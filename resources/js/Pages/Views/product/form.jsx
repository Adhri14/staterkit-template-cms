import PrimaryButton from "@/Components/buttons/PrimaryButton";
import InputError from "@/Components/forms/InputError";
import InputLabel from "@/Components/forms/InputLabel";
import TextInput from "@/Components/forms/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function ProductForm({ product, title, method }) {
    const form = useForm(product);
    const [tab, setTab] = useState('content');

    const changeTab = (newtab) => {
        setTab(newtab);
    }

    const onHandleChange = (event) => {
        form.setData(event.target.name, event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();
        if (method == 'store') {
            form.post(route('product.store', { 'product': product.id }), {
                preserveScroll: false,
                onFinish: () => { },
                onSuccess: (res) => {
                    form.reset()
                },
            });
        }
        if (method == 'update') {
            form.patch(route('product.update', { 'product': product.id }), {
                preserveScroll: false,
                onFinish: () => { },
            });
        }
    }

    return (
        <AuthenticatedLayout>
            <Head title={title} />
            <div className="px-4">
                <form className="flex flex-col lg:flex-row mt-4 gap-5" onSubmit={submit}>
                    <div className="w-full">
                        <div className="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded" >
                            <div className="block w-full overflow-x-auto">
                                <div className="rounded-t mb-5 px-5 border-1">
                                    <div className="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-blueGray-300">
                                        <ul className="flex flex-wrap -mb-px">
                                            <li className="mr-2">
                                                <button type="button" onClick={() => changeTab('content')} className={`inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600 ${tab == 'content' ? 'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : ''}`}
                                                    aria-current="product">Content</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div className={`w-full overflow-x-auto px-7 ${tab != 'content' ? 'hidden' : 'block'}`}>
                                    <div className="block">
                                        <InputLabel htmlFor="title" value="Title" />
                                        <TextInput type="text" className="mt-1 block w-full" name="title" value={form.data.title || ''} onChange={e => onHandleChange(e)} />
                                        <InputError className="mt-2" message={form.errors.title} />
                                    </div>

                                    <div className="block mt-4">
                                        <InputLabel htmlFor="price" value="Price" />
                                        <TextInput type="text" className="mt-1 block w-full" name="price" value={form.data.price || ''} onChange={e => onHandleChange(e)} />
                                        <InputError className="mt-2 " message={form.errors.price} />
                                    </div>
                                    <div className="block mt-4">
                                        <InputLabel htmlFor="discount" value="Discount" />
                                        <TextInput type="text" className="mt-1 block w-full" name="discount" value={form.data.discount || ''} onChange={e => onHandleChange(e)} />
                                        <InputError className="mt-2 " message={form.errors.discount} />
                                    </div>
                                    <div className="block mt-4">
                                        <InputLabel htmlFor="stock" value="Stock" />
                                        <TextInput type="text" className="mt-1 block w-full" name="stock" value={form.data.stock || ''} onChange={e => onHandleChange(e)} />
                                        <InputError className="mt-2 " message={form.errors.stock} />
                                    </div>
                                </div>
                            </div>
                            <div className="mt-10">
                                <PrimaryButton type="submit" className={`w-full block text-center py-3 px-3 justify-center rounded-none rounded-b-md ${form.processing ? 'opacity-25' : ''}`} disabled={form.processing}>
                                    Save
                                </PrimaryButton>
                            </div>
                        </div>
                    </div >
                </form >
            </div >
        </AuthenticatedLayout >
    );
}
