import { saveContentAction } from "@/app/admin/actions";
import { contentSchema } from "./contentSchema";
import RepeaterField from "./RepeaterField";

// Renderiza un formulario amigable por sección según contentSchema.
// Strings -> input/textarea (str__campo). Listas -> RepeaterField (json__campo).
export default function ContentSectionForm({
  sectionKey,
  value,
}: {
  sectionKey: string;
  value: Record<string, unknown>;
}) {
  const action = saveContentAction.bind(null, sectionKey);
  const schema = contentSchema[sectionKey];
  if (!schema) return null;

  return (
    <form action={action} className="card section-block">
      <h2>{schema.title}</h2>
      {schema.fields.map((f) => {
        switch (f.type) {
          case "text":
          case "textarea": {
            const val = String(value[f.name] ?? "");
            return (
              <div className="field" key={f.name}>
                <label htmlFor={`${sectionKey}-${f.name}`}>{f.label}</label>
                {f.type === "textarea" ? (
                  <textarea id={`${sectionKey}-${f.name}`} name={`str__${f.name}`} defaultValue={val} />
                ) : (
                  <input id={`${sectionKey}-${f.name}`} name={`str__${f.name}`} defaultValue={val} />
                )}
                {f.help && <span className="muted">{f.help}</span>}
              </div>
            );
          }
          case "list-object":
            return (
              <RepeaterField
                key={f.name}
                name={f.name}
                label={f.label}
                itemLabel={f.itemLabel}
                subfields={f.subfields}
                initial={value[f.name]}
              />
            );
          case "list-text":
            return (
              <RepeaterField
                key={f.name}
                name={f.name}
                label={f.label}
                itemLabel={f.itemLabel}
                initial={value[f.name]}
              />
            );
          default:
            return null;
        }
      })}
      <button className="abtn" type="submit">Guardar sección</button>
    </form>
  );
}
