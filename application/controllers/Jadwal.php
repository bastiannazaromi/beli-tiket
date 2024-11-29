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
		$url = "http://localhost/nongtons/api/jadwal_tayang";

		$username_api = 'admin';
		$password_api = '12345678';

		$query_data = [
			'api_key'  => 'nongtons-12345678'
		];

		$url_with_query = $url . '?' . http_build_query($query_data);

		// Inisialisasi cURL
		$ch = curl_init($url_with_query);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_USERPWD, "$username_api:$password_api");

		$headers = [
			'Accept: application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$this->session->set_flashdata('error', curl_error($ch));

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}

		curl_close($ch);

		$response = json_decode($response);

		$data = [
			'title'  => 'Jadwal Film',
			'page'   => 'jadwal',
			'jadwal' => $response->data
		];

		$this->load->view('index', $data);
	}
}

/* End of file Jadwal.php */
