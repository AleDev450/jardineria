import AdminShell from "@/components/admin/AdminShell";
import ContentSectionForm from "@/components/admin/ContentSectionForm";
import { requireUser } from "@/lib/auth";
import { adminGetContent } from "@/lib/admin-data";
import type { SiteContentKey } from "@/lib/types";

export const dynamic = "force-dynamic";

const order: SiteContentKey[] = [
  "general",
  "hero",
  "about",
  "services_head",
  "gallery",
  "process",
  "testimonials_head",
  "contact",
];

export default async function ContentAdmin() {
  await requireUser();
  const content = await adminGetContent();

  return (
    <AdminShell active="content" title="Contenido del sitio" subtitle="Textos de Hero, Sobre, Proceso y encabezados. La sección Service Area es estática.">
      <div className="notice">
        Los campos marcados como <b>(JSON)</b> son listas (badges, estadísticas, pasos…). Edita respetando la estructura;
        si el JSON es inválido, se mostrará un error al guardar.
      </div>
      {order.map((key) => (
        <ContentSectionForm
          key={key}
          sectionKey={key}
          value={content[key] as unknown as Record<string, unknown>}
        />
      ))}
    </AdminShell>
  );
}
