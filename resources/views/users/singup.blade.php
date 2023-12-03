
@extends('alina-layout')

@section('title', 'Регистрация')

@section('main_content')
<div class="join">
    <div class="container">
        <div class="row justify-content-around">
           <div class="block col-10 ">
            <section id="registration" class="registration">
                <h2 class="form-title">Регистрация</h2>
                <h3 class="form-headline">Добро пожаловать!<h3>

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form method="post" action="/auth/register" class="registration-form">
                    @csrf
                    <div class="inputbox">
                        <input type="text" id="login" name="login" class="input-field" required>
                        <label for="">Логин</label>
                        <p class="error-message" id="login-error"></p><br>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="email" name="email" class="input-field" required>
                        <label for="">Email</label>
                        <p class="error-message" id="email-error"></p><br>
                    </div>
                    <div class="inputbox">
                        <input type="phone" id="phone" name="phone" class="input-field" required>
                        <label for="">Телефон</label>
                        <p class="error-message" id="tel-error"></p><br>
                    </div>
                    <div class="inputbox">
                        <input type="password" id="password" name="password" class="input-field" required>
                        <label for="">Пароль</label>
                        <p class="error-message" id="password-error"></p><br>
                    </div>
                    {{-- <div class="inputbox">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="input-field" required>
                        <label for="">Повторите пароль</label>
                        <p class="error-message" id="confirmPassword-error"></p><br>
                    </div> --}}

                    {{-- <input type="submit" form="myForm" onclick="return validateForm()" value="Зарегистрироваться" class="input-field button-click" id="submitButton"> --}}
                    <button type="submit" class="input-field button-click">Зарегистрироваться</button>

                    <p class="form-text">Уже есть аккаунта?<a href="/auth/show-login-form" class="registration-link"> Войти в учетную запись</a></p>
                </form>
            </section>

                <div class="registration-img">
                    <img class="registration-image" src={{ asset('img/cat.png') }} alt="">
                </div>
           </div>
        </div>
    </div>
</div>
@endsection


