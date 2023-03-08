<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{ 
    private $_table = 'users'; 

    public function rules()
    {
        return [
            [
                'field' => 'username',  //samakan dengan atribute name pada tags input
                'label' => 'username',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nip',
                'label' => 'nip',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required'
            ],
           
            
            [
                'field' => 'level',
                'label' => 'level',
                'rules' => 'trim|required'
            ], 
        ];
    }
     
    public function get_all()//menampilkan list semua data user
    {
        $query = $this->db->get_where($this->_table);
        return $query->result(); 
    }
    
    public function delete($id_user)
    {
        return $this->db->delete($this->_table, array("id_user" => $id_user));
	} 

    public function save(){//menyimpan data user
        {
            $data = array(
                "username" => $this->input->post('username'),
                "password" => $this->input->post('password'),
                "nip" => $this->input->post('nip'),
                "nama" => $this->input->post('nama'),
                "email" => $this->input->post('email'),
                "no_hp" => $this->input->post('no_hp'),
                "password" => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                "level" => $this->input->post('level') 
            );
            return $this->db->insert($this->_table, $data);
        } 
    }

    public function find($id_user)
	{
		if (!$id_user) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_user' => $id_user));
		return $query->row();
	}

    public function update($user)
	{
		if (!isset($user['id_user'])) {
			return;
		}

		return $this->db->update($this->_table, $user, ['id_user' => $user['id_user']]);
	}
    function update_admin($where, $data)
    {
        $this->db->update('users', $data, $where);
        return $this->db->affected_rows();
    }   
    public function verify($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->_table);
        $user = $query->row();
        if (!password_verify($password, $user->password)) {
            return FALSE;
        }
        return true;
    }
}