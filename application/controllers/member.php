<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    // 로그인
    function login(){
        $this->load->config('opentutorials');
        $this->load->view('head');
        $this->load->helper('url');
        $this->load->view('login',array('returnURL'=>$this->input->get('returnURL')));
        $this->load->view('footer');

    }
    // 로그아웃
    function logout(){
        //session 삭제
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('/');

    }

    //회원가입
    function register(){

        $this->load->view('/_templates/header');

        // 전달한 값의 유효성 판단
        $this->load->library('form_validation');

                                                                // 입력된 정보가 email폼에 준수 하고 있는 지 확인/ user 테이블에 email컬럼 안에 전달한 값이 있는지 없는지 확인
        $this->form_validation->set_rules('User_id', '아이디', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('User_name', '이름', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('User_sex', '성별', 'required');
        $this->form_validation->set_rules('User_pw', '비밀번호', 'required|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('User_pw_ck', '비밀번호 확인', 'required|matches[re_password]');
        $this->form_validation->set_rules('User_mail', '이메일 주소', 'required|valid_email|is_unique[member.User_mail]');
        $this->form_validation->set_rules('User_registration', '생년월일', 'required|max_length[8]]');
        $this->form_validation->set_rules('User_address', '주소', 'required');
        $this->form_validation->set_rules('User_account', '계좌번호', 'required|integer');
        $this->form_validation->set_rules('User_phone', '휴대폰번호', 'required|integer');

        // 위에 세팅 된 내용이 실행하게 됨
            if($this->form_validation->run() == false){
                $this->load->view('/home/userInput');
            }else{

            // php에서 password_hash 라는 함수를 지원 안해주면
            if(!function_exists('password_hash')){
                // 이렇게 암호화 헬퍼를 한번 로드시키면 어디서든 사용할 수 있는 전역 함수가 됨
                $this->load->helper('password');
            }
            // 패스워드를 암호화 시켜주는 함수
            // PASSWORD_BCRYPT 상수로 인해 암호화 즉 해싱되서 리턴됨
            $hash = password_hash($this->input->post('User_pw'),PASSWORD_BCRYPT);
            $this->load->model('user_model');
            $this->user_model->add(array(
                'User_id'=>$this->input->post('User_id'),
                'User_pw'=>$hash,
                'User_name'=>$this->input->post('User_name'),
                'User_registration'=>$this->input->post('User_registration'),
                'User_sex'=>$this->input->post('User_sex'),
                'User_mail'=>$this->input->post('User_mail'),
                'User_address'=>$this->input->post('User_address'),
                'User_account'=>$this->input->post('User_account'),
                'User_phone'=>$this->input->post('User_phone')
            ));
            $this->session->set_flashdata('message','회원가입 성공');
            $this->load->helper('url');
            redirect('/'); 
        }

        $this->load->view('/_templates/footer');
    }
    // 로그인 확인
    function member_check(){

        $this->load->model('user_model');
        // user 테이블에 email 값을 가져오기 위해 씀
        $user = $this->user_model->getByEmail(array('User_id'=>$this->input->post('id')));
        // config에서 저정된 내용을 가져오는구문
        //$authentication = $this->config->item('authentication');


        if($this->input->post('id') == $user->User_id &&
            // 사용자가 전송한 데이터와 user테이블에 저장된 값을 가져와서 그 결과
            // 일반값과 암호화 된값을 비교해서 맞는지 안맞는지 판별 password_verify($this->input->post('pw'), $user->User_pw))
            $this->input->post('pw')==$user->User_pw){

            $this->session->set_userdata(array(
                'is_login' => 'true',
                'loginID' => $user->User_id,
                'userName' => $user->User_name,
                'userNum' => $user->User_num
            ));

            $this->load->helper('url');

            redirect("/home/");
        }else{
            $this->session->set_flashdata('message','로그인에 실패 했습니다.');
            $this->load->helper('url');
            redirect("/home/");
        }
    }

    function addfriend()
    {
        $this->load->Model('memberandfriend');
        $this->memberandfriend->addfriend($_POST['friend_master'], $_POST['friend_follow']);
        header('location:/usertimeline/index/'.$_POST['target_user_no'].'/0');
    }

    function money_exchang()
    {
        $this->load->model('memberandfriend');
        $result = $this->memberandfriend->money_exchang($_POST['idx'],$_POST['money']);
    }

    function money_charge()
    {
        $this->load->model('memberandfriend');
        $this->memberandfriend->money_charge($_POST['idx'],$_POST['money']);
    }

}
