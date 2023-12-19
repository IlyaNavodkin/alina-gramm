$(document).ready(function () {
    var conversationMain = $(".conversation-main");

    if (conversationMain.length > 0) {
        conversationMain.scrollTop(conversationMain[0].scrollHeight);
    }
});

function deleteMessage(messageId) {
    $.ajax({
        url: "/messages/delete", // Укажите правильный URL для вашего маршрута удаления сообщения
        type: "POST",
        data: {
            messageId: messageId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            console.log(data.message);
            location.reload();
        },
        error: function (error) {
            console.error("Ошибка при выполнении запроса", error);
        },
    });
}
