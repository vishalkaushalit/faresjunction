<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    private const SYSTEM_AUTHOR_EMAIL = 'blogs@faresjunction.com';

    public function up(): void
    {
        $now = now();
        $authorId = $this->systemAuthorId($now);

        foreach ($this->blogs() as $slug => $blog) {
            if (DB::table('blog_posts')->where('slug', $slug)->exists()) {
                continue;
            }

            $categoryId = $this->categoryId($blog['category'], $now);
            $postId = DB::table('blog_posts')->insertGetId([
                'author_id' => $authorId,
                'blog_category_id' => $categoryId,
                'title' => $blog['title'],
                'slug' => $slug,
                'featured_image' => $blog['image'],
                'featured_image_alt' => $blog['title'],
                'excerpt' => $blog['excerpt'],
                'table_of_contents' => json_encode($blog['table_of_contents']),
                'content' => $blog['content'],
                'status' => true,
                'published_at' => $blog['published_at'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($blog['tags'] as $tagName) {
                $tagId = $this->tagId($tagName, $now);

                DB::table('blog_post_tag')->insertOrIgnore([
                    'blog_post_id' => $postId,
                    'tag_id' => $tagId,
                ]);
            }
        }
    }

    public function down(): void
    {
        $slugs = array_keys($this->blogs());

        DB::table('blog_posts')->whereIn('slug', $slugs)->delete();

        $author = DB::table('users')->where('email', self::SYSTEM_AUTHOR_EMAIL)->first();

        if ($author && ! DB::table('blog_posts')->where('author_id', $author->id)->exists()) {
            DB::table('users')->where('id', $author->id)->delete();
        }
    }

    private function systemAuthorId($now)
    {
        $author = DB::table('users')->where('email', self::SYSTEM_AUTHOR_EMAIL)->first();

        if ($author) {
            return $author->id;
        }

        return DB::table('users')->insertGetId([
            'name' => 'Fares Junction',
            'email' => self::SYSTEM_AUTHOR_EMAIL,
            'password' => Hash::make(Str::random(32)),
            'role' => User::ROLE_AUTHOR,
            'status' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function categoryId(string $name, $now)
    {
        $slug = Str::slug($name);
        $category = DB::table('blog_categories')->where('slug', $slug)->first();

        if ($category) {
            return $category->id;
        }

        return DB::table('blog_categories')->insertGetId([
            'name' => $name,
            'slug' => $slug,
            'description' => null,
            'status' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function tagId(string $name, $now)
    {
        $slug = Str::slug($name);
        $tag = DB::table('tags')->where('slug', $slug)->first();

        if ($tag) {
            return $tag->id;
        }

        return DB::table('tags')->insertGetId([
            'name' => $name,
            'slug' => $slug,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function blogs(): array
    {
        return [
            'best-time-to-visit-europe' => [
                'title' => 'Best Time to Visit Europe: A Month-By-Month Guide',
                'category' => 'Travel Tips',
                'tags' => ['Travel Tips', 'Europe'],
                'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&auto=format&fit=crop',
                'published_at' => '2026-06-10 00:00:00',
                'excerpt' => 'Planning a trip to Europe but not sure when to go? We break down the best travel seasons for each major destination, from Paris in spring to Greece in summer.',
                'table_of_contents' => [
                    ['title' => 'Spring - Best for Sightseeing and Flowers', 'link' => '#spring-best-for-sightseeing-flowers'],
                    ['title' => 'Summer - High Season for Sun and Festivals', 'link' => '#summer-high-season-for-sun-and-festivals'],
                    ['title' => 'Autumn - Best for Wine and Golden Views', 'link' => '#autumn-best-for-wine-golden-views'],
                    ['title' => 'Winter - Best for Snow Sports and Christmas Markets', 'link' => '#winter-best-for-snow-sports-christmas-markets'],
                ],
                'content' => <<<'HTML'
<p>Planning a trip to Europe is an exciting adventure, but timing it right is crucial to matching your expectations. Whether you are looking for sun-drenched Mediterranean beaches, blooming spring gardens in the Netherlands, or fairy-tale winter markets in Munich, Europe has something spectacular to offer year-round.</p>

<h3 id="spring-best-for-sightseeing-flowers">Spring (March to May) - Best for Sightseeing and Flowers</h3>
<p>Spring is one of the most delightful times to visit Europe. As the winter chill fades, parks bloom, outdoor cafes reopen, and tourist numbers remain relatively low compared to summer.</p>
<ul>
    <li><strong>Highlights:</strong> Keukenhof Gardens in the Netherlands, cherry blossoms in Paris, and pleasant hiking weather in Spain.</li>
    <li><strong>Crowds and Cost:</strong> Moderate. You will find reasonable hotel rates and shorter queues at famous landmarks.</li>
</ul>

<h3 id="summer-high-season-for-sun-and-festivals">Summer (June to August) - High Season for Sun and Festivals</h3>
<p>Summer brings hot weather, long daylight hours, and vibrant outdoor festivals. It is peak travel season, especially for coastal regions and major cities.</p>
<ul>
    <li><strong>Highlights:</strong> Island hopping in Greece, beach holidays along the Amalfi Coast, and the Edinburgh Festival Fringe in Scotland.</li>
    <li><strong>Crowds and Cost:</strong> Very high. Make sure to book flights and hotels months in advance to avoid skyrocketing prices.</li>
</ul>

<h3 id="autumn-best-for-wine-golden-views">Autumn (September to November) - Best for Wine and Golden Views</h3>
<p>Autumn brings mild temperatures, fall foliage, and harvest celebrations. It is a fantastic shoulder season to experience authentic local cultures.</p>
<p>Destinations like Tuscany in Italy and Bordeaux in France host grape harvests and wine tastings. Major cities see a drop in tourist numbers, making museum visits far more pleasant.</p>

<h3 id="winter-best-for-snow-sports-christmas-markets">Winter (December to February) - Best for Snow Sports and Christmas Markets</h3>
<p>Winter is magical in Europe, particularly in December. European cities transform with sparkling lights and festive stalls selling gingerbread and mulled wine.</p>
<p>If you enjoy skiing, the Swiss and Austrian Alps offer world-class ski resorts. For budget travelers, January and February offer the lowest flight fares of the year.</p>
HTML,
            ],
            'ten-tricks-cheap-flights' => [
                'title' => '10 Proven Tricks to Find the Cheapest Flights',
                'category' => 'Flight Hacks',
                'tags' => ['Flight Hacks', 'Flights', 'Budget Travel'],
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1200&auto=format&fit=crop',
                'published_at' => '2026-05-28 00:00:00',
                'excerpt' => 'From booking on specific days of the week to using incognito mode and multi-city search, these expert tips will save you hundreds on your next trip.',
                'table_of_contents' => [
                    ['title' => 'Keep Your Searches Private', 'link' => '#keep-your-searches-private'],
                    ['title' => 'Be Flexible with Travel Dates', 'link' => '#be-flexible-with-travel-dates'],
                    ['title' => 'Use Google Flights and Compare Aggregators', 'link' => '#use-google-flights-and-compare-aggregators'],
                    ['title' => 'Consider Budget Airlines', 'link' => '#consider-budget-airlines'],
                    ['title' => 'Leverage Multi-City and Open-Jaw Routes', 'link' => '#leverage-multi-city-and-open-jaw-routes'],
                ],
                'content' => <<<'HTML'
<p>Airfare is often the largest expense of any trip. However, with the right strategies and a bit of flexibility, you can score incredible deals on flights. Here are 10 proven tricks from flight booking experts to help you fly for less.</p>

<h3 id="keep-your-searches-private">1. Keep Your Searches Private (Incognito Mode)</h3>
<p>Have you ever noticed that after searching a flight route multiple times, the price increases? Airlines use cookies to track search behavior and raise prices when they detect interest. Always search for flights in an incognito or private browsing window to view the lowest rates.</p>

<h3 id="be-flexible-with-travel-dates">2. Be Flexible with Travel Dates</h3>
<p>There is no magic day to book flights, but flying on certain days, usually Tuesdays, Wednesdays, and Saturdays, is typically cheaper than weekend travel. Use the whole month search feature on flight comparison tools to identify the cheapest departure dates.</p>

<h3 id="use-google-flights-and-compare-aggregators">3. Use Google Flights and Compare Aggregators</h3>
<p>Start your search on Google Flights to quickly filter routes and view price graphs, then check other aggregators like Skyscanner or Kayak to ensure you are getting the absolute best price available.</p>

<h3 id="consider-budget-airlines">4. Consider Budget Airlines (But Watch for Extra Fees)</h3>
<p>Low-cost carriers offer cheap base fares, but they often charge extra for carry-on luggage, seat selection, and boarding passes. Factor in these additional costs before booking.</p>

<h3 id="leverage-multi-city-and-open-jaw-routes">5. Leverage Multi-City and Open-Jaw Routes</h3>
<p>Instead of booking a simple round-trip, consider flying into one city and out of another. For example, fly into London, take a train to Paris, and fly home from Paris. This can often save you time and money.</p>
HTML,
            ],
            'dubai-travel-guide' => [
                'title' => 'Dubai Travel Guide: Everything You Need to Know',
                'category' => 'Destination Guide',
                'tags' => ['Destination Guide', 'Dubai', 'Travel Tips'],
                'image' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1200&auto=format&fit=crop',
                'published_at' => '2026-06-02 00:00:00',
                'excerpt' => 'Dubai is one of the world\'s most visited cities. Discover the best things to do, where to eat, and how to find the best flight deals to this stunning destination.',
                'table_of_contents' => [
                    ['title' => 'Best Time to Visit Dubai', 'link' => '#best-time-to-visit-dubai'],
                    ['title' => 'Top Attractions You Cannot Miss', 'link' => '#top-attractions-you-cannot-miss'],
                    ['title' => 'Culture and Travel Etiquette', 'link' => '#culture-and-travel-etiquette'],
                ],
                'content' => <<<'HTML'
<p>Dubai is a city of contrasts, where historic traditional markets, known as souks, stand alongside futuristic skyscrapers like the Burj Khalifa. Known for luxury shopping, ultramodern architecture, and a lively nightlife scene, Dubai offers an unforgettable travel experience.</p>

<h3 id="best-time-to-visit-dubai">Best Time to Visit Dubai</h3>
<p>The best time to visit Dubai is from November to April, during the winter months. The weather is warm and sunny, with temperatures hovering in the comfortable 25 C to 30 C range, perfect for beach trips, desert safaris, and sightseeing.</p>

<h3 id="top-attractions-you-cannot-miss">Top Attractions You Cannot Miss</h3>
<ul>
    <li><strong>Burj Khalifa:</strong> The world's tallest building offers panoramic views of the city from its observation deck.</li>
    <li><strong>The Dubai Mall:</strong> One of the world's largest shopping malls, complete with an aquarium, an ice rink, and the famous Dubai Fountain show.</li>
    <li><strong>Palm Jumeirah:</strong> The iconic man-made archipelago, home to high-end resorts like Atlantis The Palm.</li>
    <li><strong>Desert Safari:</strong> Ride camels, try dune bashing, and enjoy a traditional barbecue dinner under the desert stars.</li>
</ul>

<h3 id="culture-and-travel-etiquette">Culture and Travel Etiquette</h3>
<p>While Dubai is highly international and modern, it is part of an Islamic country. Visitors should respect local customs by dressing modestly in public places, especially malls and historical spots, and drinking alcohol only in licensed venues.</p>
HTML,
            ],
        ];
    }
};
