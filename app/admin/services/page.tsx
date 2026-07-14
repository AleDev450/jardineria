import Link from "next/link";
import AdminShell from "@/components/admin/AdminShell";
import ServiceForm from "@/components/admin/ServiceForm";
import { requireUser } from "@/lib/auth";
import { adminGetServices } from "@/lib/admin-data";
import { deleteServiceAction } from "@/app/admin/actions";

export const dynamic = "force-dynamic";

export default async function ServicesAdmin() {
  await requireUser();
  const services = await adminGetServices();

  return (
    <AdminShell active="services" title="Servicios" subtitle="Gestiona los servicios que aparecen en la landing.">
      <div className="section-block">
        <div className="card table-wrap">
          <table className="table">
            <thead>
              <tr><th>Orden</th><th>Ícono</th><th>Título</th><th>Descripción</th><th>Visible</th><th></th></tr>
            </thead>
            <tbody>
              {services.map((s) => (
                <tr key={s.id}>
                  <td>{s.sort_order}</td>
                  <td className="muted">{s.icon_key}</td>
                  <td><b>{s.title}</b></td>
                  <td className="muted">{s.description}</td>
                  <td>{s.is_active ? "Sí" : "No"}</td>
                  <td>
                    <div className="row-actions">
                      <Link className="abtn secondary small" href={`/admin/services/${s.id}`}>Editar</Link>
                      <form action={deleteServiceAction}>
                        <input type="hidden" name="id" value={s.id} />
                        <button className="abtn danger small" type="submit">Eliminar</button>
                      </form>
                    </div>
                  </td>
                </tr>
              ))}
              {services.length === 0 && (
                <tr><td colSpan={6} className="muted">No hay servicios todavía.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <div className="section-block">
        <h2>Agregar servicio</h2>
        <ServiceForm />
      </div>
    </AdminShell>
  );
}
