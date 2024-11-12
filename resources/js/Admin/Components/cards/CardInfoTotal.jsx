import { Link } from "@inertiajs/react";

export default function CardInfoTotal({ title, children, total, href = '/', color = '', hoverColor = '' }) {
    return (
        <div className="flex-shrink max-w-full px-4 w-full sm:w-1/2 lg:w-1/4 mb-6">
            <div className="bg-white rounded-lg shadow-lg h-full">
                <div className="pt-6 px-6 relative text-sm font-semibold">
                    {title}
                </div>
                <div className="flex flex-row justify-between px-6 py-4">
                    <div className={`self-center w-14 h-14 rounded-full relative text-center ${color}`}>
                        {children}
                    </div>
                    <h2 className="self-center text-3xl">{total}</h2>
                </div>
                <div className="px-6 pb-6">
                    <Link className={`text-sm ${hoverColor}`} href={href}>View more...</Link>
                </div>
            </div >
        </div >
    );
}