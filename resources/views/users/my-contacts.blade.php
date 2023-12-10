
@extends('alina-layout')

@section('title', 'Контакты')

@section('main_content')

<section class="chat-section">
    <div class="chat-container">

        @include('include\sidebar\sidebar') {{-- Сайдбар --}}

        <div class="chat-content">

            @include('include\contacts\contact-menu') {{-- Контакты --}}

            <!-- диалоговое окно дефолт -->
            <div class="conversation conversation-default active">
                <i class="ri-chat-3-line"></i>
                <p>Пора поболтать? Выбери того, кому хочешь написать!</p>
            </div>
            <!-- конец дефолт окна -->
            <!-- диалоговое окно с сообщениями -->
            <div class="conversation" id="conversation-1">
                <div class="conversation-top">
                    <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                    <div class="conversation-user">

                        <div>
                            <div class="conversation-user-name">Илья</div>
                            <div class="conversation-user-status online">online</div>
                        </div>
                    </div>
                    <div class="conversation-buttons">

                        <button type="button"><i class="ri-information-line"></i></button>
                        <button type="button"><i class="ri-close-circle-line"></i></button>
                    </div>
                </div>
                <div class="conversation-main">
                    <ul class="conversation-wrapper">
                        <div class="coversation-divider"><span>Среда</span></div>
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Слушай, а сегодня мы разве не собирались на каток?</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>



                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Взяли официальный комментарий у дизайнера нового лого Яндекс Музыки: Мне пофиг, я так чувствую!</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="conversation-item">
                            <div class="conversation-item-side">

                            </div>
                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Коты-диверсанты закрыли москвичку на холодном балконе в одном халате</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Пушистые злодеи захлопнули дверь за своей 61-летней хозяйкой, когда она буквально на пару мгновений выскочила на балкон. </p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Попытки вернуться в комнату самостоятельно не увенчались успехом, а коты лишь любовались на хозяйку через стекло. Женщина попросила о помощи прохожих, которые вызвали спасателей — пришлось вскрывать дверь, всё закончилось благополучно.</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <div class="coversation-divider"><span>Сегодня</span></div>
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Солнце внезапно «треснуло и порвалось» 🚬
                                                </p>
                                            <div class="conversation-item-time">10:00</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p> На светиле образовалась колоссальная корональная дыра, которая разразилась сильнейшей вспышкой M9.82. </p>
                                            <div class="conversation-item-time">10:00</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Землю ожидает мощная геомагнитная буря и яркие полярные сияния. Помянем всех метеозависимых.</p>
                                            <div class="conversation-item-time">10:00</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="conversation-form">
                    <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                    <div class="conversation-form-group">
                        <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                        <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                    </div>
                    <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                </div>
            </div>
            <div class="conversation" id="conversation-2">
                <div class="conversation-top">
                    <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                    <div class="conversation-user">

                        <div>
                            <div class="conversation-user-name">Даша</div>
                            <div class="conversation-user-status online">online</div>
                        </div>
                    </div>
                    <div class="conversation-buttons">
                        <button type="button"><i class="ri-information-line"></i></button>
                    </div>
                </div>
                <div class="conversation-main">
                    <ul class="conversation-wrapper">
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Подъехали спойлеры на 2024 год: в Китае вспышка нового крайне заразного вируса-мутанта — ежедневно госпитализируют по 7000 человек, также присутствует высокий риск распространения по миру</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Симптомы нового вируса:

                                                — Озноб;
                                                — Высокая температура;
                                                — Образование «узелков» в лёгких;
                                                — Отсутствие кашля.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item">
                                <div class="conversation-item-side">

                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Изначально симптомы проявлялись только у детей, но потом их стали обнаруживать и у взрослых.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Больницы в Пекине и Ляонине переполнены, занятия в школах отменили на неопределённый срок, врачам увеличили количество рабочих часов, а власти Китая пытаются сгладить ситуацию и выяснить происхождение вируса как можно быстрее.</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <div class="coversation-divider"><span>Сегодня</span></div>
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Не ждём, а готовимся 😐</p>
                                            <div class="conversation-item-time">9:28</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Сегодня на удаленке кстати</p>
                                            <div class="conversation-item-time">9:28</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="conversation-form">
                    <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                    <div class="conversation-form-group">
                        <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>

                    </div>
                    <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

