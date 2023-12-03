@extends('layout')

@section('title', 'Добавить пользователя')

@section('main_content')
    <div class="container mt-5">
        <h1 class="mb-4">Добавить нового пользователя</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post"  action="{{ route('users.register') }}" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Электронный адресс:</label>
                <input type="email" name="email" id="email" placeholder="Введите email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона:</label>
                <input type="text" name="phone" id="phone" placeholder="Введите phone" class="form-control">
            </div>

            <div class="mb-3">
                <label for="login" class="form-label">Логин:</label>
                <input type="text" name="login" id="login" placeholder="Введите login" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Пароль:</label>
                <input name="password" id="password" class="form-control" placeholder="Введите пароль" type="password">
            </div>

            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </div>
@endsection
