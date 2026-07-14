# Pepe Ayulo Landscaping — Sitio administrable

Landing page premium de paisajismo (Northern Virginia) convertida en un proyecto
**administrable**, a partir de `prototipo_1.html`.

- **Frontend + Backend:** Next.js 14 (App Router) + TypeScript — SSR para SEO.
- **Datos / Auth / Storage:** Supabase (Postgres + Row Level Security + Auth + Storage).
- **Diseño:** portado 1:1 del prototipo (`app/globals.css`). Fuentes: Fraunces + Instrument Sans.

El sitio público lee el contenido desde Supabase. Si Supabase aún no está
configurado, **igual funciona** mostrando el contenido por defecto del prototipo
(`lib/defaults.ts`), así que puedes verlo de inmediato.

---

## 1. Requisitos

- Node.js 18+ (probado con Node 24)
- Una cuenta gratuita en [supabase.com](https://supabase.com)

## 2. Instalar y correr en local

```bash
npm install
npm run dev
```

Abre <http://localhost:3000> (sitio) y <http://localhost:3000/admin> (panel).

Sin `.env.local`, el sitio muestra el contenido por defecto y el panel te avisa
que configures Supabase.

## 3. Configurar Supabase

1. Crea un proyecto en Supabase.
2. **SQL Editor** → pega y ejecuta todo el contenido de [`supabase/schema.sql`](supabase/schema.sql).
   Esto crea las tablas, las políticas RLS y carga el contenido inicial (seed).
3. **Storage** → crea un bucket **público** llamado `gallery`
   (Storage → New bucket → nombre `gallery` → marca *Public bucket*).
4. **Project Settings → API** → copia:
   - `Project URL`
   - `anon public` key
   - `service_role` key (secreta)
5. Copia el archivo de ejemplo y rellena tus claves:

   ```bash
   cp .env.local.example .env.local
   ```

   ```env
   NEXT_PUBLIC_SUPABASE_URL=https://TU-PROYECTO.supabase.co
   NEXT_PUBLIC_SUPABASE_ANON_KEY=...
   SUPABASE_SERVICE_ROLE_KEY=...
   NEXT_PUBLIC_SUPABASE_STORAGE_BUCKET=gallery
   ```

6. Reinicia `npm run dev`.

> ⚠️ `SUPABASE_SERVICE_ROLE_KEY` es secreta y **solo se usa en el servidor**.
> Nunca la expongas en el cliente ni la subas a git (`.env.local` está en `.gitignore`).

## 4. Crear el usuario administrador

El login del panel usa Supabase Auth (email + contraseña).

- Supabase Dashboard → **Authentication → Users → Add user** → crea tu usuario
  con email y contraseña (marca *Auto Confirm User*).

Luego entra en <http://localhost:3000/admin/login>.

## 5. ¿Qué se puede administrar?

Desde `/admin`:

| Sección       | Qué edita                                                        |
|---------------|------------------------------------------------------------------|
| **Contenido** | Textos de Hero, Sobre, Proceso, encabezados y datos generales (teléfono, email, WhatsApp). Las listas (badges, estadísticas, pasos) se editan como JSON. |
| **Servicios** | Alta/edición/baja de servicios (título, descripción, ícono, orden, visibilidad). |
| **Galería**   | Subir imágenes a Supabase Storage (o por URL), con leyenda y alt. |
| **Testimonios** | Reseñas de clientes (nombre, ciudad, texto, estrellas).       |
| **Mensajes**  | Ver/marcar/eliminar los envíos del formulario de contacto.       |

> La sección **Service Area / Cobertura** es estática (no administrable), tal como
> se acordó — vive en `app/page.tsx`.

## 6. Estructura del proyecto

```
app/
  layout.tsx            SEO, fuentes, JSON-LD (Schema.org)
  page.tsx              Landing pública (SSR, ISR cada 60s)
  globals.css           CSS portado del prototipo
  api/contact/route.ts  Guarda mensajes del formulario
  admin/                Panel de administración
    login/              Login (Supabase Auth)
    content|services|projects|testimonials|messages/
    actions.ts          Server Actions (CRUD, protegidas por sesión)
components/
  ClientScripts.tsx     Loader, menú, reveal, contadores, lightbox
  ContactForm.tsx       Formulario de contacto
  icons.tsx             Íconos SVG (mapa por icon_key)
  admin/                Formularios y shell del panel
lib/
  supabase/             Clientes: server (SSR), admin (service_role), client (browser)
  data.ts               Lectura pública con fallback a defaults
  admin-data.ts         Lectura para el panel (incluye inactivos)
  defaults.ts           Contenido por defecto (= prototipo)
  types.ts              Tipos del dominio
supabase/schema.sql     Esquema + RLS + seed
middleware.ts           Refresca sesión y protege /admin
prototipo_1.html        Prototipo original (referencia)
```

## 7. Deploy (Vercel)

1. Sube el repo a GitHub.
2. En [vercel.com](https://vercel.com) → New Project → importa el repo.
3. En **Environment Variables** agrega las 4 variables del `.env.local`.
4. Deploy. Vercel detecta Next.js automáticamente.

## 8. Seguridad

- Lectura pública restringida por **RLS** (solo `select` de contenido activo).
- `contact_messages` no es accesible con la clave pública; se escribe/lee solo
  desde el servidor con `service_role`.
- Todas las mutaciones del panel verifican la sesión (`requireUser`) antes de tocar la BD.
- Las rutas `/admin` están protegidas por `middleware.ts`.
