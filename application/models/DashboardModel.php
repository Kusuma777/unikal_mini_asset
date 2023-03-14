<?php

class DashboardModel extends CI_Model {

	public function getJenis()
	{
		return $this->db->get('jenis')->num_rows();
	}

	public function getBarang()
	{
		return $this->db->get('barang')->num_rows();
	}

	public function getPeminjaman()
	{
		return $this->db->get('peminjaman')->num_rows();
	}

}
