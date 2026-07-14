import "../globals.css";
import "./admin.css";
import type { Metadata } from "next";

export const metadata: Metadata = {
  title: "Admin · Pepe Ayulo Landscaping",
  robots: { index: false, follow: false },
};

export default function AdminLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return <div className="admin-body">{children}</div>;
}
