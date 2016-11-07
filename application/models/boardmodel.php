<?php

class Boardmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // board 테이블로부터 모든 행을 받아 출력
    public function getBoardList()
    {
        $this->db->select('*');
        $this->db->from('board b');
        $this->db->join('member m', 'm.User_num = b.User_num  AND b.Board_target = 0');
        $this->db->order_by('b.Board_num', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function getUsertimeline_BoardList($idx, $state)
    {
        $this->db->select('*');
        $this->db->from('board b');
        if ($state == 0)
        {
            $this->db->join('member m', 'm.User_num = b.User_num  AND (b.User_num = ' . $idx . ' OR b.Board_target = ' . $idx . ')');
        }else if($state == 1){
            $this->db->join('member m', 'm.User_num = b.User_num  AND (b.User_num = ' . $idx . ' OR b.Board_target = ' . $idx . ') AND Board_state = '.$state.'');
        }else if($state == 2){
            $this->db->join('member m', 'm.User_num = b.User_num  AND (b.User_num = ' . $idx . ' OR b.Board_target = ' . $idx . ') AND Board_state = 0');
        }
        $this->db->order_by('b.Board_num', 'DESC');

        /*AND Board_state = $state*/

        $query = $this->db->get()->result();

        return $query;
    }

    // 타임라인 게시물 등록!
    public function addtimelineBoard($boardValue)
    {
        // 현재 date 값
        $this->db->set('Board_date', 'NOW()', false);
        // inser 구문
        $this->db->insert('board', $boardValue);
    }

    // 댓글 리스트 뽑기
    public function getcommentList()
    {
        $this->db->select('*');
        $this->db->from('comment c');
        $this->db->join('member m', 'c.Cmd_user = m.User_num');
        $this->db->order_by('c.Cmd_num', 'DESC');

        return $this->db->get()->result();
    }

    public function addcomment($addComment)
    {
        // 현재 date 값
        $this->db->set('Cmd_date', 'NOW()', false);
        // inser 구문
        $this->db->insert('comment', $addComment);
    }

    public function deleteBoard($idx)
    {
        $idx = (int)$idx;
        $sql = "DELETE FROM board where idx = :idx";
        $query = $this->db->prepare($sql);
        $query->execute(array(':idx' => $idx));
    }

    public function search($keyword,$user)
    {
        return $this->db->query("select * from board b, member m WHERE b.User_num = m.User_num AND b.User_num != $user AND b.Board_note LIKE '%$keyword%'")->result();
    }

    public function share($shared_num)
    {
       $share = $this->db->query("SELECT * FROM board WHERE Board_num = $shared_num")->row();
       $share_array=array(
            'Page_num'=> $share->Page_num,
            'User_num' => $share->User_num,
            'Board_note' => $share->Board_note,
            'Board_state' => 2,
            'Board_max_price' => $share->Board_max_price,
            'Board_min_price' => $share->Board_min_price,
            'Board_tag' => $share->Board_tag,
            'Board_target' => $share->Board_target,
            'Board_share_user' => $this->session->userdata('loginID'),
        );
        $this->db->set('Board_state', 'NOW()', false);
        // inser 구문
        $result = $this->db->insert('board', $share_array);
        return $result;

    }

     public function cmd_cnt($Board_num)
    {
        $result = $this->db->query("select count(*) AS CNT from comment WHERE Board_num = $Board_num")->row()->CNT;
        return $result;
    }
}

?>
