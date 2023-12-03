@extends('layout')
@section('title')
    Активный контакт
@endsection
@section('main_content')

<div class="container">
    <h1>Вы это -> {{ $activeUser->id }}</h1>
    <h1>Ваш собеседник -> {{ $otherUser->id }}</h1>
    <h1>User to {{ $contact->userTo->login }}</h1>
    <h1>User from {{ $contact->userFrom->login }}</h1>
    <img src="{{ asset( $otherUser->avatar) }}" width="200" height="200"  alt="Uploaded Image">

    <div class="row">
        <div class="col-md-5 rounded border border-success p-3 m-3" >


            @if($contact->messages->count() == 0)
                <p>Нет сообщений</p>
            @endif
            @foreach ($contact->messages as $message)
            @if ($message->user->id == $activeUser->id)
                <div class="rounded border alert alert-primary m-3 mr-5 p-2">
                    <div>
                        {{ $message->created_at }}<br>
                        <strong>{{ $message->user->login }} (Вы)</strong><br>
                        @if($message->reply_message_id != null)
                            <strong>Reply Id: {{ $message->reply_message_ids }}</strong><br>
                        @endif
                        {{ $message->content }}<br>
                        <form action="{{ route('messages.delete') }}"  method="post">
                            @csrf
                            <input type="hidden" name="messageId" value="{{ $message->id }}">
                            <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                        </form>

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

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('messages.contact.send', ['activeUserId' => $activeUser->id]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="message">Новое сообщение:</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                <input type="hidden" name="contactId" value="{{ $contact->id }}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>

        </div>
    </div>
</div>

@endsection
