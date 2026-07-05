<?php
$airlines = [
    'american-airlines' => [
        'name' => 'American Airlines',
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
    'delta-air-lines' => [
        'name' => 'Delta Air Lines',
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
    'united-airlines' => [
        'name' => 'United Airlines',
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
    'british-airways' => [
        'name' => 'British Airways',
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
    'lufthansa' => [
        'name' => 'Lufthansa',
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
    'emirates-airlines' => [
        'name' => 'Emirates Airlines',
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

$sidebarPages = [
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

$airlineKey = request('airline', 'american-airlines');
$airline = $airlines[$airlineKey] ?? $airlines['american-airlines'];
$airlineKey = array_key_exists($airlineKey, $airlines) ? $airlineKey : 'american-airlines';

$pageKey = request('section', 'overview');
$pageKey = array_key_exists($pageKey, $sidebarPages) ? $pageKey : 'overview';
$activePageTitle = $sidebarPages[$pageKey];

$contentMap = [
    'overview' => [
        'title' => 'Overview',
        'body' => "{$airline['name']} is a major airline serving domestic and international routes. Use this page to compare flight options, review common travel policies, and connect with Fond Travels for booking support.",
    ],
    'book-manage' => [
        'title' => 'Book & Manage',
        'body' => "Fond Travels can help you book {$airline['name']} flights, review fare choices, add travelers, and understand booking updates before your trip.",
    ],
    'classes-seat' => [
        'title' => 'Classes & Seat Selection',
        'body' => "Review available cabin choices, seat selection options, and upgrade possibilities for {$airline['name']} before confirming your itinerary.",
    ],
    'checkin-onboard' => [
        'title' => 'Check-in & Onboard',
        'body' => "Check-in windows, boarding groups, and onboard services can vary by route and fare. Keep your confirmation details ready when checking in for {$airline['name']} flights.",
    ],
    'baggage' => [
        'title' => 'Baggage',
        'body' => "Baggage rules depend on your fare, destination, and loyalty status. Confirm carry-on, personal item, and checked bag allowances before traveling with {$airline['name']}.",
    ],
    'unaccompanied' => [
        'title' => 'Unaccompanied Minor & Infant',
        'body' => "{$airline['name']} may require special documentation, fees, and service steps for infants or unaccompanied minors. Verify requirements before booking.",
    ],
    'cancellation' => [
        'title' => 'Cancellation & Refund',
        'body' => "Cancellation eligibility, travel credits, and refund timelines depend on fare rules. Fond Travels can help you review your {$airline['name']} ticket conditions.",
    ],
    'flight-change' => [
        'title' => 'Flight Name & Date Change',
        'body' => "Name corrections and date changes follow airline fare rules and availability. Check change fees and fare differences before updating a {$airline['name']} reservation.",
    ],
    'pet-travel' => [
        'title' => 'Pet Travel',
        'body' => "Pet travel rules can include carrier size, route restrictions, and advance approval. Review {$airline['name']} pet travel requirements before departure.",
    ],
    'loyalty' => [
        'title' => 'Loyalty Programs',
        'body' => "Add your frequent flyer number when booking {$airline['name']} flights so eligible trips can earn miles or loyalty credit.",
    ],
    'insurance' => [
        'title' => 'Travel Insurance',
        'body' => "Travel insurance may help protect eligible trip costs for delays, cancellations, medical needs, and other covered disruptions.",
    ],
    'deals' => [
        'title' => 'Flight Deals',
        'body' => "Call Fond Travels to compare published and available {$airline['name']} fares for your dates, route, and cabin preference.",
    ],
    'destinations' => [
        'title' => 'Destinations',
        'body' => "{$airline['name']} serves popular business and leisure destinations. Use the route list below as a starting point for trip planning.",
    ],
    'cruises' => [
        'title' => 'Cruises',
        'body' => "Coordinate flights with cruise departures and arrivals so your {$airline['name']} itinerary leaves enough connection time around port schedules.",
    ],
    'vacations' => [
        'title' => 'Vacations',
        'body' => "Bundle flights, hotels, cars, or activities with Fond Travels for a smoother vacation plan around your {$airline['name']} flights.",
    ],
];

$pageTitle = "{$airline['name']} Flights & Travel Guide | Fond Travels";
$pageDescription = "{$airline['intro']} Get 24/7 assistance from Fond Travels.";
$extraCSS = ['css/hero.css', 'css/airline.css'];
$extraJS = ['js/search.js'];
ob_start();
?>

<section class="airline-banner">
    <div class="container airline-banner-container">
        <div class="airline-hero-copy">
            <span class="airline-kicker">{{ $airline['code'] }} Airline Guide</span>
            <h1>{{ $airline['name'] }}</h1>
            <p>{{ $airline['intro'] }}</p>
        </div>

        <div class="search-widget airline-search-widget" id="searchWidget">
            <div class="widget-tabs" role="tablist">
                <button class="tab-btn active" type="button" role="tab" aria-selected="true" aria-controls="flights-pane" id="tab-flights">
                    <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                    Flights
                </button>
                <button class="tab-btn" type="button" role="tab" aria-selected="false" aria-controls="hotels-pane" id="tab-hotels">
                    <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M7 13c1.66 0 3-1.34 3-3S8.66 7 7 7s-3 1.34-3 3 1.34 3 3 3zm12-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z"/></svg>
                    Hotels
                </button>
                <button class="tab-btn" type="button" role="tab" aria-selected="false" aria-controls="vacations-pane" id="tab-vacations">
                    <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14.5 12c.83 0 1.5-.67 1.5-1.5S15.33 9 14.5 9s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm5-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z"/></svg>
                    Vacations
                </button>
                <button class="tab-btn" type="button" role="tab" aria-selected="false" aria-controls="car-pane" id="tab-car">
                    <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.27-3.82c.07-.21.27-.35.49-.35h10.48c.22 0 .42.14.49.35L19 11H5z"/></svg>
                    Car
                </button>
                <button class="tab-btn" type="button" role="tab" aria-selected="false" aria-controls="bus-pane" id="tab-bus">
                    <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M4 16c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h10v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-4.5c0-4.88-3.95-8.5-8.5-8.5T4 6.62V16zm4-8.5c.83 0 1.5.67 1.5 1.5S8.83 10.5 8 10.5 6.5 9.83 6.5 9 7.17 7.5 8 7.5zm8 0c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-8 7c-.55 0-1-.45-1-1v-1c0-.55.45-1 1-1h8c.55 0 1 .45 1 1v1c0 .55-.45 1-1 1H8z"/></svg>
                    Bus
                </button>
            </div>

            <div class="widget-content">
                <div class="tab-pane active" id="flights-pane" role="tabpanel" aria-labelledby="tab-flights">
                    <form class="search-form" id="flight-search-form" action="{{ route('website.flights') }}" method="GET">
                        <div class="form-modifiers">
                            <div class="trip-type-group">
                                <label class="radio-label">
                                    <input type="radio" name="trip-type" value="roundtrip" checked>
                                    <span class="custom-radio"></span>
                                    RoundTrip
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="trip-type" value="oneway">
                                    <span class="custom-radio"></span>
                                    One Way
                                </label>
                            </div>

                            <div class="passenger-dropdown-container">
                                <button type="button" class="passenger-select-btn" id="passengerDropdownTrigger" aria-expanded="false" aria-haspopup="true">
                                    <span id="passenger-summary">1 Traveler Economy</span>
                                    <svg class="dropdown-chevron" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                                </button>
                                <div class="passenger-popup" id="passengerPopup" aria-hidden="true">
                                    <div class="popup-row">
                                        <div class="popup-label-col">
                                            <span class="popup-title">Adults</span>
                                            <span class="popup-desc">12+ years</span>
                                        </div>
                                        <div class="counter-control">
                                            <button type="button" class="btn-count minus" data-type="adults" aria-label="Decrease Adults">-</button>
                                            <span class="count-value" id="count-adults">1</span>
                                            <button type="button" class="btn-count plus" data-type="adults" aria-label="Increase Adults">+</button>
                                        </div>
                                    </div>
                                    <div class="popup-row">
                                        <div class="popup-label-col">
                                            <span class="popup-title">Children</span>
                                            <span class="popup-desc">2-11 years</span>
                                        </div>
                                        <div class="counter-control">
                                            <button type="button" class="btn-count minus" data-type="children" aria-label="Decrease Children">-</button>
                                            <span class="count-value" id="count-children">0</span>
                                            <button type="button" class="btn-count plus" data-type="children" aria-label="Increase Children">+</button>
                                        </div>
                                    </div>
                                    <div class="popup-row">
                                        <div class="popup-label-col">
                                            <span class="popup-title">Infants</span>
                                            <span class="popup-desc">Under 2 years</span>
                                        </div>
                                        <div class="counter-control">
                                            <button type="button" class="btn-count minus" data-type="infants" aria-label="Decrease Infants">-</button>
                                            <span class="count-value" id="count-infants">0</span>
                                            <button type="button" class="btn-count plus" data-type="infants" aria-label="Increase Infants">+</button>
                                        </div>
                                    </div>
                                    <div class="popup-row cabin-row">
                                        <span class="popup-title">Class</span>
                                        <select name="cabin-class" id="cabin-class" class="cabin-select">
                                            <option value="Economy" selected>Economy</option>
                                            <option value="Premium Economy">Premium Economy</option>
                                            <option value="Business">Business</option>
                                            <option value="First Class">First Class</option>
                                        </select>
                                    </div>
                                    <div class="popup-footer">
                                        <button type="button" class="btn btn-apply" id="applyPassengers">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="input-wrapper flying-from-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                                </span>
                                <input type="text" name="origin" id="origin-input" placeholder="Flying From" autocomplete="off" required>
                                <div class="autocomplete-list" id="origin-suggestions"></div>
                            </div>

                            <button type="button" class="btn-swap" id="swapLocationsButton" aria-label="Swap departure and arrival locations">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                            </button>

                            <div class="input-wrapper flying-to-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" transform="rotate(90 12 12)"/></svg>
                                </span>
                                <input type="text" name="destination" id="destination-input" placeholder="Flying To" autocomplete="off" required>
                                <div class="autocomplete-list" id="destination-suggestions"></div>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="depart-date" id="depart-date-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper date-wrapper" id="return-date-container">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="return-date" id="return-date-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="hotels-pane" role="tabpanel" aria-labelledby="tab-hotels">
                    <form class="search-form" id="hotel-search-form" action="{{ route('website.hotels') }}" method="GET">
                        <div class="form-grid-5">
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </span>
                                <input type="text" name="destination" id="hotel-destination-input" placeholder="Where to? (Destination/Hotel Name)" autocomplete="off" required>
                                <div class="autocomplete-list" id="hotel-destination-suggestions"></div>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="checkin" id="hotel-checkin-input" placeholder="Check-In Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="checkout" id="hotel-checkout-input" placeholder="Check-Out Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper select-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M7 13c1.66 0 3-1.34 3-3S8.66 7 7 7s-3 1.34-3 3 1.34 3 3 3zm12-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z"/></svg>
                                </span>
                                <select name="rooms-guests" id="hotel-rooms-guests" required>
                                    <option value="1-1" selected>1 Room, 1 Guest</option>
                                    <option value="1-2">1 Room, 2 Guests</option>
                                    <option value="2-4">2 Rooms, 4 Guests</option>
                                    <option value="3-6">3 Rooms, 6 Guests</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="vacations-pane" role="tabpanel" aria-labelledby="tab-vacations">
                    <form class="search-form" id="vacation-search-form" action="{{ route('website.packages') }}" method="GET">
                        <div class="form-grid">
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                                </span>
                                <input type="text" name="origin" id="vacation-origin-input" placeholder="Flying From" autocomplete="off" required>
                                <div class="autocomplete-list" id="vacation-origin-suggestions"></div>
                            </div>

                            <button type="button" class="btn-swap" id="vacationSwapButton" aria-label="Swap departure and arrival locations">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                            </button>

                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" transform="rotate(90 12 12)"/></svg>
                                </span>
                                <input type="text" name="destination" id="vacation-destination-input" placeholder="Flying To" autocomplete="off" required>
                                <div class="autocomplete-list" id="vacation-destination-suggestions"></div>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="depart-date" id="vacation-depart-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="return-date" id="vacation-return-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="car-pane" role="tabpanel" aria-labelledby="tab-car">
                    <form class="search-form" id="car-search-form" action="{{ route('website.cars') }}" method="GET">
                        <div class="form-grid-5">
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </span>
                                <input type="text" name="pickup" id="car-pickup-input" placeholder="Pick-up Location (Airport / City)" autocomplete="off" required>
                                <div class="autocomplete-list" id="car-pickup-suggestions"></div>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="pickup-date" id="car-pickup-date-input" placeholder="Pick-up Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="dropoff-date" id="car-dropoff-date-input" placeholder="Drop-off Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper select-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.27-3.82c.07-.21.27-.35.49-.35h10.48c.22 0 .42.14.49.35L19 11H5z"/></svg>
                                </span>
                                <select name="car-type" id="car-type-select" required>
                                    <option value="economy" selected>Economy / Compact</option>
                                    <option value="sedan">Standard Sedan</option>
                                    <option value="suv">SUV / Crossover</option>
                                    <option value="luxury">Luxury / Convertible</option>
                                    <option value="van">Minivan / Van</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="bus-pane" role="tabpanel" aria-labelledby="tab-bus">
                    <form class="search-form" id="bus-search-form" action="{{ route('website.flights') }}" method="GET">
                        <div class="form-grid">
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </span>
                                <input type="text" name="origin" id="bus-origin-input" placeholder="From (City / Station)" autocomplete="off" required>
                                <div class="autocomplete-list" id="bus-origin-suggestions"></div>
                            </div>

                            <button type="button" class="btn-swap" id="busSwapButton" aria-label="Swap departure and arrival locations">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                            </button>

                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </span>
                                <input type="text" name="destination" id="bus-destination-input" placeholder="To (City / Station)" autocomplete="off" required>
                                <div class="autocomplete-list" id="bus-destination-suggestions"></div>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="depart-date" id="bus-journey-date-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <div class="input-wrapper date-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                                </span>
                                <input type="text" name="return-date" id="bus-return-date-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                            </div>

                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="airline-title-section">
    <div class="container">
        <span class="airline-page-label">Fond Travels Airline Support</span>
        <h2>{{ $airline['name'] }} {{ $activePageTitle }}</h2>
        <p>{{ $airline['intro'] }}</p>
    </div>
</section>

<section class="airline-content-section">
    <div class="container">
        <div class="airline-layout">
            <aside class="airline-sidebar" aria-label="{{ $airline['name'] }} page navigation">
                <div class="airline-sidebar-heading">Airline Pages</div>
                <ul class="airline-nav-list">
                    <?php foreach ($sidebarPages as $key => $label): ?>
                        <li>
                            <a
                                href="{{ route('website.airline', ['airline' => $airlineKey, 'section' => $key]) }}"
                                class="airline-nav-item {{ $pageKey === $key ? 'active' : '' }}"
                                @if ($pageKey === $key) aria-current="page" @endif
                            >
                                {{ $label }}
                                <span class="arrow">&rsaquo;</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <main class="airline-main-content">
                <article class="airline-content-card">
                    <div class="airline-code-badge">{{ $airline['code'] }}</div>
                    <h2>{{ $contentMap[$pageKey]['title'] }}</h2>
                    <p>{{ $contentMap[$pageKey]['body'] }}</p>
                    <div class="airline-help-strip">
                        <strong>Need a quick fare check?</strong>
                        <span>Call our 24/7 travel experts at <a href="tel:+13238006001">+1 (323) 800-6001</a>.</span>
                    </div>
                </article>

                <section class="airline-popular-flights">
                    <h3 class="airline-section-title"><span>Popular Flights from</span> {{ $airline['name'] }}</h3>
                    <div class="popular-flights-box">
                        <ul class="popular-flights-list">
                            <?php foreach ($airline['routes'] as $route): ?>
                                <li>{{ $route }}</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>

                <section class="airline-faq-section">
                    <h3 class="airline-section-title">Frequently Asked Questions</h3>
                    <div class="faq-accordion">
                        <details class="faq-item">
                            <summary>How can I book {{ $airline['name'] }} flights with Fond Travels?</summary>
                            <div class="faq-content">
                                <p>Use the flight search form above or call Fond Travels for live help comparing fares and booking options.</p>
                            </div>
                        </details>
                        <details class="faq-item">
                            <summary>Can I change or cancel my {{ $airline['name'] }} booking?</summary>
                            <div class="faq-content">
                                <p>Yes, but eligibility, fees, and credits depend on the fare rules attached to your ticket.</p>
                            </div>
                        </details>
                        <details class="faq-item">
                            <summary>Does the sidebar open tabs?</summary>
                            <div class="faq-content">
                                <p>No. Each sidebar item is a normal link that loads the requested airline page section while keeping the same sidebar layout.</p>
                            </div>
                        </details>
                    </div>
                </section>
            </main>
        </div>
    </div>
</section>

<?php
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.airline', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
