<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!empty($this->session->userdata('user_login'))) {
			if ($this->uri->segment(2) != 'logout') {
				$this->session->set_flashdata('error', 'Anda sudah login');

				redirect('dashboard', 'resfresh');
			}
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Halaman Login'
		];

		$this->load->view('login', $data);
	}

	public function proses()
	{
		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username tidak boleh kosong !',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
			'required' => 'Password harap di isi !',
			'min_length' => 'Password kurang dari 3'
		]);

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());

			redirect('login', 'refresh');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$url = "http://localhost/nongtons/api/user/login";

			$data = [
				'api_key'  => 'nongtons-12345678',
				'username' => $username,
				'password' => $password
			];

			$response = api_post($url, $data);

			if ($response->status == true && $response->message == 'Login berhasil') {
				$login = [
					'is_logged_in' => true,
					'data'         => $response->data,
				];

				if ($login) {
					$this->session->set_userdata('user_login', $login);
				}

				$this->session->set_flashdata('success', $response->message);

				redirect('dashboard', 'refresh');
			} else {
				$this->session->set_flashdata('error', $response->message);

				redirect('login', 'refresh');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}

/* End of file Login.php */
