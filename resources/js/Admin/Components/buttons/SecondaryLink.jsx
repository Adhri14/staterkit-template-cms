import { Link } from "@inertiajs/react";
import { Tooltip } from "react-tooltip";

export default function SecondaryLink({ children, className = '', tooltip = 'Link', ...props }) {
    return (
        <>
            <Link
                data-tooltip-id={tooltip}
                data-tooltip-content={tooltip}
                className={`${className} inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150`}
                {...props}
            >
                {children}
            </Link>
            <Tooltip id={tooltip} style={{ backgroundColor: 'black', color: 'white', fontSize: '12px', borderRadius: '5px', padding: '5px 20px', boxShadow: '0 1px 2px 0 rgb(0 0 0 / 0.05)', fontFamily: 'Poppins' }} />
        </>
    )
}