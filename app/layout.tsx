import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  metadataBase: new URL("https://www.example.com"),
  title: "Pepe Ayulo | Premium Landscape Designer in Northern Virginia",
  description:
    "Pepe Ayulo, VA-certified horticulturist with 15+ years of experience and 2,500+ landscaping projects: garden design, patios, retaining walls, irrigation and outdoor lighting in Loudoun and Fairfax. Request your free consultation.",
  keywords:
    "landscaping, landscape design, garden design, patios, retaining walls, irrigation systems, outdoor lighting, Virginia, Loudoun, Fairfax",
  authors: [{ name: "Pepe Ayulo" }],
  robots: { index: true, follow: true, "max-image-preview": "large" } as Metadata["robots"],
  alternates: { canonical: "https://www.example.com/" },
  openGraph: {
    type: "website",
    locale: "en_US",
    url: "https://www.example.com/",
    title: "Pepe Ayulo | Landscape Design Specialist in Virginia",
    description:
      "2,500+ projects completed. Garden design, patios, walls, irrigation and outdoor lighting in Northern Virginia. Free consultation.",
    images: [
      "https://www.meadowsfarms.com/wp-content/uploads/2022/05/hero-waterfall.jpg",
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: "Pepe Ayulo | Premium Landscaping",
    description:
      "High-end landscape and garden design in Virginia. 15+ years of experience.",
    images: [
      "https://www.meadowsfarms.com/wp-content/uploads/2022/05/hero-waterfall.jpg",
    ],
  },
};

const jsonLd = {
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  name: "Pepe Ayulo — Landscape & Garden Design",
  image:
    "https://www.meadowsfarms.com/wp-content/uploads/2022/05/hero-waterfall.jpg",
  description:
    "Premium garden design, residential and commercial landscaping, patios, walls, irrigation and outdoor lighting services.",
  telephone: "+1-703-327-3940",
  areaServed: ["Loudoun, Virginia", "Fairfax, Virginia"],
  address: {
    "@type": "PostalAddress",
    addressRegion: "Virginia",
    addressCountry: "US",
  },
  priceRange: "$$",
  employee: {
    "@type": "Person",
    name: "Pepe Ayulo",
    jobTitle: "Landscape Designer / VA-Certified Horticulturist",
    image:
      "https://www.meadowsfarms.com/wp-content/uploads/2022/05/pepe-picture.jpg",
  },
  aggregateRating: {
    "@type": "AggregateRating",
    ratingValue: "4.9",
    reviewCount: "320",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
          rel="preconnect"
          href="https://fonts.gstatic.com"
          crossOrigin=""
        />
        <link
          href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,560;0,9..144,640;1,9..144,460&family=Instrument+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet"
        />
        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: JSON.stringify(jsonLd) }}
        />
      </head>
      <body>{children}</body>
    </html>
  );
}
