<?php
session_start();
include 'header.php';
require_once __DIR__ . '/../model/danh_muc.php';
require_once __DIR__ . '/../model/san_pham.php';
require_once __DIR__ . '/../view/pagination.php'; // Nạp hàm phân trang

// Kiểm tra và khởi tạo các biến
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Xác định thứ tự sắp xếp mặc định
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
$order_by = ($order === 'desc') ? 'DESC' : 'ASC';

// Lấy sản phẩm theo danh mục và tên danh mục
$products = get_products_by_category($category_id, $offset, $limit, $order_by);
$category_name = get_category_name($category_id);
$total_products = get_total_products_by_category($category_id);
$total_pages = ceil($total_products / $limit);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product categories -<?php echo htmlspecialchars($category_name); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/category_products.css">

</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Products in category: <?php echo htmlspecialchars($category_name); ?></h2>
            <form method="GET" class="form-inline">
                <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category_id); ?>">
                <select name="order" class="form-control" onchange="this.form.submit()">
                    <option value="asc" <?php echo ($order === 'asc') ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="desc" <?php echo ($order === 'desc') ? 'selected' : ''; ?>>Price: High to Low</option>
                </select>
            </form>
        </div>

        <div class="row">
            <?php if (!empty($products) && is_array($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <?php
                            $images = json_decode($product['images'], true);
                            $first_image = !empty($images) ? 'http://localhost/fanimation/upload/' . $images[0] : '/img/default-product.jpg';
                            ?>
                            <a href="../index.php?act=pd_detail&product_id=<?php echo $product['id']; ?>">
                                <img src="<?php echo htmlspecialchars($first_image); ?>" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['ten_sp']); ?></h5>
                                <p class="card-text"><?php echo number_format($product['gia'], 0, ',', '.'); ?>$</p>
                                <a href="#" class="market-button add-to-cart"
                                    data-id="<?php echo $product['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>"
                                    data-price="<?php echo $product['gia']; ?>"
                                    data-image="<?php echo $first_image; ?>">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">There are no products in this category.</p>
            <?php endif; ?>
        </div>
        <?php renderPagination($page, $total_pages, $category_id); ?>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Phần JavaScript xử lý thêm vào giỏ hàng -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const productId = this.dataset.id;
                    const productName = this.dataset.name;
                    const productPrice = this.dataset.price;
                    const productImage = this.dataset.image;

                    fetch('/fanimation/front/view/cart_handler.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'add_to_cart',
                                product_id: productId,
                                product_name: productName,
                                product_price: productPrice,
                                product_image: productImage
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert(data.message); // Hiển thị thông báo
                            } else {
                                alert('An error occurred while adding to cart!');
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });
    </script>
</body>

</html>
