@extends('layouts.app')

@section('title', $news->title)

@section('content')
<main class="container" style="max-width: 800px; margin-top: 2rem; margin-bottom: 3rem;">
    <a href="{{ route('home') }}" style="display: inline-block; margin-bottom: 1rem; color: #3b82f6; text-decoration: none;">&larr; Назад до списку новин</a>

    <article class="single-news">
        <span class="category" style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 4px; font-weight: 600;">{{ $news->category }}</span>
        <h1 style="margin-top: 1rem; font-size: 2rem;">{{ $news->title }}</h1>

        <div class="card-meta" style="color: #64748b; margin: 1rem 0; font-size: 0.9rem;">
            <span>Дата публікації: <strong>{{ $news->publish_date }}</strong></span> |
            <span>Переглядів: <strong>👁 {{ $news->views }}</strong></span>
        </div>

        <p style="font-size: 1.1rem; font-weight: 500; color: #334155; line-height: 1.6; margin-bottom: 1.5rem;">
            {{ $news->short_description }}
        </p>

        <div class="news-content" style="line-height: 1.8; color: #1e293b; font-size: 1rem;">
            {!! nl2br(e($news->content)) !!}
        </div>
    </article>
</main>
@endsection
