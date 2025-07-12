<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
    }

    public function danger() {
        $data['barang'] = $this->Stock_model->get_danger_stock();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('notif/danger', $data);
        $this->load->view('templates/footer');
    }

    public function warning() {
        $data['barang'] = $this->Stock_model->get_danger_stock();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('notif/over', $data);
        $this->load->view('templates/footer');
    }

    public function over() {
        $data['barang'] = $this->Stock_model->get_danger_stock();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('notif/over', $data);
        $this->load->view('templates/footer');
    }
}
