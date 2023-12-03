@extends('layout')
@section('title')
    Активный чат {{ $chat->topic }}
@endsection
@section('main_content')

<div class="container">
    <h1>Активный чат {{ $chat->topic }}</h1>
    <h1>Активный пользователь {{ $user->login }}</h1>

    <div class="row">
        <div class="col-md-5 rounded border border-success p-3 m-3" >
            @if($chat->messages->count() == 0)
                <p>Нет сообщений</p>
            @endif
            @foreach ($chat->messages as $message)
            @if ($message->user->id == $user->id)
                <div class="rounded border alert alert-primary m-3 mr-5 p-2">
                    <div>
                        {{ $message->created_at }}<br>
                        <strong>{{ $message->user->login }} (Вы)</strong><br>
                        @if($message->reply_message_id != null)
                            <strong>Reply Id: {{ $message->reply_message_ids }}</strong><br>
                        @endif
                        {{ $message->content }}<br>
                    </div>
                </div>
            @else
                <div class="rounded border alert alert-secondary m-3 ml-5 p-2">
                    <div>
                        {{ $message->created_at }}<br>
                        <strong>{{ $message->user->login }}</strong><br>
                        @if($message->reply_message_id != null)
                            <strong>Reply Id: {{ $message->reply_message_ids }}</strong><br>
                        @endif
                        {{ $message->content }}<br>
                    </div>
                </div>
            @endif
        @endforeach

        <form action="{{ route('sendMessage', ['chatId' => $chat->id, 'userId' => $user->id]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="message">Новое сообщение:</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                <input type="hidden" name="chatId" value="{{ $chat->id }}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>

        </div>
    </div>
</div>

@endsection
