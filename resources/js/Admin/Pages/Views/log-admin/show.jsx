import ComponentsProvider from "@/Admin/Components";
import AuthenticatedLayout from "@/Admin/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function LogAdminShow({ log_admin, title }) {
  return (
    <AuthenticatedLayout>
      <Head title={title} />
      <div className="flex flex-wrap mt-4">
        <div className="w-full mb-12 px-4">
          <div className="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            <div className="rounded-t mb-0 px-6 py-4 border-0">
              <div className="flex flex-wrap items-center">
                <div className="relative w-full max-w-full flex">
                  <div className="flex items-center">
                    <h3 className="font-bold text-lg">
                      {title}
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div className="block w-full overflow-x-auto">
              <table className="items-center w-full bg-transparent border-collapse">
                <tr className="hidden lg:table-row">
                  <tr>
                    <ComponentsProvider.Td>Admin</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.admin.name ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Subject</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.subject ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Module</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.module ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Action</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.action ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>URL</ComponentsProvider.Td>
                    <ComponentsProvider.Td className="text-blue-500">: {log_admin.url ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Method</ComponentsProvider.Td>
                    <ComponentsProvider.Td>:
                      {log_admin.method === 'POST' && <span className="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>}
                      {log_admin.method === 'PUT' || log_admin.method === 'PATCH' && <span v-if="log_admin.method === 'PUT' || log_admin.method === 'PATCH'" className="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>}
                      {log_admin.method === 'DELETE' && <span className="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>}
                    </ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>IP Address</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.ip_address ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>User Agent</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.agent ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Login Date</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.login_at ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Logout Date</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.logout_at ?? '-'}</ComponentsProvider.Td>
                  </tr>
                  <tr>
                    <ComponentsProvider.Td>Created Date</ComponentsProvider.Td>
                    <ComponentsProvider.Td>: {log_admin.created_at ?? '-'}</ComponentsProvider.Td>
                  </tr>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}