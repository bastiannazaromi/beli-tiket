<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
		$url = "http://localhost/nongtons/api/order";

		$query_data = [
			'api_key' => 'nongtons-12345678',
			'idUser'  => $this->session->userdata('user_login')['data']->id,
		];

		$response = api_get($url, $query_data);

		$data = [
			'title' => 'List Order Tiket',
			'page'  => 'order',
			'order' => $response->data
		];

		$this->load->view('index', $data);
	}

	public function delete($id)
	{
		$url = "http://localhost/nongtons/api/order";

		$data = [
			'api_key' => 'nongtons-12345678',
			'id'      => $id
		];

		$response = api_delete($url, $data);

		if ($response->status == true) {
			$this->session->set_flashdata('success', $response->message);
		} else {
			$this->session->set_flashdata('error', $response->message);
		}

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	public function update()
	{
		$id       = $this->input->post('id');
		$jumlah   = $this->input->post('jumlah');
		$no_kursi = $this->input->post('no_kursi');

		$url = "http://localhost/nongtons/api/order";

		$data = [
			'api_key'  => 'nongtons-12345678',
			'id'       => $id,
			'jumlah'   => $jumlah,
			'no_kursi' => $no_kursi
		];

		$response = api_put($url, $data);

		if ($response->status == 'true') {
			$this->session->set_flashdata('success', $response->message);

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', $response->message);

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}

  /* End of file Order.php */
