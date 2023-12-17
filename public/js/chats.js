$(document).ready(function () {
    var conversationMain = $(".conversation-main");

    if (conversationMain.length > 0) {
        conversationMain.scrollTop(conversationMain[0].scrollHeight);
    }

    var openModalBtn = document.getElementById("open-modal-btn");

    if (openModalBtn) {
        openModalBtn.addEventListener("click", function () {
            var myModal = document.getElementById("my-modal");

            if (myModal) {
                myModal.classList.add("open");
            }
        });
    }

    var closeModalBtn = document.getElementById("close-modal-btn");

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            var myModal = document.getElementById("my-modal");

            if (myModal) {
                myModal.classList.remove("open");
            }
        });
    }

    var openProfileModalBtn = document.getElementById("open-modal");

    if (openProfileModalBtn) {
        openProfileModalBtn.addEventListener("click", function () {
            var myModal = document.getElementById("my-modal");
            console.log("Нажал на кнопку профиля");

            if (myModal) {
                myModal.classList.add("open");
            }
        });
    }

    var closeProfileModalBtn = document.getElementById("close-modal");

    if (closeProfileModalBtn) {
        closeProfileModalBtn.addEventListener("click", function () {
            var myModal = document.getElementById("my-modal");

            if (myModal) {
                myModal.classList.remove("open");
            }
        });
    }

    // document
    //     .querySelector(".chat-sidebar-profile-toggle")
    //     .addEventListener("click", function (e) {
    //         e.preventDefault();
    //         this.parentElement.classList.toggle("active");
    //     });

    // document.addEventListener("click", function (e) {
    //     if (
    //         !e.target.matches(".chat-sidebar-profile, .chat-sidebar-profile *")
    //     ) {
    //         document
    //             .querySelector(".chat-sidebar-profile")
    //             .classList.remove("active");
    //     }
    // });
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
            // Обработка успешного ответа от сервера
            console.log(data.message);
            location.reload();
        },
        error: function (error) {
            // Обработка ошибок при выполнении запроса
            console.error("Ошибка при выполнении запроса", error);
        },
    });
}

function searchUsers() {
    var login = $("#login").val(); // Получите значение из поля ввода

    // Отправьте запрос на сервер с использованием AJAX
    $.ajax({
        url: "/users/findByLogin", // Замените на фактический путь к вашему обработчику поиска пользователей
        type: "POST", // Или 'GET', в зависимости от вашего обработчика
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"), // Добавление CSRF-токена
            login: login,
        },
        success: function (data) {
            // Обработка успешного ответа от сервера
            // Например, обновление содержимого блока с результатами поиска
            $(".search-result ul").html(data);
        },
        error: function (error) {
            // Обработка ошибок при выполнении запроса
            console.error("Ошибка при выполнении запроса", error);
        },
    });
}

function sendFriendRequest(userId) {
    $.ajax({
        url: "/contacts/create",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            userId: userId,
        },
        success: function (data) {
            // Обработка успешного ответа от сервера
            console.log(data.message);
            location.reload();
        },
        error: function (error) {
            // Обработка ошибок при выполнении запроса
            console.error("Ошибка при выполнении запроса", error);
        },
    });
}

// Фильтрует активные контакты чата по названию в поиске

document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.querySelector(".content-sidebar-input");
    var listItems = document.querySelectorAll(
        ".content-messages-list li[data-login]"
    );

    searchInput.addEventListener("input", function () {
        var searchTerm = searchInput.value.toLowerCase();

        listItems.forEach(function (item) {
            var loginValue = item.getAttribute("data-login").toLowerCase();

            if (loginValue.includes(searchTerm)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
});

// // Отправляет ajax запрос на поиск пользователей

// function searchUsers() {
//     var login = document.getElementById("login").value;
//     var url = "/users/findByLogin";

//     // Получение токена CSRF из мета-тега
//     var csrfToken = $('meta[name="csrf-token"]').attr("content");

//     // Выполнение AJAX-запроса с токеном CSRF
//     $.ajax({
//         type: "POST",
//         url: url,
//         data: { login: login },
//         headers: { "X-CSRF-TOKEN": csrfToken },
//         success: function (data) {
//             if (data.users.length > 0) {
//                 console.log("Нету");
//                 // Генерация HTML для каждого пользователя
//                 var html = "<ul>";
//                 data.users.forEach(function (user) {
//                     html += "<li>";
//                     html += '<a href="#">';
//                     html +=
//                         '<img class="content-message-image" src="' +
//                         user.avatar +
//                         '" alt="">';
//                     html += '<span class="content-message-info">';
//                     html +=
//                         '<span class="content-message-name">' +
//                         user.login +
//                         "</span>";
//                     html += "</span>";
//                     // Добавление кнопки с отправкой запроса и id пользователя
//                     html +=
//                         '<button class="add-friend" onclick="sendFriendRequest(' +
//                         user.id +
//                         ')">Отправить запрос</button>';
//                     html += "</a>";
//                     html += "</li>";
//                 });
//                 html += "</ul>";

//                 // Обновление части страницы с результатами
//                 $("#searchResults").html(html);
//             } else {
//                 console.log("Пусто");
//                 // Вывод сообщения, если нет пользователей
//                 $("#searchResults").html("<p>No users found.</p>");
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//             // Вывод сообщения об ошибке на странице
//             $("#errorMessage").html(
//                 "<p>Error occurred. Please try again later.</p>"
//             );
//         },
//     });
// }

// // Функция для отправки запроса на добавление в друзья с использованием id пользователя
// function sendFriendRequest(userId) {
//     var url = "/contacts/create"; // Замените на ваш путь к обработчику запроса на сервере

//     // Получение токена CSRF из мета-тега
//     var csrfToken = $('meta[name="csrf-token"]').attr("content");

//     // Выполнение AJAX-запроса с токеном CSRF и id пользователя
//     $.post(url, { userId: userId, _token: csrfToken }, function (response) {
//         // Обновление элемента с сообщением об успехе или ошибке
//         if (response.error) {
//             // Если есть ошибка, выводим сообщение об ошибке
//             $("#errorMessage").html("<p>" + response.error + "</p>");
//         } else {
//             // В противном случае, выводим сообщение об успехе
//             $("#successMessage").html("<p>" + response.message + "</p>");
//         }
//     }).fail(function (xhr) {
//         // Обработка ошибок при отправке запроса на добавление в друзья
//         console.error(xhr.responseText);

//         var decodedError = $("<div/>").html(xhr.responseJSON.error).text();

//         // Вывод сообщения об ошибке на странице
//         $("#errorMessage").html("<p>" + decodedError + "</p>");
//     });
// }
