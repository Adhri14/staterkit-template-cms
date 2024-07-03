import { usePage } from "@inertiajs/react";

export default function Navbar() {
    const { title = '', breadcumb } = usePage();
    return (
        <>
            <nav
                className=" top-0 left-0 bg-white h-[64px] w-full md:flex-row md:flex-nowrap md:justify-start flex items-center p-4 shadow-md relative z-10"
            >
                <div
                    className="w-full  md:px-2 px-4"
                >
                    <a
                        className="text-sm capitalize lg:inline-block font-semibold"
                        href="/dashboard"
                    >
                        {title || 'Dashboard'}
                    </a>
                </div>
            </nav>
            {breadcumb && (
                <nav
                    className="top-20 left-0 w-full md:flex-row md:flex-nowrap md:justify-start flex items-center p-4 pb-0"
                >
                    <div
                        className="w-full mx-autp items-center flex  md:flex-nowrap flex-wrap md:px-4 px-4 "
                    >
                        {Array.isArray(breadcumb) && [...breadcumb].map((data, index) => (
                            <div key={index}>
                                <a className="text-sm lg:inline-block opacity-50 hover:opacity-100" href={data.url}>
                                    {data.text}
                                </a>
                                {index != Object.keys($page.props.breadcumb).length - 1 && (
                                    <span className="text-sm  hidden lg:inline-block px-2 opacity-50"></span>
                                )}
                            </div>
                        ))}
                    </div >
                </nav >
            )}
        </>
    );
}