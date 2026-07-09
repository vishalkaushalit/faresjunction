<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SeoMetaTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SeoMetaController extends Controller
{
    private const STATIC_PAGES = [
        'index' => 'Home',
        'flights' => 'Flights',
        'hotels' => 'Hotels',
        'cars' => 'Cars',
        'packages' => 'Packages',
        'package-details' => 'Package Details',
        'about' => 'About',
        'blog' => 'Blog Listing',
        'contact' => 'Contact',
        'privacy-policy' => 'Privacy Policy',
        'terms' => 'Terms',
    ];

    public function index(): View
    {
        $pageMetas = SeoMetaTag::where('page_type', 'page')->get()->keyBy('page_key');
        $blogMetas = SeoMetaTag::where('page_type', 'blog')->get()->keyBy('page_key');

        $pages = collect(self::STATIC_PAGES)->map(function (string $name, string $key) use ($pageMetas) {
            return [
                'type' => 'page',
                'key' => $key,
                'name' => $name,
                'meta' => $pageMetas->get($key),
            ];
        })->merge(
            $pageMetas
                ->reject(fn (SeoMetaTag $meta) => array_key_exists($meta->page_key, self::STATIC_PAGES))
                ->map(fn (SeoMetaTag $meta) => [
                    'type' => 'page',
                    'key' => $meta->page_key,
                    'name' => $meta->page_name ?: $meta->page_key,
                    'meta' => $meta,
                ])
                ->values()
        );

        $blogOptions = $this->blogOptions();

        $blogs = collect($blogOptions)->map(function (string $name, string $key) use ($blogMetas) {
            return [
                'type' => 'blog',
                'key' => $key,
                'name' => $name,
                'meta' => $blogMetas->get($key),
            ];
        })->merge(
            $blogMetas
                ->reject(fn (SeoMetaTag $meta) => array_key_exists($meta->page_key, $blogOptions))
                ->map(fn (SeoMetaTag $meta) => [
                    'type' => 'blog',
                    'key' => $meta->page_key,
                    'name' => $meta->page_name ?: $meta->page_key,
                    'meta' => $meta,
                ])
                ->values()
        );

        return view('seo-meta.index', compact('pages', 'blogs'));
    }

    public function create(): View
    {
        return view('seo-meta.add');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedMetaData($request, [
            'page_type' => ['required', Rule::in(['page', 'blog'])],
            'page_key' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('seo_meta_tags')->where(fn ($query) => $query->where('page_type', $request->page_type)),
            ],
            'page_name' => ['required', 'string', 'max:255'],
        ]);

        SeoMetaTag::create(array_merge($validated, [
            'status' => $request->boolean('status'),
        ]));

        return redirect()->route('seo-meta.index')->with('success', 'SEO meta added successfully.');
    }

    public function edit(string $type, string $key): View
    {
        $name = $this->resolveName($type, $key);

        abort_if($name === null, 404);

        $seoMeta = SeoMetaTag::firstOrNew([
            'page_type' => $type,
            'page_key' => $key,
        ]);

        $seoMeta->page_name = $seoMeta->page_name ?: $name;

        return view('seo-meta.edit', compact('seoMeta', 'type', 'key', 'name'));
    }

    public function update(Request $request, string $type, string $key): RedirectResponse
    {
        $name = $this->resolveName($type, $key);

        abort_if($name === null, 404);

        $validated = $this->validatedMetaData($request, [
            'type' => ['required', Rule::in(['page', 'blog'])],
        ], ['type' => $type]);

        unset($validated['type']);

        SeoMetaTag::updateOrCreate(
            [
                'page_type' => $type,
                'page_key' => $key,
            ],
            array_merge($validated, [
                'page_name' => $name,
                'status' => $request->boolean('status'),
            ])
        );

        return redirect()->route('seo-meta.index')->with('success', 'Meta tags updated successfully.');
    }

    public function destroy(string $type, string $key): RedirectResponse
    {
        $deleted = SeoMetaTag::where('page_type', $type)
            ->where('page_key', $key)
            ->delete();

        if (!$deleted) {
            return redirect()->route('seo-meta.index')->with('error', 'SEO meta not found.');
        }

        return redirect()->route('seo-meta.index')->with('success', 'SEO meta deleted successfully.');
    }

    private function resolveName(string $type, string $key): ?string
    {
        $existingMeta = SeoMetaTag::where('page_type', $type)->where('page_key', $key)->first();

        if ($existingMeta) {
            return $existingMeta->page_name ?: $key;
        }

        if ($type === 'page') {
            return self::STATIC_PAGES[$key] ?? null;
        }

        if ($type === 'blog') {
            return $this->blogOptions()[$key] ?? null;
        }

        return null;
    }

    private function blogOptions(): array
    {
        return BlogPost::query()
            ->orderBy('title')
            ->pluck('title', 'slug')
            ->all();
    }

    private function validatedMetaData(Request $request, array $extraRules = [], array $extraData = []): array
    {
        return Validator::make(
            array_merge($request->all(), $extraData),
            array_merge($extraRules, [
                'meta_title' => ['nullable', 'string', 'max:255'],
                'meta_description' => ['nullable', 'string', 'max:1000'],
                'meta_keywords' => ['nullable', 'string', 'max:1000'],
                'canonical_url' => ['nullable', 'url', 'max:255'],
                'og_title' => ['nullable', 'string', 'max:255'],
                'og_description' => ['nullable', 'string', 'max:1000'],
                'og_image' => ['nullable', 'string', 'max:255'],
                'status' => ['nullable', 'boolean'],
            ])
        )->validate();
    }
}
