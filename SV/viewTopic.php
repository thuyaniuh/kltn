<?php
session_start();
$user_id = $_SESSION["user_id"];
$major_id = $_SESSION["major_id"];
// Kiểm tra xem phiên đăng nhập có tồn tại không
if (!isset($_SESSION['username'])) {
    // Nếu không, chuyển hướng người dùng đến trang đăng nhập
    header("Location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí đề tài</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        /* Tùy chỉnh bảng */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Tùy chỉnh các ô */
        .table td,
        .table th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Tùy chỉnh màu nền của các ô đầu tiên trong hàng */
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="dashboard.php"><img src="../IMG/Logo_IUH.png" alt="Logo" style="width: 50px;"></a>
            <!-- Tên trang -->
            <span class="navbar-text mx-3">Student Dashboard</span>
            <!-- Avatar và dropdown menu -->
            <div class="dropdown ms-auto">
                <!-- Avatar -->
                <img src="../IMG/thuyan.png" alt="Avatar" class="avatar" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Dropdown menu -->
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- --------------------------------------------------------------------------- -->
    <div class="fluid-container mt-5">
        <h4 class="text-center mb-4">Danh sách đề tài</h4>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Số thứ tự</th> -->
                            <th scope="col">Tên đề tài</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Giảng viên</th>
                            <th scope="col">Kĩ năng</th>
                            <th scope="col">Kết quả</th>
                            <th scope="col">Đăng kí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("../CONTROLLER/cTopic.php");
                        if (isset($major_id)) {
                            $p = new cTopic();
                            $ketqua = $p->getTopicByMajorstudent($major_id);
                            if ($ketqua !== null && is_array($ketqua) && !empty($ketqua)) {
                                foreach ($ketqua as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row["topic_name"] . "</td>";
                                    echo "<td>" . $row["topic_description"] . "</td>";
                                    echo "<td>" . $row["lecturer_name"] . "</td>"; // Lấy thông tin về tên giảng viên
                                    echo "<td>" . $row["skill"] . "</td>";
                                    echo "<td>" . $row["results"] . "</td>";
                                    // Kiểm tra xem đề tài đã được đăng kí chưa
                                    echo "<td><button type='button' class='btn btn-primary btn-register' data-bs-toggle='modal' data-bs-target='#registerModal' data-topic-id='" . $row["topic_id"] . "'><i class='fa-solid fa-check'></i></button></td>";
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Đăng kí đề tài</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="get" name="registerForm" action="#">
                        <div class="mb-3">
                            <label for="student2Name" class="form-label">Tên sinh viên 2:</label>
                            <input type="text" class="form-control" id="student2Name" name="student2Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="student2ID" class="form-label">Mã số sinh viên 2:</label>
                            <input type="text" class="form-control" id="student2ID" name="student2ID" required>
                        </div>
                        <input type="hidden" id="topicID" name="topicID">
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Thoát</button>
                        <button type="submit" class="btn btn-primary" name="btnRegister">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Lắng nghe sự kiện khi nhấp vào nút dấu check
    var registerButtons = document.querySelectorAll('.btn-register');
    registerButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var topicID = this.getAttribute('data-topic-id'); // Lấy topic_id từ thuộc tính data-topic-id
            document.getElementById('topicID').value = topicID; // Đặt giá trị topic_id vào input hidden
        });
    });
</script>
<?php
include_once("../CONTROLLER/cTopic.php");
if (isset($_REQUEST['btnRegister'])) {
    $p = new cTopic();
    //sửa này cho 1 sinh viên là tài khoản hiện tại, 1 sinh viên nhập.
    $sinhvien1ID = $user_id;
    $sinhvien1Name = $_SESSION['name'];
    $sinhvien2ID = $_REQUEST['student2ID'];
    $sinhvien2Name = $_REQUEST['student2Name'];
    $topicID = $_REQUEST['topicID'];
    $date = date("Y-m-d H:i:s");
    $ketqua = $p->getRegistration($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name);
    // if ($ketqua == 1) {
    //     echo "<script>alert('Đăng kí thành công'); </script>";
    // } else {
    //     echo "<script>alert('Lỗi');</script>";
    // }
}
?>

</html>