@extends('layouts.user')

@section('content')
    <div class="py-10 bg-slate-50 min-h-screen">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">


            <!-- HEADER PROFIL -->

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">


                <div class="flex items-center gap-5">


                    <!-- Avatar -->

                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center">


                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.29.53 6.121 1.47M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                        </svg>


                    </div>



                    <div>

                        <h1 class="text-xl font-bold text-slate-900">

                            {{ auth()->user()->name }}

                        </h1>


                        <p class="text-sm text-slate-500">

                            {{ auth()->user()->email }}

                        </p>



                        <span
                            class="inline-flex mt-2 px-3 py-1 rounded-full 
                        text-xs font-semibold 
                        bg-emerald-50 text-emerald-700">


                            {{ ucfirst(auth()->user()->role) }}


                        </span>


                    </div>


                </div>


            </div>






            <!-- INFORMASI PROFIL -->

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">


                <div class="flex items-center gap-3 mb-6">


                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">


                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">


                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />


                        </svg>


                    </div>



                    <div>

                        <h3 class="font-bold text-slate-900">

                            Informasi Pribadi

                        </h3>


                        <p class="text-xs text-slate-500">

                            Perbarui nama dan alamat email akun.

                        </p>


                    </div>


                </div>



                @include('profile.partials.update-profile-information-form')


            </div>







            <!-- PASSWORD -->

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">


                <div class="flex items-center gap-3 mb-6">


                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">


                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">


                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c0-1.657-1.343-3-3-3S6 9.343 6 11v2h12v-2c0-1.657-1.343-3-3-3s-3 1.343-3 3z" />


                        </svg>


                    </div>



                    <div>

                        <h3 class="font-bold text-slate-900">

                            Keamanan Akun

                        </h3>


                        <p class="text-xs text-slate-500">

                            Ubah password untuk menjaga keamanan akun.

                        </p>


                    </div>


                </div>



                @include('profile.partials.update-password-form')


            </div>



        </div>


    </div>
@endsection
