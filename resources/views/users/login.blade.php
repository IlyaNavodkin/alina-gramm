@extends('alina-layout')

@section('title', 'Войти')

@section('main_content')
    <div class="join">
        <div class="container">
            <div class="row justify-content-around">
            <div class="block col-auto ">
                @if ($errors->has('notPass'))
                    <div class="alert alert-danger">
                        {{ $errors->first('notPass') }}
                    </div>
                @endif
                    <section id="registration" class="registration">
                        <h2 class="form-title">Войти</h2>
                        <h3 class="form-headline">Рады видеть вас снова!<h3>
                            <form class="registration-form" action="{{ route('auth.login') }}"  id="form_id" method="post" onsubmit="return validateForm('form_id','email','password');" >
                                @csrf

                                <div class="inputbox">
                                    <input type="text" id="email" name="email" class="input-field" required>
                                    <label for="">Email</label>
                                    <p class="error-message" id="email-error"></p><br>
                                </div>

                                <div class="inputbox">
                                    <input type="password" id="password" name="password" class="input-field" required>
                                    <label for="">Пароль</label>
                                    <p class="error-message" id="password-error"></p><br>
                                </div>


                                <input type="submit" value="Войти" class="button-click" id="submit">

                                <p class="form-text">Еще нет аккаунта?<a href={{ route('register') }} class="registration-link"> Создать учетную запись</a></p>
                            </form>
                    </section>
                    <div class="registration-img">
                        <img class="registration-image"
                        src={{asset('img/login-social-media.png')}} alt="Не загрузилась">
                    </div>
            </div>
            </div>
        </div>
    </div>
@endsection


