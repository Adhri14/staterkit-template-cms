import { Link, usePage } from "@inertiajs/react"
import ApplicationLogo from "../ApplicationLogo";
import { useState } from "react";
import { FaBars } from "react-icons/fa6";
import { FaQuestionCircle, FaTimes } from "react-icons/fa";
import { icons } from "@/Utils/icons";
import ComponentsProvider from "..";
// import { icons } from "@/Utils/icon";

export default function Sidebar() {
    const [menuShow, setMenuShow] = useState('block');
    const [collapseShow, setCollapseShow] = useState('hidden');
    const { current_path, navigation: menus } = usePage().props;

    const toggleCollapseShow = (classes, menu) => {
        setCollapseShow(classes);
        setMenuShow(menu);
    }

    return (
        <>
            <nav
                className="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-md bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10"
            >
                <div
                    className="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
                >
                    {/* <!-- Toggler --> */}
                    <button
                        className={`cursor-pointer text-primary md:hidden px-3 py-1 text-2xl leading-none bg-transparent rounded border border-solid border-transparent ${menuShow}`}
                        type="button"
                        onClick={() => toggleCollapseShow('bg-white top-16', 'hidden')}
                    >
                        <FaBars />
                    </button>
                    <button
                        className={`cursor-pointer text-primary md:hidden px-3 py-1 text-2xl leading-none bg-transparent rounded border border-solid border-transparent ${collapseShow}`}
                        type="button"
                        onClick={() => toggleCollapseShow('hidden', 'block')}
                    >
                        <FaTimes />
                    </button>
                    {/* <!-- Brand --> */}
                    <Link
                        className="text-left h-[64px] bg-black flex items-center  text-blueGray-600 py-2 mr-0  whitespace-nowrap text-sm uppercase font-bold  px-0"
                        href={menus.link}
                    >
                        <ComponentsProvider.ApplicationLogo className="max-h-12 mx-auto fill-red-500"></ComponentsProvider.ApplicationLogo>
                    </Link>
                    {/* <!-- User --> */}
                    <ul className="md:hidden items-center flex flex-wrap list-none">
                        <li className="inline-block relative">
                            <a href="" className="mr-5">
                                <FaQuestionCircle />
                            </a>
                        </li>
                    </ul>
                    {/* <!-- Collapse --> */}
                    <div
                        className={`${collapseShow} md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1`}
                    >
                        {/* <!-- Collapse header --> */}
                        {/* <!-- Divider --> */}
                        {menus?.sections?.map((section, index) => (
                            <div key={index}
                            >
                                {section.title && (
                                    <h6 className="md:min-w-full text-blueGray-500 text-sm font-semibold block py-4 px-6 no-underline">
                                        {section.title}
                                    </h6>
                                )}
                                <ul className={`md:flex-col md:min-w-full flex flex-col list-none ${section.class}`}>
                                    {section?.menus?.map((item, index1) => {
                                        const IconComponent = icons[item?.icon];
                                        return (
                                            <li className="items-center" key={index1}>
                                                {item?.submenu?.length > 0 ? (
                                                    <>
                                                        <span className="text-blueGray-700 hover:text-blueGray-500 text-sm py-3  block">
                                                            <IconComponent className="text-[#777] mr-2 text-sm" />
                                                            {item.title}
                                                        </span>
                                                        <ul className="md:flex-col md:min-w-full flex flex-col list-none md:mb-4 pl-4">
                                                            {item?.submenu?.map((submenu, index2) => (
                                                                <li className="items-center" key={index2}>
                                                                    <Link
                                                                        className="text-[#777] hover:text-blueGray-500 text-sm py-3 block"
                                                                        href={submenu?.link}
                                                                        method={submenu?.method}
                                                                    >
                                                                        <IconComponent className="text-[#777] mr-2 text-sm" />
                                                                        {submenu?.title}
                                                                    </Link>
                                                                </li>
                                                            ))}
                                                        </ul>
                                                    </>
                                                ) : (
                                                    <Link
                                                        className={`text-blueGray-700 w-full text-left hover:text-blueGray-500 text-sm py-4  px-6 hover:bg-gray-100 hover:border-l-2 hover:border-primary flex items-center duration-150 transition-all ${current_path === item?.link ? 'bg-gray-100 border-l-2 border-primary flex space-x-2' : ''} ${item?.class || ''}`}
                                                        href={item?.link}
                                                        method={item?.method}
                                                        as={item?.as}
                                                    >
                                                        <IconComponent size={14} className="text-[#777] mr-2 text-sm" />
                                                        {item.title}
                                                    </Link>
                                                )}
                                            </li>
                                        );
                                    })}
                                </ul>
                                <hr className="md:min-w-full" />
                            </div>
                        ))}
                    </div>
                </div>
            </nav>
        </>
    );
}