<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Laravelの仕様ではメール認証が必要なので、リダイレクト先は /verify-email
        $response->assertRedirect('/verify-email');

        // ユーザーがデータベースに保存されていることを確認
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
