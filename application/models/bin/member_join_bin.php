<?php

class member_join_bin
{
    public $User_id = null;
    public $User_pw = null;
    public $User_name = null;
    public $User_registration = null;
    public $User_sex = null;
    public $User_mail = null;
    public $User_address = null;
    public $User_account = null;
    public $User_phone = null;
    public $User_img = null;
    public $User_money = null;
    public $User_kind = null;
    public $User_BN = null;

    function __construct($membervalue)
    {
        $this->User_id = $membervalue['User_id'];
        $this->User_pw = $membervalue['User_pw'];
        $this->User_name = $membervalue['User_name'];
        $this->User_registration = $membervalue['User_registration'];
        $this->User_sex = $membervalue['User_sex'];
        $this->User_mail = $membervalue['User_mail'];
        $this->User_address = $membervalue['User_address'];
        $this->User_account = $membervalue['User_account'];
        $this->User_phone = $membervalue['User_phone'];
        $this->User_img = null;
        $this->User_money = 0;
        $this->User_kind = $membervalue['User_kind'];
        $this->User_BN = $membervalue['User_BN'];
    }
}




?>