<?php

namespace Tests\Feature;

use App\Models\FlightCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FlightCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_flight_categories_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->get(route('flight-categories.index'));

        $response
            ->assertOk()
            ->assertSee('Flight Categories')
            ->assertSee('Add Flight Category');
    }

    public function test_flight_category_can_be_created(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $parent = FlightCategory::create([
            'name' => 'Domestic Flights',
            'slug' => 'domestic-flights',
            'image_path' => 'flight-categories/domestic.jpg',
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('flight-categories.store'), [
                'name' => 'Business Class',
                'parent_id' => $parent->id,
                'category_image' => UploadedFile::fake()->image('business.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('flight-categories.index'));

        $category = FlightCategory::where('slug', 'business-class')->firstOrFail();

        $this->assertSame('Business Class', $category->name);
        $this->assertSame($parent->id, $category->parent_id);
        $this->assertSame('business.jpg', $category->image_original_name);
        $this->assertSame('flight-categories/business.jpg', $category->image_path);
        Storage::disk('public')->assertExists($category->image_path);
    }

    public function test_flight_category_can_be_updated(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = FlightCategory::create([
            'name' => 'Domestic Flights',
            'slug' => 'domestic-flights',
            'image_path' => UploadedFile::fake()->image('old.jpg')->store('flight-categories', 'public'),
            'image_original_name' => 'old.jpg',
        ]);
        $oldImage = $category->image_path;

        $response = $this
            ->actingAs($user)
            ->put(route('flight-categories.update', $category), [
                'name' => 'International Flights',
                'slug' => 'international-flights',
                'parent_id' => '',
                'category_image' => UploadedFile::fake()->image('new.jpg'),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('flight-categories.index'));

        $category->refresh();

        $this->assertSame('International Flights', $category->name);
        $this->assertSame('international-flights', $category->slug);
        $this->assertNull($category->parent_id);
        $this->assertSame('new.jpg', $category->image_original_name);
        $this->assertSame('flight-categories/new.jpg', $category->image_path);
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($category->image_path);
    }

    public function test_flight_category_show_displays_parent_or_main_category(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $main = FlightCategory::create([
            'name' => 'Main Fare',
            'slug' => 'main-fare',
            'image_path' => 'flight-categories/main.jpg',
        ]);
        $child = FlightCategory::create([
            'name' => 'Saver Fare',
            'slug' => 'saver-fare',
            'parent_id' => $main->id,
            'image_path' => 'flight-categories/saver.jpg',
        ]);

        $this
            ->actingAs($user)
            ->get(route('flight-categories.show', $main))
            ->assertOk()
            ->assertSee('Main category');

        $this
            ->actingAs($user)
            ->get(route('flight-categories.show', $child))
            ->assertOk()
            ->assertSee('Main Fare');
    }

    public function test_flight_category_can_be_deleted(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = FlightCategory::create([
            'name' => 'Domestic Flights',
            'slug' => 'domestic-flights',
            'image_path' => UploadedFile::fake()->image('category.jpg')->store('flight-categories', 'public'),
        ]);
        $imagePath = $category->image_path;

        $response = $this
            ->actingAs($user)
            ->delete(route('flight-categories.destroy', $category));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('flight-categories.index'));

        $this->assertDatabaseMissing('flight_categories', [
            'id' => $category->id,
        ]);
        Storage::disk('public')->assertMissing($imagePath);
    }
}
