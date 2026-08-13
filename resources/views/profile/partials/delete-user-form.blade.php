<section class="space-y-6">

    {{-- HEADER --}}

    <header>

        <div class="flex items-center gap-3 mb-4">

            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600">

                ⚠️

            </div>

            <div>

                <h2 class="text-xm font-bold text-slate-900">
                    {{ __('Hapus Akun') }}
                </h2>

                <p class="text-xs text-slate-500">
                    {{ __('Penghapusan akun secara permanen.') }}
                </p>

            </div>

        </div>

        <p class="text-sm text-slate-600 leading-relaxed max-w-2xl">

            {{ __('Setelah akun Anda dihapus, seluruh data dan sumber daya yang berkaitan dengan akun ini akan dihapus secara permanen. Pastikan Anda telah menyimpan informasi penting sebelum melanjutkan.') }}

        </p>

    </header>

    {{-- BUTTON DELETE --}}

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="!bg-white-900 hover:!bg-red-200 rounded-xl px-5 py-3 shadow-sm transition font-semibold">

        {{ __('Hapus Akun Sekarang') }}

    </x-danger-button>

    {{-- MODAL CONFIRMATION --}}

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">

            @csrf
            @method('delete')

            {{-- MODAL HEADER --}}

            <div class="flex items-center gap-3 mb-5">

                <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-2xl">

                    ⚠️

                </div>

                <div>

                    <h2 class="text-xl font-bold text-slate-900">

                        {{ __('Konfirmasi Penghapusan Akun') }}

                    </h2>

                    <p class="text-sm text-slate-500">

                        {{ __('Tindakan permanen') }}

                    </p>

                </div>

            </div>

            <p class="text-sm text-slate-600 leading-relaxed">

                {{ __('Tindakan ini tidak dapat dibatalkan. Semua data akun akan dihapus secara permanen. Masukkan password Anda untuk memastikan bahwa permintaan ini benar-benar dilakukan oleh Anda.') }}

            </p>

            {{-- PASSWORD --}}

            <div class="mt-6">

                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">

                    Password

                </label>

                <input id="password" name="password" type="password"
                    class="block w-full rounded-xl bg-slate-50 border border-slate-300 px-4 py-3 text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                    placeholder="Masukkan password Anda">

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

            </div>

            {{-- ACTION BUTTON --}}

            <div class="mt-8 flex justify-end gap-3">

                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl px-5 py-3 font-semibold">

                    {{ __('Batal') }}

                </x-secondary-button>

                <x-danger-button class="rounded-xl px-5 py-3 !bg-red-600 hover:!bg-red-700 font-semibold">

                    {{ __('Ya, Hapus Akun') }}

                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>
