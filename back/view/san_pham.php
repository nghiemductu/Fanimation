<div class="container-fluid flex-grow-1 pt-4">
    <h1 class="mb-4 text-center">Product management</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            showSuccessAlert("Success!", "<?php echo $_SESSION['success']; ?>");
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="index.php?act=add_san_pham" method="post" enctype="multipart/form-data" class="mb-4" id="productForm">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="ten_sp" name="ten_sp" placeholder="Enter the product name" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" id="gia" name="gia" placeholder="Enter product price" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" class="form-control" id="so_luong_hang" name="so_luong_hang" placeholder="Enter quantity" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="form-control" id="id_dm" name="id_dm" required>
                            <option value="">Select category</option>
                            <?php foreach ($dsdm as $dm): ?>
                                <option value="<?php echo $dm['id']; ?>"><?php echo $dm['ten_danh_muc']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="cong_suat" name="cong_suat" placeholder="Enter capacity" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="cong_nghe" name="cong_nghe" placeholder="Enter technology" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="chat_lieu" name="chat_lieu" placeholder="Enter material" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="chuc_nang" name="chuc_nang" placeholder="Enter function" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="so_canh" name="so_canh" placeholder="Enter wing number" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" id="toc_do" name="toc_do" placeholder="Enter speed" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="file" class="form-control" id="imgs" name="imgs[]" multiple required accept="image/*">
                        <small class="form-text text-muted">Choose up to 6 photos (jpg, jpeg, png, gif)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <textarea class="form-control" id="mo_ta_sp" name="mo_ta_sp" rows="5" placeholder="Enter product description" required></textarea>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <label class="me-5"><input type="checkbox" name="new_arrival" value="1"> New Arrivals</label>
                    <label class="me-5"><input type="checkbox" name="featured" value="1"> Featured Products</label>
                    <label class="me-5"><input type="checkbox" name="best_seller" value="1"> Best Sellers</label>
                </div>
                <div class="text-center mb-3">
                    <button type="submit" name="add_new" class="btn btn-primary">Add new</button>
                </div>
            </div>
        </div>
    </form>

     <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>SN</th>
                <th>Product name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Describe</th>
                <th>Specifications</th>
                <th>Date posted</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Giả sử $kq chứa danh sách sản phẩm từ cơ sở dữ liệu
        if(isset($kq) && count($kq) > 0){
            $start_index = ($current_page - 1) * $limit;
            foreach ($kq as $index => $item){
                $stt = $start_index + $index + 1;
                $ten_danh_muc = '';
                foreach ($dsdm as $dm) {
                    if ($dm['id'] == $item['id_danh_muc']) {
                        $ten_danh_muc = $dm['ten_danh_muc'];
                        break;
                    }
                }

                // Lấy trạng thái từ checkbox
                $status = [];
                if ($item['new_arrival']) $status[] = 'New Arrivals';
                if ($item['featured']) $status[] = 'Featured Products';
                if ($item['best_seller']) $status[] = 'Best Sellers';
                $status_display = !empty($status) ? implode(', ', $status) : 'There are no categories';

                echo '<tr class="text-center">
                        <td class="align-middle">'.$stt.'</td>
                        <td class="align-middle">'.$item['ten_sp'].'</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#imageModal'.$item['id'].'">
                                See photos
                            </button>
                        </td>
                        <td class="align-middle">'.$ten_danh_muc.'</td>
                        <td class="align-middle">'.number_format($item['gia'], 0, ',', '.').' $</td>
                        <td class="align-middle">'.$item['so_luong_hang'].'</td>
                        <td class="align-middle">'.substr($item['mo_ta_sp'], 0, 50).'...</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#specModal'.$item['id'].'">
                                See details
                            </button>
                        </td>
                        <td class="align-middle">'.$item['ngay_dang'].'</td>
                        <td class="align-middle">'.$status_display.'</td>
                        <td class="align-middle">
                            <div class="d-flex flex-column align-items-center">
                                <a href="index.php?act=update_san_pham&id='.$item['id'].'" class="btn btn-sm btn-warning mb-2 w-100" onclick="return confirmEdit()">Fix</a>
                                <a href="#" class="btn btn-sm btn-danger w-100" onclick="confirmDelete(function() { window.location.href=\'index.php?act=delete_product&id='.$item['id'].'\'; })">Hidden</a>
                            </div>
                        </td>
                      </tr>';
            }
        }
        ?>
        </tbody>
    </table>

    <?php
    // Modal cho các sản phẩm
    if(isset($kq) && count($kq) > 0){
        foreach ($kq as $item){
            // Modal cho thông số kỹ thuật
            echo '<div class="modal fade" id="specModal'.$item['id'].'" tabindex="-1" role="dialog" aria-labelledby="specModalLabel'.$item['id'].'" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="specModalLabel'.$item['id'].'">Technical specifications: '.$item['ten_sp'].'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tr><th>Capacity</th><td>'.$item['cong_suat'].'</td></tr>
                                    <tr><th>Technology</th><td>'.$item['cong_nghe'].'</td></tr>
                                    <tr><th>Material</th><td>'.$item['chat_lieu'].'</td></tr>
                                    <tr><th>Function</th><td>'.$item['chuc_nang'].'</td></tr>
                                    <tr><th>Number of wings</th><td>'.$item['so_canh'].'</td></tr>
                                    <tr><th>Speed</th><td>'.$item['toc_do'].'</td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>';

            // Modal cho hình ảnh
            $images = json_decode($item['images'], true);
            echo '<div class="modal fade" id="imageModal'.$item['id'].'" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel'.$item['id'].'" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel'.$item['id'].'">Images: '.$item['ten_sp'].'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="imageCarousel'.$item['id'].'" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">';
                                        if (is_array($images)) {
                                            foreach($images as $index => $image) {
                                                echo '<div class="carousel-item '.($index == 0 ? 'active' : '').'">
                                                        <img src="'.$image.'" class="d-block w-100" alt="'.$item['ten_sp'].'">
                                                    </div>';
                                        }
                                    } else {
                                        echo '<div class="carousel-item active">
                                                <img src="'.$images.'" class="d-block w-100" alt="'.$item['ten_sp'].'">
                                              </div>';
                                    }
                                    echo '</div>
                                    <a class="carousel-control-prev" href="#imageCarousel'.$item['id'].'" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageCarousel'.$item['id'].'" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>';
        }
    }
    ?>
</div>

<!-- Pagination -->
<?php
require_once 'pagination.php';
echo renderPagination($current_page, $total_pages, '?act=san_pham&page=%d');
?>

<!-- Bootstrap CSS and JS for modal and carousel functionality -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="http://localhost/fanimation/public/JS/back_product.js"></script>