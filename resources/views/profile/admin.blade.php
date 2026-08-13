<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-slate-900">
                Pengaturan Profil
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Kelola informasi akun, keamanan, dan preferensi pengguna.
            </p>
        </div>
    </x-slot>



    <div class="py-10 bg-slate-50 min-h-screen">


        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">



            <!-- PROFILE HEADER CARD -->

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">


                <div class="flex items-center gap-5">


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

                @include('profile.partials.update-profile-information-form')

            </div>








            <!-- PASSWORD -->


            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">

                @include('profile.partials.update-password-form')

            </div>









            <!-- DELETE ACCOUNT -->


            <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-8">

                @include('profile.partials.delete-user-form')


            </div>






        </div>


    </div>


</x-app-layout>
