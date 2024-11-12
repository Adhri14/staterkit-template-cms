import ComponentsProvider from "@/Admin/Components";
import AuthenticatedLayout from "@/Admin/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react";
import { useState } from "react";
import { FaEye, FaRotateRight, FaTrashCan } from "react-icons/fa6";

export default function LogAdminIndex() {
    const { title, log_admins, trash } = usePage().props;
    const [showMenu, setShowMenu] = useState(false);
    const [dataLogAdmin, setDataLogAdmin] = useState(null);

    const handleOpenMenu = (data) => {
        setShowMenu(!showMenu);
        setDataLogAdmin(data);
    }

    console.log(dataLogAdmin);

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
                                <thead>
                                    <tr className="hidden lg:table-row">
                                        <ComponentsProvider.Th>Subject</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Module</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Action</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>URL</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Method</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>IP</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Admin</ComponentsProvider.Th>
                                        <ComponentsProvider.Th></ComponentsProvider.Th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {log_admins.data.map((log_admin) => (
                                        <tr className="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0" key={log_admin.id}>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Subject</strong>
                                                <span>{log_admin.subject ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Module</strong>
                                                <span>{log_admin.module ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Action</strong>
                                                <span>{log_admin.action ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">URL</strong>
                                                <span className="text-blue-500">{log_admin.url ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                {log_admin.method === 'POST' && (
                                                    <span className="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                                {log_admin.method === 'PUT' || log_admin.method === 'PATCH' && (
                                                    <span v-if="log_admin.method === 'PUT' || log_admin.method === 'PATCH'" className="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                                {log_admin.method === 'DELETE' && (
                                                    <span className="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{log_admin.method ?? '-'}</span>
                                                )}
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">IP</strong>
                                                <span>{log_admin.ip_address ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Admin</strong>
                                                <span>{log_admin.admin.name ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                {trash ? (
                                                    <div >
                                                        <ComponentsProvider.SecondaryLink tooltip="Restore" className="px-3 py-2 bg-green-500 rounded-none rounded-l-md" href={route('log-admin.restore', { log_admin })} method="post" as="button">
                                                            {/* <i className="fas fa-rotate-right"></i> */}
                                                            <FaRotateRight />
                                                        </ComponentsProvider.SecondaryLink>
                                                        <ComponentsProvider.SecondaryButton tooltip="Destroy" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('log-admin.forceDelete', { log_admin })} method="post" as="button">
                                                            <FaTrashCan />
                                                        </ComponentsProvider.SecondaryButton>
                                                    </div>
                                                ) : (
                                                    <ComponentsProvider.SecondaryLink tooltip="View Detail" className="px-3 py-2 bg-indigo-500 rounded-md" href={route('log-admin.show', { log_admin })}>
                                                        <FaEye />
                                                    </ComponentsProvider.SecondaryLink>
                                                )}
                                            </ComponentsProvider.Td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            {/* <Pagination links={log_admins.meta.links} /> */}
                            <ComponentsProvider.Pagination links={log_admins.meta.links} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}