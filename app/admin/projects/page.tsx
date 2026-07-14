import Link from "next/link";
import AdminShell from "@/components/admin/AdminShell";
import ProjectForm from "@/components/admin/ProjectForm";
import { requireUser } from "@/lib/auth";
import { adminGetProjects } from "@/lib/admin-data";
import { deleteProjectAction } from "@/app/admin/actions";

export const dynamic = "force-dynamic";

export default async function ProjectsAdmin() {
  await requireUser();
  const projects = await adminGetProjects();

  return (
    <AdminShell active="projects" title="Galería de proyectos" subtitle="Imágenes que se muestran en la sección Projects.">
      <div className="section-block">
        <div className="card table-wrap">
          <table className="table">
            <thead>
              <tr><th>Orden</th><th>Imagen</th><th>Leyenda</th><th>Visible</th><th></th></tr>
            </thead>
            <tbody>
              {projects.map((p) => (
                <tr key={p.id}>
                  <td>{p.sort_order}</td>
                  <td>{/* eslint-disable-next-line @next/next/no-img-element */}
                    <img className="thumb" src={p.image_url} alt={p.alt} /></td>
                  <td>{p.caption}<br /><span className="muted">{p.alt}</span></td>
                  <td>{p.is_active ? "Sí" : "No"}</td>
                  <td>
                    <div className="row-actions">
                      <Link className="abtn secondary small" href={`/admin/projects/${p.id}`}>Editar</Link>
                      <form action={deleteProjectAction}>
                        <input type="hidden" name="id" value={p.id} />
                        <input type="hidden" name="image_path" value={p.image_path ?? ""} />
                        <button className="abtn danger small" type="submit">Eliminar</button>
                      </form>
                    </div>
                  </td>
                </tr>
              ))}
              {projects.length === 0 && (
                <tr><td colSpan={5} className="muted">No hay proyectos todavía.</td></tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <div className="section-block">
        <h2>Agregar proyecto</h2>
        <ProjectForm />
      </div>
    </AdminShell>
  );
}
