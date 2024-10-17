<?php
session_start();
// Kết nối cơ sở dữ liệu
require_once 'C:\xampp\htdocs\fanimation\database\connect_db.php';
$conn = connect_db();

if (!$conn) {
    die("Unable to connect to the database.");
}

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Kiểm tra nếu request là POST và có action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    error_log("Action received: " . $action);

    switch ($action) {
        case 'add_to_cart':
            // Lấy thông tin sản phẩm từ POST
            $productId = $_POST['product_id'] ?? null;
            $productName = $_POST['product_name'] ?? null;
            $productPrice = isset($_POST['product_price']) ? (float)$_POST['product_price'] : null;
            $productImage = $_POST['product_image'] ?? '/img/default-product.jpg';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        
            // Kiểm tra thông tin sản phẩm đầy đủ
            if (!$productId || !$productName || !$productPrice) {
                echo json_encode(['status' => 'error', 'message' => 'Product information is incomplete!']);
                exit;
            }
        
            // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
            $productFound = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] === $productId) {
                    $item['quantity'] += $quantity;
                    $productFound = true;
                    break;
                }
            }
        
            // Thêm sản phẩm mới nếu chưa có trong giỏ hàng
            if (!$productFound) {
                $_SESSION['cart'][] = [
                    'id' => $productId,
                    'name' => $productName,
                    'price' => $productPrice,
                    'image' => $productImage,
                    'quantity' => $quantity
                ];
            }
        
            echo json_encode(['status' => 'success', 'message' => 'Product has been added to cart!']);
            break;

            case 'remove_all':
                $_SESSION['cart'] = [];
                echo json_encode(['status' => 'success', 'message' => 'The shopping cart has been successfully deleted.']);
                break;
    
            case 'remove_item':
                $productId = $_POST['product_id'] ?? null;
                if ($productId && isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
                        return $item['id'] !== $productId;
                    });
                    echo json_encode(['status' => 'success', 'message' => 'The product has been removed from the cart.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No products found to delete.']);
                }
                break;

                case 'update_quantity':
                    $productId = $_POST['product_id'] ?? null;
                    $updateAction = $_POST['update_action'] ?? null;
        
                    if ($productId && isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as &$item) {
                            if ($item['id'] === $productId) {
                                if ($updateAction === 'increase') {
                                    $item['quantity']++;
                                } elseif ($updateAction === 'decrease' && $item['quantity'] > 1) {
                                    $item['quantity']--;
                                }
                                break;
                            }
                        }
        
                        $newTotal = array_reduce($_SESSION['cart'], function ($sum, $item) {
                            return $sum + ($item['price'] * $item['quantity']);
                        }, 0);
        
                        echo json_encode([
                            'status' => 'success',
                            'new_quantity' => $item['quantity'],
                            'new_total' => $newTotal
                        ]);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'No products found to update.']);
                    }
                    break;
        
            case 'checkout':
                // Kiểm tra xem giỏ hàng có trống không
                if (empty($_SESSION['cart'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Cart is empty. Unable to pay.']);
                    exit;
                }
            
                // Tiếp tục xử lý thanh toán nếu giỏ hàng có sản phẩm
                $total = $_POST['total'] ?? 0;
                $name = $_POST['name'] ?? '';
                $phone = $_POST['phoneNumber'] ?? '';
                $address = $_POST['address'] ?? '';
                $user_id = $_SESSION['user_id'] ?? null;
                $expiry_date = date('Y-m-d H:i:s', strtotime('+30 days'));
                $status = 'Pending';
            
                if ($conn) {
                    try {
                        // Bắt đầu transaction
                        $conn->beginTransaction();
            
                        // Thêm thông tin đơn hàng vào bảng `orders`
                        $stmt = $conn->prepare("INSERT INTO orders (id_khach_hang, ngay_dat, tong_gia, ten_nguoi_nhan, so_dien_thoai, dia_chi, expiry_date, status) VALUES (:user_id, NOW(), :total, :name, :phone, :address, :expiry_date, :status)");
                        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
                        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                        $stmt->bindParam(':expiry_date', $expiry_date, PDO::PARAM_STR);
                        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                        $stmt->execute();
            
                        // Lấy `id` của đơn hàng vừa thêm
                        $orderId = $conn->lastInsertId();
            
                        // Thêm từng sản phẩm trong giỏ hàng vào bảng `chi_tiet_orders`
                        $stmt = $conn->prepare("INSERT INTO chi_tiet_orders (order_id, id_sp, so_luong, gia, tong_gia_tam_thoi) VALUES (:order_id, :id_sp, :so_luong, :gia, :tong_gia_tam_thoi)");
                        foreach ($_SESSION['cart'] as $item) {
                            $tong_gia_tam_thoi = $item['price'] * $item['quantity'];
                            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                            $stmt->bindParam(':id_sp', $item['id'], PDO::PARAM_INT);
                            $stmt->bindParam(':so_luong', $item['quantity'], PDO::PARAM_INT);
                            $stmt->bindParam(':gia', $item['price'], PDO::PARAM_STR);
                            $stmt->bindParam(':tong_gia_tam_thoi', $tong_gia_tam_thoi, PDO::PARAM_STR);
                            $stmt->execute();
                        }
            
                        // Hoàn tất transaction
                        $conn->commit();
            
                        // Xóa giỏ hàng sau khi thanh toán thành công
                        $_SESSION['cart'] = [];
            
                        echo json_encode(['status' => 'success', 'message' => 'Payment successful!']);
                    } catch (PDOException $e) {
                        $conn->rollBack();
                        error_log("Lỗi thanh toán: " . $e->getMessage());
                        echo json_encode(['status' => 'error', 'message' => 'Error processing payment.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Database connection error.']);
                }
                break;
            

        default:
            echo json_encode(['status' => 'error', 'message' => "Invalid action: $action"]);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'The request method is invalid or there is no action.']);
}
?>
