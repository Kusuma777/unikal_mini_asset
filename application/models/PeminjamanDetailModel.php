<?php

class PeminjamanDetailModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function actionINSERT($data)
	{
		$this->db->insert('peminjaman_detail', $data);

		return $this->db->insert_id();
	}
}
