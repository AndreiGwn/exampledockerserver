<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class OwnerHotelManagementTest extends TestCase
{
    public function test_guests_cannot_access_owner_hotel_management(): void
    {
        $response = $this->get('/owner/hotels');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_owner_can_view_hotels_index(): void
    {
        $user = new User([
            'name' => 'Test Owner',
            'email' => 'testowner@example.com',
            'role' => 'eigenaar',
        ]);
        $user->id = 1;

        $response = $this->actingAs($user)->get('/owner/hotels');

        $response->assertStatus(200);
        $response->assertSee('Hotelbeheer');
    }

    public function test_authenticated_owner_can_view_create_hotel_form(): void
    {
        $user = new User([
            'name' => 'Test Owner',
            'email' => 'testowner2@example.com',
            'role' => 'eigenaar',
        ]);
        $user->id = 1;

        $response = $this->actingAs($user)->get('/owner/hotels/create');

        $response->assertStatus(200);
        $response->assertSee('Nieuw Hotel Toevoegen');
    }
}
