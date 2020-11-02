<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_pembayaran extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->cek_login();
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
        $data['confirm_payment'] = $this->m_pembayaran->get_data_where('userid',$this->session->userdata('id'));
        $this->load->view('konfirmasi_pembayaran/index.php',$data);
    }

    public function ajax_update()
	{
		
		$this->_validate();
		$data = array(
				'userid' => $this->input->post('userid'),
				'accountname' => $this->input->post('accountname'),
				'bank' => $this->input->post('bank'),
				'paymentstatus' => $this->input->post('paymentstatus'),
			);
		
			if($this->input->post('remove_photo')) // if remove photo checked
			{
				if(file_exists('public/payment_slip/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
					unlink('public/payment_slip/'.$this->input->post('remove_photo'));
				$data['paymentslip'] = '';
			}
	
			if(!empty($_FILES['paymentslip']['name']))
			{
				$upload = $this->_do_upload();
				
				//delete file
				$person = $this->m_pembayaran->get_by_id($this->input->post('id'));
				if(file_exists('public/payment_slip/'.$person->paymentslip) && $person->paymentslip)
					unlink('public/payment_slip/'.$person->paymentslip);
	
				$data['paymentslip'] = $upload;
			}
	
	 
			$this->m_pembayaran->update(array('id' => $this->input->post('id')), $data);
			
			echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_add()
	{
		$data = array(
            'userid' => $this->input->post('userid'),
            'accountname' => $this->input->post('accountname'),
            'bank' => $this->input->post('bank'),
            'paymentstatus' => "Unconfirmed",
		);

		if(!empty($_FILES['paymentslip']['name'])){
            $upload = $this->_do_upload();
          
            
			$data['paymentslip'] = $upload;
		}
        
        $insert = $this->m_pembayaran->save($data);
		echo json_encode(array("status" => TRUE));
    }
    
    private function _do_upload()
    {
        $config['upload_path']          = FCPATH.'public/payment_slip/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
        
        
        $this->upload->initialize($config);       
        
        if(!$this->upload->do_upload('paymentslip')) //upload and validate
        {
            $data['inputerror'][] = 'paymentslip';
            $data['error_string'][] = $this->upload->data('file_name'); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
	}
}