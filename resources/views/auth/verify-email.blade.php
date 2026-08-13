<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - Verifikasi Email</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- ===================================
         LEFT BRANDING
    ==================================== -->

        <div class="relative hidden lg:flex flex-col justify-between bg-slate-900 p-10 text-white overflow-hidden">

            <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay"
                style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1920&auto=format&fit=crop');">
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>

            <!-- Logo -->

            <div class="relative z-10 flex items-center gap-3">

                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg">

                    <span class="text-white font-bold text-xl">

                        A

                    </span>

                </div>

                <span class="font-bold text-lg tracking-tight">

                    LateeBuildIt

                </span>

            </div>

            <!-- Description -->

            <div class="relative z-10 max-w-lg mb-6">

                <span
                    class="inline-block px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">

                    Verifikasi Akun

                </span>

                <h1 class="text-4xl font-bold tracking-tight leading-tight mb-4">

                    Lindungi Data Sistem Anda.

                </h1>

                <p class="text-slate-300 text-sm leading-relaxed">

                    Verifikasi email untuk memastikan keamanan akun sebelum menggunakan fitur audit bangunan dan
                    pengelolaan RAB.

                </p>

            </div>

            <div class="relative z-10 text-xs text-slate-400">

                &copy; {{ date('Y') }} Sistem Audit Bangunan. All rights reserved.

            </div>

        </div>

        <!-- ===================================
         RIGHT FORM
    ==================================== -->

        <div class="flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-24 bg-white">

            <!-- Mobile Logo -->

            <div class="flex items-center gap-3 mb-8 lg:hidden">

                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-md">

                    <span class="text-white font-bold text-xl">

                        A

                    </span>

                </div>

                <span class="font-bold text-lg text-slate-900">

                    Sistem Audit Bangunan

                </span>

            </div>

            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div>

                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">

                        Verifikasi Email

                    </h2>

                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">

                        Terima kasih telah membuat akun. Silakan cek email Anda dan klik link verifikasi yang telah kami
                        kirim.

                    </p>

                </div>

                <!-- Status -->

                @if (session('status') == 'verification-link-sent')
                    <div
                        class="mt-5 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-700">

                        Link verifikasi baru telah dikirim ke email Anda.

                    </div>
                @endif

                <div class="mt-8 space-y-4">

                    <!-- Resend Email -->

                    <form method="POST" action="{{ route('verification.send') }}">

                        @csrf

                        <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus:outline-2 focus:outline-emerald-600 transition">

                            Kirim Ulang Email Verifikasi

                        </button>

                    </form>

                    <!-- Logout -->

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                            class="flex w-full justify-center rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">

                            Keluar dari Akun

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
