// Esquema de campos por sección de contenido, con etiquetas en español.
// Evita exponer "JSON" al administrador: las listas se editan con campos y
// botones Agregar/Quitar (ver RepeaterField).

export type SubField = { name: string; label: string; kind?: "text" | "number" };

export type FieldSchema =
  | { name: string; label: string; type: "text" | "textarea"; help?: string }
  | { name: string; label: string; type: "list-text"; itemLabel: string; help?: string }
  | {
      name: string;
      label: string;
      type: "list-object";
      itemLabel: string;
      subfields: SubField[];
      help?: string;
    };

export type SectionSchema = { title: string; fields: FieldSchema[] };

export const contentSchema: Record<string, SectionSchema> = {
  general: {
    title: "Datos generales",
    fields: [
      { name: "brandName", label: "Nombre de la marca", type: "text" },
      { name: "brandTag", label: "Etiqueta bajo la marca", type: "text" },
      { name: "phone", label: "Teléfono (como se muestra)", type: "text" },
      { name: "phoneRaw", label: "Teléfono para el enlace (sin espacios, con +)", type: "text" },
      { name: "email", label: "Correo electrónico", type: "text" },
      { name: "whatsapp", label: "WhatsApp (número con código de país, sin +)", type: "text" },
      { name: "location", label: "Ubicación", type: "text" },
      { name: "hours", label: "Horario de atención", type: "text" },
    ],
  },
  hero: {
    title: "Portada (Hero)",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "titleLead", label: "Título — inicio", type: "text" },
      { name: "titleEm", label: "Título — palabra destacada (en verde)", type: "text" },
      { name: "titleTail", label: "Título — final", type: "text" },
      { name: "subtitle", label: "Subtítulo", type: "textarea" },
      { name: "image", label: "Imagen de fondo (URL)", type: "text", help: "Recomendado: 1920 × 1080 px (horizontal, 16:9), JPG/WebP." },
      { name: "ctaPrimary", label: "Botón principal", type: "text" },
      { name: "ctaSecondary", label: "Botón secundario", type: "text" },
      {
        name: "badges",
        label: "Indicadores (números destacados)",
        type: "list-object",
        itemLabel: "Indicador",
        subfields: [
          { name: "value", label: "Número" },
          { name: "label", label: "Descripción" },
        ],
      },
    ],
  },
  about: {
    title: "Sobre el especialista",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
      { name: "image", label: "Foto (URL)", type: "text", help: "Recomendado: 800 × 1000 px (vertical, 4:5), JPG/WebP." },
      { name: "stamp", label: "Sello sobre la foto", type: "text" },
      { name: "paragraphs", label: "Párrafos", type: "list-text", itemLabel: "Párrafo" },
      { name: "quote", label: "Cita destacada", type: "textarea" },
      { name: "certs", label: "Certificaciones / insignias", type: "list-text", itemLabel: "Certificación" },
      {
        name: "stats",
        label: "Estadísticas",
        type: "list-object",
        itemLabel: "Estadística",
        subfields: [
          { name: "target", label: "Número", kind: "number" },
          { name: "suffix", label: "Símbolo (+, %, etc.)" },
          { name: "label", label: "Descripción" },
        ],
      },
    ],
  },
  services_head: {
    title: "Encabezado de Servicios",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
      { name: "subtitle", label: "Subtítulo", type: "textarea" },
    ],
  },
  gallery: {
    title: "Galería",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
      { name: "subtitle", label: "Subtítulo", type: "textarea" },
      { name: "featureEyebrow", label: "Bloque destacado — texto superior", type: "text" },
      { name: "featureTitle", label: "Bloque destacado — título", type: "text" },
      { name: "featureText", label: "Bloque destacado — descripción", type: "textarea" },
      { name: "featureImage", label: "Bloque destacado — imagen (URL)", type: "text", help: "Recomendado: 1024 × 740 px (horizontal, 4:3), JPG/WebP." },
      { name: "featureCta", label: "Bloque destacado — botón", type: "text" },
    ],
  },
  process: {
    title: "Proceso",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
      { name: "subtitle", label: "Subtítulo", type: "textarea" },
      {
        name: "steps",
        label: "Pasos",
        type: "list-object",
        itemLabel: "Paso",
        subfields: [
          { name: "title", label: "Título del paso" },
          { name: "text", label: "Descripción" },
        ],
      },
    ],
  },
  testimonials_head: {
    title: "Encabezado de Testimonios",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
    ],
  },
  contact: {
    title: "Contacto (encabezado)",
    fields: [
      { name: "eyebrow", label: "Texto pequeño superior", type: "text" },
      { name: "title", label: "Título", type: "text" },
      { name: "subtitle", label: "Subtítulo", type: "textarea" },
    ],
  },
};
