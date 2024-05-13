<?php
include_once("MODEL/mAccount.php");
class cAccount
{
    function getLogins($username, $password)
    {
        if (isset($username) && isset($password)) {
            $p = new mAccount();
            $table = $p->login($username, $password);
            if ($table) {
                while ($row = mysqli_fetch_array($table)) {
                    if ($row['active_status'] == 1) {
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['role_id'] = $row['role_id'];
                        $_SESSION['user_id'] = $row['user_id'];
                        if ($row['role_id'] == 1) {
                            $_SESSION['user_id'];
                            $_SESSION['major_id'] = $row['major_id'];;
                            header("Location:SV/dashboard.php");
                        } elseif ($row['role_id'] == 2) {
                            $_SESSION['user_id'];
                            $_SESSION['major_id'] = $row['major_id'];;
                            header("Location:GV/dashboard.php");
                        } elseif ($row['role_id'] == 3) {
                            $_SESSION['user_id'];
                            $_SESSION['major_id'] = $row['major_id'];;
                            header("Location:CNBM/dashboard.php");
                        }
                    } else {
                        return -1;
                    }
                }
            } else {
                return -2;
            }
        }
    }
}
