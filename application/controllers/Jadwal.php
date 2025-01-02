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

		$query_data = [
			'api_key' => 'nongtons-12345678'
		];

		$response = api_get($url, $query_data);

		$data = [
			'title'  => 'Jadwal Film',
			'page'   => 'jadwal',
			'jadwal' => $response->data
		];

		$this->load->view('index', $data);
	}

	public function detail($id)
	{
		$url = "http://localhost/nongtons/api/jadwal_tayang/detail";

		$query_data = [
			'api_key' => 'nongtons-12345678',
			'id'      => $id
		];

		$response = api_get($url, $query_data);

		$data = [
			'title' => 'Detail Jadwal Film',
			'page'  => 'jadwalDetail',
			'film'  => $response->data
		];

		$this->load->view('index', $data);
	}

	public function order()
	{
		$idJadwal = $this->input->post('idJadwal');
		$jumlah   = $this->input->post('jumlah');
		$no_kursi = $this->input->post('no_kursi');

		$url = "http://localhost/nongtons/api/order";

		$data = [
			'api_key'  => 'nongtons-12345678',
			'idUser'   => $this->session->userdata('user_login')['data']->id,
			'idJadwal' => $idJadwal,
			'jumlah'   => $jumlah,
			'no_kursi' => $no_kursi
		];

		$response = api_post($url, $data);

		if ($response->status == 'true') {
			$this->session->set_flashdata('success', $response->message);

			redirect('order', 'refresh');
		} else {
			$this->session->set_flashdata('error', $response->message);

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}

  /* End of file Jadwal.php */
