@extends('layouts.app')

@section('title', 'Новая заявка')
@section('content')
    <a href="{{ route('orders.index') }}"><-Вернуться к заявками</a>
    <h2>Новая заявка на перевозку</h2>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="form-group">
            <label for="datetime">Дата и время перевозки</label>

            <input type="datetime-local" id="datetime" name="datetime" required class="datetime-input">
        </div>

        <div class="form-group">
            <label for="weight">Вес груза (кг)</label>
            <input type="number" id="weight" name="weight" step="0.1" min="0.1" required>
        </div>

        <div class="form-group">
            <label for="dimensions">Габариты груза</label>
            <input type="text" id="dimensions" name="dimensions" placeholder="ДхШхВ" required>
        </div>

        <div class="form-group">
            <label for="from_address">Адрес отправления</label>
            <input type="text" id="from_address" name="from_address" required>
        </div>

        <div class="form-group">
            <label for="to_address">Адрес доставки</label>
            <input type="text" id="to_address" name="to_address" required>
        </div>

        <div class="form-group">
            <label for="cargo_type">Тип груза</label>
            <select id="cargo_type" name="cargo_type" required>
                <option value="fragile">Хрупкое</option>
                <option value="perishable">Скоропортящееся</option>
                <option value="refrigerated">Требуется рефрижератор</option>
                <option value="animals">Животные</option>
                <option value="liquid">Жидкость</option>
                <option value="furniture">Мебель</option>
                <option value="garbage">Мусор</option>
            </select>
        </div>

        <div id="garbage-warning" class="warning" style="display: none;">
            Внимание! При выборе типа груза "Мусор" стоимость заказа будет увеличена, поскольку требуется утилизация.
        </div>

        <button type="submit" class="button">Отправить заявку</button>
    </form>

    <script>
        document.getElementById('cargo_type').addEventListener('change', function() {
            const warning = document.getElementById('garbage-warning');
            warning.style.display = this.value === 'garbage' ? 'block' : 'none';
        });
    </script>
@endsection
