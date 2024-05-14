<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nộp bài</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid lightgrey;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        /* Màu nền cho các thẻ tiêu đề */
    }
</style>
<?php
include_once("../CONTROLLER/cTopic.php");
$p = new cTopic();
// Kiểm tra xem form đã được gửi đi chưa
if (isset($_POST["btnSubmitReport"])) {
    // Lấy dữ liệu từ form
    $user_id = $_SESSION["user_id"]; // Giả sử bạn lưu user_id trong session
    $report_file_name = $_FILES["assignment"]["name"]; // Tên file được gửi lên từ form
    $report_file_tmp = $_FILES["assignment"]["tmp_name"]; // Đường dẫn tạm thời của file
    $date = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại

    // Thư mục để lưu trữ các file được tải lên
    $upload_directory = "../REPORT/";

    // Di chuyển file từ thư mục tạm thời đến thư mục lưu trữ
    $uploaded_file_path = $upload_directory . basename($report_file_name);
    if (move_uploaded_file($report_file_tmp, $uploaded_file_path)) {
        // Gọi hàm để thêm dữ liệu vào cơ sở dữ liệu
        $p = new cTopic();
        $result = $p->getSubmitReport($user_id, $uploaded_file_path, $date);

        // Kiểm tra kết quả thêm dữ liệu
        if ($result) {
            // Nếu thêm thành công, hiển thị thông báo và thực hiện các thao tác khác
            echo "<script>alert('Nộp bài thành công');</script>";
            // Thực hiện chuyển hướng hoặc các thao tác khác ở đây
        } else {
            // Nếu thêm không thành công, hiển thị thông báo lỗi
            echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại sau');</script>";
        }
    } else {
        // Nếu di chuyển file không thành công, hiển thị thông báo lỗi
        echo "<script>alert('Có lỗi xảy ra khi tải lên file');</script>";
    }
}
?>

<body>
    <h2>Nộp bài</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="assignment">Chọn file (Word hoặc PDF):</label><br>
        <input type="file" id="assignment" name="assignment" accept=".doc,.docx,.pdf"><br><br>

        <!-- Sử dụng bảng để tổ chức các trường -->
        <table style="width:100%" class="table table-striped">
            <tr>
                <td><label for="status">Trạng thái:</label></td>
                <td><input type="text" id="status" name="status" value="Chưa nộp" disabled></td>
            </tr>
            <tr>
                <td><label for="submit_time">Thời gian nộp:</label></td>
                <td><input type="text" id="submit_time" name="submit_time" value="<?php echo isset($date) ? $date : ''; ?>" disabled></td>
            </tr>
            <tr>
                <td><label for="file_name">Tên file:</label></td>
                <td><input type="text" id="file_name" name="file_name" value="<?php echo isset($report_file_name) ? $report_file_name : ''; ?>" disabled></td>
            </tr>
        </table>

        <!-- Nút submit -->
        <input type="submit" value="Nộp bài" class="btn btn-success" name="btnSubmitReport">
    </form>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>