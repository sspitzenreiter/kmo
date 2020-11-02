<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->cek_login();
        $this->load->model('Pembayaran_model','m_pembayaran');
    }

	public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id')) || $this->session->userdata('privilege') != "panitia"){
            echo '<script>alert("Lakukan login terlebih dahulu");window.location.href="'.base_url('/index.php/auth').'";</script>';
        }
	} 
	
    public function index()
    {
		// $this->load->model('Peserta_model','peserta');
		// $data['user'] = $this->peserta->get_datatables();
        $this->load->view('pembayaran/index.php');
    }
    
	public function ajax_list()
	{
		$list = $this->m_pembayaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $result) {
			$no++;
			$row = array();
			$row[] = $result->id;
            $row[] = $result->fullname;
            $row[] = $result->accountname;
            $row[] = $result->bank;
			$row[] = !empty($result->paymentslip) ? '<a href="'.base_url('public/payment_slip/'.$result->paymentslip).'" target="_blank"><img src="'.base_url('public/payment_slip/'.$result->paymentslip).'" class="img-responsive" /></a>' : '(No photo)';
            $row[] = $result->paymentstatus;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pembayaran('."'".$result->id."'".')"><i class="fa fa-edit"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pembayaran('."'".$result->id."'".')"><i class="fa fa-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_pembayaran->count_all(),
						"recordsFiltered" => $this->m_pembayaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_pembayaran->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'userid' => $this->input->post('userid'),
				'accountname' => $this->input->post('accountname'),
				'bank' => $this->input->post('bank'),
				'status' => $this->input->post('status'),		
			);

		if(!empty($_FILES['paymentslip']['name'])){
			$upload = $this->_do_upload();
			$data['paymentslip'] = $upload;
		}
		$insert = $this->m_pembayaran->save($data);
		echo json_encode(array("status" => TRUE));
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

	public function ajax_delete($id)
	{
		$this->m_pembayaran->delete_by_id($id);
		
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
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
	}
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('userid') == '')
        {
            $data['inputerror'][] = 'userid';
            $data['error_string'][] = 'Peserta is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('accountname') == '')
        {
            $data['inputerror'][] = 'accountname';
            $data['error_string'][] = 'Account name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('bank') == '')
        {
            $data['inputerror'][] = 'bank';
            $data['error_string'][] = 'Bank is required';
            $data['status'] = FALSE;
        }
 
		
        if($this->input->post('paymentstatus') == '')
        {
            $data['inputerror'][] = 'paymentstatus';
            $data['error_string'][] = 'Please select status';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}