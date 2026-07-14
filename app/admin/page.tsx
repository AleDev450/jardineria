import AdminShell from "@/components/admin/AdminShell";
import { requireUser } from "@/lib/auth";
import {
  adminGetServices,
  adminGetProjects,
  adminGetTestimonials,
  adminGetMessages,
} from "@/lib/admin-data";

export const dynamic = "force-dynamic";

export default async function AdminDashboard() {
  const user = await requireUser();
  const [services, projects, testimonials, messages] = await Promise.all([
    adminGetServices(),
    adminGetProjects(),
    adminGetTestimonials(),
    adminGetMessages(),
  ]);
  const unread = messages.filter((m) => !m.is_read).length;

  const kpis = [
    { label: "Servicios", value: services.length, href: "/admin/services" },
    { label: "Proyectos en galería", value: projects.length, href: "/admin/projects" },
    { label: "Testimonios", value: testimonials.length, href: "/admin/testimonials" },
    { label: "Mensajes sin leer", value: unread, href: "/admin/messages" },
  ];

  return (
    <AdminShell active="dashboard" title="Dashboard" subtitle={`Sesión: ${user.email}`}>
      <div className="grid-cards">
        {kpis.map((k) => (
          <a key={k.label} href={k.href} className="card kpi">
            <b>{k.value}</b>
            <span>{k.label}</span>
          </a>
        ))}
      </div>

      <div className="section-block" style={{ marginTop: "2rem" }}>
        <h2>Últimos mensajes</h2>
        {messages.length === 0 ? (
          <p className="muted">Aún no hay mensajes del formulario de contacto.</p>
        ) : (
          <div className="card table-wrap">
            <table className="table">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Servicio</th>
                  <th>Mensaje</th>
                </tr>
              </thead>
              <tbody>
                {messages.slice(0, 5).map((m) => (
                  <tr key={m.id} className={m.is_read ? "" : "unread"}>
                    <td className="muted">{new Date(m.created_at).toLocaleDateString("es-PE")}</td>
                    <td>{m.name}</td>
                    <td>{m.service}</td>
                    <td>{m.message.slice(0, 60)}{m.message.length > 60 ? "…" : ""}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>
    </AdminShell>
  );
}
