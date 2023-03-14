<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailPeminjaman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DetailPeminjamanModel', 'dmodel');
		if (!$this->session->userdata('username')) {
			redirect();
		}
	}

	public function get_data_detail()
	{

		$list = $this->dmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {



			$action = '<center>
						<a class="btn btn-sm btn-primary"  href="' . base_url('detailPeminjaman/updateData/') . $field->id_peminjaman_detail . '"><i class="fas fa-edit"></i></a>
						<a class="btn btn-sm btn-danger tombol-hapus" data-url="' . base_url() . '" data-id="' . $field->id_peminjaman_detail . '"><i class="fas fa-trash"></i></a>
					</center>';

			$no++;
			$row = [];
			$row[] = $no;
			$row[] = $field->nama_peminjam;
			$row[] = $field->nama_jenis;
			$row[] = $field->nama_barang;
			$row[] = '<img src="' . base_url('assets/foto/') . $field->foto_peminjaman . '" width="100" alt="" class="mx-auto mb-2 shadow">';
			$row[] = $field->foto_pengembalian;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dmodel->count_all(),
			"recordsFiltered" => $this->dmodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function index()
	{
		$data['title'] = 'Detail Peminjaman';
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['detail'] = $this->dmodel->join();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('detailPeminjaman/detailPeminjaman', $data);
		$this->load->view('templates/footer');
		$this->load->view('detailPeminjaman/script');
	}

	public function tambahData()
	{
		$data['title'] = 'Form Detail Peminjaman';
		$data['peminjaman'] = $this->db->get('peminjaman')->result_array();
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->db->get('barang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('detailPeminjaman/tambahDetailPeminjaman', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->dmodel->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			// upload foto


			$this->dmodel->tambahDataAksi();
			$this->session->set_flashdata('message', 'Data berhasil ditambahkan');
			redirect('detailPeminjaman');
		}
	}

	public function updateData($id)
	{
		$data['title'] = 'Update Detail Peminjaman';
		$data['detail'] = $this->dmodel->updatejoin($id);
		$data['peminjaman'] = $this->db->get('peminjaman')->result_array();
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['barang'] = $this->db->get('barang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('detailPeminjaman/updateDetailPeminjaman', $data);
		$this->load->view('templates/footer');
	}

	public function updateDataAksi()
	{
		$id = $this->input->post('id_peminjaman_detail');

		$this->update_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->updateData($id);
		} else {
			$this->dmodel->updateDataAksi();
			$this->session->set_flashdata('message', 'Data berhasil diubah');
			redirect('detailPeminjaman');
		}
	}

	public function update_rules()
	{
		$this->form_validation->set_rules('id_jenis', 'Jenis Barang', 'required|trim', [
			'required' => 'Field jenis barang harus diisi'
		]);
		$this->form_validation->set_rules('id_barang', 'Nama Barang', 'required|trim', [
			'required' => 'Field nama Barang harus diisi'
		]);
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->delete('peminjaman_detail', ['id_peminjaman_detail' => $id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus');

		echo json_encode([
			'alert' => 'dashboard/alert', // url alert
			'text' => '/Data berhasil dihapus', // text alert
			'location' => '/detailPeminjaman' // redirect
		]);
	}
}
