<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    @fonts

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            @layer properties {
                ...
            }
        </style>
    @endif
</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- KOLOM KIRI: Bagian Gambar & Branding (Hanya tampil di layar besar/PC) -->
        <div class="relative hidden lg:flex flex-col justify-between bg-slate-900 p-10 text-white overflow-hidden">
            <!-- Gambar Latar Belakang dengan efek gelap (Overlay) -->
            <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay"
                style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1920&auto=format&fit=crop');">
            </div>

            <!-- Efek gradasi tambahan agar teks lebih kontras -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>

            <!-- Logo / Judul Atas -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-xl">A</span>
                </div>
                <span class="font-bold text-lg tracking-tight">LateeBuildIt</span>
            </div>

            <!-- Teks Sambutan di Tengah/Bawah Kolom Kiri -->
            <div class="relative z-10 max-w-lg mb-6">
                <span
                    class="inline-block px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">
                    Platform Profesional
                </span>
                <h1 class="text-4xl font-extxl bold tracking-tight leading-tight mb-4">
                    Kelola Audit & RAB Konstruksi Lebih Efisien.
                </h1>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Sistem terintegrasi untuk memudahkan pengelolaan data audit, analisis harga satuan, dan penyusunan
                    Rencana Anggaran Biaya bangunan Pondok Pesantren Annuqayah Latee secara akurat.
                </p>
            </div>

            <!-- Footer Kecil di Kolom Kiri -->
            <div class="relative z-10 text-xs text-slate-400">
                &copy; {{ date('Y') }} Sistem Audit Bangunan. All rights reserved.
            </div>
        </div>

        <!-- KOLOM KANAN: Form Login -->
        <div class="flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-24 bg-white">

            <!-- Header khusus untuk tampilan Mobile / HP (karena kolom kiri disembunyikan) -->
            <div class="flex items-center gap-3 mb-8 lg:hidden">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-xl">A</span>
                </div>
                <span class="font-bold text-lg text-slate-900">Sistem Audit Bangunan</span>
            </div>

            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Silakan masukkan kredensial akun Anda untuk mengakses sistem.
                    </p>
                </div>

                <!-- Notifikasi Status / Pesan Error -->
                @if (session('status'))
                    <div
                        class="mt-4 p-3 bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-600 rounded-lg text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mt-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Input Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-900">Email</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
                                    class="block w-full rounded-lg bg-slate-50 px-3.5 py-2.5 text-base text-slate-900 border border-slate-300 placeholder:text-slate-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm">
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium text-slate-900">Password</label>
                                @if (Route::has('password.request'))
                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}"
                                            class="font-semibold text-emerald-600 hover:text-emerald-500">Lupa
                                            password?</a>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full rounded-lg bg-slate-50 px-3.5 py-2.5 text-base text-slate-900 border border-slate-300 placeholder:text-slate-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm">
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
@enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <input id="remember_me" name="remember" type="checkbox"
                                           class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600">
                                    <label for="remember_me" class="block text-sm text-slate-900">Ingat saya</label>
                                </div>
                            </div>

                            <!-- Tombol Login -->
                            <div>
                                <button type="submit"
                                        class="flex w-full justify-center rounded-lg bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition">
                                    Masuk ke Sistem
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </body>
</html>
