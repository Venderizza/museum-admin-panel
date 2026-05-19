@props(['exhibit'])

@php
    $photo = $exhibit->photos->first();
    $imageUrl = $photo && $photo->path
        ? asset('storage/' . $photo->path)
        : null;
@endphp

<div
    class="group flex flex-col h-full bg-white border border-gray-200 overflow-hidden rounded-2xl transition-all duration-300 hover:shadow-xl hover:border-red-300 hover:-translate-y-1">

    {{-- Блок с изображением --}}
    <div class="relative overflow-hidden bg-gray-100">
        @if($imageUrl)
            <img class="h-56 w-full object-cover transition-transform duration-500 group-hover:scale-105"
                src="{{ $imageUrl }}" alt="{{ $exhibit->name }}" loading="lazy">
        @else
            <div class="h-56 w-full flex items-center justify-center bg-gray-100">
                <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif

        {{-- Бейдж-акцент --}}
        <div class="absolute top-3 right-3 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
    </div>

    {{-- Контент --}}
    <div class="flex-1 flex flex-col justify-between px-5 py-4">
        <div>
            <h3
                class="text-xl font-bold text-gray-800 line-clamp-2 group-hover:text-red-600 transition-colors duration-300">
                {{ $exhibit->name }}
            </h3>
            <p class="mt-2 text-sm text-gray-500 line-clamp-3 leading-relaxed">
                {{ $exhibit->description }}
            </p>
        </div>

        {{-- Теги --}}
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full">кошка</span>
            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full">1820</span>
            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full">XIII век</span>
            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full">Пётр I</span>
        </div>

        {{-- Дата получения --}}
        @if($exhibit->arrived_at)
            <div class="mt-4 flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="font-medium">Поступил:</span>
                <span>{{ $exhibit->arrived_at->format('d.m.Y') }}</span>
            </div>
        @endif
    </div>
</div>