<?php
require_once resource_path('views/layouts/includes/packages-data.php');

// Resolve package from query parameter, fallback to default
$packageKey = isset($_GET['package']) ? $_GET['package'] : 'all-in-one-thailand';
if (!isset($packagesData[$packageKey])) {
    $packageKey = 'all-in-one-thailand';
}

$pkg = $packagesData[$packageKey];

$pageTitle = $pkg['title'] . " | Fond Travels Packages";
$pageDescription = $pkg['overview'];
$extraCSS = ['css/package-details.css', 'css/vacations.css'];

ob_start();
?>

        <!-- Breadcrumbs -->
        <div class="breadcrumb-container">
          <div class="container">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li><a href="packages.php">Packages</a></li>
              <li id="breadcrumb-active"><?php echo htmlspecialchars($pkg['title']); ?></li>
            </ul>
          </div>
        </div>

        <!-- Package Hero Section -->
        <section class="package-hero">
          <div class="container">
            <div class="package-hero-grid">
              <!-- Left Info -->
              <div class="package-hero-info">
                <span class="package-badge" id="hero-badge"><?php echo htmlspecialchars($pkg['duration']); ?></span>
                <h1 class="package-hero-title" id="hero-title"><?php echo htmlspecialchars($pkg['title']); ?></h1>
                
                <div class="package-hero-meta">
                  <div class="package-duration-tag">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span id="hero-duration"><?php echo htmlspecialchars($pkg['duration']); ?></span>
                  </div>
                  <div class="package-rating-wrapper">
                    <div class="package-rating-stars" id="hero-stars">
                      <?php echo str_repeat('<svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>', $pkg['stars']); ?>
                    </div>
                    <span>(Verified Travelers)</span>
                  </div>
                </div>
                <div class="package-nights-breakdown" id="hero-nights-breakdown">
                  <?php echo preg_replace('/(\d+\s*Nights?)/i', '<span>$1</span>', htmlspecialchars($pkg['nightsDetail'])); ?>
                </div>
                <div class="package-hero-price-box">
                  <span class="package-hero-price-label">Price starts from</span>
                  <span class="package-hero-price-val" id="hero-price"><?php echo htmlspecialchars($pkg['price']); ?> <span>Per Person</span></span>
                </div>
                <a href="tel:+13238006001" class="btn btn-call" aria-label="Call Fond Travels">
                  <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1A11.36 11.36 0 018.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg>
                  <span>Call Now</span>
                </a>
              </div>

              <!-- Right Photo Gallery -->
              <div class="package-gallery">
                <div class="gallery-main">
                  <img id="gallery-main-img" src="<?php echo htmlspecialchars($pkg['gallery'][0]); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>">
                </div>
                <div class="gallery-thumbnails" id="gallery-thumbs">
                  <?php foreach ($pkg['gallery'] as $idx => $imgUrl): ?>
                    <div class="gallery-thumb <?php echo $idx === 0 ? 'active' : ''; ?>" data-img-url="<?php echo htmlspecialchars($imgUrl); ?>">
                      <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?> thumbnail <?php echo $idx + 1; ?>">
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Sticky Quick Navigation Tab Bar -->
        <nav class="package-nav-sticky">
          <div class="container">
            <div class="package-nav-container">
              <ul class="package-nav-list">
                <li><a href="#overview" class="package-nav-link active">Overview</a></li>
                <li><a href="#highlights" class="package-nav-link">Highlights</a></li>
                <li><a href="#itinerary" class="package-nav-link">Itinerary</a></li>
                <li><a href="#inclusions" class="package-nav-link">Inclusions</a></li>
                <li><a href="#hotels" class="package-nav-link">Hotels</a></li>
                <li><a href="#activities" class="package-nav-link">Activities</a></li>
                <li><a href="#pricing" class="package-nav-link">Pricing</a></li>
                <li><a href="#notes" class="package-nav-link">Notes</a></li>
                <li><a href="#reviews" class="package-nav-link">Reviews</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <!-- Main Content Area -->
        <div class="package-content-section">
          <div class="container">
            <div class="package-layout-grid">
              
              <!-- Left Column: Content Cards -->
              <div class="package-left-col">
                
                <!-- Overview Card -->
                <div class="detail-card" id="overview">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Package Overview
                  </h2>
                  <p class="overview-text" id="overview-text"><?php echo htmlspecialchars($pkg['overview']); ?></p>
                  
                  <div class="quick-stats-grid">
                    <div class="stat-item">
                      <span class="stat-label">Duration</span>
                      <span class="stat-val" id="stat-duration"><?php echo htmlspecialchars($pkg['duration']); ?></span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-label">Starts From</span>
                      <span class="stat-val" id="stat-price"><?php echo htmlspecialchars($pkg['price']); ?> PP</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-label">Destinations</span>
                      <span class="stat-val" id="stat-destinations">
                        <?php echo htmlspecialchars(implode(' / ', array_map(function($h) { return $h['city']; }, $pkg['hotels']))); ?>
                      </span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-label">Meals</span>
                      <span class="stat-val" id="stat-meals">
                        <?php echo stripos($pkg['title'], 'mauritius') !== false ? 'Breakfast & Dinner' : 'Breakfast Included'; ?>
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Highlights Card -->
                <div class="detail-card" id="highlights">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Tour Highlights
                  </h2>
                  <div class="highlights-grid" id="highlights-list">
                    <?php foreach ($pkg['highlights'] as $hl): ?>
                      <div class="highlight-item">
                        <div class="highlight-icon">
                          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg>
                        </div>
                        <span><?php echo htmlspecialchars($hl); ?></span>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Itinerary Card -->
                <div class="detail-card" id="itinerary">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Day-By-Day Itinerary
                  </h2>
                  <div class="itinerary-timeline" id="itinerary-timeline">
                    <?php foreach ($pkg['itinerary'] as $idx => $item): ?>
                      <div class="itinerary-day <?php echo $idx === 0 ? 'active' : ''; ?>">
                        <div class="itinerary-day-header <?php echo $idx === 0 ? 'active' : ''; ?>">
                          <div class="itinerary-day-title">
                            <span class="day-badge">Day <?php echo $item['day']; ?></span>
                            <span class="day-title-text"><?php echo htmlspecialchars($item['title']); ?></span>
                          </div>
                          <svg class="itinerary-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9" />
                          </svg>
                        </div>
                        <div class="itinerary-day-body" style="display: <?php echo $idx === 0 ? 'block' : 'none'; ?>;">
                          <p><?php echo htmlspecialchars($item['description']); ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Inclusions & Exclusions Card -->
                <div class="detail-card" id="inclusions">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Inclusions & Exclusions
                  </h2>
                  <div class="inc-exc-grid">
                    <div class="inc-card">
                      <h3 class="inc-title">Inclusions</h3>
                      <ul class="inc-list" id="inclusions-list">
                        <?php foreach ($pkg['inclusions'] as $inc): ?>
                          <li><?php echo htmlspecialchars($inc); ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                    <div class="exc-card">
                      <h3 class="exc-title">Exclusions</h3>
                      <ul class="exc-list" id="exclusions-list">
                        <?php foreach ($pkg['exclusions'] as $exc): ?>
                          <li><?php echo htmlspecialchars($exc); ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- Hotels Card -->
                <div class="detail-card" id="hotels">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Accommodation details
                  </h2>
                  <div class="hotels-grid" id="hotels-grid">
                    <?php foreach ($pkg['hotels'] as $hotel): ?>
                      <div class="hotel-card">
                        <div class="hotel-city-badge"><?php echo htmlspecialchars($hotel['city']); ?></div>
                        <div class="hotel-info">
                          <h4 class="hotel-name"><?php echo htmlspecialchars($hotel['name']); ?></h4>
                          <div class="hotel-rating"><?php echo htmlspecialchars($hotel['rating']); ?></div>
                          <p class="hotel-desc"><?php echo htmlspecialchars($hotel['desc']); ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Activities Card -->
                <div class="detail-card" id="activities">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                    Highlights Tours & Activities
                  </h2>
                  <div class="activities-grid" id="activities-grid">
                    <?php foreach ($pkg['activities'] as $act): ?>
                      <div class="activity-card">
                        <div class="activity-img-wrapper">
                          <img src="<?php echo htmlspecialchars($act['image']); ?>" alt="<?php echo htmlspecialchars($act['name']); ?>" loading="lazy">
                        </div>
                        <div class="activity-info">
                          <h4 class="activity-name"><?php echo htmlspecialchars($act['name']); ?></h4>
                          <p class="activity-desc"><?php echo htmlspecialchars($act['desc']); ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Pricing Card -->
                <div class="detail-card" id="pricing">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    Pricing Options
                  </h2>
                  <div class="price-table-container">
                    <table class="price-table">
                      <thead>
                        <tr>
                          <th>Package Option</th>
                          <th>Hotel Tier</th>
                          <th>Price Starting</th>
                          <th>Package Details</th>
                        </tr>
                      </thead>
                      <tbody id="pricing-tbody">
                        <?php foreach ($pkg['pricing'] as $pr): ?>
                          <tr>
                            <td class="price-tier-name"><?php echo htmlspecialchars($pr['tier']); ?></td>
                            <td class="price-hotel-type"><?php echo htmlspecialchars($pr['hotelType']); ?></td>
                            <td class="price-value-td"><?php echo htmlspecialchars($pr['price']); ?></td>
                            <td class="price-desc-td"><?php echo htmlspecialchars($pr['description']); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Important Notes Card -->
                <div class="detail-card" id="notes">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Important Notes & FAQs
                  </h2>
                  <ul class="notes-list" id="notes-list">
                    <?php foreach ($pkg['notes'] as $note): ?>
                      <li><?php echo htmlspecialchars($note); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>

                <!-- Why Book With Us Section -->
                <div class="detail-card">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Why Book With Us
                  </h2>
                  <div class="why-book-grid">
                    <div class="why-item">
                      <div class="why-item-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                      </div>
                      <h4 class="why-item-title">24/7 Expert Support</h4>
                      <p class="why-item-desc">Speak to our dedicated travel specialists round the clock.</p>
                    </div>
                    <div class="why-item">
                      <div class="why-item-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                      </div>
                      <h4 class="why-item-title">Secure Booking</h4>
                      <p class="why-item-desc">Your payments are fully secure with industry-standard encryption.</p>
                    </div>
                    <div class="why-item">
                      <div class="why-item-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                      </div>
                      <h4 class="why-item-title">Best Price Guarantee</h4>
                      <p class="why-item-desc">Get the lowest flight fares and accommodation rates, guaranteed.</p>
                    </div>
                  </div>
                </div>

                <!-- Reviews Card -->
                <div class="detail-card" id="reviews">
                  <h2 class="detail-card-title">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Traveler Reviews
                  </h2>
                  <div class="reviews-container" id="reviews-list">
                    <?php foreach ($pkg['reviews'] as $rev): ?>
                      <div class="review-card-item">
                        <div class="review-card-header">
                          <span class="review-user-name"><?php echo htmlspecialchars($rev['name']); ?></span>
                          <span class="review-user-date"><?php echo htmlspecialchars($rev['date']); ?></span>
                        </div>
                        <div class="review-user-stars">
                          <?php echo str_repeat('<svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>', $rev['rating']); ?>
                        </div>
                        <p class="review-user-text">"<?php echo htmlspecialchars($rev['text']); ?>"</p>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Related Packages Card -->
                <div class="detail-card" style="border: none; background: transparent; padding: 0; box-shadow: none;">
                  <h2 class="detail-card-title" style="border-bottom: 2px solid var(--gray-200); padding-bottom: 0.85rem;">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 8 8 12 12 16"/><line x1="16" y1="12" x2="8" y2="12"/></svg>
                    Similar Tour Packages
                  </h2>
                  <div class="related-packages-grid" id="related-packages-grid">
                    <?php
                    foreach ($pkg['related'] as $relKey) {
                      $relPkg = isset($packagesData[$relKey]) ? $packagesData[$relKey] : null;
                      if ($relPkg) {
                        ?>
                        <a href="package-details.php?package=<?php echo urlencode($relKey); ?>" class="vacation-card" style="flex: 0 0 100%; max-width: 100%;">
                          <div class="vacation-img-wrapper" style="height: 180px;">
                            <img src="<?php echo htmlspecialchars($relPkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($relPkg['title']); ?>" class="vacation-img" loading="lazy">
                          </div>
                          <div class="vacation-body" style="padding: 1.25rem;">
                            <h3 class="vacation-title" style="font-size: 1.15rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($relPkg['title']); ?></h3>
                            <p class="vacation-nights" style="font-size: 0.88rem; min-height: auto; margin-bottom: 0.75rem; display: block; text-align: center;">
                              <?php echo preg_replace('/(\d+\s*Nights?)/i', '<span class="highlight-nights">$1</span>', htmlspecialchars($relPkg['nightsDetail'])); ?>
                            </p>
                            <div class="vacation-price-box" style="padding-top: 0.75rem; margin-bottom: 0.75rem;">
                              <span class="vacation-price" style="font-size: 1.05rem;">Price starts: <?php echo htmlspecialchars($relPkg['price']); ?> PP</span>
                            </div>
                            <span class="btn-vacation-offer" style="padding: 0.5rem 0; font-size: 0.85rem;">View Details</span>
                          </div>
                        </a>
                        <?php
                      }
                    }
                    ?>
                  </div>
                </div>

              </div>

              <!-- Right Column: Sticky Inquiry Sidebar -->
              <div class="package-right-col">
                <div class="sidebar-sticky-wrapper">
                  <div class="inquiry-card">
                    
                    <!-- Form State -->
                    <form class="inquiry-form-new" id="packageInquiryForm">
                      <div class="input-field-group">
                        <input type="text" id="traveler-name" placeholder="Name*" required>
                      </div>

                      <div class="input-field-group">
                        <input type="email" id="traveler-email" placeholder="Email*" required>
                      </div>

                      <div class="input-field-group">
                        <input type="tel" id="traveler-phone" placeholder="Your Phone*" required>
                      </div>

                      <div class="form-row-side-by-side">
                        <div class="input-field-group date-wrapper">
                          <input type="text" id="travel-date" placeholder="Travel Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                          <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div class="input-field-group count-wrapper">
                          <input type="number" id="traveler-count" min="1" max="99" value="1" required>
                        </div>
                      </div>

                      <div class="input-field-group">
                        <textarea id="traveler-message" placeholder="Message" rows="3"></textarea>
                      </div>

                      <button type="submit" class="inquiry-submit-btn-orange">Send Enquiry</button>
                    </form>

                    <!-- Success State -->
                    <div class="inquiry-success-msg" id="inquirySuccessWidget">
                      <div class="success-check-icon">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                      </div>
                      <h4 class="success-title">Inquiry Submitted!</h4>
                      <p class="success-desc">Thank you for your interest in <strong><span id="success-pkg-name"><?php echo htmlspecialchars($pkg['title']); ?></span></strong>. One of our destination specialists will contact you shortly on your phone/email.</p>
                    </div>

                  </div>

                  <!-- Most Searched Packages Slider Widget -->
                  <div class="most-searched-widget">
                    <h3 class="widget-title-underlined">Most Searched Packages</h3>
                    
                    <div class="sidebar-slider-container">
                      <div class="sidebar-slider-wrapper">
                        <?php 
                        $slideIdx = 0;
                        foreach ($packagesData as $pkgKey => $sidePkg) {
                          $starsHtml = str_repeat('<svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>', $sidePkg['stars']);
                          ?>
                          <div class="sidebar-slide <?php echo $slideIdx === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $slideIdx; ?>" style="<?php echo $slideIdx === 0 ? '' : 'display: none;'; ?>">
                            <a href="tel:+13238006001" class="sidebar-pkg-card" style="text-decoration: none; color: inherit; display: block;">
                              <div class="sidebar-pkg-img">
                                <img src="<?php echo htmlspecialchars($sidePkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($sidePkg['title']); ?>" loading="lazy">
                              </div>
                              <div class="sidebar-pkg-body">
                                <h4 class="sidebar-pkg-title"><?php echo htmlspecialchars($sidePkg['title']); ?></h4>
                                <p class="sidebar-pkg-nights">
                                  <?php echo preg_replace('/(\d+\s*Nights?)/i', '<span class="highlight-nights">$1</span>', htmlspecialchars($sidePkg['nightsDetail'])); ?>
                                </p>
                                <div class="sidebar-pkg-stars">
                                  <?php echo $starsHtml; ?>
                                </div>
                                <div class="sidebar-pkg-price-box">
                                  <span class="price-label">Price starts from:</span>
                                  <span class="price-val"><?php echo htmlspecialchars($sidePkg['price']); ?> Per Person</span>
                                </div>
                                <div class="sidebar-pkg-footer">
                                  <span class="btn-pkg-call" aria-label="Call Now">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1A11.36 11.36 0 018.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg>
                                  </span>
                                  <span class="btn-pkg-callback">Request Callback</span>
                                </div>
                              </div>
                            </a>
                          </div>
                          <?php
                          $slideIdx++;
                        }
                        ?>
                      </div>
                      
                      <!-- Slider Controls -->
                      <div class="sidebar-slider-controls">
                        <button class="slider-control-btn btn-prev" aria-label="Previous Package">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                        </button>
                        <button class="slider-control-btn btn-next active" aria-label="Next Package">
                          <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>

<?php
$extraJS = ['js/package-details.js'];
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
