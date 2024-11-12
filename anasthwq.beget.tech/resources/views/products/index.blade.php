<style>
.product-info {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-card {
    width: 100%;
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd; /* Добавьте границу для лучшей видимости */
    background-color: #fff; /* Цвет фона */
    margin-bottom: 20px; /* Отступ между карточками */
}

.product-image {
    width: 100%;
    height: auto;
}

.product-card a {
    width: 100%;
    margin-bottom: 10px;
}

.favourite-btn {
    width: 50px; /* Установите фиксированную ширину */
    height: 40px; /* Установите фиксированную высоту */
    padding: 0; /* Уберите внутренние отступы */
}

.favourite-btn img {
    width: 25px;
    height: 25px;
}

.change-btn,
.delete-btn {
    width: 100%;
}

.filter {
    margin-right: 10px;
}

.product-card .btn {
    margin: 5px 0; /* Отступы сверху и снизу для кнопок */
}

    }

</style>
@extends('layout')
@section('content')
<div class="container">
    <h1 class="text-center mt-5">Каталог</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 mb-3 text-center" style="height: fit-content;">
            @if (Auth::check() && Auth::user()->is_admin)
                <a href="{{route('products.create') }}" class="btn btn-primary w-100"> Добавить новый товар</a>
            @endif
        </div>
        <div class="col-md-8 mb-3 text-center d-flex align-items-center justify-content-between" style="height: fit-content;">
            <form id="filterForm" action="{{ route('products.filter') }}" method="POST" class="d-flex flex-wrap w-100">
                @csrf
                <div class="col-md-6 mb-3" style="flex-grow: 1;">
                    <select id="filter" name="filter" class="filter form-select w-100">
                        <option value="all">Категория</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
                <div class="product-card border-0">
                    <div class="product-info d-flex flex-column justify-content-between" style="height: 100%;">
                        <img src="{{ asset($product->img_path) }}" class="product-image" alt="Product Image">
                        <h5 class="card-title text-center mb-3"><a href="{{ route('products.show', $product) }}">{{ $product->title }}</a></h5>
                        <p class="text-center">{{ $product->price }} рублей</p>
                        <div class="row justify-content-center">
                            <div class="col-md-8 mb-2">
                                <a href="{{ route('cart.store', ['product_id' => $product->id]) }}" class="btn btn-primary">В корзину</a>
                            </div>
                            <div class="col-md-4">
                                @if (Auth::check() && Auth::user())
                                    @php
                                        $isFavourite = Auth::user()->favourites->contains($product->id);
                                        $favouriteIcon = $isFavourite ? 'unfavourite.svg' : 'favourite-1.svg';
                                    @endphp
                                    <button type="button" class="btn btn-primary favourite-btn" data-product-id="{{ $product->id }}">
                                        <img src="{{ asset("Assets/$favouriteIcon") }}" alt="Favorite Icon" class="favourite-icon">
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary favourite-btn" onclick="location.href='{{ route('login') }}'">
                                        <img src="{{ asset("Assets/favourite-1.svg") }}" alt="Favorite Icon" class="favourite-icon">
                                    </button>
                                @endif
                            </div>
                        </div>
                        @if (Auth::check() && Auth::user()->is_admin)
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary change-btn">Изменить</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">Удалить</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
