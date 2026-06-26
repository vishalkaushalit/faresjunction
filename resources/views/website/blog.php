<?php
require_once resource_path('views/layouts/includes/blogs-data.php');
require_once resource_path('views/layouts/includes/packages-data.php');

$pageTitle = "Travel Blog, Guides & Flight Hacks | Fond Travels";
$pageDescription = "Unlock travel hacks, airline policies, baggage fees, and insider destination guides with our comprehensive travel blog.";
$extraCSS = ['css/vacations.css', 'css/flights.css', 'css/blogs.css', 'css/blogs-page.css', 'css/testimonials.css'];
ob_start();
?>

        <!-- Blog Hero Section with Flight Search Form -->
        <section class="blog-hero">
          <div class="blog-hero-content">
            <h1 class="blog-hero-title">Unlocking Travel Hacks for an Unforgettable Journey</h1>
            
            <!-- Reused Flight Search Form Container -->
            <div class="inquiry-banner-card" id="flightSearchWidget" style="max-width: 1000px; text-align: left;">
              <div class="inquiry-banner-header">
                <h2>Vacations Enquiry</h2>
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

                  <!-- Row 1 Inputs -->
                  <div class="form-grid-row row1-grid">
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-origin" placeholder="Flying From - City" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                    </div>

                    <button type="button" class="dest-swap-btn" id="btn-swap-dest" aria-label="Swap Locations">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 11 21 7 17 3"/><line x1="21" y1="7" x2="9" y2="7"/><polyline points="7 13 3 17 7 21"/><line x1="3" y1="17" x2="15" y2="17"/></svg>
                    </button>

                    <div class="input-field-wrapper">
                      <input type="text" id="flight-destination" placeholder="Flying To - City" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="transform: rotate(90deg);"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z"/></svg>
                    </div>

                    <div class="input-field-wrapper">
                      <input type="text" id="flight-departure" placeholder="Journey Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

                    <div class="input-field-wrapper">
                      <input type="text" id="flight-return" placeholder="Return Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>

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

                  <!-- Row 2 Inputs -->
                  <div class="form-grid-row row2-grid">
                    <div class="input-field-wrapper">
                      <input type="text" id="flight-name" placeholder="Name" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>

                    <div class="input-field-wrapper">
                      <input type="tel" id="flight-phone" placeholder="Phone Number" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>

                    <div class="input-field-wrapper">
                      <input type="email" id="flight-email" placeholder="Email ID" required>
                      <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>

                    <div>
                      <button type="submit" class="banner-submit-btn">Search Flights</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <!-- Success State Widget -->
            <div class="banner-success-card" id="flightSuccessWidget" style="display: none; max-width: 600px; text-align: center; margin: 0 auto;">
              <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">Flight Search Inquiry Submitted!</h2>
              <p style="color: var(--gray-600); line-height: 1.6;">Thank you. Our flight desk is parsing fares for <strong id="success-flight-route">your trip</strong>. We will call you shortly with the best available quote.</p>
            </div>

          </div>
        </section>

        <!-- Category Navigation Sticky Bar -->
        <nav class="category-filter-bar">
          <div class="container filter-bar-container">
            
            <!-- Category Tabs Left -->
            <div class="filter-tabs" id="blogFilterTabs">
              <button class="filter-tab-btn active" data-category="all">All Blogs</button>
              <button class="filter-tab-btn" data-category="Travel Tips">Travel Tips</button>
              <button class="filter-tab-btn" data-category="Flight Hacks">Flight Hacks</button>
              <button class="filter-tab-btn" data-category="Destination Guide">Destination Guides</button>
            </div>

            <!-- Search Input Right -->
            <div class="blog-search-box">
              <input type="text" id="blogSearchInput" class="blog-search-input" placeholder="Search articles...">
              <svg class="blog-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

          </div>
        </nav>

        <!-- Dynamic Blog Listing Section -->
        <section style="padding: 4rem 0; background-color: var(--gray-100); min-height: 60vh;">
          <div class="container">
            
            <div class="blogs-grid" id="blogsListingGrid">
              <?php foreach ($blogsData as $bKey => $blog): ?>
                
                <div class="blog-card" data-category="<?php echo htmlspecialchars($blog['tag']); ?>" data-title="<?php echo htmlspecialchars(strtolower($blog['title'])); ?>">
                  <!-- Card cover link for full card click -->
                  <a href="<?php echo route('website.blog-details', ['slug' => $bKey], false); ?>" class="blog-card-cover-link" aria-label="Read <?php echo htmlspecialchars($blog['title']); ?>"></a>
                  <!-- Thumbnail & Social Share Overlays -->
                  <div class="blog-thumb-wrapper">
                    <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="blog-img" loading="lazy">
                    <span class="blog-tag"><?php echo htmlspecialchars($blog['tag']); ?></span>
                    
                    <!-- Social Share Overlay -->
                    <div class="blog-share-overlay" onclick="event.preventDefault();">
                      <a href="https://twitter.com/share?url=<?php echo urlencode(route('website.blog-details', ['slug' => $bKey])); ?>" target="_blank" class="share-icon-btn" aria-label="Share on Twitter">
                        <svg viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                      </a>
                      <a href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode(route('website.blog-details', ['slug' => $bKey])); ?>" target="_blank" class="share-icon-btn" aria-label="Share on Facebook">
                        <svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>
                      </a>
                      <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(route('website.blog-details', ['slug' => $bKey])); ?>" target="_blank" class="share-icon-btn" aria-label="Share on Pinterest">
                        <svg viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.08 3.16 9.4 7.63 11.12-.04-.95-.08-2.4.02-3.43.09-.94.58-3.97.58-3.97s-.15-.3-.15-.73c0-.68.4-1.2 1-1.2.47 0 .7.35.7.77 0 .47-.3 1.18-.46 1.84-.13.55.28 1 .82 1 1 0 1.75-1.05 1.75-2.57 0-1.34-.97-2.28-2.35-2.28-1.6 0-2.54 1.2-2.54 2.45 0 .48.19.9.42 1.18.05.05.05.1.03.16-.04.18-.14.58-.16.66-.03.1-.1.14-.2.09-1.2-.55-1.95-2.3-1.95-3.7 0-3.02 2.2-5.78 6.32-5.78 3.32 0 5.9 2.37 5.9 5.53 0 3.3-2.08 5.96-4.97 5.96-.97 0-1.88-.5-2.2-.5 0 0-.48 1.83-.6 2.27-.22.84-.8 1.9-1.2 2.55C10.74 23.75 11.37 24 12 24c6.63 0 12-5.37 12-12S18.63 0 12 0z"/></svg>
                      </a>
                      <a href="https://linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(route('website.blog-details', ['slug' => $bKey])); ?>" target="_blank" class="share-icon-btn" aria-label="Share on LinkedIn">
                        <svg viewBox="0 0 24 24"><path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.27c-.97 0-1.75-.79-1.75-1.76 0-.97.78-1.75 1.75-1.75s1.75.78 1.75 1.75c0 .97-.78 1.76-1.75 1.76zm13.5 12.27h-3v-5.6c0-3.37-4-3.12-4 0v5.6h-3v-11h3v1.76c1.4-2.58 7-2.78 7 2.47v6.77z"/></svg>
                      </a>
                    </div>
                  </div>

                  <!-- Blog Card Text Details -->
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
                    
                    <h3 class="blog-title"><a href="<?php echo route('website.blog-details', ['slug' => $bKey], false); ?>"><?php echo htmlspecialchars($blog['title']); ?></a></h3>
                    <p class="blog-excerpt"><?php echo htmlspecialchars($blog['excerpt']); ?></p>
                    
                    <a href="<?php echo route('website.blog-details', ['slug' => $bKey], false); ?>" class="blog-read-more">
                      Read More <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                  </div>
                </div>

              <?php endforeach; ?>

              <!-- No Blogs Found Callback -->
              <div class="no-blogs-found" id="noBlogsFoundMessage" style="display: none;">
                <h3>No articles match your search</h3>
                <p>We couldn't find any travel guides or flight hacks with those keywords. Try adjusting your search query or choosing another category tab.</p>
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
                  <p class="review-body">I needed last-minute flights to London and Fond Travels got me an unbeatable price within hours. Their agent was patient and professional throughout the whole process. Highly recommend!</p>
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
                  <p class="review-body">My flight got cancelled and the support team at Fond Travels immediately re-booked me on another flight with no extra charge. I couldn't believe how quickly they resolved it.</p>
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
$extraJS = ['js/slider.js', 'js/flights.js', 'js/blogs-filter.js'];
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
