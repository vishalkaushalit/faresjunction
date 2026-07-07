<?php
require resource_path('views/layouts/includes/packages-data.php');

$pageTitle = "Book Cheap Flight Tickets & Last Minute Travel Deals | Fares Junction";
$pageDescription = "Compare airfares on major airlines. Book cheap flights, round-trip ticket deals, and get up to 40% off by calling our 24/7 travel experts.";
$extraCSS = ['css/vacations.css', 'css/testimonials.css', 'css/flights.css'];
ob_start();
?>

        <!-- Flights Hero Banner -->
        <section class="flights-hero">
          <div class="container">
            
            <!-- Inquiry Form Widget -->
            <div class="inquiry-banner-card" id="flightSearchWidget">
              <div class="inquiry-banner-header">
                <h2>Flights Enquiry</h2>
              </div>
              <div class="inquiry-banner-body">
                <form id="flightsInquiryForm" class="flights-form">
                  
                  <!-- Trip Type Radios -->
                  <div class="trip-type-row">
                    <label class="trip-type-label">
                      <input type="radio" name="tripType" value="roundtrip" checked id="radio-roundtrip">
                      <span>Round Trip</span>
                    </label>
                    <label class="trip-type-label">
                      <input type="radio" name="tripType" value="oneway" id="radio-oneway">
                      <span>One Way</span>
                    </label>
                  </div>

                  <!-- Row 1 Inputs: Flights Specific -->
                  <div class="form-grid-row row1-grid">
                    <!-- Origin -->
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-origin" placeholder="Flying From - City" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                    </div>

                    <!-- Swap Button -->
                    <button type="button" class="dest-swap-btn" id="btn-swap-dest" aria-label="Swap Origin and Destination">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 11 21 7 17 3"/><line x1="21" y1="7" x2="9" y2="7"/><polyline points="7 13 3 17 7 21"/><line x1="3" y1="17" x2="15" y2="17"/></svg>
                    </button>

                    <!-- Destination -->
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-destination" placeholder="Flying To - City" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform: rotate(90deg);"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                    </div>

                    <!-- Departure Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-departure" placeholder="Journey Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Return Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-return" placeholder="Return Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Passengers -->
                    <div class="input-field-wrapper">
                      <select id="flight-passengers">
                        <option value="1" selected>1 Traveler</option>
                        <option value="2">2 Travelers</option>
                        <option value="3">3 Travelers</option>
                        <option value="4">4 Travelers</option>
                        <option value="5">5 Travelers</option>
                        <option value="6">6 Travelers</option>
                        <option value="7">7 Travelers</option>
                        <option value="8">8 Travelers</option>
                        <option value="9">9 Travelers</option>
                      </select>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                  </div>

                  <!-- Row 2 Inputs: Lead Info -->
                  <div class="form-grid-row row2-grid">
                    <!-- User Name -->
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-name" placeholder="Name" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>

                    <!-- Phone Number -->
                    <div class="input-field-wrapper">
                      <input type="tel" id="flight-phone" placeholder="Phone Number" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81 7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>

                    <!-- Email -->
                    <div class="input-field-wrapper">
                      <input type="email" id="flight-email" placeholder="Email ID" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>

                    <!-- Submit Button -->
                    <div>
                      <button type="submit" class="banner-submit-btn">Submit</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <!-- Success State Widget -->
            <div class="banner-success-card" id="flightSuccessWidget" style="display: none;">
              <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">Flight Inquiry Submitted!</h2>
              <p style="color: var(--gray-600); line-height: 1.6; font-size: 1.05rem;">Thank you for choosing <strong>Fares Junction</strong>. Our flight ticketing team is searching the best fares for <span id="success-flight-route" style="color: var(--secondary-color); font-weight: 700;">your trip</span>. We will call you shortly on your phone/email to finalize the quote.</p>
            </div>

          </div>
        </section>

        <!-- Trust Badges Bar Section -->
        <section class="trust-badges-bar">
          <div class="container">
            <div class="trust-badges-grid">
              
              <div class="trust-badge-item">
                <div class="trust-badge-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <div>
                  <h4 class="trust-badge-title">Call Us 24 x 7</h4>
                  <p class="trust-badge-desc">Toll-free booking line & immediate changes.</p>
                </div>
              </div>

              <div class="trust-badge-item">
                <div class="trust-badge-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                </div>
                <div>
                  <h4 class="trust-badge-title">We Know Travel</h4>
                  <p class="trust-badge-desc">Speak directly to our ticket specialists.</p>
                </div>
              </div>

              <div class="trust-badge-item">
                <div class="trust-badge-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                  <h4 class="trust-badge-title">Easy Booking</h4>
                  <p class="trust-badge-desc">Instant e-tickets straight to your email.</p>
                </div>
              </div>

              <div class="trust-badge-item">
                <div class="trust-badge-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div>
                  <h4 class="trust-badge-title">Google Rating 4.8</h4>
                  <p class="trust-badge-desc">Top marks from thousands of customers.</p>
                </div>
              </div>

            </div>
          </div>
        </section>

        <!-- Curated Flight Deals Section -->
        <section class="flight-deals-section">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Affordable Fares</span>
              <h2 class="section-title">Popular Domestic & International Flight Deals</h2>
              <p class="section-subtitle">Grab limited-time flight discounts from top U.S. airports.</p>
            </div>
            
            <div class="flight-deals-grid">
              
              <!-- Deal 1 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to London" loading="lazy">
                  <span class="flight-deal-tag">Europe Promo</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">New York (JFK) to London (LHR)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$428<span>.50 PP</span></span>
                  </div>
                </div>
              </a>

              <!-- Deal 2 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to Tokyo" loading="lazy">
                  <span class="flight-deal-tag">Asia Hot Deal</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">Los Angeles (LAX) to Tokyo (HND)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$650<span>.00 PP</span></span>
                  </div>
                </div>
              </a>

              <!-- Deal 3 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to Paris" loading="lazy">
                  <span class="flight-deal-tag">Europe Deal</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">Chicago (ORD) to Paris (CDG)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$480<span>.00 PP</span></span>
                  </div>
                </div>
              </a>

              <!-- Deal 4 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to Cancun" loading="lazy">
                  <span class="flight-deal-tag">Beach Special</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">Miami (MIA) to Cancun (CUN)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$189<span>.00 PP</span></span>
                  </div>
                </div>
              </a>

              <!-- Deal 5 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to Dubai" loading="lazy">
                  <span class="flight-deal-tag">Middle East Best</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">Washington (IAD) to Dubai (DXB)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$599<span>.00 PP</span></span>
                  </div>
                </div>
              </a>

              <!-- Deal 6 -->
              <a href="tel:+13238006001" class="flight-deal-card">
                <div class="flight-deal-img-wrapper">
                  <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=500&auto=format&fit=crop" class="flight-deal-img" alt="Flights to Rome" loading="lazy">
                  <span class="flight-deal-tag">Europe Sale</span>
                </div>
                <div class="flight-deal-body">
                  <h3 class="flight-deal-route">Boston (BOS) to Rome (FCO)</h3>
                  <div class="flight-deal-meta">
                    <span>Round-Trip</span>
                    <span>•</span>
                    <span>Economy Class</span>
                  </div>
                  <div class="flight-deal-price-box">
                    <span class="flight-deal-price-label">Fares starting from:</span>
                    <span class="flight-deal-price">$510<span>.00 PP</span></span>
                  </div>
                </div>
              </a>

            </div>
          </div>
        </section>

        <!-- REUSED: POPULAR VACATION PACKAGES CAROUSEL SECTION -->
        <section class="vacations-section" id="vacations">
          <div class="container">
            <div class="vacations-header-row">
              <div class="section-header">
                <span class="section-eyebrow">Reused Offers</span>
                <h2 class="section-title">Trending Holiday Tour Packages</h2>
                <p class="section-subtitle">Save big on complete package bookings combining flight + accommodation + sightseeing.</p>
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

        <!-- REUSED: TESTIMONIALS SLIDER SECTION -->
        <section class="testimonials-section" id="testimonials">
          <div class="container">
            <div class="section-header">
              <div class="trustpilot-rating">
                <span>Excellent</span>
                <span class="tp-text">Trustpilot</span>
              </div>
              <h2 class="section-title">What Our Travelers Say</h2>
              <p class="section-subtitle">Read feedback from our flight ticketing customers.</p>
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

        <!-- Flights FAQs Section -->
        <section class="flights-faq-section">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Frequently Asked Questions</span>
              <h2 class="section-title">Common Flight Booking Questions</h2>
              <p class="section-subtitle">Get quick answers to questions about tickets, fares, policies, and support.</p>
            </div>
            <div class="faq-main-container">
            <div class="faq-timeline" id="faqAccordion">
              
              <!-- Q1 -->
              <div class="faq-item active">
                <div class="faq-header active">
                  <span class="faq-title-text">How do I find the cheapest flight tickets on Fares Junction?</span>
                  <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-body" style="display: block;">
                  <p>To secure the lowest fares, we recommend booking 3-4 weeks in advance, remaining flexible with travel dates, and choosing off-peak times (such as mid-week departures). You can also call our 24/7 reservation desk directly for exclusive, phone-only unpublished flight deals.</p>
                </div>
              </div>

              <!-- Q2 -->
              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-title-text">Can I make changes or cancel my flight ticket after booking?</span>
                  <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-body" style="display: none;">
                  <p>Yes, change and cancellation policies depend entirely on the airline fare class. Most standard economy tickets allow changes for a fee, while flexible or business class tickets allow free changes. Call our support team at +1 (323) 800-6001 for immediate assistance with booking modifications.</p>
                </div>
              </div>

              <!-- Q3 -->
              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-title-text">What are unpublished or phone-only flight deals?</span>
                  <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-body" style="display: none;">
                  <p>Airlines often restrict agencies from publishing deep discounts online due to advertising agreements. However, these rates are fully bookable via phone. By calling our travel desk, you can save up to 40% on standard flight pricing.</p>
                </div>
              </div>

              <!-- Q4 -->
              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-title-text">How do I receive my booking confirmation and boarding pass?</span>
                  <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-body" style="display: none;">
                  <p>Once your reservation is confirmed, a detailed e-ticket confirmation email will be sent to you containing your airline booking reference (PNR). You can use this reference to check-in on the airline website 24 hours prior to departure and download your boarding passes.</p>
                </div>
              </div>

            </div>
            <div class="faq-img">
