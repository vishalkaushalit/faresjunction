<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::query()
            ->latest()
            ->paginate(10);

        return view('blog-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('blog-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedCategoryData($request);

        BlogCategory::create($validated);

        return redirect()->route('blog-categories.index')->with('success', 'Blog category added successfully.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory): RedirectResponse
    {
        $validated = $this->validatedCategoryData($request, $blogCategory);

        $blogCategory->update($validated);

        return redirect()->route('blog-categories.index')->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return redirect()->route('blog-categories.index')->with('success', 'Blog category deleted successfully.');
    }

    private function validatedCategoryData(Request $request, ?BlogCategory $blogCategory = null): array
    {
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        $request->merge(['slug' => $slug]);

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('blog_categories', 'slug')->ignore($blogCategory),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', 'boolean'],
        ]) + [
            'status' => $request->boolean('status'),
        ];
    }
}
