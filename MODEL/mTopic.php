<?php
include_once("mConnect.php");
class mTopic
{
    function insertTopic($topicName, $topicDes, $proposal, $status, $major, $result, $skill)
    {
        $p = new Connect();
        $p->connectDB($con); // Chỉnh sửa phần này để gọi phương thức connectDB mà không cần truyền tham số

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "INSERT INTO topics (topic_name, topic_description, proposed_by, status, major_id, results, skill) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("ssssiss", $topicName, $topicDes, $proposal, $status, $major, $result, $skill);
        $table = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($table === false) {
            $p->close($con); // Đóng kết nối
            return false;
        } else {
            $p->close($con); // Đóng kết nối
            return true;
        }
    }
    //Này cho sinh viên xem đề tài đăng kí nè
    function selectTopicByMajorStudent($major_id)
    {
        $p = new Connect();
        $p->connectDB($con);
        $query = "SELECT t.topic_id, t.topic_name, t.topic_description, t.status, t.results, t.skill, 
        u.name AS lecturer_name, u.email AS lecturer_email, u.address AS lecturer_address
 FROM topics t
 JOIN user u ON t.proposed_by = u.user_id
 JOIN majors m ON t.major_id = m.major_id
 WHERE t.status = 'Đã duyệt' AND m.major_id = ?";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("i", $major_id);
        $table = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($table === false) {
            $p->close($con); // Đóng kết nối
            return null;
        } else {
            $result_set = $stmt->get_result();
            $topics = $result_set->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Đóng statement
            $p->close($con); // Đóng kết nối
            return $topics;
        }
    }
    // Cái này cho chủ nhiệm bộ môn xem hết mấy đề tài được gv đề xuất nè :3
    function selectAllTopicByMajor($major_id)
    {
        $p = new Connect();
        $p->connectDB($con); // Chỉnh sửa phần này để gọi phương thức connectDB mà không cần truyền tham số

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "SELECT t.topic_id, t.topic_name, t.topic_description, t.status, t.results, t.skill, 
        u.name AS lecturer_name, u.email AS lecturer_email, u.address AS lecturer_address
 FROM topics t
 JOIN user u ON t.proposed_by = u.user_id
 JOIN majors m ON t.major_id = m.major_id
 WHERE m.major_id = ?";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("i", $major_id);
        $table = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($table === false) {
            $p->close($con); // Đóng kết nối
            return null;
        } else {
            $result_set = $stmt->get_result();
            $topics = $result_set->fetch_all(MYSQLI_ASSOC);
            $stmt->close(); // Đóng statement
            $p->close($con); // Đóng kết nối
            return $topics;
        }
    }
    // Quể này ktra xem topic đã được đăng kí hay chưa, sinh viên nào đã đăng kí rồi không được đăng kí nữa
    function checkRegistration($topicID, $studentID)
    {
        $p = new Connect();
        $p->connectDB($con); // Kết nối đến cơ sở dữ liệu

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "SELECT COUNT(*) AS count FROM registration WHERE topic_id = ? AND (student_1 = ? OR student_2 = ?)";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            $p->close($con); // Đóng kết nối
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("iii", $topicID, $studentID, $studentID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra kết quả truy vấn
        if ($result === false) {
            $p->close($con); // Đóng kết nối
            return false;
        }

        $row = $result->fetch_assoc();
        $count = $row['count'];

        $p->close($con); // Đóng kết nối

        // Nếu có ít nhất một bản ghi tồn tại, tức là đã có đăng kí
        return $count > 0;
    }
    //Hàm đăng kí
    function registerTopic($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name)
    {
        $p = new Connect();
        $p->connectDB($con); // Chỉnh sửa phần này để gọi phương thức connectDB mà không cần truyền tham số

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "INSERT INTO registration (topic_id, registration_date, student_1,student_2,student_1_name,student_2_name) VALUES (?, ?, ?, ?,?,?)";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("ssiiss", $topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name);
        $table = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($table === false) {
            $p->close($con); // Đóng kết nối
            return false;
        } else {
            $p->close($con); // Đóng kết nối
            return true;
        }
    }
    // Check coi 1 trong 2 đã đăng kí đề tài nào chưa
    public function checkRegistrationByStudent($studentID)
    {
        $p = new Connect();
        $p->connectDB($con); // Kết nối đến cơ sở dữ liệu

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "SELECT COUNT(*) AS count FROM registration WHERE student_1 = ? OR student_2 = ?";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            $p->close($con); // Đóng kết nối
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("ii", $studentID, $studentID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra kết quả truy vấn
        if ($result === false) {
            $p->close($con); // Đóng kết nối
            return false;
        }

        $row = $result->fetch_assoc();
        $count = $row['count'];

        $p->close($con); // Đóng kết nối

        // Trả về số lượng bản ghi có sinh viên đã đăng kí
        return $count;
    }

    //Gom 2 hàm lại, nếu check ok cho đăng kí không thì cook
    public function registerIfAvailable($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name)
    {
        // Kiểm tra xem cả hai sinh viên đã đăng kí cho một đề tài khác hay không
        if ($this->checkRegistration($topicID, $sinhvien1ID) || $this->checkRegistration($topicID, $sinhvien2ID)) {
            // Đã có người đăng kí, không thể đăng kí
            return false;
        } else if ($this->checkRegistrationByStudent($sinhvien1ID) || $this->checkRegistrationByStudent($sinhvien2ID)) {
            // Một trong hai sinh viên đã đăng kí cho một đề tài khác, không thể đăng kí
            return false;
        } else {
            // Chưa có người đăng kí, thực hiện đăng kí
            return $this->registerTopic($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name);
        }
    }
    // Hàm quản lí đề tài của gv
    function selectAllTopicByLecturerName($lecturer_name)
    {
        $p = new Connect();
        $p->connectDB($con); // Kết nối cơ sở dữ liệu

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "SELECT t.topic_name, u1.user_id AS student_1_id, u1.name AS student_1_name, u2.user_id AS student_2_id, u2.name AS student_2_name 
        FROM topics t JOIN registration r ON t.topic_id = r.topic_id JOIN user u_proposer ON t.proposed_by = u_proposer.user_id LEFT JOIN user u1 ON r.student_1 = u1.user_id 
        LEFT JOIN user u2 ON r.student_2 = u2.user_id WHERE u_proposer.user_id = (?)";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("s", $lecturer_name);
        $execute_success = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($execute_success === false) {
            $p->close($con); // Đóng kết nối
            return null;
        } else {
            $result_set = $stmt->get_result();
            $topics = $result_set->fetch_all(MYSQLI_ASSOC); // Trả về tất cả kết quả dưới dạng mảng kết hợp

            $stmt->close(); // Đóng statement
            $p->close($con); // Đóng kết nối

            return $topics;
        }
    }
    //Nộp báo cáo
    function submitReport($user_id, $report_file, $date)
    {
        $p = new Connect();
        $p->connectDB($con); // Kết nối cơ sở dữ liệu

        // Sử dụng Prepared Statements để tránh lỗ hổng SQL injection
        $query = "INSERT INTO progress (user_id, report_file,submit_at) VALUES (?, ?, ?)";
        $stmt = $con->prepare($query);

        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }

        // Bind parameters và thực thi truy vấn
        $stmt->bind_param("iss", $user_id, $report_file, $date);
        $execute_success = $stmt->execute();

        // Kiểm tra kết quả thực thi
        if ($execute_success === false) {
            $p->close($con); // Đóng kết nối
            return false;
        } else {
            $stmt->close(); // Đóng statement
            $p->close($con); // Đóng kết nối
            return true;
        }
    }
    // Xem báo cáo đã nộp
    function getAllReports()
    {
        $p = new Connect();
        $p->connectDB($con); // Kết nối cơ sở dữ liệu
        $query = "SELECT * FROM progress";
        $stmt = $con->prepare($query);
        // Kiểm tra nếu prepare() không thành công
        if (!$stmt) {
            return false;
        }
        $execute_success = $stmt->execute();
        // Kiểm tra kết quả thực thi
        if ($execute_success === false) {
            $p->close($con); // Đóng kết nối
            return null;
        } else {
            $result_set = $stmt->get_result();
            $reports = $result_set->fetch_all(MYSQLI_ASSOC); // Trả về tất cả kết quả dưới dạng mảng kết hợp

            $stmt->close(); // Đóng statement
            $p->close($con); // Đóng kết nối

            return $reports;
        }
    }
}
