@extends('alina-layout')

@section('title', 'Чат')

@section('main_content')

<section class="chat-section">
    <div class="chat-container">

        @include('include.sidebar.sidebar') {{-- Сайдбар --}}

        <!-- end: Sidebar -->
        <!-- start: Content -->
        <div class="chat-content" id="chat-content-1">
            <!-- start: Content side -->
            @include('include.chats.chats-menu') {{-- Контакты --}}
            <!-- start: Conversation -->

            @include('include.chats.conversation') {{-- Чат - Форма отправки сообщений --}}

        </div>
    </div>
</section>
@endsection

