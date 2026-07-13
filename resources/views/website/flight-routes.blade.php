<?php
$flightPageItem = $flightPageItem ?? null;
$routePageName = $flightPageItem?->route_text ?? $routeCategory?->name ?? 'Amsterdam';
$routeHeroImage = $flightPageItem?->image_url ?? $routeCategory?->image_url ?? asset('assets/images/amsterdam_banner_bg.png');
$isDestinationPage = ($flightPageType ?? 'route') === 'destination';
$pageSectionName = $isDestinationPage ? 'Destinations' : 'Routes';
$categoryRouteName = 'website.routes.category';
$pageTitle = "{$routePageName} Flights & {$pageSectionName} | Fares Junction";
$pageDescription = $flightPageItem?->description
    ? strip_tags($flightPageItem->description)
    : ($isDestinationPage
    ? "Compare flights and explore {$routePageName} as a travel destination with Fares Junction."
    : "Compare flights and explore travel routes for {$routePageName} with Fares Junction.");
$extraCSS = ['css/hero.css', 'css/routes.css'];
$extraJS = ['js/search.js'];
ob_start();
?>

<!-- Premium Breadcrumbs -->
<div class="premium-breadcrumb-container">
    <div class="container">
        <ul class="premium-breadcrumbs">
            <li><a href="{{ route('website.index') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ route('website.flights') }}">Flights</a> <span class="divider">/</span></li>
            @forelse ($routeBreadcrumbs as $breadcrumb)
                @if ($loop->last && ! $flightPageItem)
                    <li class="active" aria-current="page">{{ $breadcrumb->name }}</li>
                @else
                    <li>
                        <a href="{{ route($categoryRouteName, ['category' => $breadcrumb->slug]) }}">{{ $breadcrumb->name }}</a>
                        <span class="divider">/</span>
                    </li>
                @endif
            @empty
                @unless ($flightPageItem)
                    <li class="active" aria-current="page">{{ $pageSectionName }}</li>
                @endunless
            @endforelse
            @if ($flightPageItem)
                <li class="active" aria-current="page">{{ $flightPageItem->route_text }}</li>
            @endif
        </ul>
    </div>
</div>

<!-- Premium Hero Banner -->
<section class="premium-hero-banner" style="background-image: url('{{ $routeHeroImage }}');">
    <div class="premium-hero-overlay"></div>
    <div class="container premium-hero-container">
        <div class="premium-search-box">
            <div class="premium-search-title">Find Flights to {{ $routePageName }}</div>
            <!-- Search Form Widget -->
            @include('website.partials.banner-search-form')
        </div>
    </div>
</section>

