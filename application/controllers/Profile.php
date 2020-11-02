<?php
/**
 * Created by Alifia Syalsabila.
 * User: alifiaasyalsabila
 * Date: 08/10/2020
 * Time: 1.51pm
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->cek_login();
        $this->load->model('Peserta_model','m_peserta');
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
        $data['peserta'] = $this->m_peserta->get_by_id($this->session->id);
		$data['peserta']->dateOfBirth = ($data['peserta']->dateOfBirth == '0000-00-00') ? '' : $data['peserta']->dateOfBirth; // if 0000-00-00 set tu empty for datepicker compatibility
        $data['payment'] = $this->m_pembayaran->get_data_where('userid',$this->session->userdata('id'));
        
        $this->load->view('profile/index.php',$data);
    }
    
    public function ajax_edit($id)
	{
		$data = $this->m_peserta->get_by_id($id);
		$data->dateOfBirth = ($data->dateOfBirth == '0000-00-00') ? '' : $data->dateOfBirth; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
    }
    
	public function ajax_update()
	{
		$data = array(
                'nisn' => $this->input->post('nisn'),
                'fullname' => $this->input->post('fullname'),
                'gender' => $this->input->post('gender'),
                'school' => $this->input->post('school'),
                'address' => $this->input->post('address'),
                'phoneNumber' => $this->input->post('phoneNumber'),
                'dateOfBirth' => $this->input->post('dateOfBirth'),
                
			);
            
            $password = $this->input->post('password');
            if(!empty($password)){
                $salt = $this->string_generator();
                $data['salt'] = $salt;
				$data['password'] = md5($password.$salt);
            }

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
    private function string_generator($length = 64){
        $string = '';
        // You can define your own characters here.
        $characters = "123456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }

        return $string;
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
        
        // echo $this->upload->do_upload('photo');
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
}
?>