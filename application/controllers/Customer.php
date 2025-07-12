<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends My_Controller {
    
    public function  __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->model('Cs_model');
    }

    public function cs_page() {
        $data = $this->data;
        
        // Kirim ke semua views template
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        // $data['stock'] = $this->Stock_model->get_all_stock(); // ambil semua stok
        $data['customer'] = $this->db->order_by('titlecs', 'ASC')->get('cs_info')->result(); // Ambil Data DB login
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('customer/cs_page', $data);
        $this->load->view('templates/footer');
    }

    public function tambahcs()
    {
        $titlecs    = $this->input->post('titlecs');
        $telpcs     = $this->input->post('telpcs');

        // Upload image jika ada
        $imagecs = null;
        if ($_FILES['file']['name'] != '') {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 10000; // 10 MB
            $config['file_name'] = md5(uniqid($_FILES['file']['name'], true) . time());

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $imagecs = $this->upload->data('file_name');
                } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('customer/cs_page');
            }
        }

        // Cek apakah barang sudah ada
        $cek = $this->db->get_where('cs_info', ['titlecs' => $titlecs])->num_rows();

        if ($cek < 1) { $data=[ 'titlecs'=> $titlecs,
            'telpcs' => $telpcs,
            'imagecs' => $imagecs
        ];

        $this->db->insert('cs_info', $data);
        redirect('customer/cs_page');
        }  else {
            echo "<script>
                alert('Nama Customer Sudah Ada');
                window.location.href = '".base_url('customer/cs_page')."';
            </script>";
        }
    }

    public function updatecs()
    {
        $idcustomer = $this->input->post('idcustomer');
        $titlecs = $this->input->post('titlecs');
        $telpcs = $this->input->post('telpcs');

        // Ambil nama gambar lama
        $query = $this->db->get_where('cs_info', ['idcustomer' => $idcustomer])->row();
        $gambar_lama = $query->imagecs;

        // File upload
        $imagecs = $gambar_lama; // default jika tidak upload baru
        if ($_FILES['file']['size'] > 0) {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 10000; // 10MB
            $config['file_name'] = md5(uniqid($_FILES['file']['name'], true) . time());

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $imagecs = $this->upload->data('file_name');

                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists('./assets/img/' . $gambar_lama)) {
                    unlink('./assets/img/' . $gambar_lama);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('customer/cs_page');
                return;
            }
        }

        $data = [
            'titlecs' => $titlecs,
            'telpcs' => $telpcs,            
            'imagecs' => $imagecs
        ];

        $this->db->where('idcustomer', $idcustomer);
        $this->db->update('cs_info', $data);

        redirect('customer/cs_page');
    }

    public function hapuscs()
    {
        $idcustomer = $this->input->post('idcustomer');

        // Ambil data gambar
        $data = $this->db->get_where('cs_info', ['idcustomer' => $idcustomer])->row();
        if ($data && $data->imagecs) {
            $img_path = FCPATH . 'assets/img/' . $data->imagecs;
            if (file_exists($img_path)) {
                unlink($img_path); // Hapus file gambar
            }
        }

        // Hapus dari database
        $this->db->where('idcustomer', $idcustomer);
        $this->db->delete('cs_info');

        // Redirect
        echo "<script>
                alert('Customer Berhasil di Hapus');
                window.location.href = '".base_url('customer/cs_page')."';
            </script>";
    }

    ////////////Detail Barang////////////////
    public function detail_barang($customer)
    {
        $data = $this->data;
        $customer = urldecode($customer);

        // Ambil barang dari stock berdasarkan customer, urut nama barang ASC
        $this->db->where('customer', $customer);
        $this->db->order_by('namabarang', 'ASC');
        $data['barang'] = $this->db->get('stock')->result();

        // Kirim nama customer
        $data['customer'] = $customer;

        // Load Stock_Model for Notif
        $data['notif'] = $this->Stock_model->get_notif_counts();

        // Load template dan view
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('detail/detail_csbrg', $data);
        $this->load->view('templates/footer');
    }
}

