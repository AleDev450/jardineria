import { NextResponse } from "next/server";
import { createSupabaseAdminClient } from "@/lib/supabase/admin";
import { isSupabaseConfigured } from "@/lib/data";

export async function POST(req: Request) {
  let body: Record<string, unknown>;
  try {
    body = await req.json();
  } catch {
    return NextResponse.json({ error: "Invalid JSON" }, { status: 400 });
  }

  const name = String(body.name ?? "").trim();
  const phone = String(body.phone ?? "").trim();
  const email = String(body.email ?? "").trim();
  const service = String(body.service ?? "").trim();
  const message = String(body.message ?? "").trim();

  if (!name || !message) {
    return NextResponse.json(
      { error: "Name and message are required" },
      { status: 400 }
    );
  }

  // Sin Supabase configurado: aceptamos el envío (modo demo) para no romper el front.
  if (!isSupabaseConfigured() || !process.env.SUPABASE_SERVICE_ROLE_KEY) {
    console.warn("[contact] Supabase no configurado — mensaje no persistido:", {
      name,
      email,
    });
    return NextResponse.json({ ok: true, persisted: false });
  }

  try {
    const supabase = createSupabaseAdminClient();
    const { error } = await supabase.from("contact_messages").insert({
      name,
      phone,
      email,
      service,
      message,
    });
    if (error) throw error;
    return NextResponse.json({ ok: true, persisted: true });
  } catch (err) {
    console.error("[contact] error al guardar:", err);
    return NextResponse.json(
      { error: "Could not save message" },
      { status: 500 }
    );
  }
}
