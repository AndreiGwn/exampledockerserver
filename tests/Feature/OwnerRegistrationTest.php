<?php

namespace Tests\Feature;

use Tests\TestCase;

class OwnerRegistrationTest extends TestCase
{
    public function test_registration_screen_shows_eigenaar_branding(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Registreer als Eigenaar');
        $response->assertSee('Bedrijfsnaam');
    }

    public function test_new_eigenaar_can_register(): void
    {
        $email = 'new_owner_'.time().'@example.com';

        $response = $this->post('/register', [
            'name' => 'Klaas Jansen',
            'email' => $email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+31 6 12345678',
            'company_name' => 'Jansen Hospitality',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticated();
    }
}
