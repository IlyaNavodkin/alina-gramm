@extends('alina-layout')

@section('title', 'MyaoTalk - Добро пожаловать!')

@section('main_content')
<div class="join">
    <div class="container">
        <div class="row justify-content-around">
           <div class="block col-auto ">
                <div class="small-block">
                    <div class="picture-top ">
                        <img src={{ asset('img/2150797726-PhotoRoom.png-PhotoRoom.png') }} alt="">
                    </div>

                    <div class="info col-6">
                        <h1 class="title-enter">
                            Добро пожаловать в <span>MyaoTalk</span>!
                        </h1>
                        <p class="text-enter">Анонимный мессенджер с простым и интуитивно понятным интерфейсом, который позволяет легко общаться с друзьями и близкими. <br>Будьте на связи в любое время и в любом месте.</p>
                        <div class="buttons">
                            <a href="/login" class="button-click">Войти</a>
                            <a href="/register" class="button-click">Регистрация</a>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection



