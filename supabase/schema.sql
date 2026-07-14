-- =====================================================================
--  Pepe Ayulo Landscaping — Esquema de base de datos (Supabase / Postgres)
--  Ejecuta este archivo completo en:  Supabase Dashboard -> SQL Editor
-- =====================================================================

-- ---------- Extensiones ----------
create extension if not exists "pgcrypto";

-- ---------- Utilidad: updated_at automático ----------
create or replace function public.set_updated_at()
returns trigger language plpgsql as $$
begin
  new.updated_at = now();
  return new;
end;
$$;

-- =====================================================================
--  TABLA: site_content  (bloques de texto editables: hero, about, process...)
--  Modelo key/value con JSON para máxima flexibilidad desde el panel.
-- =====================================================================
create table if not exists public.site_content (
  key         text primary key,
  value       jsonb not null default '{}'::jsonb,
  updated_at  timestamptz not null default now()
);

drop trigger if exists trg_site_content_updated on public.site_content;
create trigger trg_site_content_updated before update on public.site_content
  for each row execute function public.set_updated_at();

-- =====================================================================
--  TABLA: services
-- =====================================================================
create table if not exists public.services (
  id          uuid primary key default gen_random_uuid(),
  icon_key    text not null default 'garden-design',
  title       text not null,
  description text not null,
  sort_order  int  not null default 0,
  is_active   boolean not null default true,
  updated_at  timestamptz not null default now(),
  created_at  timestamptz not null default now()
);

drop trigger if exists trg_services_updated on public.services;
create trigger trg_services_updated before update on public.services
  for each row execute function public.set_updated_at();

-- =====================================================================
--  TABLA: projects  (items de la galería)
-- =====================================================================
create table if not exists public.projects (
  id          uuid primary key default gen_random_uuid(),
  image_url   text not null,
  image_path  text,                    -- ruta en Storage (para poder borrarla)
  alt         text not null default '',
  caption     text not null default '',
  sort_order  int  not null default 0,
  is_active   boolean not null default true,
  updated_at  timestamptz not null default now(),
  created_at  timestamptz not null default now()
);

drop trigger if exists trg_projects_updated on public.projects;
create trigger trg_projects_updated before update on public.projects
  for each row execute function public.set_updated_at();

-- =====================================================================
--  TABLA: testimonials
-- =====================================================================
create table if not exists public.testimonials (
  id          uuid primary key default gen_random_uuid(),
  name        text not null,
  city        text not null default '',
  quote       text not null,
  rating      int  not null default 5 check (rating between 1 and 5),
  initials    text not null default '',
  sort_order  int  not null default 0,
  is_active   boolean not null default true,
  updated_at  timestamptz not null default now(),
  created_at  timestamptz not null default now()
);

drop trigger if exists trg_testimonials_updated on public.testimonials;
create trigger trg_testimonials_updated before update on public.testimonials
  for each row execute function public.set_updated_at();

-- =====================================================================
--  TABLA: contact_messages  (envíos del formulario)
-- =====================================================================
create table if not exists public.contact_messages (
  id          uuid primary key default gen_random_uuid(),
  name        text not null,
  phone       text not null default '',
  email       text not null default '',
  service     text not null default '',
  message     text not null default '',
  is_read     boolean not null default false,
  created_at  timestamptz not null default now()
);

create index if not exists idx_contact_messages_created on public.contact_messages (created_at desc);

-- =====================================================================
--  ROW LEVEL SECURITY
--  Público: solo lectura del contenido. Escrituras: vía service_role
--  (backend), que ignora RLS. contact_messages: sin acceso anónimo.
-- =====================================================================
alter table public.site_content     enable row level security;
alter table public.services         enable row level security;
alter table public.projects         enable row level security;
alter table public.testimonials     enable row level security;
alter table public.contact_messages enable row level security;

-- Lectura pública del contenido del sitio
drop policy if exists "public read site_content" on public.site_content;
create policy "public read site_content" on public.site_content
  for select to anon, authenticated using (true);

drop policy if exists "public read services" on public.services;
create policy "public read services" on public.services
  for select to anon, authenticated using (is_active = true);

