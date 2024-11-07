<h1 class="mb-4 text-center pt-4">Add New User</h1>
<div class="row justify-content-center">
    <div class="col-md-3">
        <?php if (isset($_SESSION['error'])): ?> <!-- Kiểm tra biến phiên error -->
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <script>
                showSuccessAlert("Success!", "<?php echo $_SESSION['success']; ?>");
            </script>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>


        <form action="index.php?act=them_nguoi_dung" method="POST" class="mb-5">
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Login name" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="add_user">Add user</button>
            </div>
        </form>
    </div>
</div>

<h1 class="mt-5 mb-4 text-center">List of users</h1>
<div class="table-responsive">
    <table class="table table-striped table-bordered border-dark w-50 mx-auto">
        <thead class="table-striped">
            <tr>
                <th class="text-center align-middle" style="width: 10%">SN</th>
                <th class="text-center align-middle" style="width: 30%">Login name</th>
                <th class="text-center align-middle" style="width: 40%">Email</th>
                <th class="text-center align-middle" style="width: 20%">Actions</th>
            </tr>
        </thead>
        <tbody>
       
            <?php foreach($users as $stt => $user): ?>
            <tr>
                <td class="text-center align-middle"><?php echo $stt + 1; ?></td>
                <td class="text-center align-middle"><?php echo htmlspecialchars($user['user_name']); ?></td>
                <td class="text-center align-middle"><?php echo htmlspecialchars($user['email']); ?></td>
                <td class="text-center align-middle">
                    <a href="#" class="btn btn-warning btn-sm" onclick="confirmHideUser('<?php echo $user['id']; ?>')">Hidden</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>