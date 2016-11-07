<?php

class Deal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function deallog($idx)
    {

        $this->load->model('memberandfriend');
        $memberinfo = $this->memberandfriend->selectmember($idx);
        $friend_list =  $this->memberandfriend->getfriendList($idx);


        $deal_state = 4;
        $this->load->model('dealmodel');
        $deallog =  $this->dealmodel->dealList($idx, $deal_state);

        /*해당 유저와 친구인지 아닌지 판별*/
        if ($idx != $this->session->userdata('userNum'))//내가 다른 사람 타임라인으로 들어갔을 경우
        {
            $result = $this->memberandfriend->checkfriend($idx, $this->session->userdata('userNum'));
            $friend_check = $result->cnt;
        } else {
            $friend_check = 1;
        }

        $this->load->view('/_templates/header', array('memberinfo' => $memberinfo,'friend_list' => $friend_list));
        $this->load->view('/home/deallog', array('memberinfo' => $memberinfo,
                                                 'deallog' => $deallog,
                                                 'friend_check' =>$friend_check));
        $this->load->view('/_templates/footer');

    }

    public function dealing($idx)
    {
	
        $state = 0;
        $this->load->model('dealmodel');
        $deallog = $this->dealmodel->dealList($idx, $state);
        $this->load->model('memberandfriend');
        $memberinfo = $this->memberandfriend->selectmember($idx);
        $friend_list =  $this->memberandfriend->getfriendList($idx);
	

        $this->load->view('/_templates/header', array('memberinfo'=>$memberinfo,'friend_list'=>$friend_list));
        $this->load->view('/home/dealing', array('deallog'=>$deallog,'memberinfo'=>$memberinfo));
        $this->load->view('/_templates/footer');

    }

    public function deal_find_id()
    {
        $this->load->model('memberandfriend');
        $memberinfo = $this->memberandfriend->selectmember($_POST['idx']);
        echo json_encode($memberinfo);
    }

    public function add_dealing()
    {
        $this->load->Model('dealmodel');
        $this->dealmodel->add_deal($_POST['Board_num'], $_POST['seller'], $_POST['buyer'], $_POST['price'], $_POST['buyer_state'],$_POST['seller_state'] );
    }

    public function deal_check()
    {
        $this->load->Model('dealmodel');
        $deal_result = $this->dealmodel->deal_check($_POST['idx']);

        echo $deal_result;
    }
    public function cancel_deal()
    {
        $this->load->Model('dealmodel');
        $deal_result = $this->dealmodel->cancel_deal($_POST['DI_num']);
    }

    public function deal_confirm()
    {
        $this->load->Model('dealmodel');
        $deal_result = $this->dealmodel->decision_deal($_POST['DI_state'],$_POST['DI_num'],$_POST['DI_target'],$_POST['DI_price']);
    }

    public function deal_notify()
    {
        $this->load->Model('dealmodel');
        $deal_result = $this->dealmodel->notify_deal($_POST['DI_num'],$_POST['User']);
    }
}

?>
