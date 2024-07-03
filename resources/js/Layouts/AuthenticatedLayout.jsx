import Footer from '@/Components/footer/Footer';
import Navbar from '@/Components/navbar/Navbar';
import Sidebar from '@/Components/sidebar/Sidebar';

export default function Authenticated({ children }) {
    // const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

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
