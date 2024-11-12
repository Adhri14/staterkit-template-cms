// Buttons
import {
    DangerButton,
    Pagination,
    PrimaryButton,
    SecondaryButton,
    SecondaryLink
} from "@/Admin/Components/buttons";

// Cards
import { CardInfoTotal } from "@/Admin/Components/cards";

// Dropdown
import { Dropdown } from "@/Admin/Components/dropdowns";

// Footer
import { Footer } from "@/Admin/Components/footer";
import { createContext } from "react";

// Form
import { InputLabel, InputError, TextInput, Checkbox } from "@/Admin/Components/forms"

// Navbar
import { Navbar, NavLink, ResponsiveNavLink } from "@/Admin/Components/navbar"

// Sidebar
import { Sidebar } from "@/Admin/Components/sidebar"

// Tables
import { Td, Th } from "./tables";

// Logo
import ApplicationLogo from "./ApplicationLogo";

// Header
import Header from "./Header";

// Modal
import Modal from "./Modal";

const ComponentsContext = createContext();

const ComponentsProvider = ({ children }) => {
    return (
        <ComponentsContext.Provider value={{}}>
            {children}
        </ComponentsContext.Provider>
    )
}

ComponentsProvider.DangerButton = DangerButton;
ComponentsProvider.PrimaryButton = PrimaryButton;
ComponentsProvider.Pagination = Pagination;
ComponentsProvider.SecondaryButton = SecondaryButton;
ComponentsProvider.SecondaryLink = SecondaryLink;
ComponentsProvider.CardInfoTotal = CardInfoTotal;
ComponentsProvider.Dropdown = Dropdown;
ComponentsProvider.Footer = Footer;
ComponentsProvider.InputLabel = InputLabel;
ComponentsProvider.InputError = InputError;
ComponentsProvider.TextInput = TextInput;
ComponentsProvider.Checkbox = Checkbox;
ComponentsProvider.Navbar = Navbar;
ComponentsProvider.NavLink = NavLink;
ComponentsProvider.ResponsiveNavLink = ResponsiveNavLink;
ComponentsProvider.Sidebar = Sidebar;
ComponentsProvider.Td = Td;
ComponentsProvider.Th = Th;
ComponentsProvider.ApplicationLogo = ApplicationLogo;
ComponentsProvider.Header = Header;
ComponentsProvider.Modal = Modal;

export default ComponentsProvider;