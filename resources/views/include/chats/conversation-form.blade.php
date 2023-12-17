<div class="conversation-form">
    <form action="{{ route('sendContactMessage') }}" method="post">
        @csrf
        <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
        <div class="conversation-form-group">
            <input type="hidden" name="contact_id" value="{{ $activeDialog->id }}">
            <input class="conversation-form-input" type="text" name="message" id="chat-input-message" rows="1" placeholder="Напиши сообщение..." />
            <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
        </div>
        <button type="submit" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
    </form>
</div>
