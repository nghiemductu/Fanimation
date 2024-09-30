<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanimation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            background-color: #f0f8ff;
        }
        .content {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Fanimation Admin</h1>
    </header>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=danh_muc">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=san_pham">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=them_nguoi_dung">Thêm người dùng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=hidden_items">Mục đã ẩn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=danh_gia_va_phan_hoi_khach_hang">Đánh giá và phản hồi khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?act=don_hang">Đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">