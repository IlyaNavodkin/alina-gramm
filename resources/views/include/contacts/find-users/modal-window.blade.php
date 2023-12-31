<div id="my-modal" class="modal ">
    <div class="modal-box">
        <button class="close-btn" id="close-modal-btn"><i class="ri-close-circle-line"></i></button>
        <h2 class="modal-title">
            Введите ник пользователя, которого вы хотите добавить:
        </h2>

        <form id="searchForm" class="content-sidebar-form">
            @csrf
            <input type="search" id="search-login-input" name="login" class="content-sidebar-input" placeholder="Найти...">
            <button type="button" onclick="searchUsers()" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
        </form>

        <div class="search-result">
            <div class="content-messages-list">
                <div class="search-divider"><span>Результаты поиска</span></div>
                <ul id="searchResults"></ul>
            </div>
        </div>
    </div>
</div>
