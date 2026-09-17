<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSHotel - Curated 4 & 5 Star Luxury Sanctuaries in the Netherlands</title>
    <meta name="description" content="Discover peaceful, high-end 4 and 5-star hotels and wellness resorts in the Netherlands. Reserve your serene stay instantly with GSHotel.">

    <!-- Favicon / URL Tab Logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/gs_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/gs_logo.png') }}">

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
                radial-gradient(at 0% 0%, rgba(212, 175, 55, 0.18) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.10) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.7) 0px, transparent 80%);
        }
        .bg-serene {
            background-color: #faf8f5;
            background-image: radial-gradient(at 0% 0%, rgba(212, 175, 55, 0.05) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(15, 41, 34, 0.04) 0px, transparent 50%);
        }
        .gold-glow {
            box-shadow: 0 0 50px -10px rgba(212, 175, 55, 0.35);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="gshotelApp()" x-init="initApp()" class="bg-serene text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 flex flex-col min-h-screen relative overflow-x-hidden">

    <!-- ========================================================================= -->
    <!-- 1. FULLSCREEN WELCOME INTRO SCREEN WITH CHILL TRANSITION                  -->
    <!-- ========================================================================= -->
    <div x-show="showWelcome" 
         x-transition:leave="transition ease-out duration-700 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-8 scale-95 pointer-events-none"
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950 text-white overflow-hidden p-6">
        
        <!-- Ambient Background Shimmers -->
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-amber-500/15 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute -bottom-40 -right-40 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-duration: 10s;"></div>

        <div class="relative z-10 max-w-2xl text-center space-y-8 py-10">
            
            <div class="inline-block group">
                <div class="w-44 h-44 sm:w-56 sm:h-56 mx-auto rounded-3xl overflow-hidden gold-glow border-2 border-amber-500/50 shadow-2xl transition-all duration-500 group-hover:scale-105 p-1 bg-slate-900/60 backdrop-blur-sm">
                    <img src="/images/gs_logo.png" alt="Gogan Space Luxury Logo" class="w-full h-full object-contain rounded-2xl">
                </div>
            </div>

            <!-- Minimalist Luxury Subtitle -->
            <div class="space-y-2">
                <p class="text-sm sm:text-base text-slate-300 max-w-lg mx-auto font-normal leading-relaxed">
                    Curated 4 & 5-star palace hotels, canal estates, and private wellness sanctuaries across the Netherlands.
                </p>
            </div>

            <!-- Chill Action Button: Let's find hotels -->
            <div class="pt-4 space-y-4">
                <button type="button" 
                        @click="enterSanctuary()"
                        class="group inline-flex items-center gap-3 px-10 py-5 rounded-3xl bg-gradient-to-r from-amber-600 via-amber-500 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm uppercase tracking-widest shadow-2xl shadow-amber-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                    <span>Let's find hotels</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>

                <div class="flex items-center justify-center gap-2 text-xs text-slate-400">
                    <svg class="w-4 h-4 text-amber-400 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    <span>Clicking starts our soothing ambient soundscape</span>
                </div>
            </div>

            <!-- Disclaimer & Copyright Contact Note -->
            <div class="pt-6 border-t border-slate-800/80 max-w-xl mx-auto">
                <div class="bg-slate-900/70 backdrop-blur-md rounded-2xl p-4 border border-slate-800/90 text-left text-xs text-slate-400 leading-relaxed shadow-lg flex items-start gap-3">
                    <div class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-200">Notice:</span>
                        <span>This platform is an independent demonstration project and is not affiliated with or endorsed by any featured hotel establishments. For inquiries, copyright notices, or content removal requests, please email:</span>
                        <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-400 hover:text-amber-300 font-semibold underline underline-offset-2 transition ml-1">andrei.gogan9@gmail.com</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. STICKY LUXURY NAVIGATION                                               -->
    <!-- ========================================================================= -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-amber-500/10 dark:bg-slate-900/90 dark:border-slate-800 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo (Clicking returns to explore or welcome) -->
                <div class="flex items-center gap-3.5 cursor-pointer group" @click="switchTab('explore')">
                    <div class="w-12 h-12 rounded-2xl overflow-hidden shadow-md shadow-amber-600/20 group-hover:scale-105 transition-transform duration-300 border border-amber-500/40 bg-slate-950 p-1 flex items-center justify-center flex-shrink-0">
                        <img src="/images/gs_logo.png" alt="Gogan Space GS Logo" class="w-full h-full object-contain rounded-xl">
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-xl sm:text-2xl font-bold tracking-tight font-serif text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors leading-tight">
                            Gogan Space
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.22em] text-amber-600 dark:text-amber-400 leading-none mt-1">
                            Hotels &bull; Netherlands
                        </span>
                    </div>
                </div>

                <!-- Navigation Tabs (SPA Navigation Without Reloading Audio) -->
                <nav class="flex items-center gap-2 sm:gap-4">
                    
                    <!-- Welcome Screen Replay -->
                    <button type="button" @click="showWelcome = true" class="hidden md:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-slate-800 transition">
                        <span>Intro</span>
                    </button>

                    <!-- Explore Hotels Tab -->
                    <button type="button" 
                            @click="switchTab('explore')" 
                            :class="activeTab === 'explore' ? 'bg-amber-500/15 text-amber-700 dark:text-amber-300 font-bold' : 'text-slate-600 hover:text-amber-600 dark:text-slate-300 font-medium'"
                            class="px-4 py-2.5 rounded-xl text-sm transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>Explore Hotels</span>
                    </button>

                    <!-- Reserved Tab (Dynamic Count Badge) -->
                    <button type="button" 
                            @click="switchTab('reserved')" 
                            :class="activeTab === 'reserved' ? 'bg-gradient-to-r from-amber-600 to-amber-700 text-white font-black shadow-md shadow-amber-600/25' : 'bg-slate-900 hover:bg-slate-800 text-white dark:bg-slate-800 dark:hover:bg-slate-700 font-bold'"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-sm transition hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Reserved</span>
                        <span x-show="reservations.length > 0" class="w-5 h-5 rounded-full bg-amber-500 text-white text-[11px] font-black flex items-center justify-center shadow-inner" x-text="reservations.length"></span>
                    </button>

                    <!-- Minimal Sound Controller in Header (Top-Right) -->
                    <div class="ml-1 sm:ml-2">
                        <x-music-player />
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- 3. TAB VIEW 1: EXPLORE 4-5 STAR HOTELS GRID & FILTER SEARCH              -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'explore'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="flex-grow flex flex-col">

        <!-- Hero Search Section -->
        <section class="hero-luxury text-white py-14 md:py-20 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-widest mb-4">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Curated 4 & 5-Star Sanctuaries Across The Netherlands</span>
                </div>

                <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight max-w-4xl mx-auto">
                    Find Your Perfect Dutch <span class="font-serif italic font-normal text-amber-300">Sanctuary</span>
                </h2>

                <!-- Live Client-Side Filter Bar -->
                <div class="mt-8 max-w-5xl mx-auto bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-3xl p-4 sm:p-6 shadow-2xl border border-white/20 text-slate-900 dark:text-slate-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 items-center">
                        
                        <!-- Search Keyword -->
                        <div class="text-left">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Sanctuary or Keyword</label>
                            <input type="text" x-model="searchQuery" placeholder="Search by name, spa, city..." class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>

                        <!-- City Filter -->
                        <div class="text-left">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">City</label>
                            <select x-model="selectedCity" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                                <option value="">All Dutch Cities</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Star Rating Filter -->
                        <div class="text-left">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Luxury Rating</label>
                            <select x-model="selectedStars" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                                <option value="">4 & 5 Stars</option>
                                <option value="5">5-Star Luxury Only</option>
                                <option value="4">4-Star & Above</option>
                            </select>
                        </div>

                        <!-- Sort Order -->
                        <div class="text-left">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Sort By</label>
                            <select x-model="sortBy" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                                <option value="recommended">Curated Recommended</option>
                                <option value="rating">Highest Guest Rating</option>
                                <option value="price_low">Price: Low to High</option>
                                <option value="price_high">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hotels Discovery Grid -->
        <main class="flex-grow py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Exclusive Portfolio</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">Dutch 4 & 5-Star Sanctuaries</h3>
                    </div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">
                        Showing <strong class="text-slate-900 dark:text-white" x-text="filteredHotels.length"></strong> luxury properties
                    </div>
                </div>

                <!-- Dynamic Hotel Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                    <template x-for="hotel in filteredHotels" :key="hotel.id">
                        <div class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col hover:-translate-y-1">
                            
                            <!-- Hotel Image & Badges -->
                            <div class="relative h-64 overflow-hidden cursor-pointer" @click="viewHotelDetails(hotel)">
                                <img :src="hotel.image_url" :alt="hotel.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-black/20"></div>

                                <!-- Star Badge & Score -->
                                <div class="absolute top-4 left-4 flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-amber-700 dark:text-amber-400 font-black text-xs shadow-md" x-text="hotel.star_rating + ' ★ Luxury'"></span>
                                </div>

                                <div class="absolute top-4 right-4">
                                    <span class="px-2.5 py-1 rounded-xl bg-emerald-600/90 text-white font-black text-xs shadow-md" x-text="'★ ' + hotel.rating_score"></span>
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-300 block mb-0.5" x-text="hotel.city"></span>
                                    <h4 class="text-lg font-black leading-tight drop-shadow-sm truncate" x-text="hotel.name"></h4>
                                </div>
                            </div>

                            <!-- Card Details & Actions -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-3 leading-relaxed" x-text="hotel.description"></p>

                                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3">
                                    <div>
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold block">From</span>
                                        <div class="text-lg font-black text-slate-900 dark:text-white">
                                            €<span x-text="Math.round(hotel.price_per_night)"></span>
                                            <span class="text-[10px] text-slate-400 font-normal">/ night</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="viewHotelDetails(hotel)" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold transition">
                                            Details
                                        </button>

                                        <button type="button" 
                                                @click="openReservationModal(hotel)"
                                                class="px-4 py-2 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white text-xs font-black tracking-wider uppercase shadow-md shadow-amber-600/20 transition hover:scale-105 active:scale-95">
                                            Reserve
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="filteredHotels.length === 0" class="text-center py-20 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 my-10 p-8">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">No luxury hotels match your filter</h3>
                    <p class="text-xs text-slate-500 mt-2">Try clearing your search query or selecting all Dutch cities.</p>
                </div>

            </div>
        </main>
    </div>

    <!-- ========================================================================= -->
    <!-- 4. TAB VIEW 2: HOTEL SANCTUARY DETAILS VIEW (SPA MODE)                    -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'details'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="flex-grow py-10" 
         x-cloak>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10" x-show="selectedHotel">
            
            <!-- Back to Hotels Button -->
            <div>
                <button type="button" @click="switchTab('explore')" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-amber-600 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Back to all sanctuaries</span>
                </button>
            </div>

            <!-- Hero Photography Banner -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[400px] sm:h-[480px]">
                <img :src="selectedHotel?.image_url" :alt="selectedHotel?.name" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-black/20"></div>

                <div class="absolute bottom-8 left-8 right-8 text-white flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="px-3.5 py-1 rounded-full bg-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg" x-text="selectedHotel?.star_rating + ' ★ Luxury Sanctuary'"></span>
                            <span class="text-sm font-semibold text-amber-200" x-text="selectedHotel?.city + ', Netherlands'"></span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight" x-text="selectedHotel?.name"></h1>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-2xl" x-text="selectedHotel?.address"></p>
                    </div>

                    <div class="shrink-0">
                        <button type="button" 
                                @click="openReservationModal(selectedHotel)"
                                class="px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm uppercase tracking-wider shadow-2xl shadow-amber-600/40 transition hover:scale-105 active:scale-95">
                            Reserve Your Stay
                        </button>
                    </div>
                </div>
            </div>

            <!-- Details Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-8 space-y-10">
                    
                    <!-- Overview -->
                    <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">The Experience</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white">About this Sanctuary</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed" x-text="selectedHotel?.description"></p>
                    </section>

                    <!-- Amenities -->
                    <template x-if="selectedHotel?.amenities && selectedHotel.amenities.length > 0">
                        <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Curated Comforts</span>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white">Signature Amenities & Wellness</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <template x-for="amenity in selectedHotel.amenities" :key="amenity.id">
                                    <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                        <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-sm">✓</div>
                                        <span class="text-xs font-bold text-slate-800 dark:text-slate-200" x-text="amenity.name"></span>
                                    </div>
                                </template>
                            </div>
                        </section>
                    </template>

                    <!-- Available Suites -->
                    <template x-if="selectedHotel?.rooms && selectedHotel.rooms.length > 0">
                        <section class="bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-6">
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">Accommodations</span>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white">Available Suites & Rooms</h3>
                            <div class="space-y-6">
                                <template x-for="room in selectedHotel.rooms" :key="room.id">
                                    <div class="flex flex-col sm:flex-row gap-6 p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 items-center justify-between">
                                        <img :src="room.image_url || selectedHotel.image_url" :alt="room.name" class="w-full sm:w-44 h-36 rounded-xl object-cover shadow-sm shrink-0">
                                        <div class="flex-1 space-y-2 text-left w-full">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-0.5 rounded-md bg-amber-500/10 text-amber-700 dark:text-amber-300 font-bold text-[10px] uppercase" x-text="room.room_type"></span>
                                                <span class="text-xs text-slate-400" x-text="'Max ' + room.max_guests + ' Guests'"></span>
                                            </div>
                                            <h4 class="text-lg font-black text-slate-900 dark:text-white" x-text="room.name"></h4>
                                            <p class="text-xs text-slate-500 dark:text-slate-400" x-text="room.description"></p>
                                            <div class="text-xs text-slate-600 dark:text-slate-300 font-semibold">
                                                Bedding: <span class="text-amber-700 dark:text-amber-400" x-text="room.bed_type"></span>
                                            </div>
                                        </div>
                                        <div class="text-right shrink-0 w-full sm:w-auto pt-4 sm:pt-0 border-t sm:border-t-0 border-slate-200 dark:border-slate-700 flex sm:flex-col items-center sm:items-end justify-between gap-3">
                                            <div>
                                                <div class="text-xl font-black text-slate-900 dark:text-white">
                                                    €<span x-text="Math.round(room.price_per_night)"></span>
                                                </div>
                                                <span class="text-[10px] text-slate-400">per night</span>
                                            </div>
                                            <button type="button" 
                                                    @click="openReservationModal(selectedHotel, room)"
                                                    class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-black uppercase tracking-wider shadow-md transition hover:scale-105 active:scale-95">
                                                Reserve Suite
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </section>
                    </template>
                </div>

                <!-- Right Sticky Concierge Card -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="sticky top-28 bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/30 dark:shadow-none space-y-6">
                        <div class="text-center pb-6 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-xs text-slate-400 uppercase tracking-widest font-bold">Rates From</span>
                            <div class="text-3xl font-black text-amber-700 dark:text-amber-400 mt-1">
                                €<span x-text="Math.round(selectedHotel?.price_per_night || 0)"></span>
                                <span class="text-xs text-slate-400 font-normal">/ night</span>
                            </div>
                        </div>

                        <button type="button" 
                                @click="openReservationModal(selectedHotel)"
                                class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm uppercase tracking-wider shadow-xl shadow-amber-600/30 transition hover:scale-[1.02] active:scale-[0.98] text-center">
                            Reserve Now
                        </button>

                        <div class="space-y-3 text-xs text-slate-600 dark:text-slate-400 pt-2">
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>No login needed — instant booking</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>Continuous relaxing ambient sound</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-amber-600">✓</span>
                                <span>Direct access on "Reserved" tab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 5. TAB VIEW 3: "RESERVED" TAB VIEW (SPA MODE)                             -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'reserved'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="flex-grow py-12" 
         x-cloak>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200 dark:border-slate-800">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400 block mb-1">Your Booking Portfolio</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white">
                        Reserved <span class="font-serif italic font-normal text-amber-700 dark:text-amber-400">Sanctuaries</span>
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-xl">
                        Review your chosen hotels and the exact guest contact information you provided for your stay.
                    </p>
                </div>

                <!-- Booking Lookup Form (AJAX without reloading music) -->
                <form @submit.prevent="lookupReservation()" class="flex items-center gap-2 max-w-md w-full">
                    <input type="text" x-model="lookupQuery" placeholder="Enter Reference (e.g. GSH-...) or Email" class="flex-1 px-4 py-2.5 rounded-xl text-xs bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider transition shrink-0">
                        Find Booking
                    </button>
                </form>
            </div>

            <!-- List of Reservations -->
            <div x-show="reservations.length > 0" class="space-y-8 mt-10">
                <template x-for="res in reservations" :key="res.reservation_code">
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none relative overflow-hidden">
                        
                        <!-- Top Info Bar: Reference Code & Status -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-6 border-b border-slate-100 dark:border-slate-800">
                            <div class="flex items-center gap-3">
                                <div class="px-3.5 py-1.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-800 dark:text-amber-300 font-mono font-black text-sm tracking-wider" x-text="res.reservation_code"></div>
                                <div class="flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span x-text="res.status || 'Confirmed & Prepared'"></span>
                                </div>
                            </div>
                            <div class="text-xs text-slate-400" x-text="'Booked for ' + (res.check_in || 'Flexible Dates')"></div>
                        </div>

                        <!-- 2-Column Split: Chosen Hotel Info vs. Submitted Guest Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                            
                            <!-- Left Column: Chosen Hotel Information -->
                            <div class="lg:col-span-7 space-y-4">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-700 dark:text-amber-400 block">Chosen Luxury Hotel</span>
                                
                                <div class="flex flex-col sm:flex-row gap-5 p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                                    <img :src="res.hotel?.image_url" :alt="res.hotel?.name" class="w-full sm:w-44 h-40 rounded-xl object-cover shadow-sm shrink-0">
                                    <div class="flex-1 space-y-2">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-800 dark:text-amber-300 font-bold text-[10px]" x-text="(res.hotel?.star_rating || 5) + ' ★ Luxury Sanctuary'"></span>
                                            <span class="text-xs font-semibold text-slate-400" x-text="res.hotel?.city"></span>
                                        </div>
                                        <h4 class="text-lg font-black text-slate-900 dark:text-white leading-snug cursor-pointer hover:text-amber-600 transition" @click="viewHotelDetails(res.hotel)" x-text="res.hotel?.name"></h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2" x-text="res.hotel?.description"></p>
                                        <div class="pt-2 flex items-center justify-between">
                                            <div>
                                                <span class="text-xs text-slate-400">Rate:</span>
                                                <span class="text-sm font-black text-amber-700 dark:text-amber-400" x-text="'€' + Math.round(res.hotel?.price_per_night || 0)"></span>
                                                <span class="text-[10px] text-slate-400">/ night</span>
                                            </div>
                                            <button type="button" @click="viewHotelDetails(res.hotel)" class="text-xs font-bold text-amber-600 hover:text-amber-700 underline">
                                                View Hotel Details →
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <template x-if="res.room">
                                    <div class="p-3.5 rounded-xl bg-amber-500/5 border border-amber-500/10 text-xs flex items-center justify-between">
                                        <span class="text-slate-500">Reserved Suite:</span>
                                        <strong class="text-slate-800 dark:text-white" x-text="res.room.name + ' (' + res.room.bed_type + ')'"></strong>
                                    </div>
                                </template>
                            </div>

                            <!-- Right Column: Information You Provided About Yourself -->
                            <div class="lg:col-span-5 space-y-4">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400 block">Your Guest Details Provided</span>
                                
                                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/70 border border-slate-200/80 dark:border-slate-800 space-y-3.5 text-xs">
                                    <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                        <span class="text-slate-400 font-medium">Guest Name</span>
                                        <strong class="text-slate-900 dark:text-white font-bold text-sm" x-text="res.guest_name"></strong>
                                    </div>

                                    <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                        <span class="text-slate-400 font-medium">Mail Address</span>
                                        <span class="text-slate-800 dark:text-slate-200 font-semibold" x-text="res.guest_email"></span>
                                    </div>

                                    <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                        <span class="text-slate-400 font-medium">Phone Number</span>
                                        <span class="text-slate-800 dark:text-slate-200 font-semibold" x-text="res.guest_phone"></span>
                                    </div>

                                    <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                        <span class="text-slate-400 font-medium">Home Address</span>
                                        <span class="text-slate-800 dark:text-slate-200 font-semibold text-right max-w-[200px] truncate" x-text="res.guest_address || 'Not provided'"></span>
                                    </div>

                                    <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                        <span class="text-slate-400 font-medium">Stay Dates</span>
                                        <span class="text-slate-800 dark:text-slate-200 font-semibold" x-text="(res.check_in || 'Tomorrow') + ' → ' + (res.check_out || '+3 days')"></span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 font-medium">Guests</span>
                                        <span class="text-slate-800 dark:text-slate-200 font-semibold" x-text="(res.guests_count || 2) + ' Guest(s)'"></span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-2">
                                    <button type="button" @click="cancelReservation(res.reservation_code)" class="text-xs font-semibold text-rose-500 hover:text-rose-700 underline">
                                        Cancel Reservation
                                    </button>
                                    <span class="text-[11px] text-slate-400">Concierge Desk Active</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </template>
            </div>

            <!-- Empty State for Reserved Tab -->
            <div x-show="reservations.length === 0" class="text-center py-20 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 my-10 p-8 shadow-sm">
                <div class="w-16 h-16 rounded-3xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white">No active reservations yet</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 max-w-sm mx-auto">
                    Explore our handpicked collection of 4 and 5-star luxury hotels in the Netherlands and click "Reserve" to secure your stay.
                </p>
                <div class="mt-6">
                    <button type="button" @click="switchTab('explore')" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-600/25 hover:scale-105 transition">
                        <span>Explore 4-5 Star Hotels</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 6. GLOBAL LUXURY FOOTER                                                   -->
    <!-- ========================================================================= -->
    <footer class="bg-white/80 dark:bg-slate-900/80 border-t border-slate-200/80 dark:border-slate-800 py-12 mt-auto text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-3">
            <div class="flex items-center justify-center gap-2.5">
                <div class="w-7 h-7 rounded-lg overflow-hidden border border-amber-500/30 inline-block align-middle">
                    <img src="/images/gs_logo.png" alt="GS Logo" class="w-full h-full object-cover">
                </div>
                <span class="text-slate-900 dark:text-white font-bold text-base">Gogan Space (GSHotel) Netherlands</span>
            </div>
            <p>Peaceful, handpicked 4 and 5-star hotel sanctuaries across Amsterdam, Rotterdam, The Hague, Utrecht, Maastricht and Eindhoven.</p>
            <p class="text-[11px] text-slate-400">© {{ date('Y') }} Gogan Space. Independent demo project, not affiliated with featured hotel brands. Copyright / inquiries: <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-600 dark:text-amber-400 underline hover:text-amber-500">andrei.gogan9@gmail.com</a></p>
        </div>
    </footer>

    <!-- Luxury Reservation Modal Component -->
    <x-reservation-modal />


    <!-- ========================================================================= -->
    <!-- 7. ALPINE.JS APP LOGIC FOR SEAMLESS SPA NAVIGATION & DATA SYNC            -->
    <!-- ========================================================================= -->
    <script>
    function gshotelApp() {
        return {
            showWelcome: {{ session()->has('guest_reservations') || ($initialTab !== 'explore') ? 'false' : 'true' }},
            activeTab: '{{ $initialTab ?? "explore" }}',
            allHotels: @json($hotels),
            reservations: @json($reservations),
            selectedHotel: null,
            searchQuery: '',
            selectedCity: '',
            selectedStars: '',
            sortBy: 'recommended',
            lookupQuery: '',

            initApp() {
                const initialHotelId = {{ $initialHotelId ?? 'null' }};
                if (initialHotelId) {
                    const found = this.allHotels.find(h => h.id === initialHotelId);
                    if (found) {
                        this.selectedHotel = found;
                        this.activeTab = 'details';
                        this.showWelcome = false;
                    }
                }

                // Handle custom reservation created event from modal
                window.addEventListener('reservation-created', (e) => {
                    const newRes = e.detail;
                    if (newRes) {
                        // Prepend new reservation to reactive array
                        this.reservations.unshift(newRes);
                    }
                });
            },

            enterSanctuary() {
                this.showWelcome = false;
                this.activeTab = 'explore';

                // Automatically trigger ambient music playback on user's button press
                window.dispatchEvent(new CustomEvent('start-gshotel-music'));
            },

            switchTab(tab) {
                this.activeTab = tab;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            viewHotelDetails(hotel) {
                this.selectedHotel = hotel;
                this.activeTab = 'details';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            openReservationModal(hotel, room = null) {
                const modalData = {
                    id: hotel.id,
                    room_id: room ? room.id : null,
                    name: room ? (hotel.name + ' - ' + room.name) : hotel.name,
                    city: hotel.city,
                    star_rating: hotel.star_rating,
                    price_per_night: room ? room.price_per_night : hotel.price_per_night,
                    image_url: room && room.image_url ? room.image_url : hotel.image_url,
                };
                window.dispatchEvent(new CustomEvent('open-reserve-modal', { detail: modalData }));
            },

            get filteredHotels() {
                let results = [...this.allHotels];

                if (this.selectedCity) {
                    results = results.filter(h => h.city.toLowerCase() === this.selectedCity.toLowerCase());
                }

                if (this.selectedStars) {
                    results = results.filter(h => Number(h.star_rating) >= Number(this.selectedStars));
                }

                if (this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase();
                    results = results.filter(h => 
                        h.name.toLowerCase().includes(q) || 
                        h.city.toLowerCase().includes(q) || 
                        (h.description && h.description.toLowerCase().includes(q))
                    );
                }

                if (this.sortBy === 'price_low') {
                    results.sort((a, b) => Number(a.price_per_night) - Number(b.price_per_night));
                } else if (this.sortBy === 'price_high') {
                    results.sort((a, b) => Number(b.price_per_night) - Number(a.price_per_night));
                } else if (this.sortBy === 'rating') {
                    results.sort((a, b) => Number(b.rating_score) - Number(a.rating_score));
                }

                return results;
            },

            lookupReservation() {
                if (!this.lookupQuery.trim()) return;

                fetch('{{ route("reservations.lookup") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ lookup_query: this.lookupQuery })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success && data.reservations) {
                        data.reservations.forEach(r => {
                            if (!this.reservations.some(existing => existing.reservation_code === r.reservation_code)) {
                                this.reservations.unshift(r);
                            }
                        });
                        alert('Found ' + data.reservations.length + ' reservation(s)!');
                        this.lookupQuery = '';
                    } else {
                        alert(data.message || 'No reservations found.');
                    }
                });
            },

            cancelReservation(code) {
                if (!confirm('Are you sure you want to cancel reservation ' + code + '?')) return;

                fetch('/reserved/' + encodeURIComponent(code), {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.reservations = this.reservations.filter(r => r.reservation_code !== code);
                    } else {
                        alert(data.message || 'Could not cancel reservation.');
                    }
                });
            }
        };
    }
    </script>

</body>
</html>
