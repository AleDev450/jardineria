import { saveTestimonialAction } from "@/app/admin/actions";
import type { Testimonial } from "@/lib/types";

export default function TestimonialForm({ t }: { t?: Testimonial }) {
  return (
    <form action={saveTestimonialAction} className="card">
      {t && <input type="hidden" name="id" value={t.id} />}
      <div className="field-row">
        <div className="field">
          <label htmlFor="name">Nombre</label>
          <input id="name" name="name" defaultValue={t?.name} required />
        </div>
        <div className="field">
          <label htmlFor="city">Ciudad</label>
          <input id="city" name="city" defaultValue={t?.city} />
        </div>
      </div>
      <div className="field">
        <label htmlFor="quote">Testimonio</label>
        <textarea id="quote" name="quote" defaultValue={t?.quote} required />
      </div>
      <div className="field-row">
        <div className="field">
          <label htmlFor="initials">Iniciales (avatar)</label>
          <input id="initials" name="initials" maxLength={3} defaultValue={t?.initials} placeholder="EL" />
        </div>
        <div className="field">
          <label htmlFor="rating">Estrellas (1-5)</label>
          <input id="rating" name="rating" type="number" min={1} max={5} defaultValue={t?.rating ?? 5} />
        </div>
      </div>
      <div className="field-row">
        <div className="field">
          <label htmlFor="sort_order">Orden</label>
          <input id="sort_order" name="sort_order" type="number" defaultValue={t?.sort_order ?? 0} />
        </div>
        <div className="field" style={{ alignSelf: "end" }}>
          <label style={{ display: "flex", gap: ".5rem", alignItems: "center" }}>
            <input type="checkbox" name="is_active" defaultChecked={t?.is_active ?? true} style={{ width: "auto" }} />
            Visible en el sitio
          </label>
        </div>
      </div>
      <button className="abtn" type="submit">{t ? "Guardar cambios" : "Agregar testimonio"}</button>
    </form>
  );
}
