<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Jadwal Film',
			'page'  => 'jadwal'
		];

		$this->load->view('index', $data);
	}
}

/* End of file Jadwal.php */
