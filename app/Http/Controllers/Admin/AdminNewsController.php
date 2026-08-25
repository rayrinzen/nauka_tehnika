<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('publish_date', 'desc')->get();
        return view('admin.index', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'publish_date' => 'required|date',
        ]);

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Новину успішно опубліковано!');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Новину успішно видалено!');
    }
}