drop policy if exists "public read projects" on public.projects;
create policy "public read projects" on public.projects
  for select to anon, authenticated using (is_active = true);

drop policy if exists "public read testimonials" on public.testimonials;
create policy "public read testimonials" on public.testimonials
  for select to anon, authenticated using (is_active = true);

-- contact_messages: sin políticas => nadie (excepto service_role) accede.

-- =====================================================================
--  SEED — contenido inicial tomado de prototipo_1.html
-- =====================================================================

-- ---- site_content ----
insert into public.site_content (key, value) values
('general', jsonb_build_object(
  'brandName',   'Pepe Ayulo',
  'brandTag',    'LANDSCAPE DESIGN',
  'phone',       '+1 703 327 3940',
  'phoneRaw',    '+17033273940',
  'email',       'hello@pepeayulo-landscaping.com',
  'whatsapp',    '17033273940',
  'location',    'Chantilly, Virginia — serving Loudoun & Fairfax',
  'hours',       'Mon – Sat · 8:00 am to 6:00 pm'
)),
('hero', jsonb_build_object(
  'eyebrow',     'Premium landscaping · Northern Virginia',
  'titleLead',   'Meet your',
  'titleEm',     'landscape design',
  'titleTail',   'specialist',
  'subtitle',    'Pepe Ayulo, a VA-certified horticulturist with 15+ years transforming outdoor spaces: gardens, patios, walls, water features and lighting that raise the value of your home.',
  'image',       'https://www.meadowsfarms.com/wp-content/uploads/2022/05/hero-waterfall.jpg',
  'ctaPrimary',  'Request a free consultation',
  'ctaSecondary','View projects',
  'badges',      jsonb_build_array(
    jsonb_build_object('value','2,500+','label','projects designed & installed'),
    jsonb_build_object('value','15+','label','years of experience'),
    jsonb_build_object('value','98%','label','satisfied clients')
  )
)),
('about', jsonb_build_object(
  'eyebrow',   'About the specialist',
  'title',     'From sketch to garden, one trusted designer',
  'image',     'https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe-picture.jpg',
  'stamp',     'VA-Certified Horticulturist',
  'paragraphs', jsonb_build_array(
    'Pepe Ayulo is a Virginia-certified horticulturist and landscape designer. While earning his Bachelor of Science degree, he excelled in woody plants, perennials, site analysis and planning, turf management, and landscape design.',
    'His hands-on experience covers plantings, screening trees, around-pool landscaping, patios, decorative walls, drainage, sodding, outdoor carpentry, water features, irrigation systems and exterior lighting — from small jobs to large estates.'
  ),
  'quote',     'I began my career in the green industry at age 19. My goal is friendly, professional service — if you hire us, I personally make sure your project goes smoothly from start to finish.',
  'certs',     jsonb_build_array('VA-Certified Horticulturist','B.S. — Horticulture & Design','Full design + installation'),
  'stats',     jsonb_build_array(
    jsonb_build_object('target',2500,'suffix','+','label','projects completed'),
    jsonb_build_object('target',15,'suffix','+','label','years of experience'),
    jsonb_build_object('target',98,'suffix','%','label','satisfied clients')
  )
)),
('services_head', jsonb_build_object(
  'eyebrow','Services',
  'title','Everything your outdoor space needs, one team',
  'subtitle','Design, installation and maintenance with premium materials and a guarantee on plants and workmanship.'
)),
('gallery', jsonb_build_object(
  'eyebrow','Project gallery',
  'title','Real work, in real backyards',
  'subtitle','A selection of patios, walls, gardens and lighting installed by Pepe and his crew.',
  'featureEyebrow','From sketch to reality',
  'featureTitle','Every project starts on paper',
  'featureText','Before a single stone is moved, you receive a scaled design of your space. What you approve on paper is exactly what we build in your yard.',
  'featureImage','https://www.meadowsfarms.com/wp-content/uploads/2022/08/landscape-design-mockup-1024x737.jpg',
  'featureCta','Get my design'
)),
('process', jsonb_build_object(
  'eyebrow','How we work',
  'title','Five steps, zero surprises',
  'subtitle','A method proven across 2,500+ projects, so you know exactly what happens at every stage.',
  'steps', jsonb_build_array(
    jsonb_build_object('title','Initial Consultation','text','We visit your property, listen to your ideas and assess soil, light and drainage.'),
    jsonb_build_object('title','Custom Design','text','We create a scaled plan with plant selections, materials and living zones.'),
    jsonb_build_object('title','Project Presentation','text','We review the design and estimate together, refining until you approve.'),
    jsonb_build_object('title','Installation','text','In-house crews, guaranteed materials and a clear timeline.'),
    jsonb_build_object('title','Follow-up & Maintenance','text','We support your garden as it grows with check-ins and care plans.')
  )
)),
('testimonials_head', jsonb_build_object(
  'eyebrow','Testimonials',
  'title','What our clients say'
)),
('contact', jsonb_build_object(
  'eyebrow','Contact',
  'title','Start with a free consultation',
  'subtitle','Tell us about your space and schedule a 1–2 hour on-site visit with our designer.'
))
on conflict (key) do nothing;

