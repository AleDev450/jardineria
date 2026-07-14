import { createSupabaseServerClient } from "./supabase/server";
import {
  defaultContent,
  defaultServices,
  defaultProjects,
  defaultTestimonials,
} from "./defaults";
import type {
  SiteContent,
  SiteContentKey,
  Service,
  Project,
  Testimonial,
} from "./types";

export function isSupabaseConfigured(): boolean {
  return Boolean(
    process.env.NEXT_PUBLIC_SUPABASE_URL &&
      process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY
  );
}

/** Combina lo guardado en BD con los defaults (para que baste editar campos sueltos). */
function mergeContent(
  rows: { key: string; value: unknown }[] | null
): SiteContent {
  const merged: SiteContent = structuredClone(defaultContent);
  if (!rows) return merged;
  for (const row of rows) {
    const key = row.key as SiteContentKey;
    if (key in merged && row.value && typeof row.value === "object") {
      merged[key] = { ...(merged[key] as object), ...(row.value as object) } as never;
    }
  }
  return merged;
}

/** Trae todo lo necesario para renderizar la landing (con fallback a defaults). */
export async function getSiteData(): Promise<{
  content: SiteContent;
  services: Service[];
  projects: Project[];
  testimonials: Testimonial[];
}> {
  const fallback = {
    content: defaultContent,
    services: defaultServices,
    projects: defaultProjects,
    testimonials: defaultTestimonials,
  };

  if (!isSupabaseConfigured()) return fallback;

  try {
    const supabase = createSupabaseServerClient();
    const [contentRes, servicesRes, projectsRes, testimonialsRes] =
      await Promise.all([
        supabase.from("site_content").select("key, value"),
        supabase
          .from("services")
          .select("*")
          .eq("is_active", true)
          .order("sort_order"),
        supabase
          .from("projects")
          .select("*")
          .eq("is_active", true)
          .order("sort_order"),
        supabase
          .from("testimonials")
          .select("*")
          .eq("is_active", true)
          .order("sort_order"),
      ]);

    if (contentRes.error || servicesRes.error || projectsRes.error || testimonialsRes.error) {
      return fallback;
    }

    return {
      content: mergeContent(contentRes.data),
      services: servicesRes.data?.length ? (servicesRes.data as Service[]) : defaultServices,
      projects: projectsRes.data?.length ? (projectsRes.data as Project[]) : defaultProjects,
      testimonials: testimonialsRes.data?.length
        ? (testimonialsRes.data as Testimonial[])
        : defaultTestimonials,
    };
  } catch {
    return fallback;
  }
}
