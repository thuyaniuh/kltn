<?php
session_start();
$user_id = $_SESSION["user_id"];
// Kiểm tra xem phiên đăng nhập có tồn tại không
if (!isset($_SESSION['username'])) {
    // Nếu không, chuyển hướng người dùng đến trang đăng nhập
    header("Location:../index.php");
    exit();
}
if ($_SESSION['role_id'] != 1) {
    // Nếu không có quyền truy cập, chuyển hướng hoặc hiển thị thông báo lỗi
    echo "Mày khoải";
    header("refresh:1;url=../logout.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .avt {
            width: 80%;
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include_once 'viewNav.php'; ?>
    <!-- Main content -->
    <!-- Main content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Navbar bên trái -->
            <div class="col-md-3">
                <div class="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?topic">Đăng kí đề tài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?submitassigment">Tiến độ thực hiện</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nội dung chính -->
            <div class="col-md-9">
                <!-- Thông tin sinh viên -->
                <?php
                if (isset($_REQUEST['topic'])) {
                    include_once 'viewTopic.php';
                } elseif (isset($_REQUEST['submitassigment'])) {
                    include_once 'viewSubmitReport.php';
                } else {
                    include_once 'viewInfor.php';
                }
                ?>

                <!-- Nội dung khác -->

            </div>
        </div>
    </div>
    <?php include("../Layout/footer.php"); ?>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>