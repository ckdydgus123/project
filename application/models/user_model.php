<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM user")->result();
    }

    function get($option)
    {
        $result = $this->db->get_where('user', array('email'=>$option['email']))->row();

        return $result;
    }

    // 회원가입
    function add($option)
    {
        $this->db->set('User_id', $option['User_id']);
        $this->db->set('User_pw', $option['User_pw']);
        $this->db->set('User_name', $option['User_name']);
        $this->db->set('User_registration', $option['User_registration']);
        $this->db->set('User_sex', $option['User_sex']);
        $this->db->set('User_mail', $option['User_mail']);
        $this->db->set('User_address', $option['User_address']);
        $this->db->set('User_account', $option['User_account']);
        $this->db->set('User_phone', $option['User_phone']);
        $this->db->set('User_joindate', 'NOW()', false);
        $this->db->insert('member');
        $result = $this->db->insert_id();
        return $result;
    }
    function getByEmail($option){

        //user 테이블에 email 값이 $option['email'] 값과 같은 데이터만 가져와서 하나의 객체에 담으
        $result = $this->db->get_where('member', array('User_id'=>$option['User_id']))->row();
        return $result;
    }
}