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
