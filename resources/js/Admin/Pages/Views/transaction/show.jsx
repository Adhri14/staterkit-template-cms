import { Head } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function TransactionShow({ transaction, title }) {
    const calculate = (val1, val2) => {
        return Number(val1) * Number(val2);
    }

    let IDR = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });

    return (
        <AuthenticatedLayout>
            <Head title="Dashboard" />
            <div className="flex flex-wrap mt-4">
                <div className="w-full mb-12 px-4">
                    <div className="relative flex flex-col min-w-0 break-words lg:w-6/12 w-full mb-6 shadow-lg rounded bg-white">
                        <div className="rounded-t mb-0 px-6 py-4 border-0">
                            <div className="flex flex-wrap items-center">
                                <div className="relative w-full max-w-full flex">
                                    <div className="flex justify-between w-full">
                                        <h3 className="font-bold text-lg">
                                            {title}
                                        </h3>
                                        <p>Type : <span className="uppercase py-1 px-3 font-semibold text-white ml-4 bg-green-500 rounded-full text-xs">{transaction.type_transaction}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="flex">
                            <div className="bg-white overflow-hidden mb-8 w-full">
                                <div className="px-3">
                                    <div className="w-full px-4">
                                        <div className="bg-white w-full h-full">
                                            <div className="border-t border-gray-200"></div>
                                            {transaction?.transaction_detail?.length > 0 && transaction?.transaction_detail?.map((item, index) => (
                                                <div className="mb-2 grid grid-cols-8 mt-5" key={index}>
                                                    <p className="col-span-3 lg:text-base text-sm">{item.title}</p>
                                                    <p className="col-span-1 text-center lg:text-base text-sm">x{item.qty}</p>
                                                    <p className="col-span-2 text-right lg:text-base text-sm"><span className={item.discount ? 'line-through text-gray-500' : ''}>{IDR.format(item.price)}</span> <span v-if="item.discount" className="font-bold">{IDR.format(item.discount)}</span></p>
                                                    <p className="col-span-2 text-right lg:text-base text-sm">{IDR.format(calculate(item.discount || item.price, item.qty))}</p>
                                                </div>
                                            ))}
                                            <div className="border-t border-gray-200 mt-5"></div>
                                            <div className="mb-2 grid grid-cols-6 mt-10">
                                                <div className="col-span-2"></div>
                                                <h3 className="font-bold uppercase col-span-1 text-right">Subtotal</h3>
                                                <p className="col-span-3 text-right">{IDR.format(transaction.grand_total)}</p>
                                            </div>
                                            <div className="mb-2 grid grid-cols-6 mt-10">
                                                <div className="col-span-2"></div>
                                                <h3 className="font-bold uppercase col-span-1 text-right">Total</h3>
                                                <p className="col-span-3 text-right">{IDR.format(transaction.grand_total)}</p>
                                            </div>
                                            <div className="mb-2 grid grid-cols-6 mt-10">
                                                <div className="col-span-2"></div>
                                                <h3 className="font-bold uppercase col-span-1 text-right">Bayar</h3>
                                                <p className="col-span-3 text-right">{IDR.format(transaction.cash)}</p>
                                            </div>
                                            <div className="mb-2 grid grid-cols-6 mt-10">
                                                <div className="col-span-2"></div>
                                                <h3 className="font-bold uppercase col-span-1 text-right">Kembali</h3>
                                                <p className="col-span-3 text-right">{IDR.format(transaction.refund)}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div >
        </AuthenticatedLayout >
    );
}