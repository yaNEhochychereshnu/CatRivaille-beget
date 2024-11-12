    @extends('layout')
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form mt-5">
                    <h1>Как со мной связаться?</h1>
                    <div class="container1 p-4">
                        <p>Если у Вас возникли трудности или вопросы, сначала попробуйте посмотреть свой вопрос во вкладке <a href="{{route('faq')}}">“FAQ”</a>. Если Вы не увидели там решение своего вопроса, свяжитесь со мной удобным Вам способом.</p>
                    </div>
                    <div class="rectangle-1 mb-3"></div>
                    <h3>Почта</h3>
                    <p class="mb-3 text-center">dianaparker228@yandex.ru</p>
                    <div class="rectangle-1 mb-3"></div>
                    <h3>Мессенеджеры</h3>
                    <div class="icons-three d-flex justify-content-center">
                        <div class="social-icons">
                            <a href="https://t.me/catriart"><img alt="SocialIcon" height="92.95" width="92.95" src="{{asset('Assets/SocialIcon.svg')}}"/></a>
                        </div>
                        <div class="social-icons">
                            <a href="https://vk.com/catrivailleart"><img alt="SocialIcon1" height="92.95" width="92.95" src="{{asset('Assets/SocialIcons1.svg')}}"/></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

