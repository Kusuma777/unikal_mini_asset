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
		$this->db->join('barang', 'peminjaman.id_barang = barang.id_barang');
		$this->db->join('jenis', 'peminjaman.id_jenis = jenis.id_jenis');
		$this->db->where('id_peminjaman', $id);
		return $this->db->get('peminjaman')->row_array();
	}

	public function tambahDataAksi()
	{
		$foto1 = $_FILES['foto_peminjaman']['name'];
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

		$data = [
			'nama_peminjam' => $this->input->post('nama_peminjam', TRUE),
			'no_telp' => $this->input->post('no_telp', TRUE),
			'tgl_dipinjam' => $this->input->post('tgl_dipinjam', TRUE),
			'tgl_pengembalian' => $this->input->post('tgl_pengembalian', TRUE),
			'status_peminjaman' => '1',
			'catatan' => $this->input->post('catatan', TRUE),
			'id_jenis' => $this->input->post('id_jenis', TRUE),
			'id_barang' => $this->input->post('id_barang', TRUE),
			'foto_peminjaman' => $foto1
		];

		$this->db->insert('peminjaman', $data);
	}

	public function updateDataAksi()
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
			'id_barang' => $this->input->post('id_barang', TRUE),
			'id_jenis' => $this->input->post('id_jenis', TRUE),
			'status_peminjaman' => $this->input->post('status_peminjaman', TRUE),
			'tambah' => $this->input->post('tambah', TRUE),
			'nama_peminjam' => $this->input->post('nama_peminjam', TRUE),
			'no_telp' => $this->input->post('no_telp', TRUE),
			'tgl_dipinjam' => $this->input->post('tgl_dipinjam', TRUE),
			'tgl_pengembalian' => $this->input->post('tgl_pengembalian', TRUE),
			'catatan' => $this->input->post('catatan', TRUE),
		];

		$this->db->where('id_peminjaman', $this->input->post('id_peminjaman', TRUE));
		$this->db->update('peminjaman', $data);
	}
}
