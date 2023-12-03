function validateForm() {
    let login = document.getElementById("login").value;
    let email = document.getElementById("email").value;
    let tel = document.getElementById("tel").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    // reset all error messages
    document.getElementById("login-error").textContent = "";
    document.getElementById("email-error").textContent = "";
    document.getElementById("tel-error").textContent = "";
    document.getElementById("password-error").textContent = "";
    document.getElementById("confirmPassword-error").textContent = "";

    // check login
    if (login.length < 3) {
        document.getElementById("login-error").textContent =
            "Логин должен содержать не менее 3 символов";
        return false;
    }

    // check email
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!regexEmail.test(email)) {
        document.getElementById("email-error").textContent =
            "Неправильный формат email";
        return false;
    }

    // check phone number
    let regexPhone = /^[0-9]{10}$/;
    if (!regexPhone.test(tel)) {
        document.getElementById("tel-error").textContent =
            "Неправильный формат телефона";
        return false;
    }

    // check password
    if (password.length < 6) {
        document.getElementById("password-error").textContent =
            "Пароль должен содержать не менее 6 символов";
        return false;
    }
}

// start: Sidebar
document
    .querySelector(".chat-sidebar-profile-toggle")
    .addEventListener("click", function (e) {
        e.preventDefault();
        this.parentElement.classList.toggle("active");
    });

document.addEventListener("click", function (e) {
    if (!e.target.matches(".chat-sidebar-profile, .chat-sidebar-profile *")) {
        document
            .querySelector(".chat-sidebar-profile")
            .classList.remove("active");
    }
});
// end: Sidebar

// start: Coversation
document
    .querySelectorAll(".conversation-item-dropdown-toggle")
    .forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            if (this.parentElement.classList.contains("active")) {
                this.parentElement.classList.remove("active");
            } else {
                document
                    .querySelectorAll(".conversation-item-dropdown")
                    .forEach(function (i) {
                        i.classList.remove("active");
                    });
                this.parentElement.classList.add("active");
            }
        });
    });

document.addEventListener("click", function (e) {
    if (
        !e.target.matches(
            ".conversation-item-dropdown, .conversation-item-dropdown *"
        )
    ) {
        document
            .querySelectorAll(".conversation-item-dropdown")
            .forEach(function (i) {
                i.classList.remove("active");
            });
    }
});

document.querySelectorAll(".conversation-form-input").forEach(function (item) {
    item.addEventListener("input", function () {
        this.rows = this.value.split("\n").length;
    });
});

document.querySelectorAll("[data-conversation]").forEach(function (item) {
    item.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelectorAll(".conversation").forEach(function (i) {
            i.classList.remove("active");
        });
        document
            .querySelector(this.dataset.conversation)
            .classList.add("active");
    });
});

document.querySelectorAll(".conversation-back").forEach(function (item) {
    item.addEventListener("click", function (e) {
        e.preventDefault();
        this.closest(".conversation").classList.remove("active");
        document.querySelector(".conversation-default").classList.add("active");
    });
});
// end: Coversation

document
    .getElementById("open-modal-btn")
    .addEventListener("click", function () {
        document.getElementById("my-modal").classList.add("open");
    });

document
    .getElementById("close-modal-btn")
    .addEventListener("click", function () {
        document.getElementById("my-modal").classList.remove("open");
    });
// пофиксисть потом
document.getElementById("open-modal").addEventListener("click", function () {
    document.getElementById("profile-modal").classList.add("open");
});
document.getElementById("close-modal").addEventListener("click", function () {
    document.getElementById("profile-modal").classList.remove("open");
});

const optionMenu = document.querySelector(".select-menu"),
    selectBtn = optionMenu.querySelector(".select-btn"),
    options = optionMenu.querySelectorAll(".option"),
    sBtnText = optionMenu.querySelector(".sBtn-text");

selectBtn.addEventListener("click", () =>
    optionMenu.classList.toggle("active")
);

options.forEach((option) => {
    option.addEventListener("click", () => {
        let selectedOptoin = option.querySelector(".option-text").innerText;
        sBtnText.innerText = selectedOptoin;
        console.log(option);
    });
});

document
    .querySelector(".submit-changes")
    .addEventListener("click", function () {
        let profileItems = document.querySelectorAll(".profile-item");
        let profileInfo = [];

        profileItems.forEach(function (item) {
            profileInfo.push(item.textContent);
        });

        console.log(profileInfo);
    });
