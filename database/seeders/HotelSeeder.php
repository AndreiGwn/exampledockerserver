<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds for GSHotel 4-5 star luxury hotels in the Netherlands.
     */
    public function run(): void
    {
        // 1. Ensure core schema tables exist
        $this->ensureTablesExist();

        // 2. Create Luxury Amenities
        $amenityData = [
            ['name' => 'Signature Wellness & Spa', 'icon' => 'spa'],
            ['name' => 'Indoor Heated Pool & Jacuzzi', 'icon' => 'swimming-pool'],
            ['name' => 'Michelin-Star Gastronomy', 'icon' => 'utensils'],
            ['name' => 'Panoramic Canal Views', 'icon' => 'water'],
            ['name' => '24/7 Private Concierge', 'icon' => 'concierge-bell'],
            ['name' => 'High-Speed Fiber WiFi', 'icon' => 'wifi'],
            ['name' => 'Chauffeured Valet Service', 'icon' => 'car'],
            ['name' => 'Serene Garden & Courtyard', 'icon' => 'leaf'],
            ['name' => 'Rooftop Champagne Lounge', 'icon' => 'glass-cheers'],
            ['name' => 'Bespoke In-Room Aromatherapy', 'icon' => 'wind'],
        ];

        $amenities = [];
        foreach ($amenityData as $a) {
            $amenity = Amenity::updateOrCreate(['name' => $a['name']], [
                'icon' => $a['icon'],
            ]);
            $amenities[] = $amenity;
        }

        // 3. Curated 4-5 Star Dutch Luxury Hotels
        $hotelsData = [
            [
                'name' => 'Conservatorium Hotel Amsterdam',
                'city' => 'Amsterdam',
                'address' => 'Paulus Potterstraat 50, 1071 DB Amsterdam',
                'star_rating' => 5,
                'price_per_night' => 385.00,
                'rating_score' => 4.9,
                'featured' => true,
                'phone' => '+31 20 570 0000',
                'email' => 'experience@conservatoriumhotel.com',
                'description' => 'A masterpiece of contemporary architectural elegance in the heart of Amsterdam\'s Museum Square. Offering the world-renowned Akasha Holistic Wellbeing Centre, peaceful inner atriums, and refined dining.',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 1, 2, 4, 5, 6, 7, 9],
                'rooms' => [
                    [
                        'name' => 'Grand Deluxe Suite',
                        'room_type' => 'Executive Suite',
                        'price_per_night' => 385.00,
                        'max_guests' => 2,
                        'bed_type' => 'Custom King Bed',
                        'description' => 'Spacious sanctuary with soaring ceilings, marble soaking bathtub, and views of the historic museum district.',
                        'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
                    ],
                    [
                        'name' => 'Heritage Duplex Suite',
                        'room_type' => 'Duplex Penthouse',
                        'price_per_night' => 620.00,
                        'max_guests' => 3,
                        'bed_type' => '1 Super King + Daybed',
                        'description' => 'Two-floor luxury suite with private terrace, integrated sound system, and dedicated butler service.',
                        'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'Hotel Des Indes The Hague',
                'city' => 'The Hague',
                'address' => 'Lange Voorhout 54, 2514 EG Den Haag',
                'star_rating' => 5,
                'price_per_night' => 295.00,
                'rating_score' => 4.9,
                'featured' => true,
                'phone' => '+31 70 361 2345',
                'email' => 'reservations@desindes.com',
                'description' => 'A legendary 5-star palace hotel steeped in royal heritage on the tree-lined Lange Voorhout. Experience classical grandeur, bespoke afternoon tea, and pure serene luxury.',
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 2, 4, 5, 6, 7, 8],
                'rooms' => [
                    [
                        'name' => 'Royal Classic Room',
                        'room_type' => 'Deluxe King',
                        'price_per_night' => 295.00,
                        'max_guests' => 2,
                        'bed_type' => 'Royal Plush King',
                        'description' => 'Exquisitely decorated with ornate draperies, crystal chandeliers, and peaceful garden views.',
                        'image_url' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=800&q=80',
                    ],
                    [
                        'name' => 'Baron von Brienen Suite',
                        'room_type' => 'Palace Suite',
                        'price_per_night' => 540.00,
                        'max_guests' => 3,
                        'bed_type' => 'Emperor Bed',
                        'description' => 'Magnificent parlor suite with authentic antique furnishings, private dining salon, and deep spa bath.',
                        'image_url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'Grand Hotel Karel V Utrecht',
                'city' => 'Utrecht',
                'address' => 'Geertebolwerk 1, 3511 XA Utrecht',
                'star_rating' => 5,
                'price_per_night' => 245.00,
                'rating_score' => 4.8,
                'featured' => true,
                'phone' => '+31 30 233 7555',
                'email' => 'hospitality@karelv.nl',
                'description' => 'An urban oasis of 10,000 m² of monumental historic gardens, former medieval monastery, Roman wellness spa, and Michelin-starred culinary excellence in tranquil Utrecht.',
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 1, 2, 5, 6, 7, 9],
                'rooms' => [
                    [
                        'name' => 'Garden Wing Deluxe',
                        'room_type' => 'Garden View Room',
                        'price_per_night' => 245.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Bed',
                        'description' => 'Peaceful room overlooking the ancient walled gardens with birdsong and botanical beauty.',
                        'image_url' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=800&q=80',
                    ],
                    [
                        'name' => 'Monastery Garden Suite',
                        'room_type' => 'Wellness Suite',
                        'price_per_night' => 430.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Bed',
                        'description' => 'Features a private Finnish sauna, direct courtyard garden access, and organic herbal amenities.',
                        'image_url' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'Kruisherenhotel Maastricht',
                'city' => 'Maastricht',
                'address' => 'Kruisherengang 19, 6211 NW Maastricht',
                'star_rating' => 5,
                'price_per_night' => 310.00,
                'rating_score' => 4.9,
                'featured' => true,
                'phone' => '+31 43 329 2020',
                'email' => 'info@kruisherenhotel.nl',
                'description' => 'A breathtaking fusion of a 15th-century Gothic monastery and avant-garde luxury design. Ambient stained-glass lighting, wine mezzanine, and tranquil monastic cloister.',
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 2, 4, 5, 7, 8, 9],
                'rooms' => [
                    [
                        'name' => 'Cloister Heritage Room',
                        'room_type' => 'Superior Double',
                        'price_per_night' => 310.00,
                        'max_guests' => 2,
                        'bed_type' => 'Design King Bed',
                        'description' => 'Artistic serenity with original monastic stone arches, designer lighting, and espresso bar.',
                        'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
                    ],
                    [
                        'name' => 'Sanctuary Choir Suite',
                        'room_type' => 'Master Suite',
                        'price_per_night' => 520.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Size',
                        'description' => 'Located in the historic church apse with soaring vaulted ceilings and panoramic garden vistas.',
                        'image_url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'Mainport Design Hotel Rotterdam',
                'city' => 'Rotterdam',
                'address' => 'Leuvehaven 77, 3011 EA Rotterdam',
                'star_rating' => 5,
                'price_per_night' => 210.00,
                'rating_score' => 4.8,
                'featured' => false,
                'phone' => '+31 10 217 5757',
                'email' => 'reservations@mainporthotel.com',
                'description' => 'Waterfront luxury on the Leuvehaven harbor. Features private in-room whirlpools, Finnish saunas, panoramic harbor views, and the heavenly Spa Heaven 8th-floor sanctuary.',
                'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 1, 3, 5, 6, 8, 9],
                'rooms' => [
                    [
                        'name' => 'Waterfront Spa Room',
                        'room_type' => 'Deluxe Spa Room',
                        'price_per_night' => 210.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Bed',
                        'description' => 'Equipped with an oversized whirlpool overlooking the harbor and a private walk-in rainfall shower.',
                        'image_url' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80',
                    ],
                    [
                        'name' => 'Harbor Panorama Suite',
                        'room_type' => 'Panoramic Suite',
                        'price_per_night' => 375.00,
                        'max_guests' => 3,
                        'bed_type' => 'King Bed + Lounge',
                        'description' => 'Floor-to-ceiling glass windows, private sauna, and complimentary champagne upon arrival.',
                        'image_url' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'The Dylan Amsterdam Boutique',
                'city' => 'Amsterdam',
                'address' => 'Keizersgracht 384, 1016 GB Amsterdam',
                'star_rating' => 5,
                'price_per_night' => 340.00,
                'rating_score' => 4.9,
                'featured' => true,
                'phone' => '+31 20 530 2010',
                'email' => 'concierge@dylanamsterdam.com',
                'description' => 'Nestled on the prestigious Keizersgracht canal. An intimate haven with a secluded courtyard garden, Michelin-starred Restaurant Vinkeles, and tailored luxury experiences.',
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 2, 3, 4, 5, 7, 9],
                'rooms' => [
                    [
                        'name' => 'Canal View Luxury Loft',
                        'room_type' => 'Luxury Loft',
                        'price_per_night' => 340.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Size',
                        'description' => 'Oak beams, serene canal vistas, and artisanal Frette linens for the ultimate restful stay.',
                        'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
            [
                'name' => 'Inntel Hotels Art Eindhoven',
                'city' => 'Eindhoven',
                'address' => 'Lichttoren 22, 5611 BJ Eindhoven',
                'star_rating' => 4,
                'price_per_night' => 145.00,
                'rating_score' => 4.7,
                'featured' => false,
                'phone' => '+31 40 751 3500',
                'email' => 'infoarteindhoven@inntelhotels.nl',
                'description' => 'Set within the historic Philips Light Tower. 4-star design sanctuary featuring 4-meter high ceilings, art installations, Finnish sauna, and tranquil Turkish steam bath.',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=85',
                'amenities_idx' => [0, 1, 5, 7, 9],
                'rooms' => [
                    [
                        'name' => 'Art Deluxe Room',
                        'room_type' => 'Deluxe King',
                        'price_per_night' => 145.00,
                        'max_guests' => 2,
                        'bed_type' => 'King Bed',
                        'description' => 'Distinctive artistic flair with oversized whirlpool and rain dance shower.',
                        'image_url' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80',
                    ],
                ],
            ],
        ];

        foreach ($hotelsData as $h) {
            $hotel = Hotel::updateOrCreate(
                ['name' => $h['name']],
                [
                    'city' => $h['city'],
                    'address' => $h['address'],
                    'star_rating' => $h['star_rating'],
                    'price_per_night' => $h['price_per_night'],
                    'rating_score' => $h['rating_score'],
                    'featured' => $h['featured'],
                    'phone' => $h['phone'],
                    'email' => $h['email'],
                    'description' => $h['description'],
                    'image_url' => $h['image_url'],
                ]
            );

            // Attach Amenities
            $attachIds = [];
            foreach ($h['amenities_idx'] as $idx) {
                if (isset($amenities[$idx])) {
                    $attachIds[] = $amenities[$idx]->id;
                }
            }
            $hotel->amenities()->sync($attachIds);

            // Create Rooms
            foreach ($h['rooms'] as $r) {
                Room::updateOrCreate(
                    ['hotel_id' => $hotel->id, 'name' => $r['name']],
                    [
                        'room_type' => $r['room_type'],
                        'price_per_night' => $r['price_per_night'],
                        'max_guests' => $r['max_guests'],
                        'bed_type' => $r['bed_type'],
                        'description' => $r['description'],
                        'image_url' => $r['image_url'],
                    ]
                );
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
