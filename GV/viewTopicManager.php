<!-- Nội dung chính -->
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        /* Màu nền cho các thẻ tiêu đề */
    }
</style>
<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<div style="width:100%">
    <h3 style="text-align: center">DANH SÁCH ĐĂNG KÍ ĐỀ TÀI</h3>
    <table style="width:100%" class="table table-striped table-hover">
        <th>STT</th>
        <th>Tên đề tài</th>
        <th>Mã sinh viên </th>
        <th>Tên sinh viên</th>
        <?php
        include_once("../CONTROLLER/cTopic.php");
        $dem = 1;
        $p = new cTopic();
        $result = $p->getAllTopicByProposal($user_id);
        if ($result) {
            foreach ($result as $row) {
                $topic_name = $row['topic_name'];
                $student1ID = $row["student_1_id"]; // Sử dụng "student_1_id" thay vì "student_1"
                $student1Name = $row["student_1_name"];
                $student2ID = $row["student_2_id"]; // Sử dụng "student_2_id" thay vì "student_2"
                $student2Name = $row["student_2_name"];
                echo "<tr><td rowspan='2' style='width:10%'>" . $dem++ . "</td><td rowspan='2' style='width:30%'>$topic_name</td><td style='width:10%'>$student1ID</td><td style='width:30%'>$student1Name</td></tr>";
                echo "<tr><td>$student2ID</td><td>$student2Name</td></tr>";
            }
        }
        ?>
    </table>
</div>