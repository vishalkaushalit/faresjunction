<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function index(): View
    {
        return view('website.index');
    }

    public function flights(): View
    {
        return view('website.flights');
    }

    public function hotels(): View
    {
        return view('website.hotels');
    }

    public function cars(): View
    {
        return view('website.cars');
    }

    public function packages(): View
    {
        return view('website.packages');
    }

    public function packageDetails(): View
    {
        return view('website.package-details');
    }

    public function about(): View
    {
        return view('website.about');
    }

    public function blog(Request $request): View
    {
        $selectedTag = $request->query('tag');
        $databasePosts = BlogPost::query()
            ->with(['author', 'category', 'tags'])
            ->where('status', true)
            ->when($selectedTag, fn ($query) => $query->whereHas(
                'tags',
                fn ($tagQuery) => $tagQuery->where('slug', $selectedTag)
            ))
            ->latest('published_at')
            ->latest()
            ->get();

        return view('website.blog', [
            'databasePosts' => $databasePosts,
            'selectedTag' => $selectedTag,
        ]);
    }

    public function blogDetails(?string $slug = null): View
    {
        $postKey = $slug ?: request('post');
        $databasePost = $postKey
            ? BlogPost::query()
                ->with(['author', 'category', 'tags'])
                ->where('slug', $postKey)
                ->where('status', true)
                ->first()
            : null;

        return view('website.blog-details', [
            'postKey' => $postKey,
            'databasePost' => $databasePost,
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
}
