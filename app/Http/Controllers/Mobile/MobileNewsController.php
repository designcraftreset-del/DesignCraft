<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileNewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search', '');

        $newsQuery = News::published()
            ->byCategory($category)
            ->search($search)
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc');

        $news = $newsQuery->paginate(20);
        $featuredNews = News::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(1)
            ->get();
        $PublicFunc = Application::where('userid', Auth::id())->get();

        return view('mobile.pages.news', compact('news', 'featuredNews', 'category', 'search', 'PublicFunc'));
    }

    public function show(string $slug)
    {
        $news = News::published()->where('slug', $slug)->firstOrFail();
        $news->increment('views_count');

        $PublicFunc = Application::where('userid', auth()->id())->get();
        $relatedNews = News::published()
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('mobile.pages.news-single', compact('news', 'PublicFunc', 'relatedNews'));
    }
}
