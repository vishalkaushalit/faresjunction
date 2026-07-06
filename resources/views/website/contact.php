<?php
$pageTitle = "Contact Our Customer Service Team Available 24/7 | Fond Travels";
$pageDescription = "Contact our customer service team. Our representatives are available 24/7 365 days to assist you with flight changes and cancellations.";
$extraCSS = ['css/flights.css', 'css/contact.css'];
ob_start();
?>

        <!-- Contact Hero Section -->
        <section class="contact-hero">
          <div class="container">
            <div class="contact-hero-content">
              <h1>Contact Us</h1>
              <p class="contact-hero-subtitle">Need a hand with your travel plans? Contact our travel experts today!</p>
            </div>
          </div>
        </section>

        <!-- Contact Content Section -->
        <section class="contact-content-section">
          <div class="container">
            <div class="contact-grid">
              
              <!-- Left Column: Inquiry Form -->
              <div class="contact-form-wrapper" id="contactFormContainer">
                <h2 class="contact-section-title">Submit an Inquiry</h2>
                <p class="contact-section-desc">*You will be contacted within 2 business days</p>
                
                <form id="contactInquiryForm" class="contact-form" method="POST" action="<?php echo route('contact.create'); ?>">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="contact_subject" value="Website Contact Inquiry">
                  <!-- Name Input -->
                  <div class="input-field-wrapper">
                    <input type="text" id="contact-name" name="contact_name" placeholder="Your Name*" required>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                  </div>

                  <!-- Email Input -->
                  <div class="input-field-wrapper">
                    <input type="email" id="contact-email" name="contact_email" placeholder="Email ID*" required>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                  </div>

                  <!-- Phone Input -->
                  <div class="input-field-wrapper">
                    <input type="tel" id="contact-phone" name="contact_phone" placeholder="Phone Number*" required>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                  </div>

                  <!-- Message Area -->
                  <div class="input-field-wrapper text-area-wrapper">
                    <textarea id="contact-message" name="contact_message" placeholder="Message*" rows="5" required></textarea>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="contact-submit-btn">Send Message</button>
                </form>
              </div>

              <!-- Success Message Card -->
              <div class="banner-success-card contact-success-card" id="contactSuccessWidget" style="display: none;">
                <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                  <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h2>Inquiry Submitted!</h2>
                <p>Thank you for contacting us, <span id="success-contact-name" style="color: var(--secondary-color); font-weight: 700;">traveler</span>. Our reservation desk has received your details and will reach out to you within 2 business days.</p>
              </div>

              <!-- Right Column: Support Details -->
              <div class="contact-info-wrapper">
                <h2 class="contact-section-title">Support Channels</h2>
                <p class="contact-section-desc">Our representatives are available 24/7 365 days to assist you.</p>

                <div class="contact-channels-list">
                  
                  <!-- Phone Card -->
                  <div class="channel-card">
                    <div class="channel-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="channel-details">
                      <h3>Phone Booking & Support</h3>
                      <a href="tel:+13238006001">+1 (323) 800-6001</a>
                      <p>Toll-Free expert travel desk available 24/7.</p>
                    </div>
                  </div>

                  <!-- Email Card -->
                  <div class="channel-card">
                    <div class="channel-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="channel-details">
                      <h3>Email Support</h3>
                      <a href="mailto:support@fondtravels.com">support@fondtravels.com</a>
                      <p>Response within 2-4 business hours.</p>
                    </div>
                  </div>

                  <!-- Address Card -->
                  <div class="channel-card">
                    <div class="channel-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="channel-details">
                      <h3>Corporate Office</h3>
                      <p class="address-text">
                        2700 Neabsco Common Pl Suite #101,<br>
                        Woodbridge, VA 22191, USA
                      </p>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </section>

<?php
$extraJS = ['js/contact.js'];
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
