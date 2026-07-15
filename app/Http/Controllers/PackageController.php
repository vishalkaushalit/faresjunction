<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends Controller
{
    private const LIST_FIELDS = ['highlights', 'inclusions', 'exclusions', 'notes'];
    private const STRUCTURED_FIELDS = ['itinerary', 'hotels', 'activities', 'pricing', 'reviews'];

    public function index(): View
    {
        return view('packages.index', [
            'packages' => Package::query()->orderBy('sort_order')->orderBy('title')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('packages.create', [
            'package' => null,
            'availablePackages' => $this->availableRelatedPackages(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $validated['gallery'] = $this->storeGalleryImages($request);
        Package::create($validated);

        return redirect()->route('admin-packages.index')->with('success', 'Package added successfully.');
    }

    public function edit(Package $adminPackage): View
    {
        return view('packages.edit', [
            'package' => $adminPackage,
            'availablePackages' => $this->availableRelatedPackages($adminPackage),
        ]);
    }

    public function update(Request $request, Package $adminPackage): RedirectResponse
    {
        $validated = $this->validatedData($request, $adminPackage);
        $existingGallery = array_values(array_intersect(
            $adminPackage->gallery ?? [],
            $request->input('existing_gallery', [])
        ));

        foreach (array_diff($adminPackage->gallery ?? [], $existingGallery) as $removedImage) {
            $this->deleteGalleryFile($removedImage);
        }

        $validated['gallery'] = [...$existingGallery, ...$this->storeGalleryImages($request)];
        $adminPackage->update($validated);

        return redirect()->route('admin-packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $adminPackage): RedirectResponse
    {
        foreach ($adminPackage->gallery ?? [] as $image) {
            $this->deleteGalleryFile($image);
        }
        foreach (collect($adminPackage->activities ?? [])->pluck('image')->filter() as $image) {
            $this->deleteActivityFile($image);
        }

        $adminPackage->delete();

        return redirect()->route('admin-packages.index')->with('success', 'Package deleted successfully.');
    }

    public function deleteGalleryImage(Request $request, Package $adminPackage): JsonResponse
    {
        $validated = $request->validate(['image' => ['required', 'string']]);
        $gallery = $adminPackage->gallery ?? [];

        abort_unless(in_array($validated['image'], $gallery, true), 404);

        $this->deleteGalleryFile($validated['image']);
        $adminPackage->update([
            'gallery' => array_values(array_filter(
                $gallery,
                fn (string $image): bool => $image !== $validated['image']
            )),
        ]);

        return response()->json(['message' => 'Gallery image deleted successfully.']);
    }

    private function validatedData(Request $request, ?Package $package = null): array
    {
        $request->merge(['slug' => Str::slug($request->input('slug') ?: $request->input('title'))]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'max:255', Rule::unique('packages', 'slug')->ignore($package)],
            'nights_detail' => ['required', 'string', 'max:500'],
            'duration' => ['required', 'string', 'max:100'],
            'price' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'stars' => ['required', 'integer', 'between:1,5'],
            'hero_image' => ['required', 'string', 'max:2048'],
            'overview' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'existing_gallery' => ['nullable', 'array'],
            'existing_gallery.*' => ['string', 'max:2048'],
            'gallery_images' => ['nullable', 'array', 'max:20'],
            'gallery_images.*' => ['image', 'max:5120'],
            'related_slugs' => ['nullable', 'array'],
            'related_slugs.*' => [
                'string',
                'distinct',
                Rule::exists('packages', 'slug')->where(
                    fn ($query) => $package ? $query->where('id', '!=', $package->id) : $query
                ),
            ],
            ...collect(self::LIST_FIELDS)->flatMap(fn ($field) => [
                $field => ['nullable', 'array'],
                $field.'.*' => ['nullable', 'string', 'max:2000'],
            ])->all(),
            'itinerary' => ['nullable', 'array'],
            'itinerary.*.day' => ['nullable', 'integer', 'min:1'],
            'itinerary.*.title' => ['nullable', 'string', 'max:255'],
            'itinerary.*.description' => ['nullable', 'string'],
            'hotels' => ['nullable', 'array'],
            'hotels.*.city' => ['nullable', 'string', 'max:255'],
            'hotels.*.name' => ['nullable', 'string', 'max:255'],
            'hotels.*.rating' => ['nullable', 'integer', 'between:1,5'],
            'hotels.*.desc' => ['nullable', 'string'],
            'activities' => ['nullable', 'array'],
            'activities.*.name' => ['nullable', 'string', 'max:255'],
            'activities.*.current_image' => ['nullable', 'string', 'max:2048'],
            'activities.*.image_file' => ['nullable', 'image', 'max:5120'],
            'activities.*.desc' => ['nullable', 'string'],
            'pricing' => ['nullable', 'array'],
            'pricing.*.tier' => ['nullable', 'string', 'max:255'],
            'pricing.*.hotelType' => ['nullable', 'string', 'max:255'],
            'pricing.*.price' => ['nullable', 'string', 'max:100'],
            'pricing.*.description' => ['nullable', 'string'],
            'reviews' => ['nullable', 'array'],
            'reviews.*.name' => ['nullable', 'string', 'max:255'],
            'reviews.*.date' => ['nullable', 'string', 'max:100'],
            'reviews.*.rating' => ['nullable', 'integer', 'between:1,5'],
            'reviews.*.text' => ['nullable', 'string'],
        ]);

        foreach (self::LIST_FIELDS as $field) {
            $validated[$field] = collect($validated[$field] ?? [])
                ->map(fn ($value): string => trim((string) $value))
                ->filter()
                ->values()
                ->all();
        }

        $validated['activities'] = collect($validated['activities'] ?? [])
            ->map(function (array $activity, int $index) use ($request): array {
                $uploadedImage = $request->file("activities.{$index}.image_file");

                return [
                    'name' => trim($activity['name'] ?? ''),
                    'image' => $uploadedImage
                        ? $this->storeWithUniqueName($uploadedImage, 'packages/activities')
                        : ($activity['current_image'] ?? ''),
                    'desc' => trim($activity['desc'] ?? ''),
                ];
            })
            ->all();

        foreach (self::STRUCTURED_FIELDS as $field) {
            $validated[$field] = collect($validated[$field] ?? [])
                ->map(fn (array $row): array => collect($row)
                    ->map(fn ($value) => is_string($value) ? trim($value) : $value)
                    ->all())
                ->filter(fn (array $row): bool => collect($row)->contains(
                    fn ($value): bool => $value !== null && $value !== ''
                ))
                ->values()
                ->all();
        }

        if ($package) {
            $retainedActivityImages = collect($validated['activities'])->pluck('image')->filter()->all();
            foreach (collect($package->activities ?? [])->pluck('image')->filter()->diff($retainedActivityImages) as $removedImage) {
                $this->deleteActivityFile($removedImage);
            }
        }

        $validated['status'] = $request->boolean('status');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['related_slugs'] = array_values($validated['related_slugs'] ?? []);
        unset($validated['existing_gallery'], $validated['gallery_images']);

        return $validated;
    }

    private function storeGalleryImages(Request $request): array
    {
        return collect($request->file('gallery_images', []))
            ->map(fn ($image): string => $this->storeWithUniqueName($image, 'packages/gallery'))
            ->all();
    }

    private function deleteGalleryFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, ['http://', 'https://', '/'])) {
            Storage::disk('public')->delete($path);
        }
    }

    private function deleteActivityFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, ['http://', 'https://', '/'])) {
            Storage::disk('public')->delete($path);
        }
    }

    private function availableRelatedPackages(?Package $package = null)
    {
        return Package::query()
            ->when($package, fn ($query) => $query->whereKeyNot($package->getKey()))
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'status']);
    }
}
