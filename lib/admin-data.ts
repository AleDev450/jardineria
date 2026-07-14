import { createSupabaseAdminClient } from "./supabase/admin";
import { defaultContent } from "./defaults";
import type {
  Service,
  Project,
  Testimonial,
  ContactMessage,
  SiteContent,
  SiteContentKey,
} from "./types";

// Acceso a datos para el panel admin (service_role, ignora RLS, incluye inactivos).

export async function adminGetServices(): Promise<Service[]> {
  const s = createSupabaseAdminClient();
  const { data } = await s.from("services").select("*").order("sort_order");
  return (data as Service[]) || [];
}

export async function adminGetProjects(): Promise<Project[]> {
  const s = createSupabaseAdminClient();
  const { data } = await s.from("projects").select("*").order("sort_order");
  return (data as Project[]) || [];
}

export async function adminGetTestimonials(): Promise<Testimonial[]> {
  const s = createSupabaseAdminClient();
  const { data } = await s.from("testimonials").select("*").order("sort_order");
  return (data as Testimonial[]) || [];
}

export async function adminGetMessages(): Promise<ContactMessage[]> {
  const s = createSupabaseAdminClient();
  const { data } = await s
    .from("contact_messages")
    .select("*")
    .order("created_at", { ascending: false });
  return (data as ContactMessage[]) || [];
}

export async function adminGetContent(): Promise<SiteContent> {
  const s = createSupabaseAdminClient();
  const { data } = await s.from("site_content").select("key, value");
  const merged: SiteContent = structuredClone(defaultContent);
  for (const row of data || []) {
    const key = row.key as SiteContentKey;
    if (key in merged && row.value && typeof row.value === "object") {
      merged[key] = { ...(merged[key] as object), ...(row.value as object) } as never;
    }
  }
  return merged;
}
