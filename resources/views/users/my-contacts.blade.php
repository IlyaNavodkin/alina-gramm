
@extends('alina-layout')

@section('title', 'Контакты')

@section('main_content')

<section class="chat-section">
    <div class="chat-container">

        @include('include\sidebar\sidebar') {{-- Сайдбар --}}

        <div class="chat-content">

            @include('include\contacts\contact-menu') {{-- Контакты --}}

            <!-- диалоговое окно дефолт -->
            <div class="conversation conversation-default active">
                <i class="ri-chat-3-line"></i>
                <p>Пора поболтать? Выбери того, кому хочешь написать!</p>
            </div>
        </div>
    </div>
</section>
@endsection

