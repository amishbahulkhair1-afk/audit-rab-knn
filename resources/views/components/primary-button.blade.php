<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2.5 bg-slate-950 hover:bg-slate-800 text-white border border-transparent rounded-lg font-semibold text-xs uppercase tracking-widest shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-950 focus:ring-offset-2 active:bg-slate-900 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
