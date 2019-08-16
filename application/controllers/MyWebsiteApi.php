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
    public function maps()
    {
        $this->load->view('pages/maps');
    }
    public function chatPusher()
    {
        $this->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '430fda1055afdc1d70da',
            '7d8715d8267744ecc8a9',
            '838370',
            $options
          );
        
          $data['message'] = $this->input->post('message');
          $data['userName'] = $this->input->post('userName');
          $pusher->trigger('channelRiya', 'eventChat', $data);        
    }
    public function chat()
    {
        $this->load->view('pages/chat');
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
        $key = $this->input->get('key');
        $message = "";
        // $this->cache->file->clean();
        if($this->cache->file->is_supported())
        {
            if($this->cache->file->get($key)==null)
            {
                $this->cache->file->save($key,1,1);
            }
            else
            {
                $count = $this->cache->file->get($key) + 1;
                if($count > 1000)
                {
                    $message = 'You have overused the limit';
                }
                else
                {
                    $this->cache->file->save($key,$count);
                }
            }

            if($message=="")
            {
                echo $this->cache->file->get($key);
            }
            else
            {
                echo $message;
            }
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