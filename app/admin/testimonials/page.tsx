import Link from "next/link";
import AdminShell from "@/components/admin/AdminShell";
import TestimonialForm from "@/components/admin/TestimonialForm";
import { requireUser } from "@/lib/auth";
import { adminGetTestimonials } from "@/lib/admin-data";
import { deleteTestimonialAction } from "@/app/admin/actions";

export const dynamic = "force-dynamic";

export default async function TestimonialsAdmin() {
  await requireUser();
  const items = await adminGetTestimonials();

  return (
    <AdminShell active="testimonials" title="Testimonios" subtitle="Reseñas de clientes que aparecen en la landing.">
      <div className="section-block">
        <div className="card table-wrap">
          <table className="table">
            <thead>
              <tr><th>Orden</th><th>Cliente</th><th>Testimonio</th><th>★</th><th>Visible</th><th></th></tr>
            </thead>
            <tbody>
              {items.map((t) => (
                <tr key={t.id}>
                  <td>{t.sort_order}</td>
                  <td><b>{t.name}</b><br /><span className="muted">{t.city}</span></td>
                  <td className="muted">{t.quote}</td>
                  <td>{t.rating}</td>
                  <td>{t.is_active ? "Sí" : "No"}</td>
                  <td>
                    <div className="row-actions">
                      <Link className="abtn secondary small" href={`/admin/testimonials/${t.id}`}>Editar</Link>
                      <form action={deleteTestimonialAction}>
                        <input type="hidden" name="id" value={t.id} />
                        <button className="abtn danger small" type="submit">Eliminar</button>
                      </form>
                    </div>
                  </td>
                </tr>
              ))}
              {items.length === 0 && (
                <tr><td colSpan={6} className="muted">No hay testimonios todavía.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <div className="section-block">
        <h2>Agregar testimonio</h2>
        <TestimonialForm />
      </div>
    </AdminShell>
  );
}
