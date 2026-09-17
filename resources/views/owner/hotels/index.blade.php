<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-slate-800 dark:text-slate-100 leading-tight">
                {{ __('Hotelbeheer') }}
            </h2>
            <a href="{{ route('owner.hotels.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/20 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Nieuw Hotel Toevoegen</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <x-feedback-alert />

            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700 shadow-sm overflow-hidden">
                @if(count($hotels) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                            <thead class="bg-slate-50 dark:bg-slate-900/60 text-[11px] font-extrabold uppercase tracking-wider text-slate-400 border-b border-slate-100 dark:border-slate-700">
                                <tr>
                                    <th class="py-4 px-6">Hotel</th>
                                    <th class="py-4 px-6">Stad</th>
                                    <th class="py-4 px-6">Sterren</th>
                                    <th class="py-4 px-6">Kamers</th>
                                    <th class="py-4 px-6">Vanaf Prijs</th>
                                    <th class="py-4 px-6 text-right">Acties</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 font-medium">
                                @foreach($hotels as $hotel)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=200&q=80' }}" class="w-12 h-12 rounded-xl object-cover" alt="">
                                                <div>
                                                    <a href="{{ route('hotels.show', $hotel->id) }}" class="font-bold text-slate-900 dark:text-white hover:text-indigo-600 block">{{ $hotel->name }}</a>
                                                    <span class="text-[11px] text-slate-400">{{ Str::limit($hotel->address, 30) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-bold text-slate-800 dark:text-slate-200">
                                            {{ $hotel->city }}
                                        </td>
                                        <td class="py-4 px-6 text-amber-400 text-xs">
                                            {{ str_repeat('★', $hotel->star_rating) }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('owner.rooms.index', $hotel->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 text-xs font-bold hover:bg-indigo-100">
                                                <span>{{ $hotel->rooms_count ?? 0 }} Kamers</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="py-4 px-6 font-bold text-slate-900 dark:text-white">
                                            €{{ number_format((float) $hotel->price_per_night, 2) }}
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('owner.rooms.index', $hotel->id) }}" class="p-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-400" title="Kamers beheren">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('owner.hotels.edit', $hotel->id) }}" class="p-2 text-slate-600 hover:text-slate-900 dark:text-slate-300" title="Bewerken">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('owner.hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Weet u zeker dat u dit hotel wilt verwijderen?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-500 hover:text-rose-700" title="Verwijderen">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 px-4">
                        <p class="text-sm text-slate-400">U heeft nog geen hotels geregistreerd.</p>
                        <a href="{{ route('owner.hotels.create') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700">
                            Registreer uw eerste hotel
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
