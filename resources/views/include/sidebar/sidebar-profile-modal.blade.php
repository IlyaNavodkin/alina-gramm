<div id="profile-modal" class="modal ">
    <div class="modal-box">
        <button class="close-btn" id="close-modal"><i class="ri-close-circle-line"></i></button>
        <h2 class="modal-title">
            Профиль
        </h2>
        <div class="search-result">
            <div class="profile-list">
                <img class="profile-image" src={{ asset($activeUser->avatar) }} alt="">
                <!-- Тут инпут на кнопке  -->
                <div class="select-menu">
                    <form class="select-btn" action="{{ route('users.uploadAvatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

                        <div class="mb-3 uploade-img">
                            <input class="sBtn-text" type="file" name="image" id="image" accept="image/*">
                            {{-- <button class="submit-changes submit-img" type="submit">Загрузить</button> --}}
                            <button class=" submit-img" type="submit"><i class="ri-upload-line"></i></button>
                        </div>

                    </form>
                </div>




                    <div class="content-messages-list">
                        <span class="profile-info">
                            {{-- <span class="profile-item" contenteditable="true">{{$activeUser->login}}</span>
                            <span class="profile-item" contenteditable="true">{{$activeUser->email}}</span>
                            <span class="profile-item" contenteditable="true">{{$activeUser->phone}}</span> --}}


                            <form method="post" action="/users/edit">
                                @csrf

                                <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

                                <div class="mb-3">
                                    <label for="login" class="form-label">Логин:</label>

                                    <input type="text" name="login" id="login" placeholder="Введите login" class="profile-item" contenteditable="true"
                                    value="{{ $activeUser->login }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail:</label>

                                    <input type="email" name="email" id="email" placeholder="Введите email" class="profile-item" contenteditable="true"
                                    value="{{ $activeUser->email }}">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>

                                    <input type="text" name="phone" id="phone" placeholder="Введите phone" class="profile-item" contenteditable="true"
                                    value="{{ $activeUser->phone }}">
                                </div>



                                </span>
                                <span class="but">

                                <button type="submit" class="submit-changes">Сохранить изменения</button>

                            </form>
                            <form method="get" action="/profile/delete">
                                @csrf
                                <button type="submit" id="delete-account-btn" class="delete-account" >Удалить аккаунт</button>
                            </form>

                        </span>
                    </div>

            </div>
        </div>
    </div>
</div>
