<?php

namespace Tests\Unit;

use App\Models\Hotel;
use PHPUnit\Framework\TestCase;

class HotelModelTest extends TestCase
{
    public function test_hotel_model_instantiation(): void
    {
        $hotel = new Hotel;
        $this->assertInstanceOf(Hotel::class, $hotel);
    }

    public function test_hotel_model_fillable_attributes(): void
    {
        $hotel = new Hotel([
            'name' => 'Grand Palace',
            'city' => 'Amsterdam',
            'star_rating' => 5,
        ]);

        $this->assertEquals('Grand Palace', $hotel->name);
        $this->assertEquals('Amsterdam', $hotel->city);
        $this->assertEquals(5, $hotel->star_rating);
    }
}
