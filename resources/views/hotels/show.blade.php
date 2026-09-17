<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $hotel->name }} - TrivagoHotel</title>
    <meta name="description" content="{{ Str::limit($hotel->description, 160) }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/80 dark:bg-slate-900/90 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('hotels.index') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-500 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xl font-black bg-gradient-to-r from-rose-500 via-indigo-600 to-sky-500 bg-clip-text text-transparent">Trivago<span class="text-slate-900 dark:text-white font-bold">Hotel</span></span>
                </a>

                <div class="flex items-center gap-4">
                    <a href="{{ route('hotels.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Terug naar resultaten</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
            <a href="{{ route('hotels.index') }}" class="hover:text-indigo-600">Hotels</a>
            <span>/</span>
            <span>{{ $hotel->city }}</span>
            <span>/</span>
            <span class="text-slate-700 dark:text-slate-300">{{ $hotel->name }}</span>
        </nav>

        <!-- Hotel Hero Header Card -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <!-- Star Badges -->
                        <div class="text-amber-400 text-sm font-black flex items-center">
                            {{ str_repeat('★', $hotel->star_rating) }}
                        </div>
                        <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300">
                            {{ $hotel->star_rating }}-Sterren Hotel
                        </span>
                        @if(!empty($hotel->is_featured))
                            <span class="px-3 py-1 rounded-full bg-rose-500 text-white text-xs font-black uppercase tracking-wider">
                                Premium Uitgelicht
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                        {{ $hotel->name }}
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 flex items-center gap-1.5 mt-2">
                        <svg class="w-4 h-4 text-rose-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $hotel->address }}, {{ $hotel->city }}, Nederland</span>
                    </p>
                </div>

                <!-- Review Score & Price Block -->
                <div class="flex items-center gap-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 shrink-0">
                    <div class="text-right">
                        <span class="block text-xs font-bold text-slate-500 dark:text-slate-400">Uitstekend</span>
                        <span class="text-xs text-slate-400">{{ $hotel->reviews_count ?? 12 }} beoordelingen</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/30">
                        {{ number_format((float) ($hotel->average_rating ?? 8.5), 1) }}
                    </div>
                </div>
            </div>

            <!-- Image Showcase Gallery -->
            <div class="mt-8 rounded-2xl overflow-hidden aspect-[21/9] max-h-[460px] bg-slate-100 dark:bg-slate-800">
                <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Description & Available Rooms -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Card -->
                <section class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 dark:text-white mb-4">Over dit hotel</h2>
                    <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                        {{ $hotel->description }}
                    </p>
                </section>

                <!-- Available Rooms Section -->
                <section class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-black text-slate-900 dark:text-white">Beschikbare Kamertypes</h2>
                        <span class="text-xs font-bold text-slate-400">{{ count($rooms) }} kamers beschikbaar</span>
                    </div>

                    @if(count($rooms) > 0)
                        <div class="space-y-4">
                            @foreach($rooms as $room)
                                <div class="p-5 rounded-2xl border border-slate-200/90 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-indigo-300 dark:hover:border-indigo-700 transition bg-slate-50/50 dark:bg-slate-800/30">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-extrabold text-base text-slate-900 dark:text-white">{{ $room->name }}</h3>
                                            <span class="px-2 py-0.5 rounded-lg bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 text-[10px] font-bold">{{ $room->room_type }}</span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                Max {{ $room->capacity }} personen
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ $room->beds }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between sm:justify-end gap-4 shrink-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-200 dark:border-slate-800">
                                        <div class="text-left sm:text-right">
                                            <div class="text-xl font-black text-slate-900 dark:text-white">€{{ number_format((float) $room->price_per_night, 0) }}</div>
                                            <span class="text-[10px] text-slate-400">per nacht incl. btw</span>
                                        </div>
                                        <button type="button" onclick="alert('Kamer selectie geactiveerd! Neem contact op met het hotel via de eigenaargegevens.')" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-sm transition">
                                            Selecteer Kamer
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-slate-400 text-sm">
                            Er zijn momenteel geen losse kamers vermeld. Vraag beschikbaarheid aan via de contactgegevens.
                        </div>
                    @endif
                </section>
            </div>

            <!-- Right Col: Eigenaar (Owner) Info Card & Inquiries -->
            <div class="space-y-6">
                <!-- Owner Profile Box -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm sticky top-28">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block mb-2">Geverifieerde Eigenaar</span>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">{{ $hotel->owner_company ?: ($hotel->owner_name ?: 'Hotel Beheer') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 mb-6">Contactpersoon: {{ $hotel->owner_name ?: 'Eigenaar' }}</p>

                    <div class="space-y-3.5 text-xs text-slate-700 dark:text-slate-300 mb-6">
                        @if(!empty($hotel->phone))
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="font-bold">{{ $hotel->phone }}</span>
                            </div>
                        @endif

                        @if(!empty($hotel->email))
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-bold truncate">{{ $hotel->email }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="mailto:{{ $hotel->email }}?subject=Reservering Aanvraag voor {{ urlencode($hotel->name) }}" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-2 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>Stuur Directe Aanvraag</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs py-10 border-t border-slate-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-500">
            &copy; {{ date('Y') }} TrivagoHotel. Gebouwd met Stored Procedures & FrankenPHP.
        </div>
    </footer>

</body>
</html>
