<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('backend/auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'List Data User';
        $data['activeUser'] = $this->auth_model->current_user();
        $data['users'] = $this->Users_model->get_all();

        $this->load->view('backend/list_user', $data);
    }
    public function delete($id = null)
    {

        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->Users_model->delete($id);

        $this->session->set_flashdata('message', 'Data berhasil dihapus');
        redirect("backend/users");
    }
    public function add()
    {

        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $user = $this->Users_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());
        if ($validation->run()) {
            $user->save();
            redirect("backend/Users");
        }
        $this->load->view('backend/fitur/add_user', $data);
    }
    public function edit($id = null)
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['users'] = $this->Users_model->find($id);

        if (!$data['users'] || !$id) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            // TODO: lakukan validasi data seblum simpan ke model
            $users = [
                'id_user' => $id,
                'username' => $this->input->post('username'),
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'level' => $this->input->post('level'),
                'status' => $this->input->post('status')
            ];
            $updated = $this->Users_model->update($users);
            if ($updated) {
                $this->session->set_flashdata('message', 'Article was updated');
                redirect('backend/users');
            }
        }

        $this->load->view('backend/fitur/edit_user', $data);
    }
    public function blokir()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '0');
        $update = $this->Users_model->update_admin(array('id_user' => $id), $data);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diblokir!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diblokir!');
        }
        redirect('backend/users');
    }
    public function aktifkan()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '1');
        $update = $this->Users_model->update_admin(array('id_user' => $id), $data);
        $this->session->set_flashdata('message', '
            Data Petugas Telah Di-aktifkan kembali!');
        redirect('backend/users');
    }
    public function change($id_user = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        $data['user'] = $this->Users_model->find($id_user);
        if ($data['activeUser']->level <> 'Admin' && $data['activeUser']->username <> $data['user']->username) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $current = $this->input->post('current');
            $verify = $this->Users_model->verify($data['user']->username, $current);
            if (!$verify) {
                $this->session->set_flashdata('message', 'Current password salah!');
            } else {
                $user = [
                    'id_user'   => $id_user,
                    'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                ];
                $update = $this->Users_model->update($user);
                if ($update) {
                    $this->session->set_flashdata('message', 'Password berhasil diubah!');
                    if ($data['activeUser']->username == $data['user']->username) {
                        $this->auth_model->logout();
                        redirect('backend');
                    }
                    redirect('backend/users');
                } else {
                    $this->session->set_flashdata('message', 'Password gagal diubah!');
                }
            }
        }
        $this->load->view('backend/fitur/change_password', $data);
    }
}
