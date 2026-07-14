import type { ReactNode } from "react";

// Íconos de servicios, referenciados por icon_key desde la BD.
// Copiados 1:1 desde prototipo_1.html.
export const serviceIcons: Record<string, ReactNode> = {
  "garden-design": (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M12 19V5" /><path d="M12 9c0-3-2.5-5-6-5 0 3.5 2.5 6 6 5Z" /><path d="M12 13c0-3 2.5-5 6-5 0 3.5-2.5 6-6 5Z" /><path d="M5 19h14" /></svg>
  ),
  residential: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round" strokeLinejoin="round"><path d="M3 11 12 4l9 7" /><path d="M5 10v9h14v-9" /><path d="M9 19v-5h6v5" /></svg>
  ),
  commercial: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M4 21V7l6-3v17" /><path d="M10 21V11l6-2v12" /><path d="M16 21v-8l4-1v9" /><path d="M2 21h20" /></svg>
  ),
  irrigation: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M12 3c3 4 6 7.5 6 11a6 6 0 1 1-12 0c0-3.5 3-7 6-11Z" /><path d="M9 14a3 3 0 0 0 3 3" /></svg>
  ),
  sod: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M3 20h18" /><path d="M4 20c1-6 3-9 8-9s7 3 8 9" /><path d="M7 11V8M12 9V5M17 11V8" /></svg>
  ),
  pruning: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round" strokeLinejoin="round"><path d="m9 15-5 5" /><path d="M14.5 4.5 19 9l-7 7-4.5-4.5z" /><path d="M16 7l3-3" /></svg>
  ),
  vertical: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><rect x="4" y="3" width="16" height="18" rx="1" /><path d="M8 7c1.5 1 1.5 3 0 4M12 6c1.5 1 1.5 3 0 4M16 7c1.5 1 1.5 3 0 4M8 14c1.5 1 1.5 3 0 4M12 13c1.5 1 1.5 3 0 4" /></svg>
  ),
  lighting: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M9 18h6M10 21h4" /><path d="M12 3a6 6 0 0 0-4 10.5c.8.7 1 1.5 1 2.5h6c0-1 .2-1.8 1-2.5A6 6 0 0 0 12 3Z" /></svg>
  ),
  maintenance: (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round"><path d="M12 21a9 9 0 1 0-9-9" /><path d="M3 12c3 0 4 2 4 4M12 21c0-3-2-4-4-4" /><path d="M12 7v5l3 3" /></svg>
  ),
};

export const serviceIconKeys = Object.keys(serviceIcons);

export function ServiceIcon({ iconKey }: { iconKey: string }) {
  return <>{serviceIcons[iconKey] ?? serviceIcons["garden-design"]}</>;
}

export function LeafLogo() {
  return (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round">
      <path d="M12 22V10" />
      <path d="M12 10C12 5 8 3 4 3c0 5 3 8 8 7Z" fill="#7fae6b" stroke="#7fae6b" />
      <path d="M12 14c0-4 3.5-6 8-6 0 4.5-3 7-8 6Z" fill="#b9d68a" stroke="#b9d68a" />
    </svg>
  );
}

export function CheckIcon() {
  return (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M20 6 9 17l-5-5" /></svg>
  );
}

export function LeafMark() {
  return (
    <svg className="leafmark" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21c6-2 9-7 9-15-8 0-13 3-15 9 3-1 6-1 9 0-4 0-7 2-8 6h5Z" /></svg>
  );
}

export function PinIcon() {
  return (
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z" /><circle cx="12" cy="10" r="3" /></svg>
  );
}
