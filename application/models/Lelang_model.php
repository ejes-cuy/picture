<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lelang_model extends CI_Model
{
    private $_table = 'lelang',
        $_vDetailLelang = 'detail_lelang',
        $_vLelangBerlangsung = 'lelang_berlangsung',
        $_vPemenangLelang = 'pemenang_lelang';


    public function rules()
    {
        return [
            [
                'field' => 'tgl_mulai',  //samakan dengan atribute name pada tags input
                'label' => 'tgl_muali',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'tgl_akhir',
                'label' => 'tgl_akhir',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function get_all() //menampilkan list all data lelang

    {
        $query = $this->db->get_where($this->_vDetailLelang);
        return $query->result();
    }

    public function save($data)
    { //menyimpan data user
        {
            return $this->db->insert($this->_table, $data);
        }
    }
    public function get_LelangBerlangsung() //menampilkan list data lelang berlangsung
    {
        $query = $this->db->get_where($this->_vLelangBerlangsung);
        return $query->result();
    }

    public function get_pemenangLelang() //menampilkan list pemenang lelang
    {
        $query = $this->db->get_where($this->_vPemenangLelang, array('status' => 'Unconfirmed'));
        return $query->result();
    }
    public function get_pemenangLelangPage()
    {
        $query = $this->db->get_where($this->_vPemenangLelang, array('status' => 'Confirmed'));
        return $query->result();
    }
    public function get_pemenangLelangLapor()
    {
        $query = $this->db->get_where($this->_vPemenangLelang);
        return $query->result();
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_lelang" => $id));
    }

    public function find($id_lelang)
    {
        if (!$id_lelang) {
            return;
        }

        $query = $this->db->get_where($this->_table, array('id_lelang' => $id_lelang));
        return $query->row();
    }
    public function get_by_id($id_lelang)
    {
        $query = $this->db->get_where($this->_table, array('id_lelang' => $id_lelang));
        return $query;
    }



    public function update($lelang)
    {
        if (!isset($lelang['id_lelang'])) {
            return;
        }

        return $this->db->update($this->_table, $lelang, ['id_lelang' => $lelang['id_lelang']]);
    }
    public function get_status_open()
    {
        $query =  $this->db->get_where($this->_vDetailLelang, array('status' => 'open'));
        return $query->result();
    }
    public function close($id_lelang = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        $data['lelang'] = $this->lelang_model->get_by_id($id_lelang)->row();
        if (!$data['lelang'] || !$id_lelang) {
            show_404();
        }
        $data['penawaran'] = $this->penawaran_model->get_by_lelang($id_lelang)->row();
        $lelang = [
            'id_lelang' => $id_lelang,
            'update_by' => $data['activeUser']->id_user,
            'update_date' => date('Y-m-d H:i:s'),
            'id_masyarakat' => $data['penawaran']->id_masyarakat,
            'harga_akhir' => $data['penawaran']->harga_penawaran,
            'status' => 'Closed'
        ];
        $update = $this->lelang_model->update($lelang);
        if ($update) {
            $barang = [
                'id_barang' => $data['lelang']->id_barang,
                'status' => 'Sold'
            ];
            $updt = $this->barang_model->update($barang);
            if ($updt) {
                $this->session->set_flashdata('message', 'Data berhasil diclosed!');
            }
        } else {
            $this->session->set_flashdata('message', 'Data gagal diclosed!');
        }
        redirect('backend/lelang');
    }
    public function berlangsung_by_id($id_lelang)
    {
        $query = $this->db->get_where($this->_vLelangBerlangsung, array('id_lelang' => $id_lelang));
        return $query;
    }
    public function search($keyword)
    {
        if (!$keyword) {
            return null;
        }
        $this->db->like('nama_barang', $keyword);
        $query = $this->db->get($this->_vLelangBerlangsung);
        return $query->result();
    }
}
