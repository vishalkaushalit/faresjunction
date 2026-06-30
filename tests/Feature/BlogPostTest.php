<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_can_create_blog_post_for_themselves(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($author)
            ->post(route('blog-posts.store'), [
                'title' => 'Travel Planning Tips',
                'content' => 'Use a simple checklist before every trip.',
                'tags' => 'Europe, Flights, europe, Budget Travel',
                'table_of_contents' => [
                    ['title' => 'Spring Travel Tips', 'link' => '#spring-travel-tips'],
                    ['title' => 'Summer Travel Tips', 'link' => ''],
                ],
                'status' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-posts.index'));

        $this->assertDatabaseHas('blog_posts', [
            'author_id' => $author->id,
            'title' => 'Travel Planning Tips',
            'slug' => 'travel-planning-tips',
            'status' => true,
        ]);

        $post = BlogPost::where('slug', 'travel-planning-tips')->first();

        $this->assertSame(['Europe', 'Flights', 'Budget Travel'], $post->tags);

        $this->assertSame([
            ['title' => 'Spring Travel Tips', 'link' => '#spring-travel-tips'],
            ['title' => 'Summer Travel Tips', 'link' => '#summer-travel-tips'],
        ], $post->table_of_contents);
    }

    public function test_author_cannot_edit_another_authors_post(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $otherAuthor = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $post = BlogPost::create([
            'author_id' => $otherAuthor->id,
            'title' => 'Other Post',
            'slug' => 'other-post',
            'content' => 'Private draft.',
        ]);

        $this
            ->actingAs($author)
            ->get(route('blog-posts.edit', $post))
            ->assertForbidden();
    }

    public function test_admin_can_update_any_blog_post(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $post = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Original Post',
            'slug' => 'original-post',
            'content' => 'Original content.',
        ]);

        $response = $this
            ->actingAs($admin)
            ->put(route('blog-posts.update', $post), [
                'author_id' => $author->id,
                'title' => 'Updated Post',
                'slug' => 'updated-post',
                'content' => 'Updated content.',
                'status' => '0',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-posts.index'));

        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'title' => 'Updated Post',
            'slug' => 'updated-post',
        ]);
    }

    public function test_published_database_post_displays_table_of_contents(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $post = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Best Time to Visit Europe',
            'slug' => 'best-time-to-visit-europe-db',
            'excerpt' => 'A seasonal guide.',
            'content' => '<h3 id="spring">Spring</h3><p>Flowers and sightseeing.</p>',
            'tags' => ['Europe', 'Seasonal Travel'],
            'table_of_contents' => [
                ['title' => 'Spring - Best for Sightseeing', 'link' => '#spring'],
            ],
            'status' => true,
            'published_at' => now(),
        ]);

        $this
            ->get(route('website.blog-details', $post->slug))
            ->assertOk()
            ->assertSee('Table of Contents')
            ->assertSee('Spring - Best for Sightseeing')
            ->assertSee('Europe')
            ->assertSee('Seasonal Travel')
            ->assertSee('href="#spring"', false);
    }
}
