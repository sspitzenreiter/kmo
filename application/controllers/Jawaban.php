<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class jawaban extends CI_Controller {
    function __construct()
    {
		parent::__construct();
		$this->cek_login();
        $this->load->model('Jawaban_model','m_jawaban');
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
        $this->load->view('jawaban/index.php');
    }
  
	public function ajax_list()
	{
		$list = $this->m_jawaban->get_datatables();
		// echo $this->db->last_query();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $result) {
			$no++;
			$row = array();
			$row[] = $result->id;
			$row[] = $result->fullname;
			$row[] = $result->examtitle;
            $row[] = !empty($result->filepath) ? "<a class='btn btn-sm btn-link'  href='".base_url().'public/jawaban/'.$result->filepath."' target='_blank' >View</a> " : "";
            $row[] = $result->collecttime;
            $row[] = $result->score;
            $row[] = $result->resultstatus;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_jawaban('."'".$result->id."'".')"><i class="fa fa-edit"></i> Edit</a>
					<a class="btn btn-sm btn-success" href="'.base_url().'index.php/jawaban/ajax_download/'.$result->id.'"><i class="fa fa-download"></i> Download</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_jawaban->count_all(),
						"recordsFiltered" => $this->m_jawaban->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->m_jawaban->get_by_id($id);
		$data->collecttime = ($data->collecttime == '0000-00-00') ? '' : $data->collecttime; // if 0000-00-00 set tu empty for datepicker compatibility
		
		echo json_encode($data);
	}

	public function ajax_download($id)
	{
		$this->load->helper('download');
		
		$data = $this->m_jawaban->get_by_id($id);
		$file = 'public/jawaban/'.$data->filepath;
		$filename = $data->examtitle.'_'.$data->userid.'_'.$data->fullname.'.pdf';
		//download file from directory
		force_download($filename,file_get_contents($file));
	}

	public function ajax_update()
	{
		
		$this->_validate();
		$data = array(
				'score' => $this->input->post('score'),
				'resultstatus' => $this->input->post('resultstatus')
			);
		
			$this->m_jawaban->update(array('id' => $this->input->post('id')), $data);
			
			echo json_encode(array("status" => TRUE));
	}

	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
	 
		if($this->input->post('score') == '')
        {
            $data['inputerror'][] = 'score';
            $data['error_string'][] = 'Nilai is required';
            $data['status'] = FALSE;
		}
		
        if($this->input->post('resultstatus') == '')
        {
            $data['inputerror'][] = 'resultstatus';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }
		
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}