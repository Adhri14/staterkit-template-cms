import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Th from "@/Components/tables/Th";
import Td from "@/Components/tables/Td";
import SecondaryButton from "@/Components/buttons/SecondaryButton";
import Pagination from "@/Components/buttons/Pagination";
import { Link, usePage } from "@inertiajs/react"

export default function LogAdminIndex() {
    const { title, log_admins, trash } = usePage().props;
    return (
        <AuthenticatedLayout>
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
                                <thead>
                                    <tr className="hidden lg:table-row">
                                        <Th>Subject</Th>
                                        <Th>Module</Th>
                                        <Th>Action</Th>
                                        <Th>URL</Th>
                                        <Th>Method</Th>
                                        <Th>IP</Th>
                                        <Th>Admin</Th>
                                        <Th></Th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {log_admins.data.map((log_admin, index) => (
                                        <tr className="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0" key={log_admin.id}>
                                            <Td>
                                                <strong className="block lg:hidden">Subject</strong>
                                                <span>{log_admin.subject ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">Module</strong>
                                                <span>{log_admin.module ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">Action</strong>
                                                <span>{log_admin.action ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">URL</strong>
                                                <span className="text-blue-500">{log_admin.url ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                {log_admin.method === 'POST' && (
                                                    <span className="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                                {log_admin.method === 'PUT' || log_admin.method === 'PATCH' && (
                                                    <span v-if="log_admin.method === 'PUT' || log_admin.method === 'PATCH'" className="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                                {log_admin.method === 'DELETE' && (
                                                    <span className="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">IP</strong>
                                                <span>{log_admin.ip_address ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">Admin</strong>
                                                <span>{log_admin.admin.name ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                {trash ? (
                                                    <div >
                                                        <SecondaryButton v-tooltip="'Restore'" className="px-3 py-2 bg-green-500 rounded-none rounded-l-md" href={route('log-admin.restore', { log_admin })} method="post" as="button">
                                                            <i className="fas fa-rotate-right"></i>
                                                        </SecondaryButton>
                                                        <SecondaryButton v-tooltip="'Destroy'" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('log-admin.forceDelete', { log_admin })} method="post" as="button">
                                                            <i className="fas fa-trash-can"></i>
                                                        </SecondaryButton>
                                                    </div>
                                                ) : (
                                                    <div>
                                                        <SecondaryButton v-tooltip="'View Detail'" className="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" href={route('log-admin.show', { log_admin })}>
                                                            <i className="fas fa-eye"></i>
                                                        </SecondaryButton>
                                                    </div>
                                                )}

                                            </Td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <div className="mt-6">
                                <Pagination links={log_admins.meta.links} />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}