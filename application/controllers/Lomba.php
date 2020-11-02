<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 23/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Lomba extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->model('Jawaban_model','m_jawaban');
        $this->load->model('Soal_model','m_soal');
        $this->load->model('Pembayaran_model','m_pembayaran');

    }

    public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id')) || $this->session->userdata('privilege') != "peserta"){
            echo '<script>alert("Lakukan login terlebih dahulu");window.location.href="'.base_url('/index.php/auth').'";</script>';
        }
    } 

    public function index()
    {
        // $data['peserta'] = $this->m_peserta->get_by_id($this->session->id);
		
        $data['soal'] = $this->m_soal->get_data_where('examstatus','onprogress');
        $data['jawaban'] = $this->m_jawaban->get_data_where('userid',$this->session->userdata('id'));
        $payment = $this->m_pembayaran->get_data_where('userid',$this->session->userdata('id'));
        
        if($payment != NULL){
            if($payment->paymentstatus == "Confirmed"){
                $this->load->view('lomba/index.php',$data);
            }else{
                echo '<script>alert("Pembayaran belum terkonfirmasi");history.go(-1);</script>';
            }
        }else{
            echo '<script>alert("Lakukan konfirmasi pembayaran terlebih dahulu");history.go(-1);</script>';
        }
       
    }

    public function ajax_download($id)
	{
		$this->load->helper('download');
		
		$data = $this->m_soal->get_by_id($id);
		$file = 'public/soal/'.$data->filepath;
		$filename = $data->examtitle.'.pdf';
		//download file from directory
		force_download($filename,file_get_contents($file));
    }
    

    public function ajax_add()
	{
		
		$data = array(
				'userid' => $this->input->post('userid'),
				'examid' => $this->input->post('examid'),
				'collecttime' => date('Y-m-d H:i:s'),
				'resultstatus' => "unchecked",
			);

        if(!empty($_FILES['filepath']['name'])){
            $upload = $this->_do_upload();
            $data['filepath'] = $upload;
        }

        $insert = $this->m_jawaban->save($data);
        
        echo $this->db->last_query();
		echo json_encode(array("status" => TRUE));
	}

    private function _do_upload()
    {
        $config['upload_path']          = 'public/jawaban/';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['max_size']             = 2048000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
		$this->upload->initialize($config);
        if(!$this->upload->do_upload('filepath')) //upload and validate
        {
            $data['inputerror'][] = 'soal';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
	}
    
}
?>