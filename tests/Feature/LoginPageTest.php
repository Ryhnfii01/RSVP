<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_sees_login_form(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_logged_in_user_opening_login_goes_to_dashboard(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($user)->get('/login')->assertRedirect(route('admin.dashboard'));
        $this->actingAs($user)->get('/')->assertSee('Dashboard');
    }
}
