@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-700 tracking-wide mb-1']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
    @endif
</label>
