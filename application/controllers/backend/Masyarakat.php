<?php

class Masyarakat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('masyarakat_model');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('backend/auth/login');
		}
	}

	public function index()
	{
		$data['title'] = 'List Data Masyarakat';
        $data['activeUser'] = $this->auth_model->current_user();
        $data['masyarakat'] = $this->masyarakat_model->get_all();
        
		$this->load->view('backend/list_masyarakat', $data);
	}
	public function blokir()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '0');
        $update = $this->masyarakat_model->update_masyarakat(array('id_masyarakat' => $id), $data);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diblokir!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diblokir!');
        }
        redirect('backend/masyarakat');
    }
    public function aktifkan()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '1');
        $update = $this->masyarakat_model->update_masyarakat(array('id_masyarakat' => $id), $data);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diaktifkan!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diaktifkan!');
        }
        redirect('backend/masyarakat');
    }
	
}
