<?php

class DetailPeminjamanModel extends CI_Model{

	var $table = 'peminjaman_detail D'; //nama tabel dari database
	var	$column_order = array('D.id_peminjaman_detail', 'D.id_peminjaman', 'B.nama_jenis', 'J.nama_jenis', 'D.foto_peminjaman', 'D.foto_pengembalian' ); // Field yang ada di tabel barang
	var $column_search = array('P.nama_peminjam'); // Field yang diizinkan untuk penncarian
	var $order = array('id_peminjaman_detail' => 'desc');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	private function _get_datatables_query()
    {

		$id_jenis = $this->input->post('id_jenis');

		if(!empty($id_jenis)){
			$this->db->where("B.id_jenis", $id_jenis);
		}

        $this->db->from($this->table);
		$this->db->join('jenis J', 'D.id_jenis=J.id_jenis');
		$this->db->join('barang B', 'D.id_barang=B.id_barang');
		$this->db->join('Peminjaman P', 'D.id_peminjaman=P.id_peminjaman');

		$id_jenis = $this->input->post("id_jenis");
        $i = 0;
    
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
            
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
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

	public function join()
	{		
		$this->db->join('jenis', 'peminjaman_detail.id_jenis = jenis.id_jenis');
		$this->db->join('barang', 'peminjaman_detail.id_barang = barang.id_barang');
		$this->db->join('peminjaman', 'peminjaman_detail.id_peminjaman = peminjaman.id_peminjaman');
		return $this->db->get('peminjaman_detail')->result_array();
	}

	public function updateJoin($id)
	{		
		$this->db->join('jenis', 'peminjaman_detail.id_jenis = jenis.id_jenis');
		$this->db->join('barang', 'peminjaman_detail.id_barang = barang.id_barang');
		$this->db->join('peminjaman', 'peminjaman_detail.id_peminjaman = peminjaman.id_peminjaman');
		$this->db->where('id_peminjaman_detail', $id);
		return $this->db->get('peminjaman_detail')->row_array();
	}

	public function tambahDataAksi()
	{
		$foto1 = $_FILES['foto_peminjaman']['name'];
		$config ['upload_path'] = './assets/foto';
		$config ['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
		$config ['encrypt_name'] = true;
		$config ['max_size'] = 2048;
		
		$this->load->library('upload', $config);

		if( $this->upload->do_upload('foto_peminjaman', TRUE)) { 
			$foto1 = $this->upload->data('file_name');
		} else {
			echo 'Gagal Upload';
		}

			$data = [
				'id_jenis' => $this->input->post('id_jenis', TRUE),
				'id_barang' => $this->input->post('id_barang', TRUE),
				'id_peminjaman' => $this->input->post('id_peminjaman', TRUE),
				'foto_peminjaman' => $foto1
			];

			$this->db->insert('peminjaman_detail', $data);
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_peminjaman', 'Nama Peminjam', 'required|trim',[
			'required' => 'Field nama peminjam harus diisi'
		]);
		$this->form_validation->set_rules('id_jenis', 'Jenis Barang', 'required|trim',[
			'required' => 'Field jenis barang harus diisi'
		]);
		$this->form_validation->set_rules('id_barang', 'Nama Barang', 'required|trim',[
			'required' => 'Field nama Barang harus diisi'
		]);
		
	}

	public function updateDataAksi()
	{
		$foto1 = $_FILES['foto_peminjaman']['name'];
		$config ['upload_path'] = './assets/foto';
		$config ['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
		$config ['encrypt_name'] = true;
		$config ['max_size'] = 2048;
		
		$this->load->library('upload', $config);

		if( $this->upload->do_upload('foto_peminjaman', TRUE)) { 
			
			$foto1 = $this->upload->data('file_name');
			$foto1 = $_FILES['foto_peminjaman']['name'];
			$this->db->set('foto_peminjaman', $foto1);
		} else {
			echo $this->upload->display_errors();
		}


		$foto2 = $_FILES['foto_pengembalian']['name'];
		$config ['upload_path'] = './assets/foto';
		$config ['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
		
		$this->load->library('upload', $config);

		if( $this->upload->do_upload('foto_pengembalian', TRUE)) { 
			$foto2 = $this->upload->data('file_name');
			$foto2 = $_FILES['foto_pengembalian']['name'];
			$this->db->set('foto_pengembalian', $foto2);
		} else {
			echo $this->upload->display_errors();
		}
		
			$data = [
				'id_jenis' => $this->input->post('id_jenis', TRUE),
				'id_barang' => $this->input->post('id_barang', TRUE),
				'tambah' => '1',

				
			];

			$id = $this->input->post('id_peminjaman_detail');
			$this->db->update('peminjaman_detail', $data, ['id_peminjaman_detail' => $id]);
	}


	public function updateDataHistory()
	{
		$foto2 = $_FILES['foto_pengembalian']['name'];
		$config ['upload_path'] = './assets/foto';
		$config ['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
		
		$this->load->library('upload', $config);

		if( $this->upload->do_upload('foto_pengembalian', TRUE)) { 
			$foto2 = $this->upload->data('file_name');
			$foto2 = $_FILES['foto_pengembalian']['name'];
			$this->db->set('foto_pengembalian', $foto2);
		} else {
			echo $this->upload->display_errors();
		}

			$data = [
				'tambah' => '3',
			];

			// $data_pinjam = [
			// 	'status_peminjaman' => '2'
			// ];

			// $id_pinjam = $this->input->post('id_peminjaman');
			// $this->db->update('peminjaman', $data_pinjam, ['id_peminjaman' => $id_pinjam]);
			
			$id = $this->input->post('id_peminjaman_detail');
			$this->db->update('peminjaman_detail', $data, ['id_peminjaman_detail' => $id]);
	}

}
