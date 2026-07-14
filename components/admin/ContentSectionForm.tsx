import { saveContentAction } from "@/app/admin/actions";

const sectionTitles: Record<string, string> = {
  general: "Datos generales (marca, teléfono, email, WhatsApp…)",
  hero: "Hero (portada)",
  about: "Sobre el especialista",
  services_head: "Encabezado de Servicios",
  gallery: "Galería (encabezado + bloque destacado)",
  process: "Proceso",
  testimonials_head: "Encabezado de Testimonios",
  contact: "Contacto (encabezado)",
};

// value: objeto JSON de la sección. Renderiza inputs para strings y
// textareas JSON para arrays/objetos (badges, stats, steps, paragraphs…).
export default function ContentSectionForm({
  sectionKey,
  value,
}: {
  sectionKey: string;
  value: Record<string, unknown>;
}) {
  const action = saveContentAction.bind(null, sectionKey);

  return (
    <form action={action} className="card section-block">
      <h2>{sectionTitles[sectionKey] ?? sectionKey}</h2>
      {Object.entries(value).map(([field, val]) => {
        const isString = typeof val === "string";
        const isLong = isString && (val as string).length > 60;
        if (isString) {
          return (
            <div className="field" key={field}>
              <label htmlFor={`${sectionKey}-${field}`}>{field}</label>
              {isLong ? (
                <textarea id={`${sectionKey}-${field}`} name={`str__${field}`} defaultValue={val as string} />
              ) : (
                <input id={`${sectionKey}-${field}`} name={`str__${field}`} defaultValue={val as string} />
              )}
            </div>
          );
        }
        // Arrays / objetos -> JSON editable
        return (
          <div className="field" key={field}>
            <label htmlFor={`${sectionKey}-${field}`}>{field} <span className="muted">(JSON)</span></label>
            <textarea
              id={`${sectionKey}-${field}`}
              name={`json__${field}`}
              defaultValue={JSON.stringify(val, null, 2)}
              style={{ fontFamily: "monospace", minHeight: 140 }}
            />
          </div>
        );
      })}
      <button className="abtn" type="submit">Guardar sección</button>
    </form>
  );
}
