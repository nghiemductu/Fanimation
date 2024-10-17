<h1 class="mb-5 text-center pt-4 ">Hidden items</h1>

<div class="container">
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            showSuccessAlert("Success!", "<?php echo $_SESSION['success']; ?>");
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="w-75 mx-auto">
        <h3 class="mt-5 mb-4 pt-4">Hidden categories</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-striped">
                    <tr>
                        <th class="text-center align-middle" style="width: 10%;">SN</th>
                        <th class="text-center align-middle" style="width: 60%;">Category name</th>
                        <th class="text-center align-middle" style="width: 30%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt_category = 1; ?>
                    <?php foreach ($hidden_categories as $dm): ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $stt_category++; ?></td>
                        <td class="text-center align-middle"><?php echo $dm['ten_danh_muc']; ?></td>
                        <td class="text-center align-middle">
                            <a href="#" class="btn btn-sm btn-success" onclick="confirmRestore('index.php?act=restore_category&id=<?php echo $dm['id']; ?>')">Restore</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-75 mx-auto">
        <h3 class="mt-5 mb-4 pt-4">Product is hidden</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-striped">
                    <tr>
                        <th class="text-center align-middle" style="width: 10%;">SN</th>
                        <th class="text-center align-middle" style="width: 40%;">Product name</th>
                        <th class="text-center align-middle" style="width: 20%;">Price</th>
                        <th class="text-center align-middle" style="width: 30%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt_product = 1; ?>
                    <?php foreach ($hidden_products as $sp): ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $stt_product++; ?></td>
                        <td class="text-center align-middle"><?php echo $sp['ten_sp']; ?></td>
                        <td class="text-center align-middle"><?php echo number_format($sp['gia'], 0, ',', '.'); ?> đ</td>
                        <td class="text-center align-middle">
                            <a href="#" class="btn btn-sm btn-success" onclick="confirmRestore('index.php?act=restore_product&id=<?php echo $sp['id']; ?>')">Restore</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-75 mx-auto">
        <h3 class="mt-5 mb-4 pt-4">User is hidden</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-striped">
                    <tr>
                        <th class="text-center align-middle" style="width: 10%;">SN</th>
                        <th class="text-center align-middle" style="width: 30%;">User name</th>
                        <th class="text-center align-middle" style="width: 30%;">Email</th>
                        <th class="text-center align-middle" style="width: 30%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  
            <tbody>
                <?php $stt_user = 1; ?>
                <?php foreach ($hidden_users as $user): ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $stt_user++; ?></td>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($user['user_name']); ?></td>
                    <td class="text-center align-middle"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="text-center align-middle">
                        <a href="#" class="btn btn-sm btn-success" onclick="confirmRestore('index.php?act=restore_user&id=<?php echo $user['id']; ?>')">Restore</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="w-100 mx-auto">
        <h3 class="mt-5 mb-4 pt-4">Review hidden</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-striped">
                    <tr>
                        <th class="text-center align-middle" style="width: 5%;">SN</th>
                        <th class="text-center align-middle" style="width: 20%;">Product</th>
                        <th class="text-center align-middle" style="width: 15%;">User</th>
                        <th class="text-center align-middle" style="width: 10%;">Rating</th>
                        <th class="text-center align-middle" style="width: 30%;">Comment</th>
                        <th class="text-center align-middle" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt_review = 1; ?>
                    <?php foreach ($hidden_reviews as $review): ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $stt_review++; ?></td>
                        <td class="text-center align-middle"><?php echo htmlspecialchars($review['ten_sp']); ?></td>
                        <td class="text-center align-middle"><?php echo htmlspecialchars($review['user_name']); ?></td>
                        <td class="text-center align-middle"><?php echo $review['danh_gia']; ?> starts</td>
                        <td class="text-center align-middle"><?php echo htmlspecialchars($review['binh_luan']); ?></td>
                        <td class="text-center align-middle">
                            <a href="index.php?act=restore_review&id=<?php echo $review['id']; ?>" 
                            class="btn btn-success btn-sm" onclick="confirmRestore(this.href); return false;">Restore</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>