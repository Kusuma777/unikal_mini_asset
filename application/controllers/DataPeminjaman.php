<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPeminjaman extends CI_Controller
{

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

			$this->tambahData();

			echo json_encode([
				"status" => 300,
				"message" => "Data Gagal Disimpan"
			]);
		} else {
			var_dump($this->input->post('data'));
			var_dump($this->input->post('id_barang'));
			die;
			$this->pmodel->tambahDataAksi();
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
		$id = $this->input->post('id_peminjaman_detail');

		$this->_rules();
		// if( $this->form_validation->run() == FALSE) {
		// 	$this->detail($id);
		// } else {
		$this->pmodel->updateDataAksi();
		$this->session->set_flashdata('main', 'Barang sudah dikembalikan');
		redirect('dataPeminjaman');
		// }
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

		$this->db->delete('peminjaman', ['id_peminjaman' => $id]);
		$this->session->set_flashdata('main', 'Data berhasil dihapus');

		echo json_encode([
			'alert' => 'dashboard/alert', // url alert
			'text' => '/Data berhasil dihapus', // text alert
		]);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'required|trim', [
			'required' => 'Field nama peminjam harus diisi'
		]);
		$this->form_validation->set_rules('no_telp', 'Nomor Telp/Wa', 'required|trim|min_length[11]', [
			'required' => 'Field nomor telp/Wa harus diisi',
			'min_length' => 'Nomor telp/wa terlalu pendek pastikan nomer dengan benar',
		]);
		$this->form_validation->set_rules('tgl_dipinjam', 'Tanggal Dipinjam', 'required|trim', [
			'required' => 'Tanggal dipinjam harus diisi',
		]);
		$this->form_validation->set_rules('tgl_pengembalian', 'Tanggal Pengembalian', 'required|trim', [
			'required' => 'Tanggal pengembalian harus diisi',
		]);
		$this->form_validation->set_rules('id_jenis', 'Jenis Barang', 'required|trim', [
			'required' => 'Field jenis barang harus diisi'
		]);
		$this->form_validation->set_rules('id_barang', 'Nama Barang', 'required|trim', [
			'required' => 'Field nama Barang harus diisi'
		]);
	}
}
