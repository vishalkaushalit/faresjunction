<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogTagController extends Controller
{
    public function index(Request $request): View
    {
        $tags = Tag::query()
            ->withCount([
                'blogPosts as posts_count' => fn ($query) => $query
                    ->when(
                        ! $request->user()->isAdmin(),
                        fn ($query) => $query->where('author_id', $request->user()->id)
                    ),
            ])
            ->when(
                ! $request->user()->isAdmin(),
                fn ($query) => $query->whereHas(
                    'blogPosts',
                    fn ($query) => $query->where('author_id', $request->user()->id)
                )
            )
            ->orderBy('name')
            ->paginate(10);

        return view('blog-tags.index', compact('tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('tags', 'slug'),
            ],
        ]);

        Tag::create($validated);

        return redirect()->route('blog-tags.index')->with('success', 'Blog tag added successfully.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('blog-tags.index')->with('success', 'Blog tag deleted successfully.');
    }
}
