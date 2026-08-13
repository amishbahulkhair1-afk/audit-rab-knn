@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 focus:ring-offset-0 transition duration-150 ease-in-out disabled:bg-gray-50 disabled:text-gray-400']) }}>
