<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function websiteNewsFunc(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search', '');
        
        $newsQuery = News::published()
                    ->byCategory($category)
                    ->search($search)
                    ->orderBy('is_featured', 'desc') // Сначала featured
                    ->orderBy('published_at', 'desc')
                    ->orderBy('created_at', 'desc');
        
        $news = $newsQuery->paginate(50);
        
        // Остальной код остается без изменений...
        $featuredNews = News::published()
                        ->featured()
                        ->orderBy('published_at', 'desc')
                        ->take(1)
                        ->get();
        
        $PublicFunc = Application::where('userid', Auth::id())->get();
        
        return view("websiteNews", compact("news", "featuredNews", "category", "search", "PublicFunc"));
    }
    public function hellowFunc(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search', '');
        
        $newsQuery = News::published()
                    ->byCategory($category)
                    ->search($search)
                    ->orderBy('is_featured', 'desc') // Сначала featured
                    ->orderBy('published_at', 'desc')
                    ->orderBy('created_at', 'desc');
        
        $news = $newsQuery->paginate(50);
        
        // Остальной код остается без изменений...
        $featuredNews = News::published()
                        ->featured()
                        ->orderBy('published_at', 'desc')
                        ->take(1)
                        ->get();
        
        $PublicFunc = Application::where('userid', Auth::id())->get();
        
        return view("hellow", compact("news", "featuredNews", "category", "search", "PublicFunc"));
    }

    public function show($slug)
    {
        $news = News::published()->where('slug', $slug)->firstOrFail();
        
        // Увеличиваем счетчик просмотров
        $news->increment('views_count');
        
        $PublicFunc = Application::where('userid', Auth::id())->get();
        
        // Получаем связанные новости (например, из той же категории)
        $relatedNews = News::published()
                          ->where('category', $news->category)
                          ->where('id', '!=', $news->id)
                          ->orderBy('published_at', 'desc')
                          ->take(3)
                          ->get();
        
        // Данные для SEO и структуры страницы
        $pageTitle = $news->title;
        $pageDescription = $news->excerpt;
        $breadcrumbs = [
            ['name' => 'Главная', 'url' => '/'],
            ['name' => 'Новости', 'url' => route('websiteNews')],
            ['name' => $news->title, 'url' => route('news.show', $news->slug)]
        ];
        
        return view("news-single", compact(
            "news", 
            "PublicFunc", 
            "relatedNews",
            "pageTitle",
            "pageDescription",
            "breadcrumbs"
        ));
    }

    public function create()
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'У вас нет прав для создания новостей');
        }
        
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $pageTitle = "Создание новости";
        
        return view('newsTwo.create', compact('PublicFunc', 'pageTitle'));
    }

    public function store(Request $request)
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'У вас нет прав для создания новостей');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|in:Дизайн,Разработка,Маркетинг,События,Общее',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        // Генерируем уникальный slug
        $slug = \Illuminate\Support\Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        
        // Проверяем, существует ли уже такой slug
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $publishedAt = $request->filled('published_at') ? $request->published_at : null;
        if ($publishedAt === null) {
            $publishedAt = now();
        }

        $news = News::create([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image_path' => $imagePath,
            'category' => $request->category,
            'is_featured' => $request->boolean('is_featured'),
            'author_id' => Auth::id(),
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('websiteNews')->with('success', 'Новость успешно создана!');
    }

    public function edit(News $news)
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'У вас нет прав для редактирования новостей');
        }

        $PublicFunc = Application::where('userid', Auth::id())->get();
        $pageTitle = "Редактирование новости";
        
        return view('newsTwo.edit', compact('news', 'PublicFunc', 'pageTitle'));
    }

    public function update(Request $request, News $news)
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'У вас нет прав для редактирования новостей');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|in:Дизайн,Разработка,Маркетинг,События,Общее',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Генерируем новый slug только если заголовок изменился
        $slug = $news->slug;
        if ($request->title !== $news->title) {
            $slug = \Illuminate\Support\Str::slug($request->title);
            $originalSlug = $slug;
            $counter = 1;
            
            // Проверяем, существует ли уже такой slug (кроме текущей новости)
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                try {
                    Storage::disk('public')->delete($news->image_path);
                } catch (\Throwable $e) {
                    // файл мог отсутствовать (например после перезапуска на Render)
                }
            }
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $publishedAt = $request->filled('published_at') ? $request->published_at : null;

        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category' => $request->category,
            'is_featured' => $request->boolean('is_featured'),
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('websiteNews')->with('success', 'Новость успешно обновлена!');
    }

    public function destroy(News $news)
    {
        if (!Auth::user() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'У вас нет прав для удаления новостей');
        }

        if ($news->image_path) {
            try {
                Storage::disk('public')->delete($news->image_path);
            } catch (\Throwable $e) {
                // не ломаем удаление новости, если файла нет
            }
        }

        $news->delete();

        return redirect()->route('websiteNews')->with('success', 'Новость успешно удалена!');
    }
}