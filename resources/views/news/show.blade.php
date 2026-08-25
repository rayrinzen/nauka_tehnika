@extends('layouts.app')

@php
    $item = $newsItem ?? $news;
@endphp

@section('title', $item->title ?? 'Перегляд новини')

@section('content')
<main class="container" style="max-width: 850px; margin: 40px auto; padding: 0 15px;">
    <article class="news-single" style="background: var(--card-bg, #fff); padding: 30px; border-radius: 8px; border: 1px solid #e1e4e8;">
        <div style="margin-bottom: 20px;">
            <a href="{{ route('home') }}" style="text-decoration: none; color: #007bff; font-weight: 500;">← Повернутися до всіх новин</a>
        </div>

        <span class="category" style="display: inline-block; font-size: 13px; font-weight: bold; color: #007bff; text-transform: uppercase; margin-bottom: 10px;">
            {{ $item->category }}
        </span>

        <h1 style="font-size: 28px; margin: 0 0 15px 0; color: #222; line-height: 1.3;">
            {{ $item->title }}
        </h1>

        <div class="card-meta" style="display: flex; gap: 20px; font-size: 13px; color: #888; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <span>📅 {{ $item->publish_date }}</span>
            <span>👁 {{ $item->views }} переглядів</span>
        </div>

        @if(!empty($item->short_description))
            <p style="font-size: 16px; font-weight: 600; color: #444; line-height: 1.6; margin-bottom: 20px;">
                {{ $item->short_description }}
            </p>
        @endif

        <div class="news-content" style="font-size: 16px; line-height: 1.8; color: #333; white-space: pre-line;">
            {{ $item->content }}
        </div>
    </article>
</main>
@endsection
