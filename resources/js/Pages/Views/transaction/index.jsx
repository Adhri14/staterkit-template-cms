import { Head } from "@inertiajs/react"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import SecondaryLink from "@/Components/buttons/SecondaryLink";
import Th from "@/Components/tables/Th";
import Td from "@/Components/tables/Td";
import Pagination from "@/Components/buttons/Pagination";
import { FaEye, FaPencil, FaRotateRight, FaTrashCan } from "react-icons/fa6";
import { useState } from "react";
import InputLabel from "@/Components/forms/InputLabel";
import TextInput from "@/Components/forms/TextInput";

{/* <script setup>
import { ref } from 'vue';

const props  = defineProps({
    transactions: Object,
    title:String,
    trash:Boolean,
});

const start_date = ref();
const end_date = ref();

</script>
<template>
    
 </template> */}

export default function TransactionIndex({ transactions, title, trash }) {
    const [startDate, setStartDate] = useState('');
    const [endDate, setEndDate] = useState('');

    return (
        <AuthenticatedLayout>
            <Head title={title} />
            <div className="flex flex-wrap mt-4">
                <div className="w-full mb-12 px-4">
                    <div className="relative flex flex-col min-w-0 break-words lg:w-1/2 w-full mb-6 shadow-lg rounded bg-white">
                        <div className="block w-full p-4">
                            <h2 className="font-bold mb-6">Export Excel Data</h2>
                            <div className="flex gap-2 mb-2">
                                <div className="w-full">
                                    <InputLabel htmlFor="start_date" value="Start Date" />
                                    <TextInput className="w-full" type="date" name="start_date" value={startDate} onChange={e => setStartDate(e.targe.value)} format="dd/MM/yyyy" placeholder="Select Published Date" />
                                </div>
                                <div className="w-full">
                                    <InputLabel htmlFor="end_date" value="End Date" />
                                    <TextInput className="w-full" type="date" name="start_date" value={endDate} onChange={e => setEndDate(e.targe.value)} format="dd/MM/yyyy" placeholder="Select Published Date" />
                                </div>
                            </div>
                            <a href={route('transaction.export', { start_date: startDate, end_date: endDate })} className="w-full font-medium py-2 px-4 block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0">Export</a>
                        </div>
                    </div>
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
                                        <SecondaryLink href={trash != '1' ? route('transaction.index', { trash: '1' }) : route('transaction.index')} tooltip={trash != 1 ? 'Trash' : 'Transactions'} className="px-3 py-1 rounded-md bg-red-500">{trash != '1' ? 'Trash' : 'Transactions'}</SecondaryLink>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="block w-full overflow-x-auto">
                            <table className="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr className="hidden lg:table-row">
                                        <Th>Order Code</Th>
                                        <Th>Type Transaction</Th>
                                        <Th>Created Date</Th>
                                        <Th></Th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {transactions.data.length > 0 ? transactions.data.map((transaction) => (
                                        <tr className="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                                            <Td>
                                                <strong className="block lg:hidden">Order Code</strong>
                                                <span>{transaction.order_code ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">Type Transaction</strong>
                                                <span>{transaction.type_transaction ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                <strong className="block lg:hidden">Created Date</strong>
                                                <span>{transaction.created_at ?? '-'}</span>
                                            </Td>
                                            <Td>
                                                {trash ? (
                                                    <div>
                                                        <SecondaryLink tooltip="Restore" className="px-3 py-2 bg-green-500 rounded-none rounded-l-md" href={route('transaction.restore', { transaction: transaction })} method="post" as="button">
                                                            <FaRotateRight />
                                                        </SecondaryLink>
                                                        <SecondaryLink tooltip="Destroy" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('transaction.forceDelete', { transaction: transaction })} method="post" as="button">
                                                            <FaTrashCan />
                                                        </SecondaryLink>
                                                    </div>
                                                ) : (
                                                    <div>
                                                        <SecondaryLink tooltip="View Transaction" className="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" href={route('transaction.show', { transaction: transaction })}>
                                                            <FaEye />
                                                        </SecondaryLink>
                                                        <SecondaryLink tooltip="Refund Transaction" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md" href={route('transaction.delete', { transaction: transaction })} method="post" as="button">
                                                            <FaTrashCan />
                                                        </SecondaryLink>
                                                    </div>
                                                )}
                                            </Td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan={4} className="text-center py-4">No Data</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                            <Pagination className="mt-6" links={transactions.meta.links} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout >
    );
}
