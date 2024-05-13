<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí đề tài</title>
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
            font-size: 12px;
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
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("../CONTROLLER/cTopic.php");

                        if (isset($major_id)) {
                            $p = new cTopic();
                            $ketqua = $p->getAllTopicByMajor($major_id);
                            if ($ketqua !== null && is_array($ketqua) && !empty($ketqua)) {
                                foreach ($ketqua as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row["topic_name"] . "</td>";
                                    echo "<td>" . $row["topic_description"] . "</td>";
                                    echo "<td>" . $row["lecturer_name"] . "</td>"; // Lấy thông tin về tên giảng viên
                                    echo "<td>" . $row["skill"] . "</td>";
                                    echo "<td>" . $row["results"] . "</td>";
                                    echo "<td>";
                                    echo "<a href='dashboard?id=" . $row["topic_id"] . "&action=approve' class='btn btn-primary'><i class='fa-solid fa-check'></i></a>";
                                    echo "<a href='dashboard?id=" . $row["topic_id"] . "&action=delete' class='btn btn-danger' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\"><i class='fa-solid fa-trash'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>