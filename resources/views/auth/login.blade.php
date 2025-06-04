@extends('layouts.app')

@section('title', 'Вход')
@section('content')
    <div class="auth-form">
        <h2>Вход</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus>
                @error('login')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="button">Войти</button>
        </form>
    </div>
@endsection
