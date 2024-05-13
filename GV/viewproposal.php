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
    <?php
    include_once("../CONTROLLER/cTopic.php");
    if (isset($_REQUEST['btnDeXuat'])) {
        $topicName = $_REQUEST['topicName'];
        $topicDes = $_REQUEST['topicDescription'];
        $proposal = $_SESSION['user_id'];
        $status = 'Chờ duyệt';
        $major = $_SESSION['major_id'];
        $result = $_REQUEST['result'];
        $skill = $_REQUEST['requiredSkills'];
        $p = new cTopic();
        $ketqua = $p->addTopic($topicName, $topicDes, $proposal, $status, $major, $result, $skill);
        if ($ketqua == 1) {
            echo "<script>alert('Đề xuất thành công');</script>";
            header("refresh:1;url=#");
        } else {
            echo "<script>alert('Lỗi');</script>";
        }
    }
    ?>
    <!-- Nội dung chính -->
    <div class="col-md-9">
        <h2 class="mt-5 mb-4">Đề Xuất Đề Tài Mới</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="topicName" class="form-label">Tên Đề Tài:</label>
                <input type="text" class="form-control" id="topicName" name="topicName" required>
            </div>
            <div class="mb-3">
                <label for="topicDescription" class="form-label">Mô Tả Đề Tài:</label>
                <textarea class="form-control" id="topicDescription" name="topicDescription" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="result" class="form-label">Kết quả đạt được:</label>
                <input type="text" class="form-control" id="result" name="result" required>
            </div>
            <div class="mb-3">
                <label for="requiredSkills" class="form-label">Kỹ Năng Cần Có:</label>
                <input type="text" class="form-control" id="requiredSkills" name="requiredSkills" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnDeXuat">Gửi Đề Xuất</button>
        </form>
    </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>