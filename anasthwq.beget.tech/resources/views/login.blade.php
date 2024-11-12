    @extends('layout')
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form mt-5">
                    <h1 class="text-center">Вход</h1>
                    <form action="{{route('login')}}" method = "POST">
                        @csrf
                        <div class="form-group">
                            <h5>Эл.почта/логин:</h5>
                            <input type="text" class="form-control mb-3" id="login_or_email" name="login_or_email" placeholder="Эл.почта/логин" required>
                        </div>
                        <div class="form-group">
                            <h5>Пароль:</h5>
                            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Пароль" required>
                        </div>
                        <div class="form-group text-center">
                            <p>Нет аккаунта? Тогда, <a href="{{route('registration')}}">зарегистрируйтесь</a>!</p>
                        </div>
                        <div class="form-group text-center">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary mb-3">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

