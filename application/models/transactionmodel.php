<?php

class TransacTion
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('DB connect error!');
        }
    }

    function checkmemeber($id, $pw)
    {

        $sql = "SELECT * FROM member WHERE User_id = '" . strval($id) . "' AND User_pw = '" . strval($pw) . "'";
        $sql2 = "SELECT * FROM member WHERE User_id = '" . strval($id) . "'";

        $query = $this->db->prepare($sql);
        $query->execute();
        $memberinfo = $query->fetch();


        if ($memberinfo) {
            $loginResult['name'] = $memberinfo->User_name;
            $loginResult['id'] = $memberinfo->User_id;
            $loginResult['idx'] = $memberinfo->User_no;
            $loginResult['code'] = 1; // 로그인 성공 코드 리턴
        } else {
            $query = $this->db->prepare($sql2);
            $query->execute();
            $memberinfo = $query->fetch();
            if ($memberinfo) {
                $loginResult['code'] = -2; // 비밀번호 오류
            } else {
                $loginResult['code'] = -1; // 아이디 오류
            }
        }

        return $loginResult;
    }

    function member_join($values)
    {
        $sql = "INSERT INTO member (User_id, User_pw, User_name, User_registration, User_sex, User_mail, User_address, User_account, User_phone, User_img, User_money, User_kind, User_BN, User_joindate) VALUES
        (:User_id, :User_pw, :User_name, :User_registration, :User_sex, :User_mail, :User_address, :User_account, :User_phone, :User_img, :User_money, :User_kind, :User_BN, :User_joindate)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':User_id' => $values->User_id, ':User_pw' => $values->User_pw, ':User_name' => $values->User_name, ':User_registration' => $values->User_registration,
            ':User_sex' => $values->User_sex, ':User_mail' => $values->User_mail, ':User_address' => $values->User_address , ':User_account' => $values->User_account, ':User_phone'=> $values->User_phone,
            ':User_img' => $values->User_img, ':User_money' => $values->User_money, ':User_kind' => $values->User_kind, ':User_BN' => $values->User_BN, ':User_joindate' => date("Y-m-d H:i:s")));
    }
}

?>