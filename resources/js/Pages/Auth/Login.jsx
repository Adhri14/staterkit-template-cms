import { useEffect } from 'react';
import Checkbox from '@/Components/forms/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/forms/InputError';
import InputLabel from '@/Components/forms/InputLabel';
import PrimaryButton from '@/Components/buttons/PrimaryButton';
import TextInput from '@/Components/forms/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import Header from '@/Components/Header';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    return (
        <>
            <Head title="Log in" />

            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                <img
                    id="background"
                    className="absolute -left-20 top-0 max-w-[877px]"
                    src="https://laravel.com/assets/img/welcome/background.svg"
                />
                <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                    <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <main className="mt-6">
                            <div className="grid gap-6 lg:grid-cols-2">
                                <div
                                    className="flex flex-col gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                                >
                                    <Header />
                                    <form onSubmit={submit}>
                                        <div>
                                            <InputLabel htmlFor="email" value="Email" />

                                            <TextInput
                                                id="email"
                                                type="email"
                                                name="email"
                                                value={data.email}
                                                className="mt-1 block w-full"
                                                autoComplete="username"
                                                isFocused={true}
                                                onChange={(e) => setData('email', e.target.value)}
                                            />

                                            <InputError message={errors.email} className="mt-2" />
                                        </div>

                                        <div className="mt-4">
                                            <InputLabel htmlFor="password" value="Password" />

                                            <TextInput
                                                id="password"
                                                type="password"
                                                name="password"
                                                value={data.password}
                                                className="mt-1 block w-full"
                                                autoComplete="current-password"
                                                onChange={(e) => setData('password', e.target.value)}
                                            />

                                            <InputError message={errors.password} className="mt-2" />
                                        </div>

                                        <div className="flex justify-between mt-4">
                                            <label className="flex items-center">
                                                <Checkbox
                                                    name="remember"
                                                    checked={data.remember}
                                                    onChange={(e) => setData('remember', e.target.checked)}
                                                />
                                                <span className="ms-2 text-sm text-gray-600">Remember me</span>
                                            </label>
                                            {canResetPassword && (
                                                <Link
                                                    href={route('password.request')}
                                                    className="underline text-sm text-gray-600 hover:text-[#FF2D20] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                >
                                                    Forgot your password?
                                                </Link>
                                            )}
                                        </div>

                                        <div className="flex items-center justify-end mt-10">
                                            <Link
                                                href={route('register')}
                                                className="underline text-sm text-gray-600 hover:text-[#FF2D20] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >
                                                Do you have an account?
                                            </Link>

                                            <PrimaryButton className="ms-4" disabled={processing}>
                                                Log in
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </>
    );
}
