@extends('layout')

@section('title')
    Главная
@endsection
@section('main_content')
<div class="container py-5 px-4">

    <header class="text-center">
      <h1 class="display-4 text-white">Bootstrap Chat</h1>
      <p class="text-white lead mb-0">An Awesome chat widget compatible with Bootstrap 4</p>
      <p class="text-white lead mb-4">Snippet by
        <a href="https://gosnippets.com" class="text-white">
          <u>GoSnippets</u></a>
      </p>
    </header>

    <div class="row rounded-lg overflow-hidden shadow">
      <!-- Users box-->
      <div class="col-5 px-0 ">
        <div class="bg-white  users-box">

          <div class="bg-gray px-4 py-2 bg-light">
            <p class="h5 mb-0 py-1">Recent</p>
          </div>

          <div class="messages-box">
            <div class="list-group rounded-0">
              <a class="list-group-item list-group-item-action active text-white rounded-0">
                <div class="media"><img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg" alt="user" width="50" class="rounded-circle">
                  <div class="media-body ml-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                      <h6 class="mb-0">Ravi Raushan</h6><small class="small font-weight-bold">22 Dec</small>
                    </div>
                    <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                  </div>
                </div>
              </a>

              @foreach($chats as $chat)
                <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                    <div class="media"><img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg" alt="user" width="50" class="rounded-circle">
                    <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                        <h6 class="mb-0">{{$chat->topic}}</h6><small class="small font-weight-bold">18 Dec</small>
                        </div>
                        <p class="font-italic text-muted mb-0 text-small">...</p>
                    </div>
                    </div>
                </a>

              @endforeach


            </div>
          </div>
        </div>
      </div>
      <!-- Chat Box-->
      <div class="col-7 px-0">
        <div class="px-4 py-5 chat-box bg-white">
          <!-- Sender Message-->
          <div class="media w-50 mb-3"><img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg" alt="user" width="50" class="rounded-circle">
            <div class="media-body ml-3">
              <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-muted">I am launching a new company</p>
              </div>
              <p class="small text-muted">12:02 PM | 22 Dec</p>
            </div>
          </div>

          <!-- Reciever Message-->
          <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
              <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">I am elite gamer, so what</p>
              </div>
              <p class="small text-muted">12:01 PM | 22 Dec</p>
            </div>
          </div>

          <!-- Sender Message-->
          <div class="media w-50 mb-3"><img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg" alt="user" width="50" class="rounded-circle">
            <div class="media-body ml-3">
              <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-muted">I have done everything great in my life.</p>
              </div>
              <p class="small text-muted">12:00 PM | 22 Dec</p>
            </div>
          </div>

          <!-- Reciever Message-->
          <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
              <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">Millenium Institute of Technology</p>
              </div>
              <p class="small text-muted">12:00 PM | 20 Dec</p>
            </div>
          </div>

          <!-- Sender Message-->
          <div class="media w-50 mb-3"><img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg" alt="user" width="50" class="rounded-circle">
            <div class="media-body ml-3">
              <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-muted">I am the best in my college.</p>
              </div>
              <p class="small text-muted">1:00 PM | 20 Nov</p>
            </div>
          </div>

          <!-- Reciever Message-->
          <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
              <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">Millenium Institute Of Technology and Science </p>
              </div>
              <p class="small text-muted">1:00 PM | 20 Nov</p>
            </div>
          </div>

        </div>

        <!-- Typing area -->
        <form action="#" class="bg-light">
          <div class="input-group">
            <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
            <div class="input-group-append">
              <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>  @endsection
