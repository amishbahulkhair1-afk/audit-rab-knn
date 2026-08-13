@extends('layouts.user')

@section('content')
    <div class="space-y-8">


        {{-- =========================================================
        PROFILE HEADER
    ========================================================== --}}

        <div class="bg-gradient-to-r from-emerald-700 to-emerald-500 
                rounded-3xl p-8 text-white shadow-lg">


            <div
                class="flex flex-col md:flex-row 
                    items-center md:items-start 
                    gap-6">


                {{-- Avatar --}}

                <div
                    class="w-24 h-24 rounded-3xl 
                        bg-white/20 backdrop-blur-md
                        flex items-center justify-center
                        text-4xl font-bold shadow">


                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}


                </div>



                {{-- User Information --}}

                <div class="text-center md:text-left">


                    <span
                        class="inline-block
                             bg-white/20 
                             px-3 py-1 
                             rounded-full
                             text-xs font-semibold
                             mb-3">


                        {{ Auth::user()->role == 'pengurus_pu' ? 'Pengurus PU' : 'Administrator' }}


                    </span>



                    <h1 class="text-3xl font-bold">

                        {{ Auth::user()->name }}

                    </h1>


                    <p class="text-emerald-50 mt-2">

                        {{ Auth::user()->email }}

                    </p>


                    <p class="text-sm text-emerald-100 mt-3">

                        Kelola informasi akun dan keamanan
                        sistem Anda.

                    </p>


                </div>


            </div>


        </div>





        {{-- =========================================================
        PROFILE INFORMATION
    ========================================================== --}}


        <div class="bg-white rounded-2xl 
                border border-slate-100
                shadow-sm overflow-hidden">




            <div class="p-8">


                @include('profile.partials.update-profile-information-form')


            </div>


        </div>





        {{-- =========================================================
        PASSWORD
    ========================================================== --}}


        <div class="bg-white rounded-2xl
                border border-slate-100
                shadow-sm overflow-hidden">
            <div class="p-8">


                @include('profile.partials.update-password-form')


            </div>


        </div>




        {{-- =========================================================
        DELETE ACCOUNT (OPTIONAL)
    ========================================================== --}}

        @if (Auth::user()->role == 'admin')
            <div
                class="bg-white rounded-2xl
                border border-red-100
                shadow-sm overflow-hidden">


                <div class="p-6 border-b border-red-100">


                </div>



                <div class="p-8">

                    @include('profile.partials.delete-user-form')

                </div>


            </div>
        @endif



    </div>
@endsection
