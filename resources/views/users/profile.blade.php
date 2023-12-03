@extends('layout')

@section('title', 'Изменить пользователя')

@section('main_content')
    <div class="container mt-5">
        <h1 class="mb-4">Изменить текущего пользователя</h1>

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

        <form method="post" action="/users/edit" class="mb-4">
            @csrf

            <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

            <div class="mb-3">
                <label for="email" class="form-label">Электронный адресс:</label>
                <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"
                value="{{ $activeUser->email }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона:</label>
                <input type="text" name="phone" id="phone" placeholder="Введите phone" class="form-control"
                value="{{ $activeUser->phone }}">
            </div>

            <div class="mb-3">
                <label for="login" class="form-label">Логин:</label>
                <input type="text" name="login" id="login" placeholder="Введите login" class="form-control"
                value="{{ $activeUser->login }}">
            </div>


            <button type="submit" class="btn btn-success">Изменить данные</button>
        </form>

        <img src="{{ $avatarPath }}" width="200" height="200"  alt="Uploaded Image">
        <form class="mb-4" action="{{ route('users.uploadAvatar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

            <div class="mb-3">
                <label for="image">Выберите изображение:</label>
                <input class="form-control" type="file" name="image" id="image" accept="image/*">
            </div>

            <button class="btn btn-success" type="submit">Загрузить</button>
        </form>

    </div>
@endsection
