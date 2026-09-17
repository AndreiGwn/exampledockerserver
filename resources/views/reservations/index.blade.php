<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserved Sanctuaries - GSHotel Netherlands</title>
    <meta name="description" content="View your reserved luxury 4-5 star hotels and submitted guest information with GSHotel.">

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
            background-image: radial-gradient(at 0% 0%, rgba(212, 175, 55, 0.08) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(15, 41, 34, 0.05) 0px, transparent 50%);
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
                <nav class="flex items-center gap-3 sm:gap-6">
                    <a href="{{ route('hotels.index') }}" class="text-sm font-semibold text-slate-600 hover:text-amber-600 dark:text-slate-300 dark:hover:text-white transition flex items-center gap-2 px-3 py-2 rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Explore Hotels</span>
                    </a>

                    <!-- Reserved Tab (Active) -->
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold text-sm shadow-md shadow-amber-600/20 transition hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Reserved</span>
                        @if($reservations->count() > 0)
                            <span class="w-5 h-5 rounded-full bg-white text-amber-700 text-[11px] font-black flex items-center justify-center shadow-inner">
                                {{ $reservations->count() }}
                            </span>
                        @endif
                    </a>

                    <!-- Minimal Sound Controller in Header (Top-Right) -->
                    <div class="ml-1 sm:ml-2">
                        <x-music-player />
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Flash Alert -->
            @if(session('success'))
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-8 p-4 rounded-2xl bg-sky-50 dark:bg-sky-950/40 border border-sky-200 dark:border-sky-800 text-sky-800 dark:text-sky-300 text-sm font-semibold">
                    {{ session('info') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200 dark:border-slate-800">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400 block mb-1">Your Booking Portfolio</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white">
                        Reserved <span class="font-serif italic font-normal text-amber-700 dark:text-amber-400">Sanctuaries</span>
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-xl">
                        Here you can review your chosen hotels and the exact guest contact information you provided for your stay.
                    </p>
                </div>

                <!-- Lookup Past Reservations -->
                <form action="{{ route('reservations.lookup') }}" method="POST" class="flex items-center gap-2 max-w-md w-full">
                    @csrf
                    <input type="text" name="lookup_query" placeholder="Enter Reference (e.g. GSH-...) or Email" class="flex-1 px-4 py-2.5 rounded-xl text-xs bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider transition shrink-0">
                        Find Booking
                    </button>
                </form>
            </div>

            <!-- List of Reservations -->
            @if($reservations->count() > 0)
                <div class="space-y-8 mt-10">
                    @foreach($reservations as $res)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none relative overflow-hidden">
                            
                            <!-- Top Info Bar: Reference Code & Status -->
                            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-6 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="px-3.5 py-1.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-800 dark:text-amber-300 font-mono font-black text-sm tracking-wider">
                                        {{ $res->reservation_code }}
                                    </div>
                                    <div class="flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 text-xs font-bold">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>{{ $res->status ?: 'Confirmed & Prepared' }}</span>
                                    </div>
                                </div>
                                <div class="text-xs text-slate-400">
                                    Reserved on {{ $res->created_at->format('M d, Y - H:i') }}
                                </div>
                            </div>

                            <!-- 2-Column Split: Chosen Hotel Info vs. Submitted Guest Information -->
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                                
                                <!-- Left Column: Chosen Hotel Information -->
                                <div class="lg:col-span-7 space-y-4">
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-700 dark:text-amber-400 block">Chosen Luxury Hotel</span>
                                    
                                    <div class="flex flex-col sm:flex-row gap-5 p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                                        <img src="{{ $res->hotel->image_url }}" alt="{{ $res->hotel->name }}" class="w-full sm:w-44 h-40 rounded-xl object-cover shadow-sm shrink-0">
                                        <div class="flex-1 space-y-2">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-800 dark:text-amber-300 font-bold text-[10px]">
                                                    {{ $res->hotel->star_rating }} ★ Luxury Sanctuary
                                                </span>
                                                <span class="text-xs font-semibold text-slate-400">{{ $res->hotel->city }}</span>
                                            </div>
                                            <h3 class="text-lg font-black text-slate-900 dark:text-white leading-snug">
                                                <a href="{{ route('hotels.show', $res->hotel->id) }}" class="hover:text-amber-600 transition">
                                                    {{ $res->hotel->name }}
                                                </a>
                                            </h3>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                                                {{ $res->hotel->description }}
                                            </p>
                                            <div class="pt-2 flex items-center justify-between">
                                                <div>
                                                    <span class="text-xs text-slate-400">Rate:</span>
                                                    <span class="text-sm font-black text-amber-700 dark:text-amber-400">€{{ number_format((float)$res->hotel->price_per_night, 0) }}</span>
                                                    <span class="text-[10px] text-slate-400">/ night</span>
                                                </div>
                                                <a href="{{ route('hotels.show', $res->hotel->id) }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 underline">
                                                    View Hotel Details →
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    @if($res->room)
                                        <div class="p-3.5 rounded-xl bg-amber-500/5 border border-amber-500/10 text-xs flex items-center justify-between">
                                            <span class="text-slate-500">Reserved Suite Type:</span>
                                            <strong class="text-slate-800 dark:text-white">{{ $res->room->name }} ({{ $res->room->bed_type }})</strong>
                                        </div>
                                    @endif

                                    <!-- Hotel Amenities Badges -->
                                    @if($res->hotel->amenities && $res->hotel->amenities->count() > 0)
                                        <div class="flex flex-wrap gap-2 pt-1">
                                            @foreach($res->hotel->amenities->take(5) as $amenity)
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700 text-[11px] font-semibold text-slate-600 dark:text-slate-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    {{ $amenity->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Right Column: Information You Provided About Yourself -->
                                <div class="lg:col-span-5 space-y-4">
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400 block">Your Guest Details Provided</span>
                                    
                                    <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/70 border border-slate-200/80 dark:border-slate-800 space-y-3.5 text-xs">
                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                            <span class="text-slate-400 font-medium">Guest Name</span>
                                            <strong class="text-slate-900 dark:text-white font-bold text-sm">{{ $res->guest_name }}</strong>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                            <span class="text-slate-400 font-medium">Mail Address</span>
                                            <span class="text-slate-800 dark:text-slate-200 font-semibold">{{ $res->guest_email }}</span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                            <span class="text-slate-400 font-medium">Phone Number</span>
                                            <span class="text-slate-800 dark:text-slate-200 font-semibold">{{ $res->guest_phone }}</span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                            <span class="text-slate-400 font-medium">Home Address</span>
                                            <span class="text-slate-800 dark:text-slate-200 font-semibold text-right max-w-[200px] truncate">
                                                {{ $res->guest_address ?: 'Not provided' }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between pb-2 border-b border-slate-200/60 dark:border-slate-700">
                                            <span class="text-slate-400 font-medium">Stay Dates</span>
                                            <span class="text-slate-800 dark:text-slate-200 font-semibold">
                                                {{ $res->check_in ? $res->check_in->format('M d, Y') : 'Flexible' }} → {{ $res->check_out ? $res->check_out->format('M d, Y') : 'Flexible' }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <span class="text-slate-400 font-medium">Guests</span>
                                            <span class="text-slate-800 dark:text-slate-200 font-semibold">{{ $res->guests_count }} Guest(s)</span>
                                        </div>
                                    </div>

                                    <!-- Cancellation / Support Action -->
                                    <div class="flex items-center justify-between pt-2">
                                        <form action="{{ route('reservations.destroy', $res->reservation_code) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-500 hover:text-rose-700 underline">
                                                Cancel Reservation
                                            </button>
                                        </form>

                                        <span class="text-[11px] text-slate-400">Concierge Desk Available 24/7</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800 my-10 p-8 shadow-sm">
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
                        <a href="{{ route('hotels.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-600/25 hover:scale-105 transition">
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
    <footer class="bg-white/80 dark:bg-slate-900/80 border-t border-slate-200/80 dark:border-slate-800 py-10 mt-16 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <div class="font-serif italic font-bold text-slate-800 dark:text-slate-200 text-base">Gogan Space (GSHotel) Luxury Hospitality</div>
            <p>Curated 4 & 5-Star Sanctuaries across Amsterdam, Rotterdam, The Hague, Utrecht & Maastricht.</p>
            <p class="text-[11px] text-slate-400">© {{ date('Y') }} Gogan Space. Independent demo project, not affiliated with featured hotels. Contact / Copyright: <a href="mailto:andrei.gogan9@gmail.com" class="text-amber-600 dark:text-amber-400 underline hover:text-amber-500">andrei.gogan9@gmail.com</a></p>
        </div>
    </footer>

</body>
</html>
