<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $_table = 'barang',
        $_view = 'detail_barang';

    public function rules()
    {
        return [
            [
                'field' => 'nama_barang',  //samakan dengan atribute name pada tags input
                'label' => 'nama_barang',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'deskripsi',
                'label' => 'deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'harga_awal',
                'label' => 'harga_awal',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'gambar',
                'label' => 'gambar',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status',
                'label' => 'status',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function get_all() //menampilkan list semua data user
    {
        $query = $this->db->get_where($this->_view);
        return $query->result();
    }

    public function insert($barang) //simpan data barang
    {
        $this->db->insert($this->_table, $barang);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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

        $query = $this->db->get_where($this->_table, array('id_barang' => $id_barang));
        return $query->row();
    }

    public function get_by_id($id_barang)
    {
        $query = $this->db->get_where($this->_view, array('id_barang' => $id_barang))->row();
        return $query;
    }

    public function findBarang($id_barang)
    {
        if (!$id_barang) {
            return;
        }

        $query = $this->db->get_where($this->_view, array('id_barang' => $id_barang));
        return $query->row();
    }

    public function update($barang)
    {
        if (!isset($barang['id_barang'])) {
            return;
        }

        return $this->db->update($this->_table, $barang, ['id_barang' => $barang['id_barang']]);
    }


    public function save()
    { //menyimpan data user
        {
            $data = array(
                "nama_barang" => $this->input->post('nama_barang'),
                "deskripsi" => $this->input->post('deskripsi'),
                "harga_awal" => $this->input->post('harga_awal'),
                "gambar" => $this->input->post('gambar'),
                "status" => $this->input->post('status')
            );
            return $this->db->insert($this->_table, $data);
        }
    }
}
