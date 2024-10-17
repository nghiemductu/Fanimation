<?php
// Bắt đầu session nếu chưa bắt đầu để quản lý giỏ hàng hoặc thông tin người dùng
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối cơ sở dữ liệu
require_once 'C:\xampp\htdocs\fanimation\database\connect_db.php';

// Kết nối đến cơ sở dữ liệu và kiểm tra kết nối
$conn = connect_db();
if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu.");
}

// Truy vấn để lấy tất cả dữ liệu từ bảng orders, bao gồm thông tin khách hàng
$orders = $conn->query("
    SELECT orders.*, user.user_name 
    FROM orders 
    JOIN user ON orders.id_khach_hang = user.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Order Management</h2>
    
    <!-- Hiển thị bảng đơn hàng với các cột chi tiết -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order Code</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Receiver</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>Expiry</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                <td><?= htmlspecialchars($order['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['user_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['tong_gia'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['ngay_dat'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['ten_nguoi_nhan'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['so_dien_thoai'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['dia_chi'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['expiry_date'] ?? '') ?></td>
            <td><?= htmlspecialchars($order['status'] ?? '') ?></td>
                <td>
                    <button class="btn btn-info btn-sm view-details" data-id="<?= $order['id'] ?>">View</button>
                    <button class="btn btn-success btn-sm confirm-order" data-id="<?= $order['id'] ?>">Confirm</button>
                    <button class="btn btn-danger btn-sm cancel-order" data-id="<?= $order['id'] ?>">Cancel</button>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Chi Tiết Đơn Hàng -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <div id="order-details-content"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Xem chi tiết đơn hàng
        $('.view-details').click(function() {
            const orderId = $(this).data('id');
            $.post('/fanimation/back/view/don_hang.php', { action: 'view_details', order_id: orderId }, function(response) {
                const result = JSON.parse(response);
                if (result.error) {
                    alert(result.error);
                } else {
                    const order = result.order;
                    const products = result.products;

                    let productListHtml = '<h5>Danh sách sản phẩm</h5><ul>';
                    products.forEach(product => {
                        productListHtml += `<li>${product.ten_sp} - Số lượng: ${product.so_luong} - Giá: ${new Intl.NumberFormat().format(product.gia)}$</li>`;
                    });
                    productListHtml += '</ul>';

                    $('#order-details-content').html(`
                        <p><strong>Order Code:</strong> ${order.id}</p>
                        <p><strong>Customer Name:</strong> ${order.user_name}</p>
                        <p><strong>Total Price:</strong> ${new Intl.NumberFormat().format(order.tong_gia)}$</p>
                        <p><strong>Booking Date:</strong> ${order.ngay_dat}</p>
                        <p><strong>Receiver:</strong> ${order.ten_nguoi_nhan}</p>
                        <p><strong>Phone number:</strong> ${order.so_dien_thoai}</p>
                        <p><strong>Address:</strong> ${order.dia_chi}</p>
                        ${productListHtml}
                    `);
                    $('#orderDetailsModal').modal('show');
                }
            });
        });

        // Xác nhận đơn hàng
        $('.confirm-order').click(function() {
            const orderId = $(this).data('id');
            if (confirm('Are you sure you want to confirm this order?')) {
                $.post('/fanimation/back/view/don_hang.php', { action: 'confirm_order', order_id: orderId }, function(response) {
                    const result = JSON.parse(response);
                    alert(result.message);
                    location.reload();
                });
            }
        });

        // Hủy đơn hàng
        $('.cancel-order').click(function() {
            const orderId = $(this).data('id');
            if (confirm('Are you sure you want to cancel this order?')) {
                $.post('/fanimation/back/view/don_hang.php', { action: 'cancel_order', order_id: orderId }, function(response) {
                    const result = JSON.parse(response);
                    alert(result.message);
                    location.reload();
                });
            }
        });
    });
</script>

</body>
</html>
