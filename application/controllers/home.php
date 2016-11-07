<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        // 정의를 안하면 controller의 생성자를 재정의 해버리기 때문에
        // 부모 controller를 수동적으로 정의 해줘야함
        parent::__construct();
        $this->load->database();
        $this->load->model('boardmodel');
        $this->load->model('memberandfriend');
    }

    function _head()
    {
        $this->load->config('opentutorials');
        $friend_list =  $this->memberandfriend->getfriendList($this->session->userdata('userNum'));
        $memberinfo = $this->memberandfriend->selectmember($this->session->userdata('userNum'));
        $this->load->view('/_templates/header',array('friend_list'=>$friend_list,'memberinfo'=>$memberinfo));
    }

    function index()
    {
        if ($this->session->userdata('is_login')) {
            $this->_head(array());
            $boards = $this->boardmodel->getBoardList();
            $comments = $this->boardmodel->getcommentList();
            $memberinfo = $this->memberandfriend->selectmember($this->session->userdata('userNum'));
            $this->load->view('/home/index', array('boardlist' => $boards,
                                                   'commentlist'=> $comments));
            $this->load->view('/_templates/footer', array('memberinfo'=>$memberinfo));
        } else {
            $this->load->config('opentutorials');
            $this->load->view('/home/login');
        }
    }

//사용자가 전송한 파일을 받는곳
    function upload_receive()
    {
        // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
        $config['upload_path'] = './static/user';
        // git,jpg,png 파일만 업로드를 허용한다.
        $config['allowed_types'] = 'gif|jpg|png';
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = '500';
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width'] = '1024';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        // 파일 업로드를 처리하는 라이브러리 클래스가 가지고 있는 do_upload를 호출
        // 사용자가 전송한 파일 name = user_upload_file
        if (!$this->upload->do_upload("user_upload_file")) {
            /*            $error = array('error'=>$this->upload->display_errors());
                          $this->load->view('upload_form',$error);*/
            echo $this->upload->display_errors();
        } else {
            // 사용자가 업로드한 파일을 php가 받아서 보안상 체크를 하고 제한상황을 체크하고
            // 문제가 없으면 성공 !
            $data = array('upload_data' => $this->upload->data());
            /* $this->load->view('upload_success',$data);*/
            echo "성공";
            var_dump($data);
        }
    }

    function upload_form()
    {
        $this->_head();

        $this->load->view('upload_form');

        $this->load->view('/_templates/footer');
    }

    public function friend_id()
    {

        $this->load->Model('memberandfriend');
        $friend_id = $this->memberandfriend->getfriend_id($_POST['idx']);


        echo json_encode($friend_id);
    }

    public function test()
    {
        $this->load->View('gcmtest');
    }
}

?>