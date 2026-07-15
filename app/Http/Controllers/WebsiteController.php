<?php

namespace App\Http\Controllers;

use App\Models\AirlinePage;
use App\Models\BlogPost;
use App\Models\FlightCategory;
use App\Models\FlightRouteDestination;
use App\Models\Package;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        $blogCardsData = $this->publishedBlogPosts()
            ->limit(3)
            ->get()
            ->mapWithKeys(fn (BlogPost $post): array => [$post->slug => $this->blogCardData($post)])
            ->all();

        return view('website.index', [
            'blogCardsData' => $blogCardsData,
        ]);
    }

    public function flights(): View
    {
        return view('website.flights');
    }

    public function routes(?FlightCategory $category = null): View
    {
        return $this->flightCategoryPage($category, 'route');
    }

    public function routePage(FlightRouteDestination $flightRouteDestination): View
    {
        return $this->flightItemPage($flightRouteDestination, FlightRouteDestination::TYPE_ROUTE);
    }

    public function destinationPage(FlightRouteDestination $flightRouteDestination): View
    {
        return $this->flightItemPage($flightRouteDestination, FlightRouteDestination::TYPE_DESTINATION);
    }

    private function flightCategoryPage(?FlightCategory $category, string $pageType): View
    {
        $breadcrumbs = collect();
        $ancestor = $category;

        while ($ancestor) {
            $breadcrumbs->prepend($ancestor);
            $ancestor = $ancestor->parent;
        }

        return view('website.flight-routes', [
            'routeCategory' => $category,
            'routeBreadcrumbs' => $breadcrumbs,
            'flightPageType' => $pageType,
            'flightPageItem' => null,
        ]);
    }

    private function flightItemPage(FlightRouteDestination $item, string $type): View
    {
        abort_unless($item->type === $type && $item->is_published, 404);

        $category = $item->category;
        $breadcrumbs = collect();
        $ancestor = $category;

        while ($ancestor) {
            $breadcrumbs->prepend($ancestor);
            $ancestor = $ancestor->parent;
        }

        return view('website.flight-routes', [
            'routeCategory' => $category,
            'routeBreadcrumbs' => $breadcrumbs,
            'flightPageType' => $type,
            'flightPageItem' => $item,
        ]);
    }

    public function hotels(): View
    {
        return view('website.hotels');
    }

    public function airlines(): View
    {
        return view('website.airlines.index');
    }

    public function cars(): View
    {
        return view('website.cars');
    }

    public function packages(): View
    {
        return view('website.packages', [
            'packagesData' => Package::query()->where('status', true)
                ->orderBy('sort_order')->orderBy('title')->get()
                ->mapWithKeys(fn (Package $package) => [$package->slug => $package->websiteData()])->all(),
        ]);
    }

    public function packageDetails(Request $request, ?Package $package = null): View
    {
        $package ??= Package::query()->where('slug', $request->query('package'))->first();
        abort_unless($package && $package->status, 404);

        $allPackages = Package::query()->where('status', true)
            ->orderBy('sort_order')->orderBy('title')->get();

        return view('website.package-details', [
            'packageKey' => $package->slug,
            'pkg' => $package->websiteData(),
            'packagesData' => $allPackages->mapWithKeys(
                fn (Package $item) => [$item->slug => $item->websiteData()]
            )->all(),
            'packageModel' => $package,
        ]);
    }

    public function airline(Request $request, ?string $airline = null, ?string $section = null): View
    {
        try {
            $databaseAirlinePages = AirlinePage::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        } catch (QueryException) {
            $databaseAirlinePages = collect();
        }

        return view('website.airlines.airline', [
            'databaseAirlinePages' => $databaseAirlinePages,
            'requestedAirlineKey' => $airline ?: $request->query('airline'),
            'requestedSectionKey' => $section ?: $request->query('section'),
            'sectionLabels' => AirlinePage::SECTION_LABELS,
        ]);
    }

    public function about(): View
    {
        return view('website.about');
    }

    public function blog(Request $request): View
    {
        $selectedTag = $request->query('tag');

        $posts = $this->publishedBlogPosts()
            ->when($selectedTag, fn ($query) => $query->whereHas(
                'tags',
                fn ($tagQuery) => $tagQuery->where('slug', $selectedTag)
            ))
            ->get();

        $blogCardsData = $posts
            ->mapWithKeys(fn (BlogPost $post): array => [$post->slug => $this->blogCardData($post)])
            ->all();
        $selectedTagLabel = $selectedTag
            ? $posts
                ->flatMap(fn (BlogPost $post) => $post->tags)
                ->firstWhere('slug', $selectedTag)?->name
            : null;

        return view('website.blog', [
            'blogCardsData' => $blogCardsData,
            'selectedTag' => $selectedTag,
            'selectedTagLabel' => $selectedTagLabel,
        ]);
    }

    public function blogDetails(?string $slug = null): View
    {
        $postKey = $slug ?: request('post');
        $postQuery = $this->publishedBlogPosts();
        $databasePost = $postKey
            ? (clone $postQuery)->where('slug', $postKey)->first()
            : $postQuery->first();

        abort_if($postKey && ! $databasePost, 404);
        abort_unless($databasePost, 404);

        $recentPosts = $this->publishedBlogPosts()
            ->where('id', '!=', $databasePost->id)
            ->limit(4)
            ->get()
            ->mapWithKeys(fn (BlogPost $post): array => [$post->slug => $this->blogCardData($post)])
            ->all();

        return view('website.blog-details', [
            'postKey' => $databasePost->slug,
            'blog' => $this->blogDetailData($databasePost),
            'recentPosts' => $recentPosts,
        ]);
    }

    public function contact(): View
    {
        return view('website.contact');
    }

    public function privacyPolicy(): View
    {
        return view('website.privacy-policy');
    }

    public function terms(): View
    {
        return view('website.terms');
    }

    private function publishedBlogPosts()
    {
        return BlogPost::query()
            ->with(['author', 'category', 'tags'])
            ->where('status', true)
            ->latest('published_at')
            ->latest();
    }

    private function blogCardData(BlogPost $post): array
    {
        $tags = $post->tags
            ->map(fn ($tag): array => ['name' => $tag->name, 'slug' => $tag->slug])
            ->all();

        return [
            'title' => $post->title,
            'tag' => $post->category?->name ?? ($tags[0]['name'] ?? 'Travel'),
            'image' => $this->blogImageUrl($post->featured_image),
            'imageAlt' => $post->featured_image_alt ?: $post->title,
            'author' => $post->author?->name ?? 'Fares Junction',
            'date' => optional($post->published_at ?? $post->created_at)->format('F j, Y'),
            'readTime' => $this->readTime($post->content),
            'excerpt' => $post->excerpt ?: str($post->content)->stripTags()->limit(160)->toString(),
            'tags' => $tags,
        ];
    }

    private function blogDetailData(BlogPost $post): array
    {
        return $this->blogCardData($post) + [
            'content' => $post->content,
            'tableOfContents' => $post->table_of_contents ?? [],
        ];
    }

    private function blogImageUrl(?string $image): string
    {
        if (! $image) {
            return asset('dashboardAssets/img/news-1.jpg');
        }

        return Str::startsWith($image, ['http://', 'https://', '/'])
            ? $image
            : asset('storage/' . $image);
    }

    private function readTime(string $content): string
    {
        $minutes = max(1, (int) ceil(str_word_count(strip_tags($content)) / 200));

        return $minutes . ' min read';
    }
}
