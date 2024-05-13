<?php
include_once("mConnect.php");
class mAccount
{
    function login($username, $password)
    {
        $p = new Connect();
        $p->connectDB($con);
        // Sử dụng Prepared Statements
        $query = "SELECT *, user.major_id 
        FROM account 
        INNER JOIN user ON account.user_id = user.user_id
        WHERE username=? AND password=md5(?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $username, $password);
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
