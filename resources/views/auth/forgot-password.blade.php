<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - Lupa Password</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

</head>


<body class="h-full bg-slate-50 text-slate-800 antialiased">


<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">


    <!-- ===========================
         KOLOM KIRI BRANDING
    ============================ -->

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




        <!-- Deskripsi -->

        <div class="relative z-10 max-w-lg mb-6">


            <span class="inline-block px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">

                Keamanan Akun

            </span>


            <h1 class="text-4xl font-bold tracking-tight leading-tight mb-4">

                Pulihkan Akses Akun Anda Dengan Aman.

            </h1>


            <p class="text-slate-300 text-sm leading-relaxed">

                Gunakan email terdaftar untuk mendapatkan tautan reset password dan kembali mengakses Sistem Audit Bangunan.

            </p>


        </div>



        <div class="relative z-10 text-xs text-slate-400">

            &copy; {{ date('Y') }} Sistem Audit Bangunan. All rights reserved.

        </div>


    </div>





    <!-- ===========================
         KOLOM FORM
    ============================ -->


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

                    Lupa Password?

                </h2>


                <p class="mt-2 text-sm text-slate-600 leading-relaxed">

                    Masukkan alamat email Anda. Kami akan mengirimkan tautan untuk membuat password baru.

                </p>


            </div>




            <!-- Status -->

            @if(session('status'))

                <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-600 rounded-lg text-center">

                    {{ session('status') }}

                </div>

            @endif





            <div class="mt-8">


                <form method="POST"
                      action="{{ route('password.email') }}"
                      class="space-y-5">

                    @csrf




                    <!-- Email -->


                    <div>


                        <label for="email"
                               class="block text-sm font-medium text-slate-900">

                            Email

                        </label>


                        <div class="mt-2">

                            <input

                                id="email"

                                name="email"

                                type="email"

                                autocomplete="email"

                                required

                                autofocus

                                value="{{ old('email') }}"

                                placeholder="nama@email.com"

                                class="block w-full rounded-lg bg-slate-50 px-3.5 py-2.5 text-base text-slate-900 border border-slate-300 placeholder:text-slate-400 focus:bg-white focus:outline-2 focus:outline-emerald-600 sm:text-sm"

                            >

                        </div>



                        @error('email')

                            <p class="mt-1.5 text-sm text-red-600">

                                {{ $message }}

                            </p>

                        @enderror


                    </div>





                    <!-- Button -->


                    <div>


                        <button type="submit"

                            class="flex w-full justify-center rounded-lg bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus:outline-2 focus:outline-emerald-600 transition">


                            Kirim Link Reset Password


                        </button>


                    </div>




                </form>



                <!-- Back Login -->


                <div class="mt-6 text-center">


                    <a href="{{ route('login') }}"

                       class="text-sm font-semibold text-emerald-600 hover:text-emerald-500">


                        ← Kembali ke halaman login


                    </a>


                </div>




            </div>


        </div>


    </div>



</div>


</body>

</html>