<?php

class Board extends Controller
{
    public function index()
    {
        // 모델을 불러와 클래스 생성
        $board_model = $this->loadModel('BoardModel');
        $board_list = $board_model->getBoardList();
        require 'test/views/_templates/header.php';
        require 'test/views/board/index.php';
        require 'test/views/_templates/footer.php';
    }

    public function write()
    {
        require 'test/views/_templates/header.php';
        require 'test/views/board/write.php';
        require 'test/views/_templates/footer.php';
    }
    public function view($idx)
    {
        $board_model = $this->loadModel('BoardModel');
        $board_view = $board_model->getBoardView($idx);
        require 'test/views/_templates/header.php';
        require 'test/views/board/view.php';
        require 'test/views/_templates/footer.php';
    }
    public function add()
    {
        // 저장 버튼을 눌렀으면 참 ! 아니면 거짓 !
        if(isset($_POST["submit_insert_board"]))
        {
            $board_model = $this->loadModel('BoardModel');
            $board_model->addBoard($_POST["title"], $_POST["content"], $_POST["writer"]);
        }
        header('location: ' . URL . 'board/index');
    }
    public function edit($idx)
    {
        $board_model = $this->loadModel('BoardModel');
        $board_data = $board_model->getBoardView($idx);
        require 'test/views/_templates/header.php';
        require 'test/views/board/edit.php';
        require 'test/views/_templates/footer.php';
    }
    public function update()
    {
        if (isset($_POST["submit_update_board"])){
            $board_model = $this->loadModel('BoardModel');
            $board_model->updateBoard($_POST["idx"], $_POST["title"], $_POST["content"],  $_POST["writer"]);
        }
        header('location: ' . URL . 'board/index');
    }
    public function del($idx)
    {
        $board_model = $this->loadModel('BoardModel');
        $board_model->deleteBoard($idx);
        header('location:' . URL . 'board/index');
        /*exit("까꿍");*/
    }
    public function helpme(){

        require 'test/views/_templates/header.php';
        require 'test/views/board/helpme.php';
        require 'test/views/_templates/footer.php';
    }
}
?>