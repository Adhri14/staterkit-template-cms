import ComponentsProvider from '@/Admin/Components';
import GuestLayout from '@/Admin/Layouts/GuestLayout';
import { Head, useForm } from '@inertiajs/react';
import { useEffect } from 'react';

export default function ResetPassword({ token, email }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('password.store'));
    };

    return (
        <GuestLayout>
            <Head title="Reset Password" />

            <form onSubmit={submit}>
                <div>
                    <ComponentsProvider.InputLabel htmlFor="email" value="Email" />

                    <ComponentsProvider.TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                    />

                    <ComponentsProvider.InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <ComponentsProvider.InputLabel htmlFor="password" value="Password" />

                    <ComponentsProvider.TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        isFocused={true}
                        onChange={(e) => setData('password', e.target.value)}
                    />

                    <ComponentsProvider.InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <ComponentsProvider.InputLabel htmlFor="password_confirmation" value="Confirm Password" />

                    <ComponentsProvider.TextInput
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                    />

                    <ComponentsProvider.InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <ComponentsProvider.PrimaryButton className="ms-4" disabled={processing}>
                        Reset Password
                    </ComponentsProvider.PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
