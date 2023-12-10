function refreshConversation(contactId) {
    // Выполняем GET-запрос на указанный URL

    $.ajax({
        type: "GET",
        url: "/contacts/getById/" + contactId,
        success: function (response) {
            // Используйте актуальный идентификатор элемента
            $("#conversation-1").html(response);
            console.log(contactId);
        },
        error: function (error) {
            console.error("Ошибка AJAX-запроса", error);
        },
    });
}

$(document).ready(function () {
    // При загрузке страницы и каждый раз после добавления нового сообщения
    scrollToBottom();

    function scrollToBottom() {
        var conversationWrapper = $(".conversation-wrapper");
        conversationWrapper.scrollTop(conversationWrapper[0].scrollHeight);
    }
});
