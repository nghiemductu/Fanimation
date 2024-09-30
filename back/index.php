<?php
session_start();
ob_start();
include "../database/connect_db.php";
include "model/danh_muc.php";
include "model/san_pham.php";
include "model/user.php";  



connect_db();  
include "view/header.php";

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        
        case 'danh_muc':
            $kq = getall_dm();
            include "view/danh_muc.php";
            break;
        
        case 'adding_category':
            if(isset($_POST['add_new'])){
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $parent_id = $_POST['parent_id'];
                add_category($ten_danh_muc, $parent_id);
            }
            header("Location: index.php?act=danh_muc");
            break;
        
        case 'update_category':
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $dm = get_category($id);
                $kq = getall_dm();
                include "view/update_category.php";
            }
            if(isset($_POST['update'])){
                $id = $_POST['id'];
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $parent_id = $_POST['parent_id'];
                update_category($id, $ten_danh_muc, $parent_id);
                header("Location: index.php?act=danh_muc");
            }
            break;
        
        case 'delete_category':
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                delete_category($id);
            }
            header("Location: index.php?act=danh_muc");
            break;

        case 'restore_category':
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                restore_category($id);
            }
            header("Location: index.php?act=muc_an.php");
            break;


        case 'san_pham':
            $dsdm = getall_dm();
            $limit = 1; // Số sản phẩm trên mỗi trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $limit;
    
            $total_products = count_san_pham();
            $total_pages = ceil($total_products / $limit);
            
            $kq = get_products_paginated($start, $limit);
            include "view/san_pham.php";
            break;
        

        case 'add_san_pham':
            if(isset($_POST['add_new'])) {
                $ten_sp = $_POST['ten_sp'];
                $gia = $_POST['gia'];
                $id_danh_muc = $_POST['id_dm'];
                $mo_ta_sp = $_POST['mo_ta_sp'];
                $so_luong_hang = $_POST['so_luong_hang'];
                $cong_suat = $_POST['cong_suat'];
                $cong_nghe = $_POST['cong_nghe'];
                $chat_lieu = $_POST['chat_lieu'];
                $chuc_nang = $_POST['chuc_nang'];
                $so_canh = $_POST['so_canh'];
                $toc_do = $_POST['toc_do'];
                            
                    $images = array();
                    if(isset($_FILES['imgs'])) {
                        $file_count = count($_FILES['imgs']['name']);
                        for($i = 0; $i < $file_count; $i++) {
                            if($_FILES['imgs']['error'][$i] == 0) {
                                $target_dir = "../upload/";
                                $target_file = $target_dir . basename($_FILES["imgs"]["name"][$i]);
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                $newFileName = uniqid() . '.' . $imageFileType;
                                $target_file = $target_dir . $newFileName;
                                if (move_uploaded_file($_FILES["imgs"]["tmp_name"][$i], $target_file)) {
                                    $images[] = $target_file;
                                }
                            }
                        }
                    }
                            
                    insert_product($id_danh_muc, $ten_sp, $gia, $so_luong_hang, $mo_ta_sp, $images, $cong_suat, $cong_nghe, $chat_lieu, $chuc_nang, $so_canh, $toc_do);
                    header("Location: index.php?act=san_pham");
                }
                break;
        

            case 'update_san_pham':
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sp = get_product($id);
                    $dsdm = getall_dm();
                    include "view/update_san_pham.php";
                }
                if(isset($_POST['update'])){
                    $id = $_POST['id'];
                    $ten_sp = $_POST['ten_sp'];
                    $gia = $_POST['gia'];
                    $so_luong_hang = $_POST['so_luong_hang'];
                    $mo_ta_sp = $_POST['mo_ta_sp'];
                    $id_danh_muc = $_POST['id_dm'];
                    $cong_suat = $_POST['cong_suat'];
                    $cong_nghe = $_POST['cong_nghe'];
                    $chat_lieu = $_POST['chat_lieu'];
                    $chuc_nang = $_POST['chuc_nang'];
                    $so_canh = $_POST['so_canh'];
                    $toc_do = $_POST['toc_do'];
                        
                    $images = array();
                        if(isset($_FILES['imgs'])) {
                            $file_count = count($_FILES['imgs']['name']);
                            for($i = 0; $i < $file_count; $i++) {
                                if($_FILES['imgs']['error'][$i] == 0) {
                                    $target_dir = "../upload/";
                                    $target_file = $target_dir . basename($_FILES["imgs"]["name"][$i]);
                                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                    $newFileName = uniqid() . '.' . $imageFileType;
                                    $target_file = $target_dir . $newFileName;
                                    if (move_uploaded_file($_FILES["imgs"]["tmp_name"][$i], $target_file)) {
                                        $images[] = $target_file;
                                    }
                                }
                            }
                        }
                        
                    $images_json = !empty($images) ? json_encode($images) : "";
                        
                    update_product($id, $ten_sp, $gia, $so_luong_hang, $mo_ta_sp, $id_danh_muc, $cong_suat, $cong_nghe, $chat_lieu, $chuc_nang, $so_canh, $toc_do, $images_json);
                    header("Location: index.php?act=san_pham");
                    }
                break;

            case 'delete_product':
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    delete_product($id);
                }
                header("Location: index.php?act=san_pham");
                break;
            
            case 'restore_product':
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    restore_product($id);
                }
                header("Location: index.php?act=muc_an.php");
                break;

            case 'them_nguoi_dung':
                if(isset($_POST['add_user'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    $email = $_POST['email'];
                        
                    if($password !== $confirm_password) {
                        $error = "Mật khẩu và xác nhận mật khẩu không khớp!";
                    } else {
                        $result = add_user($username, $password, $email);
                            
                        if($result) {
                            $success = "Thêm người dùng thành công!";
                        } else {
                            $error = "Có lỗi xảy ra khi thêm người dùng!";
                        }
                    }
                }
                    
                $users = get_all_users();
                include "view/user.php";
                break;
                
            case 'hide_user':
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    hide_user($id);
                }
                header("Location: index.php?act=them_nguoi_dung");
                break;
                
                
            case 'restore_user':
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    restore_user($id);
                }
                header("Location: index.php?act=hidden_items");
                break;

            case 'hidden_items':
                $hidden_categories = get_hidden_categories();
                $hidden_products = get_hidden_products();
                $hidden_users = get_hidden_users();
                include "model/review.php";
                $hidden_reviews = get_hidden_reviews();
                include "view/muc_an.php";
                break;

            

            case 'danh_gia_va_phan_hoi_khach_hang':
                include "model/review.php";
                if(isset($_GET['action']) && $_GET['action'] == 'hide' && isset($_GET['id'])) {
                    $review_id = $_GET['id'];
                    hide_review($review_id);
                    header("Location: index.php?act=danh_gia_va_phan_hoi_khach_hang");
                    exit();
                }
                $reviews = get_all_reviews();
                include "view/review.php";
                break;
            
            case 'restore_review':
                include "model/review.php";
                if(isset($_GET['id'])) {
                    $review_id = $_GET['id'];
                    restore_review($review_id);
                }
                header("Location: index.php?act=hidden_items");
                break;
   
            case 'don_hang':
                include "view/don_hang.php";
                break;

            

            default:
                include "view/home.php";
                break;
        }
    } else {
        include "view/home.php";
    }

    include "view/footer.php";
    ?>