<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->helper('url');
        $this->load->library('session');
        // $this->load->model('User_model'); // jika ada login

        //Cek apakah sudah login
        // if (!$this->session->userdata('log')) {
        //     redirect('login');
        // }
    }

    public function index() {
        $data = $this->data;
        
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        $data['stock'] = $this->Stock_model->get_all_stock(); // ambil semua stok

        $customer   = $this->input->post('customer');
    
        $query = "SELECT * FROM stock";
        $filterstk = [];

        // Filter customer
        if ($customer) {
            $filterstk[] = "customer = '$customer'";
        }

        if (!empty($filterstk)) {
            $query .= " WHERE " . implode(' AND ', $filterstk);
        }

        // ORDER BY DESC
        $query .= " ORDER BY namabarang ASC";

        // Ambil Data Masuk
        $data['stock'] = $this->db->query($query)->result();

        // Option Customer Filter
        $data['customers'] = $this->db->order_by('titlecs', 'ASC')->get('cs_info')->result(); // Ambil Data DB cs_info

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');

    }

}
