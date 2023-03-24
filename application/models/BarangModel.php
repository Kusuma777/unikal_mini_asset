<?php

class BarangModel extends CI_Model
{

	var $table = 'barang B'; //nama tabel dari database
	var	$column_order = array(null, 'B.file_foto', 'B.id_jenis', 'J.nama_jenis', 'B.nama_barang', 'B.status', 'B.stok', 'B.keterangan'); // Field yang ada di tabel barang
	var $column_search = array('B.nama_barang'); // Field yang diizinkan untuk penncarian
	var $order = array('id_barang' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$id_jenis = $this->input->post('id_jenis');

		if (!empty($id_jenis)) {
			$this->db->where("B.id_jenis", $id_jenis);
		}

		$this->db->from($this->table);
		$this->db->join('jenis J', 'B.id_jenis=J.id_jenis');

		// $id_jenis = $this->input->post("id_jenis");
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


	public function join($table, $tbljoin, $join)
	{
		$this->db->join($tbljoin, $join);
		$this->db->order_by('nama_barang', 'ASC');
		return $this->db->get($table)->result_array();
	}

	public function joinById($tbljoin, $join, $id)
	{
		$this->db->join($tbljoin, $join);
		$this->db->where('id_barang', $id);
		return $this->db->get('barang')->row_array();
	}

	public function tambahDataAksi($data)
	{
		$this->db->insert('barang', $data);
	}

	public function updateDataAksi($data)
	{
		$this->db->where('id_barang', $this->input->post('id_barang'));
		$this->db->update('barang', $data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_jenis', 'Jenis barang', 'required|trim', [
			'required' => 'Field jenis barang harus diisi',
		]);
		$this->form_validation->set_rules('nama_barang', 'Barang', 'required|trim', [
			'required' => 'Field barang harus diisi'
		]);
		$this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric', [
			'required' => 'Field stok harus diisi',
			'numeric' => 'Field stok harus berupa angka'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
			'required' => 'Field keterangan harus diisi'
		]);
	}

	public function getDataById($id)
	{
		return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
	}
}
