<?php
$pageTitle = 'Popular Airlines Worldwide | Fares Junction';
$pageDescription = 'Book cheap tickets for domestic and international flights with Fares Junction. We unlock exclusive airfare deals so you can fly at the best prices.';
$extraCSS = ['css/hero.css', 'css/airline.css'];
$extraJS = ['js/search.js'];
ob_start();
?>

<style>
    .airline-index-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2rem;
        margin-top: 2rem;
        align-items: start;
    }

    @media (max-width: 991px) {
        .airline-index-layout {
            grid-template-columns: 1fr;
        }
    }

    .airline-sidebar {
        position: sticky;
        top: 100px;
        align-self: start;
        z-index: 10;
        transition: all 0.3s ease-in-out;
    }

    .category-section {
        margin-bottom: 2.5rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .category-header {
        background-color: #0f294d;
        color: #fff;
        padding: 1rem 1.5rem;
    }

    .category-header h2 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
    }

    .category-body {
        padding: 1.5rem;
    }

    .airline-item {
        margin-bottom: 2rem;
    }

    .airline-item:last-child {
        margin-bottom: 0;
    }

    .airline-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #ff6b00;
        margin-bottom: 0.75rem;
    }

    .airline-features {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
        color: #444;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .airline-features strong {
        color: #222;
    }

    .airline-info-line {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .airline-info-line strong {
        color: #222;
    }

    .static-cta-banner .cta-close-btn {
        display: none;
    }

    .smart-hacks-box {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 3rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .smart-hacks-box ul li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .smart-hacks-box h3,
    .faq-section h3 {
        color: #0f294d;
    }

    .faq-section {
        margin-top: 3rem;
    }

    .airline-main-content 
</style>

<section class="airline-banner">
    <div class="container airline-banner-container">
        <div class="airline-hero-copy">
            <span class="airline-page-label">AIRLINES INDEX</span>
            <h1>Popular Airlines Worldwide</h1>
            <p>Book cheap tickets for domestic and international flights with Fares Junction. We unlock exclusive
                airfare deals so you can fly at the best prices.</p>
        </div>

        @include('website.partials.banner-search-form')
    </div>
</section>

<section class="airline-content-section" style="padding-bottom: 4rem;">
    <div class="container">
        <div class="airline-index-layout">

            <!-- Left Sidebar Navigation -->
            <aside class="airline-sidebar" aria-label="Airlines index navigation">
                <ul class="airline-nav-list">
                    <li>
                        <a href="#major-us" class="airline-nav-item active"
                            onclick="document.querySelectorAll('.airline-nav-item').forEach(el=>el.classList.remove('active')); this.classList.add('active');">
                            Major Airlines in the US
                        </a>
                    </li>
                    <li>
                        <a href="#budget-us" class="airline-nav-item"
                            onclick="document.querySelectorAll('.airline-nav-item').forEach(el=>el.classList.remove('active')); this.classList.add('active');">
                            Popular Budget Airlines in the US
                        </a>
                    </li>
                    <li>
                        <a href="#middle-eastern" class="airline-nav-item"
                            onclick="document.querySelectorAll('.airline-nav-item').forEach(el=>el.classList.remove('active')); this.classList.add('active');">
                            Popular Middle Eastern Airlines
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Right Main Content -->
            <main class="airline-main-content">

                <!-- Section 1 -->
                <div id="major-us" class="category-section">
                    <div class="category-header">
                        <h2>Major Airlines in the US</h2>
                    </div>
                    <div class="category-body">

                        <a class="airline-item" href="{{ route('website.airline.slug', 'delta-airlines') }}">
                            <h3 class="airline-name">Delta Air Lines (DL)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Atlanta (ATL), Detroit (DTW), 
                                Minneapolis/St. Paul (MSP)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> Atlanta (ATL) - Orlando
                                (MCO)</p>
                        </a>
                        
                        <a class="airline-item" href="{{ route('website.airline.slug', 'american-airlines') }}">
                            <h3 class="airline-name">American Airlines (AA)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Dallas/Fort Worth (DFW), Miami (MIA),
                                Charlotte (CLT)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> New York (JFK) - Los Angeles
                                (LAX)</p>
                        </a>
                        
                        <a class="airline-item" href="{{ route('website.airline.slug', 'southwest-airlines') }}">
                            <h3 class="airline-name">Southwest Airlines (WN)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Dallas/Fort Worth (DFW), Miami (MIA),
                                Charlotte (CLT)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> New York (JFK) - Los Angeles
                                (LAX)</p>
                        </a>
                        
                        <a class="airline-item" href="{{ route('website.airline.slug', 'united-airlines') }}">
                            <h3 class="airline-name">United Airlines (UA)</h3>
                            <ul class="airline-features">
                                <li>Extensive flight network covering <strong>domestic and international
                                        airlines</strong>.</li>
                                <li><strong>Refundable airline tickets</strong> and easy <strong>airline ticket change
                                        policies</strong>.</li>
                                <li>Comfortable seating options in <strong>business class, premium economy</strong>, and
                                    <strong>economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hubs:</strong> Chicago O'Hare (ORD), Newark (EWR), San
                                Francisco (SFO)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> Chicago (ORD) - Denver (DEN)
                            </p>
                        </a>
                        
                        <a class="airline-item" href="{{ route('website.airline.slug', 'alaska-airlines') }}">
                            <h3 class="airline-name">Alaska Airlines (AS)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Dallas/Fort Worth (DFW), Miami (MIA),
                                Charlotte (CLT)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> New York (JFK) - Los Angeles
                                (LAX)</p>
                        </a>
                        
                         <a class="airline-item" href="{{ route('website.airline.slug', 'jetblue-airways') }}">
                            <h3 class="airline-name">JetBlue Airways (B6)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Dallas/Fort Worth (DFW), Miami (MIA),
                                Charlotte (CLT)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> New York (JFK) - Los Angeles
                                (LAX)</p>
                        </a>
                    </div>
                </div>

                <!-- Section 2 -->
                <div id="budget-us" class="category-section">
                    <div class="category-header">
                        <h2>Popular Budget Airlines in the US</h2>
                    </div>
                    <div class="category-body">
                        <div class="airline-item">
                            <h3 class="airline-name">JetBlue Airways (B6)</h3>
                            <ul class="airline-features">
                                <li>Spacious seating, free onboard entertainment, and complimentary Wi-Fi.</li>
                                <li>Affordable fares with options to upgrade to <strong>business class</strong> and
                                    premium economy.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hubs:</strong> New York (JFK), Boston (BOS), Fort
                                Lauderdale (FLL)</p>
                        </div>

                        <div class="airline-item">
                            <ul class="airline-features">
                                <li>Ultra-low-cost flights with a customizable fare structure.</li>
                                <li>Budget-friendly <strong>domestic and international airline reservations</strong>.
                                </li>
                            </ul>
                            <p class="airline-info-line"><strong>Hubs:</strong> Fort Lauderdale (FLL), Orlando (MCO),
                                Las Vegas (LAS)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> Fort Lauderdale (FLL) - Cancun
                                (CUN)</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div id="middle-eastern" class="category-section">
                    <div class="category-header">
                        <h2>Popular Middle Eastern Airlines</h2>
                    </div>
                    <div class="category-body">
                        <div class="airline-item">
                            <h3 class="airline-name">Etihad Airways (EY)</h3>
                            <ul class="airline-features">
                                <li>Premium travel experience with <strong>personalized services and world-class
                                        in-flight dining</strong>.</li>
                                <li>Easy <strong>ticket changes</strong> and <strong>refundable airlines
                                        tickets</strong> for flexible travel plans.</li>
                                <li>Business travelers enjoy luxury in <strong>first class</strong> and <strong>business
                                        class cabins</strong>.</li>
                            </ul>
                            <p class="airline-info-line"><strong>Hubs:</strong> Abu Dhabi International Airport (AUH)
                            </p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> Abu Dhabi (AUH) - London
                                Heathrow (LHR)</p>
                        </div>

                        <div class="airline-item">
                            <h3 class="airline-name">Emirates (EK)</h3>
                            <ul class="airline-features">
                                <li>Globally recognized for luxury service, world-class entertainment, and premium
                                    economy cabins.</li>
                                <li>Flexible booking options with <strong>refundable flight tickets</strong> and
                                    <strong>business class</strong> upgrades.</li>
                            </ul>
                        </div>

                    </div>
                </div>

            </main>
        </div>

        <!-- Smart Hacks Section -->
        <div class="smart-hacks-box">
            <p class="text-muted small mb-3">**Note: The information provided is based on available data as of March
                2025 and may be subject to change.</p>
            <h3 class="mb-3 fw-bold">Smart Hacks to Find the Best Flight Deals!</h3>
            <p>Want to stretch your travel budget even further? Here's how to score unbeatable airfare deals:</p>
            <ul class="list-unstyled mb-4">
                <li class="mb-2">🌟 <span>Avoid weekends for bookings; opt for Tuesdays and Wednesdays to uncover the
                        most affordable tickets.</span></li>
                <li class="mb-2">✈️ <span>Consider flying early in the morning or late at night—these times often have
                        lower fares and fewer travelers.</span></li>
                <li class="mb-2">📅 <span>Embrace flexibility! Changing your flight dates by a day or two can lead to
                        amazing discounts on international flights and even business-class options.</span></li>
            </ul>
            <p class="mb-0">At Fares Junction, we're thrilled to offer last-minute flight discounts, refundable
                tickets, and exclusive deals. Call us at <a href="tel:+13238006001"
                    class="text-primary text-decoration-underline">+1 (323) 800 6001</a>, and let's make your travel
                dreams a reality!</p>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section airline-faq-section mb-5">
            <h3 class="fw-bold mb-4">FAQ's</h3>
            <div class="accordion faq-accordion" id="airlineFaqAccordion">

                <div class="accordion-item faq-item">
                    <h4 class="accordion-header" id="faqHeading0">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse0" aria-expanded="false" aria-controls="faqCollapse0">
                            What is the best time to book cheap airline tickets?
                        </button>
                    </h4>
                    <div id="faqCollapse0" class="accordion-collapse collapse" aria-labelledby="faqHeading0"
                        data-bs-parent="#airlineFaqAccordion">
                        <div class="accordion-body faq-content">
                            <p>To get the best deals on airline tickets, it is generally recommended to book 1 to 3
                                months in advance for domestic flights and 2 to 8 months in advance for international
                                flights. Flexibility with travel dates can also help you find cheaper options.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item">
                    <h4 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                            How can I change my name, reschedule my flight, or rebook a missed flight?
                        </button>
                    </h4>
                    <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1"
                        data-bs-parent="#airlineFaqAccordion">
                        <div class="accordion-body faq-content">
                            <p>Most airlines allow minor name corrections or date changes for a fee, depending on the
                                ticket type. If you miss a flight, contact the airline immediately to see if you can be
                                rebooked on the next available flight. You can also contact our support team for
                                assistance.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item">
                    <h4 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            How can I find last-minute flight deals and discounts?
                        </button>
                    </h4>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                        data-bs-parent="#airlineFaqAccordion">
                        <div class="accordion-body faq-content">
                            <p>Last-minute deals can sometimes be found by remaining flexible with your travel dates and
                                destinations, signing up for fare alerts, or calling travel agencies directly. Give us a
                                call at +1 (323) 800 6001 and we can check exclusive unpublished fares for you.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item">
                    <h4 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Can I cancel my flight and get a refund?
                        </button>
                    </h4>
                    <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                        data-bs-parent="#airlineFaqAccordion">
                        <div class="accordion-body faq-content">
                            <p>Refund eligibility depends on the airline's policy and the fare class of your ticket.
                                Fully refundable tickets allow cash refunds, while non-refundable tickets might only
                                offer a travel credit minus a cancellation fee.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item">
                    <h4 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            Can I transfer my flight ticket to someone else?
                        </button>
                    </h4>
                    <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                        data-bs-parent="#airlineFaqAccordion">
                        <div class="accordion-body faq-content">
                            <p>Generally, airline tickets are non-transferable, meaning you cannot change the name on a
                                ticket to someone else's name. However, some airlines may allow it for a significant
                                fee. It's best to check with the specific airline's policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.airline', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
