import { notFound } from "next/navigation";
import AdminShell from "@/components/admin/AdminShell";
import TestimonialForm from "@/components/admin/TestimonialForm";
import { requireUser } from "@/lib/auth";
import { adminGetTestimonials } from "@/lib/admin-data";

export const dynamic = "force-dynamic";

export default async function EditTestimonial({ params }: { params: { id: string } }) {
  await requireUser();
  const items = await adminGetTestimonials();
  const t = items.find((x) => x.id === params.id);
  if (!t) notFound();

  return (
    <AdminShell active="testimonials" title="Editar testimonio" subtitle={t.name}>
      <TestimonialForm t={t} />
    </AdminShell>
  );
}
