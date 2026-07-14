import { notFound } from "next/navigation";
import AdminShell from "@/components/admin/AdminShell";
import ProjectForm from "@/components/admin/ProjectForm";
import { requireUser } from "@/lib/auth";
import { adminGetProjects } from "@/lib/admin-data";

export const dynamic = "force-dynamic";

export default async function EditProject({ params }: { params: { id: string } }) {
  await requireUser();
  const projects = await adminGetProjects();
  const project = projects.find((p) => p.id === params.id);
  if (!project) notFound();

  return (
    <AdminShell active="projects" title="Editar proyecto" subtitle={project.caption}>
      <ProjectForm project={project} />
    </AdminShell>
  );
}
