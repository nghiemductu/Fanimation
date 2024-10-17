<?php
function add_user($username, $password, $email) {
    $conn = connect_db();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (user_name, password, email, role, hien_thi_user) VALUES (:username, :password, :email, 1, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);
    return $stmt->execute();
}

function get_all_users() {
    $conn = connect_db();
    $sql = "SELECT id, user_name, email FROM user WHERE role = 0 AND hien_thi_user = 1 ORDER BY id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function hide_user($id) {
    $conn = connect_db();
    $sql = "UPDATE user SET hien_thi_user = 0 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function get_hidden_users() {
    $conn = connect_db();
    $sql = "SELECT id, user_name, email FROM user WHERE hien_thi_user = 0 ORDER BY id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function restore_user($id) {
    $conn = connect_db();
    $sql = "UPDATE user SET hien_thi_user = 1 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}


// Hàm thêm vào để test gửi bình luận lên db
function get_user_by_username($username) {
    $conn = connect_db();
    $sql = "SELECT * FROM user WHERE user_name = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result : false;
}
?>