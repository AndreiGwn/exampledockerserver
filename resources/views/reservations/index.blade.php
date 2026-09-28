<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth overflow-x-hidden w-full max-w-full" style="color-scheme: dark;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <title>Reserved Sanctuaries - Gogan Space Netherlands</title>
    <meta name="description" content="View your reserved luxury 4-5 star hotels and submitted guest information with Gogan Space.">

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

                <!-- Navigation & Controls Container (Desktop Tabs + Single Music Player + Mobile Hamburger) -->
                <div class="flex items-center gap-1.5 xs:gap-2.5 sm:gap-3 shrink-0">
                    
                    <!-- Desktop Navigation Tabs (hidden on mobile, visible on md+) -->
                    <nav class="hidden md:flex items-center gap-1.5 sm:gap-3">
                        <a href="{{ route('hotels.index') }}" class="px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-xl text-xs sm:text-sm text-slate-300 hover:text-amber-400 font-medium transition flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Explore Hotels</span>
                        </a>

                        <!-- Reserved Tab (Active) -->
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-xl sm:rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-600/20 transition hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            <span>Reserved</span>
                            @if($reservations->count() > 0)
                                <span class="w-4 h-4 sm:w-5 sm:h-5 rounded-full bg-white text-amber-700 text-[10px] sm:text-[11px] font-black flex items-center justify-center shadow-inner">
                                    {{ $reservations->count() }}
                                </span>
                            @endif
                        </a>
                    </nav>

                    <!-- Single Ambient Music Player Widget (Desktop full pill, Mobile compact) -->
                    <div class="shrink-0">
                        <x-music-player />
                    </div>

                    <!-- Mobile Hamburger Menu Toggle Button (md:hidden) -->
                    <button type="button" 
                            @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="md:hidden relative p-2 xs:p-2.5 rounded-xl bg-slate-800/90 hover:bg-slate-700/90 border border-amber-500/30 hover:border-amber-400 text-amber-400 hover:text-amber-300 transition-all focus:outline-none focus:ring-2 focus:ring-amber-500/50 shadow-md flex items-center justify-center shrink-0"
                            aria-label="Toggle navigation menu">
                        @if($reservations->count() > 0)
                            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-amber-400 rounded-full animate-ping"></span>
                            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-amber-500 rounded-full border-2 border-slate-900"></span>
                        @endif

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
               class="w-full flex items-center justify-between p-3 rounded-2xl border border-amber-500/40 bg-gradient-to-r from-amber-600/30 to-amber-700/30 text-amber-300 shadow-inner transition-all group">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform border border-amber-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-white group-hover:text-amber-300 transition-colors truncate">Reserved Sanctuaries</span>
                            @if($reservations->count() > 0)
                                <span class="px-2 py-0.5 rounded-full bg-amber-500 text-white text-[10px] font-black shrink-0">{{ $reservations->count() }}</span>
                            @endif
                        </div>
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

    <!-- Main Content -->
    <main class="flex-grow py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <!-- Flash Alert -->
            @if(session('success'))
                <div class="mb-6 sm:mb-8 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-emerald-950/40 border border-emerald-800 text-emerald-300 text-xs sm:text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 sm:mb-8 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-sky-950/40 border border-sky-800 text-sky-300 text-xs sm:text-sm font-semibold">
                    {{ session('info') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 sm:mb-8 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-rose-950/40 border border-rose-800 text-rose-300 text-xs sm:text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6 pb-6 sm:pb-8 border-b border-slate-800">
                <div>
                    <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-amber-400 block mb-1">Your Booking Portfolio</span>
                    <h1 class="text-2xl sm:text-4xl font-black text-white">
                        Reserved <span class="font-serif italic font-normal text-amber-400">Sanctuaries</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 sm:mt-2 max-w-xl">
                        Here you can review your chosen hotels and the exact guest contact information you provided for your stay.
                    </p>
                </div>

                <!-- Lookup Past Reservations -->
                <form action="{{ route('reservations.lookup') }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 max-w-md w-full">
                    @csrf
                    <input type="text" name="lookup_query" placeholder="Enter Reference (e.g. GSH-...) or Email" class="flex-1 px-3.5 py-2.5 rounded-xl text-base sm:text-xs bg-slate-800 border border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none text-slate-100">
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider transition shrink-0 text-center border border-slate-700">
                        Find Booking
                    </button>
                </form>
            </div>

            <!-- List of Reservations -->
            @if($reservations->count() > 0)
                <div class="space-y-6 sm:space-y-8 mt-6 sm:mt-10">
                    @foreach($reservations as $res)
                        <div class="bg-slate-900 rounded-2xl sm:rounded-3xl p-4 sm:p-8 border border-slate-800 shadow-xl relative overflow-hidden">
                            
                            <!-- Top Info Bar: Reference Code & Status -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-4 sm:pb-6 mb-4 sm:mb-6 border-b border-slate-800">
                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                    <div class="px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-300 font-mono font-black text-xs sm:text-sm tracking-wider">
                                        {{ $res->reservation_code }}
                                    </div>
                                    <div class="flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-xl bg-emerald-950/50 text-emerald-300 text-[11px] sm:text-xs font-bold">
                                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>{{ $res->status ?: 'Confirmed & Prepared' }}</span>
                                    </div>
                                </div>
                                <div class="text-[11px] sm:text-xs text-slate-400">
                                    Reserved on {{ $res->created_at->format('M d, Y - H:i') }}
                                </div>
                            </div>

                            <!-- 2-Column Split: Chosen Hotel Info vs. Submitted Guest Information -->
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                                
                                <!-- Left Column: Chosen Hotel Information -->
                                <div class="lg:col-span-7 space-y-3 sm:space-y-4">
                                    <span class="text-[10px] sm:text-[11px] font-extrabold uppercase tracking-wider text-amber-400 block">Chosen Luxury Hotel</span>
                                    
                                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 p-3.5 sm:p-5 rounded-2xl bg-slate-800/50 border border-slate-800">
                                        <img src="{{ $res->hotel->image_url }}" alt="{{ $res->hotel->name }}" class="w-full sm:w-44 h-40 rounded-xl object-cover shadow-sm shrink-0">
                                        <div class="flex-1 space-y-1.5 sm:space-y-2">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-300 font-bold text-[10px]">
                                                    {{ $res->hotel->star_rating }} ★ Luxury Sanctuary
                                                </span>
                                                <span class="text-xs font-semibold text-slate-400">{{ $res->hotel->city }}</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-black text-white leading-snug">
                                                <a href="{{ route('hotels.show', $res->hotel->id) }}" class="hover:text-amber-400 transition">
                                                    {{ $res->hotel->name }}
                                                </a>
                                            </h3>
                                            <p class="text-xs text-slate-400 line-clamp-2">
                                                {{ $res->hotel->description }}
                                            </p>
                                            <div class="pt-2 flex flex-wrap items-center justify-between gap-2">
                                                <div>
                                                    <span class="text-xs text-slate-400">Rate:</span>
                                                    <span class="text-sm font-black text-amber-400">€{{ number_format((float)$res->hotel->price_per_night, 0) }}</span>
                                                    <span class="text-[10px] text-slate-400">/ night</span>
                                                </div>
                                                <a href="{{ route('hotels.show', $res->hotel->id) }}" class="text-xs font-bold text-amber-400 hover:text-amber-300 underline">
                                                    View Hotel Details →
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    @if($res->room)
                                        <div class="p-3 sm:p-3.5 rounded-xl bg-amber-500/5 border border-amber-500/10 text-xs flex flex-wrap items-center justify-between gap-1">
                                            <span class="text-slate-400">Reserved Suite Type:</span>
                                            <strong class="text-white">{{ $res->room->name }} ({{ $res->room->bed_type }})</strong>
                                        </div>
                                    @endif

                                    <!-- Hotel Amenities Badges -->
                                    @if($res->hotel->amenities && $res->hotel->amenities->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 sm:gap-2 pt-1">
                                            @foreach($res->hotel->amenities->take(5) as $amenity)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-lg bg-slate-800 border border-slate-700 text-[10px] sm:text-[11px] font-semibold text-slate-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    {{ $amenity->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Right Column: Information You Provided About Yourself -->
                                <div class="lg:col-span-5 space-y-3 sm:space-y-4">
                                    <span class="text-[10px] sm:text-[11px] font-extrabold uppercase tracking-wider text-slate-400 block">Your Guest Details Provided</span>
                                    
                                    <div class="p-4 sm:p-6 rounded-2xl bg-slate-800/70 border border-slate-800 space-y-3 text-xs">
                                        <div class="flex items-center justify-between pb-2 border-b border-slate-700">
                                            <span class="text-slate-400 font-medium">Guest Name</span>
                                            <strong class="text-white font-bold text-sm">{{ $res->guest_name }}</strong>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-700 gap-2">
                                            <span class="text-slate-400 font-medium shrink-0">Mail Address</span>
                                            <span class="text-slate-200 font-semibold truncate text-right">{{ $res->guest_email }}</span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-700">
                                            <span class="text-slate-400 font-medium">Phone Number</span>
                                            <span class="text-slate-200 font-semibold">{{ $res->guest_phone }}</span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-700 gap-2">
                                            <span class="text-slate-400 font-medium shrink-0">Home Address</span>
                                            <span class="text-slate-200 font-semibold text-right truncate max-w-[180px]">
                                                {{ $res->guest_address ?: 'Not provided' }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-700">
                                            <span class="text-slate-400 font-medium">Stay Dates</span>
                                            <span class="text-slate-200 font-semibold">
                                                {{ $res->check_in ? $res->check_in->format('M d, Y') : 'Flexible' }} → {{ $res->check_out ? $res->check_out->format('M d, Y') : 'Flexible' }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <span class="text-slate-400 font-medium">Guests</span>
                                            <span class="text-slate-200 font-semibold">{{ $res->guests_count }} Guest(s)</span>
                                        </div>
                                    </div>

                                    <!-- Cancellation / Support Action -->
                                    <div class="flex items-center justify-between pt-1 sm:pt-2">
                                        <form action="{{ route('reservations.destroy', $res->reservation_code) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300 underline">
                                                Cancel Reservation
                                            </button>
                                        </form>

                                        <span class="text-[10px] sm:text-[11px] text-slate-400">Concierge Desk Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-800 my-8 p-6 shadow-sm">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl sm:rounded-3xl bg-amber-500/10 text-amber-400 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-white">No active reservations yet</h3>
                    <p class="text-xs text-slate-400 mt-2 max-w-sm mx-auto">
                        Explore our handpicked collection of 4 and 5-star luxury hotels in the Netherlands and click "Reserve" to secure your stay.
                    </p>
                    <div class="mt-5 sm:mt-6">
                        <a href="{{ route('hotels.index') }}" class="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-600/25 hover:scale-105 transition">
                            <span>Explore 4-5 Star Hotels</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900/80 border-t border-slate-800 py-10 mt-auto text-center text-xs text-slate-500">
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
            <p>Curated 4 & 5-Star Sanctuaries across Amsterdam, Rotterdam, The Hague, Utrecht & Maastricht.</p>
            <p class="text-[11px] text-slate-400">© {{ date('Y') }} Gogan Space. Independent demo project, not affiliated with featured hotels. Contact / Copyright: <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-400 underline hover:text-amber-300">andrei.gogan9@gmail.com</a></p>
        </div>
    </footer>

</body>
</html>
