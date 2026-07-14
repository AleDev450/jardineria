import { saveServiceAction } from "@/app/admin/actions";
import { serviceIconKeys } from "@/components/icons";
import type { Service } from "@/lib/types";

export default function ServiceForm({ service }: { service?: Service }) {
  return (
    <form action={saveServiceAction} className="card">
      {service && <input type="hidden" name="id" value={service.id} />}
      <div className="field-row">
        <div className="field">
          <label htmlFor="title">Título</label>
          <input id="title" name="title" defaultValue={service?.title} required />
        </div>
        <div className="field">
          <label htmlFor="icon_key">Ícono</label>
          <select id="icon_key" name="icon_key" defaultValue={service?.icon_key || "garden-design"}>
            {serviceIconKeys.map((k) => (
              <option key={k} value={k}>{k}</option>
            ))}
          </select>
        </div>
      </div>
      <div className="field">
        <label htmlFor="description">Descripción</label>
        <textarea id="description" name="description" defaultValue={service?.description} required />
      </div>
      <div className="field-row">
        <div className="field">
          <label htmlFor="sort_order">Orden</label>
          <input id="sort_order" name="sort_order" type="number" defaultValue={service?.sort_order ?? 0} />
        </div>
        <div className="field" style={{ alignSelf: "end" }}>
          <label style={{ display: "flex", gap: ".5rem", alignItems: "center" }}>
            <input type="checkbox" name="is_active" defaultChecked={service?.is_active ?? true} style={{ width: "auto" }} />
            Visible en el sitio
          </label>
        </div>
      </div>
      <button className="abtn" type="submit">{service ? "Guardar cambios" : "Agregar servicio"}</button>
    </form>
  );
}
