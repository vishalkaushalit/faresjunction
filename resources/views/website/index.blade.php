<?php
require resource_path('views/layouts/includes/packages-data.php');

$pageTitle = "Fares Junction - Dynamic Flight & Holiday Booking";
$pageDescription = "Explore and book flights, hotels, and holiday destinations around the world with Fares Junction.";
$extraCSS = ['css/hero.css', 'css/features.css', 'css/vacations.css', 'css/destinations.css', 'css/deals.css', 'css/testimonials.css', 'css/blogs.css'];
$blogCardsData = $blogCardsData ?? [];
ob_start();
?>

        <!-- Hero Section -->
        <section class="hero-section">
          <!-- Background Graphics -->
          <div class="hero-bg-graphic map-graphic"></div>
          <div class="hero-bg-graphic plane-graphic"></div>
          
          <div class="container hero-container">
            <div class="hero-content">
              <h1 class="hero-title">Scores of cheap flights, 1000+ destinations</h1>
              <p class="hero-subtitle">
                Call us at our 24/7 Number <a href="tel:+13238006001" class="hero-phone">+1 (323) 800-6001</a> to Get Best Flight Deals.
              </p>
            </div>

            <!-- Search Form Widget -->
            <div class="search-widget" id="searchWidget">
              <!-- Tabs Header -->
              <div class="widget-tabs" role="tablist">
                <button class="tab-btn active" role="tab" aria-selected="true" aria-controls="flights-pane" id="tab-flights">
                  <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                  Flights
                </button>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="hotels-pane" id="tab-hotels">
                  <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M7 13c1.66 0 3-1.34 3-3S8.66 7 7 7s-3 1.34-3 3 1.34 3 3 3zm12-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z"/></svg>
                  Hotels
                </button>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="vacations-pane" id="tab-vacations">
                  <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14.5 12c.83 0 1.5-.67 1.5-1.5S15.33 9 14.5 9s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm5-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z"/></svg>
                  Vacations
                </button>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="car-pane" id="tab-car">
                  <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.27-3.82c.07-.21.27-.35.49-.35h10.48c.22 0 .42.14.49.35L19 11H5z"/></svg>
                  Car
                </button>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="bus-pane" id="tab-bus">
                  <svg class="tab-icon" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M4 16c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h10v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-4.5c0-4.88-3.95-8.5-8.5-8.5T4 6.62V16zm4-8.5c.83 0 1.5.67 1.5 1.5S8.83 10.5 8 10.5 6.5 9.83 6.5 9 7.17 7.5 8 7.5zm8 0c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-8 7c-.55 0-1-.45-1-1v-1c0-.55.45-1 1-1h8c.55 0 1 .45 1 1v1c0 .55-.45 1-1 1H8z"/></svg>
                  Bus
                </button>
              </div>

              <!-- Tab Content Area -->
              <div class="widget-content">
                <!-- Flights Tab Pane -->
                <div class="tab-pane active" id="flights-pane" role="tabpanel" aria-labelledby="tab-flights">
                  <form class="search-form" id="flight-search-form" action="#" method="GET">
                    
                    <!-- Flight Modifiers -->
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

                      <!-- Passengers Dropdown -->
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

                    <!-- Fields Grid -->
                    <div class="form-grid">
                      <!-- Flying From -->
                      <div class="input-wrapper flying-from-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                        </span>
                        <input type="text" name="origin" id="origin-input" placeholder="Flying From" autocomplete="off" required>
                        <!-- Suggestions -->
                        <div class="autocomplete-list" id="origin-suggestions"></div>
                      </div>

                      <!-- Swap Button -->
                      <button type="button" class="btn-swap" id="swapLocationsButton" aria-label="Swap departure and arrival locations">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                      </button>

                      <!-- Flying To -->
                      <div class="input-wrapper flying-to-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" transform="rotate(90 12 12)"/></svg>
                        </span>
                        <input type="text" name="destination" id="destination-input" placeholder="Flying To" autocomplete="off" required>
                        <!-- Suggestions -->
                        <div class="autocomplete-list" id="destination-suggestions"></div>
                      </div>

                      <!-- Depart Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="depart-date" id="depart-date-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Return Date -->
                      <div class="input-wrapper date-wrapper" id="return-date-container">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="return-date" id="return-date-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Search Button -->
                      <button type="submit" class="btn btn-search">Search</button>

                    </div>
                  </form>
                </div>

                <!-- Hotels Tab Pane -->
                <div class="tab-pane" id="hotels-pane" role="tabpanel" aria-labelledby="tab-hotels">
                  <form class="search-form" id="hotel-search-form" action="hotels.php" method="GET">
                    <div class="form-grid-5">
                      <!-- Destination -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </span>
                        <input type="text" name="destination" id="hotel-destination-input" placeholder="Where to? (Destination/Hotel Name)" autocomplete="off" required>
                        <div class="autocomplete-list" id="hotel-destination-suggestions"></div>
                      </div>

                      <!-- Check-In Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="checkin" id="hotel-checkin-input" placeholder="Check-In Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Check-Out Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="checkout" id="hotel-checkout-input" placeholder="Check-Out Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Rooms & Guests -->
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

                      <!-- Search Button -->
                      <button type="submit" class="btn btn-search">Search</button>
                    </div>
                  </form>
                </div>

                <!-- Vacations Tab Pane -->
                <div class="tab-pane" id="vacations-pane" role="tabpanel" aria-labelledby="tab-vacations">
                  <form class="search-form" id="vacation-search-form" action="packages.php" method="GET">
                    <div class="form-grid">
                      <!-- Flying From -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                        </span>
                        <input type="text" name="origin" id="vacation-origin-input" placeholder="Flying From" autocomplete="off" required>
                        <div class="autocomplete-list" id="vacation-origin-suggestions"></div>
                      </div>

                      <!-- Swap Button -->
                      <button type="button" class="btn-swap" id="vacationSwapButton" aria-label="Swap departure and arrival locations">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                      </button>

                      <!-- Flying To -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" transform="rotate(90 12 12)"/></svg>
                        </span>
                        <input type="text" name="destination" id="vacation-destination-input" placeholder="Flying To" autocomplete="off" required>
                        <div class="autocomplete-list" id="vacation-destination-suggestions"></div>
                      </div>

                      <!-- Depart Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="depart-date" id="vacation-depart-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Return Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="return-date" id="vacation-return-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Search Button -->
                      <button type="submit" class="btn btn-search">Search</button>
                    </div>
                  </form>
                </div>

                <!-- Car Tab Pane -->
                <div class="tab-pane" id="car-pane" role="tabpanel" aria-labelledby="tab-car">
                  <form class="search-form" id="car-search-form" action="cars.php" method="GET">
                    <div class="form-grid-5">
                      <!-- Pickup Location -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </span>
                        <input type="text" name="pickup" id="car-pickup-input" placeholder="Pick-up Location (Airport / City)" autocomplete="off" required>
                        <div class="autocomplete-list" id="car-pickup-suggestions"></div>
                      </div>

                      <!-- Pick-up Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="pickup-date" id="car-pickup-date-input" placeholder="Pick-up Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Drop-off Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="dropoff-date" id="car-dropoff-date-input" placeholder="Drop-off Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Car Type -->
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

                      <!-- Search Button -->
                      <button type="submit" class="btn btn-search">Search</button>
                    </div>
                  </form>
                </div>

                <!-- Bus Tab Pane -->
                <div class="tab-pane" id="bus-pane" role="tabpanel" aria-labelledby="tab-bus">
                  <form class="search-form" id="bus-search-form" action="flights.php" method="GET">
                    <div class="form-grid">
                      <!-- From Station -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </span>
                        <input type="text" name="origin" id="bus-origin-input" placeholder="From (City / Station)" autocomplete="off" required>
                        <div class="autocomplete-list" id="bus-origin-suggestions"></div>
                      </div>

                      <!-- Swap Button -->
                      <button type="button" class="btn-swap" id="busSwapButton" aria-label="Swap departure and arrival locations">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"/></svg>
                      </button>

                      <!-- To Station -->
                      <div class="input-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </span>
                        <input type="text" name="destination" id="bus-destination-input" placeholder="To (City / Station)" autocomplete="off" required>
                        <div class="autocomplete-list" id="bus-destination-suggestions"></div>
                      </div>

                      <!-- Journey Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="depart-date" id="bus-journey-date-input" placeholder="Journey Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Return Date -->
                      <div class="input-wrapper date-wrapper">
                        <span class="input-icon">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        </span>
                        <input type="text" name="return-date" id="bus-return-date-input" placeholder="Return Date" onfocus="(this.type='date')" onblur="(this.value ? this.type='date' : this.type='text')" required>
                      </div>

                      <!-- Search Button -->
                      <button type="submit" class="btn btn-search">Search</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- FEATURES SECTION ("Reasons to Book") -->
        <section class="features-section" id="features">
          <div class="container">
            <div class="features-container-card">
              <div class="features-header">
                <h2 class="features-title">Reasons to book with <span>Fares Junction</span></h2>
              </div>
              <div class="features-grid">
                <!-- Card 1: Call Us 24 x 7 -->
                <a href="tel:+13238006001" class="feature-card">
                  <div class="feature-icon-wrapper">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                      <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1A11.36 11.36 0 018.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/>
                    </svg>
                  </div>
                  <div class="feature-info">
                    <h3 class="feature-card-title">Call Us 24 x 7</h3>
                    <p class="feature-card-desc">Our flight agents work round the clock.</p>
                  </div>
                </a>

                <!-- Card 2: We Know Travel -->
                <div class="feature-card">
                  <div class="feature-icon-wrapper">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                      <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                    </svg>
                  </div>
                  <div class="feature-info">
                    <h3 class="feature-card-title">We Know Travel</h3>
                    <p class="feature-card-desc">Get served by our deal specialists to save.</p>
                  </div>
                </div>

                <!-- Card 3: Easy Booking -->
                <div class="feature-card">
                  <div class="feature-icon-wrapper">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                      <path d="M9 11.24V7.5a2.5 2.5 0 015 0v3.74c1.21-.81 2-2.18 2-3.74a4.5 4.5 0 00-9 0c0 1.56.79 2.93 2 3.74zm10.74 3.01l-4.5-2.25a1.002 1.002 0 00-1.12.18l-1.9 1.9c-2.45-1.22-4.46-3.23-5.68-5.68l1.9-1.9c.27-.27.34-.68.18-1.02l-2.25-4.5c-.32-.64-1.11-.9-1.78-.52L1.87 2.06c-.53.3-.87.87-.87 1.48 0 8.01 6.5 14.51 14.51 14.51.61 0 1.18-.34 1.48-.87l1.58-3.16c.38-.67.12-1.46-.52-1.78z"/>
                    </svg>
                  </div>
                  <div class="feature-info">
                    <h3 class="feature-card-title">Easy Booking</h3>
                    <p class="feature-card-desc">Get your e-tickets in less than minutes.</p>
                  </div>
                </div>

                <!-- Card 4: Google Rating -->
                <div class="feature-card">
                  <div class="feature-icon-wrapper">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                      <path d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.287 4.114a6.286 6.286 0 010-12.57c2.519 0 4.56 1.8 5.143 4.229h4.286C22.56 4.3 17.96 0 12.24 0c-6.629 0-12 5.371-12 12s5.371 12 12 12c5.657 0 10.629-4.029 11.743-9.714v-4H12.24v.001z"/>
                    </svg>
                  </div>
                  <div class="feature-info">
                    <h3 class="feature-card-title">Google Rating</h3>
                    <p class="feature-card-desc">Rated 4.8 out of 5 on Google</p>
                    <div class="google-stars">
                      <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                      <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                      <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                      <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                      <svg viewBox="0 0 24 24"><path d="M12 17.27l-4.18 2.2 1.1-4.7-3.64-3.15 4.8-.41L12 6.57l1.92 4.14 4.8.41-3.64 3.15 1.1 4.7z"/></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- VACATION PACKAGES SECTION -->
        <section class="vacations-section" id="vacations">
          <div class="container">
            <div class="vacations-header-row">
              <div class="section-header">
                <span class="section-eyebrow">Dream Getaways</span>
                <h2 class="section-title">Popular Vacation Packages</h2>
                <p class="section-subtitle">Exotic beach trips and cultural tours designed just for you.</p>
              </div>
              <div class="vacations-controls">
                <button class="vacations-btn" id="vacationsPrev" aria-label="Previous vacations">
                  <svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                </button>
                <button class="vacations-btn" id="vacationsNext" aria-label="Next vacations">
                  <svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                </button>
              </div>
            </div>
            
            <div class="vacations-slider-wrapper">
              <div class="vacations-slider" id="vacationsSlider">
                <?php
                foreach ($packagesData as $key => $relPkg) {
                  $starsHtml = str_repeat('<svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>', $relPkg['stars']);
                  ?>
                  <a href="package-details.php?package=<?php echo urlencode($key); ?>" class="vacation-card">
                    <div class="vacation-img-wrapper">
                      <img src="<?php echo htmlspecialchars($relPkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($relPkg['title']); ?>" class="vacation-img" loading="lazy">
                    </div>
                    <div class="vacation-body">
                      <h3 class="vacation-title"><?php echo htmlspecialchars($relPkg['title']); ?></h3>
                      <p class="vacation-nights">
                        <?php echo preg_replace('/(\d+\s*Nights?)/i', '<span class="highlight-nights">$1</span>', htmlspecialchars($relPkg['nightsDetail'])); ?>
                      </p>
                      <div class="vacation-stars">
                        <?php echo $starsHtml; ?>
                      </div>
                      <div class="vacation-price-box">
                        <span class="vacation-price-label">Price starts from:</span>
                        <span class="vacation-price"><?php echo htmlspecialchars($relPkg['price']); ?> Per Person</span>
                      </div>
                      <span class="btn-vacation-offer">View Offer</span>
                    </div>
                  </a>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>
        </section>

        <!-- DESTINATIONS SECTION -->
        <section class="destinations-section" id="destinations">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Where To Go</span>
              <h2 class="section-title">Trending Global Destinations</h2>
              <p class="section-subtitle">Explore the world's most beloved destinations and find exclusive travel deals.</p>
            </div>
            <div class="destinations-grid">
              <!-- London -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=600&auto=format&fit=crop" alt="London, United Kingdom" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">United Kingdom</span>
                  <h3 class="dest-city">London</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
              <!-- Paris -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?w=600&auto=format&fit=crop" alt="Paris, France" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">France</span>
                  <h3 class="dest-city">Paris</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
              <!-- New York -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1518235506717-e1ed3306a89b?w=600&auto=format&fit=crop" alt="New York, USA" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">United States</span>
                  <h3 class="dest-city">New York</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
              <!-- Tokyo -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=600&auto=format&fit=crop" alt="Tokyo, Japan" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">Japan</span>
                  <h3 class="dest-city">Tokyo</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
              <!-- Dubai -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&auto=format&fit=crop" alt="Dubai, UAE" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">United Arab Emirates</span>
                  <h3 class="dest-city">Dubai</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
              <!-- Rome -->
              <a href="flights.php" class="destination-card">
                <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&auto=format&fit=crop" alt="Rome, Italy" class="dest-img" loading="lazy">
                <div class="dest-overlay">
                  <span class="dest-country">Italy</span>
                  <h3 class="dest-city">Rome</h3>
                  <span class="dest-link">Explore Deals <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                </div>
              </a>
            </div>
          </div>
        </section>

        <!-- DEALS SECTION -->
        <section class="deals-section" id="deals">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Hot Offers</span>
              <h2 class="section-title">Exclusive Flight Deals</h2>
              <p class="section-subtitle">Handpicked deals with lowest airfares — book before they are gone.</p>
            </div>
            <div class="deals-tabs" role="tablist">
              <button class="deal-tab-btn active" data-deal-filter="all">All Deals</button>
              <button class="deal-tab-btn" data-deal-filter="domestic">Domestic Flights</button>
              <button class="deal-tab-btn" data-deal-filter="international">International</button>
              <button class="deal-tab-btn" data-deal-filter="lastminute">Last-Minute</button>
            </div>
            <div class="deals-grid" id="dealsGrid">
              <!-- Deal 1 -->
              <a href="flights.php" class="deal-card" data-deal-type="international">
                <div class="deal-airline">
                  <div class="airline-logo">AA</div>
                  <span class="airline-name">American Airlines</span>
                </div>
                <div class="deal-route">
                  <div class="deal-route-row">
                    <span class="route-dot"></span>
                    <span class="route-city">New York</span><span class="route-code">JFK</span>
                  </div>
                  <div class="route-line" style="margin-left:3px;"></div>
                  <div class="deal-route-row">
                    <span class="route-dot" style="background:var(--secondary-color)"></span>
                    <span class="route-city">London</span><span class="route-code">LHR</span>
                  </div>
                </div>
                <div class="deal-footer">
                  <div><span class="deal-price-label">From</span><span class="deal-price">$389</span></div>
                  <span class="btn-book">Book Now</span>
                </div>
              </a>
              <!-- Deal 2 -->
              <a href="flights.php" class="deal-card" data-deal-type="domestic">
                <div class="deal-airline">
                  <div class="airline-logo">DL</div>
                  <span class="airline-name">Delta Air Lines</span>
                </div>
                <div class="deal-route">
                  <div class="deal-route-row">
                    <span class="route-dot"></span>
                    <span class="route-city">Los Angeles</span><span class="route-code">LAX</span>
                  </div>
                  <div class="route-line" style="margin-left:3px;"></div>
                  <div class="deal-route-row">
                    <span class="route-dot" style="background:var(--secondary-color)"></span>
                    <span class="route-city">Miami</span><span class="route-code">MIA</span>
                  </div>
                </div>
                <div class="deal-footer">
                  <div><span class="deal-price-label">From</span><span class="deal-price">$129</span></div>
                  <span class="btn-book">Book Now</span>
                </div>
              </a>
              <!-- Deal 3 -->
              <a href="flights.php" class="deal-card" data-deal-type="international lastminute">
                <div class="deal-airline">
                  <div class="airline-logo">UA</div>
                  <span class="airline-name">United Airlines</span>
                </div>
                <div class="deal-route">
                  <div class="deal-route-row">
                    <span class="route-dot"></span>
                    <span class="route-city">Chicago</span><span class="route-code">ORD</span>
                  </div>
                  <div class="route-line" style="margin-left:3px;"></div>
                  <div class="deal-route-row">
                    <span class="route-dot" style="background:var(--secondary-color)"></span>
                    <span class="route-city">Dubai</span><span class="route-code">DXB</span>
                  </div>
                </div>
                <div class="deal-footer">
                  <div><span class="deal-price-label">From</span><span class="deal-price">$549</span></div>
                  <span class="btn-book">Book Now</span>
                </div>
              </a>
              <!-- Deal 4 -->
              <a href="flights.php" class="deal-card" data-deal-type="domestic lastminute">
                <div class="deal-airline">
                  <div class="airline-logo">WN</div>
                  <span class="airline-name">Southwest Airlines</span>
                </div>
                <div class="deal-route">
                  <div class="deal-route-row">
                    <span class="route-dot"></span>
                    <span class="route-city">New York</span><span class="route-code">NYC</span>
                  </div>
                  <div class="route-line" style="margin-left:3px;"></div>
                  <div class="deal-route-row">
                    <span class="route-dot" style="background:var(--secondary-color)"></span>
                    <span class="route-city">Orlando</span><span class="route-code">MCO</span>
                  </div>
                </div>
                <div class="deal-footer">
                  <div><span class="deal-price-label">From</span><span class="deal-price">$89</span></div>
                  <span class="btn-book">Book Now</span>
                </div>
              </a>
            </div>
          </div>
        </section>

                <!-- BLOG SECTION -->
        <section class="blogs-section" id="blog">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Travel Insights</span>
              <h2 class="section-title">Latest From Our Travel Blog</h2>
              <p class="section-subtitle">Tips, guides and inspiring stories from around the globe.</p>
            </div>
            <div class="blogs-grid">
              <?php foreach ($blogCardsData as $bKey => $blog): ?>
                <a href="<?php echo route('website.blog-details', ['slug' => $bKey], false); ?>" class="blog-card">
                  <div class="blog-thumb">
                    <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['imageAlt'] ?? $blog['title']); ?>" class="blog-img" loading="lazy">
                    <span class="blog-tag"><?php echo htmlspecialchars($blog['tag']); ?></span>
                  </div>
                  <div class="blog-content">
                    <div class="blog-meta">
                      <span class="blog-meta-item">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                        <?php echo htmlspecialchars($blog['author']); ?>
                      </span>
                      <span class="blog-meta-item">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.89 3 3 3.9 3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                        <?php echo htmlspecialchars($blog['date']); ?>
                      </span>
                    </div>
                    <h3 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h3>
                    <p class="blog-excerpt"><?php echo htmlspecialchars($blog['excerpt']); ?></p>
                    <span class="blog-read-more">Read More <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        
        <!-- TESTIMONIALS SECTION -->
        <section class="testimonials-section" id="testimonials">
          <div class="container">
            <div class="section-header">
              <div class="trustpilot-badge">
                <div class="trustpilot-stars">
                  <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <svg viewBox="0 0 24 24" width="16" height="16"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <span>Excellent</span>
                <span class="tp-text">Trustpilot</span>
              </div>
              <h2 class="section-title">What Our Travelers Say</h2>
              <p class="section-subtitle">Thousands of happy travelers, one mission — best deals, best service.</p>
            </div>
            <div class="testimonials-slider-wrapper">
              <div class="testimonials-slider" id="testimonialsSlider">
                <!-- Review 1 -->
                <div class="testimonial-card">
                  <div class="review-stars">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  </div>
                  <h4 class="review-title">"Best flight deal I could find anywhere!"</h4>
                  <p class="review-body">I needed last-minute flights to London and Fares Junction got me an unbeatable price within hours. Their agent was patient and professional throughout the whole process. Highly recommend!</p>
                  <div class="reviewer-meta">
                    <div class="reviewer-avatar" style="background: linear-gradient(135deg, #ff7b25, #e56513);">MJ</div>
                    <div>
                      <div class="reviewer-name">Michael Johnson</div>
                      <div class="reviewer-date">May 2026</div>
                    </div>
                    <span class="verified-badge">
                      <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                      Verified
                    </span>
                  </div>
                </div>
                <!-- Review 2 -->
                <div class="testimonial-card">
                  <div class="review-stars">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  </div>
                  <h4 class="review-title">"Saved over $400 on our family vacation"</h4>
                  <p class="review-body">Traveling with family of 4 to Paris and the savings were incredible. The booking process was smooth and transparent. Customer service was available anytime we had a question.</p>
                  <div class="reviewer-meta">
                    <div class="reviewer-avatar" style="background: linear-gradient(135deg, #0d6efd, #0f294d);">SR</div>
                    <div>
                      <div class="reviewer-name">Sarah Rodriguez</div>
                      <div class="reviewer-date">April 2026</div>
                    </div>
                    <span class="verified-badge">
                      <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                      Verified
                    </span>
                  </div>
                </div>
                <!-- Review 3 -->
                <div class="testimonial-card">
                  <div class="review-stars">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  </div>
                  <h4 class="review-title">"24/7 support actually works!"</h4>
                  <p class="review-body">My flight got cancelled and the support team at Fares Junction immediately re-booked me on another flight with no extra charge. I couldn't believe how quickly they resolved it.</p>
                  <div class="reviewer-meta">
                    <div class="reviewer-avatar" style="background: linear-gradient(135deg, #10b981, #059669);">DK</div>
                    <div>
                      <div class="reviewer-name">David Kim</div>
                      <div class="reviewer-date">June 2026</div>
                    </div>
                    <span class="verified-badge">
                      <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                      Verified
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- Slider Controls -->
            <div class="slider-controls">
              <button class="slider-btn" id="sliderPrev" aria-label="Previous testimonial">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
              </button>
              <div class="slider-dots" id="sliderDots">
                <button class="slider-dot active" aria-label="Slide 1"></button>
                <button class="slider-dot" aria-label="Slide 2"></button>
                <button class="slider-dot" aria-label="Slide 3"></button>
              </div>
              <button class="slider-btn" id="sliderNext" aria-label="Next testimonial">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
              </button>
            </div>
          </div>
        </section>



<?php
$extraJS = ['js/search.js', 'js/slider.js', 'js/blogs.js', 'js/main.js'];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.guest', compact(
    'slot',
    'pageTitle',
    'pageDescription',
    'extraCSS',
    'extraJS',
))->render();
?>
