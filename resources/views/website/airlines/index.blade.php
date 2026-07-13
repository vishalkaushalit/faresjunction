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
        align-items: start;
    }

    @media (max-width: 991px) {
        .airline-index-layout {
            grid-template-columns: 1fr;
        }
    }

    .category-section {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        scroll-margin-top: 100px;
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

    .airline-main-content {
        padding: 0;
        background: none;
        box-shadow: none;
    }
</style>

<section class="airline-banner">
    <div class="container airline-banner-container">
        <div class="airline-hero-copy">
            <h1>Popular Airlines Worldwide</h1>
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

                        <div class="airline-item">
                            <h3 class="airline-name">American Airlines (AA)</h3>
                            <ul class="airline-features">
                                <li>Premium services in <strong>business class, first class</strong>, and
                                    <strong>premium economy</strong>.
                                </li>
                            </ul>
                            <p class="airline-info-line"><strong>Hub:</strong> Dallas/Fort Worth (DFW), Miami (MIA),
                                Charlotte (CLT)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> New York (JFK) - Los Angeles
                                (LAX)</p>
                        </div>

                        <div class="airline-item">
                            <h3 class="airline-name">United Airlines (UA)</h3>
                            <ul class="airline-features">
                                <li>Extensive flight network covering <strong>domestic and international
                                        airlines</strong>.</li>
                                <li><strong>Refundable airline tickets</strong> and easy <strong>airline ticket change
                                        policies</strong>.</li>
                                <li>Comfortable seating options in <strong>business class, premium economy</strong>, and
                                    <strong>economy</strong>.
                                </li>
                            </ul>
                            <p class="airline-info-line"><strong>Hubs:</strong> Chicago O'Hare (ORD), Newark (EWR), San
                                Francisco (SFO)</p>
                            <p class="airline-info-line"><strong>Popular Route:</strong> Chicago (ORD) - Denver (DEN)
                            </p>
                        </div>
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
                                    <strong>business class</strong> upgrades.
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>
</section>


<?php
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view('layouts.airline', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