<img src="./assets/images/flights/faq-side-image.avif" alt="FAQ Image">
            </div>
            </div>
          </div>
        </section>

        <!-- Route Links Cloud -->
        <section class="routes-cloud-section">
          <div class="container">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); text-align: center; margin-bottom: 1.5rem;">Popular Airline Routes</h3>
            <div class="routes-cloud-container">
              <a href="tel:+13238006001">New York to London</a> | 
              <a href="tel:+13238006001">Los Angeles to Tokyo</a> | 
              <a href="tel:+13238006001">Chicago to Paris</a> | 
              <a href="tel:+13238006001">Miami to Cancun</a> | 
              <a href="tel:+13238006001">Houston to San Jose</a> | 
              <a href="tel:+13238006001">Washington to Rome</a> | 
              <a href="tel:+13238006001">New York to Rome</a> | 
              <a href="tel:+13238006001">San Francisco to London</a> | 
              <a href="tel:+13238006001">Boston to Paris</a> | 
              <a href="tel:+13238006001">Atlanta to Mexico City</a>
            </div>
          </div>
        </section>

<?php
$extraJS = ['js/slider.js', 'js/flights.js'];
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view("layouts.guest", compact(
    "slot",
    "pageTitle",
    "pageDescription",
    "extraCSS",
    "extraJS",
))->render();
?>
