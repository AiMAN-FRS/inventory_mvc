<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller {
    public function  __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->model('Admin_model');
    }

    public function adminpage() {
        $data = $this->data;
        
        // Kirim ke semua views template
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        // $data['stock'] = $this->Stock_model->get_all_stock(); // ambil semua stok
        $data['admin'] = $this->db->order_by('email', 'ASC')->get('login')->result(); // Ambil Data DB login
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/adminpage', $data);
        $this->load->view('templates/footer');
    }

    public function tambahadmin()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        // Cek apakah barang sudah ada
        $cek = $this->db->get_where('login', ['email' => $email])->num_rows();

        if ($cek < 1) { $data=[ 'email'=> $email,
            'password' => $password
        ];

        $this->db->insert('login', $data);
        redirect('admin/adminpage');
        }  else {
            echo "<script>
                alert('Nama Akun Sudah Ada');
                window.location.href = '".base_url('admin/adminpage')."';
            </script>";
        }
    }

    public function updateadmin()
    {
        $iduser     = $this->input->post('iduser');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $data = [
            'email' => $email,
            'password' => $password
        ];

        $this->db->where('iduser', $iduser);
        $this->db->update('login', $data);

        redirect('admin/adminpage');
    }

    public function hapusadmin()
    {
        $iduser = $this->input->post('iduser');        

        // Hapus dari database
        $this->db->where('iduser', $iduser);
        $this->db->delete('login');

        // Redirect
        echo "<script>
                alert('Akun Berhasil di Hapus');
                window.location.href = '".base_url('admin/adminpage')."';
            </script>";
    }
}

