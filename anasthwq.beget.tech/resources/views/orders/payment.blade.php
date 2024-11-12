<style>
    h4 {
        color: #4780C4;
        margin: 0 !important;
        padding-bottom: 10 !important;
    }

    h2 {
        color: #4780C4;
        margin: 0 !important;
        padding: 10 !important;
    }
</style>
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="login-form mt-5">
                <h1 class="text-center mt-5">Оплата заказа {{$order->id}}</h1>
                <div class="container1 p-4">
                <h4>Реквизиты для оплаты</h4>
                <ul>
                    <li>Получатель: Крючкова Диана Олеговна</li>
                    <li>Телефон: +7 (987) 974-70-08</li>
                    <li>Банк: Сбербанк/Тинькофф</li>
                </ul>
                <hr>
                <h4>Загрузить чек об оплате</h4>
                <form action="{{route('orders.uploadReceipt', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="receipt">Выберите файл</label>
                        <input type="file" class="form-control" id="receipt" name="receipt" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Отправить</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
