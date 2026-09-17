<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class Room
 *
 * Strict wrapper model for Room Stored Procedures.
 * Adheres strictly to Rules & Regulations (Rule 1, Rule 3, Rule 4, Rule 6).
 *
 * @package App\Models
 */
class Room extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'name',
        'room_type',
        'price_per_night',
        'capacity',
        'beds',
        'description',
        'image_url',
        'is_available',
    ];

    /**
     * Retrieve all rooms for a specific hotel via SP_Room_ReadByHotel.
     *
     * @param int $hotelId The ID of the hotel.
     * @return array<int, object> List of rooms or empty array fallback on failure.
     */
    public function getByHotelId(int $hotelId): array
    {
        try {
            $results = DB::select('CALL SP_Room_ReadByHotel(?)', [$hotelId]);
            Log::info('SP_Room_ReadByHotel executed successfully.', [
                'hotel_id' => $hotelId,
                'rooms_count' => count($results),
            ]);

            return $results ?? [];
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Room_ReadByHotel: ' . $e->getMessage(), [
                'hotel_id' => $hotelId,
                'exception' => $e,
            ]);

            return [];
        }
    }

    /**
     * Create a new room for a hotel via Stored Procedure SP_Room_Create.
     *
     * @param array<string, mixed> $data Associative array of room fields.
     * @return int The ID of the newly created room, or 0 on failure.
     */
    public function createRoom(array $data): int
    {
        try {
            DB::statement('CALL SP_Room_Create(?, ?, ?, ?, ?, ?, ?, ?, ?, @out_id)', [
                $data['hotel_id'] ?? 1,
                $data['name'] ?? '',
                $data['room_type'] ?? 'Standard Room',
                $data['price_per_night'] ?? 0.00,
                $data['capacity'] ?? 2,
                $data['beds'] ?? '1 Queen Bed',
                $data['description'] ?? '',
                $data['image_url'] ?? '',
                isset($data['is_available']) ? (int) $data['is_available'] : 1,
            ]);

            $outIdResult = DB::select('SELECT @out_id AS inserted_id');
            $insertedId = (int) ($outIdResult[0]->inserted_id ?? 0);

            Log::info('SP_Room_Create executed successfully.', ['inserted_id' => $insertedId]);

            return $insertedId > 0 ? $insertedId : 0;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Room_Create: ' . $e->getMessage(), [
                'data' => $data,
                'exception' => $e,
            ]);

            return 0;
        }
    }

    /**
     * Update an existing room via Stored Procedure SP_Room_Update.
     *
     * @param int $id The ID of the room to update.
     * @param array<string, mixed> $data Associative array of room fields to update.
     * @return bool True on success, false on failure.
     */
    public function updateRoom(int $id, array $data): bool
    {
        try {
            DB::statement('CALL SP_Room_Update(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $data['name'] ?? null,
                $data['room_type'] ?? null,
                $data['price_per_night'] ?? null,
                $data['capacity'] ?? null,
                $data['beds'] ?? null,
                $data['description'] ?? null,
                $data['image_url'] ?? null,
                isset($data['is_available']) ? (int) $data['is_available'] : null,
            ]);

            Log::info('SP_Room_Update executed successfully.', ['room_id' => $id]);

            return true;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Room_Update: ' . $e->getMessage(), [
                'room_id' => $id,
                'exception' => $e,
            ]);

            return false;
        }
    }

    /**
     * Delete a room via Stored Procedure SP_Room_Delete.
     *
     * @param int $id The room ID to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteRoom(int $id): bool
    {
        try {
            DB::statement('CALL SP_Room_Delete(?)', [$id]);
            Log::info('SP_Room_Delete executed successfully.', ['room_id' => $id]);

            return true;
        } catch (\Throwable $e) {
            Log::error('Failed executing SP_Room_Delete: ' . $e->getMessage(), [
                'room_id' => $id,
                'exception' => $e,
            ]);

            return false;
        }
    }
}
