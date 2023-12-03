@extends('layout')
@section('title')
    Все чаты пользователей
@endsection
@section('main_content')


<div class="container">
    <h1>Пользователь {{ $activeUser->login }}</h1>
    <div class="row">
        <div class="col-md-5 rounded border border-success p-3 m-3" >
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h2>Контакты</h2>

            @foreach ($acceptedContacts as $contact)
            <div class="alert alert-primary m-3 p-3">
                @if($activeUser->id == $contact->userFrom->id)
                    <div >
                        <strong>Login {{ $contact->userTo->login }}</strong><br>
                        <strong>Email {{ $contact->userTo->email }}</strong><br>
                        <strong>Phone {{ $contact->userTo->phone }}</strong><br>
                    </div>

                @else
                    <div >
                        <strong>Login {{ $contact->userFrom->login }}</strong><br>
                        <strong>Email {{ $contact->userFrom->email }}</strong><br>
                        <strong>Phone {{ $contact->userFrom->phone }}</strong><br>
                    </div>
                @endif
                <form action="{{ route('contacts.delete', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                </form>
                <a href="{{ route('contacts.chat', ['contactId' => $contact->id,'activeUserId' => $activeUser->id]) }}" class="btn btn-primary mr-2 mt-2">Написать пользователю</a>
            </div>
        @endforeach

            <h2>Входящие запросы</h2>

            @foreach ($pendingContacts as $contact)
            <div class="lert alert-warning m-3 p-3">
                <div >
                    <strong>Login {{ $contact->userFrom->login }}</strong><br>
                    <strong>Email {{ $contact->userFrom->email }}</strong><br>
                    <strong>Phone {{ $contact->userFrom->phone }}</strong><br>
                </div>
                <form action="{{ route('contacts.accept', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                    @csrf
                    <button type="submit" class="btn btn-success mt-3">Принять</button>
                </form>
                <form action="{{ route('contacts.delete', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Отклонить</button>
                </form>
            </div>
        @endforeach
            <h2>Исходящие запросы</h2>

            @foreach ($commingContacts as $contact)
            <div class="lert alert-success m-3 p-3">
                <div >
                    <strong>Login {{ $contact->userTo->login }}</strong><br>
                    <strong>Email {{ $contact->userTo->email }}</strong><br>
                    <strong>Phone {{ $contact->userTo->phone }}</strong><br>
                </div>
                <form action="{{ route('contacts.delete', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                </form>
            </div>
        @endforeach

        </div>
        <div class="col-md-5 rounded border border-success p-3 m-3" >
            <h2>Добавить контакт</h2>
            <form action="{{ route('contacts.create', ['userId' => $activeUser->id]) }}" method="post">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="login">Введите логин:</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>

                <button type="submit" class="btn btn-primary">Отправить запрос в контакт</button>
            </form>

        </div>
    </div>
    <div class="row">
        <div class="col-md-5 rounded border border-success p-3 m-3" >
            <h2>Чаты пользователя</h2>
                @foreach ($activeUser->chats as $chat)
                <div class="rounded border border-success m-3 p-3">
                    <div >
                        <strong>Chat ID: {{ $chat->id }}</strong><br>
                        <span>Chat-owner:</span><br>
                        <div class="d-flex flex-wrap">
                            <div class="rounded border border-danger pr-1 pl-1">{{ $chat->owner->login }}</div>
                        </div>
                        <span>Users:
                            <div class="d-flex flex-wrap">
                                @foreach ($chat->users as $user)
                                <div class="rounded border border-success pr-1 pl-1">{{ $user->login }}</div>
                                @endforeach
                            </div>
                        <span>Total messages: {{ $chat->messages->count() }}</span>

                    </div>
                    <div>
                        <a href="{{ route('enterChat', ['chatId' => $chat->id, 'userId' => $activeUser->id]) }}" class="btn btn-primary mr-2 mt-2">Перейти в чат</a>
                        <a href="{{ route('exitChat', ['chatId' => $chat->id, 'userId' => $activeUser->id]) }}" class="btn btn-danger mt-2">Выйти из чата</a>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-md-5 rounded border border-success p-3 m-3" >
            <h2>Остальные чаты</h2>
                @foreach ($notUsedChats as $chat)
                <div class="rounded border border-success m-3 p-3">
                    <div >
                        <strong>Chat ID: {{ $chat->id }}</strong><br>
                        <span>Chat-owner:</span><br>
                        <div class="d-flex flex-wrap">
                            <div class="rounded border border-danger pr-1 pl-1">{{ $chat->owner->login }}</div>
                        </div>
                        <span>Users:
                            <div class="d-flex flex-wrap">
                                @foreach ($chat->users as $user)
                                <div class="rounded border border-success pr-1 pl-1">{{ $user->login }}</div>
                                @endforeach
                            </div>
                        <span>Total messages: {{ $chat->messages->count() }}</span>

                    </div>
                    <div>
                        <a  href="{{ route('addChat', ['chatId' => $chat->id, 'userId' => $activeUser->id]) }}" class="btn btn-success mr-2 mt-2">Добавить чат</a>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

</div>

@endsection
