@extends('layouts.app')

@section('title', 'Новини науки та техніки')

@section('content')
<section class="hero">
    <div class="container hero-inner">
        <div>
            <h1>Новини науки та техніки</h1>
            <p>Актуальні матеріали про технології, космос, штучний інтелект та наукові відкриття.</p>

            <form class="search-box" method="GET" action="{{ route('home') }}">
                @if(!empty($category))
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Пошук новин..."
                >
                <button type="submit">Шукати</button>
            </form>
        </div>

        <div class="stats-card">
            <h3>Статистика сайту</h3>
            <p><strong>{{ $totalNews ?? 0 }}</strong> новин у базі</p>
            <p><strong>{{ $totalViews ?? 0 }}</strong> переглядів</p>
        </div>
    </div>
</section>

<main class="container">
    <section class="categories">
        <a href="{{ route('home') }}" class="{{ empty($category) ? 'active' : '' }}">Усі</a>
        <a href="{{ route('home', ['category' => 'Наука']) }}" class="{{ $category === 'Наука' ? 'active' : '' }}">Наука</a>
        <a href="{{ route('home', ['category' => 'Техніка']) }}" class="{{ $category === 'Техніка' ? 'active' : '' }}">Техніка</a>
        <a href="{{ route('home', ['category' => 'Космос']) }}" class="{{ $category === 'Космос' ? 'active' : '' }}">Космос</a>
        <a href="{{ route('home', ['category' => 'IT']) }}" class="{{ $category === 'IT' ? 'active' : '' }}">IT</a>
    </section>

    <section class="news-grid">
        @forelse ($news as $item)
            <article class="news-card">
                <span class="category">{{ $item->category }}</span>
                <h3>{{ $item->title }}</h3>
                <p>{{ $item->short_description }}</p>
                <div class="card-meta">
                    <small>{{ $item->publish_date }}</small>
                    <small>👁 {{ $item->views }}</small>
                </div>
                <a href="{{ route('news.show', $item->id) }}">Читати далі</a>
            </article>
        @empty
            <p class="empty">Новини не знайдено.</p>
        @endforelse
    </section>
</main>
@endsection
