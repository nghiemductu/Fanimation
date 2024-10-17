<?php
session_start();
session_destroy(); // Hủy phiên làm việc
header("Location: http://localhost/fanimation/front/index.php"); // Chuyển hướng về trang home khách
exit();
?>