<!-- Premium Main Content -->
<section class="premium-section" style="padding: 40px 0; background: #fff;">
    <div class="container">

        <!-- Next Trip Section -->
        <div class="next-trip-section fade-in-up">
            <div class="next-trip-header">
                <h2 class="next-trip-title">Recommended for your next trip</h2>
                <p class="next-trip-subtitle">Based on your most recent searches or your location</p>
            </div>
            <div class="next-trip-grid">
                <!-- Vancouver -->
                <a href="#" class="next-trip-card">
                    <img src="{{ asset('assets/images/vancouver.png') }}" alt="Vancouver" class="next-trip-img">
                    <div class="next-trip-content">
                        <div class="next-trip-cost-info">
                            <span>Similar flights usually cost between<br>,124 - $1,544. &#9432;</span>
                            <div class="price-bar"><span class="pb-green"></span><span class="pb-yellow"></span><span
                                    class="pb-red"></span></div>
                        </div>
                        <div class="next-trip-details">
                            <div>
                                <div class="next-trip-city">Vancouver</div>
                                <div class="next-trip-route">DEL - YVR<br>Oct 04 - Oct 30</div>
                            </div>
                            <div class="next-trip-price">$850<br><span
                                    style="font-size:1rem;font-weight:normal;color:#64748b;">Round Trip</span></div>
                        </div>
                    </div>
                </a>
                <!-- San Francisco -->
                <a href="#" class="next-trip-card">
                    <img src="{{ asset('assets/images/san_francisco.png') }}" alt="San Francisco" class="next-trip-img">
                    <div class="next-trip-content">
                        <div class="next-trip-cost-info">
                            <span>Similar flights usually cost between<br> - $984. &#9432;</span>
                            <div class="price-bar"><span class="pb-green"></span><span class="pb-yellow"></span><span
                                    class="pb-red"></span></div>
                        </div>
                        <div class="next-trip-details">
                            <div>
                                <div class="next-trip-city">San Francisco</div>
                                <div class="next-trip-route">DEL - SFO<br>Sep 10 - Feb 11</div>
                            </div>
                            <div class="next-trip-price">$878<br><span
                                    style="font-size:1rem;font-weight:normal;color:#64748b;">Round Trip</span></div>
                        </div>
                    </div>
                </a>
                <!-- Seattle -->
                <a href="#" class="next-trip-card">
                    <img src="{{ asset('assets/images/seattle.png') }}" alt="Seattle" class="next-trip-img">
                    <div class="next-trip-content">
                        <div class="next-trip-cost-info">
                            <span>Similar flights usually cost between<br> - $1,069. &#9432;</span>
                            <div class="price-bar"><span class="pb-green"></span><span class="pb-yellow"></span><span
                                    class="pb-red"></span></div>
                        </div>
                        <div class="next-trip-details">
                            <div>
                                <div class="next-trip-city">Seattle</div>
                                <div class="next-trip-route">DEL - SEA<br>Dec 05 - Dec 14</div>
                            </div>
                            <div class="next-trip-price">$879<br><span
                                    style="font-size:1rem;font-weight:normal;color:#64748b;">Round Trip</span></div>
                        </div>
                    </div>
                </a>
                <!-- Toronto -->
                <a href="#" class="next-trip-card">
                    <img src="{{ asset('assets/images/toronto.png') }}" alt="Toronto" class="next-trip-img">
                    <div class="next-trip-content">
                        <div class="next-trip-cost-info">
                            <span>Similar flights usually cost between<br>,073 - $1,338. &#9432;</span>
                            <div class="price-bar"><span class="pb-green"></span><span class="pb-yellow"></span><span
                                    class="pb-red"></span></div>
                        </div>
                        <div class="next-trip-details">
                            <div>
                                <div class="next-trip-city">Toronto</div>
                                <div class="next-trip-route">DEL - YTO<br>Nov 11 - Feb 07</div>
                            </div>
                            <div class="next-trip-price">$919<br><span
                                    style="font-size:1rem;font-weight:normal;color:#64748b;">Round Trip</span></div>
                        </div>
                    </div>
                </a>
            </div>
            <div style="font-size:1rem; color:#64748b; margin-top:15px;">*Rates last found on Jul 07, 2026 &#9432;
            </div>
        </div>

        <!-- Book With Confidence -->
        <div class="confidence-section fade-in-up">
            <div class="confidence-banner">
                <h3 class="confidence-title">Book with Confidence. Trusted by 40M+ Travelers</h3>
                <div class="confidence-grid">
                    <div class="confidence-item">
                        <div class="confidence-icon"><svg width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg></div>
                        <div class="confidence-text">
                            <h4>Price Match Promise &#9432;</h4>
                            <p>Found a better deal? We'll match it!</p>
                        </div>
                    </div>
                    <div class="confidence-item">
                        <div class="confidence-icon"><svg width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg></div>
                        <div class="confidence-text">
                            <h4>24/7 Customer Support</h4>
                            <p>Speak to our travel experts anytime, anywhere.</p>
                        </div>
                    </div>
                    <div class="confidence-item">
                        <div class="confidence-icon"><svg width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 8v4l3 3" />
                            </svg></div>
                        <div class="confidence-text">
                            <h4>ClubMiles Rewards</h4>
                            <p>Stack points & airline miles to save.</p>
                        </div>
                    </div>
                    <div class="confidence-item">
                        <div class="confidence-icon"><svg width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="4" y="2" width="16" height="20" rx="2" ry="2" />
                                <path d="M12 18h.01" />
                                <path d="M8 12h.01" />
                                <path d="M16 12h.01" />
                            </svg></div>
                        <div class="confidence-text">
                            <h4>Easy Cancellations</h4>
                            <p>Convenient options online and 24/7 global concierge.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cheap Flight Deals -->
        <div class="cheap-deals-section fade-in-up">
            <div class="cheap-deals-header">
                <h2 class="cheap-deals-title">Cheap Flight Deals to Amsterdam</h2>
                <div class="cheap-deals-subtitle">Call us for phone only deals at <a href="tel:000-800-050-3540"
                        style="color:#166534;">000-800-050-3540</a></div>
            </div>

            <div class="deals-tabs">
                <div class="deals-tab active" data-type="round-trip">Round Trip</div>
                <div class="deals-tab" data-type="one-way">One Way</div>
            </div>

            <div class="cheap-deals-grid" id="cheapDealsGrid">
                <!-- Deal 1 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>BWI</strong><span>Baltimore</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$584</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 6, 2026 - Nov 13, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Deal 2 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>WAS</strong><span>Washington DC</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$630</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 9, 2026 - Nov 14, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Deal 3 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>BOS</strong><span>Boston</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$640</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Oct 1, 2026 - Oct 4, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Deal 4 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>NYC</strong><span>New York City</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$655</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 2, 2026 - Nov 27, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Deal 5 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>CHI</strong><span>Chicago</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$675</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Oct 31, 2026 - Nov 14, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Deal 6 -->
                <div class="cheap-deal-card deal-item round-trip">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo" style="font-family:serif;font-style:normal;">SAS</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>MIA</strong><span>Miami</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$696</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Oct 29, 2026 - Nov 12, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <!-- Hidden Round Trip Deals (Shown on "Show More") -->
                <div class="cheap-deal-card deal-item round-trip hidden-deal">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>LAX</strong><span>Los Angeles</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$710</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 15, 2026 - Nov 22, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>

                <!-- Hidden One Way Deals -->
                <div class="cheap-deal-card deal-item one-way" style="display:none;">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>NYC</strong><span>New York</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$450</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Dec 01, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <div class="cheap-deal-card deal-item one-way" style="display:none;">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>BOS</strong><span>Boston</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$420</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 28, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
                <div class="cheap-deal-card deal-item one-way" style="display:none;">
                    <div class="cdc-top">
                        <div class="cdc-airline-logo">F</div>
                        <div class="cdc-route">
                            <div class="cdc-airport"><strong>MIA</strong><span>Miami</span></div>
                            <div class="cdc-line"></div>
                            <div class="cdc-airport"><strong>AMS</strong><span>Amsterdam</span></div>
                        </div>
                        <div class="cdc-price">From<br><strong>$510</strong></div>
                    </div>
                    <div class="cdc-bottom">
                        <div class="cdc-dates">Nov 18, 2026</div>
                        <a href="tel:0008000503540" class="cdc-btn"
                            style="text-decoration:none; display:inline-block; text-align:center; line-height:1.2;">Book
                            Now</a>
                    </div>
                </div>
            </div>

            <div style="text-align:center; margin-top:25px;">
                <button id="showMoreDealsBtn"
                    style="background:#f1f5f9;border:none;border-radius:20px;padding:10px 40px;font-weight:700;color:#0f294d;cursor:pointer;transition:0.3s;">Show
                    more</button>
            </div>
            <div style="font-size:1rem; color:#64748b; margin-top:15px;">*All fares above were last found on: &#9432;
            </div>
        </div>

        <!-- Near You Section -->
        <div class="near-you-section fade-in-up">
            <div class="near-you-header">
                <h2 class="near-you-title">Flight deals departing near you</h2>
                <div class="near-you-subtitle">Based on your location</div>
            </div>
            <div class="near-you-grid">
                <a href="#" class="near-you-card">
                    <img src="{{ asset('assets/images/amsterdam_near_you.png') }}" alt="Amsterdam" class="near-you-img">
                    <div class="near-you-content">
                        <div class="near-you-top">
                            <div class="near-you-city">Amsterdam</div>
                            <div class="near-you-price">$637*</div>
                        </div>
                        <div class="near-you-bottom">
                            <div>DEL - AMS<br>Sep 15 - Sep 20</div>
                            <div>Round Trip</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="near-you-card">
                    <img src="{{ asset('assets/images/amsterdam_near_you.png') }}" alt="London" class="near-you-img"
                        style="filter: hue-rotate(180deg);">
                    <div class="near-you-content">
                        <div class="near-you-top">
                            <div class="near-you-city">London</div>
                            <div class="near-you-price">$589*</div>
                        </div>
                        <div class="near-you-bottom">
                            <div>DEL - LHR<br>Oct 10 - Oct 17</div>
                            <div>Round Trip</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="near-you-card">
                    <img src="{{ asset('assets/images/amsterdam_near_you.png') }}" alt="Paris" class="near-you-img"
                        style="filter: hue-rotate(90deg);">
                    <div class="near-you-content">
                        <div class="near-you-top">
                            <div class="near-you-city">Paris</div>
                            <div class="near-you-price">$615*</div>
                        </div>
                        <div class="near-you-bottom">
                            <div>DEL - CDG<br>Nov 01 - Nov 08</div>
                            <div>Round Trip</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="near-you-card">
                    <img src="{{ asset('assets/images/amsterdam_near_you.png') }}" alt="Rome" class="near-you-img"
                        style="filter: hue-rotate(270deg);">
                    <div class="near-you-content">
                        <div class="near-you-top">
                            <div class="near-you-city">Rome</div>
                            <div class="near-you-price">$710*</div>
                        </div>
                        <div class="near-you-bottom">
                            <div>DEL - FCO<br>Dec 05 - Dec 12</div>
                            <div>Round Trip</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Content & Table Section -->
        <div class="content-section fade-in-up">
            <h2>Cheap Flights to Amsterdam &ndash; Find Affordable Airfare to the Netherlands</h2>
            <p>Amsterdam, Netherlands, welcomes you with golden canals, crooked houses, world-class museums, and the
                Dutch
                spirit of <em>gezelligheid</em>, that warm mix of comfort, creativity, and cozy charm that defines the
                city.
            </p>
            <p>Whether you're here for tulip fields, caf&eacute; culture, or a canal-side escape, finding cheap flights
                to
                Amsterdam is simple. With flexible dates, fare alerts, and comparison tools on our platform, you can
                secure
                our best deals for your European getaway.</p>

            <h3>How to Find the Cheapest Flights to Amsterdam?</h3>
            <p>Looking for low fares from U.S. airports to AMS? These flight-booking tips can help you save on your
                Dutch
                getaway:</p>

            <div class="table-responsive" style="overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch;">
                <table class="tips-table">
                    <thead>
                        <tr>
                            <th>Tip</th>
                            <th>Why It Works</th>
                            <th>For U.S. Travelers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fly midweek</td>
                            <td>Airfare dips Tuesday-Wednesday</td>
                            <td>Often 15% cheaper from NYC, Chicago and Boston</td>
                        </tr>
                        <tr>
                            <td>Pick shoulder seasons</td>
                            <td>Less demand = better prices</td>
                            <td>Mid-spring and early autumn flights are often our best deals</td>
                        </tr>
                        <tr>
                            <td>Mix airlines</td>
                            <td>Combine one-way bookings</td>
                            <td>Budget and legacy carriers can offer cheaper alternatives</td>
                        </tr>
                        <tr>
                            <td>Set fare alerts</td>
                            <td>Real-time tracking of rate changes</td>
                            <td>Be in the loop when prices drop</td>
                        </tr>
                        <tr>
                            <td>Use flexible dates</td>
                            <td>Search 3-day or weekend windows</td>
                            <td>Adjusting by a day can save over $100 on average</td>
                        </tr>
                        <tr>
                            <td>Choose alternate routes</td>
                            <td>Consider connecting in Iceland, Paris or Dublin</td>
                            <td>May find lower Euro-bound rates with stopovers</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <ul>
                <li><span class="pro-tip">Pro tip:</span> Based on flight data, airfares to Amsterdam are cheaper when
                    booked
                    6-9 weeks before your trip, especially during spring and fall.</li>
            </ul>

            <h3>When Is Our Best Time to Visit Amsterdam?</h3>
            <p>Amsterdam is beautiful year-round, but each season brings different airfare patterns, weather, and
                signature
                Dutch experiences.</p>
            <p><a href="#" style="color:#0f294d;font-weight:700;">Winter off-season (Nov-Feb)</a><br>Great for
                budget-conscious travelers. Fewer crowds and twinkling holiday lights make this a cozy time to explore.
                Average round-trip prices from New York range from $490 to $580.</p>
        </div>

        <!-- Accordion Links -->
        <div class="accordion accordion-flush accordion-links-section fade-in-up" id="routesAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="routesHeadingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#routesCollapseOne" aria-expanded="true" aria-controls="routesCollapseOne">
                        Flights to Amsterdam
                    </button>
                </h2>
                <div id="routesCollapseOne" class="accordion-collapse collapse show" aria-labelledby="routesHeadingOne"
                    data-bs-parent="#routesAccordion">
                    <div class="accordion-body">
                        <div class="al-grid">
                        <a href="#" class="al-link">Flights from New York City to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Chicago to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Houston to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Washington DC to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Toronto to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Orlando to Amsterdam</a>
                        <a href="#" class="al-link">Flights from San Francisco to Amsterdam</a>
                        <a href="#" class="al-link">Flights from Los Angeles to Amsterdam</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="routesHeadingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#routesCollapseTwo" aria-expanded="false" aria-controls="routesCollapseTwo">
                        Flights from Amsterdam
                    </button>
                </h2>
                <div id="routesCollapseTwo" class="accordion-collapse collapse" aria-labelledby="routesHeadingTwo"
                    data-bs-parent="#routesAccordion"><div class="accordion-body"></div></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="routesHeadingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#routesCollapseThree" aria-expanded="false" aria-controls="routesCollapseThree">
                        Flights to Nearby Cities
                    </button>
                </h2>
                <div id="routesCollapseThree" class="accordion-collapse collapse" aria-labelledby="routesHeadingThree"
                    data-bs-parent="#routesAccordion"><div class="accordion-body"></div></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="routesHeadingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#routesCollapseFour" aria-expanded="false" aria-controls="routesCollapseFour">
                        Airports Near Amsterdam
                    </button>
                </h2>
                <div id="routesCollapseFour" class="accordion-collapse collapse" aria-labelledby="routesHeadingFour"
                    data-bs-parent="#routesAccordion"><div class="accordion-body"></div></div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="routesHeadingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#routesCollapseFive" aria-expanded="false" aria-controls="routesCollapseFive">
                        Airlines Fly to Amsterdam
                    </button>
                </h2>
                <div id="routesCollapseFive" class="accordion-collapse collapse" aria-labelledby="routesHeadingFive"
                    data-bs-parent="#routesAccordion"><div class="accordion-body"></div></div>
            </div>
        </div>

        <!-- Cross-Sells -->
        <div class="cross-sells fade-in-up">
            <a href="#" class="cross-sell-card">
                <div class="csc-left">
                    <div class="csc-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M2 5v14M22 5v14M5 9h14M5 15h14M2 9h20M2 15h20" />
                        </svg></div>
                    <div>Cheap Hotels in Amsterdam</div>
                </div>
                <div class="csc-arrow">&#8599;</div>
            </a>
            <a href="#" class="cross-sell-card">
                <div class="csc-left">
                    <div class="csc-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="8" rx="2" />
                            <circle cx="7" cy="19" r="2" />
                            <circle cx="17" cy="19" r="2" />
                            <path d="M5 11l2-5h10l2 5" />
                        </svg></div>
                    <div>Car Rentals in Amsterdam</div>
                </div>
                <div class="csc-arrow">&#8599;</div>
            </a>
            <a href="#" class="cross-sell-card">
                <div class="csc-left">
                    <div class="csc-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M20 16.58A5 5 0 0 0 18 7h-1.26A8 8 0 1 0 4 15.25" />
                            <path d="M12 7v8" />
                        </svg></div>
                    <div>Amsterdam Vacation Packages</div>
                </div>
                <div class="csc-arrow">&#8599;</div>
            </a>
        </div>
    </div>
</section><!-- Back to Top Button -->

<?php
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.guest', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
