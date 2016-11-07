<?php

class Usertimeline extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($idx, $timelinestate)
    {
        //개인 타임라인 정보 출력을 위한 유저 정보 query
        $this->load->model('memberandfriend');
        $memberinfo= $this->memberandfriend->selectmember($idx);

        if ($memberinfo->User_sex == 0) {
            $member_sex = '남';
        } else {
            $member_sex = '여';
        }

        // 개인타임라인 board 출력
        $this->load->model('boardmodel');
        $timeline_list=$this->boardmodel->getUsertimeline_BoardList($idx,$timelinestate);
        $comment_list = $this->boardmodel->getcommentList();


        /*해당 유저와 친구인지 아닌지 판별*/
        if ($idx != $this->session->userdata('userNum'))//내가 다른 사람 타임라인으로 들어갔을 경우
        {
            $result = $this->memberandfriend->checkfriend($idx, $this->session->userdata('userNum'));
            $friend_check = $result->cnt;
        } else {
            $friend_check = 1;
        }

        $friend_list =  $this->memberandfriend->getfriendList($this->session->userdata('userNum'));
        $this->load->view('/_templates/header',array('friend_list'=>$friend_list,'memberinfo'=>$memberinfo));
        $this->load->view('/home/timeline',array('memberinfo' => $memberinfo,
                                                 'timeline_list' => $timeline_list,
                                                 'comment_list' => $comment_list,
                                                 'friend_check' =>$friend_check
            ));
        $this->load->view('/_templates/footer',array('memberinfo'=>$memberinfo));
    }


}

?>