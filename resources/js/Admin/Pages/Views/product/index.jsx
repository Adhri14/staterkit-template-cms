import ComponentsProvider from "@/Admin/Components";
import AuthenticatedLayout from "@/Admin/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { FaPencil, FaRotateRight, FaTrashCan } from "react-icons/fa6";

export default function ProductIndex({ products, title, trash }) {
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
                                    <div className="ml-auto">
                                        <ComponentsProvider.SecondaryLink href={route('product.create')} className="px-3 py-1 rounded-md bg-blue-500" tooltip="Create New">Create New</ComponentsProvider.SecondaryLink>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="block w-full overflow-x-auto">
                            <table className="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr className="hidden lg:table-row">
                                        <ComponentsProvider.Th>Title</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Price</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Discount</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Stock</ComponentsProvider.Th>
                                        <ComponentsProvider.Th>Published Date</ComponentsProvider.Th>
                                        <ComponentsProvider.Th></ComponentsProvider.Th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {products.data.length > 0 ? products.data.map((product) => (
                                        <tr key={product.id} className="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Title</strong>
                                                <span>{product.title ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Price</strong>
                                                <span>{product.price ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Discount</strong>
                                                <span>{product.discount ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Stock</strong>
                                                <span>{product.stock ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                <strong className="block lg:hidden">Published Date</strong>
                                                <span>{product.created_at ?? '-'}</span>
                                            </ComponentsProvider.Td>
                                            <ComponentsProvider.Td>
                                                {trash ? (
                                                    <div>
                                                        <ComponentsProvider.SecondaryLink tooltip="Restore" className="px-3 py-2 bg-green-500 rounded-none rounded-l-md" href={route('product.restore', { product: product })} method="post" as="button">
                                                            <FaRotateRight />
                                                        </ComponentsProvider.SecondaryLink>
                                                        <ComponentsProvider.SecondaryLink tooltip="Destroy" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('product.forceDelete', { product: product })} method="post" as="button">
                                                            <FaTrashCan />
                                                        </ComponentsProvider.SecondaryLink>
                                                    </div>
                                                ) : (
                                                    <div>
                                                        <ComponentsProvider.SecondaryLink tooltip="Edit" className="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" href={route('product.edit', { product: product })}>
                                                            <FaPencil />
                                                        </ComponentsProvider.SecondaryLink>
                                                        <ComponentsProvider.SecondaryLink tooltip="Delete" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('product.delete', { product: product })} method="post" as="button">
                                                            <FaTrashCan />
                                                        </ComponentsProvider.SecondaryLink>
                                                    </div>
                                                )}
                                            </ComponentsProvider.Td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan={6} className="text-center py-4">No Data</td>
                                        </tr>
                                    )}
                                </tbody >
                            </table >
                            <ComponentsProvider.Pagination className="mt-6" links={products.meta.links} />
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
