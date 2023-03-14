<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataJenisBarang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('JenisBarang_model', 'Jmodel');
		if (!$this->session->userdata('username')) {
			redirect();
		}
		// $this->load->librarry('form_validation');

	}

	public function index()
	{
		$data['title'] = 'Jenis Barang';
		$data['jenis'] = $this->db->get('jenis')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('jenis/dataJenisBarang', $data);
		$this->load->view('templates/footer');
	}

	public function get_data_jenis()
	{

		$list = $this->Jmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$action = '<center>
						<a class="text-primary ml-1"  href="' . base_url('dataJenis/updateData/') . $field->id_jenis . '"><i class="fas fa-edit"></i></a> 
						|
						<a class="text-danger tombol-hapus mr-1" data-url="' . base_url() . '" data-id="' . $field->id_jenis . '"><i class="fas fa-trash-alt"></i></a>
					</center>';

			$no++;
			$row = [];
			$row[] = $no;
			$row[] = $field->nama_jenis;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Jmodel->count_all(),
			"recordsFiltered" => $this->Jmodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}


	public function tambahData()
	{
		$data['title'] = 'Tambah Jenis Barang';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('jenis/tambahJenisBarang', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis Barang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			$this->Jmodel->tambahDataAksi();

			$this->session->set_flashdata('main', 'Data berhasil ditambahkan');
			redirect('dataJenisBarang');
		}
	}

	public function delete($id)
	{
		$this->db->delete('jenis', ['id_jenis' => $id]);
		$this->session->set_flashdata('main', 'Data berhasil dihapus');
		redirect('dataJenisBarang');
	}

	public function updateData($id)
	{
		$data['title'] = 'Update Jenis Barang';
		$data['jenis'] = $this->Jmodel->getDataById($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('jenis/updateJenisBarang', $data);
		$this->load->view('templates/footer');
	}

	public function updateDataAksi()
	{
		$this->input->post('id_jenis');
		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis Barang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->updateData($id);
		} else {
			$this->Jmodel->updateDataAksi();

			$this->session->set_flashdata('main', 'Data berhasil diupdate');
			redirect('dataJenisBarang');
		}
	}
}
