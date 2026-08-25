@extends('layouts.app')

@section('title', 'Авторизація адміністратора')

@section('content')
<main class="container" style="max-width: 420px; margin-top: 3rem; margin-bottom: 4rem;">
    <div style="background: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
        <h2 style="text-align: center; margin-bottom: 1.5rem;">Вхід до адмін-панелі</h2>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.9rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.3rem; font-weight: 500;">Логін</label>
                <input type="text" name="login" value="{{ old('login') }}" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.3rem; font-weight: 500;">Пароль</label>
                <input type="password" name="password" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; background: #2563eb; color: #fff; border: none; padding: 0.75rem; border-radius: 6px; font-weight: 600; cursor: pointer;">Увійти</button>
        </form>
    </div>
</main>
@endsection
