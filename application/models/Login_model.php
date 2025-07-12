<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function cek_user($email, $password)
    {
        return $this->db->get_where('login', array(
            'email'    => $email,
            'password' => $password
        ))->row();
    }
}
