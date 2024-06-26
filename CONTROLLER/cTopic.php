<?php
include_once("../MODEL/mTopic.php");
class cTopic
{
    function addTopic($topicName, $topicDes, $proposal, $status, $major, $result, $skill)
    {
        $p = new mTopic();
        $ketqua = $p->insertTopic($topicName, $topicDes, $proposal, $status, $major, $result, $skill);
        if ($ketqua) {
            return 1;
        } else {
            return 0;
        }
    }
    function getTopicByMajorStudent($major_id)
    {
        $p = new mTopic();
        return $p->selectTopicByMajorStudent($major_id);
    }
    function getRegistration($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name)
    {
        $p = new mTopic();
        // Kiểm tra xem cả hai sinh viên đã đăng kí cho một đề tài nào đó chưa
        if ($p->checkRegistration($topicID, $sinhvien1ID) || $p->checkRegistration($topicID, $sinhvien2ID)) {
            echo "<script>alert('Đề tài đã được đăng kí hoặc sinh viên đã đăng kí đề tài khác'); window.location.href='#';</script>";
        } else {
            // Thực hiện đăng kí nếu không có lỗi
            $ketqua = $p->registerIfAvailable($topicID, $date, $sinhvien1ID, $sinhvien2ID, $sinhvien1Name, $sinhvien2Name);
            if ($ketqua === true) {
                echo "<script>alert('Đăng kí thành công'); window.location.href='#';</script>";
            } else {
                echo "<script>alert('Lỗi khi thực hiện đăng kí'); window.location.href='#';</script>";
            }
        }
    }
    //Lấy danh sách đề tài theo người đề xuất
    function getAllTopicByMajor($major_id)
    {
        $p = new mTopic();
        return $p->selectAllTopicByMajor($major_id);
    }
    public function isRegistered($topicID, $studentID)
    {
        $p = new mTopic();
        return $p->checkRegistration($topicID, $studentID);
    }
    //Lấy danh sách đề tài theo người đề xuất
    function getAllTopicByProposal($lecturer_name)
    {
        $p = new mTopic();
        return $p->selectAllTopicByLecturerName($lecturer_name);
    }
    //Nộp báo cáo
    function getSubmitReport($user_id, $report_file, $date)
    {
        $p = new mTopic();
        return $p->submitReport($user_id, $report_file, $date);
    }
    //Xem báo cáo
    function getAllReports()
    {
        $mReport = new mTopic();
        return $mReport->selectAllReports();
    }
    // Lấy thông tin nộp theo user_id
    function getAllReportsByUser($user_id)
    {
        $mReport = new mTopic();
        return $mReport->selectAllReportsByUser($user_id);
    }
}
