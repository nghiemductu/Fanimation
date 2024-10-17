<link rel="stylesheet" href="http://localhost/fanimation/public/css/body.css">
<?php
session_start();
include 'header.php'; 
require_once __DIR__ . '/../model/san_pham.php'; // Đảm bảo rằng bạn đã bao gồm model sản phẩm

$query = isset($_GET['query']) ? $_GET['query'] : ''; // Lấy từ tham số query
$products = []; // Khởi tạo mảng sản phẩm

// Định nghĩa biến đường dẫn cơ sở cho hình ảnh
$imageBasePath = 'http://localhost/fanimation/upload/';

if (!empty($query)) {
    $products = search_products($query); // Gọi hàm tìm kiếm sản phẩm
}
?>

<div class="container mt-5">
    <h2>Search results for: <?php echo htmlspecialchars($query); ?></h2>
    <div class="row my-5">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <?php 
                        $images = json_decode($product['images'], true);
                        // Lấy ảnh đầu tiên hoặc ảnh mặc định
                        $first_image = !empty($images) ? $imageBasePath . $images[0] : '/img/default-product.jpg'; 
                        ?>
                       <a href="pd_detail.php?product_id=<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($first_image); ?>" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>" class="card-img-top">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['ten_sp']); ?></h5>
                            <p class="card-text"><?php echo number_format($product['gia'], 0, ',', '.'); ?>$</p>
                            <a href="#" class="market-button add-to-cart" 
                               data-id="<?php echo $product['id']; ?>" 
                               data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>" 
                               data-price="<?php echo $product['gia']; ?>" 
                               data-image="<?php echo htmlspecialchars($first_image); ?>">Add to cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found matching this keyword.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="http://localhost/fanimation/public/JS/cart.js"></script> <!-- Đảm bảo rằng cart.js được bao gồm -->