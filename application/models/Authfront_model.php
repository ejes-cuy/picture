<?php

class Authfront_model extends CI_Model
{
    private $_table = "masyarakat";
    const SESSION_KEY = 'id_masyarakat';

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('status', 1);
        $query = $this->db->get($this->_table);
        $masyarakat = $query->row();
        if (!$masyarakat) {
            return FALSE;
        }
        if (!password_verify($password, $masyarakat->password)) {
            return FALSE;
        }
        $this->session->set_userdata([self::SESSION_KEY => $masyarakat->id_masyarakat]);
        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $id_masyarakat = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id_masyarakat' => $id_masyarakat]);
        return $query->row();
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }
}
