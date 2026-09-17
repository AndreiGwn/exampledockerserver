<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl text-slate-800 dark:text-slate-100 leading-tight">
                    Kamers van {{ $hotel->name }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">{{ $hotel->address }}, {{ $hotel->city }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('owner.hotels.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200">
                    &larr; Terug naar hotels
                </a>
                <a href="{{ route('owner.rooms.create', $hotel->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Kamer Toevoegen</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <x-feedback-alert />

            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700 shadow-sm overflow-hidden">
                @if(count($rooms) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                            <thead class="bg-slate-50 dark:bg-slate-900/60 text-[11px] font-extrabold uppercase tracking-wider text-slate-400 border-b border-slate-100 dark:border-slate-700">
                                <tr>
                                    <th class="py-4 px-6">Kamer</th>
                                    <th class="py-4 px-6">Type</th>
                                    <th class="py-4 px-6">Capaciteit</th>
                                    <th class="py-4 px-6">Bedden</th>
                                    <th class="py-4 px-6">Prijs / nacht</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Acties</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 font-medium">
                                @foreach($rooms as $room)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $room->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=200&q=80' }}" class="w-10 h-10 rounded-xl object-cover" alt="">
                                                <span class="font-bold text-slate-900 dark:text-white">{{ $room->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">{{ $room->room_type }}</td>
                                        <td class="py-4 px-6 font-bold text-slate-800 dark:text-slate-200">{{ $room->capacity }} personen</td>
                                        <td class="py-4 px-6 text-xs text-slate-500">{{ $room->beds }}</td>
                                        <td class="py-4 px-6 font-bold text-slate-900 dark:text-white">€{{ number_format((float) $room->price_per_night, 2) }}</td>
                                        <td class="py-4 px-6">
                                            @if($room->is_available)
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Beschikbaar</span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">Niet beschikbaar</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('owner.rooms.edit', [$hotel->id, $room->id]) }}" class="p-2 text-slate-600 hover:text-slate-900 dark:text-slate-300" title="Bewerken">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('owner.rooms.destroy', [$hotel->id, $room->id]) }}" method="POST" onsubmit="return confirm('Weet u zeker dat u deze kamer wilt verwijderen?')" class="inline">
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
                        <p class="text-sm text-slate-400">Er zijn nog geen kamers geregistreerd voor dit hotel.</p>
                        <a href="{{ route('owner.rooms.create', $hotel->id) }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700">
                            Voeg uw eerste kamer toe
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
