<div class="col-3 border sidebar">
    <div class="sidebar-head d-flex py-2 px-2 justify-content-between align-items-center">
        <div class="sidebar-head-text">
            <h3>Chats</h3>
        </div>
        <div class="sidebar-head-tools">
            <button class="btn btn-primary rounded-circle">
                Abc
            </button>
        </div>
    </div>
    <div class="sidebar-search py-2 px-2">
        <div class="position-relative">
            <i
                class="fa-solid fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            <input type="text" class="rounded-pill form-control ps-5" placeholder="Search..." />
        </div>
    </div>
    <div class="sidebar-body">
        <div class="sidebar-content py-3">
            <ul class="sidebar-list list-unstyled">
                @foreach ($users as $user)
                    <li class="sidebar-item py-2">
                        <a href="{{ route('chat.chatPrivate', $user->id) }}" id="link-{{ $user->id }}">
                            <div class="media-group d-flex align-items-center gap-3">
                                <!-- Avatar -->
                                <div class="media-image position-relative" id="user-info-{{$user->id}}">
                                    <img src="{{ Str::contains($user->avatar, 'http') ? $user->avatar : Storage::url($user->avatar) }}"
                                        alt="" width="45" height="45" class="rounded-pill" />
                                    {{-- <span class="online-indicator position-absolute"></span> --}}
                                </div>
                                <!-- Nội dung -->
                                <div class="media-text w-100">
                                    <div
                                        class="media-text-top d-flex justify-content-between align-items-center">
                                        <h6 class="text-name m-0">
                                            {{ $user->name }}
                                        </h6>
                                        <span class="text-typing">Typing...</span>
                                    </div>
                                    <div
                                        class="media-text-bot d-flex justify-content-between align-items-center">
                                        <p class="text-notification m-0 text-truncate" style="max-width: 80%">
                                            Had they visited Rome before
                                        </p>
                                        <span class="text-notification-time">45 min</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>