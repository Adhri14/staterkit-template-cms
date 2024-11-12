import { usePage } from "@inertiajs/react";

export default function Footer() {
    const { env } = usePage().props;
    const date = new Date().getFullYear();
    return (
        <footer className="block py-4 mt-auto">
            <div className="container mx-auto px-4">
                <hr className="mb-4 border-b-1 border-blueGray-200" />
                <div
                    className="flex flex-wrap items-center md:justify-between justify-center"
                >
                    <div className="w-full md:w-4/12 px-4">
                        <div
                            className="text-xs text-blueGray-500  py-1 text-center md:text-left"
                        >
                            Copyright {env.app_name} © {date}
                            <a
                                href="https://www.creative-tim.com?ref=vn-footer-admin"
                                className="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1"
                            >
                                {/* <!-- NowLab Team --> */}
                            </a>
                        </div>
                    </div>
                    <div className="w-full md:w-8/12 px-4">
                        {/* <!-- <ul className="flex flex-wrap list-none md:justify-end justify-center">
                            <li>
                                <a
                                    href="https://github.com/creativetimofficial/vue-notus/blob/main/LICENSE.md?ref=vn-footer-admin"
                                    className="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                                >
                                    MIT License
                                </a>
                            </li>
                        </ul> --> */}
                    </div>
                </div>
            </div>
        </footer>
    )
}