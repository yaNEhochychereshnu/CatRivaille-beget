@extends('layout')
@section('content')
    <style>
    .product-container {
      max-width: 420px;
      margin: 0 auto;
    }
    .product-image {
      width: 100%;
      height: auto;
      margin-top: 25px;
      margin-bottom: 10px;
    }
    .button-container {
      display: flex;
      justify-content: flex-end;
    }

    .cart-button {
      width: 125px;
    }

    .fav-button {
      margin-left: 15px;
    }

    .product-info {
      line-height: 1.4;
      word-wrap: break-word;
    }

    .product-info p {
  margin-bottom: 5px; /* Уменьшаем вертикальный отступ между элементами <p> */
}

    b {
    color: #4780C4;
    }

    .availability {
    color: #3B8354;
  }
  .availability.out-of-stock {
    color:  #A92323;

  }

  .favourite-btn {
        width: 100%;
        height: 100%;
    }

    .favourite-btn img {
    width: 25px;
    height: 25px;
    }

  </style>
<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="product-container">
        <img src="{{asset($product->img_path)}}"alt="Product Image" class="product-image">
        <div class="row mt-3 product-info">
          <div class="col">
            <p><b>{{$product->title}}</b></p>
            <p>{{$product->price}} рублей</p>
            @if (Auth::check() && Auth::user()->is_admin)
                <p>Осталось: {{$product->qty}}</p>
            @endif
            <?php
                $qty = $product->qty;
                $availability_class = $qty == 0 ? 'out-of-stock' : '';
                echo "<p class='availability $availability_class'>" . ($qty == 0 ? 'Закончился' : 'В наличии') . "</p>";
            ?>
          </div>
          <div class="col text-right">
            <div class="button-container">
                <a href="{{route('cart.store', ['product_id'=>$product->id])}}" class="cart-button btn btn-primary align-items-center">в корзину</a>
                <div class="fav-button">
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
          </div>
        </div>
        <div class="row mt-3 product-info">
          <div class="col">
            <p><b>Описание товара:</b></p>
            <p>Тип товара: {{$product->category->title}}.</p>
            <p>Материал: {{$product->material}}.</p>
            <p>Размер: {{$product->size}}см.</p>
          </div>
          <div class="col">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
