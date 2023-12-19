
@extends('alina-layout')

@section('title', 'Контакты')

@section('main_content')


@if(session('success'))
<div>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('errors'))
<div>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

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

