<?php

class dealmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function dealList($idx, $state)
    {

        if ($state == 0) {
            $query = $this->db->query("select * from deallog WHERE (DI_seller = $idx OR DI_buyer = $idx) AND (DI_state = $state OR  DI_other_state = $state)")->result();
        } else {
            $query = $this->db->query("select * from deallog WHERE (DI_seller = $idx OR DI_buyer = $idx) AND (DI_state + DI_other_state >= 2)")->result();
        }

        return $query;
    }

    function add_deal($Board_num, $seller, $buyer, $price, $buy_state, $sell_state)
    {
        $this->db->query("INSERT INTO deallog (Board_num, DI_seller, DI_buyer, DI_price, DI_state, DI_other_state, DI_date) VALUES
                ($Board_num, $seller, $buyer, $price, $buy_state, $sell_state, NOW())");

    }

    function deal_check($idx)
    {
        $query = $this->db->query("SELECT count(*) AS cnt FROM deallog WHERE Board_num = $idx")->row();

        return $query->cnt;
    }

    function cancel_deal($DI_num)
    {
        return $this->db->query("DELETE FROM deallog where DI_num = $DI_num");
    }

    function decision_sell_deal($DI_num)
    {
        $time = NOW();
        $row = $this->db->query("SELECT * FROM deallog WHERE DI_num = $DI_num")->row();

        $confirm_state = $row->DI_state + 1;
        return $this->db->query("UPDATE deallog set DI_state = $confirm_state, DI_date = $time WHERE DI_num = $DI_num");
    }

    function decision_deal($DI_state, $DI_num, $target, $price)
    {
        $time = NOW();
        if ($DI_state == 1) {
            $query = $this->db->query("select User_money from member WHERE User_num = $target")->row();
            $money = $query->User_money;
            $result_money = $money + $price;
            $this->db->query("UPDATE member set User_money = $result_money WHERE User_num = $target");//money 수정
            //거래 완료시 돈이 올라감
            $row = $this->db->query("SELECT * FROM deallog WHERE DI_num = $DI_num")->row();
            $confirm_state = $row->DI_state + 1;
            return $this->db->query("UPDATE deallog set DI_state = $confirm_state, DI_date = $time WHERE DI_num = $DI_num");
            //거래 완료시 상태가 거래 완료로 바뀜
        } else if ($DI_state == 2) {
            $query = $this->db->query("select User_money from member WHERE User_num = $target")->row();
            $money = $query->User_money;
            $result_money = $money - $price;
            $this->db->query("UPDATE member set User_money = $result_money WHERE User_num = $target");//money 수정
            //물건 인수 확인시 돈이 차감됨.
            $row = $this->db->query("SELECT * FROM deallog WHERE DI_num = $DI_num")->row();
            $confirm_state = $row->DI_other_state + 1;
            return $this->db->query("UPDATE deallog set DI_other_state = $confirm_state, DI_date = $time WHERE DI_num = $DI_num");
            //거래 완료시 상태가 거래 완료로 바뀜
        }
    }

    function notify_deal($DI_num, $User)
    {
        if($User == 1)
        {
            $this->db->query("UPDATE deallog set DI_state = 0, DI_other_state = 2 WHERE DI_num = $DI_num");
        }else if($User == 2)
        {
            $this->db->query("UPDATE deallog set DI_state = 2, DI_other_state = 0 WHERE DI_num = $DI_num");
        }
    }

}

?>
