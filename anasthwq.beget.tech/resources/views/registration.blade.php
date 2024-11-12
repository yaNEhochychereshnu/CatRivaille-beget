    @extends('layout')
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="registration-form mt-5">
                    <h1 class="text-center mb-3">Регистрация</h1>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5>Эл. почта:</h5>
                            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="email@mail.ru" value="{{old('email')}}" required>
                        </div>
                        <div class="form-group">
                            <h5>Логин:</h5>
                            <input type="text" class="form-control mb-3" id="login" name="login" placeholder="Логин" value="{{old('login')}}" required>
                        </div>
                        <div class="form-group">
                            <h5>Пароль:</h5>
                            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Пароль" required>
                        </div>
                        <div class="form-group">
                            <h5>Повторите пароль:</h5>
                            <input type="password" class="form-control mb-3"  id="password_confirmation" name="password_confirmation" placeholder="Подтверждение пароля" required>
                        </div>
                        <div class="text-center">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary mt-3">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

