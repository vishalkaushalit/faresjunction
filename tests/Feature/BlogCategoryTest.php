<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_categories_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->get(route('blog-categories.index'));

        $response
            ->assertOk()
            ->assertSee('Blog Categories')
            ->assertSee('Add Blog Category');
    }

    public function test_blog_category_can_be_created(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->post(route('blog-categories.store'), [
                'name' => 'Travel Tips',
                'description' => 'Helpful travel planning articles.',
                'status' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-categories.index'));

        $this->assertDatabaseHas('blog_categories', [
            'name' => 'Travel Tips',
            'slug' => 'travel-tips',
            'description' => 'Helpful travel planning articles.',
            'status' => true,
        ]);
    }

    public function test_blog_category_can_be_updated(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = BlogCategory::create([
            'name' => 'Travel Tips',
            'slug' => 'travel-tips',
            'status' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('blog-categories.update', $category), [
                'name' => 'Flight Hacks',
                'slug' => 'flight-hacks',
                'description' => 'Ways to book smarter flights.',
                'status' => '0',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-categories.index'));

        $this->assertDatabaseHas('blog_categories', [
            'id' => $category->id,
            'name' => 'Flight Hacks',
            'slug' => 'flight-hacks',
            'description' => 'Ways to book smarter flights.',
            'status' => false,
        ]);
    }

    public function test_blog_category_can_be_deleted(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = BlogCategory::create([
            'name' => 'Travel Tips',
            'slug' => 'travel-tips',
            'status' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('blog-categories.destroy', $category));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-categories.index'));

        $this->assertDatabaseMissing('blog_categories', [
            'id' => $category->id,
        ]);
    }
}
