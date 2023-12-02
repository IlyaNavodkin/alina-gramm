@extends('layout')
@section('title')
    Чаты
@endsection
@section('main_content')

<h1>Чаты</h1>

@if(count($chats) > 0)
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Id чата</th>
            <th scope="col">Имя чата</th>
            <th scope="col">Создатель чата</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chats as $chat)
            <tr>
                <td>{{$chat->id}}</td>
                <td>{{$chat->topic}}</td>
                <td>{{$chat->owner->login}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chatModal{{$chat->id}}">
                        Показать сообщения
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#usersInfo{{$chat->id}}">
                        Показать участников
                    </button>
                </td>
            </tr>

            <!-- Модальное окно для каждого чата -->
            <div class="modal" id="chatModal{{$chat->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark ">
                        <div class="modal-header">
                            <h5 class="modal-title">Topic:{{$chat->topic}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                            @if (count($chat->messages) > 0)
                                <ul>
                                    @foreach($chat->messages as $message)
                                        <div class="alert alert-primary" role="alert">
                                            <div>
                                                <h4>{{$message->user->login}}</h4>
                                                <p>{{$message->created_at}}</p>
                                            </div>
                                            <li>{{$message->content}}</li>
                                        </div>
                                    @endforeach
                                </ul>
                            @else
                                <p>Нет сообщений.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Модальное окно для каждого чата -->
            <div class="modal" id="usersInfo{{$chat->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark ">
                        <div class="modal-header">
                            <h5 class="modal-title">Topic:{{$chat->topic}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                            @if (count($chat->users) > 0)
                                <ul>
                                    @foreach($chat->users as $user)
                                        <div class="alert alert-secondary" role="alert">
                                            <div>
                                                <h4>{{$user->email}}</h4>
                                            </div>
                                            <li>{{$user->login}}</li>
                                        </div>
                                    @endforeach
                                </ul>
                            @else
                                <p>Нет сообщений.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
@endforeach
        </tbody>
    </table>
@else
    <p>Нет чатов.</p>
@endif

@endsection
