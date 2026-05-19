<div>
    <div class="flex w-full h-screen bg-gray-50">

        {{-- Левая панель (чат/поиск) --}}
        <div
            class="fixed left-0 right-[75%] min-w-82.5 w-89.5 bottom-0 top-0 flex-1 flex justify-between flex-col bg-white shadow-xl rounded-r-2xl px-4 pb-6 pt-4 border-l-4 border-l-red-500">

            <div class="flex flex-col h-full justify-between">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-8 bg-red-500 rounded-full"></div>
                    <h2 class="text-xl font-bold text-gray-800">Поиск экспонатов</h2>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">

                    <div class="flex flex-col gap-3 mb-4 max-h-96 overflow-y-auto">

                        @foreach ($messages as $message)

                            @if ($message['type'] === 'user')
                                <div class="bg-gray-100 text-gray-700 rounded-2xl rounded-tr-none px-4 py-2 max-w-[85%]">
                                    {{ $message['text'] }}
                                </div>
                            @else
                                <div class="bg-red-500 text-white rounded-2xl rounded-tl-none px-4 py-2 max-w-[85%] self-end">
                                    {{ $message['text'] }}
                                </div>
                            @endif

                        @endforeach

                    </div>

                    {{-- Поле поиска --}}
                    <div class="flex gap-2 items-center">

                        <div class="flex-1 relative">
                            <input
                                class="w-full bg-white border border-gray-200 rounded-full pl-4 pr-10 py-2.5 focus:outline-none focus:border-red-300 focus:ring-1 focus:ring-red-300 transition text-gray-700 placeholder-gray-400"
                                type="text" placeholder="Введите запрос..." wire:model="searchQuery"
                                wire:keydown.enter="search">
                        </div>

                        <button wire:click="search" wire:loading.attr="disabled"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-5 rounded-full transition shadow-md hover:shadow-lg">
                            →
                        </button>

                    </div>
                </div>
            </div>

            {{-- Нижняя часть панели (опционально) --}}
            <div class="text-center text-xs text-gray-400 pt-4 border-t border-gray-100">
                Архив музея • {{ now()->year }}
            </div>
        </div>

        {{-- Правая панель с карточками --}}
        <div class="ml-89.5 flex-1 p-6 overflow-y-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Коллекция музея</h1>
                <p class="text-gray-500 text-sm mt-1">Всего экспонатов: {{ $cards->count() }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pb-8">
                @forelse ($cards as $card)
                    <x-card :exhibit="$card" :wire:key="$card->id" />
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <p class="text-gray-500 text-lg">Нет доступных экспонатов</p>
                        <p class="text-gray-400 text-sm mt-1">Попробуйте изменить параметры поиска</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>