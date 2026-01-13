<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;

class RegisterUserLivewireTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserRoleSeeder::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_register_a_user_via_livewire_component()
    {
        Livewire::test('register-user')
            ->set('name', 'Livewire User')
            ->set('email', 'livewire@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertRedirect(route('splash'));

        $this->assertDatabaseHas('users', [
            'email' => 'livewire@example.com',
        ]);
        $this->assertAuthenticated();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_requires_valid_email()
    {
        Livewire::test('register-user')
            ->set('name', 'Livewire User')
            ->set('email', 'not-an-email')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);

        $this->assertGuest();
    }
}
