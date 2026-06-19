<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_account_page_is_displayed(): void
    {
        $user = User::factory()->user()->create();

        $response = $this
            ->actingAs($user)
            ->get('/user/account/page');

        $response->assertOk();
    }

    public function test_user_account_page_requires_authentication(): void
    {
        $response = $this->get('/user/account/page');

        $response->assertRedirect('/login');
    }

    public function test_user_profile_can_be_updated(): void
    {
        $user = User::factory()->user()->create();

        $response = $this
            ->actingAs($user)
            ->post('/profile/update', [
                'username' => 'testuser',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '0123456789',
                'address' => '123 Test Street',
            ]);

        $response->assertRedirect();

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertSame('testuser', $user->username);
    }

    public function test_user_dashboard_is_displayed(): void
    {
        $user = User::factory()->user()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_user_change_password_page_is_displayed(): void
    {
        $user = User::factory()->user()->create();

        $response = $this
            ->actingAs($user)
            ->get('/user/change/password');

        $response->assertOk();
    }
}
