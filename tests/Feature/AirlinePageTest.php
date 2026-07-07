<?php

namespace Tests\Feature;

use App\Models\AirlinePage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirlinePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_airline_pages_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->get(route('airline-pages.index'));

        $response
            ->assertOk()
            ->assertSee('Airline Pages')
            ->assertSee('Add Airline Page');
    }

    public function test_airline_page_can_be_created(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this
            ->actingAs($user)
            ->post(route('airline-pages.store'), [
                'name' => 'Test Airways',
                'code' => 'TA',
                'intro' => 'Compare Test Airways flights with Fares Junction.',
                'routes_text' => "New York (JFK) to Miami (MIA)\nChicago (ORD) to Dallas (DFW)",
                'faqs' => [
                    [
                        'question' => 'How do I book Test Airways?',
                        'answer' => 'Call Fares Junction to book Test Airways.',
                    ],
                    [
                        'question' => '',
                        'answer' => 'This incomplete FAQ is ignored.',
                    ],
                ],
                'sections' => [
                    'overview' => [
                        'title' => 'Overview',
                        'body' => 'Test Airways overview content.',
                    ],
                ],
                'status' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('airline-pages.index'));

        $this->assertDatabaseHas('airline_pages', [
            'name' => 'Test Airways',
            'slug' => 'test-airways',
            'code' => 'TA',
            'status' => true,
        ]);

        $airlinePage = AirlinePage::query()->where('slug', 'test-airways')->firstOrFail();

        $this->assertSame([
            'New York (JFK) to Miami (MIA)',
            'Chicago (ORD) to Dallas (DFW)',
        ], $airlinePage->routes);
        $this->assertSame([
            [
                'question' => 'How do I book Test Airways?',
                'answer' => 'Call Fares Junction to book Test Airways.',
            ],
        ], $airlinePage->faqs);
        $this->assertSame('Test Airways overview content.', $airlinePage->sections['overview']['body']);
    }

    public function test_public_airline_page_renders_database_content(): void
    {
        AirlinePage::create([
            'name' => 'Test Airways',
            'slug' => 'test-airways',
            'code' => 'TA',
            'intro' => 'Compare Test Airways flights with Fares Junction.',
            'routes' => ['New York (JFK) to Miami (MIA)'],
            'faqs' => [
                [
                    'question' => 'Does Test Airways have a custom FAQ?',
                    'answer' => 'Yes, this FAQ comes from the database.',
                ],
            ],
            'sections' => [
                'overview' => [
                    'title' => 'Overview',
                    'body' => 'Test Airways overview content.',
                ],
            ],
            'status' => true,
        ]);

        $response = $this->get(route('website.airline.slug', 'test-airways'));

        $response
            ->assertOk()
            ->assertSee('Test Airways')
            ->assertSee('TA Airline Guide')
            ->assertSee('Test Airways overview content.')
            ->assertSee('Does Test Airways have a custom FAQ?')
            ->assertSee('Yes, this FAQ comes from the database.')
            ->assertSee('New York (JFK) to Miami (MIA)');
    }

    public function test_public_airline_page_hides_faq_section_when_no_faqs_exist(): void
    {
        AirlinePage::create([
            'name' => 'Test Airways',
            'slug' => 'test-airways',
            'code' => 'TA',
            'intro' => 'Compare Test Airways flights with Fares Junction.',
            'sections' => [
                'overview' => [
                    'title' => 'Overview',
                    'body' => 'Test Airways overview content.',
                ],
            ],
            'faqs' => [],
            'status' => true,
        ]);

        $response = $this->get(route('website.airline.slug', 'test-airways'));

        $response
            ->assertOk()
            ->assertDontSee('Frequently Asked Questions')
            ->assertDontSee('How can I check-in for my Test Airways flight?');
    }

    public function test_public_airline_sidebar_hides_sections_without_body_content(): void
    {
        AirlinePage::create([
            'name' => 'Test Airways',
            'slug' => 'test-airways',
            'code' => 'TA',
            'intro' => 'Compare Test Airways flights with Fares Junction.',
            'routes' => ['New York (JFK) to Miami (MIA)'],
            'sections' => [
                'overview' => [
                    'title' => 'Overview',
                    'body' => 'Visible overview content.',
                ],
                'baggage' => [
                    'title' => 'Baggage',
                    'body' => '',
                ],
                'cancellation' => [
                    'title' => 'Cancellation & Refund',
                    'body' => 'Visible cancellation content.',
                ],
            ],
            'status' => true,
        ]);

        $response = $this->get(route('website.airline.slug', 'test-airways') . '?section=baggage');

        $response
            ->assertOk()
            ->assertSee('Visible overview content.')
            ->assertSee('section=overview', false)
            ->assertSee('section=cancellation', false)
            ->assertDontSee('section=baggage', false);
    }

    public function test_new_active_airline_appears_in_public_footer(): void
    {
        AirlinePage::create([
            'name' => 'Footer Airways',
            'slug' => 'footer-airways',
            'code' => 'FA',
            'intro' => 'Compare Footer Airways flights with Fares Junction.',
            'sections' => [
                'overview' => [
                    'title' => 'Overview',
                    'body' => 'Footer Airways overview content.',
                ],
            ],
            'status' => true,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Footer Airways')
            ->assertSee(route('website.airline.slug', 'footer-airways'), false);
    }
}
