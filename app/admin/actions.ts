"use server";

import { revalidatePath } from "next/cache";
import { redirect } from "next/navigation";
import { requireUser } from "@/lib/auth";
import { createSupabaseServerClient } from "@/lib/supabase/server";
import { createSupabaseAdminClient } from "@/lib/supabase/admin";

const BUCKET = process.env.NEXT_PUBLIC_SUPABASE_STORAGE_BUCKET || "gallery";

function revalidateAll() {
  revalidatePath("/");
}

// ============ AUTH ============
export async function signOutAction() {
  const supabase = createSupabaseServerClient();
  await supabase.auth.signOut();
  redirect("/admin/login");
}

// ============ SITE CONTENT ============
// Reconstruye el JSON de la sección desde el formulario.
// Campos "str__<k>" -> string ; "json__<k>" -> JSON.parse.
export async function saveContentAction(sectionKey: string, formData: FormData) {
  await requireUser();
  const value: Record<string, unknown> = {};
  for (const [name, raw] of formData.entries()) {
    if (typeof raw !== "string") continue;
    if (name.startsWith("str__")) {
      value[name.slice(5)] = raw;
    } else if (name.startsWith("json__")) {
      try {
        value[name.slice(6)] = JSON.parse(raw);
      } catch {
        throw new Error(`El campo "${name.slice(6)}" no es JSON válido.`);
      }
    }
  }
  const supabase = createSupabaseAdminClient();
  const { error } = await supabase
    .from("site_content")
    .upsert({ key: sectionKey, value }, { onConflict: "key" });
  if (error) throw new Error(error.message);
  revalidateAll();
  revalidatePath("/admin/content");
}

// ============ SERVICES ============
export async function saveServiceAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const payload = {
    icon_key: String(formData.get("icon_key") || "garden-design"),
    title: String(formData.get("title") || "").trim(),
    description: String(formData.get("description") || "").trim(),
    sort_order: Number(formData.get("sort_order") || 0),
    is_active: formData.get("is_active") === "on",
  };
  const supabase = createSupabaseAdminClient();
  const { error } = id
    ? await supabase.from("services").update(payload).eq("id", id)
    : await supabase.from("services").insert(payload);
  if (error) throw new Error(error.message);
  revalidateAll();
  revalidatePath("/admin/services");
  redirect("/admin/services");
}

export async function deleteServiceAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const supabase = createSupabaseAdminClient();
  await supabase.from("services").delete().eq("id", id);
  revalidateAll();
  revalidatePath("/admin/services");
}

// ============ TESTIMONIALS ============
export async function saveTestimonialAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const payload = {
    name: String(formData.get("name") || "").trim(),
    city: String(formData.get("city") || "").trim(),
    quote: String(formData.get("quote") || "").trim(),
    rating: Math.min(5, Math.max(1, Number(formData.get("rating") || 5))),
    initials: String(formData.get("initials") || "").trim(),
    sort_order: Number(formData.get("sort_order") || 0),
    is_active: formData.get("is_active") === "on",
  };
  const supabase = createSupabaseAdminClient();
  const { error } = id
    ? await supabase.from("testimonials").update(payload).eq("id", id)
    : await supabase.from("testimonials").insert(payload);
  if (error) throw new Error(error.message);
  revalidateAll();
  revalidatePath("/admin/testimonials");
  redirect("/admin/testimonials");
}

export async function deleteTestimonialAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const supabase = createSupabaseAdminClient();
  await supabase.from("testimonials").delete().eq("id", id);
  revalidateAll();
  revalidatePath("/admin/testimonials");
}

// ============ PROJECTS (GALERÍA) ============
export async function saveProjectAction(formData: FormData) {
  await requireUser();
  const supabase = createSupabaseAdminClient();
  const id = String(formData.get("id") || "");
  const alt = String(formData.get("alt") || "").trim();
  const caption = String(formData.get("caption") || "").trim();
  const sort_order = Number(formData.get("sort_order") || 0);
  const is_active = formData.get("is_active") === "on";
  const urlField = String(formData.get("image_url") || "").trim();

  let image_url = urlField;
  let image_path: string | null = null;

  const file = formData.get("image_file");
  if (file instanceof File && file.size > 0) {
    const ext = file.name.split(".").pop() || "jpg";
    const path = `projects/${Date.now()}-${Math.random().toString(36).slice(2)}.${ext}`;
    const { error: upErr } = await supabase.storage
      .from(BUCKET)
      .upload(path, file, { contentType: file.type, upsert: false });
    if (upErr) throw new Error("Error al subir imagen: " + upErr.message);
    const { data: pub } = supabase.storage.from(BUCKET).getPublicUrl(path);
    image_url = pub.publicUrl;
    image_path = path;
  }

  if (!image_url) throw new Error("Debes subir una imagen o indicar una URL.");

  const payload = { image_url, alt, caption, sort_order, is_active } as Record<string, unknown>;
  if (image_path) payload.image_path = image_path;

  const { error } = id
    ? await supabase.from("projects").update(payload).eq("id", id)
    : await supabase.from("projects").insert(payload);
  if (error) throw new Error(error.message);
  revalidateAll();
  revalidatePath("/admin/projects");
  redirect("/admin/projects");
}

export async function deleteProjectAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const image_path = String(formData.get("image_path") || "");
  const supabase = createSupabaseAdminClient();
  if (image_path) {
    await supabase.storage.from(BUCKET).remove([image_path]);
  }
  await supabase.from("projects").delete().eq("id", id);
  revalidateAll();
  revalidatePath("/admin/projects");
}

// ============ MESSAGES ============
export async function toggleMessageReadAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const is_read = formData.get("is_read") === "true";
  const supabase = createSupabaseAdminClient();
  await supabase.from("contact_messages").update({ is_read: !is_read }).eq("id", id);
  revalidatePath("/admin/messages");
  revalidatePath("/admin");
}

export async function deleteMessageAction(formData: FormData) {
  await requireUser();
  const id = String(formData.get("id") || "");
  const supabase = createSupabaseAdminClient();
  await supabase.from("contact_messages").delete().eq("id", id);
  revalidatePath("/admin/messages");
  revalidatePath("/admin");
}
