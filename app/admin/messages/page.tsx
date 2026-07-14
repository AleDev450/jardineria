import AdminShell from "@/components/admin/AdminShell";
import { requireUser } from "@/lib/auth";
import { adminGetMessages } from "@/lib/admin-data";
import { toggleMessageReadAction, deleteMessageAction } from "@/app/admin/actions";

export const dynamic = "force-dynamic";

export default async function MessagesAdmin() {
  await requireUser();
  const messages = await adminGetMessages();
  const unread = messages.filter((m) => !m.is_read).length;

  return (
    <AdminShell
      active="messages"
      title="Mensajes de contacto"
      subtitle={`${messages.length} en total · ${unread} sin leer`}
    >
      <div className="card table-wrap">
        <table className="table">
          <thead>
            <tr>
              <th>Fecha</th><th>Contacto</th><th>Servicio</th><th>Mensaje</th><th></th>
            </tr>
          </thead>
          <tbody>
            {messages.map((m) => (
              <tr key={m.id} className={m.is_read ? "" : "unread"}>
                <td className="muted">{new Date(m.created_at).toLocaleString("es-PE")}</td>
                <td>
                  <b>{m.name}</b><br />
                  {m.email && <a href={`mailto:${m.email}`}>{m.email}</a>}<br />
                  {m.phone && <a href={`tel:${m.phone}`}>{m.phone}</a>}
                </td>
                <td>{m.service}</td>
                <td style={{ maxWidth: 340 }}>{m.message}</td>
                <td>
                  <div className="row-actions">
                    <form action={toggleMessageReadAction}>
                      <input type="hidden" name="id" value={m.id} />
                      <input type="hidden" name="is_read" value={String(m.is_read)} />
                      <button className="abtn secondary small" type="submit">
                        {m.is_read ? "Marcar no leído" : "Marcar leído"}
                      </button>
                    </form>
                    <form action={deleteMessageAction}>
                      <input type="hidden" name="id" value={m.id} />
                      <button className="abtn danger small" type="submit">Eliminar</button>
                    </form>
                  </div>
                </td>
              </tr>
            ))}
            {messages.length === 0 && (
              <tr><td colSpan={5} className="muted">Aún no hay mensajes.</td></tr>
            )}
          </tbody>
        </table>
      </div>
    </AdminShell>
  );
}
