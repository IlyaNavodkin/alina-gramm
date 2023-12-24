<div class="conversation-top">
    <a type="button" href="{{ route('chat') }}" class="conversation-back"><i class="ri-arrow-left-line"></i></a>
    <div class="conversation-user">


            <img class="content-message-image" src={{ asset($activeDialog->friend->avatar) }} alt="">
            <div class="conversation-user-name">{{ $activeDialog->friend->login }}</div>
            {{-- <div class="conversation-user-status online" id="chat-friend-top-status">online</div> --}}

    </div>
    <div class="conversation-buttons">
        <a href="{{ route('chat') }}" type="button"><i class="ri-close-circle-line"></i></a>
    </div>
</div>
