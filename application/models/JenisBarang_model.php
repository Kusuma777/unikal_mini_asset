<?php

class JenisBarang_model extends CI_Model
{

	var $table = 'jenis'; //nama tabel dari database
	var	$column_order = array(null, 'nama_jenis'); // Field yang ada di tabel barang
	var $column_search = array('nama_jenis'); // Field yang diizinkan untuk penncarian
	var $order = array('id_jenis' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$id_jenis = $this->input->post('id_jenis');

		if (!empty($id_jenis)) {
			$this->db->where("id_jenis", $id_jenis);
		}

		$this->db->from($this->table);

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

	public function tambahDataAksi()
	{
		$data = [
			'nama_jenis' => htmlspecialchars($this->input->post('nama_jenis', TRUE)),
		];

		$this->db->insert('jenis', $data);
	}

	public function updateDataAksi()
	{
		$data = [
			'nama_jenis' => htmlspecialchars($this->input->post('nama_jenis', TRUE)),
		];

		$this->db->where('id_jenis', $this->input->post('id_jenis'));
		$this->db->update('jenis', $data);
	}

	public function getDataById($id)
	{
		return $this->db->get_where('jenis', ['id_jenis' => $id])->row_array();
	}
}
