<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyWebsiteDatabase extends CI_Model
{
    public function __construct()
    {
        parent :: __construct();

    }

    public function insertDB()
    {
        $insertData = array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'gender'=>$this->input->post('gender'),
                    'pass'=>$this->input->post('pass')
        );
        $email = $this->input->post('email');
        if($_POST['name']!=null && $_POST['email']!=null && $_POST['gender']!=null && $_POST['pass']!=null)
        {   
            $selectData = $this->db->query("select count(*) as count from users where email= '$email'")->row();
            if(empty($selectData->count))
            {
                $this->db->insert('users',$insertData);
                //return $this->db->affected_rows();   
                return "new";
            }
            else
            {
                return "exists";
            }
                     
        }
        return 0;

    }

    public function selectDB()
    {
       $email = $this->input->post('email2'); 
       $pass = $this->input->post('pass2');
    //    $pass = trim($pass);
       $flag1 = $this->db->query("select count(*) as count from users where email= '$email'")->row();
       if(($flag1->count)!=1)
       {
           return "user";
       }
       else 
       {
            $flag2 = $this->db->query("select count(*) as count from users where email= '$email' and pass= '$pass'")->row();
            if(($flag2->count)!=1)
            {
                return "pass";
            }
            else
            {
                $this->session->set_userdata('username',$email);
                return 1;
            }
       }
    }

    public function search()
    {
        $q = $_GET['q'];
        $query = $this->db->query("select * from users where email like('%$q%')")->result_array();
        return $query;
    }

}