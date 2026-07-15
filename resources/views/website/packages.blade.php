<?php
$pageTitle = 'Popular Vacation Packages & Tour Deals | Fares Junction';
$pageDescription = 'Browse and book handpicked vacation packages and global tour deals with flights, hotels, and sightseeing included.';
$extraCSS = ['css/vacations.css', 'css/flights.css', 'css/blogs-page.css'];
ob_start();
?>

<!-- Packages Hero Section with Flight Search Form -->
<section class="packages-hero">
    <div class="blog-hero-content">
        <h1 class="blog-hero-title">Exclusive Vacation Packages & Custom Holiday Deals</h1>

        <!-- Reused Flight Search Form Container -->
        <div class="inquiry-banner-card" id="flightSearchWidget"
            style="max-width: 1000px; text-align: left; margin: 0 auto;">
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
                    <div class="form-grid-row row1-grid" style="grid-template-columns: 1fr auto 1fr 1.1fr 1.1fr 0.8fr;">
                        <div class="input-field-wrapper">
                            <input type="text" id="flight-origin" placeholder="Flying From - City" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" />
                            </svg>
                        </div>

                        <button type="button" class="dest-swap-btn" id="btn-swap-dest" aria-label="Swap Locations">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="17 11 21 7 17 3" />
                                <line x1="21" y1="7" x2="9" y2="7" />
                                <polyline points="7 13 3 17 7 21" />
                                <line x1="3" y1="17" x2="15" y2="17" />
                            </svg>
                        </button>

                        <div class="input-field-wrapper">
                            <input type="text" id="flight-destination" placeholder="Flying To - City" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="transform: rotate(90deg);">
                                <path
                                    d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L14 19v-5.5l7 2.5z" />
                            </svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="text" id="flight-departure" placeholder="Journey Date"
                                onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="text" id="flight-return" placeholder="Return Date"
                                onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
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
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                        </div>
                    </div>

                    <!-- Row 2 Inputs -->
                    <div class="form-grid-row row2-grid" style="grid-template-columns: 1.2fr 1.2fr 1.2fr 0.9fr;">
                        <div class="input-field-wrapper">
                            <input type="text" id="flight-name" placeholder="Name" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="tel" id="flight-phone" placeholder="Phone Number" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="email" id="flight-email" placeholder="Email ID" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>

                        <div>
                            <button type="submit" class="banner-submit-btn">Search Packages</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Success State Widget -->
        <div class="banner-success-card" id="flightSuccessWidget"
            style="display: none; max-width: 600px; text-align: center; margin: 0 auto;">
            <div
                style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; color: var(--white);">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor"
                    stroke-width="3">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 0.5rem;">
                Inquiry Submitted Successfully!</h2>
            <p style="color: var(--gray-600); line-height: 1.6;">Thank you. Our travel desk is planning fares for
                <strong id="success-flight-route">your trip</strong>. We will contact you shortly with a customized
                tour proposal.</p>
        </div>

    </div>
</section>

<!-- Reused Packages Grid Listing -->
<div style="padding: 5rem 0; background-color: var(--gray-100); min-height: 50vh;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span class="package-badge" style="margin-bottom: 0.5rem; display: inline-flex;">Holiday Tours</span>
            <h2 class="section-title">Popular Tour Packages</h2>
            <p class="section-subtitle"
                style="color: var(--gray-500); max-width: 600px; margin: 0.5rem auto 0 auto; line-height: 1.6; font-size: 0.95rem;">
                Explore handpicked, high-value vacation packages around the globe. Get the lowest fares on flights,
                hotels, and tours.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
            <?php
              foreach ($packagesData as $key => $pkg) {
                $starsHtml = str_repeat('<svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>', $pkg['stars']);
                ?>
            <a href="<?php echo route('website.package-details', $key); ?>" class="vacation-card"
                style="height: 100%; display: flex; flex-direction: column;">
                <div class="vacation-img-wrapper" style="height: 200px;">
                    <img src="<?php echo htmlspecialchars($pkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="vacation-img" loading="lazy">
                </div>
                <div class="vacation-body"
                    style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; text-align: center;">
                    <h3 class="vacation-title"
                        style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-bottom: 0.75rem;">
                        <?php echo htmlspecialchars($pkg['title']); ?></h3>
                    <p class="vacation-nights"
                        style="font-size: 0.92rem; color: var(--gray-800); margin-bottom: 0.75rem; display: block; text-align: center;">
                        <?php echo preg_replace('/(\d+\s*Nights?)/i', '<span class="highlight-nights" style="color:var(--secondary-color); font-weight:700;">$1</span>', htmlspecialchars($pkg['nightsDetail'])); ?>
                    </p>
                    <div class="vacation-stars"
                        style="display: flex; justify-content: center; gap: 3px; color: #ffb800; margin-bottom: 1rem;">
                        <?php echo $starsHtml; ?>
                    </div>
                    <div class="vacation-price-box"
                        style="margin-top: auto; border-top: 1px dashed var(--gray-200); padding-top: 1rem; margin-bottom: 1rem;">
                        <span class="vacation-price-label"
                            style="font-size: 0.85rem; color: var(--gray-500); display: block; margin-bottom: 0.15rem;">Price
                            starts from:</span>
                        <span class="vacation-price"
                            style="font-size: 1.15rem; font-weight: 800; color: var(--primary-color);"><?php echo htmlspecialchars($pkg['price']); ?>
                            Per Person</span>
                    </div>
                    <span class="btn-vacation-offer"
                        style="display: inline-block; width: 100%; padding: 0.65rem 0; border: 1px solid var(--secondary-color); color: var(--secondary-color); background: transparent; border-radius: var(--btn-radius); font-weight: 600; font-size: 0.9rem; text-align: center;">View
                        Offer</span>
                </div>
            </a>
            <?php
              }
              ?>
        </div>
    </div>
</div>

<?php
$extraJS = ['js/flights.js'];
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.guest', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
