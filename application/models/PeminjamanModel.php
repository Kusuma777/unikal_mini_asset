<?php

class PeminjamanModel extends CI_Model
{

	var $table = 'peminjaman'; //nama tabel dari database
	var	$column_order = array(null, 'nama_peminjam', 'no_telp', 'tgl_dipinjam', 'tgl_pengembalian', 'status_peminjaman', 'catatan'); // Field yang ada di tabel barang
	var $column_search = array('nama_peminjam'); // Field yang diizinkan untuk penncarian
	var $order = array('id_peminjaman' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$status_peminjaman = $this->input->post('status_peminjaman');

		if (!empty($status_peminjaman)) {
			$this->db->where("status_peminjaman", $status_peminjaman);
		}

		// $this->db->join('jenis J', 'B.id_jenis=J.id_jenis');

		$this->db->from($this->table);
		$status_peminjaman = $this->input->post("status_peminjaman");
		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function updateJoin($id)
	{
		// $this->db->join('barang', 'peminjaman.id_barang = barang.id_barang');
		// $this->db->join('jenis', 'peminjaman.id_jenis = jenis.id_jenis');
		$this->db->where('id_peminjaman', $id);
		return $this->db->get('peminjaman')->row_array();
	}

	public function tambahDataAksi($data)
	{
		$this->db->insert('peminjaman', $data);

		return $this->db->insert_id();
	}

	public function updateDataAksi($data)
	{
		$foto1 = $_FILES['foto_peminjaman']['name'];
		$config['upload_path'] = './assets/foto';
		$config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
		$config['encrypt_name'] = true;
		$config['max_size'] = 2048;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_peminjaman', TRUE)) {

			$foto1 = $this->upload->data('file_name');
			$foto1 = $_FILES['foto_peminjaman']['name'];
			$this->db->set('foto_peminjaman', $foto1);
		} else {
			echo $this->upload->display_errors();
		}


		$foto2 = $_FILES['foto_pengembalian']['name'];
		$config['upload_path'] = './assets/foto';
		$config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_pengembalian', TRUE)) {
			$foto2 = $this->upload->data('file_name');
			$foto2 = $_FILES['foto_pengembalian']['name'];
			$this->db->set('foto_pengembalian', $foto2);
		} else {
			echo $this->upload->display_errors();
		}

		$data = [
			'status_peminjaman' => $this->input->post('status_peminjaman', TRUE),
			'nama_peminjam' => $this->input->post('nama_peminjam', TRUE),
			'no_telp' => $this->input->post('no_telp', TRUE),
			'tgl_dipinjam' => $this->input->post('tgl_dipinjam', TRUE),
			'tgl_pengembalian' => $this->input->post('tgl_pengembalian', TRUE),
			'catatan' => $this->input->post('catatan', TRUE),
		];

		$this->db->where('id_peminjaman', $this->input->post('id_peminjaman', TRUE));
		$this->db->update('peminjaman', $data);
	}

	public function logById($id)
	{
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get_where('log', ['id_service' => $id])->result_array();
	}

	public function log_delete($id)
	{

		$peminjaman = $this->updateJoin($id);
		$logData = [
			'id_peminjaman'    => $id,
			'keterangan'    => $this->session->userdata('username') . " mengahapus data peminjaman " . $peminjaman['nama_peminjam']
		];
		$this->db->insert('log', $logData);
	}

	private function _getDataQueryLog()
	{
		$tgl_awal = $this->input->post('awal');
		$tgl_akhir = $this->input->post('akhir');

		$this->db->from('log');

		if (!empty($tgl_awal)) {
			$this->db->where('created_at >=', $tgl_awal . " 00:00:00");
		}
		if (!empty($tgl_akhir)) {
			$this->db->where('created_at <=', $tgl_akhir . " 25:60:60");
		}

		if (isset($_POST['search']['value'])) {
			$this->db->like('keterangan', $_POST['search']['value']);
		}

		if (isset($_POST['order'])) {

			$this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('created_at', 'DESC');
		}
	}

	public function getDataLog()
	{
		$this->_getDataQueryLog();
		if ($_POST['length'] != 1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get()->result();
		return $query;
	}

	public function count_filtered_log()
	{
		$this->_getDataQueryLog();
		$query = $this->db->get()->num_rows();
		return $query;
	}

	public function count_all_log()
	{
		$this->db->from('log');
		return $this->db->count_all_results();
	}
}
