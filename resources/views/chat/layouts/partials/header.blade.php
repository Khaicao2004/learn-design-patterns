<div class="header border-bottom px-3 py-2 d-flex justify-content-between align-items-center">
    <!-- Logo hoặc Tên ứng dụng -->
    <a href="{{ route('chat.index') }}">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-comments fs-5 text-primary"></i>
            <h5 class="mb-0">ChatApp</h5>
        </div>
    </a>
    <!-- Các icon thông báo & profile -->
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light border rounded-circle" style="width: 40px; height: 40px">
            <i class="fa-solid fa-bell"></i>
        </button>
        <button class="btn btn-light border rounded-circle" style="width: 40px; height: 40px">
            <i class="fa-solid fa-user"></i>
        </button>
    </div>
</div>