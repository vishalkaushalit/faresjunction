<?php
require_once resource_path('views/layouts/includes/packages-data.php');

$pageTitle = "Book Hotels & Accommodations Worldwide | Fond Travels";
$pageDescription = "Compare hotel prices and find cheap room stays at popular global tourist destinations with Fond Travels.";
$extraCSS = ['css/vacations.css', 'css/flights.css', 'css/hotels.css'];
ob_start();
?>

        <!-- Hotels Hero Section -->
        <section class="hotels-hero">
          <div class="container">
            
            <div class="banner-title-text">
              <h1>Find Your Perfect Hotel at Cheap Price</h1>
            </div>

            <!-- Inquiry Form Widget -->
            <div class="inquiry-banner-card" id="hotelSearchWidget">
              <div class="inquiry-banner-header">
                <h2>Hotels Search & Enquiry</h2>
              </div>
              <div class="inquiry-banner-body">
                <form id="hotelsInquiryForm" class="hotels-form">
                  
                  <!-- Row 1 Inputs: Destination, Check-In, Check-Out, Rooms/Guests -->
                  <div class="form-grid-row hotel-row1-grid">
                    <!-- Destination -->
                    <div class="input-field-wrapper">
                      <input type="text" id="hotel-destination" placeholder="Where to? (Destination/Hotel Name)" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>

                    <!-- Check-In Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="hotel-checkin" placeholder="Check-In Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Check-Out Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="hotel-checkout" placeholder="Check-Out Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Rooms & Guests -->
                    <div class="input-field-wrapper">
                      <select id="hotel-rooms-guests">
                        <option value="1-1" selected>1 Room, 1 Guest</option>
                        <option value="1-2">1 Room, 2 Guests</option>
                        <option value="2-4">2 Rooms, 4 Guests</option>
                        <option value="3-6">3 Rooms, 6 Guests</option>
                      </select>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                  </div>

                  <!-- Row 2 Inputs: Lead Info -->
                  <div class="form-grid-row hotel-row2-grid">
                    <!-- User Name -->
                    <div class="input-field-wrapper">
                      <input type="text" id="hotel-name" placeholder="Full Name" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>

                    <!-- Phone Number -->
                    <div class="input-field-wrapper">
                      <input type="tel" id="hotel-phone" placeholder="Phone Number" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>

                    <!-- Email -->
                    <div class="input-field-wrapper">
                      <input type="email" id="hotel-email" placeholder="Email ID" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>

                    <!-- Submit Button -->
                    <div>
                      <button type="submit" class="banner-submit-btn">Search Hotels</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <!-- Success State Widget -->
            <div class="banner-success-card" id="hotelSuccessWidget" style="display: none;">
              <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">Hotel Inquiry Submitted!</h2>
              <p style="color: var(--gray-600); line-height: 1.6; font-size: 1.05rem;">Thank you. Our hotel reservation desk is searching the best room rates for <span id="success-hotel-dest" style="color: var(--secondary-color); font-weight: 700;">your destination</span>. We will call you shortly to finalize your stay booking.</p>
            </div>

          </div>
        </section>

        <!-- USP Sections: Why Choose Fond Travels -->
        <section class="hotel-usp-section">
          <div class="container">
            <h2 class="section-title text-center">Why Choose Fond Travels for <strong>Best Hotel Deals</strong></h2>
            <div class="hotel-usp-grid">
              
              <div class="hotel-usp-item">
                <div class="hotel-usp-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <h4>Best Rates Guaranteed</h4>
              </div>

              <div class="hotel-usp-item">
                <div class="hotel-usp-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <h4>Wide Hotel Selection</h4>
              </div>

              <div class="hotel-usp-item">
                <div class="hotel-usp-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h4>Easy Cancellations</h4>
              </div>

              <div class="hotel-usp-item">
                <div class="hotel-usp-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h4>Travel Expert Guidance</h4>
              </div>

            </div>
          </div>
        </section>

        <!-- Trending Destinations Section -->
        <section class="hotel-trending-section">
          <div class="container">
            <h2 class="section-title text-center" style="margin-bottom: 2.5rem;">Trending <strong>Destinations</strong></h2>
            
            <div class="trending-destinations-grid">
              
              <!-- Card 1: United States -->
              <div class="trending-dest-card card-large">
                <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=800&auto=format&fit=crop" alt="United States Hotels" class="dest-bg-img" loading="lazy">
                <div class="dest-card-overlay"></div>
                <div class="dest-card-content">
                  <h3 class="dest-card-title">United States</h3>
                  <div class="dest-city-thumbnails">
                    <a href="tel:+13238006001" class="city-thumb" title="Los Angeles Hotels"><span>LA</span><span class="city-name">Los Angeles</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="New York Hotels"><span>NY</span><span class="city-name">New York</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Las Vegas Hotels"><span>LV</span><span class="city-name">Las Vegas</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Orlando Hotels"><span>OR</span><span class="city-name">Orlando</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Miami Hotels"><span>MI</span><span class="city-name">Miami</span></a>
                  </div>
                </div>
              </div>

              <!-- Card 2: Canada -->
              <div class="trending-dest-card card-medium">
                <img src="https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?w=800&auto=format&fit=crop" alt="Canada Hotels" class="dest-bg-img" loading="lazy">
                <div class="dest-card-overlay"></div>
                <div class="dest-card-content">
                  <h3 class="dest-card-title">Canada</h3>
                  <div class="dest-city-thumbnails">
                    <a href="tel:+13238006001" class="city-thumb" title="Toronto Hotels"><span>TO</span><span class="city-name">Toronto</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Vancouver Hotels"><span>VA</span><span class="city-name">Vancouver</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Montreal Hotels"><span>MO</span><span class="city-name">Montreal</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Ottawa Hotels"><span>OT</span><span class="city-name">Ottawa</span></a>
                  </div>
                </div>
              </div>

              <!-- Card 3: United Kingdom -->
              <div class="trending-dest-card">
                <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=600&auto=format&fit=crop" alt="United Kingdom Hotels" class="dest-bg-img" loading="lazy">
                <div class="dest-card-overlay"></div>
                <div class="dest-card-content">
                  <h3 class="dest-card-title">United Kingdom</h3>
                  <div class="dest-city-thumbnails">
                    <a href="tel:+13238006001" class="city-thumb" title="London Hotels"><span>LD</span><span class="city-name">London</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Birmingham Hotels"><span>BI</span><span class="city-name">Birmingham</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Manchester Hotels"><span>MA</span><span class="city-name">Manchester</span></a>
                  </div>
                </div>
              </div>

              <!-- Card 4: UAE -->
              <div class="trending-dest-card">
                <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&auto=format&fit=crop" alt="United Arab Emirates Hotels" class="dest-bg-img" loading="lazy">
                <div class="dest-card-overlay"></div>
                <div class="dest-card-content">
                  <h3 class="dest-card-title">United Arab Emirates</h3>
                  <div class="dest-city-thumbnails">
                    <a href="tel:+13238006001" class="city-thumb" title="Dubai Hotels"><span>DX</span><span class="city-name">Dubai</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Abu Dhabi Hotels"><span>AB</span><span class="city-name">Abu Dhabi</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Sharjah Hotels"><span>SH</span><span class="city-name">Sharjah</span></a>
                  </div>
                </div>
              </div>

              <!-- Card 5: Indonesia -->
              <div class="trending-dest-card">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&auto=format&fit=crop" alt="Indonesia Hotels" class="dest-bg-img" loading="lazy">
                <div class="dest-card-overlay"></div>
                <div class="dest-card-content">
                  <h3 class="dest-card-title">Indonesia</h3>
                  <div class="dest-city-thumbnails">
                    <a href="tel:+13238006001" class="city-thumb" title="Bali Hotels"><span>BA</span><span class="city-name">Bali</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Jakarta Hotels"><span>JA</span><span class="city-name">Jakarta</span></a>
                    <a href="tel:+13238006001" class="city-thumb" title="Surabaya Hotels"><span>SU</span><span class="city-name">Surabaya</span></a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>

        <!-- Call Banner Section -->
        <section class="hotel-call-banner">
          <div class="container">
            <div class="hotel-call-content">
              <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="m19.23 15.26-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98"/></svg>
              <p>Call us at our 24/7 Number <a href="tel:+13238006001">+1 (323) 800-6001</a> to get great hotel deals!</p>
            </div>
          </div>
        </section>

        <!-- Popular Hotels Section -->
        <section class="popular-hotels-section">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Top Accommodations</span>
              <h2 class="section-title">Popular <strong>Hotels</strong></h2>
              <p class="section-subtitle">Browse trending hotel stays with reviews and exceptional rates.</p>
            </div>
            
            <div class="popular-hotels-grid">
              
              <!-- Hotel 1 -->
              <a href="tel:+13238006001" class="popular-hotel-card">
                <div class="hotel-img-container">
                  <img src="https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=500&auto=format&fit=crop" alt="Metro Palace Mumbai" loading="lazy">
                </div>
                <div class="hotel-details-body">
                  <h4 class="hotel-name">Metro Palace</h4>
                  <p class="hotel-city">Mumbai (MUMBAI)</p>
                  <div class="hotel-stars">
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                  </div>
                  <div class="hotel-price-row">
                    <span class="price-val">$<strong>66</strong><sup>.47</sup></span>
                    <span class="price-type">per night</span>
                  </div>
                  <span class="btn-hotel-book">Book Stay</span>
                </div>
              </a>

              <!-- Hotel 2 -->
              <a href="tel:+13238006001" class="popular-hotel-card">
                <div class="hotel-img-container">
                  <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&auto=format&fit=crop" alt="Sydney Harbour YHA" loading="lazy">
                </div>
                <div class="hotel-details-body">
                  <h4 class="hotel-name">Sydney Harbour YHA</h4>
                  <p class="hotel-city">Sydney (The Rocks)</p>
                  <div class="hotel-stars">
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                  </div>
                  <div class="hotel-price-row">
                    <span class="price-val">$<strong>84</strong><sup>.00</sup></span>
                    <span class="price-type">per night</span>
                  </div>
                  <span class="btn-hotel-book">Book Stay</span>
                </div>
              </a>

              <!-- Hotel 3 -->
              <a href="tel:+13238006001" class="popular-hotel-card">
                <div class="hotel-img-container">
                  <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=500&auto=format&fit=crop" alt="Sleepwell Motel Albany" loading="lazy">
                </div>
                <div class="hotel-details-body">
                  <h4 class="hotel-name">Sleepwell Motel Albany</h4>
                  <p class="hotel-city">Albany (ALBANY, WA)</p>
                  <div class="hotel-stars">
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                  </div>
                  <div class="hotel-price-row">
                    <span class="price-val">$<strong>72</strong><sup>.47</sup></span>
                    <span class="price-type">per night</span>
                  </div>
                  <span class="btn-hotel-book">Book Stay</span>
                </div>
              </a>

              <!-- Hotel 4 -->
              <a href="tel:+13238006001" class="popular-hotel-card">
                <div class="hotel-img-container">
                  <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=500&auto=format&fit=crop" alt="Excalibur Hotel" loading="lazy">
                </div>
                <div class="hotel-details-body">
                  <h4 class="hotel-name">Excalibur Hotel</h4>
                  <p class="hotel-city">Las Vegas (LAS VEGAS)</p>
                  <div class="hotel-stars">
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                  </div>
                  <div class="hotel-price-row">
                    <span class="price-val">$<strong>49</strong><sup>.00</sup></span>
                    <span class="price-type">per night</span>
                  </div>
                  <span class="btn-hotel-book">Book Stay</span>
                </div>
              </a>

            </div>
          </div>
        </section>

        <!-- Hotels FAQ Section -->
        <section class="hotels-faq-section">
          <div class="container">
            <div class="section-header">
              <span class="section-eyebrow">Hotel Bookings FAQs</span>
              <h2 class="section-title">Common Hotel Booking Questions</h2>
              <p class="section-subtitle">Find immediate answers to questions about booking, policies, check-in, and cancellations.</p>
            </div>
            
            <div class="faq-main-container">
              <div class="faq-timeline" id="hotelFaqAccordion">
                
                <!-- Q1 -->
                <div class="faq-item active">
                  <div class="faq-header active">
                    <span class="faq-title-text">How do I get the lowest hotel rates with Fond Travels?</span>
                    <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                  </div>
                  <div class="faq-body" style="display: block;">
                    <p>To lock in the lowest rates, we recommend booking several weeks in advance or booking off-peak travel seasons. In addition, you can call our booking desk directly for special corporate rates, group discounts, or package bundles combining flight + hotel.</p>
                  </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                  <div class="faq-header">
                    <span class="faq-title-text">Can I cancel or modify my hotel reservation?</span>
                    <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                  </div>
                  <div class="faq-body" style="display: none;">
                    <p>Yes. Room cancellation and modification policies depend entirely on the selected rate class. Some budget reservations are strictly non-refundable, while standard flexible bookings allow free cancellation up to 24-48 hours prior to arrival. Call +1 (323) 800-6001 for help with any booking change.</p>
                  </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                  <div class="faq-header">
                    <span class="faq-title-text">Are local taxes and resort fees included in the price?</span>
                    <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                  </div>
                  <div class="faq-body" style="display: none;">
                    <p>Our quotes display room prices, hotel taxes, and booking fees. However, some hotels or resorts charge local city tourism taxes or daily resort fees directly at check-out. Any such mandatory local fees will be specified in your detailed reservation voucher email.</p>
                  </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                  <div class="faq-header">
                    <span class="faq-title-text">What do I need to present during check-in at the hotel?</span>
                    <svg class="faq-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                  </div>
                  <div class="faq-body" style="display: none;">
                    <p>You must present a government-issued photo ID (passport or driver's license) and the booking confirmation voucher (digital or print). Additionally, most hotels require a valid credit card or security cash deposit at check-in to cover incidental charges.</p>
                  </div>
                </div>

              </div>
              <div class="faq-img">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&auto=format&fit=crop" alt="FAQ Stays">
              </div>
            </div>
          </div>
        </section>

<?php
$extraJS = ['js/hotels.js'];
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
