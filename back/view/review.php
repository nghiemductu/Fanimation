
<div class="container-fluid flex-grow-1 pt-4">
    <h1 class="mb-4 text-center">Manage customer reviews and feedback</h1>
    <div class="container"> <!-- Thêm container này -->
        <div class="w-100 mx-auto" >
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-striped">
                        <tr>
                            <th class="text-center align-middle" style="width: 5%;">SN</th> <!-- Thay đổi tiêu đề cột -->
                            <th class="text-center align-middle" style="width: 15%;">Product</th>
                            <th class="text-center align-middle" style="width: 15%;">Client</th>
                            <th class="text-center align-middle" style="width: 10%;">Evaluate</th>
                            <th class="text-center align-middle" style="width: 25%;">Comment</th>
                            <th class="text-center align-middle" style="width: 15%;">Date posted</th>
                            <th class="text-center align-middle" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($reviews as $review): ?>
                <tr>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($review['id']); ?></td>
                    <td class="text-center align-middle"><?php echo isset($review['ten_sp']) ? htmlspecialchars($review['ten_sp']) : 'No product name'; ?></td>
                    <td class="text-center align-middle"><?php echo isset($review['user_name']) ? htmlspecialchars($review['user_name']) : 'No username'; ?></td>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($review['danh_gia']) . ' stars'; ?></td>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($review['binh_luan']); ?></td>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($review['ngay_bl']); ?></td>
                    <td class="text-center align-middle">
                    <a href="index.php?act=danh_gia_va_phan_hoi_khach_hang&action=hide&id=<?php echo $review['id']; ?>" class="btn btn-warning btn-sm" onclick="confirmHide(this.href); return false;">Hidden</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>