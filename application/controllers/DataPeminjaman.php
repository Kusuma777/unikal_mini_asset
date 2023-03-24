<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPeminjaman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PeminjamanModel', 'pmodel');
		$this->load->model('PeminjamanDetailModel', 'pdmodel');
		if (!$this->session->userdata('username')) {
			redirect();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Peminjaman';
		$data['peminjaman'] = $this->db->get('peminjaman')->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('peminjaman/dataPeminjaman', $data);
		$this->load->view('templates/footer');
		$this->load->view('peminjaman/script');
	}

	public function status()
	{
		if ($field->status_peminjaman == 1) {
			echo 'dipinjam';
		} elseif ($field->status_peminjaman == 2) {
			echo 'sudah dikembalikan';
		} else {
			echo 'belum dikembalikan';
		}
	}

	public function get_data_peminjaman()
	{

		$list = $this->pmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			if ($field->status_peminjaman == 1) {
				$status = "<span class='badge badge-primary'>Dipinjam</span>";
			} elseif ($field->status_peminjaman == 2) {
				$status = "<span class='badge badge-success'>Sudah dikembalikan</span>";
			} else {
				$status = "<span class='badge badge-danger'>Belum dikembalikan</span>";
			}



			$action = '<center>
						<a class="text-warning mr-1"  href="' . base_url('dataPeminjaman/detail/') . $field->id_peminjaman . '"><i class="fas fa-info-circle"></i></a>
						|
						<a class="text-primary ml-1"  href="' . base_url('dataPeminjaman/updateData/') . $field->id_peminjaman . '"><i class="fas fa-edit text-da"></i></a>
						|
						<a class="text-danger tombol-hapus mx-1" data-url="' . base_url() . '" data-id="' . $field->id_peminjaman . '"><i class="fas fa-trash-alt"></i></a>
					</center>';

			$no++;
			$row = [];
			$row[] = $no;
			$row[] = $field->nama_peminjam;
			$row[] = $field->no_telp;
			$row[] = $field->tgl_dipinjam;
			$row[] = $field->tgl_pengembalian;
			$row[] = $status;
			$row[] = $field->catatan;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pmodel->count_all(),
			"recordsFiltered" => $this->pmodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function tambahData()
	{
		$data['title'] = 'Tambah Data Peminjaman';
		$data['peminjaman'] = $this->db->get('peminjaman')->result_array();
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->db->get('barang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('peminjaman/tambahPeminjaman', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				"status" => 300,
				"message" => "Data Gagal Disimpan"
			]);
		} else {

			$foto1 =  $_FILES['foto_peminjaman']['name'];
			$config['upload_path'] = './assets/foto';
			$config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
			$config['encrypt_name'] = true;
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto_peminjaman', TRUE)) {
				$foto1 = $this->upload->data('file_name');
			} else {
				echo 'Gagal Upload';
			}

			$form_data = $this->input->post('data');
			$id_barang = $this->input->post('barang');
			$barang = json_decode($_POST['barang']);


			var_dump($id_barang);
			die;

			// parse_str($form_data, $form_array);

			// $nama_peminjam = $form_array['nama_peminjam'];
			// $no_telp = $form_array['no_telp'];
			// $tgl_dipinjam = $form_array['tgl_dipinjam'];
			// $tgl_pengenmalian = $form_array['tgl_pengembalian'];
			// $catatan = $form_array['catatan'];

			// $data = [
			// 	'nama_peminjam' => $nama_peminjam,
			// 	'no_telp' => $no_telp,
			// 	'tgl_dipinjam' => $tgl_dipinjam,
			// 	'tgl_pengembalian' => $tgl_pengenmalian,
			// 	'status_peminjaman' => '1',
			// 	'catatan' => $catatan,
			// 	'foto_peminjaman' => $foto1
			// ];

			// $id_peminjaman = $this->pmodel->tambahDataAksi($data);

			// foreach ($id_barang as $key => $val) {
			// 	$data = [
			// 		'id_peminjaman' => $id_peminjaman,
			// 		'id_barang' => $val['id_barang']
			// 	];

			// 	$this->pdmodel->actionINSERT($data);
			// }

			echo json_encode([
				"status" => 200,
				"message" => "Data Berhasil Disimpan"
			]);
		}
	}

	public function updateData($id)
	{
		$data['title'] = 'Update Data Peminjaman';
		$data['detail'] = $this->pmodel->updatejoin($id);
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->db->get('barang')->result_array();
		$data['peminjaman'] = $this->db->get('peminjaman')->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('peminjaman/updatePeminjaman', $data);
		$this->load->view('templates/footer');
		$this->load->view('peminjaman/script');
	}

	public function updateDataAksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->updateData();
		} else {
			$this->pmodel->updateDataAksi();
			$this->session->set_flashdata('main', 'Data berhasil diubah');
			redirect('dataPeminjaman');
		}
	}

	public function updateDataDetail()
	{
		$id = $this->input->post('id');

		$this->_rules();
		$id = $this->input->post('id_peminjaman');
		$peminjaman = $this->pmodel->updateJoin($id);
		$logData = [
			'id_peminjaman'    => $id,
			'keterangan'    => " Barang yang dipinjam oleh " . $peminjaman['nama_peminjam'] . " sudah dikembalikan"
		];
		$this->db->insert('log', $logData);
		$this->pmodel->updateDataAksi($id);
		$this->session->set_flashdata('main', 'Barang sudah dikembalikan');
		redirect('dataPeminjaman');
	}

	public function detail($id)
	{
		$data['title'] = 'Detail Peminjaman';
		$data['detail'] = $this->pmodel->updateJoin($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('Peminjaman/detailPeminjaman', $data);
		$this->load->view('templates/footer');
		$this->load->view('detailPeminjaman/script');
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->pmodel->log_delete($id);
		$this->db->delete('peminjaman', ['id_peminjaman' => $id]);
		$this->session->set_flashdata('main', 'Data berhasil dihapus');

		echo json_encode([
			'alert' => 'dashboard/alert', // url alert
			'text' => '/Data berhasil dihapus', // text alert
		]);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('data', 'Data Peminjam', 'required|trim', [
			'required' => 'Field data peminjam harus diisi'
		]);
		$this->form_validation->set_rules('barang', 'Barang', 'required|trim', [
			'required' => 'Field nama Barang harus diisi'
		]);
	}
}
