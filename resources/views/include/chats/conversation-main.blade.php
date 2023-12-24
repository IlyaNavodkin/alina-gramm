<div class="conversation-main">
    <ul class="conversation-wrapper">
        <div class="conversation-item-content">
            <div class="conversation-item-wrapper">

                @foreach ($activeDialog->messages as $message)
                @if($message->user_id == Auth::user()->id)
                <div class="conversation-item-box sent">
                    <div class="conversation-item-text">
                        <p>{{$message->content}}</p>
                        <div class="conversation-item-time">{{$message->created_at}}</div>
                    </div>
                    <div class="conversation-item-dropdown">
                        <button data-message-id="{{ $message->id }}" onclick="deleteMessage({{ $message->id }})" type="button" class="conversation-item-dropdown-toggle"><i class="ri-delete-bin-line"></i></i></button>
                    </div>
                </div>

                @else
                <div class="conversation-item-box received">
                    <div class="conversation-item-text">
                        <p>{{$message->content}}</p>
                        <div class="conversation-item-time">{{$message->created_at}}</div>
                    </div>
                    {{-- <div class="conversation-item-dropdown">
                        <button data-message-id="{{ $message->id }}"  type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                        <ul class="conversation-item-dropdown-list">
                            <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                            <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                        </ul>
                    </div> --}}
                </div>

                @endif
                @endforeach

            </div>
        </div>
    </ul>
</div>
