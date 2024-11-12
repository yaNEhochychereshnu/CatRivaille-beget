<style>
  .favourite-col{
    flex: 0 0 30% !important;
    max-width: 30% !important;
    }
    .orders-col{
    flex: 0 0 30% !important;
    max-width: 30% !important;
    }
    .cart-col{
    flex: 0 0 30% !important;
    max-width: 30% !important;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=1024">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/style.css')}}">
    <title>Catrivaille</title>
</head>
<body>
    <header>
        <div class="contacts">
            <div class="running-line">
                <div class="scrolling">• Спасибо за покупку! Заказы были закрыты. Приблизительная дата отправки - 1 июня!</div>
                <div class="scrolling">• Спасибо за покупку! Заказы были закрыты. Приблизительная дата отправки - 1 июня!</div>
                <div class="scrolling">• Спасибо за покупку! Заказы были закрыты. Приблизительная дата отправки - 1 июня!</div>
                <div class="scrolling">• Спасибо за покупку! Заказы были закрыты. Приблизительная дата отправки - 1 июня!</div>
            </div>
                <div class="header">
                    <div class="row">
                        <div class="col">
                          <img src="{{asset('Assets/MainImage.png')}}" alt="MainImage" class="main-image">
                          <h1 class="text-center cat-rivaille">CatRivaille</h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <ul class="list-unstyled d-flex justify-content-center">
                            @if (Auth::check() && Auth::user()->is_admin)
                                <li><a href="{{route('categories.index')}}">категории</a></li>
                                <li><a href="{{route('orders.index')}}">заказы</a></li>
                            @endif
                            <li><a href="{{route('products.index')}}">товары</a></li>
                            <li><a href="{{route('faq')}}">FAQ</a></li>
                            <li><a href="{{route('contacts')}}">контакты</a></li>
                          </ul>
                        </div>
                      </div>
                <div class="icons">
                    <div class="row mb-3">
                        <div class="favourite-col">
                            <a href="{{route('favourites')}}"><img class="favourite" alt=""src="{{asset('Assets/favourite-icon.svg')}}"/></a>
                        </div>
                        <div class="orders-col">
                            <a href="{{route('orders.index')}}"><img alt="" class="user" src="{{asset('Assets/user-icon.svg')}}"/></a>
                        </div>
                        <div class="cart-col">
                            <a href="{{route('cart.index')}}"><img alt="" class="shopping-bag" src="{{asset('Assets/basket-icon.svg')}}"/></a>
                        </div>
                    </div>
                </div>
              </div>
    </header>
    @if (Session::has('info'))
    <div class="alert alert-warning">
        {{ Session::get('info') }}
    </div>
@endif

@if (isset($info))
    <div class="alert alert-warning">
        {{ $info }}
    </div>
@endif
    <main class="main">
        @yield('content')
        <script src="{{asset("JS/bootstrap.bundle.min.js")}}"></script>
        <script src="{{asset("JS/code.jquery.com_jquery-3.7.1.min.js")}}"></script>
        <script src="{{asset("JS/jquery.maskedinput.min.js")}}"></script>
        <script>
            $('.mask-phone').mask('+7 (999) 999-99-99');
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#filter').change(function() {
                    $('#filterForm').submit();
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favourite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const favouriteIcon = this.querySelector('.favourite-icon');

            fetch(`/favourites/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.action === 'added') {
                    favouriteIcon.src = '{{ asset("Assets/unfavourite.svg") }}'; // Иконка для добавленного в избранное
                } else if (data.action === 'removed') {
                    favouriteIcon.src = '{{ asset("Assets/favourite-1.svg") }}'; // Иконка для убранного из избранного
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
        </script>

    </main>
<footer>
        <div class="footer">
            <div class="icons-two">
                <div class="telegram-icon">
                    <a href="https://t.me/catriart"><img alt="TelegramIcon" src="{{asset('Assets/TelegramIcon.svg')}}"/></a>
                </div>
                <div class="telegram-icon">
                    <a href="https://vk.com/catrivailleart"><img alt="VKIcon" src="{{asset('Assets/VKIcon.svg')}}"/></a>
                </div>
            </div>
            <div class="rectangle-14"></div>
            <p class="num-2024-cat-rivaille">
                © 2024 «CatRivaille»</p>
        </div>
    </footer>
</body>
</html>
