<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Reservation;
use Database\Seeders\HotelSeeder;
use Tests\TestCase;

class ReservationFlowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(HotelSeeder::class);
    }

    public function test_guest_can_reserve_hotel_without_login(): void
    {
        $hotel = Hotel::first();
        $this->assertNotNull($hotel);

        $email = 'guest_'.uniqid().'@example.com';

        $response = $this->post('/reserve', [
            'hotel_id' => $hotel->id,
            'guest_name' => 'Sophia Montgomery',
            'guest_email' => $email,
            'guest_phone' => '+31 6 9876 5432',
            'guest_address' => 'Keizersgracht 200, Amsterdam',
            'check_in' => '2026-10-01',
            'check_out' => '2026-10-05',
            'guests_count' => 2,
            'special_requests' => 'Quiet room facing the inner garden.',
        ]);

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseHas('reservations', [
            'hotel_id' => $hotel->id,
            'guest_name' => 'Sophia Montgomery',
            'guest_email' => $email,
        ]);
    }

    public function test_reserved_tab_displays_chosen_hotel_and_guest_info(): void
    {
        $hotel = Hotel::first();
        $this->assertNotNull($hotel);

        $code = 'GSH-'.strtoupper(substr(uniqid(), -6));

        $reservation = Reservation::create([
            'reservation_code' => $code,
            'hotel_id' => $hotel->id,
            'guest_name' => 'Alexander Wright',
            'guest_email' => 'alex_'.uniqid().'@example.com',
            'guest_phone' => '+31 6 1122 3344',
            'guest_address' => 'Herengracht 50, Amsterdam',
            'check_in' => '2026-11-01',
            'check_out' => '2026-11-04',
            'guests_count' => 2,
            'status' => 'Confirmed',
        ]);

        $response = $this->withSession(['guest_reservations' => [$code]])
            ->get('/reserved');

        $response->assertStatus(200);
        $response->assertSee($code);
        $response->assertSee('Alexander Wright');
        $response->assertSee('+31 6 1122 3344');
        $response->assertSee($hotel->name);
    }

    public function test_reservation_lookup_by_code(): void
    {
        $hotel = Hotel::first();
        $this->assertNotNull($hotel);

        $code = 'GSH-'.strtoupper(substr(uniqid(), -6));

        $reservation = Reservation::create([
            'reservation_code' => $code,
            'hotel_id' => $hotel->id,
            'guest_name' => 'Emma Watson',
            'guest_email' => 'emma_'.uniqid().'@watson.com',
            'guest_phone' => '+31 6 5555 6666',
            'status' => 'Confirmed',
        ]);

        $response = $this->post('/reserved/lookup', [
            'lookup_query' => $code,
        ]);

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('success');
    }

    public function test_guest_can_cancel_reservation(): void
    {
        $hotel = Hotel::first();
        $this->assertNotNull($hotel);

        $code = 'GSH-'.strtoupper(substr(uniqid(), -6));

        $reservation = Reservation::create([
            'reservation_code' => $code,
            'hotel_id' => $hotel->id,
            'guest_name' => 'Lucas Brown',
            'guest_email' => 'lucas_'.uniqid().'@brown.com',
            'guest_phone' => '+31 6 7777 8888',
            'status' => 'Confirmed',
        ]);

        $response = $this->delete('/reserved/'.$code);

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseMissing('reservations', [
            'reservation_code' => $code,
        ]);
    }
}
