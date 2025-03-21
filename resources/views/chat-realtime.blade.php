<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .chat-container {
            width: 100%;
            height: 80vh;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .chat-sidebar {
            width: 30%;
            border-right: 1px solid #ddd;
            overflow-y: auto;
        }

        .chat-sidebar .list-group .list-group-item .avatar-user {
            width: 40px;
            height: 40px;
        }

        .chat-main {
            width: 70%;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background: #f8f9fa;
        }

        .chat-main .chat-header .avatar-user {
            width: 40px;
            height: 40px;
        }

        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
        }

        .chat-input {
            border-top: 1px solid #ddd;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .chat-input textarea {
            flex: 1;
            border: none;
            border-radius: 20px;
            padding: 10px;
            resize: none;
            outline: none;
        }

        .chat-input button {
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="chat-container d-flex">
            <!-- Sidebar -->
            <div class="chat-sidebar p-3">
                <h5>Chats</h5>
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item d-flex align-items-center">
                            <a href="{{ route('chat.show', $user->id) }}" class="text-decoration-none text-dark">
                                <img src="{{ Str::contains($user->avatar, 'http') ? $user->avatar : Storage::url($user->avatar) }}"
                                    class="rounded-circle me-2 avatar-user" alt="User">
                                <span>{{ $user->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Chat Main -->
            <div class="chat-main">
                <div class="chat-header d-flex align-items-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s"
                        class="rounded-circle me-2 avatar-user" alt="User">
                    <span>User A</span>
                </div>
                <div class="chat-messages">
                    <div class="d-flex mb-2">
                        <div class="p-2 bg-primary text-white rounded">Hello!</div>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        <div class="p-2 bg-secondary text-white rounded">Hi there!</div>
                    </div>
                </div>
                <div class="chat-input d-flex">
                    <textarea class="form-control" rows="1" placeholder="Type a message..."></textarea>
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
