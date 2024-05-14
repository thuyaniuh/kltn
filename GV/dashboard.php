<?php
session_start();
include_once("../CONTROLLER/cUser.php");
$user_id = $_SESSION["user_id"];
// Kiểm tra xem phiên đăng nhập có tồn tại không
if (!isset($_SESSION['username'])) {
    // Nếu không, chuyển hướng người dùng đến trang đăng nhập
    header("Location:../index.php");
    exit();
}

if ($_SESSION['role_id'] != 2) {
    // Nếu không có quyền truy cập, chuyển hướng hoặc hiển thị thông báo lỗi
    header("Location: unauthorized.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="dashboard.php"><img src="../IMG/Logo_IUH.png" alt="Logo" style="width: 50px;"></a>
            <!-- Tên trang -->
            <span class="navbar-text mx-3">Techer Dashboard</span>
            <!-- Avatar và dropdown menu -->
            <div class="dropdown ms-auto">
                <!-- Avatar -->
                <?php
                if (isset($user_id)) {
                    $p = new cUser();
                    $result = $p->getInfor($user_id);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $image = $row['image'];
                            echo "<img src='../IMG/$image' class='avatar' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>";
                        }
                    }
                }

                ?>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Navbar bên trái -->
            <div class="col-md-3">
                <div class="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?proposal">Đề xuất đề tài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?report">Quản lí bài nộp</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?topicmanager">Quản lí đề tài</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nội dung chính -->
            <div class="col-md-9">
                <!-- Thông tin sinh viên -->
                <?php
                if (isset($_REQUEST['proposal'])) {
                    include_once 'viewproposal.php';
                } elseif (isset($_REQUEST['topicmanager'])) {
                    include_once 'viewTopicManager.php';
                } elseif (isset($_REQUEST['report'])) {
                    include_once 'viewReport.php';
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