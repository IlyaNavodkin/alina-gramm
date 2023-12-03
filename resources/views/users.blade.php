@extends('layout')
@section('title')
    Пользователи
@endsection
@section('main_content')
    <h1>Пользователи</h1>

    @if(count($users) > 0)
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">login</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">Опции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->login}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>
                        <div class="container">
                            <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                            <a href="{{ route('editUser', ['id' => $user->id]) }}" method="get" class="btn btn-primary">Изменить</a>
                            <a href="{{ route('users.getChats', ['id' => $user->id]) }}" method="get" class="btn btn-primary">Войти через него</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Нет пользователей.</p>
    @endif
@endsection
