<div class="col-9 main-content border d-flex flex-column">
    @if ($userReceiver != null)
        <div class="row main-content-top p-3 border">
            <div class="d-flex align-items-center justify-content-between w-100">
                <!-- Thông tin người dùng -->
                <div class="d-flex align-items-center">
                    <img src="{{ Str::contains($userReceiver->avatar, 'http') ? $userReceiver->avatar : Storage::url($userReceiver->avatar) }}"
                        alt="User Avatar" width="45" height="45" class="rounded-circle me-3" />
                    <div>
                        <h6 class="mb-0">{{ $userReceiver->name }}</h6>
                        <p class="text-success small mb-0">
                            Active now
                        </p>
                    </div>
                </div>

                <!-- Nút gọi thoại & video -->
                <div>
                    <button class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px">
                        <i class="fa-solid fa-phone"></i>
                    </button>
                    <button class="btn btn-light border rounded-circle" style="width: 40px; height: 40px">
                        <i class="fa-solid fa-video"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row main-content-mid flex-grow-1 overflow-auto p-3">
            <div class="d-flex flex-column gap-3" id="messages">
                <!-- Chứa tin nhắn -->
            </div>
        </div>

        <div class="row main-content-bot p-3 border">
            <form id="chat-form">
                <div class="d-flex align-items-center gap-2 w-100">
                    <!-- Icon đính kèm file -->
                    <button class="btn btn-light border rounded-circle btn-circle" title="Đính kèm file">
                        <i class="fa-solid fa-paperclip"></i>
                    </button>
    
                    <!-- Icon emoji -->
                    <button class="btn btn-light border rounded-circle btn-circle" title="Chèn emoji">
                        <i class="fa-regular fa-face-smile"></i>
                    </button>
    
                    <!-- Input nhập tin nhắn -->
                    <input type="text" id="message" class="form-control rounded flex-grow-1" placeholder="Nhập tin nhắn..." />
    
                    <!-- Icon ghi âm -->
                    <button class="btn btn-light border rounded-circle btn-circle" title="Ghi âm">
                        <i class="fa-solid fa-microphone"></i>
                    </button>
    
                    <!-- Icon gửi tin nhắn -->
                    <button class="btn btn-primary rounded-circle btn-circle" title="Gửi tin nhắn" id="send" type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center w-100" style="height: 100%;">
            <p class="text-muted">Hãy chọn một cuộc trò chuyện</p>
        </div>
    @endif
</div>
