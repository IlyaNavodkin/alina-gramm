<div class="conversation-form">
    <form action="{{ route('sendContactMessage') }}" method="post" class="conversation-form-container">
        @csrf

        <div class="conversation-form-group">
            <input type="hidden" name="contact_id" value="{{ $activeDialog->id }}">
            <input class="conversation-form-input" type="text" name="message" id="chat-input-message" rows="1" placeholder="Напиши сообщение..." />

        </div>
        <button type="submit" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
    </form>
</div>
