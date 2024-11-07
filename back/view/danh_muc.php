<div class="container-fluid flex-grow-1 pt-4">
    <h1 class="mb-4 text-center">Category Management</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            showSuccessAlert("Success!", "<?php echo $_SESSION['success']; ?>");
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="index.php?act=adding_category" method="post" class="category-form mb-4">
        <div class="row justify-content-center">
            <div class="col-md-2 mb-3">
                <input type="text" class="form-control" name="ten_danh_muc" placeholder="Category name" required>
            </div>
            <div class="col-md-2 mb-3">
                <select class="form-control" name="parent_id">
                    <option value="0">Original catalog</option>
                    <?php
                    function buildCategoryOptions($categories, $parent_id = 0) {
                        $result = '';
                        foreach ($categories as $dm) {
                            if ($dm['parent_id'] == $parent_id) {
                                $result .= '<option value="'.$dm['id'].'">'.$dm['ten_danh_muc'].'</option>';
                                $result .= buildCategoryOptions($categories, $dm['id']); // Gọi đệ quy
                            }
                        }
                        return $result;
                    }
                    echo buildCategoryOptions($kq);
                    ?>
                </select>
            </div>
        </div>
        <div class="text-center mb-3">
            <button type="submit" name="add_new" class="btn btn-primary">Add new</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered w-50 mx-auto">
            <thead class="thead-striped">
                <tr>
                    <th class="text-center" style="width: 15%">SN</th>
                    <th class="text-center" style="width: 55%">Category name</th>
                    <th class="text-center" style="width: 30%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function displayCategories($categories, $parent_id = 0, &$stt = 1)
                {
                    foreach ($categories as $dm) {
                        if ($dm['parent_id'] == $parent_id) {
                            $bg_class = $parent_id == 0 ? 'table-primary' : ''; 
                            $padding_left = $dm['parent_id'] == 0 ? 0 : 50; 
                            echo '<tr class="' . $bg_class . '">
                                    <td class="text-center align-middle">' . $stt++ . '</td>
                                    <td class="text-center align-middle">
                                        <div style="padding-left: ' . $padding_left . 'px;">
                                            ' . $dm['ten_danh_muc'] . '
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="index.php?act=update_category&id=' . $dm['id'] . '" class="btn btn-sm btn-warning w-25">Fix</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete(function() { window.location.href=\'index.php?act=delete_category&id=' . $dm['id'] . '\'; })">Hidden</a>
                                    </td>
                                  </tr>';
                            displayCategories($categories, $dm['id'], $stt); // Gọi đệ quy để hiển thị danh mục con
                        }
                    }
                }
                $stt = 1;
                displayCategories($kq, 0, $stt);
                ?>
            </tbody>
        </table>
    </div>
</div>