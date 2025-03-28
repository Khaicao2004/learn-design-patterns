<style>
    .container .row .header {
        width: 100%;
        height: 10vh;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        height: 90vh;
    }

    .sidebar-body {
        flex-grow: 1;
        overflow-y: auto;
    }

    .main-content {
        height: 90vh;
    }

    .sidebar-item {
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .sidebar-item:hover {
        background: #f1f5f9;
    }

    .media-group {
        display: flex;
        align-items: center;
    }

    .media-image img {
        display: block;
        object-fit: cover;
    }

    .media-text {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .media-text-top,
    .media-text-bot {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .text-typing {
        color: #cbd5e1;
        font-size: 10px;
    }

    .text-name {
        font-size: 14px;
        color: #64748b;
    }

    .text-notification {
        color: #64748b;
        font-size: 12px;
    }

    .text-notification-time {
        color: #64748b;
        font-size: 10px;
    }

    .sidebar-search input {
        height: 38px;
        /* Điều chỉnh chiều cao */
        font-size: 14px;
        /* Giảm kích thước chữ */
        background-color: #f1f5f9;
        /* Nền sáng nhẹ */
        border: none;
        /* Bỏ viền */
        outline: none;
        /* Bỏ viền focus */
    }

    .sidebar-search input:focus {
        background-color: #ffffff;
        /* Khi focus thì nền sáng lên */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng nhẹ */
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .main-content-bot input {
        height: 38px;
        /* Điều chỉnh chiều cao */
        font-size: 14px;
        /* Giảm kích thước chữ */
        background-color: #f1f5f9;
        /* Nền sáng nhẹ */
        border: none;
        /* Bỏ viền */
        outline: none;
        /* Bỏ viền focus */
    }

    .main-content input:focus {
        background-color: #ffffff;
        /* Khi focus thì nền sáng lên */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng nhẹ */
    }

    .sidebar-content,
    .sidebar-list,
    .sidebar-item a {
        text-decoration: none
    }

    .media-image .online-indicator {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 10px;
        height: 10px;
        background: green;
        border-radius: 50%;
        border: 2px solid white;
    }
    .header a{
        text-decoration: none
    }
    .sidebar-list .sidebar-item.active{
        background-color: rgb(191, 191, 191);
    }
</style>
@yield('style')
