<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanimation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/header.css">
</head>

<body>
    <div class="container-fluid main-container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="http://localhost/fanimation/front/index.php">
                    <img src="http://localhost/fanimation/img/logo_fanimation.png" alt="Logo" class="img-fluid" style="max-height: 150px;">
                </a>

                <!-- Burger Menu Button (will appear on smaller screens) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu Items (will collapse into burger menu) -->
                <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: end;">
                    

                    <!-- Search Form -->
                    <form class="d-flex" action="http://localhost/fanimation/front/view/search.php" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <!-- User and Cart Icons -->
                    <div class="d-flex ms-3">
                        <?php if (!isset($_SESSION['user'])): ?>
                            <a href="#" class="me-3" onclick="showLoginAlert(event)">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                            <a href="#" class="me-3" onclick="showLoginAlert(event)">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <a href="http://localhost/fanimation/front/view/login.php" class="me-3">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        <?php else: ?>
                            <a href="http://localhost/fanimation/front/view/shopping_cart.php" class="me-3">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                            <a href="http://localhost/fanimation/front/view/favorites.php" class="me-3">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <span class="me-3">
                                <strong><?php echo 'Hello ' . htmlspecialchars($_SESSION['user']['user_name']); ?></strong>
                            </span>
                            <a href="http://localhost/fanimation/front/view/logout.php" class="btn btn-link">
                                Log out
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        // Kiểm tra xem biến $categories có được định nghĩa không
                        if (!isset($categories) || !is_array($categories)) {
                            $categories = []; // Khởi tạo là mảng rỗng nếu không có
                        }
                        ?>
                        <?php foreach ($categories as $category): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <?php echo htmlspecialchars($category['ten_danh_muc']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (!empty($category['children'])): ?>
                                        <?php foreach ($category['children'] as $child): ?>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="http://localhost/fanimation/front/view/category_products.php?category_id=<?php echo $child['id']; ?>">
                                                    <?php echo htmlspecialchars($child['ten_danh_muc']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </div>

    <script>
        function showLoginAlert(event) {
            event.preventDefault();
            alert("You need to log in to use this feature.");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
