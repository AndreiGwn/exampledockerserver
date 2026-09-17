<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $hotel->name }} - GSHotel Luxury Netherlands</title>
    <meta name="description" content="{{ Str::limit($hotel->description, 160) }}">

    <!-- Favicon / URL Tab Logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/gs_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/gs_logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .bg-serene {
            background-color: #faf8f5;
        }
    </style>
</head>
<body class="bg-serene text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 flex flex-col min-h-screen">

    <!-- Top Luxury Navigation -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-amber-500/10 dark:bg-slate-900/90 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo -->
                <a href="{{ route('hotels.index') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 rounded-2xl overflow-hidden shadow-md shadow-amber-600/20 group-hover:scale-105 transition-transform duration-300 border border-amber-500/30">
                        <img src="/images/gs_logo.png" alt="Gogan Space GS Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Gogan <span class="text-amber-600 dark:text-amber-400 font-serif italic">Space</span></span>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Netherlands Sanctuary</span>
                    </div>
                </a>

                <!-- Navigation Tabs -->
                <nav class="flex items-center gap-4 sm:gap-6">
                    <a href="{{ route('hotels.index') }}" class="text-sm font-semibold text-slate-600 hover:text-amber-600 dark:text-slate-300 dark:hover:text-white transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>All Hotels</span>
                    </a>

                    <!-- Reserved Tab -->
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white dark:bg-slate-800 dark:hover:bg-slate-700 font-bold text-sm shadow-md transition hover:scale-[1.02]">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Reserved</span>
                    </a>

                    <!-- Minimal Sound Controller in Header (Top-Right) -->
                    <div class="ml-1 sm:ml-2">
                        <x-music-player />
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Sanctuary Page -->
    <main class="flex-grow py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Hero Photography Banner -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[400px] sm:h-[480px]">
                <img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-black/20"></div>

                <div class="absolute bottom-8 left-8 right-8 text-white flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="px-3.5 py-1 rounded-full bg-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg">
                                {{ $hotel->star_rating }} ★ Luxury Sanctuary
                            </span>
                            <span class="text-sm font-semibold text-amber-200">{{ $hotel->city }}, Netherlands</span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">{{ $hotel->name }}</h1>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-2xl">{{ $hotel->address }}</p>
                    </div>

                    <!-- Direct Reserve Action Button -->
                    <div class="shrink-0">
                        <button type="button" 
                                @click="$dispatch('open-reserve-modal', {
                                    id: {{ $hotel->id }},
                                    name: '{{ addslashes($hotel->name) }}',
                                    city: '{{ addslashes($hotel->city) }}',
                                    star_rating: {{ $hotel->star_rating }},
                                    price_per_night: '{{ number_format((float)$hotel->price_per_night, 0) }}',
                                    image_url: '{{ $hotel->image_url }}'
                                })"
                                class="px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm uppercase tracking-wider shadow-2xl shadow-amber-600/40 transition hover:scale-105 active:scale-95">
                            Reserve Your Stay
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Details & Suites vs Summary Card -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left 8-Col: Sanctuary Story, Amenities & Suites -->
                <div class="lg:col-span-8 space-y-10">
                    
                    <!-- Sanctuary Overview -->
                    <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">The Experience</span>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white">About this 4-5 Star Sanctuary</h2>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            {{ $hotel->description }}
                        </p>
                    </section>

                    <!-- Signature Amenities -->
                    @if($amenities && $amenities->count() > 0)
                        <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Curated Comforts</span>
                            <h2 class="text-2xl font-black text-slate-900 dark:text-white">Signature Amenities & Wellness</h2>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($amenities as $amenity)
                                    <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                        <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-sm">
                                            ✓
                                        </div>
                                        <span class="text-xs font-bold text-slate-800 dark:text-slate-200">{{ $amenity->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Suites & Rooms Selection -->
                    <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-6">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Accommodations</span>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white">Available Suites & Rooms</h2>
                        
                        <div class="space-y-6">
                            @foreach($rooms as $room)
                                <div class="flex flex-col sm:flex-row gap-6 p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 items-center justify-between">
                                    <img src="{{ $room->image_url ?: $hotel->image_url }}" alt="{{ $room->name }}" class="w-full sm:w-44 h-36 rounded-xl object-cover shadow-sm shrink-0">
                                    
                                    <div class="flex-1 space-y-2 text-left w-full">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-0.5 rounded-md bg-amber-500/10 text-amber-700 dark:text-amber-300 font-bold text-[10px] uppercase">
                                                {{ $room->room_type }}
                                            </span>
                                            <span class="text-xs text-slate-400">Max {{ $room->max_guests }} Guests</span>
                                        </div>
                                        <h3 class="text-lg font-black text-slate-900 dark:text-white">{{ $room->name }}</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $room->description }}</p>
                                        <div class="text-xs text-slate-600 dark:text-slate-300 font-semibold">
                                            Bedding: <span class="text-amber-700 dark:text-amber-400">{{ $room->bed_type }}</span>
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0 w-full sm:w-auto pt-4 sm:pt-0 border-t sm:border-t-0 border-slate-200 dark:border-slate-700 flex sm:flex-col items-center sm:items-end justify-between gap-3">
                                        <div>
                                            <div class="text-xl font-black text-slate-900 dark:text-white">
                                                €{{ number_format((float)$room->price_per_night, 0) }}
                                            </div>
                                            <span class="text-[10px] text-slate-400">per night incl. taxes</span>
                                        </div>

                                        <!-- Reserve Suite Trigger -->
                                        <button type="button" 
                                                @click="$dispatch('open-reserve-modal', {
                                                    id: {{ $hotel->id }},
                                                    room_id: {{ $room->id }},
                                                    name: '{{ addslashes($hotel->name . ' - ' . $room->name) }}',
                                                    city: '{{ addslashes($hotel->city) }}',
                                                    star_rating: {{ $hotel->star_rating }},
                                                    price_per_night: '{{ number_format((float)$room->price_per_night, 0) }}',
                                                    image_url: '{{ $room->image_url ?: $hotel->image_url }}'
                                                })"
                                                class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-black uppercase tracking-wider shadow-md transition hover:scale-105 active:scale-95">
                                            Reserve Suite
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                </div>

                <!-- Right 4-Col: Sticky Concierge Card -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="sticky top-28 bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/30 dark:shadow-none space-y-6">
                        <div class="text-center pb-6 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-xs text-slate-400 uppercase tracking-widest font-bold">Rates From</span>
                            <div class="text-3xl font-black text-amber-700 dark:text-amber-400 mt-1">
                                €{{ number_format((float)$hotel->price_per_night, 0) }}
                                <span class="text-xs text-slate-400 font-normal">/ night</span>
                            </div>
                        </div>

                        <!-- Instant Reservation Button -->
                        <button type="button" 
                                @click="$dispatch('open-reserve-modal', {
                                    id: {{ $hotel->id }},
                                    name: '{{ addslashes($hotel->name) }}',
                                    city: '{{ addslashes($hotel->city) }}',
                                    star_rating: {{ $hotel->star_rating }},
                                    price_per_night: '{{ number_format((float)$hotel->price_per_night, 0) }}',
                                    image_url: '{{ $hotel->image_url }}'
                                })"
                                class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm uppercase tracking-wider shadow-xl shadow-amber-600/30 transition hover:scale-[1.02] active:scale-[0.98] text-center">
                            Reserve Now
                        </button>

                        <div class="space-y-3 text-xs text-slate-600 dark:text-slate-400 pt-2">
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>No account or login required</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>Instant confirmation on "Reserved" tab</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>24/7 dedicated sanctuary concierge</span>
                            </div>
                        </div>

                        <!-- Direct Contact -->
                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 space-y-2 text-xs">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Sanctuary Concierge</span>
                            <div class="font-semibold text-slate-800 dark:text-white">{{ $hotel->phone ?: '+31 20 570 0000' }}</div>
                            <div class="text-slate-500">{{ $hotel->email ?: 'concierge@gshotel.nl' }}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 dark:bg-slate-900/80 border-t border-slate-200/80 dark:border-slate-800 py-10 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <p>© {{ date('Y') }} Gogan Space (GSHotel) Netherlands. Curated 4-5 star luxury hospitality.</p>
            <p class="text-[11px] text-slate-400">Independent demonstration project, not affiliated with featured hotels. Contact / Copyright: <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-600 dark:text-amber-400 underline hover:text-amber-500">andrei.gogan9@gmail.com</a></p>
        </div>
    </footer>

    <!-- Reservation Modal Component -->
    <x-reservation-modal />


</body>
</html>
