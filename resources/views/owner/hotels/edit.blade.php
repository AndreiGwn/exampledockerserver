<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-slate-800 dark:text-slate-100 leading-tight">
                {{ __('Hotel Bewerken: ') }} {{ $hotel->name }}
            </h2>
            <a href="{{ route('owner.hotels.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200">
                &larr; Terug naar overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-feedback-alert />

            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700 shadow-sm p-6 sm:p-8">
                <form action="{{ route('owner.hotels.update', $hotel->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Hotel Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Hotelnaam *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $hotel->name) }}" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                        @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- City & Address -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="city" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Stad *</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $hotel->city) }}" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('city') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Adres *</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $hotel->address) }}" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('address') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Star Rating & Base Price -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="star_rating" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Aantal Sterren *</label>
                            <select id="star_rating" name="star_rating" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                                <option value="3" {{ old('star_rating', $hotel->star_rating) == '3' ? 'selected' : '' }}>3 Sterren</option>
                                <option value="4" {{ old('star_rating', $hotel->star_rating) == '4' ? 'selected' : '' }}>4 Sterren</option>
                                <option value="5" {{ old('star_rating', $hotel->star_rating) == '5' ? 'selected' : '' }}>5 Sterren (Luxe)</option>
                                <option value="2" {{ old('star_rating', $hotel->star_rating) == '2' ? 'selected' : '' }}>2 Sterren</option>
                                <option value="1" {{ old('star_rating', $hotel->star_rating) == '1' ? 'selected' : '' }}>1 Ster</option>
                            </select>
                            @error('star_rating') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="price_per_night" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Vanaf Prijs (€) *</label>
                            <input type="number" step="0.01" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $hotel->price_per_night) }}" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                            @error('price_per_night') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Image URL -->
                    <div>
                        <label for="image_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Afbeelding URL</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $hotel->image_url) }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                        @error('image_url') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Beschrijving *</label>
                        <textarea id="description" name="description" rows="4" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">{{ old('description', $hotel->description) }}</textarea>
                        @error('description') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contact Details -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Telefoonnummer</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $hotel->phone) }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">E-mailadres</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $hotel->email) }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Featured Checkbox -->
                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $hotel->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500">
                        <label for="is_featured" class="text-xs font-bold text-slate-700 dark:text-slate-300">Markeer als Premium Uitgelicht hotel</label>
                    </div>

                    <!-- Submit & Actions -->
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center">
                        <a href="{{ route('owner.rooms.index', $hotel->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800">
                            <span>Kamers van dit hotel beheren &rarr;</span>
                        </a>
                        <div class="flex gap-3">
                            <a href="{{ route('owner.hotels.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">
                                Annuleren
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-600/30 transition">
                                Wijzigingen Opslaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