-- ---- services ----
insert into public.services (icon_key, title, description, sort_order) values
('garden-design','Garden Design','Custom scaled plans that balance plant species, light and lifestyle.',1),
('residential','Residential Landscaping','Front yards, backyards and green areas that elevate your home.',2),
('commercial','Commercial Landscaping','Corporate grounds and HOAs with planned, reliable upkeep.',3),
('irrigation','Irrigation Systems','Smart irrigation and drainage that protect every plant and your bill.',4),
('sod','Sod & Lawn Installation','Sodding and seeding with professional grading and soil prep.',5),
('pruning','Professional Pruning','Shaping and plant health care for trees, hedges and shrubs.',6),
('vertical','Vertical Gardens','Living walls and climbing plants for modern patios and facades.',7),
('lighting','Outdoor Lighting','Warm light for walkways, facades and gardens that shine at night.',8),
('maintenance','Grounds Maintenance','Monthly plans: mowing, fertilizing, pest control and monitoring.',9)
on conflict do nothing;

-- ---- projects (galería) ----
insert into public.projects (image_url, alt, caption, sort_order) values
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe1-1200x900-1-1024x768.jpg','Curved stacked-stone retaining wall beside a house and lawn','Retaining wall · Stacked stone',1),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe2-1200x900-1-1024x768.jpg','Curved stone wall bordering a patio with pink and red flowers','Flowering border planting',2),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe3-1024x768.jpg','Raised stone patio with stairs and mulched flower bed','Raised patio · Hardscape',3),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe6-1200x900-1-1024x768.jpg','Stone tile patio with white staircase to a raised deck','Integrated patio + deck',4),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe7-1200x900-1-1024x768.jpg','Backyard with gray and reddish stone pavers and a curved bench','Paver patio with stone bench',5),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe9-1200x891-1-1024x760.jpg','Backyard corner with evergreen trees and a stone path','Privacy screen · Evergreens',6),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe10.jpg','Two-story house lit at night with front yard landscaping','Outdoor lighting at night',7),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe11.jpg','White house with lit porch, walkway and landscaped yard at dusk','Facade lighting at dusk',8),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe13-1200x900-1-1024x768.jpg','Courtyard with brick walls, stone benches and garden beds','Courtyard · Minimalist design',9),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe16-1200x900-1-1024x768.jpg','Stacked-stone retaining wall along a brick building','Retaining wall & drainage',10),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe17-1200x900-1-1024x768.jpg','Stone walkway with dark brick border and steps','Stone walkway with steps',11),
('https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe2-583x1024.jpg','Garden with dry creek bed, purple flowers and a glass birdbath','Dry creek bed · Natural style',12)
on conflict do nothing;

-- ---- testimonials ----
insert into public.testimonials (name, city, quote, rating, initials, sort_order) values
('Erin L.','Aldie, VA','Pepe was a pleasure to work with — we will definitely be doing more projects with his team!',5,'EL',1),
('Sara & Dan W.','Chantilly, VA','Wonderful to work with! He listened to every request and delivered a design that was exactly what we envisioned.',5,'SD',2),
('Patrick H.','Fairfax, VA','Pepe has worked with us before and, as always, the job was excellent from start to finish.',5,'PH',3)
on conflict do nothing;
