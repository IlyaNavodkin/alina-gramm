$(document).ready(function () {
    document
        .querySelector(".chat-sidebar-profile-toggle")
        .addEventListener("click", function (e) {
            e.preventDefault();
            this.parentElement.classList.toggle("active");
        });

    document
        .getElementById("open-modal")
        .addEventListener("click", function () {
            document.getElementById("profile-modal").classList.add("open");
        });
    document
        .getElementById("close-modal")
        .addEventListener("click", function () {
            document.getElementById("profile-modal").classList.remove("open");
        });

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
});

function deleteProfile() {
    $.ajax({
        url: "/profile/delete",
        type: "DELETE",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            login: login,
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
