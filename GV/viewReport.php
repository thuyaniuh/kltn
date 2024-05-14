<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài nộp</title>
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
$reports = $p->getAllReports();
?>

<body>
    <h2>Danh sách bài nộp của sinh viên</h2>
    <table>
        <thead>
            <tr>
                <th>Mã sinh viên</th>
                <th>Tên file</th>
                <th>Thời gian nộp</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($reports) {
                foreach ($reports as $report) {
                    echo "<tr>";
                    echo "<td>{$report['user_id']}</td>";
                    echo "<td>" . basename($report['report_file']) . "</td>";
                    echo "<td>{$report['submit_at']}</td>";
                    echo "<td><a href='{$report['report_file']}' target='_blank'>Xem file</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>