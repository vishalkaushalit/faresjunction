<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('airline_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code', 10)->nullable();
            $table->text('intro')->nullable();
            $table->json('routes')->nullable();
            $table->json('sections')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $sectionLabels = [
            'overview' => 'Overview',
            'book-manage' => 'Book & Manage',
            'classes-seat' => 'Classes & Seat Selection',
            'checkin-onboard' => 'Check-in & Onboard',
            'baggage' => 'Baggage',
            'unaccompanied' => 'Unaccompanied Minor & Infant',
            'cancellation' => 'Cancellation & Refund',
            'flight-change' => 'Flight Name & Date Change',
            'pet-travel' => 'Pet Travel',
            'loyalty' => 'Loyalty Programs',
            'insurance' => 'Travel Insurance',
            'deals' => 'Flight Deals',
            'destinations' => 'Destinations',
            'cruises' => 'Cruises',
            'vacations' => 'Vacations',
        ];

        $airlines = [
            [
                'name' => 'American Airlines',
                'slug' => 'american-airlines',
                'code' => 'AA',
                'intro' => 'Book cheap American Airlines flights, compare popular routes, and get help with booking, check-in, baggage, cancellations, and travel extras.',
                'routes' => [
                    'Detroit (DTW) to Orlando (MCO)',
                    'Chicago (ORD) to Fort Lauderdale (FLL)',
                    'Houston (IAH) to Las Vegas (LAS)',
                    'Newark (EWR) to Fort Lauderdale (FLL)',
                    'Dallas (DFW) to Las Vegas (LAS)',
                    'New York City to Fort Lauderdale',
                    'Detroit (DTW) to Las Vegas (LAS)',
                    'Baltimore/Washington DC to Fort Lauderdale',
                ],
            ],
            [
                'name' => 'Delta Air Lines',
                'slug' => 'delta-air-lines',
                'code' => 'DL',
                'intro' => 'Find Delta Air Lines flight deals, plan domestic or international travel, and review the essentials before you fly.',
                'routes' => [
                    'Atlanta (ATL) to New York (JFK)',
                    'Los Angeles (LAX) to Seattle (SEA)',
                    'Detroit (DTW) to Las Vegas (LAS)',
                    'Minneapolis (MSP) to Orlando (MCO)',
                    'Boston (BOS) to Miami (MIA)',
                    'Salt Lake City (SLC) to Denver (DEN)',
                    'New York (LGA) to Chicago (ORD)',
                    'Atlanta (ATL) to Fort Lauderdale (FLL)',
                ],
            ],
            [
                'name' => 'United Airlines',
                'slug' => 'united-airlines',
                'code' => 'UA',
                'intro' => 'Compare United Airlines flight options and use this guide for booking, seat, baggage, and travel policy support.',
                'routes' => [
                    'Chicago (ORD) to Denver (DEN)',
                    'Newark (EWR) to Los Angeles (LAX)',
                    'Houston (IAH) to Cancun (CUN)',
                    'San Francisco (SFO) to Honolulu (HNL)',
                    'Washington DC (IAD) to London (LHR)',
                    'Denver (DEN) to Phoenix (PHX)',
                    'Newark (EWR) to Orlando (MCO)',
                    'Chicago (ORD) to Fort Lauderdale (FLL)',
                ],
            ],
            [
                'name' => 'British Airways',
                'slug' => 'british-airways',
                'code' => 'BA',
                'intro' => 'Compare British Airways flights, review long-haul travel options, and get support with booking, baggage, seats, and schedule changes.',
                'routes' => [
                    'New York (JFK) to London (LHR)',
                    'Los Angeles (LAX) to London (LHR)',
                    'Chicago (ORD) to London (LHR)',
                    'Boston (BOS) to London (LHR)',
                    'Miami (MIA) to London (LHR)',
                    'San Francisco (SFO) to London (LHR)',
                    'London (LHR) to Paris (CDG)',
                    'London (LHR) to Rome (FCO)',
                ],
            ],
            [
                'name' => 'Lufthansa',
                'slug' => 'lufthansa',
                'code' => 'LH',
                'intro' => 'Find Lufthansa flight options for Europe and beyond, with booking help for seats, baggage, connections, and travel policies.',
                'routes' => [
                    'New York (JFK) to Frankfurt (FRA)',
                    'Chicago (ORD) to Munich (MUC)',
                    'Los Angeles (LAX) to Frankfurt (FRA)',
                    'Boston (BOS) to Munich (MUC)',
                    'Miami (MIA) to Frankfurt (FRA)',
                    'San Francisco (SFO) to Munich (MUC)',
                    'Frankfurt (FRA) to Berlin (BER)',
                    'Munich (MUC) to Rome (FCO)',
                ],
            ],
            [
                'name' => 'Emirates Airlines',
                'slug' => 'emirates-airlines',
                'code' => 'EK',
                'intro' => 'Explore Emirates Airlines flights, cabin options, baggage support, and international route planning with Fond Travels.',
                'routes' => [
                    'New York (JFK) to Dubai (DXB)',
                    'Los Angeles (LAX) to Dubai (DXB)',
                    'Chicago (ORD) to Dubai (DXB)',
                    'Houston (IAH) to Dubai (DXB)',
                    'San Francisco (SFO) to Dubai (DXB)',
                    'Boston (BOS) to Dubai (DXB)',
                    'Dubai (DXB) to Mumbai (BOM)',
                    'Dubai (DXB) to London (LHR)',
                ],
            ],
        ];

        DB::table('airline_pages')->insert(collect($airlines)->map(function (array $airline, int $index) use ($sectionLabels, $now): array {
            $sections = collect($sectionLabels)->mapWithKeys(function (string $title, string $key) use ($airline): array {
                return [$key => [
                    'title' => $title,
                    'body' => match ($key) {
                        'overview' => "{$airline['name']} is a major airline serving domestic and international routes. Use this page to compare flight options, review common travel policies, and connect with Fond Travels for booking support.",
                        'book-manage' => "Fond Travels can help you book {$airline['name']} flights, review fare choices, add travelers, and understand booking updates before your trip.",
                        'classes-seat' => "Review available cabin choices, seat selection options, and upgrade possibilities for {$airline['name']} before confirming your itinerary.",
                        'checkin-onboard' => "Check-in windows, boarding groups, and onboard services can vary by route and fare. Keep your confirmation details ready when checking in for {$airline['name']} flights.",
                        'baggage' => "Baggage rules depend on your fare, destination, and loyalty status. Confirm carry-on, personal item, and checked bag allowances before traveling with {$airline['name']}.",
                        'unaccompanied' => "{$airline['name']} may require special documentation, fees, and service steps for infants or unaccompanied minors. Verify requirements before booking.",
                        'cancellation' => "Cancellation eligibility, travel credits, and refund timelines depend on fare rules. Fond Travels can help you review your {$airline['name']} ticket conditions.",
                        'flight-change' => "Name corrections and date changes follow airline fare rules and availability. Check change fees and fare differences before updating a {$airline['name']} reservation.",
                        'pet-travel' => "Pet travel rules can include carrier size, route restrictions, and advance approval. Review {$airline['name']} pet travel requirements before departure.",
                        'loyalty' => "Add your frequent flyer number when booking {$airline['name']} flights so eligible trips can earn miles or loyalty credit.",
                        'insurance' => 'Travel insurance may help protect eligible trip costs for delays, cancellations, medical needs, and other covered disruptions.',
                        'deals' => "Call Fond Travels to compare published and available {$airline['name']} fares for your dates, route, and cabin preference.",
                        'destinations' => "{$airline['name']} serves popular business and leisure destinations. Use the route list below as a starting point for trip planning.",
                        'cruises' => "Coordinate flights with cruise departures and arrivals so your {$airline['name']} itinerary leaves enough connection time around port schedules.",
                        'vacations' => "Bundle flights, hotels, cars, or activities with Fond Travels for a smoother vacation plan around your {$airline['name']} flights.",
                    },
                ]];
            })->all();

            return [
                'name' => $airline['name'],
                'slug' => $airline['slug'],
                'code' => $airline['code'],
                'intro' => $airline['intro'],
                'routes' => json_encode($airline['routes']),
                'sections' => json_encode($sections),
                'meta_title' => "{$airline['name']} Flights & Travel Guide | Fond Travels",
                'meta_description' => "{$airline['intro']} Get 24/7 assistance from Fond Travels.",
                'status' => true,
                'sort_order' => $index + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all());
    }

    public function down(): void
    {
        Schema::dropIfExists('airline_pages');
    }
};
