<?php

class m_barang extends CI_Model {

	function list_quality() {
		return $this -> db -> get('quality') -> result_array();
	}

	function list_negara() {
		return $this -> db -> get('negara') -> result_array();
	}

	function list_barang($nama_tipe_barang = '', $mulai, $abanyak_item) {
		$this -> db -> join('tipe_barang', 'barang.id_tipe_barang = tipe_barang.id_tipe_barang');
		$this -> db -> where('nama_tipe_barang', $nama_tipe_barang);
		$this -> db -> order_by('datetime_post', 'desc');
		return $this -> db -> get('barang', $mulai, $abanyak_item) -> result_array();
	}

	//buat insert barang
	function tambah_barang($data='',$data_label='') {
		$this -> db -> trans_start();
		$this -> db -> insert('barang', $data);
		$this -> db -> trans_complete();
		$result=$this -> db -> trans_status();
		if($result)
		{
			$this->insert_barang_has_label($data_label, $this->get_last_id_barang());
		}
		return $result;
	}
	
	function insert_barang_has_label($data_label='', $last_id_barang)
	{
		$this -> db -> trans_start();
		foreach($data_label as $label)
		{
			$trim_lbl=trim($label);
			$data_lb['id_barang']=$last_id_barang;
			if($this->cek_label_is_eksis($trim_lbl))
			{
				$data_lb['id_label']=$this->get_id_label_by_label($trim_lbl);
				$this->db->insert('barang_has_label',$data_lb);
			}else
			{
				if($this->insert_label($trim_lbl))
				{
					$data_lb['id_label']=$this->get_last_id_label();
					$this->db->insert('barang_has_label',$data_lb);
				}
			}
		}
		$this -> db -> trans_complete();
		
		return $this -> db -> trans_status();;
	}
	
	function cek_label_is_eksis($label='')
	{
		$this->db->where('label', $label);
		$row_count=$this->db->get('label')->num_rows();
		if($row_count!=0)
		{
			return true;
		}else return false;
	}
	
	function get_last_id_barang()
	{
		$this->db->order_by('id_barang','desc');
		$this->db->limit(1);
		$query=$this->db->get('barang')->result_array();
		return $query[0]['id_barang'];
	}
	
	function get_last_id_label()
	{
		$this->db->order_by('id_label','desc');
		$this->db->limit(1);
		$query=$this->db->get('label')->result_array();
		//print_r($query); exit();
		return $query[0]['id_label'];
	}
	
	function insert_label($label)
	{
		$data['label']=$label;
		
		$this -> db -> trans_start();
		$this -> db -> insert('label', $data);
		$this -> db -> trans_complete();
		return $this -> db -> trans_status();
	}

	function get_id_label_by_label($label)
	{
		$this->db->where('label',$label);
		$query=$this->db->get('label')->result_array();
		return $query[0]['id_label'];
	}
	
	///end insert barang

	function hapus_barang($tipe='', $id_barang='')
	{
		if($this->hapus_barang_has_label_by_id_barang($id_barang))
		{
			$this -> db -> trans_start();
			$data['id_barang']=$id_barang;
			$data['id_tipe_barang']=$tipe;
			$this->db->delete('barang', $data); 
			$this -> db -> trans_complete();	
			return $this -> db -> trans_status();
		}else return false;
	}
	
	function hapus_barang_has_label_by_id_barang($id_barang)
	{
		$this -> db -> trans_start();
		$data['id_barang']=$id_barang;
		$this->db->delete('barang_has_label', $data); 
		$this -> db -> trans_complete();
		return $this -> db -> trans_status();
	}
	
	function get_tipe_barang_by_id_tipe_barang($id_tipe_barang)
	{
		$this->db->where('id_tipe_barang',$id_tipe_barang);
		$query=$this->db->get('tipe_barang')->result_array();
		return $query[0]['nama_tipe_barang'];
	}
}
?>