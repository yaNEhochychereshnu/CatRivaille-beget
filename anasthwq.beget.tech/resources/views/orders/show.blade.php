<style>
    b {
        color: #4780C4;
    }

    h4 {
        color: #4780C4;
        margin: 0 !important;
        padding: 0 !important;
    }

    .delivery-col {
    flex: 0 0 82.5% !important;
    max-width: 82.5% !important;
    }

    .deliverysum-col {
    flex: 0 0 17.5% !important;
    max-width: 17.5% !important;
    }

    .center-text {
    text-align: center;
    white-space: pre-wrap;
    }

    .payment-btn {
        width: 100%;
    }
</style>
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="cart-container mt-5">
                <h2 class="text-center"><a href="{{route('orders.show', $order)}}">Заказ {{$order->id}}</a></h2>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <h4>Товар</h4>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-2">
                        <h4>Цена</h4>
                    </div>
                    <div class="col-md-2">
                        <h4>Кол-во</h4>
                    </div>
                    <div class="col-md-2">
                        <h4>Сумма</h4>
                    </div>
                </div>
                <hr>
                @foreach ($order->products as $product)
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <img src="{{ asset($product->img_path) }}" class="img-fluid" alt="Product Image">
                        </div>
                        <div class="col-md-4">
                            <h5>{{$product->title}}</h5>
                        </div>
                        <div class="col-md-2">
                            <p class="center-text">{{$product->price}} рублей</p>
                        </div>
                        <div class="col-md-2">
                            <p class="center-text">{{$product->pivot->qty}}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="center-text">{{$product->pivot->qty * $product->price}} рублей</p>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row mb-3">
                    <div class="delivery-col">
                        <b>Доставка:</b>
                    </div>
                    <div class="deliverysum-col">
                         <span class="ml-auto">350 рублей</span>
                    </div>
                </div>
                <hr>
                <p><b>Итого: </b>{{$order->sum}} рублей</p>
                <p><b>Статус: </b>{{$order->status}}</p>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12">
                        @if ($order->status == 'Создан')
                            <button type="button" class="btn btn-primary mt-3 payment-btn">
                                <a href="{{ route('orders.payment', $order) }}" style="color: white; text-decoration: none;">Оплатить</a>
                            </button>
                        @endif
                    </div>
                </div>
                @if ($order->status == 'Отправлен')
                    <p><b>Трек-код: </b>{{$order->trackcode}}</p>
                @endif
                    @if (Auth::check() && Auth::user()->is_admin)
                    <hr>
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label for="status"><b>Статус: </b></label>
                                <select name="status" id="status">
                                    <option value="Создан" {{ $order->status == 'Создан' ? 'selected' : '' }}>Создан</option>
                                    <option value="В обработке" {{ $order->status == 'В обработке' ? 'selected' : '' }}>В обработке</option>
                                    <option value="Подтвержден" {{ $order->status == 'Подтвержден' ? 'selected' : '' }}>Подтвержден</option>
                                    <option value="В сборке" {{ $order->status == 'В сборке' ? 'selected' : '' }}>В сборке</option>
                                    <option value="Отправлен" {{ $order->status == 'Отправлен' ? 'selected' : '' }}>Отправлен</option>
                                    <option value="Завершен" {{ $order->status == 'Завершен' ? 'selected' : '' }}>Завершен</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="trackcode"><b>Трек-код: </b></label>
                                <input type="text" id="trackcode" name="trackcode" value="{{ old('trackcode') ?? $order->trackcode }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Обновить статус</button>
                    </form>
                    @if ($order->status == 'В обработке')
                    <p><b>Чек об оплате: </b></p>
                    <p><img src="{{asset($order->receipt_path)}}" alt="receipt" class="img-fluid"></p>
                    @endif
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
