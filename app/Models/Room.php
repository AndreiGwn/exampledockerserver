<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Room
 *
 * Represents a room or suite in a luxury hotel.
 */
class Room extends Model
{
    use HasFactory;

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
        'max_guests',
        'bed_type',
        'description',
        'image_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_night' => 'decimal:2',
        'max_guests' => 'integer',
    ];

    /**
     * Get the hotel that owns this suite/room.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the reservations for this suite/room.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'room_id');
    }

    /**
     * Compatibility helper: get rooms by hotel id.
     *
     * @return Collection
     */
    public function getByHotelId(int $hotelId)
    {
        return self::where('hotel_id', $hotelId)->get();
    }
}
