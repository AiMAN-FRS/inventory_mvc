<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');       
    }

    // public function barang_masuk() {
    //     $data['masuk'] = $this->db->query("SELECT m.*, s.* FROM masuk m JOIN stock s ON s.idbarang = m.idbarang")->result();

    //     $this->load->view('export/export_masuk', $data);
    // }

    // Fungsi Export Masuk
    public function barang_masuk() {
        $startmsk   = $this->input->post('tgl_mulaimsk');
        $endmsk     = $this->input->post('tgl_selesaimsk');
        $customer   = $this->input->post('customer');
    
        $query = "SELECT m.*, s.* FROM masuk m JOIN stock s ON s.idbarang = m.idbarang";
        $filter = [];
    
        // Filter tanggal
        if ($startmsk && $endmsk) {
            $filter[] = "m.tanggal BETWEEN '$startmsk' AND '$endmsk'";
        }

        // Filter customer
        if ($customer) {
            $filter[] = "s.customer = '$customer'";
        }

        if (!empty($filter)) {
            $query .= " WHERE " . implode(' AND ', $filter);
        }

        // ORDER BY DESC
        $query .= " ORDER BY m.tanggal DESC";

        // Ambil Data Masuk
        $data['masuk'] = $this->db->query($query)->result();

        // Option Customer Filter
        $data['customers'] = $this->db->order_by('titlecs', 'ASC')->get('cs_info')->result();

        $this->load->view('export/export_masuk', $data);
    }


    // Fungsi Export Masuk
    public function barang_keluar() {
        $startklr   = $this->input->post('tgl_mulaiklr');
        $endklr     = $this->input->post('tgl_selesaiklr');
        $customer   = $this->input->post('customer');
    
        $query = "SELECT k.*, s.* FROM keluar k JOIN stock s ON s.idbarang = k.idbarang";
        $filterklr = [];
    
        // Filter tanggal
        if ($startklr && $endklr) {
            $filterklr[] = "k.tanggal BETWEEN '$startklr' AND '$endklr'";
        }

        // Filter customer
        if ($customer) {
            $filterklr[] = "s.customer = '$customer'";
        }

        if (!empty($filterklr)) {
            $query .= " WHERE " . implode(' AND ', $filterklr);
        }

        // ORDER BY DESC
        $query .= " ORDER BY k.tanggal DESC";

        // Ambil Data Masuk
        $data['keluar'] = $this->db->query($query)->result();

        // Option Customer Filter
        $data['customers'] = $this->db->order_by('titlecs', 'ASC')->get('cs_info')->result();

        $this->load->view('export/export_keluar', $data);
    }


    // Fungsi Export Stock Barang
    public function export_stock() {
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
        $data['customers'] = $this->db->order_by('titlecs', 'ASC')->get('cs_info')->result();

        $this->load->view('export/export_stock', $data);
    }


    ///////// STATUS STOCK ///////////
    public function export_danger()
    {
        $data = $this->data;
        
        $data['title'] = 'Danger Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_danger'] = $this->db->query("SELECT * FROM stock WHERE stock <= min_stock")->result();
        
        // Kirim ke view notif_dgr.php
        $this->load->view('export/export_danger', $data);
    }

    public function export_warning()
    {
        $data = $this->data;
        
        $data['title'] = 'Warning Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_warning'] = $this->db->query("SELECT * FROM stock WHERE (stock < min_stock OR stock = min_stock) AND stock >= (min_stock / 2)")->result();
        
        // Kirim ke view notif_dgr.php
        $this->load->view('export/export_warning', $data);
    }

    public function export_over()
    {
        $data = $this->data;
        
        $data['title'] = 'Over Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_over'] = $this->db->query("SELECT * FROM stock WHERE stock > max_stock")->result();
        
        // Kirim ke view notif_dgr.php
        $this->load->view('export/export_over', $data);
    }
}
