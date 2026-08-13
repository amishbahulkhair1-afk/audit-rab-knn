<section class="space-y-6">


    {{-- HEADER --}}

    <header>


        <div class="flex items-center gap-3 mb-4">


            <div
                class="w-10 h-10 rounded-xl
                        bg-blue-50
                        flex items-center justify-center
                        text-blue-600">

                👤

            </div>



            <div>


                <h2 class="text-lg font-bold text-slate-900">

                    {{ __('Informasi Profil') }}

                </h2>


                <p class="text-sm text-slate-500">

                    {{ __('Kelola informasi dasar akun Anda.') }}

                </p>


            </div>


        </div>




        <p class="text-sm text-slate-600 leading-relaxed max-w-2xl">

            {{ __('Perbarui nama dan alamat email yang digunakan untuk mengakses Sistem Audit Bangunan.') }}

        </p>


    </header>







    {{-- EMAIL VERIFICATION FORM --}}

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">

        @csrf

    </form>







    {{-- UPDATE PROFILE FORM --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">

        @csrf
        @method('patch')





        {{-- NAME --}}

        <div>


            <label for="name"
                class="
                block
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-slate-500
                mb-2
                ">

                Nama Lengkap

            </label>




            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                autofocus autocomplete="name"
                class="
                block w-full

                rounded-xl

                bg-slate-50

                border border-slate-300

                px-4 py-3

                text-slate-900

                focus:bg-white

                focus:outline-none

                focus:ring-2

                focus:ring-emerald-500

                focus:border-emerald-500
                ">



            <x-input-error class="mt-2" :messages="$errors->get('name')" />


        </div>







        {{-- EMAIL --}}

        <div>


            <label for="email"
                class="
                block
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-slate-500
                mb-2
                ">

                Alamat Email

            </label>




            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                class="
                block w-full

                rounded-xl

                bg-slate-50

                border border-slate-300

                px-4 py-3

                text-slate-900

                focus:bg-white

                focus:outline-none

                focus:ring-2

                focus:ring-emerald-500

                focus:border-emerald-500
                ">



            <x-input-error class="mt-2" :messages="$errors->get('email')" />







            {{-- EMAIL VERIFICATION ALERT --}}

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())


                <div
                    class="
                    mt-5
                    p-5

                    rounded-2xl

                    bg-amber-50

                    border border-amber-200
                ">


                    <div class="flex gap-3">


                        <div
                            class="
                            w-8 h-8
                            rounded-xl
                            bg-amber-100
                            flex items-center justify-center
                        ">

                            ⚠️

                        </div>



                        <div>


                            <p class="text-sm text-amber-800 leading-relaxed">


                                {{ __('Alamat email Anda belum diverifikasi.') }}



                                <button form="send-verification"
                                    class="
                                    block
                                    mt-2

                                    text-amber-900

                                    font-bold

                                    underline

                                    hover:text-amber-700
                                    ">

                                    {{ __('Kirim ulang email verifikasi') }}

                                </button>


                            </p>






                            @if (session('status') === 'verification-link-sent')
                                <p
                                    class="
                                    mt-3

                                    text-sm

                                    font-medium

                                    text-emerald-600
                                ">


                                    ✓

                                    {{ __('Link verifikasi baru berhasil dikirim.') }}


                                </p>
                            @endif



                        </div>


                    </div>


                </div>


            @endif



        </div>







        {{-- BUTTON SAVE --}}

        <div class="flex items-center gap-4 pt-3">


            <button type="submit"
                class="
                bg-emerald-600

                hover:bg-emerald-700

                text-white

                px-6 py-3

                rounded-xl

                shadow-sm

                hover:shadow-md

                transition

                text-xs

                font-bold

                uppercase

                tracking-wider
                ">

                Simpan Perubahan

            </button>






            {{-- SUCCESS MESSAGE --}}


            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                    class="
                    flex items-center gap-2

                    text-sm

                    font-medium

                    text-emerald-600
                    ">


                    <div
                        class="
                        w-6 h-6

                        rounded-full

                        bg-emerald-100

                        flex items-center justify-center
                    ">


                        ✓


                    </div>



                    Profil berhasil diperbarui.


                </div>
            @endif



        </div>



    </form>



</section>
