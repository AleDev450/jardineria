import { redirect } from "next/navigation";
import { createSupabaseServerClient } from "./supabase/server";
import { isSupabaseConfigured } from "./data";

/** Devuelve el usuario autenticado o redirige a /admin/login. Usar en Server Actions y páginas admin. */
export async function requireUser() {
  // Sin Supabase configurado no hay sesión posible: mandamos al login (que avisa cómo configurar).
  if (!isSupabaseConfigured()) redirect("/admin/login");
  const supabase = createSupabaseServerClient();
  const {
    data: { user },
  } = await supabase.auth.getUser();
  if (!user) redirect("/admin/login");
  return user;
}
