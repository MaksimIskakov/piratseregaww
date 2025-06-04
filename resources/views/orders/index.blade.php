@extends('layouts.app')

@section('title', 'Мои заявки')
@section('content')
    <h2>Мои заявки</h2>
    <a href="{{ route('orders.create') }}" class="button">Создать новую заявку</a>

    @if($orders->isEmpty())
        <p>У вас пока нет заявок</p>
    @else
        <table class="orders-list">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Тип груза</th>
                <th>Откуда</th>
                <th>Куда</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td data-label="Дата">{{ $order->datetime}}</td>
                    <td data-label="Тип груза">{{ $order->cargo_type_name }}</td>
                    <td data-label="Откуда">{{ $order->from_address }}</td>
                    <td data-label="Куда">{{ $order->to_address }}</td>
                    <td data-label="Статус">{{ $order->status_name }}</td>

                    <td>
                        @if($order->status === 'completed' && !$order->review)
                            <button onclick="document.getElementById('review-form-{{ $order->id }}').style.display='block'">
                                Оставить отзыв
                            </button>
                            <div id="review-form-{{ $order->id }}" class="modal">
                                <div class="modal-content">
                                        <span onclick="document.getElementById('review-form-{{ $order->id }}').style.display='none'"
                                              class="close">&times;</span>
                                    <form action="{{ route('reviews.store', $order) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="rating-{{ $order->id }}">Оценка (1-5)</label>
                                            <input type="number" id="rating-{{ $order->id }}" name="rating" min="1" max="5" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment-{{ $order->id }}">Комментарий</label>
                                            <textarea id="comment-{{ $order->id }}" name="comment" required></textarea>
                                        </div>
                                        <button type="submit" class="button">Отправить отзыв</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
