import Footer from '@/Components/footer/Footer';
import Navbar from '@/Components/navbar/Navbar';
import Sidebar from '@/Components/sidebar/Sidebar';
import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';
import Toastify from "toastify-js";

export default function Authenticated({ children }) {
    // const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    const { flash } = usePage().props;

    useEffect(() => {
        if (flash.has_flash) {
            Toastify({
                text: flash.message,
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function () { } // Callback after click
            }).showToast();
        }
    }, [flash.has_flash]);

    return (
        <div className="min-h-screen">
            <Sidebar />

            <div className="relative md:ml-64 min-h-screen flex flex-col">
                <Navbar />
                <main className="mx-auto w-full">{children}</main>
                <Footer />
            </div>
        </div>
    );
}
