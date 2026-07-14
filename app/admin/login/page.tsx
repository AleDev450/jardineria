"use client";

import { Suspense, useState } from "react";
import { useRouter, useSearchParams } from "next/navigation";
import { createSupabaseBrowserClient } from "@/lib/supabase/client";
import { LeafLogo } from "@/components/icons";

function LoginForm() {
  const router = useRouter();
  const params = useSearchParams();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const configured = Boolean(
    process.env.NEXT_PUBLIC_SUPABASE_URL &&
      process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY
  );

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    if (!configured) return;
    setLoading(true);
    setError(null);
    const supabase = createSupabaseBrowserClient();
    const { error } = await supabase.auth.signInWithPassword({ email, password });
    if (error) {
      setError("Credenciales incorrectas. Verifica tu correo y contraseña.");
      setLoading(false);
      return;
    }
    router.replace(params.get("redirect") || "/admin");
    router.refresh();
  }

  return (
    <div className="login-wrap">
      <form className="login-card" onSubmit={handleSubmit}>
        <div style={{ display: "flex", alignItems: "center", gap: ".5rem", color: "var(--pine)", marginBottom: "1.2rem" }}>
          <span style={{ width: 34, height: 34, display: "inline-block" }}><LeafLogo /></span>
          <strong style={{ fontFamily: "var(--ff-display)", fontSize: "1.1rem" }}>Pepe Ayulo Admin</strong>
        </div>
        <h1>Iniciar sesión</h1>
        <p className="muted" style={{ marginBottom: "1.4rem" }}>Panel de administración del sitio.</p>
        {!configured && (
          <div className="notice warn" style={{ marginBottom: "1.2rem" }}>
            Supabase no está configurado. Copia <code>.env.local.example</code> a <code>.env.local</code>,
            rellena tus claves y reinicia el servidor.
          </div>
        )}
        <div className="field">
          <label htmlFor="email">Correo</label>
          <input id="email" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required autoComplete="email" />
        </div>
        <div className="field">
          <label htmlFor="password">Contraseña</label>
          <input id="password" type="password" value={password} onChange={(e) => setPassword(e.target.value)} required autoComplete="current-password" />
        </div>
        <button className="abtn" type="submit" disabled={loading} style={{ width: "100%", justifyContent: "center", marginTop: ".4rem" }}>
          {loading ? "Ingresando…" : "Ingresar"}
        </button>
        {error && <div className="err">{error}</div>}
      </form>
    </div>
  );
}

export default function LoginPage() {
  return (
    <Suspense fallback={<div className="login-wrap" />}>
      <LoginForm />
    </Suspense>
  );
}
