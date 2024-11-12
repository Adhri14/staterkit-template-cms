import Pagination from "@/Components/buttons/Pagination";
import InputLabel from "@/Components/forms/InputLabel";
import TextInput from "@/Components/forms/TextInput";
import Td from "@/Components/tables/Td";
import Th from "@/Components/tables/Th";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { useState } from "react";

export default function UserIndex({ title, users }) {
    const [startDate, setStartDate] = useState('');
    const [endDate, setEndDate] = useState('');

    return (
        <AuthenticatedLayout>
            <Head title={title} />
            <div className="flex flex-wrap mt-4">
                <div className="w-full mb-12 px-4">
                    <div className="relative flex flex-col min-w-0 break-words lg:w-1/2 w-full mb-6 shadow-lg rounded bg-white">
                        <div className="block w-full p-4">
                            <h2 className="font-bold mb-6">Export Data</h2>
                            <div className="flex gap-2 mb-2">
                                <div className="w-full">
                                    <InputLabel htmlFor="start_date" value="Start Date" />
                                    <TextInput className="w-full" name="start_date" id="start_date" value={startDate} onChange={e => setStartDate(e.target.value)} type="date" format="dd/MM/yyyy" placeholder="Select Published Date" />
                                </div>
                                <div className="w-full">
                                    <InputLabel htmlFor="end_date" value="End Date" />
                                    <TextInput className="w-full" name="end_date" id="end_date" value={startDate} onChange={e => setStartDate(e.target.value)} type="date" format="dd/MM/yyyy" placeholder="Select Published Date" />
                                </div>
                            </div>
                            <a
                                href={route('user.export', { start_date: startDate, end_date: endDate })}
                                className="w-full font-medium py-2 px-4 block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0">Export</a>
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
                                    {/* <!-- <input v-model="search" type="text" className="ml-auto rounded-md border-slate-400 mr-2 text-sm w-1/4" placeholder="Search Fullname"> --> */}
                                </div>
                            </div>
                        </div>
                        <div className="block w-full overflow-x-auto">
                            <table className="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr className="hidden lg:table-row">
                                        <Th>Fullname</Th>
                                        <Th>Username</Th>
                                        <Th>Email</Th>
                                        <Th>Register Date</Th>
                                        {/* <Th></Th> */}
                                    </tr>
                                </thead>
                                <tbody>
                                    {users.data.length > 0 ? (
                                        users.data.map((user, index) => (
                                            <tr key={index} className="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                                                <Td>
                                                    <strong className="block lg:hidden">Fullname</strong>
                                                    <span>{user.fullname ?? '-'}</span>
                                                </Td>
                                                <Td>
                                                    <strong className="block lg:hidden">Username</strong>
                                                    <span>@{user.username ?? '-'}</span>
                                                </Td>
                                                <Td>
                                                    <strong className="block lg:hidden">Email</strong>
                                                    <span>{user.email ?? '-'}</span>
                                                </Td>
                                                <Td>
                                                    <strong className="block lg:hidden">Register Date</strong>
                                                    <span>{user.created_at ?? '-'}</span>
                                                </Td>
                                                {/* <Td>
                                                    {trash ? (
                                                        <div>
                                                            <SecondaryLink tooltip="Restore" className="px-3 py-2 bg-green-500 rounded-none rounded-l-md">
                                                                <FaRotateRight />
                                                            </SecondaryLink>
                                                            <SecondaryLink tooltip="Destroy" className="px-3 py-2 bg-red-500 rounded-none rounded-r-md">
                                                                <FaTrashCan />
                                                            </SecondaryLink>
                                                        </div>
                                                    ) : (
                                                        <div>
                                                            <SecondaryLink tooltip="View Detail" className="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md">
                                                                <FaEye />
                                                            </SecondaryLink>
                                                            <SecondaryLink tooltip="Edit" className="px-3 py-2 bg-blue-500 rounded-none rounded-r-md">
                                                                <FaEdit />
                                                            </SecondaryLink>
                                                        </div>
                                                    )}
                                                </Td> */}
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan={4} className="text-center py-4">No Data</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table >
                            <Pagination className="mt-6" links={users.meta.links} />
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
