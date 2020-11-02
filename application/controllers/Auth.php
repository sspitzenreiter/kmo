<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Auth_model','m_auth');
		$this->load->model('Web_App_model','web_app_model');
	}

	public function index()
	{	
		$this->load->view('auth/signin_form');
    }

    public function daftar(){
        $this->load->view('auth/signup_form');
    }

	public function login()
	{
		$u = $this->input->post("email");
		$p = $this->input->post("password");
		$this->form_validation->set_rules('email', 'Email address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        
		if ($this->form_validation->run() == FALSE) {
			$errors = $this->form_validation->error_array();
			$this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('input', $this->input->post());
			redirect('auth'); // LOGIN
		
		} else {
		    
			$check = $this->m_auth->do_auth($u,$p);
		    print_r($check);
			if (!empty($check)){
				$this->session->set_userdata('id', $check['id']);
				$this->session->set_userdata('fullname', $check['fullname']);
                $this->session->set_userdata('email', $check['email']);
                $this->session->set_userdata('privilege', $check['privilege']);
				if($check['privilege'] == "panitia"){
					redirect('dashboard');
				} elseif($check['privilege'] == "peserta") {
					redirect('dashboard_peserta');	
				}
			}else{
			    redirect('auth');
			}
		}
	}

	public function register(){
		
		$this->form_validation->set_rules('fullname', 'Nama Peserta','required');
		$this->form_validation->set_rules('email', 'Email','required|valid_email');
		$this->form_validation->set_rules('no_hp', 'No Handphone','required|numeric');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
		
		if ($this->form_validation->run() == TRUE) {			
			$password = $this->input->post("password");
			$salt = $this->string_generator();
			
			$data = array ( 
				'fullname' => $this->input->post("fullname"),
				'email' => $this->input->post("email"),
				'salt' => $salt,
				'password' => md5($password.$salt),
            	'phoneNumber' => $this->input->post("no_hp"),
				'gender' => $this->input->post("gender"),
				'privilege' => "peserta"
			);

			$insert = $this->web_app_model->insert_data("user", $data);
			$this->session->set_flashdata('success_register','Proses Pendaftaran User Berhasil');
			redirect('auth');
		} else 
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('home');
		}
	}

	private function string_generator($length = 64){
        $string = '';
        // You can define your own characters here.
        $characters = "123456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }

        return $string;
	}
	
	public function signout()
    {
    	
	    $this->session->sess_destroy();
	    $this->session->__construct();
	    
	    redirect('home');
	}
}
