import { getSiteData } from "@/lib/data";
import ContactForm from "@/components/ContactForm";
import ClientScripts from "@/components/ClientScripts";
import {
  ServiceIcon,
  LeafLogo,
  CheckIcon,
  LeafMark,
  PinIcon,
} from "@/components/icons";

export const revalidate = 60; // ISR: refresca contenido de la BD cada 60s

export default async function Home() {
  const { content, services, projects, testimonials } = await getSiteData();
  const { general, hero, about, services_head, gallery, process, testimonials_head, contact } = content;
  const year = new Date().getFullYear();

  return (
    <>
      {/* ================= LOADER ================= */}
      <div id="loader" aria-hidden="true">
        <svg width="150" height="170" viewBox="0 0 150 170" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Growing tree">
          <path className="tree-trunk" d="M75 162 V96 M75 118 C75 118 56 110 46 92 M75 110 C75 110 96 104 106 84 M75 96 C75 96 64 84 60 64 M75 96 C75 96 88 82 92 60 M75 96 V52" />
          <ellipse className="tree-leaf" style={{ animationDelay: ".55s" }} cx="44" cy="86" rx="11" ry="7" transform="rotate(-38 44 86)" />
          <ellipse className="tree-leaf" style={{ animationDelay: ".75s" }} cx="108" cy="78" rx="11" ry="7" transform="rotate(34 108 78)" />
          <ellipse className="tree-leaf" style={{ animationDelay: ".95s" }} cx="57" cy="56" rx="11" ry="7" transform="rotate(-52 57 56)" />
          <ellipse className="tree-leaf" style={{ animationDelay: "1.15s" }} cx="95" cy="52" rx="11" ry="7" transform="rotate(48 95 52)" />
          <ellipse className="tree-leaf" style={{ animationDelay: "1.35s" }} cx="75" cy="42" rx="12" ry="8" transform="rotate(0 75 42)" />
          <ellipse className="tree-leaf" style={{ animationDelay: "1.55s" }} cx="60" cy="34" rx="10" ry="6.5" transform="rotate(-28 60 34)" />
          <ellipse className="tree-leaf" style={{ animationDelay: "1.75s" }} cx="90" cy="32" rx="10" ry="6.5" transform="rotate(26 90 32)" />
          <ellipse className="tree-leaf" style={{ animationDelay: "1.95s" }} cx="75" cy="22" rx="9" ry="6" transform="rotate(0 75 22)" />
        </svg>
        <p>Growing your outdoor space…</p>
        <div className="bar"><span></span></div>
      </div>

      {/* ================= HEADER ================= */}
      <header id="top">
        <div className="container nav">
          <a className="logo" href="#top" aria-label="Home">
            <LeafLogo />
            {general.brandName}{" "}
            <span style={{ fontFamily: "var(--ff-body)", fontSize: ".7rem", letterSpacing: ".2em", opacity: 0.7, marginLeft: ".2rem" }}>
              {general.brandTag}
            </span>
          </a>
          <nav>
            <ul className="nav-links" id="navLinks">
              <li><a href="#sobre">About</a></li>
              <li><a href="#servicios">Services</a></li>
              <li><a href="#proyectos">Projects</a></li>
              <li><a href="#proceso">Process</a></li>
              <li><a href="#contacto">Contact</a></li>
            </ul>
          </nav>
          <a href="#contacto" className="btn btn-primary nav-cta">Free consultation</a>
          <button className="burger" id="burger" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
        </div>
      </header>

      {/* ================= HERO ================= */}
      <section className="hero">
        <div className="hero-bg">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img src={hero.image} alt="Natural stone waterfall flowing into a pond surrounded by lush greenery" fetchPriority="high" />
        </div>
        <div className="container hero-inner">
          <span className="eyebrow">{hero.eyebrow}</span>
          <h1>{hero.titleLead} <em>{hero.titleEm}</em> {hero.titleTail}</h1>
          <p>{hero.subtitle}</p>
          <div className="hero-actions">
            <a href="#contacto" className="btn btn-primary">{hero.ctaPrimary}</a>
            <a href="#proyectos" className="btn btn-ghost">{hero.ctaSecondary}</a>
          </div>
          <div className="hero-badge">
            {hero.badges.map((b, i) => (
              <div key={i}><b>{b.value}</b>{b.label}</div>
            ))}
          </div>
        </div>
      </section>

      {/* ================= SOBRE ================= */}
      <section className="section about" id="sobre">
        <div className="container about-grid">
          <div className="about-photo reveal">
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img src={about.image} alt="Portrait of Pepe Ayulo, landscape designer" loading="lazy" />
            <div className="stamp">{about.stamp}</div>
          </div>
          <div className="about-body reveal">
            <span className="eyebrow">{about.eyebrow}</span>
            <h2>{about.title}</h2>
            {about.paragraphs.map((p, i) => (
              <p key={i}>{p}</p>
            ))}
            <blockquote className="about-quote">&ldquo;{about.quote}&rdquo;</blockquote>
            <ul className="certs">
              {about.certs.map((c, i) => (
                <li key={i}><CheckIcon />{c}</li>
              ))}
            </ul>
            <div className="stats">
              {about.stats.map((s, i) => (
                <div className="stat" key={i}>
                  <b><span className="count" data-target={s.target}>0</span>{s.suffix}</b>
                  <span>{s.label}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ================= SERVICIOS ================= */}
      <section className="section services" id="servicios">
        <div className="container">
          <div className="section-head reveal">
            <span className="eyebrow">{services_head.eyebrow}</span>
            <h2>{services_head.title}</h2>
            <p>{services_head.subtitle}</p>
          </div>
          <div className="services-grid">
            {services.map((s) => (
              <article className="service reveal" key={s.id}>
                <div className="ico"><ServiceIcon iconKey={s.icon_key} /></div>
                <h3>{s.title}</h3>
                <p>{s.description}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      {/* ================= GALERÍA ================= */}
      <section className="section" id="proyectos">
        <div className="container">
          <div className="section-head reveal">
            <span className="eyebrow">{gallery.eyebrow}</span>
            <h2>{gallery.title}</h2>
            <p>{gallery.subtitle}</p>
          </div>

          <div className="gallery-feature reveal">
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img src={gallery.featureImage} alt="Finished garden with the original design sketch overlay" loading="lazy" />
            <div className="gf-text">
              <span className="eyebrow">{gallery.featureEyebrow}</span>
              <h3>{gallery.featureTitle}</h3>
              <p>{gallery.featureText}</p>
              <a href="#contacto" className="btn btn-primary" style={{ alignSelf: "flex-start" }}>{gallery.featureCta}</a>
            </div>
          </div>

          <div className="gallery-grid">
            {projects.map((p) => (
              <button className="g-item reveal" type="button" key={p.id}>
                {/* eslint-disable-next-line @next/next/no-img-element */}
                <img src={p.image_url} alt={p.alt} loading="lazy" />
                <figcaption>{p.caption}</figcaption>
              </button>
            ))}
          </div>
        </div>
      </section>
      <div id="lightbox" role="dialog" aria-modal="true" aria-label="Enlarged project view">
        <button type="button" aria-label="Close">&times;</button>
        {/* eslint-disable-next-line @next/next/no-img-element */}
        <img src="" alt="" />
      </div>

      {/* ================= PROCESO ================= */}
      <section className="section process" id="proceso">
        <div className="container">
          <div className="section-head reveal">
            <span className="eyebrow">{process.eyebrow}</span>
            <h2>{process.title}</h2>
            <p>{process.subtitle}</p>
          </div>
          <div className="steps">
            {process.steps.map((step, i) => (
              <div className="step reveal" key={i}>
                <LeafMark />
                <h3>{step.title}</h3>
                <p>{step.text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ================= TESTIMONIOS ================= */}
      <section className="section testimonials" id="testimonios">
        <div className="container">
          <div className="section-head reveal">
            <span className="eyebrow">{testimonials_head.eyebrow}</span>
            <h2>{testimonials_head.title}</h2>
          </div>
          <div className="t-grid">
            {testimonials.map((t) => (
              <article className="t-card reveal" key={t.id}>
                <div className="stars" aria-label={`${t.rating} out of 5 stars`}>{"★".repeat(t.rating)}</div>
                <blockquote>&ldquo;{t.quote}&rdquo;</blockquote>
                <footer>
                  <div className="avatar">{t.initials}</div>
                  <div><b>{t.name}</b><span>{t.city}</span></div>
                </footer>
              </article>
            ))}
          </div>
        </div>
      </section>

      {/* ================= CONTACTO ================= */}
      <section className="section contact" id="contacto">
        <div className="container contact-grid">
          <div className="reveal">
            <span className="eyebrow">{contact.eyebrow}</span>
            <h2>{contact.title}</h2>
            <p style={{ color: "#54625a", marginBottom: "1.8rem" }}>{contact.subtitle}</p>
            <ul className="c-info">
              <li>
                <div className="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.4 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.6 1.9Z" /></svg></div>
                <div><b>Phone</b><a href={`tel:${general.phoneRaw}`}>{general.phone}</a></div>
              </li>
              <li>
                <div className="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round"><rect x="2" y="4" width="20" height="16" rx="2" /><path d="m22 7-10 6L2 7" /></svg></div>
                <div><b>Email</b><a href={`mailto:${general.email}`}>{general.email}</a></div>
              </li>
              <li>
                <div className="ico"><PinIcon /></div>
                <div><b>Location</b><span>{general.location}</span></div>
              </li>
              <li>
                <div className="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg></div>
                <div><b>Hours</b><span>{general.hours}</span></div>
              </li>
            </ul>
          </div>
          <ContactForm />
        </div>
      </section>

      {/* ================= FOOTER ================= */}
      <footer className="site">
        <div className="container">
          <div className="f-grid">
            <a className="logo" href="#top">
              <LeafLogo />
              {general.brandName} Landscaping
            </a>
            <ul style={{ display: "flex", gap: "1.6rem", flexWrap: "wrap" }}>
              <li><a href="#sobre">About</a></li>
              <li><a href="#servicios">Services</a></li>
              <li><a href="#proyectos">Projects</a></li>
              <li><a href="#contacto">Contact</a></li>
            </ul>
          </div>
          <div className="f-bottom">
            <span>© <span id="year">{year}</span> {general.brandName} Landscaping. All rights reserved.</span>
            <span>Premium landscape design · Loudoun &amp; Fairfax, Virginia</span>
          </div>
        </div>
      </footer>

      {/* ================= WHATSAPP FLOAT ================= */}
      <a className="wa-float" href={`https://wa.me/${general.whatsapp}?text=Hi%2C%20I%27d%20like%20a%20free%20landscaping%20consultation`} target="_blank" rel="noopener" aria-label="Message us on WhatsApp">
        <svg viewBox="0 0 32 32"><path d="M16 3C9.4 3 4 8.4 4 15c0 2.6.8 5 2.3 7L4 29l7.2-2.3c1.9 1 4 1.6 6.2 1.3h.6c6.6 0 12-5.4 12-12S22.6 3 16 3zm7 17c-.3.8-1.7 1.6-2.4 1.7-.6.1-1.4.2-2.3-.1-.5-.2-1.2-.4-2.1-.8-3.7-1.6-6.1-5.3-6.3-5.6-.2-.2-1.5-2-1.5-3.8s1-2.7 1.3-3c.3-.4.7-.5 1-.5h.7c.2 0 .5-.1.8.6.3.8 1.1 2.7 1.2 2.8.1.2.2.4 0 .7-.1.3-.2.4-.4.7l-.6.7c-.2.2-.4.4-.2.8.2.4 1 1.7 2.2 2.7 1.5 1.4 2.8 1.8 3.2 2 .4.2.6.1.9-.1.2-.3 1-1.2 1.3-1.6.3-.4.5-.3.9-.2.4.1 2.2 1 2.6 1.2.4.2.6.3.7.5.1.2.1.9-.2 1.7z" /></svg>
      </a>

      <ClientScripts />
    </>
  );
}
