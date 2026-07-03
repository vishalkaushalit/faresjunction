<?php
$isInnerPage = true;
include 'includes/header.php';
?>

<!-- Airline Header Banner -->
<section class="airline-banner" style="background-image: url('img/airline_hero.jpg'); background-color: #0f294d;">
  <div class="container text-center text-white" style="padding: 60px 0;">
    <h1 style="font-size: 2.5rem; font-weight: 700; color: #fff;">American Airlines</h1>
    <p style="font-size: 1.1rem; opacity: 0.9;">Book cheap American Airlines flights and manage your booking.</p>
  </div>
</section>

<!-- Main Airline Content -->
<section class="airline-content-section" style="padding: 50px 0; background-color: #f8f9fa;">
  <div class="container">
    <div class="airline-layout">
      
      <!-- Sidebar Navigation -->
      <aside class="airline-sidebar">
        <ul class="airline-nav-list">
          <li><a href="american-airlines.blade.php" class="airline-nav-item ">Overview</a></li>
          <li><a href="american-airlines-book-manage.blade.php" class="airline-nav-item ">Book & Manage</a></li>
          <li><a href="american-airlines-classes-seat.blade.php" class="airline-nav-item ">Classes & Seat Selection <span class="arrow">▼</span></a></li>
          <li><a href="american-airlines-checkin-onboard.blade.php" class="airline-nav-item ">Check-in & Onboard</a></li>
          <li><a href="american-airlines-baggage.blade.php" class="airline-nav-item ">Baggage</a></li>
          <li><a href="american-airlines-unaccompanied.blade.php" class="airline-nav-item ">Unaccompanied Minor & Infant</a></li>
          <li><a href="american-airlines-cancellation.blade.php" class="airline-nav-item ">Cancellation & Refund</a></li>
          <li><a href="american-airlines-flight-change.blade.php" class="airline-nav-item ">Flight Name & Date Change</a></li>
          <li><a href="american-airlines-pet-travel.blade.php" class="airline-nav-item ">Pet Travel</a></li>
          <li><a href="american-airlines-loyalty.blade.php" class="airline-nav-item ">Loyalty Programs</a></li>
          <li><a href="american-airlines-insurance.blade.php" class="airline-nav-item ">Travel Insurance</a></li>
          <li><a href="american-airlines-deals.blade.php" class="airline-nav-item ">Flight Deals</a></li>
          <li><a href="american-airlines-destinations.blade.php" class="airline-nav-item ">Destinations</a></li>
          <li><a href="american-airlines-cruises.blade.php" class="airline-nav-item ">Cruises</a></li>
          <li><a href="american-airlines-vacations.blade.php" class="airline-nav-item active">Vacations</a></li>
        </ul>
      </aside>

      <!-- Content Area (Main + Extra Sections) -->
      <main class="airline-main-content">
        
        <!-- Standard Content Block -->
        <div class="airline-tab-content active">
          <h2>Vacations</h2>
          <p>All-inclusive packages, hotel bundles, and guided tours powered by our vacations team. with American Airlines.</p>
        </div>

        <hr style="margin: 40px 0; border-top: 1px solid #ddd;">

        <!-- Popular Flights Section -->
        <section class="airline-popular-flights">
          <h3 class="airline-section-title"><span class="highlight-text">Popular Flights from</span> American Airlines</h3>
          <div class="popular-flights-box">
            <ul class="popular-flights-list">
              <li>Detroit (DTW) to Orlando (MCO)</li>
              <li>Chicago (ORD) to Fort Lauderdale (FLL)</li>
              <li>Houston (IAH) to Las Vegas (LAS)</li>
              <li>Newark (EWR) to Fort Lauderdale (FLL)</li>
              <li>Dallas (DFW) to Las Vegas (LAS)</li>
              <li>New York City - Fort Lauderdale</li>
              <li>Detroit (DTW) to Las Vegas (LAS)</li>
              <li>Baltimore/Washington DC to Fort Lauderdale</li>
            </ul>
          </div>
        </section>

        <!-- FAQ Section -->
        <section class="airline-faq-section" style="margin-top: 40px;">
          <h3 class="airline-section-title">Frequently Asked Questions</h3>
          <div class="faq-accordion">
            <details class="faq-item">
              <summary>How can I check-in for my American Airlines flight?</summary>
              <div class="faq-content">
                <p>You can check in online via the American Airlines website, mobile app, or at the airport using self-service kiosks or check-in counters.</p>
              </div>
            </details>
            <details class="faq-item">
              <summary>What is the baggage allowance for American Airlines?</summary>
              <div class="faq-content">
                <p>Baggage allowance varies based on your ticket class and destination. Typically, passengers are allowed one carry-on bag and one personal item. Checked baggage may incur additional fees.</p>
              </div>
            </details>
            <details class="faq-item">
              <summary>Can I cancel or change my American Airlines booking?</summary>
              <div class="faq-content">
                <p>Yes, you can modify or cancel your booking through the Manage Booking section. Fees and policies depend on your fare type and how far in advance you make the change.</p>
              </div>
            </details>
          </div>
        </section>

      </main>

    </div>
  </div>
</section>



<?php include 'includes/footer.php'; ?>


