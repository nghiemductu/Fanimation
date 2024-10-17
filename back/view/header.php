<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanimation - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Roboto:wght@300&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- File JavaScript của bạn -->
    <script src="http://localhost/fanimation/public/JS/sweetalert.js"></script>
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/admin_style.css">
    <!-- Custom CSS -->
    <style>
       
    </style>
</head>
<body>
    <!-- Navbar với icon động và gradient -->
    <nav class="navbar navbar-expand-lg">
        <!-- Icon quạt xoay với tốc độ khác nhau -->
        <i class="fas fa-fan fan-icon fan-icon-1"></i>
        <i class="fas fa-fan fan-icon fan-icon-2"></i>
        <i class="fas fa-fan fan-icon fan-icon-3"></i>
        <i class="fas fa-fan fan-icon fan-icon-4"></i>

        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-fan fa-spin"></i> Fanimation Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=danh_muc">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=san_pham">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=them_nguoi_dung">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=don_hang">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=hidden_items">Hidden item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=danh_gia_va_phan_hoi_khach_hang">Reviews and feedback</a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
