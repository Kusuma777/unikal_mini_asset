<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{

	var $title = "Log Activity";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PeminjamanModel', 'pmodel');
		if (!$this->session->userdata('username')) {
			redirect();
		}
	}

	public function index()
	{
		$data = [
			'title' => $this->title
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peminjaman/logPeminjaman', $data);
		$this->load->view('templates/footer');
		$this->load->view('peminjaman/scriptLog');
	}

	public function getLog()
	{
		$result = $this->pmodel->getDataLog();
		$no = $_POST['start'];
		$data = [];
		foreach ($result as $r) {
			$keterangan = '<span class="d-inline-block text-truncate">' . $r->keterangan . ',</span>';
			$waktu = '<span class="text-truncate">pada ' . date('d-m-Y H:i:s', strtotime($r->created_at)) . '</span>';

			$row = [];
			$row[] = ++$no;
			$row[] = $keterangan;
			$row[] = $waktu;
			$data[] = $row;
		}

		$ouput = [
			'draw' => $_POST['draw'],
			'recordsTotal'      => $this->pmodel->count_all_log(),
			'recordsFiltered'   => $this->pmodel->count_filtered_log(),
			'data'              => $data
		];

		echo json_encode($ouput);
	}
}
