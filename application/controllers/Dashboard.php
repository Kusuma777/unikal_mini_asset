<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DashboardModel', 'dmodel');
	}

	public function index()
	{
		if (!$this->session->userdata('username')) {
			redirect();
		} else {

			$data = [
				'title'   	 => 'Dashboard',
				'log'		 => $this->_getLog(),
				'jenis' 	 => $this->dmodel->getjenis(),
				'peminjaman' => $this->dmodel->getPeminjaman(),
				'barang'	 => $this->dmodel->getBarang(),
			];

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('templates/footer');
		}
	}


	public function alert($text, $location)
	{
		if ($this->session->flashdata('message')) {
			$newText = str_replace('%20', ' ', $text);

			$this->session->set_flashdata('message', $newText);
			redirect($location);
		} else {
			redirect('alert/' . $text . '/' . $location);
		}
	}

	private function _getLog()
	{
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(10);
		return $this->db->get('log')->result_array();
	}
}
