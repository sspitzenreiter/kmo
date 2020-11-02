<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_peserta extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->cek_login();
    }

    public function index(){

        $this->load->view("dashboard_peserta");
        
    }

    public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id')) || $this->session->userdata('privilege') != "peserta"){
            echo '<script>alert("Lakukan login terlebih dahulu");window.location.href="'.base_url('/index.php/auth').'";</script>';
        }
    } 

}