export default function Td({ value, children }) {
    return (
        <td className="px-6 align-middle  lg:border-solid py-3 text-sm  border-b-0 lg:border-b whitespace-nowrap text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100 block border-0 lg:table-cell">
            {value ? (
                <span >{{ value }}</span>
            ) : (
                <span>{children}</span>
            )}
        </td>
    )
}