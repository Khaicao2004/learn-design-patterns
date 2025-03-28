@extends('chat.layouts.master')

@section('title')
    Chat App
@endsection

@section('content')
    <div class="row">
        <!-- Header -->
        @include('chat.layouts.partials.header')
    </div>
    <div class="row">
        <!-- Sidebar -->
        @include('chat.layouts.partials.sidebar', [
            'allUsers' => $allUsers ?? [],
            'userReceiver' => $userReceiver,
        ])
        <!-- Main content -->
        @include('chat.layouts.partials.main-content', ['userReceiver' => $userReceiver ?? []])
    </div>
@endsection

@section('style')
@endsection

@section('script')
    <script type="module">
        window.Echo.join('chat')
            .here(users => {
                users.forEach(item => {
                    let element = document.querySelector(`#user-info-${item.id}`);
                    let statusElement = document.createElement("span");
                    statusElement.classList.add('online-indicator', 'position-absolute');
                    if (element) {
                        element.appendChild(statusElement);
                    }
                });
            }).joining(user => {
                let element = document.querySelector(`#user-info-${user.id}`);
                let statusElement = document.createElement("span");
                statusElement.classList.add('online-indicator', 'position-absolute');
                if (element) {
                    element.appendChild(statusElement);
                }
            }).leaving(user => {
                let element = document.querySelector(`#user-info-${user.id}`);
                let statusElement = element.querySelector(".online-indicator");
                if (statusElement) {
                    element.removeChild(statusElement);
                }
            })
        let submitForm = document.querySelector("#chat-form");
        let message = document.querySelector("#message");
        submitForm.addEventListener('submit', function(e) {
            e.preventDefault();
            axios.post('{{ route('chat.postMessagePrivate', $userReceiver->id) }}', {
                message: message.value
            }).then(data => {
                message.value = '';
            })

        })
        document.addEventListener("DOMContentLoaded", function() {
            axios.get('{{ route('private.getPrivateMessages', $userReceiver->id) }}')
                .then(response => {
                    // let messageContentSidebar = document.querySelector("#message-content-sidebar");
                    // let messageTimeSidebar = document.querySelector("#message-time-sidebar");
                    let messages = document.querySelector("#messages");
                    // messageContentSidebar.innerHTML = '';
                    // messageTimeSidebar.innerHTML = '';
                    messages.innerHTML = '';
                    response.data.forEach(message => {
                        addMessageToList({
                            sender_id: message.sender_id,
                            sender: {
                                name: message.sender.name
                            },
                            content: message.content,
                            // created_at: message.created_at
                        });
                    });
                })
                .catch(error => {
                    console.error("Lỗi khi lấy tin nhắn:", error);
                });
        });

        //pusher Auth send
        window.Echo.private('chat-private.{{ Auth::id() }}.{{ $userReceiver->id }}')
            .listen('ChatPrivate', (e) => {
                addMessageToList({
                    sender_id: e.userSend.id,
                    sender: {
                        name: e.userSend.name
                    },
                    content: e.message,
                    // created_at: e.userSend.created_at
                });
            });

        //userReceiver send
        window.Echo.private('chat-private.{{ $userReceiver->id }}.{{ Auth::id() }}')
            .listen('ChatPrivate', (e) => {
                addMessageToList({
                    sender_id: e.userSend.id,
                    sender: {
                        name: e.userSend.name
                    },
                    content: e.message,
                    // created_at: e.userSend.created_at
                });
            });

        function addMessageToList(message) {
            // let messageContentSidebar = document.querySelector("#message-content-sidebar");
            // let messageTimeSidebar = document.querySelector("#message-time-sidebar");
            let messages = document.querySelector("#messages");
            let messageWrapper = document.createElement("div");

            messageWrapper.classList.add("d-flex");
            let messageContent = document.createElement("div");
            messageContent.classList.add("p-2", "border", "rounded");
            messageContent.style.maxWidth = "75%"

            messageContent.textContent = `${message.content}`;
            if (message.sender_id == "{{ Auth::id() }}") {
                // messageContentSidebar.textContent = `Bạn: ${message.content}`;
                // messageTimeSidebar.textContent = `${message.created_at}`;
                messageWrapper.classList.add("justify-content-end");
                messageContent.classList.add("p-2", "bg-primary", "border", "rounded", "text-white");
            } else {
                // messageContentSidebar.textContent = `${message.sender.name}: ${message.content}`;
                // messageTimeSidebar.textContent = `${message.created_at}`;
                messageWrapper.classList.add("justify-content-start");
                messageContent.classList.add("p-2", "bg-light", "border", "rounded");
            }
            messageWrapper.appendChild(messageContent);
            messages.appendChild(messageWrapper);
        }
    </script>
@endsection
