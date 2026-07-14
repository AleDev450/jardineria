import type {
  SiteContent,
  Service,
  Project,
  Testimonial,
} from "./types";

// Contenido por defecto (idéntico a prototipo_1.html / seed).
// Se usa como fallback si Supabase aún no está configurado o falla.

export const defaultContent: SiteContent = {
  general: {
    brandName: "Pepe Ayulo",
    brandTag: "LANDSCAPE DESIGN",
    phone: "+1 703 327 3940",
    phoneRaw: "+17033273940",
    email: "hello@pepeayulo-landscaping.com",
    whatsapp: "17033273940",
    location: "Chantilly, Virginia — serving Loudoun & Fairfax",
    hours: "Mon – Sat · 8:00 am to 6:00 pm",
  },
  hero: {
    eyebrow: "Premium landscaping · Northern Virginia",
    titleLead: "Meet your",
    titleEm: "landscape design",
    titleTail: "specialist",
    subtitle:
      "Pepe Ayulo, a VA-certified horticulturist with 15+ years transforming outdoor spaces: gardens, patios, walls, water features and lighting that raise the value of your home.",
    image:
      "https://www.meadowsfarms.com/wp-content/uploads/2022/05/hero-waterfall.jpg",
    ctaPrimary: "Request a free consultation",
    ctaSecondary: "View projects",
    badges: [
      { value: "2,500+", label: "projects designed & installed" },
      { value: "15+", label: "years of experience" },
      { value: "98%", label: "satisfied clients" },
    ],
  },
  about: {
    eyebrow: "About the specialist",
    title: "From sketch to garden, one trusted designer",
    image:
      "https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe-picture.jpg",
    stamp: "VA-Certified Horticulturist",
    paragraphs: [
      "Pepe Ayulo is a Virginia-certified horticulturist and landscape designer. While earning his Bachelor of Science degree, he excelled in woody plants, perennials, site analysis and planning, turf management, and landscape design.",
      "His hands-on experience covers plantings, screening trees, around-pool landscaping, patios, decorative walls, drainage, sodding, outdoor carpentry, water features, irrigation systems and exterior lighting — from small jobs to large estates.",
    ],
    quote:
      "I began my career in the green industry at age 19. My goal is friendly, professional service — if you hire us, I personally make sure your project goes smoothly from start to finish.",
    certs: [
      "VA-Certified Horticulturist",
      "B.S. — Horticulture & Design",
      "Full design + installation",
    ],
    stats: [
      { target: 2500, suffix: "+", label: "projects completed" },
      { target: 15, suffix: "+", label: "years of experience" },
      { target: 98, suffix: "%", label: "satisfied clients" },
    ],
  },
  services_head: {
    eyebrow: "Services",
    title: "Everything your outdoor space needs, one team",
    subtitle:
      "Design, installation and maintenance with premium materials and a guarantee on plants and workmanship.",
  },
  gallery: {
    eyebrow: "Project gallery",
    title: "Real work, in real backyards",
    subtitle:
      "A selection of patios, walls, gardens and lighting installed by Pepe and his crew.",
    featureEyebrow: "From sketch to reality",
    featureTitle: "Every project starts on paper",
    featureText:
      "Before a single stone is moved, you receive a scaled design of your space. What you approve on paper is exactly what we build in your yard.",
    featureImage:
      "https://www.meadowsfarms.com/wp-content/uploads/2022/08/landscape-design-mockup-1024x737.jpg",
    featureCta: "Get my design",
  },
  process: {
    eyebrow: "How we work",
    title: "Five steps, zero surprises",
    subtitle:
      "A method proven across 2,500+ projects, so you know exactly what happens at every stage.",
    steps: [
      {
        title: "Initial Consultation",
        text: "We visit your property, listen to your ideas and assess soil, light and drainage.",
      },
      {
        title: "Custom Design",
        text: "We create a scaled plan with plant selections, materials and living zones.",
      },
      {
        title: "Project Presentation",
        text: "We review the design and estimate together, refining until you approve.",
      },
      {
        title: "Installation",
        text: "In-house crews, guaranteed materials and a clear timeline.",
      },
      {
        title: "Follow-up & Maintenance",
        text: "We support your garden as it grows with check-ins and care plans.",
      },
    ],
  },
  testimonials_head: {
    eyebrow: "Testimonials",
    title: "What our clients say",
  },
  contact: {
    eyebrow: "Contact",
    title: "Start with a free consultation",
    subtitle:
      "Tell us about your space and schedule a 1–2 hour on-site visit with our designer.",
  },
};

