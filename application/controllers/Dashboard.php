<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Jawaban_model','m_jawaban');
        $this->load->model('Pembayaran_model','m_pembayaran');
        $this->load->model('Peserta_model','m_user');

        $this->cek_login();
        
    }
    
    public function index(){        
        $data['peserta'] = $this->m_user->count_where("privilege","peserta");
        $data['panitia'] = $this->m_user->count_where("privilege","panitia");
        $data['pembayaran'] = $this->m_pembayaran->count_all();
        $data['jawaban'] = $this->m_jawaban->count_all();
        $this->load->view("dashboard",$data);
    }
    
    public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id')) || $this->session->userdata('privilege') != "panitia"){
            echo '<script>alert("Lakukan login terlebih dahulu");window.location.href="'.base_url('/index.php/auth').'";</script>';
        }
    } 
}