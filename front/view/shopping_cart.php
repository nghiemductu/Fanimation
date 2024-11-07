<?php
session_start();
include 'C:\xampp\htdocs\fanimation\front\view\header.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tính tổng giá tiền
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/shopping_cart.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="fw-bold">YOUR CART</h1>
        <p>TOTAL (<span id="cart-count"><?= count($_SESSION['cart']) ?></span> product)
            <span class="fw-bold" id="cart-total"><?= number_format($total, 0, ',', '.') ?>$</span>
        </p>
        <p>Please check the quantity carefully before ordering</p>

        <div class="row">
            <div class="col-lg-8" id="cart-items">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
    <div class="cart-item d-flex mb-3 p-3 border rounded">
        <?php
        // Đảm bảo đường dẫn đúng của ảnh mặc định
        $default_image_path = "http://localhost/fanimation/img/anh_to_2.jpg";

        // Kiểm tra đường dẫn ảnh trong giỏ hàng và thay thế bằng ảnh mặc định nếu không tồn tại
        $image_path = isset($item['images']) && file_exists($_SERVER['DOCUMENT_ROOT'] . "http://localhost/fanimation/upload/" . $item['images'][0])
            ? "http://localhost/fanimation/upload/" . $item['images'][0]
            : $default_image_path;
        ?>

        <a href="http://localhost/fanimation/front/index.php?act=pd_detail&product_id=1<?php echo $item['id']; ?>">
            <img src="<?php echo $image_path; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: auto;">
        </a>

        <div class="ms-3">
            <h5><?php echo htmlspecialchars($item['name']); ?></h5>
            <p>Price:<?php echo number_format($item['price'], 0, ',', '.'); ?>$</p>
            <div class="quantity-control">
                <button class="btn btn-secondary decrease-quantity" data-id="<?php echo $item['id']; ?>">-</button>
                <input class="quantity" type="number" value="<?php echo $item['quantity']; ?>" style="width:100px">
                <button class="btn btn-secondary increase-quantity" data-id="<?php echo $item['id']; ?>">+</button>
            </div>
            <button class="btn btn-danger btn-sm remove-item" data-id="<?php echo $item['id']; ?>">X</button>
        </div>
    </div>
<?php endforeach; ?>

                <?php else: ?>
                    <p>Your shopping cart is empty.</p>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body position-relative">
                        <button class="btn btn-danger w-100 mb-3" onclick="removeAllItems()">Delete all</button>
                        <h5 class="card-title fw-bold">ORDER SUMMARY</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span id="summary-count"><?= count($_SESSION['cart']) ?> product</span>
                            <span id="summary-total"
                                class="summary-total"><?= number_format($total, 0, ',', '.') ?>$</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Delivery</span>
                            <span>Free of charge</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span class="total-label">Total order amount</span>
                            <span id="final-total"
                                class="summary-total total-value"><?= number_format($total, 0, ',', '.') ?>$</span>
                        </div>
                        <button class="btn btn-dark w-100 mt-3" id="checkout-button">Check out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal cho thông tin thanh toán -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Payment Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="payment-form">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient Name:</label>
                            <input type="text" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-phone" class="col-form-label">Phone number:</label>
                            <input type="tel" class="form-control" id="recipient-phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-address" class="col-form-label">Delivery Address:</label>
                            <input type="text" class="form-control" id="recipient-address" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-custom" id="confirm-checkout">Payment Confirmation</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        // Event listener for quantity update (increase/decrease buttons)
        document.getElementById("cart-items").addEventListener("click", function (e) {
            if (e.target.classList.contains("increase-quantity") || e.target.classList.contains("decrease-quantity")) {
                const productId = e.target.dataset.id;
                const action = e.target.classList.contains("increase-quantity") ? 'increase' : 'decrease';
                updateQuantity(productId, action, e.target);
            }
        });

        // Update quantity in the cart
        function updateQuantity(productId, action, button) {
            fetch('http://localhost/fanimation/front/view/cart_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ action: 'update_quantity', product_id: productId, update_action: action })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const cartItem = button.closest(".cart-item");
                        const quantityInput = cartItem.querySelector(".quantity");
                        quantityInput.value = data.new_quantity;

                        document.getElementById("cart-total").textContent = data.new_total.toLocaleString() + "$";
                        document.getElementById("summary-total").textContent = data.new_total.toLocaleString() + "$";
                        document.getElementById("final-total").textContent = data.new_total.toLocaleString() + "$";
                    } else {
                        console.error(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Remove a single item from the cart
        document.querySelectorAll(".remove-item").forEach(button => {
            button.addEventListener("click", function () {
                const productId = this.dataset.id;
                fetch('http://localhost/fanimation/front/view/cart_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ action: 'remove_item', product_id: productId })
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.status === 'success') {
                            location.reload(); // Reload page to reflect changes
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

        // Remove all items from the cart
        function removeAllItems() {
            fetch('http://localhost/fanimation/front/view/cart_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ action: 'remove_all' })
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        location.reload(); // Reload page if items are removed successfully
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Show checkout modal
        document.getElementById("checkout-button").addEventListener("click", function () {
            var myModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            myModal.show();
        });

        // Confirm and process checkout
        document.getElementById("confirm-checkout").addEventListener("click", function () {
            const totalAmount = parseInt(document.getElementById("final-total").textContent.replace("$", "").replace(",", "")) || 0;
            const name = document.getElementById("recipient-name").value;
            const phone = document.getElementById("recipient-phone").value;
            const address = document.getElementById("recipient-address").value;

            // Validate checkout information
            if (!name || !phone || !address) {
                alert("Please fill in all information to pay.");
                return;
            }

            fetch("http://localhost/fanimation/front/view/cart_handler.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "checkout",
                    total: totalAmount,
                    name: name,
                    phoneNumber: phone,
                    address: address
                })
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === "success") {
                        window.location.reload(); // Reload page after successful checkout
                    }
                })
                .catch(error => console.error("Error:", error));
        });

    </script>
</body>

</html>