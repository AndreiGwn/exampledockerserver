<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth overflow-x-hidden w-full max-w-full" style="color-scheme: dark;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <title>{{ $hotel->name }} - Gogan Space Luxury Netherlands</title>
    <meta name="description" content="{{ Str::limit($hotel->description, 160) }}">

    <!-- Favicon / URL Tab Logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/gs_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/gs_logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Cinzel+Decorative:wght@700;900&family=Marcellus&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            background-color: #020617;
            background-image: radial-gradient(at 0% 0%, rgba(212, 175, 55, 0.07) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(15, 41, 34, 0.06) 0px, transparent 50%),
                              radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.95) 0px, transparent 80%);
        }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false }" class="bg-serene text-slate-100 antialiased dark:bg-slate-950 dark:text-slate-100 flex flex-col min-h-screen relative w-full max-w-full overflow-x-hidden">

    <!-- Top Luxury Navigation -->
    <header class="sticky top-0 z-40 bg-slate-900/95 backdrop-blur-md border-b border-amber-500/15 transition-all w-full max-w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-2.5 xs:px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 xs:h-16 sm:h-20 gap-1 sm:gap-3">
                
                <!-- Cool Brand Logo -->
                <a href="{{ route('hotels.index') }}" class="flex items-center gap-1.5 xs:gap-2 sm:gap-3.5 group shrink-0 min-w-0">
                    <div class="w-8 h-8 xs:w-10 xs:h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-2xl overflow-hidden shadow-lg shadow-amber-500/20 group-hover:scale-105 group-hover:border-amber-400/80 transition-all duration-300 border border-amber-500/40 bg-slate-950 p-0.5 sm:p-1 flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/gs_logo.png') }}" alt="Gogan Space GS Logo" class="w-full h-full object-contain rounded-md sm:rounded-xl">
                    </div>
                    <div class="flex flex-col justify-center leading-none min-w-0">
                        <div class="flex items-center gap-1 sm:gap-2">
                            <span class="font-cinzel text-xs xs:text-sm sm:text-2xl font-black tracking-wider text-white logo-text-shimmer drop-shadow-sm uppercase truncate">
                                Gogan Space
                            </span>
                            <span class="font-cinzel-decorative text-[8px] xs:text-[10px] sm:text-xs font-bold tracking-widest gold-text-glow px-1 sm:px-1.5 py-0.5 rounded bg-amber-500/10 border border-amber-500/30 shadow-sm uppercase shrink-0">
                                Hotels
                            </span>
                        </div>
                        <div class="hidden md:flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 rounded-full bg-amber-400/80"></span>
                            <span class="text-[8px] sm:text-[9px] font-bold uppercase tracking-[0.24em] text-slate-400 group-hover:text-amber-300/90 transition-colors">
                                Netherlands &bull; Luxury Sanctuaries
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Tabs (hidden on mobile, visible on md+) -->
                <nav class="hidden md:flex items-center gap-1.5 sm:gap-3">
                    <a href="{{ route('hotels.index') }}" class="px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-xl text-xs sm:text-sm text-slate-300 hover:text-amber-400 font-medium transition flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>All Hotels</span>
                    </a>

                    <!-- Reserved Tab -->
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-xl sm:rounded-2xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs sm:text-sm shadow-md transition hover:scale-[1.02]">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Reserved</span>
                    </a>

                    <!-- Minimal Sound Controller in Header (Top-Right) -->
                    <div class="shrink-0">
                        <x-music-player />
                    </div>
                </nav>

                <!-- Mobile Action Bar: Quick Audio + Hamburger Button (md:hidden) -->
                <div class="flex md:hidden items-center gap-1.5 xs:gap-2 shrink-0">
                    <x-music-player />

                    <button type="button" 
                            @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2 xs:p-2.5 rounded-xl bg-slate-800/90 hover:bg-slate-700/90 border border-amber-500/30 hover:border-amber-400 text-amber-400 hover:text-amber-300 transition-all focus:outline-none focus:ring-2 focus:ring-amber-500/50 shadow-md flex items-center justify-center"
                            aria-label="Toggle navigation menu">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5 text-amber-300 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-250 transform origin-top"
             x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform origin-top"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
             @click.away="mobileMenuOpen = false"
             class="md:hidden border-t border-amber-500/20 bg-slate-950/98 backdrop-blur-2xl px-3.5 py-4 space-y-2.5 shadow-2xl max-w-full overflow-hidden"
             x-cloak>
            
            <a href="{{ route('hotels.index') }}" 
               class="w-full flex items-center justify-between p-3 rounded-2xl border border-slate-800 bg-slate-900/90 text-slate-200 hover:bg-slate-800/90 hover:border-amber-500/30 transition-all group">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm font-bold text-white group-hover:text-amber-300 transition-colors truncate">Explore Sanctuaries</div>
                        <div class="text-[11px] text-slate-400 truncate">Browse 4 & 5-star Dutch luxury stays</div>
                    </div>
                </div>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-400 group-hover:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="{{ route('reservations.index') }}" 
               class="w-full flex items-center justify-between p-3 rounded-2xl border border-slate-800 bg-slate-900/90 text-slate-200 hover:bg-slate-800/90 hover:border-amber-500/30 transition-all group">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm font-bold text-white group-hover:text-amber-300 transition-colors truncate">Reserved Sanctuaries</div>
                        <div class="text-[11px] text-slate-400 truncate">Lookup & manage confirmed bookings</div>
                    </div>
                </div>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-400 group-hover:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <div class="pt-2 border-t border-slate-800/80 text-center">
                <a href="mailto:andrei.gogan9@gmail.com" class="text-[11px] text-amber-400/90 hover:text-amber-300 font-medium inline-flex items-center justify-center gap-1.5 py-1 transition-colors">
                    <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="truncate">Concierge: andrei.gogan9@gmail.com</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Sanctuary Page -->
    <main class="flex-grow py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 space-y-6 sm:space-y-10">
            
            <!-- Hero Photography Banner -->
            <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl min-h-[300px] h-[340px] xs:h-[380px] sm:h-[480px]">
                <img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/50 to-black/30"></div>

                <div class="absolute bottom-4 sm:bottom-8 left-4 sm:left-8 right-4 sm:right-8 text-white flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6">
                    <div class="space-y-1.5 sm:space-y-2">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <span class="px-2.5 sm:px-3.5 py-0.5 sm:py-1 rounded-full bg-amber-500 text-slate-950 font-black text-[10px] sm:text-xs uppercase tracking-wider shadow-lg">
                                {{ $hotel->star_rating }} ★ Luxury Sanctuary
                            </span>
                            <span class="text-xs sm:text-sm font-semibold text-amber-200">{{ $hotel->city }}, Netherlands</span>
                        </div>
                        <h1 class="text-2xl xs:text-3xl sm:text-5xl font-black tracking-tight leading-tight">{{ $hotel->name }}</h1>
                        <p class="text-[11px] sm:text-sm text-slate-300 max-w-2xl line-clamp-2 sm:line-clamp-none">{{ $hotel->address }}</p>
                    </div>

                    <!-- Direct Reserve Action Button -->
                    <div class="shrink-0 w-full sm:w-auto">
                        <button type="button" 
                                @click="$dispatch('open-reserve-modal', {
                                    id: {{ $hotel->id }},
                                    name: '{{ addslashes($hotel->name) }}',
                                    city: '{{ addslashes($hotel->city) }}',
                                    star_rating: {{ $hotel->star_rating }},
                                    price_per_night: '{{ number_format((float)$hotel->price_per_night, 0) }}',
                                    image_url: '{{ $hotel->image_url }}'
                                })"
                                class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-xs sm:text-sm uppercase tracking-wider shadow-2xl shadow-amber-600/40 transition hover:scale-105 active:scale-95 text-center">
                            Reserve Your Stay
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Details & Suites vs Summary Card -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-10">
                
                <!-- Left 8-Col: Sanctuary Story, Amenities & Suites -->
                <div class="lg:col-span-8 space-y-6 sm:space-y-10">
                    
                    <!-- Sanctuary Overview -->
                    <section class="bg-slate-900 rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-slate-800 shadow-sm space-y-3 sm:space-y-4">
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-amber-400">The Experience</span>
                        <h2 class="text-xl sm:text-2xl font-black text-white">About this 4-5 Star Sanctuary</h2>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                            {{ $hotel->description }}
                        </p>
                    </section>

                    <!-- Signature Amenities -->
                    @if($amenities && $amenities->count() > 0)
                        <section class="bg-slate-900 rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-slate-800 shadow-sm space-y-4 sm:space-y-6">
                            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-amber-400">Curated Comforts</span>
                            <h2 class="text-xl sm:text-2xl font-black text-white">Signature Amenities & Wellness</h2>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                @foreach($amenities as $amenity)
                                    <div class="flex items-center gap-3 p-3 rounded-xl sm:rounded-2xl bg-slate-800/60 border border-slate-800">
                                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg sm:rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold text-xs sm:text-sm flex-shrink-0">
                                            ✓
                                        </div>
                                        <span class="text-xs font-bold text-slate-200">{{ $amenity->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Suites & Rooms Selection -->
                    <section class="bg-slate-900 rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-slate-800 shadow-sm space-y-4 sm:space-y-6">
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-amber-400">Accommodations</span>
                        <h2 class="text-xl sm:text-2xl font-black text-white">Available Suites & Rooms</h2>
                        
                        <div class="space-y-4 sm:space-y-6">
                            @foreach($rooms as $room)
                                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 p-4 sm:p-6 rounded-2xl bg-slate-800/60 border border-slate-800 items-start sm:items-center justify-between">
                                    <img src="{{ $room->image_url ?: $hotel->image_url }}" alt="{{ $room->name }}" class="w-full sm:w-44 h-44 sm:h-36 rounded-xl object-cover shadow-sm shrink-0">
                                    
                                    <div class="flex-1 space-y-1.5 sm:space-y-2 text-left w-full">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-300 font-bold text-[10px] uppercase">
                                                {{ $room->room_type }}
                                            </span>
                                            <span class="text-[11px] sm:text-xs text-slate-400">Max {{ $room->max_guests }} Guests</span>
                                        </div>
                                        <h3 class="text-base sm:text-lg font-black text-white">{{ $room->name }}</h3>
                                        <p class="text-xs text-slate-400">{{ $room->description }}</p>
                                        <div class="text-xs text-slate-300 font-semibold">
                                            Bedding: <span class="text-amber-400">{{ $room->bed_type }}</span>
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-700 flex sm:flex-col items-center sm:items-end justify-between gap-3">
                                        <div class="text-left sm:text-right">
                                            <div class="text-lg sm:text-xl font-black text-white">
                                                €{{ number_format((float)$room->price_per_night, 0) }}
                                            </div>
                                            <span class="text-[10px] text-slate-400">per night</span>
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
                                                class="px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-black uppercase tracking-wider shadow-md transition hover:scale-105 active:scale-95">
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
                    <div class="static lg:sticky top-28 bg-slate-900 rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-slate-800 shadow-xl space-y-5 sm:space-y-6">
                        <div class="text-center pb-4 sm:pb-6 border-b border-slate-800">
                            <span class="text-xs text-slate-400 uppercase tracking-widest font-bold">Rates From</span>
                            <div class="text-2xl sm:text-3xl font-black text-amber-400 mt-1">
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
                                class="w-full py-3.5 sm:py-4 px-6 rounded-xl sm:rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-xs sm:text-sm uppercase tracking-wider shadow-xl shadow-amber-600/30 transition hover:scale-[1.02] active:scale-[0.98] text-center">
                            Reserve Now
                        </button>

                        <div class="space-y-2.5 sm:space-y-3 text-xs text-slate-400 pt-1 sm:pt-2">
                            <div class="flex items-center gap-2.5 sm:gap-3">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>No account or login required</span>
                            </div>
                            <div class="flex items-center gap-2.5 sm:gap-3">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>Instant confirmation on "Reserved" tab</span>
                            </div>
                            <div class="flex items-center gap-2.5 sm:gap-3">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>24/7 dedicated sanctuary concierge</span>
                            </div>
                        </div>

                        <!-- Direct Contact -->
                        <div class="pt-5 sm:pt-6 border-t border-slate-800 space-y-1.5 sm:space-y-2 text-xs">
                            <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Sanctuary Concierge</span>
                            <div class="font-semibold text-white">{{ $hotel->phone ?: '+31 20 570 0000' }}</div>
                            <div class="text-slate-400">{{ $hotel->email ?: 'concierge@gshotel.nl' }}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900/80 border-t border-slate-800 py-10 text-center text-xs text-slate-500 mt-auto">
        <div class="max-w-7xl mx-auto px-4 space-y-3">
            <div class="flex items-center justify-center gap-2.5">
                <div class="w-8 h-8 rounded-lg overflow-hidden border border-amber-500/30 inline-block align-middle">
                    <img src="{{ asset('images/gs_logo.png') }}" alt="GS Logo" class="w-full h-full object-contain">
                </div>
                <div class="inline-flex items-center gap-2">
                    <span class="font-cinzel text-white font-black tracking-wider text-base uppercase">Gogan Space</span>
                    <span class="font-cinzel-decorative text-sm font-bold tracking-widest gold-text-glow uppercase">Hotels</span>
                    <span class="text-xs text-slate-400 font-semibold">&bull; Netherlands</span>
                </div>
            </div>
            <p>Curated 4-5 star luxury hospitality sanctuaries across the Netherlands.</p>
            <p class="text-[11px] text-slate-400">© {{ date('Y') }} Gogan Space. Independent demonstration project, not affiliated with featured hotels. Contact / Copyright: <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-400 underline hover:text-amber-300">andrei.gogan9@gmail.com</a></p>
        </div>
    </footer>

    <!-- Reservation Modal Component -->
    <x-reservation-modal />


</body>
</html>
