<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;

class LoginUserLivewireTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserRoleSeeder::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_login_a_user_via_livewire_component()
    {
        $user = User::factory()->create([
            'email' => 'loginuser@example.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test('login-user')
            ->set('email', 'loginuser@example.com')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_fails_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'loginuser@example.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test('login-user')
            ->set('email', 'a@user.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertSee('Invalid credentials.');
        
        $this->assertGuest();
    }
}
