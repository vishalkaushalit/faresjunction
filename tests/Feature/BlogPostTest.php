<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
                'featured_image_alt' => 'Backpack beside a travel checklist',
                'content' => '<p>Use a simple checklist before every trip.</p><img src="/images/checklist.jpg">',
                'content_image_alts' => [
                    'Travel checklist on a table',
                ],
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
            'featured_image_alt' => 'Backpack beside a travel checklist',
            'status' => true,
        ]);

        $post = BlogPost::where('slug', 'travel-planning-tips')->first();
        $post->load('tags');

        $this->assertStringContainsString('alt="Travel checklist on a table"', $post->content);
        $this->assertSame(['Budget Travel', 'Europe', 'Flights'], $post->tags->pluck('name')->all());
        $this->assertDatabaseHas('tags', [
            'name' => 'Europe',
            'slug' => 'europe',
        ]);
        $this->assertDatabaseHas('blog_post_tag', [
            'blog_post_id' => $post->id,
            'tag_id' => Tag::where('slug', 'europe')->value('id'),
        ]);

        $this->assertSame([
            ['title' => 'Spring Travel Tips', 'link' => '#spring-travel-tips'],
            ['title' => 'Summer Travel Tips', 'link' => '#summer-travel-tips'],
        ], $post->table_of_contents);
    }

    public function test_embedded_editor_images_are_saved_as_short_storage_urls(): void
    {
        Storage::fake('public');

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $base64Image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=';

        $response = $this
            ->actingAs($author)
            ->post(route('blog-posts.store'), [
                'title' => 'Embedded Image Post',
                'content' => '<p>Intro</p><img src="' . $base64Image . '">',
                'content_image_alts' => [
                    'One pixel test image',
                ],
                'status' => '1',
            ]);

        $response->assertSessionHasNoErrors();

        $post = BlogPost::where('slug', 'embedded-image-post')->firstOrFail();

        $this->assertStringNotContainsString('data:image/png;base64', $post->content);
        $this->assertStringContainsString('src="/storage/blog-posts/content/', $post->content);
        $this->assertStringContainsString('alt="One pixel test image"', $post->content);
        $this->assertMatchesRegularExpression('/src="\/storage\/blog-posts\/content\/([^"]+\.png)"/', $post->content);

        preg_match('/src="\/storage\/([^"]+)"/', $post->content, $matches);
        Storage::disk('public')->assertExists($matches[1]);
    }

    public function test_editor_image_upload_returns_short_storage_url(): void
    {
        Storage::fake('public');

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($author)
            ->postJson(route('blog-posts.content-image-upload'), [
                'upload' => UploadedFile::fake()->image('editor-image.jpg'),
            ]);

        $response
            ->assertOk()
            ->assertJson([
                'uploaded' => 1,
            ])
            ->assertJsonPath('url', fn (string $url): bool => str_starts_with($url, '/storage/blog-posts/content/'));

        $path = str_replace('/storage/', '', $response->json('url'));
        Storage::disk('public')->assertExists($path);
    }

    public function test_editor_file_upload_returns_short_storage_url(): void
    {
        Storage::fake('public');

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($author)
            ->postJson(route('blog-posts.content-file-upload'), [
                'upload' => UploadedFile::fake()->create('fare-rules.pdf', 128, 'application/pdf'),
            ]);

        $response
            ->assertOk()
            ->assertJson([
                'uploaded' => 1,
            ])
            ->assertJsonPath('url', fn (string $url): bool => str_starts_with($url, '/storage/blog-posts/files/'));

        $path = str_replace('/storage/', '', $response->json('url'));
        Storage::disk('public')->assertExists($path);
    }

    public function test_editor_file_upload_accepts_any_file_extension(): void
    {
        Storage::fake('public');

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($author)
            ->postJson(route('blog-posts.content-file-upload'), [
                'upload' => UploadedFile::fake()->create('airline-data.customformat', 4, 'application/octet-stream'),
            ]);

        $response
            ->assertOk()
            ->assertJson([
                'uploaded' => 1,
            ])
            ->assertJsonPath('url', fn (string $url): bool => str_starts_with($url, '/storage/blog-posts/files/'))
            ->assertJsonPath('url', fn (string $url): bool => str_ends_with($url, '.customformat'));

        $path = str_replace('/storage/', '', $response->json('url'));
        Storage::disk('public')->assertExists($path);
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

    public function test_author_can_duplicate_their_blog_post_as_a_draft(): void
    {
        Storage::fake('public');

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $tag = Tag::create(['name' => 'Europe', 'slug' => 'europe']);
        Storage::disk('public')->put('blog-posts/original.jpg', 'image-content');

        $post = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Europe Travel Guide',
            'slug' => 'europe-travel-guide',
            'featured_image' => 'blog-posts/original.jpg',
            'featured_image_alt' => 'European city skyline',
            'excerpt' => 'A complete guide to Europe.',
            'content' => '<p>Original guide content.</p>',
            'table_of_contents' => [
                ['title' => 'Planning', 'link' => '#planning'],
            ],
            'status' => true,
            'published_at' => now(),
        ]);
        $post->tags()->attach($tag);

        $response = $this
            ->actingAs($author)
            ->post(route('blog-posts.duplicate', $post));

        $duplicate = BlogPost::where('slug', 'europe-travel-guide-copy')->firstOrFail();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-posts.edit', $duplicate));

        $duplicate->load('tags');

        $this->assertSame($author->id, $duplicate->author_id);
        $this->assertSame('Europe Travel Guide Copy', $duplicate->title);
        $this->assertFalse($duplicate->status);
        $this->assertNull($duplicate->published_at);
        $this->assertSame('European city skyline', $duplicate->featured_image_alt);
        $this->assertSame('A complete guide to Europe.', $duplicate->excerpt);
        $this->assertSame('<p>Original guide content.</p>', $duplicate->content);
        $this->assertSame([
            ['title' => 'Planning', 'link' => '#planning'],
        ], $duplicate->table_of_contents);
        $this->assertSame(['Europe'], $duplicate->tags->pluck('name')->all());
        $this->assertNotSame($post->featured_image, $duplicate->featured_image);

        Storage::disk('public')->assertExists($post->featured_image);
        Storage::disk('public')->assertExists($duplicate->featured_image);
    }

    public function test_author_cannot_duplicate_another_authors_post(): void
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
            ->post(route('blog-posts.duplicate', $post))
            ->assertForbidden();

        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function test_published_database_post_displays_table_of_contents(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $post = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Best Time to Visit Europe',
            'slug' => 'best-time-to-visit-europe-db',
            'excerpt' => 'A seasonal guide.',
            'featured_image' => 'blog-posts/europe.jpg',
            'featured_image_alt' => 'Spring flowers near a European landmark',
            'content' => '<h3 id="spring">Spring</h3><p>Flowers and sightseeing.</p>',
            'table_of_contents' => [
                ['title' => 'Spring - Best for Sightseeing', 'link' => '#spring'],
            ],
            'status' => true,
            'published_at' => now(),
        ]);
        $post->tags()->attach([
            Tag::create(['name' => 'Europe', 'slug' => 'europe'])->id,
            Tag::create(['name' => 'Seasonal Travel', 'slug' => 'seasonal-travel'])->id,
        ]);

        $this
            ->get(route('website.blog-details', $post->slug))
            ->assertOk()
            ->assertSee('Table of Contents')
            ->assertSee('Spring - Best for Sightseeing')
            ->assertSee('Europe')
            ->assertSee('Seasonal Travel')
            ->assertSee(route('website.blog', ['tag' => 'europe'], false), false)
            ->assertSee('alt="Spring flowers near a European landmark"', false)
            ->assertSee('href="#spring"', false);
    }

    public function test_blog_index_can_be_filtered_by_clicked_tag(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $europe = Tag::create(['name' => 'Europe', 'slug' => 'europe']);
        $flights = Tag::create(['name' => 'Flights', 'slug' => 'flights']);

        $europePost = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Europe Rail Guide',
            'slug' => 'europe-rail-guide',
            'content' => 'Rail tips for Europe.',
            'status' => true,
            'published_at' => now(),
        ]);
        $europePost->tags()->attach($europe);

        $flightPost = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Flight Booking Guide',
            'slug' => 'flight-booking-guide',
            'content' => 'Flight booking tips.',
            'status' => true,
            'published_at' => now(),
        ]);
        $flightPost->tags()->attach($flights);

        $this
            ->get(route('website.blog', ['tag' => 'europe']))
            ->assertOk()
            ->assertSee('Posts tagged: Europe')
            ->assertSee('Europe Rail Guide')
            ->assertDontSee('Flight Booking Guide')
            ->assertSee(route('website.blog', ['tag' => 'europe'], false), false);
    }

    public function test_author_can_view_only_their_blog_tags(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $otherAuthor = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $europe = Tag::create(['name' => 'Europe', 'slug' => 'europe']);
        $flights = Tag::create(['name' => 'Flights', 'slug' => 'flights']);

        $authorPost = BlogPost::create([
            'author_id' => $author->id,
            'title' => 'Author Europe Post',
            'slug' => 'author-europe-post',
            'content' => 'Author content.',
        ]);
        $authorPost->tags()->attach($europe);

        $otherPost = BlogPost::create([
            'author_id' => $otherAuthor->id,
            'title' => 'Other Flights Post',
            'slug' => 'other-flights-post',
            'content' => 'Other content.',
        ]);
        $otherPost->tags()->attach($flights);

        $this
            ->actingAs($author)
            ->get(route('blog-tags.index'))
            ->assertOk()
            ->assertSee('Europe')
            ->assertSee('europe')
            ->assertDontSee('Flights')
            ->assertSee(route('website.blog', ['tag' => 'europe'], false), false);
    }

    public function test_blog_tag_can_be_created_from_tags_page(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $response = $this
            ->actingAs($author)
            ->post(route('blog-tags.store'), [
                'name' => 'Travel Deals',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Travel Deals',
            'slug' => 'travel-deals',
        ]);
    }

    public function test_blog_tag_can_be_deleted_from_tags_page(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $tag = Tag::create(['name' => 'Travel Deals', 'slug' => 'travel-deals']);

        $response = $this
            ->actingAs($author)
            ->delete(route('blog-tags.destroy', $tag));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('blog-tags.index'));

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->id,
        ]);
    }
}
