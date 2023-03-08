<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gambar_model extends CI_Model
{
	private $_table = 'gambar';

	public function insert($gambar) //simpan data gambar
	{
		$this->db->insert($this->_table, $gambar);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
	}

	public function delete($id_barang)
	{
		return $this->db->delete($this->_table, array("id_barang" => $id_barang));
	}

	public function find($id_barang)
	{
		if (!$id_barang) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang, 'utama' => 1));
		return $query->row();
	}

	public function update($barang)
	{
		if (!isset($barang['id_barang'])) {
			return;
		}

		return $this->db->update($this->_table, $barang, ['id_barang' => $barang['id_barang']]);
	}

	public function get_by_barang($id_barang) //menghapus gambar
	{
		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang, 'utama' => 0));
		return $query->result();
	}

	public function get_by_id($id_gambar) //menghapus gambar
	{
		$query = $this->db->get_where($this->_table, array('id_gambar' => $id_gambar));
		return $query;
	}

	public function get_by_idBarang($id_barang)
	{
		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang));
		return $query->result();
	}
	function hapus_gambar($id)
	{
		$this->db->where('id_gambar', $id);
		$this->db->delete('gambar');
	}
	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id_gambar" => $id])->row();
		//query diatas seperti halnya query pada mysql 
		//select * from tb_barang where id_barang='$id'
	}
}
