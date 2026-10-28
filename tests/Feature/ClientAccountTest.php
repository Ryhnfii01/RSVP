<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\ClientCredentials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Akun client: password sementara + kirim ke WhatsApp, dan halaman Akun Saya.
 */
class ClientAccountTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);
    }

    public function test_generated_passwords_are_readable_and_unique(): void
    {
        $passwords = collect(range(1, 50))->map(fn () => ClientCredentials::generatePassword());

        $this->assertSame(50, $passwords->unique()->count());
        $passwords->each(fn ($p) => $this->assertMatchesRegularExpression('/^[a-z2-9]{4}-[a-z2-9]{4}-[a-z2-9]{4}$/', $p));
        $passwords->each(fn ($p) => $this->assertDoesNotMatchRegularExpression('/[01ilo]/', $p));
    }

    public function test_new_client_credentials_are_shown_once_with_whatsapp_link(): void
    {
        $this->actingAs($this->superAdmin)
            ->post('/admin/clients', ['name' => 'Rina & Dimas', 'email' => 'rina@example.com', 'phone' => '0812 3456 7890'])
            ->assertRedirect(route('admin.clients.index'));

        $credentials = session('client_credentials');
        $client = User::where('email', 'rina@example.com')->firstOrFail();

        $this->assertSame(User::ROLE_CLIENT, $client->role);
        $this->assertTrue($client->must_change_password);
        $this->assertTrue(Hash::check($credentials['password'], $client->password));
        $this->assertStringStartsWith('https://wa.me/6281234567890?text=', $credentials['whatsapp_url']);
        $this->assertStringContainsString($credentials['password'], $credentials['message']);
        $this->assertStringContainsString(route('login'), $credentials['message']);

        // Tampil di halaman berikutnya, lalu hilang
        $this->actingAs($this->superAdmin)->get('/admin/clients')
            ->assertSee($credentials['password'])
            ->assertSee('Send to client on WhatsApp');
        $this->actingAs($this->superAdmin)->get('/admin/clients')->assertDontSee($credentials['password']);
    }

    public function test_client_without_phone_gets_contact_picker_link(): void
    {
        $this->actingAs($this->superAdmin)->post('/admin/clients', ['name' => 'Tanpa Nomor', 'email' => 'tn@example.com']);

        $this->assertStringStartsWith('https://wa.me/?text=', session('client_credentials')['whatsapp_url']);
    }

    public function test_reset_creates_new_temporary_password(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT, 'must_change_password' => false]);

        $this->actingAs($this->superAdmin)->put("/admin/clients/{$client->id}/password")->assertRedirect();

        $client->refresh();
        $this->assertTrue($client->must_change_password);
        $this->assertTrue(Hash::check(session('client_credentials')['password'], $client->password));
        $this->assertFalse(Hash::check('password', $client->password));
    }

    public function test_super_admin_can_set_client_phone(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($this->superAdmin)->put("/admin/clients/{$client->id}/phone", ['phone' => '0813-9999-0000']);

        $this->assertSame('6281399990000', $client->fresh()->phone);
    }

    public function test_client_with_temporary_password_sees_reminder_until_changed(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT, 'must_change_password' => true, 'password' => 'kd7m-p2xq-9fhb']);

        $this->actingAs($client)->get('/admin/guests')->assertSee('You are still using a temporary password');

        $this->actingAs($client)
            ->put('/admin/account/password', [
                'current_password' => 'kd7m-p2xq-9fhb',
                'password' => 'passwordbaruku',
                'password_confirmation' => 'passwordbaruku',
            ])
            ->assertRedirect(route('admin.account.edit'))
            ->assertSessionHasNoErrors();

        $client->refresh();
        $this->assertFalse($client->must_change_password);
        $this->assertTrue(Hash::check('passwordbaruku', $client->password));
        $this->actingAs($client)->get('/admin/guests')->assertDontSee('You are still using a temporary password');
    }

    public function test_change_password_validates_current_and_confirmation(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT, 'password' => 'lamaku12345']);

        $this->actingAs($client)
            ->put('/admin/account/password', ['current_password' => 'salah', 'password' => 'barubaru123', 'password_confirmation' => 'barubaru123'])
            ->assertSessionHasErrors(['current_password' => 'Password saat ini salah.']);

        $this->actingAs($client)
            ->put('/admin/account/password', ['current_password' => 'lamaku12345', 'password' => 'barubaru123', 'password_confirmation' => 'beda'])
            ->assertSessionHasErrors('password');

        $this->actingAs($client)
            ->put('/admin/account/password', ['current_password' => 'lamaku12345', 'password' => 'pendek', 'password_confirmation' => 'pendek'])
            ->assertSessionHasErrors('password');

        $this->assertTrue(Hash::check('lamaku12345', $client->fresh()->password));
    }

    public function test_user_can_update_own_profile_but_not_steal_email(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($client)
            ->put('/admin/account/profile', ['name' => 'Rina', 'email' => $this->superAdmin->email])
            ->assertSessionHasErrors('email');

        $this->actingAs($client)
            ->put('/admin/account/profile', ['name' => 'Rina', 'email' => 'rina.baru@example.com', 'phone' => '0812 0000 1111'])
            ->assertSessionHasNoErrors();

        $client->refresh();
        $this->assertSame('rina.baru@example.com', $client->email);
        $this->assertSame('6281200001111', $client->phone);
    }

    public function test_client_cannot_create_or_reset_other_accounts(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $other = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($client)->post('/admin/clients', ['name' => 'X', 'email' => 'x@example.com'])->assertForbidden();
        $this->actingAs($client)->put("/admin/clients/{$other->id}/password")->assertForbidden();
        $this->actingAs($client)->put("/admin/clients/{$other->id}/phone", ['phone' => '0811'])->assertForbidden();
    }
}
