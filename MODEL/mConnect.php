<?php
class Connect
{
    function connectDB(&$con)
    {
        $con = mysqli_connect("localhost", "thuyan", "an1234", "kltn");
        if ($con) {
            return true; // Trả về true nếu kết nối thành công
        } else {
            return false; // Trả về false nếu kết nối không thành công
        }
    }

    function close($con)
    {
        mysqli_close($con);
    }
}