export const defaultServices: Service[] = [
  { icon_key: "garden-design", title: "Garden Design", description: "Custom scaled plans that balance plant species, light and lifestyle." },
  { icon_key: "residential", title: "Residential Landscaping", description: "Front yards, backyards and green areas that elevate your home." },
  { icon_key: "commercial", title: "Commercial Landscaping", description: "Corporate grounds and HOAs with planned, reliable upkeep." },
  { icon_key: "irrigation", title: "Irrigation Systems", description: "Smart irrigation and drainage that protect every plant and your bill." },
  { icon_key: "sod", title: "Sod & Lawn Installation", description: "Sodding and seeding with professional grading and soil prep." },
  { icon_key: "pruning", title: "Professional Pruning", description: "Shaping and plant health care for trees, hedges and shrubs." },
  { icon_key: "vertical", title: "Vertical Gardens", description: "Living walls and climbing plants for modern patios and facades." },
  { icon_key: "lighting", title: "Outdoor Lighting", description: "Warm light for walkways, facades and gardens that shine at night." },
  { icon_key: "maintenance", title: "Grounds Maintenance", description: "Monthly plans: mowing, fertilizing, pest control and monitoring." },
].map((s, i) => ({ ...s, id: `default-${i}`, sort_order: i + 1, is_active: true }));

const projectData: Array<[string, string, string]> = [
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe1-1200x900-1-1024x768.jpg", "Curved stacked-stone retaining wall beside a house and lawn", "Retaining wall · Stacked stone"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe2-1200x900-1-1024x768.jpg", "Curved stone wall bordering a patio with pink and red flowers", "Flowering border planting"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe3-1024x768.jpg", "Raised stone patio with stairs and mulched flower bed", "Raised patio · Hardscape"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe6-1200x900-1-1024x768.jpg", "Stone tile patio with white staircase to a raised deck", "Integrated patio + deck"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe7-1200x900-1-1024x768.jpg", "Backyard with gray and reddish stone pavers and a curved bench", "Paver patio with stone bench"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe9-1200x891-1-1024x760.jpg", "Backyard corner with evergreen trees and a stone path", "Privacy screen · Evergreens"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe10.jpg", "Two-story house lit at night with front yard landscaping", "Outdoor lighting at night"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe11.jpg", "White house with lit porch, walkway and landscaped yard at dusk", "Facade lighting at dusk"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe13-1200x900-1-1024x768.jpg", "Courtyard with brick walls, stone benches and garden beds", "Courtyard · Minimalist design"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe16-1200x900-1-1024x768.jpg", "Stacked-stone retaining wall along a brick building", "Retaining wall & drainage"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe17-1200x900-1-1024x768.jpg", "Stone walkway with dark brick border and steps", "Stone walkway with steps"],
  ["https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe2-583x1024.jpg", "Garden with dry creek bed, purple flowers and a glass birdbath", "Dry creek bed · Natural style"],
];

export const defaultProjects: Project[] = projectData.map(([image_url, alt, caption], i) => ({
  id: `default-${i}`,
  image_url,
  image_path: null,
  alt,
  caption,
  sort_order: i + 1,
  is_active: true,
}));

export const defaultTestimonials: Testimonial[] = [
  { name: "Erin L.", city: "Aldie, VA", quote: "Pepe was a pleasure to work with — we will definitely be doing more projects with his team!", initials: "EL" },
  { name: "Sara & Dan W.", city: "Chantilly, VA", quote: "Wonderful to work with! He listened to every request and delivered a design that was exactly what we envisioned.", initials: "SD" },
  { name: "Patrick H.", city: "Fairfax, VA", quote: "Pepe has worked with us before and, as always, the job was excellent from start to finish.", initials: "PH" },
].map((t, i) => ({ ...t, id: `default-${i}`, rating: 5, sort_order: i + 1, is_active: true }));
