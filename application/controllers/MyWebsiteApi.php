<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyWebsiteApi extends CI_Controller
{
    public function __construct()
    {
        parent :: __construct();
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');    
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
        $this->load->model('MyWebsiteDatabase');

    }

    public function index()
    {
        if($this->session->has_userdata('count'))
        {
             $count = $this->session->userdata('count');
             $count++;
             $this->session->set_userdata('count',$count);
        }
        else
        {
            $this->session->set_userdata('count',0);
        }
        echo $this->session->userdata('count');
    }
    public function google_api()
    {
        // $this->cache->file->clean();
        if($this->cache->file->is_supported())
        {
            if($this->cache->file->get('count')==null)
            {
                $this->cache->file->save('count',1);
            }
            else
            {
                $count = $this->cache->file->get('count') + 1;
                $this->cache->file->save('count',$count);
            }
            echo $this->cache->file->get('count');
        }
        else
        {
            echo 'File cache not supported';
        }
    }
    public function signup($msg=null)
    {
        $username = $this->session->userdata('username');
        if($username==null)
        {
            $data['msg'] = $msg;
            $this->load->view('components/header');
            $this->load->view('pages/signup',$data);
            $this->load->view('components/footer');
        }
        else
        {
            redirect('MyWebsiteApi/home');
        }
    }

    public function login($msg2=null)
    {   
        $username = $this->session->userdata('username');
        if($username==null)
        {   
            $data['msg'] = $msg2;
            $this->load->view('components/header');
            $this->load->view('pages/login',$data);
            $this->load->view('components/footer');
        }
        else
        {
            redirect('MyWebsiteApi/home');
        }
    }

    public function home()
    {  
        $username = $this->session->userdata('username');
            if($username!=null)
            {
                $this->load->view('components/header');
                $this->load->view('pages/home');
                $this->load->view('components/footer');
            }
            else
            {
                redirect('MyWebsiteApi/login');
            }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect('MyWebsiteApi/login');
    } 

    public function insertDB()
    {
       $data = $this->MyWebsiteDatabase->insertDB();
       
           if($data=='new')
           {
            $response = array('signup'=>'success');
           }
           else if($data=='exists')
           {
            $response = array('signup'=>'exists');
           }
          
          else
            {
             $response = array('signup'=>'failed');
            }
            echo json_encode($response);
    }  

    public function selectDB()
    {
        $data = $this->MyWebsiteDatabase->selectDB();
        if($data!=1)
        {
            if($data=='user')
            {
                $response = array('error'=>'username');
            }
            else
            {
                $response = array('error'=>'password');
            }
        }
        else
        {
            $response = array('error'=>'none');
            // redirect('MyWebsiteApi/home');
        }
        echo json_encode($response);
    }

    public function search()
    {
        $data = $this->MyWebsiteDatabase->search();
        echo json_encode($data);
    }

    public function ajax()
    {
        $this->load->view('pages/ajax');
    }

    public function ajaxApi()
    {
        $data = array('id' => 1);
        // print_r($data);
        echo json_encode($data);        
    }

    public function modal()
    {
        $this->load->view('components/header');
        $this->load->view('components/footer');            
        $this->load->view('pages/modal');
    }
}