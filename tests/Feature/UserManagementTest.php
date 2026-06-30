<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_author_user(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($admin)
            ->post(route('users.store'), [
                'name' => 'Author Name',
                'age' => 32,
                'experience' => '7 years',
                'social_media_profile' => 'https://linkedin.com/in/author-name',
                'contact_number' => '1234567890',
                'email' => 'author@example.com',
                'role' => User::ROLE_AUTHOR,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'Author Name',
            'age' => 32,
            'experience' => '7 years',
            'email' => 'author@example.com',
            'role' => User::ROLE_AUTHOR,
        ]);
    }

    public function test_author_cannot_access_user_management(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $this
            ->actingAs($author)
            ->get(route('users.index'))
            ->assertForbidden();
    }

    public function test_admin_can_delete_another_user(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('users.destroy', $author));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $author->id,
        ]);
    }
}
