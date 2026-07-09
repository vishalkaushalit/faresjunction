<?php

namespace Tests\Feature;

use App\Models\FlightRouteDestination;
use App\Models\FlightCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FlightRouteDestinationTest extends TestCase
{
    use RefreshDatabase;

    public function test_flight_routes_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->get(route('flight-routes.index'));

        $response
            ->assertOk()
            ->assertSee('Flight Routes')
            ->assertSee('Add Route');
    }

    public function test_flight_destination_can_be_created(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = FlightCategory::create([
            'name' => 'International Flights',
            'slug' => 'international-flights',
            'image_path' => 'flight-categories/international.jpg',
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('flight-destinations.store'), [
                'flight_category_id' => $category->id,
                'image' => UploadedFile::fake()->image('dubai.jpg'),
                'route_text' => 'Dubai',
                'trip_type' => 'round_trip',
                'cabin_class' => 'Businesss',
                'pricing' => '$899',
                'tag' => 'Featured',
                'description' => '<p>Dubai flight destination.</p>',
                'is_published' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('flight-destinations.index'));

        $destination = FlightRouteDestination::where('route_text', 'Dubai')->firstOrFail();

        $this->assertSame(FlightRouteDestination::TYPE_DESTINATION, $destination->type);
        $this->assertSame($category->id, $destination->flight_category_id);
        $this->assertSame('flight-destinations/dubai.jpg', $destination->image_path);
        $this->assertSame('dubai.jpg', $destination->image_original_name);
        $this->assertTrue($destination->is_published);
        Storage::disk('public')->assertExists('flight-destinations/dubai.jpg');
    }

    public function test_flight_route_can_be_updated(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $category = FlightCategory::create([
            'name' => 'Domestic Flights',
            'slug' => 'domestic-flights',
            'image_path' => 'flight-categories/domestic.jpg',
        ]);
        $route = FlightRouteDestination::create([
            'type' => FlightRouteDestination::TYPE_ROUTE,
            'flight_category_id' => $category->id,
            'image_path' => UploadedFile::fake()->image('old-route.jpg')->storeAs('flight-routes', 'old-route.jpg', 'public'),
            'image_original_name' => 'old-route.jpg',
            'route_text' => 'New York to London',
            'trip_type' => 'one_way',
            'cabin_class' => 'Economy',
            'pricing' => '$399',
            'tag' => 'Deal',
            'description' => '<p>Old description.</p>',
            'is_published' => false,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('flight-routes.update', $route), [
                'image' => UploadedFile::fake()->image('new-route.jpg'),
                'flight_category_id' => $category->id,
                'route_text' => 'New York to London via Boston',
                'trip_type' => 'multi_city',
                'cabin_class' => 'Premium Economy',
                'pricing' => '$599',
                'tag' => 'Popular',
                'description' => '<p>Updated route.</p>',
                'is_published' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('flight-routes.index'));

        $route->refresh();

        $this->assertSame('New York to London via Boston', $route->route_text);
        $this->assertSame($category->id, $route->flight_category_id);
        $this->assertSame('multi_city', $route->trip_type);
        $this->assertSame('Premium Economy', $route->cabin_class);
        $this->assertSame('flight-routes/new-route.jpg', $route->image_path);
        $this->assertSame('new-route.jpg', $route->image_original_name);
        $this->assertTrue($route->is_published);
        Storage::disk('public')->assertMissing('flight-routes/old-route.jpg');
        Storage::disk('public')->assertExists('flight-routes/new-route.jpg');
    }
}
