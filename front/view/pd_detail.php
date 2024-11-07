<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\xampp\htdocs\fanimation\database\connect_db.php';
require_once 'C:\xampp\htdocs\fanimation\back\model\review.php';


// Kết nối cơ sở dữ liệu
$conn = connect_db();

// Kiểm tra đăng nhập
$logged_in = isset($_SESSION['user_id']);
$user_id = $_SESSION['user_id'] ?? null;

// Lấy thông tin sản phẩm
$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    die("Invalid product ID.");
}

// Hàm lấy thông tin sản phẩm theo ID
function get_product_by_id($id, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$product = get_product_by_id($product_id, $conn);
if (!$product) {
    die("Product does not exist.");
}

// // Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_review') {
    if ($logged_in) {
        $danh_gia = $_POST['danh_gia'] ?? null;
        $binh_luan = $_POST['binh_luan'] ?? null;

        if ($danh_gia && $binh_luan && $product_id && $user_id) {

            // Ghi log để kiểm tra giá trị các biến
            error_log("Product ID: $product_id, User ID: $user_id, Rating: $danh_gia, Comment: $binh_luan");

            if (add_review($product_id, $user_id, $danh_gia, $binh_luan)) {
                $review_status = 'success';
            } else {
                $review_status = 'error';
            }
        } else {
            $review_status = 'missing_data';
        }
    } else {
        $review_status = 'login_required';
    }
}




