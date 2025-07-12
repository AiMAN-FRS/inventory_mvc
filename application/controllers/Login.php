<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function cek_login()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->Login_model->cek_user($email, $password);

        if ($user) {
            $data_session = array(
                'email' => $user->email,
                'log'   => 'True'
            );
            $this->session->set_userdata($data_session);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Email atau Password salah!');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
