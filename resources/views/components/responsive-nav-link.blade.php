@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-2.5 rounded-lg text-start text-sm font-semibold text-indigo-700 bg-indigo-50/70 border border-indigo-100/50 transition duration-150 ease-in-out focus:outline-none'
            : 'block w-full ps-4 pe-4 py-2.5 rounded-lg text-start text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 border border-transparent transition duration-150 ease-in-out focus:outline-none';
@endphp

<!-- Ditambahkan margin kecil (mx-2) agar saat menjadi bentuk kotak/pill tidak menempel ke pinggir layar HP -->
<div class="mx-2 my-1">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</div>