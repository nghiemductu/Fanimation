<?php
session_start();
require_once 'C:\xampp\htdocs\fanimation\database\connect_db.php'; // Điều chỉnh đường dẫn cho đúng

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pwd']);
    $confirmPassword = trim($_POST['cpwd']);
    
    // Kiểm tra mật khẩu có khớp không
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Password and authentication password do not match.';
        header("Location: register.php");
        exit();
    }

    // Kiểm tra email đã tồn tại chưa
    try {
        $conn = connect_db();
        if ($conn) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE user_name = :user_name");
            $stmt->bindParam(':user_name', $user_name);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $_SESSION['error'] = 'Username already exists. Please choose another username.';
                header("Location: register.php");
                exit();
            }

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Thêm người dùng mới vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO user (user_name, email, password, role, hien_thi_user) VALUES (:user_name, :email, :password, :role, :hien_thi_user)");
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindValue(':role', 'user'); // Thiết lập role là 'user'
            $stmt->bindValue(':hien_thi_user', 1); // Thiết lập hien_thi_user là 1 (hiển thị)

            if ($stmt->execute()) {
                $_SESSION['success'] = 'Registered successfully! You can log in now.';
                header("Location: register.php");
                exit();
            } else {
                $_SESSION['error'] = 'An error occurred during registration.';
            }
            close_db_connection($conn);
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database connection error: " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/login&register.css">

</head>
<body>
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="left col-md-6">
            <div class="icon mb-4">
                <i class="bi bi-fan"></i> Fanimation
            </div>
            <h3 class="mb-4">Register your account</h3>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="User name" required>
                    <label for="name">Tên người dùng</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required>
                    <label for="pwd">Mật khẩu</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="cpwd" name="cpwd" placeholder="Confirm password" required>
                    <label for="cpwd">Xác nhận mật khẩu</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
                <div class="text-center">
                    <p>Already have an account? <a href="login.php" class="link-info">Sign in now!</a></p>
                </div>
            </form>
        </div>
        <div class="right col-md-6">
            <div class="overlay">
                <h1>Welcome to Fanimation</h1>
                <p>The leading electric fan store for all your cooling needs.</p>
                <p>Experience coolness, modern technology, and dedicated service at Fanimation</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
