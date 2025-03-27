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
        @include('chat.layouts.partials.sidebar', ['users' => $users ?? []])
        <!-- Main content -->
        @include('chat.layouts.partials.main-content', ['user' => $user ?? []])
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
                if(statusElement){
                    element.removeChild(statusElement);
                }
            })
        let btnSent = document.querySelector("#send");
        let message = document.querySelector("#message");
        btnSent.addEventListener('click', function(e) {
            e.preventDefault();    
            axios.post('{{ route('chat.postMessagePrivate', $user->id) }}', {
                message: message.value
            }).then(data => {
                message.value = '';
            })

        })
        
    </script>
@endsection
