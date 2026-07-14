import { saveProjectAction } from "@/app/admin/actions";
import type { Project } from "@/lib/types";

export default function ProjectForm({ project }: { project?: Project }) {
  return (
    <form action={saveProjectAction} className="card" encType="multipart/form-data">
      {project && <input type="hidden" name="id" value={project.id} />}
      {project?.image_path && <input type="hidden" name="image_path" value={project.image_path} />}

      <div className="field">
        <label htmlFor="image_file">
          Subir imagen {project ? "(deja vacío para conservar la actual)" : ""}
        </label>
        <input id="image_file" name="image_file" type="file" accept="image/*" />
        <span className="muted">
          Medida recomendada: <b>1200 × 900 px</b> (proporción 4:3, horizontal) · JPG o WebP · máx. 500 KB
          para la mejor calidad y velocidad de carga. Se sube a Supabase Storage; también puedes pegar una URL abajo.
        </span>
      </div>
      <div className="field">
        <label htmlFor="image_url">URL de imagen (opcional)</label>
        <input id="image_url" name="image_url" defaultValue={project?.image_url} placeholder="https://…" />
      </div>
      <div className="field">
        <label htmlFor="caption">Leyenda (caption)</label>
        <input id="caption" name="caption" defaultValue={project?.caption} placeholder="Retaining wall · Stacked stone" />
      </div>
      <div className="field">
        <label htmlFor="alt">Texto alternativo (alt / SEO)</label>
        <input id="alt" name="alt" defaultValue={project?.alt} placeholder="Descripción de la imagen" />
      </div>
      <div className="field-row">
        <div className="field">
          <label htmlFor="sort_order">Orden</label>
          <input id="sort_order" name="sort_order" type="number" defaultValue={project?.sort_order ?? 0} />
        </div>
        <div className="field" style={{ alignSelf: "end" }}>
          <label style={{ display: "flex", gap: ".5rem", alignItems: "center" }}>
            <input type="checkbox" name="is_active" defaultChecked={project?.is_active ?? true} style={{ width: "auto" }} />
            Visible en el sitio
          </label>
        </div>
      </div>
      <button className="abtn" type="submit">{project ? "Guardar cambios" : "Agregar a la galería"}</button>
    </form>
  );
}