// Lấy các đánh giá cho sản phẩm hiện tại
$stmt = $conn->prepare("SELECT r.danh_gia, r.binh_luan, r.ngay_bl, u.user_name FROM review r JOIN user u ON r.id_khach_hang = u.id WHERE r.id_san_pham = ?");
$stmt->execute([$product_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy hình ảnh sản phẩm
$images = json_decode($product['images'], true);
$first_image = (!empty($images) && !empty($images[0])) ? htmlspecialchars($images[0]) : '/img/default-product.jpg';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/fanimation/public/css/pd_detail.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php if (isset($product)): ?>
            <div class="row">
                <div class="col-md-6 product-image-container" style="position: relative; ">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <div class="image-wrapper">
                                    <img src="http://localhost/fanimation/upload/<?php echo htmlspecialchars($image); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="d-flex justify-content-start mt-3" style="position: absolute; height:100px; width:calc(100% /  6)">
                        <?php foreach ($images as $index => $image): ?>
                            <img src="http://localhost/fanimation/upload/<?php echo htmlspecialchars($image); ?>" class="img-thumbnail thumbnail-small" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>" onclick="changeImage('<?php echo htmlspecialchars($image); ?>', this)">
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-md-6" style="padding: 0 50px;">
                    <h1><?php echo htmlspecialchars($product['ten_sp']); ?></h1>
                    <h4>Price: <?php echo number_format($product['gia'], 0, ',', '.'); ?>$</h4>
                    <table class="table table-bordered mt-3">
                        <tbody>
                            <tr>
                                <th>Capacity</th>
                                <td><?php echo htmlspecialchars($product['cong_suat']); ?></td>
                            </tr>
                            <tr>
                                <th>Number of wings</th>
                                <td><?php echo htmlspecialchars($product['so_canh']); ?></td>
                            </tr>
                            <tr>
                                <th>Technology</th>
                                <td><?php echo htmlspecialchars($product['cong_nghe']); ?></td>
                            </tr>
                            <tr>
                                <th>Speed</th>
                                <td><?php echo htmlspecialchars($product['toc_do']); ?></td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td><?php echo htmlspecialchars($product['chat_lieu']); ?></td>
                            </tr>
                            <tr>
                                <th>Function</th>
                                <td><?php echo htmlspecialchars($product['chuc_nang']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center mt-3">
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control quantity-input" style="width: 100px; margin-right: 10px;">
                        <button class="market-button add-to-cart specific-add-to-cart" 
                            data-id="<?php echo $product['id']; ?>"
                            data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>"
                            data-price="<?php echo $product['gia']; ?>"
                            data-image="<?php echo $first_image; ?>" >
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-4 border p-3" style="border: 1px solid #ccc; border-radius: 5px;">
                <p><strong>Describe</strong> <?php echo htmlspecialchars($product['mo_ta_sp']); ?></p>
            </div>

            <!-- Phần hiển thị đánh giá -->
            <?php if (isset($review_status)): ?>
                <div class="alert <?php echo $review_status === 'success' ? 'alert-success' : ($review_status === 'error' ? 'alert-danger' : 'alert-warning'); ?>">
                    <?php
                    echo $review_status === 'success' ? "Your review has been noted!" : ($review_status === 'error' ? "An error occurred while submitting the review. Please try again." : ($review_status === 'missing_data' ? "Please fill out complete evaluation information." : "Bạn cần <a href='login.php'>login</a> to rate this product."));
                    ?>
                </div>
            <?php endif; ?>

            <!-- Form gửi đánh giá (chỉ hiển thị khi đã đăng nhập) -->
            <?php if ($logged_in): ?>
                <h2>Product reviews</h2>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="submit_review">
                    <div class="mb-3">
                        <label class="form-label">Evaluate:</label>
                        <div class="star-rating">
                            <input type="radio" name="danh_gia" value="5" id="star-5">
                            <label for="star-5" title="5 sao">&#9733;</label>
                            <input type="radio" name="danh_gia" value="4" id="star-4">
                            <label for="star-4" title="4 sao">&#9733;</label>
                            <input type="radio" name="danh_gia" value="3" id="star-3">
                            <label for="star-3" title="3 sao">&#9733;</label>
                            <input type="radio" name="danh_gia" value="2" id="star-2">
                            <label for="star-2" title="2 sao">&#9733;</label>
                            <input type="radio" name="danh_gia" value="1" id="star-1">
                            <label for="star-1" title="1 sao">&#9733;</label>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment:</label>
                            <textarea id="comment" name="binh_luan" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="market-button review-button">Submit a review</button>
                </form>
            <?php else: ?>
                <p>Please <a href="http://localhost/fanimation/front/view/login.php">log in</a> to submit a review.</p>
            <?php endif; ?>

            <!-- Hiển thị các đánh giá hiện có -->
            <h2 class="mt-5">Reviews from users</h2>
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="border rounded p-3 mb-3">
                        <p><strong>User:</strong> <?php echo htmlspecialchars($review['user_name']); ?></p>
                        <p><strong>Evaluate:</strong> <?php echo $review['danh_gia']; ?> stars</p>
                        <p><strong>Comment:</strong> <?php echo htmlspecialchars($review['binh_luan']); ?></p>
                        <p><small><em>Comment date: <?php echo $review['ngay_bl']; ?></em></small></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>There are no reviews for this product yet.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Product does not exist.</p>
        <?php endif; ?>
        <div class="container mt-5">
            <h2 class="text-center">SIMILAR PRODUCTS</h2>
            <?php
// Fetch similar products
    $similar_products = get_similar_products($product['id_danh_muc'], $product['id'], 8);
    ?>

    <div class="row text-center mt-5">
        <?php if (is_array($similar_products) && count($similar_products) > 0): ?>
            <?php foreach ($similar_products as $similar_product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <?php
                        $images = json_decode($similar_product['images'], true);
                        $first_image = !empty($images) ? 'http://localhost/fanimation/upload/' . $images[0] : '/img/default-product.jpg';
                        ?>
                        <a href="index.php?act=pd_detail&product_id=<?php echo $similar_product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($first_image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($similar_product['ten_sp']); ?>">
                        </a>
                        <div class="card-body text-start">
                            <h5 class="card-title"><?php echo htmlspecialchars($similar_product['ten_sp']); ?></h5>
                            <p class="card-text"><?php echo number_format($similar_product['gia'], 0, ',', '.'); ?>$</p>
                            <a href="#" class="market-button add-to-cart"
                                data-id="<?php echo $similar_product['id']; ?>"
                                data-name="<?php echo htmlspecialchars($similar_product['ten_sp']); ?>"
                                data-price="<?php echo $similar_product['gia']; ?>"
                                data-image="<?php echo $first_image; ?>">Add to cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no similar products.</p>
        <?php endif; ?>
    </div>
 
 
   

    <!-- Bao gồm tập lệnh giỏ hàng -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Use event delegation to handle clicks on all 'add-to-cart' buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-to-cart')) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của trình duyệt

            const button = event.target;
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productPrice = button.getAttribute('data-price');
            const productImage = button.getAttribute('data-image');
            const quantityElement = document.getElementById('quantity');
            const quantity = quantityElement ? quantityElement.value : 1; // Default to 1 if not found

            fetch('http://localhost/fanimation/front/view/cart_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        action: 'add_to_cart',
                        product_id: productId,
                        product_name: productName,
                        product_price: productPrice,
                        product_image: productImage,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                    } else {
                        alert('Lỗi: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
</body>

</html>