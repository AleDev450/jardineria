// Tipos del dominio — reflejan las tablas de supabase/schema.sql

export type Service = {
  id: string;
  icon_key: string;
  title: string;
  description: string;
  sort_order: number;
  is_active: boolean;
};

export type Project = {
  id: string;
  image_url: string;
  image_path: string | null;
  alt: string;
  caption: string;
  sort_order: number;
  is_active: boolean;
};

export type Testimonial = {
  id: string;
  name: string;
  city: string;
  quote: string;
  rating: number;
  initials: string;
  sort_order: number;
  is_active: boolean;
};

export type ContactMessage = {
  id: string;
  name: string;
  phone: string;
  email: string;
  service: string;
  message: string;
  is_read: boolean;
  created_at: string;
};

// ---- Bloques de site_content (value jsonb) ----
export type GeneralContent = {
  brandName: string;
  brandTag: string;
  phone: string;
  phoneRaw: string;
  email: string;
  whatsapp: string;
  location: string;
  hours: string;
};

export type HeroBadge = { value: string; label: string };
export type HeroContent = {
  eyebrow: string;
  titleLead: string;
  titleEm: string;
  titleTail: string;
  subtitle: string;
  image: string;
  ctaPrimary: string;
  ctaSecondary: string;
  badges: HeroBadge[];
};

export type AboutStat = { target: number; suffix: string; label: string };
export type AboutContent = {
  eyebrow: string;
  title: string;
  image: string;
  stamp: string;
  paragraphs: string[];
  quote: string;
  certs: string[];
  stats: AboutStat[];
};

export type SectionHead = { eyebrow: string; title: string; subtitle?: string };

export type GalleryContent = SectionHead & {
  featureEyebrow: string;
  featureTitle: string;
  featureText: string;
  featureImage: string;
  featureCta: string;
};

export type ProcessStep = { title: string; text: string };
export type ProcessContent = SectionHead & { steps: ProcessStep[] };

export type SiteContent = {
  general: GeneralContent;
  hero: HeroContent;
  about: AboutContent;
  services_head: SectionHead;
  gallery: GalleryContent;
  process: ProcessContent;
  testimonials_head: SectionHead;
  contact: SectionHead;
};

export type SiteContentKey = keyof SiteContent;
