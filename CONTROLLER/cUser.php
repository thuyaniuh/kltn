<?php
include_once("../MODEL/mUser.php");
class cUser
{
    function getInfor($user_id)
    {
        $p = new mUser();
        return $p->selectUserByID($user_id);
    }
}
