<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->helper('url');
        $this->load->library('session');
        // $this->load->model('User_model'); // jika ada login
    }

    public function tambah()
    {
        $kd         = $this->input->post('kd');
        $namabarang = $this->input->post('namabarang');
        $spek       = $this->input->post('spek');
        $produsen   = $this->input->post('produsen');
        $cs         = $this->input->post('customer');
        $stock      = $this->input->post('stock');
        $satuan     = $this->input->post('satuan');
        $lokasi     = $this->input->post('lokasi');
        $min_stk    = $this->input->post('min_stock');
        $max_stk    = $this->input->post('max_stock');

        // Upload image jika ada
        $gambar = null;
        if ($_FILES['file']['name'] != '') {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 10000; // 10 MB
            $config['file_name'] = md5(uniqid($_FILES['file']['name'], true) . time());

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $gambar = $this->upload->data('file_name');
                } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dashboard');
            }
        }

        // Cek apakah barang sudah ada
        $cek = $this->db->get_where('stock', ['namabarang' => $namabarang])->num_rows();

        if ($cek < 1) { $data=[ 'namabarang'=> $namabarang,
            'kd' => $kd,
            'spek' => $spek,
            'produsen' => $produsen,
            'customer' => $cs,
            'stock' => $stock,
            'satuan' => $satuan,
            'lokasi' => $lokasi,
            'min_stock' => $min_stk,
            'max_stock' => $max_stk,
            'gambar' => $gambar
        ];

        $this->db->insert('stock', $data);
        redirect('dashboard');
        }  else {
            echo "<script>
                alert('Nama barang sudah ada');
                window.location.href = '".base_url('dashboard')."';
            </script>";
        }
    }

    public function update()
    {
        $idbarang = $this->input->post('idbarang');
        $kd = $this->input->post('kd');
        $namabarang = $this->input->post('namabarang');
        $spek = $this->input->post('spek');
        $produsen = $this->input->post('produsen');
        $cs = $this->input->post('customer');
        $stock = $this->input->post('stock');
        $satuan = $this->input->post('satuan');
        $lokasi = $this->input->post('lokasi');
        $min_stk = $this->input->post('min_stock');
        $max_stk = $this->input->post('max_stock');

        // Ambil nama gambar lama
        $query = $this->db->get_where('stock', ['idbarang' => $idbarang])->row();
        $gambar_lama = $query->gambar;

        // File upload
        $gambar = $gambar_lama; // default jika tidak upload baru
        if ($_FILES['file']['size'] > 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 10000; // 10MB
            $config['file_name'] = md5(uniqid($_FILES['file']['name'], true) . time());

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $gambar = $this->upload->data('file_name');

                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists('./uploads/' . $gambar_lama)) {
                    unlink('./uploads/' . $gambar_lama);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dashboard');
                return;
            }
        }

        $data = [
            'kd' => $kd,
            'namabarang' => $namabarang,
            'spek' => $spek,
            'produsen' => $produsen,
            'customer' => $cs,
            'stock' => $stock,
            'satuan' => $satuan,
            'lokasi' => $lokasi,
            'min_stock' => $min_stk,
            'max_stock' => $max_stk,
            'gambar' => $gambar
        ];

        $this->db->where('idbarang', $idbarang);
        $this->db->update('stock', $data);

        redirect('dashboard');
    }

    public function hapus()
    {
        $idbarang = $this->input->post('idbarang');

        // Ambil data gambar
        $data = $this->db->get_where('stock', ['idbarang' => $idbarang])->row();
        if ($data && $data->gambar) {
            $img_path = FCPATH . 'uploads/' . $data->gambar;
            if (file_exists($img_path)) {
                unlink($img_path); // Hapus file gambar
            }
        }

        // Hapus dari database
        $this->db->where('idbarang', $idbarang);
        $this->db->delete('stock');

        // Redirect
        echo "<script>
                alert('Barang Berhasil di Hapus');
                window.location.href = '".base_url('dashboard')."';
            </script>";
    }
///////////////////////////////////////////////////////////////////////////
    public function notif_dgr()
    {
        $data = $this->data;
        
        $data['title'] = 'Danger Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_danger'] = $this->db->query("SELECT * FROM stock WHERE stock <= min_stock")->result();

        // Kirim ke semua views template
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        
        // Kirim ke view notif_dgr.php
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('stock/notif_dgr', $data);
        $this->load->view('templates/footer');
    }

    public function notif_wrng()
    {
        $data = $this->data;

        $data['title'] = 'Warning Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_warning'] = $this->db->query("SELECT * FROM stock WHERE (stock < min_stock OR stock = min_stock) AND stock >= (min_stock / 2)")->result();

        // Kirim ke semua views template
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        
        // Kirim ke view notif_dgr.php
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('stock/notif_wrng', $data);
        $this->load->view('templates/footer');
    }

    public function notif_over()
    {
        $data = $this->data;
        
        $data['title'] = 'Over Stock';
        // Ambil data barang dengan stock kurang dari min_stock
        $data['stock_over'] = $this->db->query("SELECT * FROM stock WHERE stock > max_stock")->result();

        // Kirim ke semua views template
        $data['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        
        // Kirim ke view notif_dgr.php
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('stock/notif_over', $data);
        $this->load->view('templates/footer');
    }

}
