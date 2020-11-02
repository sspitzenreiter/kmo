<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 5.00pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id'))){
           }
    } 
    
	public function index()
	{
        if(empty($this->session->userdata('id'))){
            $this->load->view('home');
        }else{
            if($this->session->userdata('privilege') == "panitia"){
                redirect("dashboard");
            }else{
                redirect("dashboard_peserta");
            }
        }
       
    }


        
}

/* End of file home.php */