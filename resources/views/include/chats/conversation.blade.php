<div class="conversation" id="conversation-1">
    @if($activeDialog)

        @include('include\chats\conversation-top') {{-- Чат - Шапка с ником собеседника --}}

        @include('include\chats\conversation-main') {{-- Чат - Сообщения --}}

        @include('include\chats\conversation-form') {{-- Чат - Форма отправки сообщений --}}

    @else

        @include('include\chats\conversation-empty-message') {{-- Чат - Форма отправки сообщений --}}

    @endif

</div>
