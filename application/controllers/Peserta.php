<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->cek_login();
        $this->load->model('Peserta_model','m_peserta');
    }

    public function index()
    {
        $this->load->view('peserta/index.php');
    }

	public function cek_login()
    {
        $this->load->library('session');
        if(empty($this->session->userdata('id')) || $this->session->userdata('privilege') != "panitia"){
            echo '<script>alert("Lakukan login terlebih dahulu");window.location.href="'.base_url('/index.php/auth').'";</script>';
        }
	} 
    
	public function ajax_list()
	{
		$list = $this->m_peserta->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $result) {
			$no++;
			$row = array();
			$row[] = $result->nisn;
            $row[] = $result->fullname;
            $row[] = $result->email;
			$row[] = $result->gender;
			$row[] = $result->phoneNumber;
            $row[] = $result->school;
			$row[] = !empty($result->photo) ? '<a href="'.base_url('public/photo/'.$result->photo).'" target="_blank"><img src="'.base_url('public/photo/'.$result->photo).'" class="img-responsive" /></a>' : '(No photo)';
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_peserta('."'".$result->id."'".')"><i class="fa fa-edit"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_peserta('."'".$result->id."'".')"><i class="fa fa-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_peserta->count_all(),
						"recordsFiltered" => $this->m_peserta->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_peserta->get_by_id($id);
		$data->dateOfBirth = ($data->dateOfBirth == '0000-00-00') ? '' : $data->dateOfBirth; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$salt = $this->string_generator();
		$data = array(
				'nisn' => $this->input->post('nisn'),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'school' => $this->input->post('school'),
				'address' => $this->input->post('address'),
				'phoneNumber' => $this->input->post('phoneNumber'),
				'dateOfBirth' => $this->input->post('dateOfBirth'),
				'salt' => $salt,
				'password' =>  md5($this->input->post('password').$salt),
				'privilege' => "Peserta"
			);

		if(!empty($_FILES['photo']['name'])){
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}
		$insert = $this->m_peserta->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		
		$this->_validate();
		$data = array(
			'nisn' => $this->input->post('nisn'),
			'fullname' => $this->input->post('fullname'),
			'gender' => $this->input->post('gender'),
			'school' => $this->input->post('school'),
			'address' => $this->input->post('address'),
			'phoneNumber' => $this->input->post('phoneNumber'),
			'dateOfBirth' => $this->input->post('dateOfBirth'),
			
			);
		
			if($this->input->post('remove_photo')) // if remove photo checked
			{
				if(file_exists('public/photo/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
					unlink('public/photo/'.$this->input->post('remove_photo'));
				$data['photo'] = '';
			}
	
			if(!empty($_FILES['photo']['name']))
			{
				$upload = $this->_do_upload();
				
				//delete file
				$person = $this->m_peserta->get_by_id($this->input->post('id'));
				if(file_exists('public/photo/'.$person->photo) && $person->photo)
					unlink('public/photo/'.$person->photo);
	
				$data['photo'] = $upload;
			}
	
	 
			$this->m_peserta->update(array('id' => $this->input->post('id')), $data);
			
			echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_peserta->delete_by_id($id);
		
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
    {
        $config['upload_path']          = FCPATH.'public/photo/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);   
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
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
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('fullname') == '')
        {
            $data['inputerror'][] = 'fullname';
            $data['error_string'][] = 'Nama lengkap is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('dateOfBirth') == '')
        {
            $data['inputerror'][] = 'dateOfBirth';
            $data['error_string'][] = 'Tanggal lahir is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('gender') == '')
        {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('phoneNumber') == '')
        {
            $data['inputerror'][] = 'phoneNumber';
            $data['error_string'][] = 'No Handphone is required';
            $data['status'] = FALSE;
        }
 
		
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}