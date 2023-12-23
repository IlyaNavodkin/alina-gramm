$(document).ready(function () {
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
});

function searchUsers() {
    var login = $("#search-login-input").val();
    console.log(login);
    $.ajax({
        url: "/users/findByLogin",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            login: login,
        },
        success: function (data) {
            // const searchResults = data;
            $("#searchResults").html(data);
        },
        error: function (error) {
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
            console.log(data.message);
            location.reload();
        },
        error: function (error) {
            console.error("Ошибка при выполнении запроса", error);
        },
    });
}
