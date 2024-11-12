   <style>
    h4 {
        color: #4780C4;
        margin: 0 !important;
        padding: 0 !important;
    }

    .delete-btn {
        width: 100%;
    }

    .center-text {
    text-align: center;
    white-space: pre-wrap;
    }

    b {
        color: #4780C4;
    }

    .delivery-col {
    flex: 0 0 82.5% !important;
    max-width: 82.5% !important;
    }

    .deliverysum-col {
    flex: 0 0 17.5% !important;
    max-width: 17.5% !important;
    }

    .empty-col {
    flex: 0 0 74% !important;
    max-width: 74% !important;
    }

    .total-col {
    flex: 0 0 26% !important;
    max-width: 26% !important;
    }
   </style>
@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-container mt-5">
                    <h1 class="text-center mb-3">Корзина</h1>
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
                    @foreach ($products as $product)
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <img src="{{asset($product->img_path)}}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-4">
                            <h5>{{$product->title}}</h5>
                        </div>
                        <div class="col-md-2">
                            <p class="center-text">{{$product->price}} рублей</p>
                        </div>
                        <div class="col-md-2">
                            <form action="{{route('cart.change', ['product_id'=>$product->id])}}" method="POST">
                                @csrf
                                <input type="number" name="qty" value="{{$product->pivot->qty}}" min="0" max="{{$product->qty}}" class="form-control">
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Изменить</button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <p class="center-text">{{$product->pivot->qty * $product->price}} рублей</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form action="{{route('cart.destroy', ['id'=>$product->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <p></p><button type="submit" class="btn btn-danger delete-btn">Удалить</button>
                            </form>
                            <hr>
                        </div>
                    </div>
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
                    <div class="row mb-3">
                        <div class="empty-col">
                        </div>
                        <div class="total-col">
                            <b>Итого: </b><u>{{$totalPrice}} рублей</u>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form mt-5">
                    <h1 class="text-center">Подтверждение заказа</h1>
                    <form action="{{route('orders.store')}}" method="POST">
                        @csrf
                        <input type="hidden" id="sum" name="sum" value={{$totalPrice}}>
                        <div class="form-group">
                            <h5>ФИО:</h5>
                            <input type="text" class="form-control mb-3" id="full_name" name="full_name" placeholder="Иванов Иван Иванович" required>
                        </div>
                        <div class="form-group">
                            <h5>Номер телефона:</h5>
                            <input type="text" class="mask-phone form-control mb-3" id="phone" name="phone" placeholder="Номер телефона" required>
                        </div>
                        <div class="form-group">
                            <h5>Адрес:</h5>
                            <input type="text" class="form-control mb-3" id="address" name="address" placeholder="Город, улица, дом, квартира" required>
                        </div>
                        <div class="form-group">
                            <h5>Индекс:</h5>
                            <input type="text" class="form-control mb-3" id="postcode" name="postcode" placeholder="111111" required>
                        </div>
                        <div class="form-group">
                            <h5>Пароль:</h5>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Оформить заказ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection


