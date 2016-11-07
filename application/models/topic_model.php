<?php
class Topic_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function boards(){
    	return $this->db->query("SELECT * FROM board")->result();
    }

    function get($topic_id){
        $this->db->select('id');
        $this->db->select('title');
        $this->db->select('description');
        $this->db->select('UNIX_TIMESTAMP(created) AS created');
    	return $this->db->get_where('topic', array('id'=>$topic_id))->row();
    }

    function add($title,$description){

        // now()가 문자열로 해석되지 않고 쓸 수있는 형태로 바뀜
        $this->db->set('created','NOW()',false);
       $this->db->insert('topic',array(
            'title'=>$title,
            'description'=>$description
        ));

        // db 구문 확인법
        //echo $this->db->last_query();

        return $this->db->insert_id();
    }
}