<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->cek_login();
        $this->load->model('Soal_model','m_soal');
    }

    public function index()
    {
        $this->load->view('soal/index.php');
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
		$list = $this->m_soal->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $result) {
			$no++;
			$row = array();
			$row[] = $result->id;
			$row[] = $result->examtitle;
            $row[] = !empty($result->filepath) ? "<a class='btn btn-sm btn-link'  href='".base_url().'public/soal/'.$result->filepath."' target='_blank' >View</a>" : "";
            $row[] = $result->examdate;
            $row[] = $result->starttime;
            $row[] = $result->endtime;
            // $row[] = $result->description;
            $row[] = $result->examstatus;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_soal('."'".$result->id."'".')"><i class="fa fa-edit"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_soal('."'".$result->id."'".')"><i class="fa fa-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_soal->count_all(),
						"recordsFiltered" => $this->m_soal->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_soal->get_by_id($id);
		$data->examdate = ($data->examdate == '0000-00-00') ? '' : $data->examdate; // if 0000-00-00 set tu empty for datepicker compatibility
		$data->starttime = ($data->starttime == '00:00') ? '' : $data->starttime; // if 0000-00-00 set tu empty for datepicker compatibility
		$data->endtime = ($data->endtime == '00:00') ? '' : $data->endtime; // if 0000-00-00 set tu empty for datepicker compatibility
		
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'examtitle' => $this->input->post('examtitle'),
				'examdate' => $this->input->post('examdate'),
				'starttime' => $this->input->post('starttime'),
				'endtime' => $this->input->post('endtime'),
				'description' => $this->input->post('description'),
				'examstatus' => "queue"
			);

		if(!empty($_FILES['filepath']['name'])){
			$upload = $this->_do_upload();
			$data['filepath'] = $upload;
		}
		$insert = $this->m_soal->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		
		$this->_validate();
		$data = array(
				'examtitle' => $this->input->post('examtitle'),
				'examdate' => $this->input->post('examdate'),
				'starttime' => $this->input->post('starttime'),
				'endtime' => $this->input->post('endtime'),
				'description' => $this->input->post('description'),
				'examstatus' => $this->input->post('examstatus')
			);
		
			if($this->input->post('remove_file')) // if remove photo checked
			{
				if(file_exists('public/soal/'.$this->input->post('remove_file')) && $this->input->post('remove_file'))
					unlink('public/soal/'.$this->input->post('remove_file'));
				$data['filepath'] = '';
			}
	
			if(!empty($_FILES['filepath']['name']))
			{
				$upload = $this->_do_upload();
				
				//delete file
				$person = $this->m_soal->get_by_id($this->input->post('id'));
				if(file_exists('public/soal/'.$person->filepath) && $person->filepath)
					unlink('public/soal/'.$person->filepath);
	
				$data['filepath'] = $upload;
			}
	
	 
			$this->m_soal->update(array('id' => $this->input->post('id')), $data);
			
			echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_soal->delete_by_id($id);
		
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
    {

        $config['upload_path']          = FCPATH. '/public/soal/';
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
	
	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('examtitle') == '')
        {
            $data['inputerror'][] = 'examtitle';
            $data['error_string'][] = 'Judul Ujian is required';
            $data['status'] = FALSE;
		} 
		
		if($this->input->post('examdate') == '')
        {
            $data['inputerror'][] = 'examdate';
            $data['error_string'][] = 'Tanggal ujian is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('starttime') == '')
        {
            $data['inputerror'][] = 'starttime';
            $data['error_string'][] = 'Waktu mulai ujian is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('endtime') == '')
        {
            $data['inputerror'][] = 'endtime';
            $data['error_string'][] = 'Waktu berakhir ujian is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('description') == '')
        {
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'Deskripsi ujian is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('examstatus') == '')
        {
            $data['inputerror'][] = 'examstatus';
            $data['error_string'][] = 'Status ujian is required';
            $data['status'] = FALSE;
        }
		
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}