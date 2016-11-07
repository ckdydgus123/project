<?php

class MemberNfriend extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function checkmemeber($id, $pw)
    {
        $memberinfo = $this->db->get_where('member', array('User_id' => $id, 'User_pw' => $pw))->row();

        if ($memberinfo) {
            $loginResult['name'] = $memberinfo->User_name;
            $loginResult['id'] = $memberinfo->User_id;
            $loginResult['idx'] = $memberinfo->User_num;
            $loginResult['code'] = 1; // 로그인 성공 코드 리턴
        } else {
            $memberinfo2 = $this->db->get_where('member', array('User_id' => $id))->row();
            if ($memberinfo2) {
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
            ':User_sex' => $values->User_sex, ':User_mail' => $values->User_mail, ':User_address' => $values->User_address, ':User_account' => $values->User_account, ':User_phone' => $values->User_phone,
            ':User_img' => $values->User_img, ':User_money' => $values->User_money, ':User_kind' => $values->User_kind, ':User_BN' => $values->User_BN, ':User_joindate' => date("Y-m-d H:i:s")));
    }

    function selectmember($idx)
    {
/*        $this->db->select("User_num, User_id, User_sex, User_registration, SUBSTR(User_address,1,3) AS User_address");*/
        $query = $this->db->get_where('member', array('User_num' => $idx))->row();

        return $query;
    }

    function addfriend($M_idx, $F_idx)
    {
        $this->db->insert('friend', array('Friend_master' => $M_idx,
                                          'Friend_follow' => $F_idx,
                                          'Friend_state' => 1
        ));
    }

    function checkfriend($M_idx, $F_idx)
    {
        //테스트 아직안함
        /*
                $this->db->count_all('friend')
                        ->where('Friend_master', $M_idx)
                        ->where('Friend_follow', $F_idx)
                        ->or_where('Friend_master', $F_idx)
                        ->where('Friend_follow', $M_idx)
                ;
                $where = "(Friend_master = $M_idx AND Friend_follow = $F_idx) OR (Friend_master = $F_idx AND Friend_follow = $M_idx)";
                $this->db->count_all('friend')
                         ->where($where);*/

        return  $this->db->query("select count(*) AS cnt from friend WHERE (Friend_master = $M_idx AND Friend_follow = $F_idx ) OR  (Friend_master = $F_idx AND Friend_follow = $M_idx )")->row();
    }

    function getfriendList($idx)
    {

        return $this->db->query("SELECT * from friend WHERE (Friend_master = $idx OR Friend_follow = $idx) AND Friend_state = 1")->result();
    }

    function getfriend_id($idx)
    {
        return $this->db->query("SELECT User_id FROM member WHERE User_num = $idx")->result();
    }

    function money_exchang($idx,$money)
    {
        $query = $this->db->query("select User_money from member where User_num = $idx")->row();
        $currentMoney = $query->User_money;
        $exchangMoney = $currentMoney - $money;

        return $this->db->query("update member set User_money = $exchangMoney WHERE User_num = $idx");

    }

    function money_charge($idx,$money)
    {
        $query = $this->db->query("select User_money from member where User_num = $idx")->row();
        $currentMoney = $query->User_money;
        $chargeMoney = $currentMoney + $money;

        return $this->db->query("update member set User_money = $chargeMoney WHERE User_num = $idx");
    }

}

?>