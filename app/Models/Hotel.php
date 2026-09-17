<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class Hotel
 *
 * Strict wrapper model for Hotel Stored Procedures.
 * Adheres strictly to Rules & Regulations (Rule 1, Rule 3, Rule 4, Rule 6).
 */
class Hotel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hotels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'city',
        'address',
        'star_rating',
        'price_per_night',
        'image_url',
        'phone',
        'email',
        'is_featured',
    ];

    /**
     * Retrieve all hotels via Stored Procedure SP_Hotel_ReadAll.
     *
     * @return array<int, object> Returns an array of hotel objects or empty array fallback on failure.
     */
    public function getAll(): array
    {
        try {
            $results = DB::select('CALL SP_Hotel_ReadAll()');
            Log::info('SP_Hotel_ReadAll executed successfully.', ['count' => count($results)]);

            return $results ?? [];
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_ReadAll: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            // Fallback via Golden Rule of Null (Rule 4)
            return [];
        }
    }

    /**
     * Retrieve a specific hotel by ID via Stored Procedure SP_Hotel_Read.
     *
     * @param  int  $id  The unique identifier of the hotel.
     * @return object Returns the hotel object, or an empty fallback object on failure (never null).
     */
    public function findById(int $id): object
    {
        try {
            $results = DB::select('CALL SP_Hotel_Read(?)', [$id]);
            Log::info('SP_Hotel_Read executed successfully.', ['hotel_id' => $id]);

            if (! empty($results) && isset($results[0])) {
                return $results[0];
            }

            // Fallback empty object reflecting missing state (Rule 4)
            return (object) [
                'id' => 0,
                'name' => 'Hotel Not Found',
                'description' => '',
                'city' => '',
                'address' => '',
                'star_rating' => 0,
                'price_per_night' => 0.00,
                'image_url' => '',
                'phone' => '',
                'email' => '',
                'is_featured' => 0,
                'average_rating' => 0.0,
                'reviews_count' => 0,
                'rooms_count' => 0,
                'starting_price' => 0.00,
            ];
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_Read: '.$e->getMessage(), [
                'hotel_id' => $id,
                'exception' => $e,
            ]);

            return (object) [
                'id' => 0,
                'name' => 'Error Loading Hotel',
                'description' => $e->getMessage(),
                'city' => '',
                'address' => '',
                'star_rating' => 0,
                'price_per_night' => 0.00,
                'image_url' => '',
                'phone' => '',
                'email' => '',
                'is_featured' => 0,
                'average_rating' => 0.0,
                'reviews_count' => 0,
                'rooms_count' => 0,
                'starting_price' => 0.00,
            ];
        }
    }

    /**
     * Retrieve all hotels belonging to a specific owner via SP_Hotel_ReadByOwner.
     *
     * @param  int  $userId  The ID of the Eigenaar owner.
     * @return array<int, object> List of hotels owned by user or empty array fallback.
     */
    public function getByOwnerId(int $userId): array
    {
        try {
            $results = DB::select('CALL SP_Hotel_ReadByOwner(?)', [$userId]);
            Log::info('SP_Hotel_ReadByOwner executed successfully.', ['user_id' => $userId]);

            return $results ?? [];
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_ReadByOwner: '.$e->getMessage(), [
                'user_id' => $userId,
                'exception' => $e,
            ]);

            return [];
        }
    }

    /**
     * Create a new hotel property via Stored Procedure SP_Hotel_Create.
     *
     * @param  array<string, mixed>  $data  Associative array of hotel fields.
     * @return int The ID of the newly created hotel, or 0 on failure.
     */
    public function createHotel(array $data): int
    {
        try {
            DB::statement('CALL SP_Hotel_Create(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @out_id)', [
                $data['user_id'] ?? 1,
                $data['name'] ?? '',
                $data['description'] ?? '',
                $data['city'] ?? '',
                $data['address'] ?? '',
                $data['star_rating'] ?? 3,
                $data['price_per_night'] ?? 0.00,
                $data['image_url'] ?? '',
                $data['phone'] ?? '',
                $data['email'] ?? '',
                $data['is_featured'] ?? 0,
            ]);

            $outIdResult = DB::select('SELECT @out_id AS inserted_id');
            $insertedId = (int) ($outIdResult[0]->inserted_id ?? 0);

            Log::info('SP_Hotel_Create executed successfully.', ['inserted_id' => $insertedId]);

            return $insertedId > 0 ? $insertedId : 0;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_Create: '.$e->getMessage(), [
                'data' => $data,
                'exception' => $e,
            ]);

            return 0;
        }
    }

    /**
     * Update an existing hotel property via Stored Procedure SP_Hotel_Update.
     *
     * @param  int  $id  The ID of the hotel to update.
     * @param  array<string, mixed>  $data  Associative array of update fields.
     * @param  int|null  $userId  Optional owner ID verification.
     * @return bool True on success, false on failure.
     */
    public function updateHotel(int $id, array $data, ?int $userId = null): bool
    {
        try {
            DB::statement('CALL SP_Hotel_Update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $userId,
                $data['name'] ?? null,
                $data['description'] ?? null,
                $data['city'] ?? null,
                $data['address'] ?? null,
                $data['star_rating'] ?? null,
                $data['price_per_night'] ?? null,
                $data['image_url'] ?? null,
                $data['phone'] ?? null,
                $data['email'] ?? null,
                isset($data['is_featured']) ? (int) $data['is_featured'] : null,
            ]);

            Log::info('SP_Hotel_Update executed successfully.', ['hotel_id' => $id]);

            return true;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_Update: '.$e->getMessage(), [
                'hotel_id' => $id,
                'exception' => $e,
            ]);

            return false;
        }
    }

    /**
     * Delete a hotel property via Stored Procedure SP_Hotel_Delete.
     *
     * @param  int  $id  The hotel ID to delete.
     * @param  int|null  $userId  Optional owner ID constraint.
     * @return bool True on success, false on failure.
     */
    public function deleteHotel(int $id, ?int $userId = null): bool
    {
        try {
            DB::statement('CALL SP_Hotel_Delete(?, ?)', [$id, $userId]);
            Log::info('SP_Hotel_Delete executed successfully.', ['hotel_id' => $id]);

            return true;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_Delete: '.$e->getMessage(), [
                'hotel_id' => $id,
                'exception' => $e,
            ]);

            return false;
        }
    }

    /**
     * Perform Trivago-style search using Stored Procedure SP_Hotel_Search.
     *
     * @param  array<string, mixed>  $filters  Search criteria (query, city, min_price, max_price, min_star, capacity, sort_by).
     * @return array<int, object> Matching hotel results or empty array fallback.
     */
    public function search(array $filters): array
    {
        try {
            $query = $filters['q'] ?? ($filters['query'] ?? null);
            $city = $filters['city'] ?? null;
            $minPrice = isset($filters['min_price']) && $filters['min_price'] !== '' ? (float) $filters['min_price'] : null;
            $maxPrice = isset($filters['max_price']) && $filters['max_price'] !== '' ? (float) $filters['max_price'] : null;
            $minStar = isset($filters['min_star']) && $filters['min_star'] !== '' ? (int) $filters['min_star'] : null;
            $capacity = isset($filters['capacity']) && $filters['capacity'] !== '' ? (int) $filters['capacity'] : null;
            $sortBy = $filters['sort_by'] ?? 'recommended';

            $results = DB::select('CALL SP_Hotel_Search(?, ?, ?, ?, ?, ?, ?)', [
                $query,
                $city,
                $minPrice,
                $maxPrice,
                $minStar,
                $capacity,
                $sortBy,
            ]);

            Log::info('SP_Hotel_Search executed successfully.', [
                'filters' => $filters,
                'results_count' => count($results),
            ]);

            return $results ?? [];
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Hotel_Search: '.$e->getMessage(), [
                'filters' => $filters,
                'exception' => $e,
            ]);

            return [];
        }
    }

    /**
     * Get distinct hotel cities available in the database.
     *
     * @return array<int, string>
     */
    public function getDistinctCities(): array
    {
        try {
            $cities = DB::table('hotels')->distinct()->pluck('city')->toArray();
            Log::info('Retrieved distinct hotel cities successfully.');

            return $cities ?? [];
        } catch (\Throwable $e) {
            Log::error('Failed retrieving distinct cities: '.$e->getMessage());

            return ['Amsterdam', 'Rotterdam', 'Utrecht', 'The Hague', 'Maastricht', 'Eindhoven'];
        }
    }
}
