@extends('layouts.app')

@section('title', 'Регистрация')
@section('content')
    <div class="auth-form">
        <h2>Регистрация</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="login">Логин (только кириллица, мин. 6 символов)</label>
                <input type="text" id="login" name="login" value="{{ old('login') }}" required>
                @error('login')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Пароль (мин. 6 символов)</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Подтвердите пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="full_name">ФИО (только кириллица и пробелы)</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                @error('full_name')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Телефон (формат: +7(XXX)-XXX-XX-XX)</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="button">Зарегистрироваться</button>
        </form>
    </div>
@endsection
