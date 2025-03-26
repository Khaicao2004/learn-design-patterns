@extends('layouts.app')

@section('style')
    <style>
        .item img {
            width: 50px;
            height: 50px;
            border-radius: 50%
        }

        .item a {
            padding: 15px;
            display: block;
            position: relative;
            text-decoration: none;
            color: black
        }

        .item a:hover {
            color: white;
            text-transform: none;
            background: rgb(231, 102, 102);
            border-radius: 5px;
        }

        .status {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: green;
            top: 10px;
            left: 10px;
        }

        .my-message {
            text-align: right;
            color: blue;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1>{{ $group->name }}</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="row border">
                    <div class="col-md-12 item mt-3 bg-info">
                        <a id="link-{{ $leader->id }}">
                            <img src="{{ Str::contains($leader->avatar, 'http') ? $leader->avatar : Storage::url($leader->avatar) }}"
                                alt="">
                            <p>{{ $leader->name }}</p>
                        </a>
                    </div>
                    @foreach ($members as $member)
                        <div class="col-md-12 item mt-3">
                            <a href="{{ route('chat.chatPrivate', $member->id) }}" id="link-{{ $member->id }}">
                                <img src="{{ Str::contains($member->avatar, 'http') ? $member->avatar : Storage::url($member->avatar) }}"
                                    alt="">
                                <p>{{ $member->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <div class="row border">
                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height: 40vh"></ul>
                    <form class="border-top">
                        <div class="row py-3">
                            <div class="col-10">
                                <input type="text" id="message" class="form-control">
                            </div>
                            <div class="col-2">
                                <button id="send" type="submit" class="btn btn-primary w-100">Gui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        window.Echo.join('chat')
            .here(users => {
                users.forEach(item => {
                    let element = document.querySelector(`#link-${item.id}`);
                    let statusElement = document.createElement("div");
                    statusElement.classList.add('status');
                    if (element) {
                        element.appendChild(statusElement);
                    }
                });
            }).joining(user => {
                let element = document.querySelector(`#link-${user.id}`);
                let statusElement = document.createElement("div");
                statusElement.classList.add('status');
                if (element) {
                    element.appendChild(statusElement);
                }
            }).leaving(user => {
                let element = document.querySelector(`#link-${user.id}`);
                let statusElement = element.querySelector(".status");
                if (statusElement) {
                    element.removeChild(statusElement);
                }
            }).listen('UserOnline', e => {
                let messages = document.querySelector("#messages");
                let itemElement = document.createElement("li");
                itemElement.textContent = `${e.user.name}: ${e.message}`;
                if (e.user.id == "{{ Auth::id() }}") {
                    itemElement.classList.add("my-message");
                }
                messages.appendChild(itemElement);
            })

        let btnSent = document.querySelector("#send");
        let message = document.querySelector("#message");

        btnSent.addEventListener('click', function(e) {
            e.preventDefault();
            axios.post('{{ route('chat.postMessageGroup') }}', {
                message: message.value,
                groupId: "{{ $group->id }}",
            }).then(data => {
                message.value = '';
            })

        })
    </script>

    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            axios.get('{{ route('group.getGroupMessages', $group->id) }}')
                .then(response => {
                    let messages = document.querySelector("#messages");
                    messages.innerHTML = '';

                    response.data.forEach(message => {
                        addMessageToList(message);
                    });
                })
                .catch(error => {
                    console.error("Lỗi khi lấy tin nhắn:", error);
                });
        });
        window.Echo.private('chat-group.{{ $group->id }}')
            .listen('ChatGroup', e => {
                addMessageToList({
                    sender: {
                        name: e.user.name
                    },
                    content: e.message,
                    sender_id: e.user.id
                });
            })

        function addMessageToList(message) {
            let messages = document.querySelector("#messages");
            let itemElement = document.createElement("li");

            itemElement.textContent = `${message.sender.name}: ${message.content}`;

            if (message.sender_id == "{{ Auth::id() }}") {
                itemElement.classList.add("my-message");
            }

            messages.appendChild(itemElement);
        }
    </script>
@endsection
