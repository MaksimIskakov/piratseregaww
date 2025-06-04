@extends('layouts.app')

@section('title', 'Панель администратора')
@section('content')
    <h2>Панель администратора</h2>


    <div class="admin-table">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Дата</th>
            <th>Тип груза</th>
            <th>Габариты груза</th>
            <th>Откуда</th>
            <th>Куда</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->full_name }}</td>
                <td>{{ $order->datetime}}</td>
                <td>{{ $order->cargo_type_name }}</td>
                <td>{{ $order->dimensions }}</td>
                <td>{{ $order->from_address }}</td>
                <td>{{ $order->to_address }}</td>
                <td>{{ $order->status_name }}</td>
                <td>
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Новая</option>
                            <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>В работе</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Выполнено</option>
                            <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Отменена</option>
                        </select>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        <div>

    {{ $orders->links() }}
@endsection
