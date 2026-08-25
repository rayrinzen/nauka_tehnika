<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');
        $search = $request->input('search');

        $query = News::query();

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('short_description', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $news = $query->orderBy('id', 'desc')->get();
        $totalNews = News::count();
        $totalViews = News::sum('views');

        return view('news.index', compact('news', 'totalNews', 'totalViews', 'category', 'search'));
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        $newsItem->increment('views');

        return view('news.show', compact('newsItem'));
    }
}
