@extends('layouts.app')

@section('title', 'Панель адміністратора')

@section('content')
<main class="container" style="margin-top: 2rem; margin-bottom: 3rem;">
    <h2>Панель керування новинами</h2>

    @if (session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 0.75rem; border-radius: 6px; margin: 1rem 0;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; padding: 1.5rem; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h3>Додати нову новину</h3>
        <form action="{{ route('admin.news.store') }}" method="POST" style="margin-top: 1rem;">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.3rem;">Заголовок новини:</label>
                <input type="text" name="title" required style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.3rem;">Категорія:</label>
                    <select name="category" required style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
                        <option value="IT">IT</option>
                        <option value="Техніка">Техніка</option>
                        <option value="Космос">Космос</option>
                        <option value="Наука">Наука</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.3rem;">Дата публікації:</label>
                    <input type="date" name="publish_date" value="{{ date('Y-m-d') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.3rem;">Короткий опис (до 500 символів):</label>
                <textarea name="short_description" rows="2" required style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;"></textarea>
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.3rem;">Повний текст статті:</label>
                <textarea name="content" rows="5" required style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;"></textarea>
            </div>

            <button type="submit" style="background: #16a34a; color: #fff; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; cursor: pointer; font-weight: 600;">Зберегти новину</button>
        </form>
    </div>

    <h3>Список новин у базі</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Заголовок</th>
                <th style="padding: 10px;">Категорія</th>
                <th style="padding: 10px;">Дата</th>
                <th style="padding: 10px;">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $item)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 10px;">{{ $item->id }}</td>
                    <td style="padding: 10px;">{{ $item->title }}</td>
                    <td style="padding: 10px;">{{ $item->category }}</td>
                    <td style="padding: 10px;">{{ $item->publish_date }}</td>
                    <td style="padding: 10px;">
                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Видалити цю новину?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer;">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
