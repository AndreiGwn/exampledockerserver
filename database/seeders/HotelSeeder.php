<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds for hotels, rooms, amenities, and reviews.
     */
    public function run(): void
    {
        // 1. Ensure core schema tables exist
        $this->ensureTablesExist();

        // 2. Create Amenities
        $amenities = [
            ['name' => 'Free High-Speed WiFi', 'icon' => 'wifi'],
            ['name' => 'Swimming Pool', 'icon' => 'swimming-pool'],
            ['name' => 'Wellness & Spa', 'icon' => 'spa'],
            ['name' => 'Fitness Gym', 'icon' => 'dumbbell'],
            ['name' => 'Restaurant & Skybar', 'icon' => 'utensils'],
            ['name' => 'Air Conditioning', 'icon' => 'snowflake'],
            ['name' => '24/7 Room Service', 'icon' => 'concierge-bell'],
            ['name' => 'EV Charging Station', 'icon' => 'charging-station'],
            ['name' => 'Airport Shuttle', 'icon' => 'shuttle-van'],
            ['name' => 'Pet Friendly', 'icon' => 'paw'],
        ];

        $amenityIds = [];
        foreach ($amenities as $amenity) {
            $id = DB::table('amenities')->insertGetId([
                'name' => $amenity['name'],
                'icon' => $amenity['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $amenityIds[] = $id;
        }

        // 3. Create Eigenaar (Hotel Owner) Users
        $owner1Id = DB::table('users')->insertGetId([
            'name' => 'Jan de Vries',
            'email' => 'owner@kcw-hotels.nl',
            'password' => Hash::make('password'),
            'role' => 'eigenaar',
            'phone' => '+31 20 555 1234',
            'company_name' => 'Grand Dutch Hospitality B.V.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $owner2Id = DB::table('users')->insertGetId([
            'name' => 'Sophie van Dijk',
            'email' => 'eigenaar@trivago-example.com',
            'password' => Hash::make('password'),
            'role' => 'eigenaar',
            'phone' => '+31 10 444 5678',
            'company_name' => 'Boutique Collection NL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Create Curated Hotels
        $hotelsData = [
            [
                'user_id' => $owner1Id,
                'name' => 'Grand Canal Palace Hotel',
                'description' => 'Luxury 5-star canal-side residence in historic central Amsterdam. Features stunning canal views, world-class dining, and premium wellness facilities.',
                'city' => 'Amsterdam',
                'address' => 'Herengracht 380, 1016 CJ Amsterdam',
                'star_rating' => 5,
                'price_per_night' => 249.00,
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 20 888 1122',
                'email' => 'reservations@grandcanalpalace.nl',
                'is_featured' => 1,
                'amenities' => [0, 1, 2, 3, 4, 5, 6],
                'rooms' => [
                    ['name' => 'Deluxe Canal View Room', 'type' => 'Deluxe Room', 'price' => 249.00, 'capacity' => 2, 'beds' => '1 King Bed', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Executive Canal Suite', 'type' => 'Executive Suite', 'price' => 419.00, 'capacity' => 3, 'beds' => '1 Super King + 1 Sofa Bed', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Royal Penthouse Suite', 'type' => 'Presidential Suite', 'price' => 789.00, 'capacity' => 4, 'beds' => '2 King Beds', 'img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Emma Watson', 'rating' => 9.4, 'comment' => 'Exceptional service and the canal view from the balcony was breathtaking!'],
                    ['name' => 'Lars Lindqvist', 'rating' => 9.0, 'comment' => 'Top notch breakfast and prime location. Highly recommended.'],
                ],
            ],
            [
                'user_id' => $owner2Id,
                'name' => 'The Modernist Rotterdam Harbor',
                'description' => 'Architectural boutique hotel overlooking the Erasmus Bridge. Sleek contemporary interiors, skyline panoramic rooftop, and artisan dining.',
                'city' => 'Rotterdam',
                'address' => 'Wilhelminakade 120, 3072 AR Rotterdam',
                'star_rating' => 4,
                'price_per_night' => 159.00,
                'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 10 999 4433',
                'email' => 'stay@themodernist-rdam.nl',
                'is_featured' => 1,
                'amenities' => [0, 3, 4, 5, 7],
                'rooms' => [
                    ['name' => 'Skyline Panorama Room', 'type' => 'Superior Double', 'price' => 159.00, 'capacity' => 2, 'beds' => '1 Queen Bed', 'img' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Bridge View Loft', 'type' => 'Studio Suite', 'price' => 239.00, 'capacity' => 2, 'beds' => '1 King Bed', 'img' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Mark van Bergen', 'rating' => 8.8, 'comment' => 'Incredible architecture, modern vibe and fantastic cocktails on the roof.'],
                ],
            ],
            [
                'user_id' => $owner1Id,
                'name' => 'Dom Tower Heritage Inn',
                'description' => 'Charming boutique hotel located right next to the historic Dom Tower in Utrecht. Authentic historic architecture with modern luxury comforts.',
                'city' => 'Utrecht',
                'address' => 'Domplein 15, 3512 JC Utrecht',
                'star_rating' => 4,
                'price_per_night' => 135.00,
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 30 777 2211',
                'email' => 'info@domtowerhotel.nl',
                'is_featured' => 0,
                'amenities' => [0, 4, 5, 6],
                'rooms' => [
                    ['name' => 'Classic Heritage Room', 'type' => 'Standard Double', 'price' => 135.00, 'capacity' => 2, 'beds' => '1 Queen Bed', 'img' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Dom View Suite', 'type' => 'Junior Suite', 'price' => 210.00, 'capacity' => 3, 'beds' => '1 King Bed + 1 Rollaway', 'img' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Sophie Laurent', 'rating' => 9.1, 'comment' => 'Cosy, authentic and romantic hotel right in the heart of Utrecht.'],
                ],
            ],
            [
                'user_id' => $owner2Id,
                'name' => 'Royal Seaside Resort & Spa',
                'description' => 'Luxury beachfront oasis in Scheveningen, The Hague. Offering oceanfront suites, an indoor seawater spa pool, and seaside terrace.',
                'city' => 'The Hague',
                'address' => 'Gevers Deynootweg 130, 2586 CP Den Haag',
                'star_rating' => 5,
                'price_per_night' => 215.00,
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 70 333 8899',
                'email' => 'welcome@royalseaside-thehague.nl',
                'is_featured' => 1,
                'amenities' => [0, 1, 2, 3, 4, 5, 6, 7],
                'rooms' => [
                    ['name' => 'Ocean Breeze Standard', 'type' => 'Double Room', 'price' => 215.00, 'capacity' => 2, 'beds' => '1 King Bed', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Sunset Ocean Suite', 'type' => 'Ocean Suite', 'price' => 365.00, 'capacity' => 4, 'beds' => '2 Queen Beds', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Julian Davies', 'rating' => 9.5, 'comment' => 'Incredible spa facilities and sleeping with the sound of the North Sea waves.'],
                ],
            ],
            [
                'user_id' => $owner2Id,
                'name' => 'Château de Maastricht Wellness Estate',
                'description' => 'Historic castle estate nestled in the rolling hills of South Limburg. Michelin-starred restaurant, Roman baths, and vineyard trails.',
                'city' => 'Maastricht',
                'address' => 'Joseph Bechlaan 10, 6229 GR Maastricht',
                'star_rating' => 5,
                'price_per_night' => 280.00,
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 43 222 7700',
                'email' => 'concierge@chateaumaastricht.nl',
                'is_featured' => 1,
                'amenities' => [0, 1, 2, 3, 4, 5, 6, 7, 9],
                'rooms' => [
                    ['name' => 'Castle Garden Deluxe', 'type' => 'Deluxe Room', 'price' => 280.00, 'capacity' => 2, 'beds' => '1 King Bed', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Tower Knight Suite', 'type' => 'Castle Suite', 'price' => 495.00, 'capacity' => 2, 'beds' => '1 Four-Poster King Bed', 'img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Charlotte Becker', 'rating' => 9.7, 'comment' => 'Pure fairytale experience! The castle grounds and dining were unmatched.'],
                ],
            ],
            [
                'user_id' => $owner1Id,
                'name' => 'TechDistrict City Hotel',
                'description' => 'Smart eco-hotel in the heart of Eindhoven technology hub. High-speed automation, soundproof pods, and minimalist luxury.',
                'city' => 'Eindhoven',
                'address' => 'Torenallee 20, 5617 BC Eindhoven',
                'star_rating' => 3,
                'price_per_night' => 89.00,
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                'phone' => '+31 40 111 6655',
                'email' => 'hello@techdistricthotel.nl',
                'is_featured' => 0,
                'amenities' => [0, 3, 5, 7],
                'rooms' => [
                    ['name' => 'Smart Pod Single', 'type' => 'Single Pod', 'price' => 89.00, 'capacity' => 1, 'beds' => '1 Single Bed', 'img' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Tech Duo Room', 'type' => 'Standard Double', 'price' => 119.00, 'capacity' => 2, 'beds' => '1 Queen Bed', 'img' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80'],
                ],
                'reviews' => [
                    ['name' => 'Dennis Schmidt', 'rating' => 8.4, 'comment' => 'Super fast check-in, spotless clean, and perfect for business travelers.'],
                ],
            ],
        ];

        foreach ($hotelsData as $hData) {
            $hotelId = DB::table('hotels')->insertGetId([
                'user_id' => $hData['user_id'],
                'name' => $hData['name'],
                'description' => $hData['description'],
                'city' => $hData['city'],
                'address' => $hData['address'],
                'star_rating' => $hData['star_rating'],
                'price_per_night' => $hData['price_per_night'],
                'image_url' => $hData['image_url'],
                'phone' => $hData['phone'],
                'email' => $hData['email'],
                'is_featured' => $hData['is_featured'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Link Amenities
            foreach ($hData['amenities'] as $idx) {
                if (isset($amenityIds[$idx])) {
                    DB::table('hotel_amenities')->insert([
                        'hotel_id' => $hotelId,
                        'amenity_id' => $amenityIds[$idx],
                    ]);
                }
            }

            // Insert Rooms
            foreach ($hData['rooms'] as $room) {
                DB::table('rooms')->insert([
                    'hotel_id' => $hotelId,
                    'name' => $room['name'],
                    'room_type' => $room['type'],
                    'price_per_night' => $room['price'],
                    'capacity' => $room['capacity'],
                    'beds' => $room['beds'],
                    'description' => 'Comfortable and fully appointed room with premium bedding, private bathroom, and free high-speed WiFi.',
                    'image_url' => $room['img'],
                    'is_available' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Insert Reviews
            foreach ($hData['reviews'] as $rev) {
                DB::table('reviews')->insert([
                    'hotel_id' => $hotelId,
                    'reviewer_name' => $rev['name'],
                    'rating' => $rev['rating'],
                    'comment' => $rev['comment'],
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Ensure core tables exist before seeding.
     */
    private function ensureTablesExist(): void
    {
        if (! Schema::hasTable('hotels')) {
            $sqlFile = base_path('createscript.sql');
            if (file_exists($sqlFile)) {
                DB::unprepared(file_get_contents($sqlFile));
            }
        }
    }
}
