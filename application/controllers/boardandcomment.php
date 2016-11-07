<?php

class boardandcomment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('boardmodel');
        $this->load->model('memberandfriend');
    }

    // 타임라인 게시물 등록
    public function timeline_board_add()
    {
        $Page_num = isset($_POST['Page_num'])?$_POST['Page_num']:null;
        $Board_max_price = isset($_POST['Board_max_price'])?$_POST['Board_max_price']:null;
        $Board_min_price = isset($_POST['Board_min_price'])?$_POST['Board_min_price']:null;
        $Board_tag = isset($_POST['Board_tag'])?$_POST['Board_tag']:null;



        $this->boardmodel->addtimelineBoard(array(

            'Page_num'=> $Page_num,
            'User_num' => $this->session->userdata('userNum'),
            'Board_note' => $this->input->post('Board_note'),
            'Board_state' => $this->input->post('Board_state'),
            'Board_max_price' => $Board_max_price,
            'Board_min_price' => $Board_min_price,
            'Board_tag' => $Board_tag,
            'Board_target' => $this->input->post('Board_target')

        ));

        if ($this->input->post('Board_target') == 0){
            header('location:/home');
        }else{
            header('location:/usertimeline/index/'.$this->input->post('target_user_no'));
        }
    }

    public function addcomment()
    {
        $Cmd_price = isset($_POST['Cmd_price'])?$_POST['Cmd_price']:null;

        $this->boardmodel->addcomment(array(

            'Board_num'=> $this->input->post('group_num'),
            'Cmd_user' => $this->session->userdata('userNum'),
            'Cmd_note' => $this->input->post('Cmd_note'),
            'Cmd_price' => $Cmd_price
        ));


        if ($_POST['target_user_no'] == 0){
            header('location:/home');
        }else{
            header('location:/usertimeline/index/'.$_POST['target_user_no']);
        }
    }

    public function search()
    {
        $result = $this->boardmodel->search($_POST['keyword'],$this->session->userdata('userNum'));
        $friend_list =  $this->memberandfriend->getfriendList($this->session->userdata('userNum'));
        $memberinfo = $this->memberandfriend->selectmember($this->session->userdata('userNum'));
        $comments = $this->boardmodel->getcommentList();


        $this->load->view('/_templates/header',array('friend_list'=>$friend_list,'memberinfo'=>$memberinfo));
        $this->load->view('/home/search_index', array('boardlist' => $result,
            'commentlist'=> $comments));
        $this->load->view('/_templates/footer', array('memberinfo'=>$memberinfo));
    }

    public function share()
    {
        $result = $this->boardmodel->share($_POST['share_num']);

        echo json_encode($result);
    }

    public function cmd_cnt()
    {
        $result = $this->boardmodel->cmd_cnt($_POST['Cmd_num']);

        echo $result;
    }

    public function chat()
    {
        $this->load->view('/home/chatroom');
    }

}

?>
