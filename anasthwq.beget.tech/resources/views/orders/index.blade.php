<style>
    .orderNum-col {
    flex: 0 0 82.5% !important;
    max-width: 82.5% !important;
    }

    .orderSum-col {
    flex: 0 0 17.5% !important;
    max-width: 17.5% !important;
    }
</style>
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="cart-container mt-5">
                <h1 class="text-center">Заказы</h1>
                <hr>
                @foreach ($orders as $order)
                <div class="row mb-3">
                    <div class="orderNum-col">
                        <a href="{{route('orders.show', $order)}}">Заказ {{$order->id}}</a>
                    </div>
                    <div class="orderSum-col">
                        {{$order->sum}} рублей
                    </div>
                </div>
                <hr>
                @endforeach

<form class="text-center" action="{{route('logout')}}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Выход из аккаунта</button>
</form>
@endsection
