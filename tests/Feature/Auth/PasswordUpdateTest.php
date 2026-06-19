<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->user()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/password/update', [
                'old_password' => 'password',
                'new_password' => 'new-password',
                'new_password_confirmation' => 'new-password',
            ]);

        $response->assertRedirect();

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_correct_old_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->user()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/password/update', [
                'old_password' => 'wrong-password',
                'new_password' => 'new-password',
                'new_password_confirmation' => 'new-password',
            ]);

        $response->assertRedirect();

        // Password should remain unchanged
        $this->assertTrue(Hash::check('password', $user->refresh()->password));
    }
}
