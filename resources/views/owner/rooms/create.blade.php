<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-slate-800 dark:text-slate-100 leading-tight">
                {{ __('Nieuwe Kamer Toevoegen aan ') }} {{ $hotel->name }}
            </h2>
            <a href="{{ route('owner.rooms.index', $hotel->id) }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200">
                &larr; Terug naar kamers
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-feedback-alert />

            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700 shadow-sm p-6 sm:p-8">
                <form action="{{ route('owner.rooms.store', $hotel->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Room Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Kamer Titel / Naam *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Bijv. Deluxe King Room met Balkon" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                        @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Room Type & Price -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="room_type" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Kamertype *</label>
                            <select id="room_type" name="room_type" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                                <option value="Standard Room">Standard Room</option>
                                <option value="Superior Double">Superior Double</option>
                                <option value="Deluxe Room">Deluxe Room</option>
                                <option value="Executive Suite">Executive Suite</option>
                                <option value="Junior Suite">Junior Suite</option>
                                <option value="Presidential Suite">Presidential Suite</option>
                                <option value="Family Room">Family Room</option>
                            </select>
                        </div>

                        <div>
                            <label for="price_per_night" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Prijs per Nacht (€) *</label>
                            <input type="number" step="0.01" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', '110.00') }}" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('price_per_night') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Capacity & Beds -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="capacity" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Max Gasten (Capaciteit) *</label>
                            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', 2) }}" min="1" max="10" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('capacity') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="beds" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Bed Configuratie *</label>
                            <input type="text" id="beds" name="beds" value="{{ old('beds', '1 Queen Bed') }}" placeholder="1 King Bed / 2 Twin Beds" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('beds') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Image URL -->
                    <div>
                        <label for="image_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Kamer Afbeelding URL</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/..." class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Kamer Omschrijving</label>
                        <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- Availability Toggle -->
                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', 1) ? 'checked' : '' }} class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500">
                        <label for="is_available" class="text-xs font-bold text-slate-700 dark:text-slate-300">Kamer is direct beschikbaar voor boeking</label>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                        <a href="{{ route('owner.rooms.index', $hotel->id) }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">
                            Annuleren
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/30 transition">
                            Kamer Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
