<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSHotel - Curated 4 & 5 Star Luxury Sanctuaries in the Netherlands</title>
    <meta name="description" content="Discover peaceful, high-end 4 and 5-star hotels and wellness resorts in the Netherlands. Reserve your serene stay instantly with GSHotel.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .hero-luxury {
            background-color: #0b1713;
            background-image: 
                radial-gradient(at 0% 0%, rgba(212, 175, 55, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(30, 41, 59, 0.6) 0px, transparent 80%);
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
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-700 via-amber-600 to-amber-400 flex items-center justify-center text-white shadow-lg shadow-amber-600/20 group-hover:scale-105 transition-transform duration-300">
                        <span class="font-serif font-bold text-xl tracking-wider">GS</span>
                    </div>
                    <div>
                        <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">GS<span class="text-amber-600 dark:text-amber-400 font-serif italic">Hotel</span></span>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Netherlands Sanctuary</span>
                    </div>
                </a>

                <!-- Navigation Tabs (No Login Needed) -->
                <nav class="flex items-center gap-3 sm:gap-6">
                    <a href="{{ route('hotels.index') }}" class="text-sm font-semibold text-amber-700 dark:text-amber-400 px-3 py-2 rounded-xl bg-amber-500/10 transition">
                        Explore Sanctuaries
                    </a>

                    <!-- Reserved Tab (Highlighted) -->
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white dark:bg-slate-800 dark:hover:bg-slate-700 font-bold text-sm shadow-md transition hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Reserved</span>
                        @php
                            $resCount = count(session()->get('guest_reservations', []));
                        @endphp
                        @if($resCount > 0)
                            <span class="w-5 h-5 rounded-full bg-amber-500 text-white text-[11px] font-black flex items-center justify-center">
                                {{ $resCount }}
                            </span>
                        @endif
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Luxury Hero Section with Relaxing Ambiance -->
    <section class="hero-luxury text-white py-16 md:py-24 relative overflow-hidden">
        <!-- Subtle Ambient Glow -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <!-- Curated Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-widest mb-6">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Curated 4 & 5-Star Sanctuaries Across The Netherlands</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight leading-tight max-w-4xl mx-auto">
                Discover Serenity & Refined Luxury at <span class="font-serif italic font-normal text-amber-300">GSHotel</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto mt-4 font-normal">
                Handpicked 4 and 5-star palace hotels, canal estates, and wellness resorts. Reserve your bespoke stay instantly without login.
            </p>

            <!-- Search & Filter Card -->
            <div class="mt-10 max-w-5xl mx-auto bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-3xl p-4 sm:p-6 shadow-2xl border border-white/20 text-slate-900 dark:text-slate-100">
                <form action="{{ route('hotels.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 items-center">
                    
                    <!-- Search Query -->
                    <div class="text-left">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Sanctuary or Keyword</label>
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="e.g. Conservatorium, Spa..." class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                    </div>

                    <!-- Destination / City -->
                    <div class="text-left">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Destination</label>
                        <select name="city" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                            <option value="">All Dutch Cities</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Star Rating (4-5 Stars) -->
                    <div class="text-left">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Luxury Rating</label>
                        <select name="stars" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                            <option value="">4 & 5 Stars</option>
                            <option value="5" {{ request('stars') == '5' ? 'selected' : '' }}>5-Star Luxury Only</option>
                            <option value="4" {{ request('stars') == '4' ? 'selected' : '' }}>4-Star & Above</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div class="text-left">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Sort By</label>
                        <select name="sort_by" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                            <option value="recommended" {{ request('sort_by') == 'recommended' ? 'selected' : '' }}>Curated Recommended</option>
                            <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>Highest Guest Rating</option>
                            <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="sm:col-span-2 lg:col-span-1 pt-2 sm:pt-0">
                        <label class="hidden lg:block text-[11px] font-bold text-transparent mb-1">Action</label>
                        <button type="submit" class="w-full py-3 px-5 rounded-xl bg-gradient-to-r from-amber-600 via-amber-500 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-amber-500/25 transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Hotel Results Section -->
    <main class="flex-grow py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Exclusive Portfolio</span>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">
                        Dutch 4 & 5-Star Sanctuaries
                    </h2>
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">
                    Showing <strong class="text-slate-900 dark:text-white">{{ $totalResults }}</strong> luxury properties
                </div>
            </div>

            <!-- Hotels Grid -->
            @if($hotels->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                    @foreach($hotels as $hotel)
                        <div class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                            
                            <!-- Hotel Image & Badges -->
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-black/20"></div>

                                <!-- Star Badge & Score -->
                                <div class="absolute top-4 left-4 flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-amber-700 dark:text-amber-400 font-black text-xs shadow-md">
                                        {{ $hotel->star_rating }} ★ Luxury
                                    </span>
                                </div>

                                <div class="absolute top-4 right-4">
                                    <span class="px-2.5 py-1 rounded-xl bg-emerald-600/90 text-white font-black text-xs shadow-md">
                                        ★ {{ $hotel->rating_score }}
                                    </span>
                                </div>

                                <!-- City & Hotel Name on Image Bottom -->
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-300 block mb-0.5">{{ $hotel->city }}</span>
                                    <h3 class="text-lg font-black leading-tight drop-shadow-sm">{{ $hotel->name }}</h3>
                                </div>
                            </div>

                            <!-- Hotel Content Card -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ $hotel->description }}
                                </p>

                                <!-- Amenities Chips -->
                                @if($hotel->amenities && $hotel->amenities->count() > 0)
                                    <div class="flex flex-wrap gap-1.5 pt-1">
                                        @foreach($hotel->amenities->take(3) as $amenity)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-600 dark:text-slate-300">
                                                <span class="w-1 h-1 rounded-full bg-amber-500"></span>
                                                {{ $amenity->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Pricing & Actions -->
                                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3">
                                    <div>
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold block">From</span>
                                        <div class="text-lg font-black text-slate-900 dark:text-white">
                                            €{{ number_format((float)$hotel->price_per_night, 0) }}
                                            <span class="text-[10px] text-slate-400 font-normal">/ night</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <!-- View Details -->
                                        <a href="{{ route('hotels.show', $hotel->id) }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition">
                                            Details
                                        </a>

                                        <!-- Reserve Button (Opens Modal with Thank You and Contact fields) -->
                                        <button type="button" 
                                                @click="$dispatch('open-reserve-modal', {
                                                    id: {{ $hotel->id }},
                                                    name: '{{ addslashes($hotel->name) }}',
                                                    city: '{{ addslashes($hotel->city) }}',
                                                    star_rating: {{ $hotel->star_rating }},
                                                    price_per_night: '{{ number_format((float)$hotel->price_per_night, 0) }}',
                                                    image_url: '{{ $hotel->image_url }}'
                                                })"
                                                class="px-4 py-2 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white text-xs font-black tracking-wider uppercase shadow-md shadow-amber-600/20 transition hover:scale-105 active:scale-95">
                                            Reserve
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 my-10 p-8">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">No luxury hotels match your filter</h3>
                    <p class="text-xs text-slate-500 mt-2">Try clearing your search query or selecting all Dutch destinations.</p>
                    <a href="{{ route('hotels.index') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-amber-600 text-white text-xs font-bold">
                        Reset Filters
                    </a>
                </div>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 dark:bg-slate-900/80 border-t border-slate-200/80 dark:border-slate-800 py-12 mt-20 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-3">
            <div class="flex items-center justify-center gap-2">
                <span class="font-serif italic font-bold text-slate-900 dark:text-white text-lg">GS</span>
                <span class="text-slate-900 dark:text-white font-bold text-base">Hotel Netherlands</span>
            </div>
            <p>Peaceful, handpicked 4 and 5-star hotel sanctuaries across Amsterdam, Rotterdam, The Hague, Utrecht, Maastricht and Eindhoven.</p>
            <p class="text-[11px] text-slate-400">© {{ date('Y') }} GSHotel. All rights reserved. Enjoy relaxing ambient soundscapes during your stay.</p>
        </div>
    </footer>

    <!-- Luxury Reservation Modal Component -->
    <x-reservation-modal />

    <!-- Floating Background Music Player with Mute Button on Bottom-Right -->
    <x-music-player />

</body>
</html>
