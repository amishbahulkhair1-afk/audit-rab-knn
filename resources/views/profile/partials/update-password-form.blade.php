<section class="space-y-6">


    {{-- HEADER --}}

    <header>


        <div class="flex items-center gap-3 mb-4">


            <div
                class="w-10 h-10 rounded-xl
                        bg-amber-50
                        flex items-center justify-center
                        text-amber-600">

                🔐

            </div>



            <div>


                <h2 class="text-xm font-bold text-slate-900">

                    {{ __('Ubah Kata Sandi') }}

                </h2>


                <p class="text-xs text-slate-500">

                    {{ __('Perbarui password untuk menjaga keamanan akun Anda.') }}

                </p>


            </div>


        </div>



        <p class="text-sm text-slate-600 leading-relaxed max-w-2xl">

            {{ __('Gunakan kata sandi yang kuat dengan kombinasi huruf, angka, dan karakter khusus agar akun tetap terlindungi.') }}

        </p>


    </header>






    {{-- FORM PASSWORD --}}

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">

        @csrf
        @method('put')



        {{-- CURRENT PASSWORD --}}

        <div>


            <label for="update_password_current_password"
                class="
                block
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-slate-500
                mb-2
                ">

                Kata Sandi Saat Ini

            </label>



            <input id="update_password_current_password" name="current_password" type="password"
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
                "
                autocomplete="current-password">



            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />


        </div>






        {{-- NEW PASSWORD --}}

        <div>


            <label for="update_password_password"
                class="
                block
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-slate-500
                mb-2
                ">

                Kata Sandi Baru

            </label>




            <input id="update_password_password" name="password" type="password"
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
                "
                autocomplete="new-password">




            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />


        </div>






        {{-- CONFIRM PASSWORD --}}

        <div>


            <label for="update_password_password_confirmation"
                class="
                block
                text-xs
                font-bold
                uppercase
                tracking-wider
                text-slate-500
                mb-2
                ">

                Konfirmasi Kata Sandi

            </label>




            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
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
                "
                autocomplete="new-password">




            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />


        </div>








        {{-- BUTTON --}}

        <div class="flex items-center gap-4 pt-3">


            <button type="submit"
                class="
                bg-emerald-600
                hover:bg-emerald-700

                text-white

                px-6
                py-3

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

            @if (session('status') === 'password-updated')
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



                    Password berhasil diperbarui.


                </div>
            @endif



        </div>




    </form>



</section>
