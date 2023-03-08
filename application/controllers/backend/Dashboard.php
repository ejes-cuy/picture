<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('lelang_model');
		if (!$this->auth_model->current_user()) {
			redirect('backend/auth/login');
		}
	}

	public function index()
	{
		$data['activeUser'] = $this->auth_model->current_user();
		$data['dashboard'] = $this->lelang_model->get_Lelangberlangsung(); //menampilkan data
		$data['laporan'] = $this->lelang_model->get_pemenangLelang();  //menampilkan data

		$this->load->view('backend/dashboard', $data);
	}
}
