import Link from "next/link";
import { LeafLogo } from "@/components/icons";
import { signOutAction } from "@/app/admin/actions";

const nav = [
  { href: "/admin", label: "Dashboard", key: "dashboard" },
  { href: "/admin/content", label: "Contenido", key: "content" },
  { href: "/admin/services", label: "Servicios", key: "services" },
  { href: "/admin/projects", label: "Galería", key: "projects" },
  { href: "/admin/testimonials", label: "Testimonios", key: "testimonials" },
  { href: "/admin/messages", label: "Mensajes", key: "messages" },
];

export default function AdminShell({
  active,
  title,
  subtitle,
  children,
  actions,
}: {
  active: string;
  title: string;
  subtitle?: string;
  children: React.ReactNode;
  actions?: React.ReactNode;
}) {
  return (
    <div className="admin-shell">
      <aside className="admin-side">
        <div className="admin-brand">
          <LeafLogo />
          Pepe Ayulo
        </div>
        <nav className="admin-nav">
          {nav.map((n) => (
            <Link
              key={n.key}
              href={n.href}
              className={active === n.key ? "active" : ""}
            >
              {n.label}
            </Link>
          ))}
        </nav>
        <div className="admin-side-foot">
          <a href="/" target="_blank" rel="noopener">
            Ver sitio ↗
          </a>
          <form action={signOutAction}>
            <button type="submit" className="abtn secondary small">
              Cerrar sesión
            </button>
          </form>
        </div>
      </aside>
      <main className="admin-main">
        <div className="admin-head">
          <div>
            <h1>{title}</h1>
            {subtitle && <p>{subtitle}</p>}
          </div>
          {actions && <div className="row-actions">{actions}</div>}
        </div>
        {children}
      </main>
    </div>
  );
}
