<?php
$pageTitle = "Cheap Car Rentals & Rental Car Deals | Fares Junction";
$pageDescription = "Find cheap car rentals and special deals on rental cars with Fares Junction. Compare rates and save on your vehicle booking.";
$extraCSS = ['css/flights.css', 'css/cars.css'];
ob_start();
?>

        <!-- Cars Hero Section -->
        <section class="cars-hero">
          <div class="container">
            
            <div class="banner-title-text">
              <h1>Car Rentals For Any Kind of Trip</h1>
            </div>

            <!-- Inquiry Form Widget -->
            <div class="inquiry-banner-card" id="carSearchWidget">
              <div class="inquiry-banner-header">
                <h2>Car Rental Enquiry</h2>
              </div>
              <div class="inquiry-banner-body">
                <form id="carsInquiryForm" class="cars-form">
                  
                  <!-- Row 1 Inputs: Location, Check-In, Check-Out -->
                  <div class="form-grid-row car-row1-grid">
                    <!-- Pickup Location -->
                    <div class="input-field-wrapper">
                      <input type="text" id="car-location" placeholder="Pick-up Location (Airport / City)" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>

                    <!-- Pick-up Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="car-pickup-date" placeholder="Pick-up Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Drop-off Date -->
                    <div class="input-field-wrapper">
                      <input type="text" id="car-dropoff-date" placeholder="Drop-off Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <!-- Car Type -->
                    <div class="input-field-wrapper">
                      <select id="car-type">
                        <option value="economy" selected>Economy / Compact</option>
                        <option value="sedan">Standard Sedan</option>
                        <option value="suv">SUV / Crossover</option>
                        <option value="luxury">Luxury / Convertible</option>
                        <option value="van">Minivan / Van</option>
                      </select>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-1.1 0-2 .9-2 2v6c0 .6.4 1 1 1h2m3 0c0-1.7 1.3-3 3-3s3 1.3 3 3m-9 0c0-1.7 1.3-3 3-3s3 1.3 3 3"/></svg>
                    </div>
                  </div>

                  <!-- Row 2 Inputs: Lead Info -->
                  <div class="form-grid-row car-row2-grid">
                    <!-- User Name -->
                    <div class="input-field-wrapper">
                      <input type="text" id="car-name" placeholder="Full Name" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>

                    <!-- Phone Number -->
                    <div class="input-field-wrapper">
                      <input type="tel" id="car-phone" placeholder="Phone Number" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>

                    <!-- Email -->
                    <div class="input-field-wrapper">
                      <input type="email" id="car-email" placeholder="Email ID" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>

                    <!-- Submit Button -->
                    <div>
                      <button type="submit" class="banner-submit-btn">Search Cars</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <!-- Success State Widget -->
            <div class="banner-success-card" id="carSuccessWidget" style="display: none;">
              <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">Car Inquiry Submitted!</h2>
              <p style="color: var(--gray-600); line-height: 1.6; font-size: 1.05rem;">Thank you. Our car rental desk is searching the best rental rates in <span id="success-car-loc" style="color: var(--secondary-color); font-weight: 700;">your location</span>. We will call you shortly with options.</p>
            </div>

          </div>
        </section>

        <!-- Car Deals Section -->
        <section class="car-deals-section">
          <div class="container">
            <div class="section-header text-center">
              <span class="section-eyebrow">Affordable Wheels</span>
              <h2 class="section-title">Car Rental Deals Found on <strong>Fares Junction</strong></h2>
              <p class="section-subtitle">Rent a top-tier vehicle at premium rates in major U.S. travel destinations.</p>
            </div>

            <div class="car-deals-grid">
              
              <!-- Deal 1: NYC -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop" alt="Car rentals in New York City" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">New York City</span>
                  <h3 class="car-card-title">Car Rentals in New York City</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>21</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

              <!-- Deal 2: Chicago -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500&auto=format&fit=crop" alt="Car rentals in Chicago" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">Chicago</span>
                  <h3 class="car-card-title">Car Rentals in Chicago</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>22</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

              <!-- Deal 3: San Francisco -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop" alt="Car rentals in San Francisco" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">San Francisco</span>
                  <h3 class="car-card-title">Car Rentals in San Francisco</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>23</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

              <!-- Deal 4: Denver -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=500&auto=format&fit=crop" alt="Car rentals in Denver" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">Denver</span>
                  <h3 class="car-card-title">Car Rentals in Denver</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>21</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

              <!-- Deal 5: Los Angeles -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=500&auto=format&fit=crop" alt="Car rentals in Los Angeles" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">Los Angeles</span>
                  <h3 class="car-card-title">Car Rentals in Los Angeles</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>23</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

              <!-- Deal 6: Las Vegas -->
              <a href="tel:+13238006001" class="car-deal-card">
                <div class="car-img-container">
                  <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=500&auto=format&fit=crop" alt="Car rentals in Las Vegas" loading="lazy">
                </div>
                <div class="car-card-body">
                  <span class="car-location-tag">Las Vegas</span>
                  <h3 class="car-card-title">Car Rentals in Las Vegas</h3>
                  <div class="car-price-row">
                    <span class="price-val">From $<strong>25</strong>/day</span>
                    <span class="btn-car-book">Book Now</span>
                  </div>
                </div>
              </a>

            </div>
          </div>
        </section>

        <!-- Booking Process Section -->
        <section class="car-process-section">
          <div class="container">
            <h2 class="section-title text-center">Quick and Easy Car Rental Bookings For USA</h2>
            <div class="car-process-grid">
              
              <div class="process-card">
                <div class="process-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <h3><strong>01.</strong> Search</h3>
                <p>Choose your pickup location, dates and check rates instantly.</p>
              </div>

              <div class="process-card">
                <div class="process-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </div>
                <h3><strong>02.</strong> Select</h3>
                <p>Compare vehicles and select the package that fits your itinerary.</p>
              </div>

              <div class="process-card">
                <div class="process-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h3><strong>03.</strong> Book</h3>
                <p>Reserve your car rental through our booking specialist over phone.</p>
              </div>

            </div>
          </div>
        </section>

<?php
$extraJS = ['js/cars.js'];
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
