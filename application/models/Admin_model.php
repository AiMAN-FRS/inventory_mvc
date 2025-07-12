<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        // $this->load->model('User_model'); // jika ada login
    }
}