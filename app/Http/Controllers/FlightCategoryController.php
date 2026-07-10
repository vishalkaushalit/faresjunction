<?php

namespace App\Http\Controllers;

use App\Models\FlightCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FlightCategoryController extends Controller
{
    public function index(): View
    {
        $flightCategories = FlightCategory::query()
            ->with('parent')
            ->latest()
            ->paginate(10);

        return view('flight-categories.index', compact('flightCategories'));
    }

    public function create(): View
    {
        return view('flight-categories.create', [
            'flightCategory' => null,
            'parentCategories' => $this->parentCategories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedCategoryData($request);

        if ($request->hasFile('category_image')) {
            $validated['image_original_name'] = $request->file('category_image')->getClientOriginalName();
            $validated['image_path'] = $this->storeCategoryImage($request);
        }

        FlightCategory::create($validated);

        return redirect()->route('flight-categories.index')->with('success', 'Flight category added successfully.');
    }

    public function show(FlightCategory $flightCategory): View
    {
        $flightCategory->load('parent', 'children');

        return view('flight-categories.show', compact('flightCategory'));
    }

    public function edit(FlightCategory $flightCategory): View
    {
        return view('flight-categories.edit', [
            'flightCategory' => $flightCategory,
            'parentCategories' => $this->parentCategories($flightCategory),
        ]);
    }

    public function update(Request $request, FlightCategory $flightCategory): RedirectResponse
    {
        $validated = $this->validatedCategoryData($request, $flightCategory);

        if ($request->hasFile('category_image')) {
            $this->deleteFile($flightCategory->image_path);
            $validated['image_original_name'] = $request->file('category_image')->getClientOriginalName();
            $validated['image_path'] = $this->storeCategoryImage($request);
        }

        $flightCategory->update($validated);

        return redirect()->route('flight-categories.index')->with('success', 'Flight category updated successfully.');
    }

    public function destroy(FlightCategory $flightCategory): RedirectResponse
    {
        $this->deleteFile($flightCategory->image_path);
        $flightCategory->delete();

        return redirect()->route('flight-categories.index')->with('success', 'Flight category deleted successfully.');
    }

    private function validatedCategoryData(Request $request, ?FlightCategory $flightCategory = null): array
    {
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        $request->merge([
            'slug' => $slug,
            'parent_id' => $request->input('parent_id') ?: null,
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('flight_categories', 'slug')->ignore($flightCategory),
            ],
            'parent_id' => ['nullable', 'integer', Rule::exists('flight_categories', 'id')],
            'category_image' => [$flightCategory ? 'nullable' : 'required', 'image', 'max:2048'],
        ]);

        if ($flightCategory && (int) ($validated['parent_id'] ?? 0) === $flightCategory->id) {
            throw ValidationException::withMessages([
                'parent_id' => 'A category cannot be its own parent.',
            ]);
        }

        if ($flightCategory && $this->isDescendantParent($flightCategory, $validated['parent_id'] ?? null)) {
            throw ValidationException::withMessages([
                'parent_id' => 'A child category cannot be selected as the parent.',
            ]);
        }

        unset($validated['category_image']);

        return $validated;
    }

    private function parentCategories(?FlightCategory $flightCategory = null)
    {
        $query = FlightCategory::query()->orderBy('name');

        if ($flightCategory) {
            $excludedIds = [$flightCategory->id, ...$this->descendantIds($flightCategory)];
            $query->whereNotIn('id', array_unique($excludedIds));
        }

        return $query->get();
    }

    private function isDescendantParent(FlightCategory $flightCategory, ?int $parentId): bool
    {
        if (! $parentId) {
            return false;
        }

        $descendantIds = $flightCategory->children()
            ->with('children')
            ->get()
            ->flatMap(fn (FlightCategory $child) => $this->descendantIds($child))
            ->all();

        return in_array($parentId, $descendantIds, true);
    }

    private function descendantIds(FlightCategory $flightCategory): array
    {
        return [$flightCategory->id, ...$flightCategory->children->flatMap(
            fn (FlightCategory $child) => $this->descendantIds($child)
        )->all()];
    }

    private function storeCategoryImage(Request $request): string
    {
        $file = $request->file('category_image');

        return $this->storeWithUniqueName($file, 'flight-categories');
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, ['http://', 'https://', '/'])) {
            Storage::disk('public')->delete($path);
        }
    }
}
