<?php
session_start();
require_once '../../database/connect_db.php'; 
require_once '../model/user.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['pwd'];

    $user = authenticate_user($username, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Điều hướng theo quyền
        if ($user['role'] == 1) {
            header("Location: http://localhost/fanimation/back"); 
        } else {
            header("Location: http://localhost/fanimation/front"); 
        }
        exit;
    } else {
        $_SESSION['error'] = "Username or password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/fanimation/public/css/login&register.css">
    
</head>
<body>
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Nửa trái -->
        <div class="left col-md-6">
            <div class="icon mb-4">
                <i class="bi bi-fan"></i> Fanimation
            </div>
            <h3 class="mb-4">Sign in to your account</h3>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Login name" required>
                    <label for="name">Login name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required>
                    <label for="pwd">Password</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Log in</button>
                <div class="text-center">
                    <a class="link-info" href="#">Forgot password?</a>
                </div>
                <div class="text-center mt-3">
                    <p>Don't have an account yet? <a href="register.php" class="link-info">Register now</a></p>
                </div>
            </form>
        </div>
        <!-- Nửa phải -->
        <div class="right col-md-6">
            <div class="overlay">
                <h1>Welcome to Fanimation!</h1>
                <p>The leading electric fan store for all your cooling needs.</p>
                <p>Experience coolness, modern technology, and dedicated service at Fanimation</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
