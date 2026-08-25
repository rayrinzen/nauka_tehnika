<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', '');
        $search = $request->query('search', '');

        $query = News::query();

        if (!empty($category) && $category !== 'all') {
            $query->where('category', $category);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->orderBy('publish_date', 'desc')->get();
        $totalNews = News::count();
        $totalViews = News::sum('views') ?: 0;

        return view('news.index', compact('news', 'category', 'search', 'totalNews', 'totalViews'));
    }

    public function show(News $news)
    {
        $news->increment('views');
        return view('news.show', compact('news'));
    }

    // Для живого поиска через AJAX (заменяет старый api/search.php)
    public function liveSearch(Request $request)
    {
        $query = $request->get('q', '');
        $news = News::where('title', 'like', "%{$query}%")
                    ->orWhere('short_description', 'like', "%{$query}%")
                    ->orderBy('publish_date', 'desc')
                    ->get();

        return response()->json($news);
    }
}
