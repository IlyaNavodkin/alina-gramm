@extends('layout')
@section('title')
    Сообщения
@endsection
@section('main_content')

<h1>Сообщения</h1>

@if(count($messages) > 0)
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Id сообщения</th>
            <th scope="col">Текст сообщения</th>
            <th scope="col">Создатель чата</th>
            <th scope="col">Имя чата</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <td>{{$message->id}}</td>
                <td>{{$message->content}}</td>
                <td>{{$message->user->login}}</td>
                <td>{{$message->chat->topic}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Нет сообщений.</p>
@endif

@endsection
