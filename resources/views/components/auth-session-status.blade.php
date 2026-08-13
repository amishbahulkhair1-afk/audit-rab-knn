@props(['status'])

@if ($status)
    <!-- Ditambahkan padding, background soft green, dan border tipis -->
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-4 py-3 rounded-lg shadow-sm flex items-center gap-2']) }}>
        <svg class="w-4 4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $status }}</span>
    </div>
@endif