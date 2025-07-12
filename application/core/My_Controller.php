<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('Stock_model');
        $this->load->library('session');
        $this->load->helper('url');

        // Cek apakah sudah login
        if (!$this->session->userdata('log')) {
            redirect('login');
        }

        // Set global data
        $this->data['notif'] = $this->Stock_model->get_notif_counts();
        $this->data['email'] = $this->session->userdata('email');

    }
}