<?php
$airlines = ($databaseAirlinePages ?? collect())
    ->mapWithKeys(fn ($airlinePage) => [
        $airlinePage->slug => [
            'name' => $airlinePage->name,
            'code' => $airlinePage->code ?: 'N/A',
            'intro' => $airlinePage->intro ?: "Compare {$airlinePage->name} flights and get help from Fares Junction.",
            'routes' => $airlinePage->routes ?? [],
            'faqs' => $airlinePage->faqs ?? [],
            'sections' => $airlinePage->mergedSections(),
            'meta_title' => $airlinePage->meta_title,
            'meta_description' => $airlinePage->meta_description,
        ],
    ])
    ->all();

$allSidebarPages = $sectionLabels ?? [];

if (empty($airlines)) {
    $pageTitle = 'Airline Pages | Fares Junction';
    $pageDescription = 'Explore airline travel guides from Fares Junction.';
    $extraCSS = ['css/hero.css', 'css/airline.css'];
    $extraJS = ['js/search.js'];
    ob_start();
    ?>
<section class="airline-content-section">
    <div class="container">
        <article class="airline-content-card">
            <h1 class="section-title">No airline pages available</h1>
            <p>Active airline pages added in the admin panel will appear here.</p>
        </article>
    </div>
</section>
<?php
    $slot = new \Illuminate\Support\HtmlString(ob_get_clean());

    echo view('layouts.airline', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
    return;
}

$defaultAirlineKey = array_key_exists('american-airlines', $airlines) ? 'american-airlines' : array_key_first($airlines);
$airlineKey = $requestedAirlineKey ?: request('airline', $defaultAirlineKey);
$airlineKey = array_key_exists($airlineKey, $airlines) ? $airlineKey : $defaultAirlineKey;
$airline = $airlines[$airlineKey];

$contentMap = collect($allSidebarPages)
    ->filter(fn (string $label, string $key): bool => filled($airline['sections'][$key]['body'] ?? null))
    ->mapWithKeys(fn (string $label, string $key): array => [
        $key => [
            'title' => $airline['sections'][$key]['title'] ?: $label,
            'body' => $airline['sections'][$key]['body'],
        ],
    ])
    ->all();
$sidebarPages = collect($contentMap)
    ->mapWithKeys(fn (array $section, string $key): array => [$key => $section['title']])
    ->all();
$pageKey = $requestedSectionKey ?: 'overview';
$pageKey = array_key_exists($pageKey, $sidebarPages) ? $pageKey : array_key_first($sidebarPages);
$activePageTitle = $pageKey ? $sidebarPages[$pageKey] : null;

$pageTitle = $airline['meta_title'] ?: "{$airline['name']} Flights & Travel Guide | Fares Junction";
$pageDescription = $airline['meta_description'] ?: "{$airline['intro']} Get 24/7 assistance from Fares Junction.";
$extraCSS = ['css/hero.css', 'css/airline.css'];
$extraJS = ['js/search.js'];
ob_start();
?>

<section class="airline-banner">
    <div class="container airline-banner-container">
        <div class="airline-hero-copy">
            <h1>Book {{ $airline['name'] }} Flights with Fares Junction</h1>
        </div>

        @include('website.partials.banner-search-form')
    </div>
</section>

<section class="airline-content-section">
    <div class="container">
        <nav class="airline-breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="{{ route('website.index') }}">Home</a></li>
                <li><a href="{{ route('website.airline.slug', $airlineKey) }}">{{ $airline['name'] }}</a></li>
                @if ($activePageTitle)
                    <li aria-current="page">{{ $activePageTitle }}</li>
                @endif
            </ol>
        </nav>

        <div class="airline-page-heading">
            <h2>
                {{ $airline['name'] }}
                @if ($activePageTitle)
                    <span>{{ $activePageTitle }}</span>
                @endif
            </h2>
        </div>

        <div class="airline-layout">
            <aside class="airline-sidebar" aria-label="{{ $airline['name'] }} page navigation">
                <ul class="airline-nav-list">
                    <?php foreach ($sidebarPages as $key => $label): ?>
                    <li>
                        <a href="{{ route('website.airline.section', ['airline' => $airlineKey, 'section' => $key]) }}"
                            class="airline-nav-item {{ $pageKey === $key ? 'active' : '' }}"
                            @if ($pageKey === $key) aria-current="page" @endif>
                            {{ $label }}
                            @if ($key === 'classes-seat')
                                <span class="arrow">▼</span>
                            @endif
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <main class="airline-main-content">
                <article class="airline-content-card">
                    <p class="airline-code">Airline Code: {{ $airline['code'] }}</p>
                    @if ($pageKey)
                        <p>{{ $contentMap[$pageKey]['body'] }}</p>
                    @else
                        <h2 class="section-title">No section content available</h2>
                        <p>Section content added in the admin panel will appear here.</p>
                    @endif
                </article>

                <hr class="airline-content-divider">

                <section class="airline-popular-flights">
                    <h3 class="airline-section-title"><span>Popular Flights from</span> {{ $airline['name'] }}</h3>
                    <div class="popular-flights-box">
                        <ul class="popular-flights-list">
                            <?php foreach ($airline['routes'] as $route): ?>
                            <li>{{ $route }}</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>

                @if (!empty($airline['faqs']))
                    <section class="airline-faq-section">
                        <h3 class="airline-section-title">Frequently Asked Questions</h3>
                        <div class="accordion faq-accordion" id="airlineFaqAccordion">
                            @foreach ($airline['faqs'] as $index => $faq)
                                @php
                                    $headingId = 'airlineFaqHeading' . $index;
                                    $collapseId = 'airlineFaqCollapse' . $index;
                                    $isOpen = $loop->first;
                                @endphp
                                <div class="accordion-item faq-item">
                                    <h4 class="accordion-header" id="{{ $headingId }}">
                                        <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}"
                                            aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                                            aria-controls="{{ $collapseId }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h4>
                                    <div id="{{ $collapseId }}"
                                        class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}"
                                        aria-labelledby="{{ $headingId }}"
                                        data-bs-parent="#airlineFaqAccordion">
                                        <div class="accordion-body faq-content">
                                            <p>{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
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
