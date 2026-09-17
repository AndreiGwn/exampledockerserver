<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Hotel
 *
 * Represents a luxury 4-5 star hotel in the Netherlands.
 */
class Hotel extends Model
{
    use HasFactory;

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
        'name',
        'city',
        'address',
        'star_rating',
        'price_per_night',
        'description',
        'image_url',
        'gallery_images',
        'featured',
        'rating_score',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'star_rating' => 'integer',
        'price_per_night' => 'decimal:2',
        'rating_score' => 'float',
        'featured' => 'boolean',
        'gallery_images' => 'array',
    ];

    /**
     * Get the suites/rooms for this hotel.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    /**
     * Get the amenities for this hotel.
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'hotel_amenities', 'hotel_id', 'amenity_id');
    }

    /**
     * Get the reservations for this hotel.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'hotel_id');
    }

    /**
     * Retrieve all hotels or filter by criteria.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, Hotel>
     */
    public function search(array $filters = [])
    {
        $query = self::with(['rooms', 'amenities']);

        if (! empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (! empty($filters['stars'])) {
            $query->where('star_rating', '>=', (int) $filters['stars']);
        }

        if (! empty($filters['min_price'])) {
            $query->where('price_per_night', '>=', (float) $filters['min_price']);
        }

        if (! empty($filters['max_price'])) {
            $query->where('price_per_night', '<=', (float) $filters['max_price']);
        }

        if (! empty($filters['q'])) {
            $search = '%'.$filters['q'].'%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                    ->orWhere('city', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        }

        $sortBy = $filters['sort_by'] ?? 'recommended';
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price_per_night', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_per_night', 'desc');
                break;
            case 'stars':
                $query->orderBy('star_rating', 'desc')->orderBy('rating_score', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating_score', 'desc');
                break;
            default:
                $query->orderBy('featured', 'desc')->orderBy('rating_score', 'desc');
                break;
        }

        return $query->get();
    }

    /**
     * Get distinct cities for filters.
     *
     * @return array<int, string>
     */
    public function getDistinctCities(): array
    {
        try {
            return self::distinct()->pluck('city')->toArray();
        } catch (\Throwable $e) {
            return ['Amsterdam', 'The Hague', 'Rotterdam', 'Utrecht', 'Maastricht', 'Eindhoven'];
        }
    }
}
