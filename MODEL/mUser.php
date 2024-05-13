<?php
include_once("mConnect.php");
class mUser
{
    function selectUserByID($user_id)
    {
        $p = new Connect();
        $p->connectDB($con);
        $query = "SELECT * FROM user where user_id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra xem có kết quả trả về hay không
        if ($result->num_rows > 0) {
            $p->close($con);
            return $result;
        } else {
            $p->close($con);
            return false;
        }
    }
}
