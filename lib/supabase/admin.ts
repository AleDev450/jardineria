import { createClient } from "@supabase/supabase-js";

/**
 * Cliente con service_role — SOLO en el servidor. Ignora RLS.
 * Se usa para todas las mutaciones del panel admin (tras verificar sesión)
 * y para insertar mensajes de contacto.
 * NUNCA importar este módulo en código de cliente.
 */
export function createSupabaseAdminClient() {
  const url = process.env.NEXT_PUBLIC_SUPABASE_URL;
  const key = process.env.SUPABASE_SERVICE_ROLE_KEY;
  if (!url || !key) {
    throw new Error(
      "Faltan NEXT_PUBLIC_SUPABASE_URL o SUPABASE_SERVICE_ROLE_KEY en el entorno."
    );
  }
  return createClient(url, key, {
    auth: { autoRefreshToken: false, persistSession: false },
  });
}
