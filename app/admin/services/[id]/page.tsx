import { notFound } from "next/navigation";
import AdminShell from "@/components/admin/AdminShell";
import ServiceForm from "@/components/admin/ServiceForm";
import { requireUser } from "@/lib/auth";
import { adminGetServices } from "@/lib/admin-data";

export const dynamic = "force-dynamic";

export default async function EditService({ params }: { params: { id: string } }) {
  await requireUser();
  const services = await adminGetServices();
  const service = services.find((s) => s.id === params.id);
  if (!service) notFound();

  return (
    <AdminShell active="services" title="Editar servicio" subtitle={service.title}>
      <ServiceForm service={service} />
    </AdminShell>
  );
}
