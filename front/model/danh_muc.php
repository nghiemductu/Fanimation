<?php
// function get_categories_hierarchical() {
//     $conn = connect_db();
//     $sql = "SELECT * FROM category"; // Lấy tất cả danh mục
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // Tổ chức danh mục thành cấu trúc phân cấp
//     $category_tree = [];
//     foreach ($categories as $category) {
//         $category_tree[$category['id']] = $category;
//         $category_tree[$category['id']]['children'] = []; // Thêm trường children
//     }

//     foreach ($categories as $category) {
//         if ($category['parent_id'] != 0) {
//             $category_tree[$category['parent_id']]['children'][] = &$category_tree[$category['id']];
//         }
//     }

//     return array_filter($category_tree, function($category) {
//         return $category['parent_id'] == 0; // Chỉ trả về danh mục gốc
//     });
// }

function get_category_name($category_id) {
    $conn = connect_db();
    $sql = "SELECT ten_danh_muc FROM category WHERE id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn(); 
}

function get_total_products_by_category($category_id) {
    $conn = connect_db();
    $sql = "SELECT COUNT(*) FROM products WHERE id_danh_muc = :category_id AND hien_thi_sp = 1"; // Đếm số sản phẩm hiển thị
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn(); 
}
?>