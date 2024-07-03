import { Link } from "@inertiajs/react"

export default function Pagination({ links }) {
    return links.length > 3 && (
        <div className="px-4 py-4">
            <div className="flex items-center flex-wrap -mb-1">
                {links.map((link, index) => {
                    return (
                        <div key={index}>
                            {link.url === null ? <div className="mr-1 mb-1 px-3 py-2 text-sm leading-4 text-gray-400 border rounded" dangerouslySetInnerHTML={{ __html: link.label }} /> : <Link
                                className={`mr-1 mb-1 px-3 py-2 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500 ${link.active ? 'bg-blue-700 text-white hover:text-black' : ''}`}
                                href={link.url} dangerouslySetInnerHTML={{ __html: link.label }} />}
                        </div>
                    )
                })}
            </div>
        </div>
    )
}