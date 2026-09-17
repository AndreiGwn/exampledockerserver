<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TrivagoHotel - Vergelijk & Vind Luxe & Voordelige Hotels</title>
    <meta name="description" content="Vergelijk en ontdek de beste hotels in Nederland. Vind de ideale kamer voor de scherpste prijs.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .hero-pattern {
            background-color: #0f172a;
            background-image: radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.12) 0px, transparent 50%),
                              radial-gradient(at 50% 50%, rgba(99, 102, 241, 0.1) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 flex flex-col min-h-screen">

    <!-- Top Navigation -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/80 dark:bg-slate-900/90 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="{{ route('hotels.index') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-rose-500 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-black tracking-tight bg-gradient-to-r from-rose-500 via-indigo-600 to-sky-500 bg-clip-text text-transparent">Trivago<span class="text-slate-900 dark:text-white font-bold">Hotel</span></span>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Vergelijk & Ontdek</span>
                    </div>
                </a>

                <!-- Right Nav / Auth Links -->
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-sm transition dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-200">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Owner Dashboard</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-slate-500 hover:text-slate-800 dark:hover:text-slate-300 px-3 py-2">
                                Uitloggen
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white px-3 py-2 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md shadow-indigo-500/20 transition hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Register</span>
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Search Section (Trivago Style) -->
    <section class="hero-pattern text-white py-12 md:py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-indigo-300 text-xs font-bold uppercase tracking-wider backdrop-blur-sm mb-4 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Honderden geverifieerde hotels & deals
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                    Vind jouw ideale hotelverblijf in <span class="bg-gradient-to-r from-sky-400 to-indigo-400 bg-clip-text text-transparent">Nederland</span>
                </h1>
                <p class="mt-4 text-base sm:text-lg text-slate-300 font-normal">
                    Vergelijk kamerprijzen, ontdek luxe suites en vind de scherpste aanbiedingen in jouw favoriete stad.
                </p>
            </div>

            <!-- Main Search Box Card -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-4 sm:p-6 shadow-2xl shadow-black/40 border border-slate-100 dark:border-slate-800 text-slate-900 dark:text-slate-100">
                <form action="{{ route('hotels.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                        <!-- Search Keyword / Name -->
                        <div class="lg:col-span-2 relative">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">
                                Bestemming of Hotelnaam
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Bijv. Canal Palace, Amsterdam..." class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-semibold placeholder:text-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <!-- City Dropdown -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">
                                Stad
                            </label>
                            <select name="city" class="w-full py-3 px-3.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-semibold text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                <option value="All">Alle Steden</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c }}" {{ request('city') === $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Star Rating Filter -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">
                                Min. Sterren
                            </label>
                            <select name="min_star" class="w-full py-3 px-3.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-semibold text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                <option value="">Elke classificatie</option>
                                <option value="5" {{ request('min_star') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Sterren)</option>
                                <option value="4" {{ request('min_star') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4+ Sterren)</option>
                                <option value="3" {{ request('min_star') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3+ Sterren)</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-end">
                            <button type="submit" class="w-full py-3 px-6 bg-gradient-to-r from-rose-500 via-indigo-600 to-indigo-700 hover:from-rose-600 hover:to-indigo-800 text-white font-bold rounded-2xl text-sm shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span>Zoek Hotels</span>
                            </button>
                        </div>
                    </div>

                    <!-- Secondary Quick Filters (Price range & Guests) -->
                    <div class="pt-3 border-t border-slate-100 dark:border-slate-800/80 flex flex-wrap items-center justify-between gap-4 text-xs">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="font-bold text-slate-500 dark:text-slate-400">Snelfilters:</span>
                            <!-- Price Range -->
                            <div class="flex items-center gap-2">
                                <span>Max Prijs:</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="€ Max" class="w-24 px-2.5 py-1.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-medium focus:ring-1 focus:ring-indigo-500">
                            </div>
                            <!-- Guests Capacity -->
                            <div class="flex items-center gap-2">
                                <span>Aantal Gasten:</span>
                                <select name="capacity" class="px-2.5 py-1.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-medium focus:ring-1 focus:ring-indigo-500">
                                    <option value="">Alle</option>
                                    <option value="1" {{ request('capacity') == '1' ? 'selected' : '' }}>1 Gast</option>
                                    <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2 Gasten</option>
                                    <option value="3" {{ request('capacity') == '3' ? 'selected' : '' }}>3+ Gasten</option>
                                    <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ Gasten (Familie)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Reset Filter -->
                        @if(request()->hasAny(['q', 'city', 'min_star', 'max_price', 'capacity']))
                            <a href="{{ route('hotels.index') }}" class="text-rose-500 hover:text-rose-600 font-semibold underline flex items-center gap-1">
                                <span>Wis alle filters</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <!-- Flash Feedback Alert -->
        <x-feedback-alert />

        <!-- Header Controls (Results count & Sorting) -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 mb-8 border-b border-slate-200 dark:border-slate-800 gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white">
                    @if(request('city') && request('city') !== 'All')
                        Hotels in {{ request('city') }}
                    @elseif(request('q'))
                        Zoekresultaten voor "{{ request('q') }}"
                    @else
                        Aanbevolen Hotels in Nederland
                    @endif
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ $totalResults }} {{ $totalResults === 1 ? 'accommodatie' : 'accommodaties' }} gevonden
                </p>
            </div>

            <!-- Sort By Selector -->
            <form action="{{ route('hotels.index') }}" method="GET" class="flex items-center gap-2">
                @foreach(request()->except('sort_by') as $key => $val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
                <label for="sort_by" class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sorteren op:</label>
                <select id="sort_by" name="sort_by" onchange="this.form.submit()" class="py-2 pl-3 pr-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500">
                    <option value="recommended" {{ request('sort_by') == 'recommended' ? 'selected' : '' }}>Aanbevolen</option>
                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Prijs (Laag naar Hoog)</option>
                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Prijs (Hoog naar Laag)</option>
                    <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Beoordeling</option>
                    <option value="stars_desc" {{ request('sort_by') == 'stars_desc' ? 'selected' : '' }}>Aantal Sterren</option>
                </select>
            </form>
        </div>

        <!-- Hotels Grid / Cards Listing -->
        @if(count($hotels) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($hotels as $hotel)
                    <article class="bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group hover:-translate-y-1">
                        <!-- Hotel Image Banner -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800">
                            <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Star Rating Badge -->
                            <div class="absolute top-3.5 left-3.5 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-full text-amber-400 text-xs font-extrabold flex items-center gap-1 shadow-sm">
                                <span>{{ str_repeat('★', $hotel->star_rating) }}</span>
                            </div>

                            <!-- Featured Badge -->
                            @if(!empty($hotel->is_featured))
                                <div class="absolute top-3.5 right-3.5 bg-gradient-to-r from-rose-500 to-pink-500 text-white text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-md">
                                    Uitgelicht
                                </div>
                            @endif

                            <!-- City Badge -->
                            <div class="absolute bottom-3.5 left-3.5 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5 shadow-sm">
                                <svg class="w-3.5 h-3.5 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $hotel->city }}</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Hotel Title & Rating Score -->
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <h3 class="font-bold text-lg text-slate-900 dark:text-white leading-snug group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                    <a href="{{ route('hotels.show', $hotel->id) }}">
                                        {{ $hotel->name }}
                                    </a>
                                </h3>
                                <div class="flex items-center gap-1 bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-100 dark:border-indigo-900 text-indigo-700 dark:text-indigo-300 px-2.5 py-1 rounded-xl text-xs font-black shrink-0">
                                    <svg class="w-3.5 h-3.5 text-indigo-500 fill-indigo-500" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span>{{ number_format((float) ($hotel->average_rating ?? 8.5), 1) }}</span>
                                </div>
                            </div>

                            <!-- Description Snippet -->
                            <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 mb-4 leading-relaxed">
                                {{ $hotel->description }}
                            </p>

                            <!-- Address Line -->
                            <p class="text-[11px] text-slate-400 dark:text-slate-500 flex items-center gap-1 mb-6">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="truncate">{{ $hotel->address }}</span>
                            </p>

                            <!-- Card Footer: Price & Action -->
                            <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-wider">Vanaf</span>
                                    <div class="text-xl font-black text-slate-900 dark:text-white">
                                        €{{ number_format((float) ($hotel->starting_price ?? $hotel->price_per_night), 0) }}
                                        <span class="text-xs font-normal text-slate-500">/ nacht</span>
                                    </div>
                                </div>
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold transition shadow-sm group-hover:bg-indigo-600">
                                    <span>Bekijk Deals</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-8">
                <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-500 dark:bg-indigo-950/60 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Geen hotels gevonden</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-md mx-auto">
                    Er zijn geen hotels die voldoen aan je huidige zoekopdracht. Probeer een andere stad of pas je filters aan.
                </p>
                <a href="{{ route('hotels.index') }}" class="inline-block mt-6 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm transition">
                    Toon alle hotels
                </a>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs py-12 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-sm">
                        T
                    </div>
                    <div>
                        <span class="text-white font-bold text-sm">TrivagoHotel Platform</span>
                        <p class="text-slate-500 text-[11px]">Powered by Laravel & FrankenPHP Container Technology</p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-slate-400 font-medium">
                    <a href="{{ route('hotels.index') }}" class="hover:text-white transition">Hotels Zoeken</a>
                    <a href="{{ route('register') }}" class="hover:text-white transition">Register</a>
                    <a href="{{ route('login') }}" class="hover:text-white transition">Login</a>
                </div>

                <div class="text-slate-500 text-center md:text-right text-[11px]">
                    &copy; {{ date('Y') }} TrivagoHotel. Gebouwd conform Kniploket Tiko Directives.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
