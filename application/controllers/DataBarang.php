<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataBarang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('BarangModel', 'bmodel');
		if (!$this->session->userdata('username')) {
			redirect();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Barang';
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->bmodel->join('barang', 'jenis', 'barang.id_jenis=jenis.id_jenis');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('barang/dataBarang', $data);
		$this->load->view('templates/footer');
		$this->load->view('barang/script');
	}

	public function get_data_barang()
	{

		$list = $this->bmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$action = '<center>
						<a class="text-primary ml-1"  href="' . base_url('dataBarang/updateData/') . $field->id_barang . '"><i class="fas fa-edit"></i></a> 
						|
						<a class="text-danger tombol-hapus mr-1" data-url="' . base_url() . '" data-id="' . $field->id_barang . '"><i class="fas fa-trash-alt"></i></a>
					</center>';

			$no++;
			$row = [];
			$row[] = $no;
			$row[] = '<img src="' . base_url('assets/foto/') . $field->file_foto . '" width="100" alt="" class="mx-auto mb-2 shadow">';
			$row[] = $field->nama_jenis;
			$row[] = $field->nama_barang;
			$row[] = $field->status;
			$row[] = $field->stok;
			$row[] = $field->keterangan;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bmodel->count_all(),
			"recordsFiltered" => $this->bmodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}


	public function tambahData()
	{
		$data['title'] = 'Tambah Barang';
		$data['barang'] = $this->db->get('jenis')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('barang/tambahBarang', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->bmodel->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			// upload foto
			$foto = $_FILES['file_foto']['name'];
			$config['upload_path'] = './assets/foto';
			$config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
			$config['encrypt_name'] = true;
			$config['max_size'] = 2048;


			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_foto', TRUE)) {
				$foto = $this->upload->data('file_name');
			} else {
				echo 'Gagal Upload';
			}

			$data = [
				'id_jenis' => $this->input->post('id_jenis', TRUE),
				'nama_barang' => $this->input->post('nama_barang', TRUE),
				'status' => 'tersedia',
				'stok' => $this->input->post('stok', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
				'file_foto' => $foto
			];
			$this->bmodel->tambahDataAksi($data);

			$this->session->set_flashdata('main', 'Data berhasil ditambahkan');
			redirect('dataBarang');
		}
	}

	public function updateData($id)
	{
		$data['title'] = 'update Barang';
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->bmodel->joinById('jenis', 'barang.id_jenis=jenis.id_jenis', $id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('barang/updateBarang', $data);
		$this->load->view('templates/footer');
	}

	public function updateDataAksi()
	{
		$id = $this->input->post('id_barang');

		$this->bmodel->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->updateData($id);
		} else {
			$foto = $_FILES['file_foto']['name'];
			if ($foto) {
				$config['upload_path'] = './assets/foto';
				$config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
				$config['encrypt_name'] = true;
				$config['max_size'] = 2048;

				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_foto')) {
					$foto = $this->upload->data('file_name');
					$this->db->set('file_foto', $foto);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'id_jenis' => $this->input->post('id_jenis', TRUE),
				'nama_barang' => $this->input->post('nama_barang', TRUE),
				'status' => 'Tersedia',
				'stok' => $this->input->post('stok', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),

			];

			$this->bmodel->updateDataAksi($data);

			$this->session->set_flashdata('main', 'Data berhasil diubah');
			redirect('dataBarang');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->delete('barang', ['id_barang' => $id]);
		$this->session->set_flashdata('main', 'Data berhasil dihapus');

		echo json_encode([
			'alert' => 'dashboard/alert', // url alert
			'text' => '/Data berhasil dihapus', // text alert
		]);
	}
}
