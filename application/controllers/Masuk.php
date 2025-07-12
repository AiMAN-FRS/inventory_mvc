<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->model('Masuk_model');
    }
        
    public function barangmasuk() {
        $data = $this->data;

        // Kirim ke semua views template
        $datanotif['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model
        
        // $data['stockList'] = $this->Masuk_model->get_all_stock();
        $data['customerList'] = $this->Masuk_model->get_customer_list();
        
        $data['barang'] = $this->Masuk_model->get_all_barang(); ///

        $stok_barang = [];
        foreach ($data['barang'] as $b) {
            $stok_barang[$b['idbarang']] = number_format($b['stock']);
        }
        $data['stok_barang'] = $stok_barang;


        $tgl_mulai = $this->input->post('tgl_mulaimsk');
        $tgl_selesai = $this->input->post('tgl_selesaimsk');
        $customer = $this->input->post('customer');

        // // Cek jika tombol filter ditekan
        // if ($this->input->post('filter_msk') !== null) {
        //     $data['barangmasuk'] = $this->Masuk_model->filter_barang_masuk($tgl_mulai, $tgl_selesai, $customer);
        // } else {
        //     $data['barangmasuk'] = $this->Masuk_model->filter_barang_masuk(null, null, null);
        // }

        // Cek jika tombol filter ditekan
        if ($this->input->post('filter_msk') !== null) {
            // Cek jika semua input kosong
            if (empty($tgl_mulai) && empty($tgl_selesai) && empty($customer)) {
                // Tampilkan data 2 minggu terakhir
                $data['barangmasuk'] = $this->Masuk_model->get_data_2minggu_terakhir();
            } else {
                // Filter sesuai input
                $data['barangmasuk'] = $this->Masuk_model->filter_barang_masuk($tgl_mulai, $tgl_selesai, $customer);
            }
        } else {
            // Default tampil data 2 minggu terakhir
            $data['barangmasuk'] = $this->Masuk_model->get_data_2minggu_terakhir();
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('masuk/barangmasuk', $data);
        $this->load->view('templates/footer');
    }

///////////////////////////////////////////////////////////////////////////


    public function tambahmasuk()
    {
        if ($this->input->method() === 'post') {
            $tanggalmsk = date('Y-m-d', strtotime($this->input->post('tanggal')));
            $barangnya  = $this->input->post('barangnya');
            $qty        = $this->input->post('qty');
            $keterangan = $this->input->post('keterangan');
    
            // Cek stock sekarang
            $barang = $this->Masuk_model->get_stock_by_id($barangnya);
    
            if ($barang) {
                $stocksekarang = $barang['stock'];
                $tambahstock   = $stocksekarang + $qty;
    
                // Insert ke tabel 'masuk'
                $data_masuk = [
                    'idbarang'   => $barangnya,
                    'tanggal'    => $tanggalmsk,
                    'keterangan' => $keterangan,
                    'qty'        => $qty
                ];
                $this->db->insert('masuk', $data_masuk);
    
                // Update stok barang
                $this->db->where('idbarang', $barangnya);
                $this->db->update('stock', ['stock' => $tambahstock]);
    
                redirect('masuk/barangmasuk');
            } else {
                echo "Barang tidak ditemukan!";
            }
        } else {
            echo "Form tidak dikirim!";
        }
    }

    public function updatebarangmasuk()
    {
        if ($this->input->method() === 'post' ) {
            $idbarang = $this->input->post('idbarang');
            $idm = $this->input->post('idm');
            $qty = $this->input->post('qty');
            $keterangan = $this->input->post('keterangan');
            
            // Ambil stok sekarang
            $stockskrg = $this->Masuk_model->get_stock_sekarang($idbarang);
    
            // Ambil qty sebelumnya
            $qtyskrg = $this->Masuk_model->get_qty_masuk($idm);
    
            if ($qty > $qtyskrg) {
                $selisih = $qty - $qtyskrg;
                $stockbaru = $stockskrg - $selisih;
            } else {
                $selisih = $qtyskrg - $qty;
                $stockbaru = $stockskrg + $selisih;
            }
    
            // Update stock
            $this->Masuk_model->update_stock($idbarang, $stockbaru);
    
            // Update data barang masuk
            $data = [
                'qty' => $qty,
                'keterangan' => $keterangan
            ];
            $this->Masuk_model->update_barang_masuk($idm, $data);
    
            redirect('masuk/barangmasuk');
        } else {
            echo "Form tidak dikirim!";
        }
    }

    public function hapusbarangmasuk()
    {
        if ($this->input->method() === 'post' ) {
            $idbarang = $this->input->post('idbarang');
            $idm = $this->input->post('idm');
            $qty = $this->input->post('qty');

            // Ambil stok sekarang
            // $datastock = $this->Masuk_model->get_stock_sekarang($idbarang);
            $stockskrg = $this->Masuk_model->get_stock_sekarang($idbarang);

            // Kurangi stock
            $stockbaru = $stockskrg - $qty;

            // Update stock
            $this->Masuk_model->update_stock($idbarang, $stockbaru);

            // Hapus data barang masuk
            $this->Masuk_model->hapus_barang_masuk($idm);

            // Redirect ke halaman barang masuk
            redirect('masuk/barangmasuk');
        } else {
            echo "Gagal Hapus Data Masuk!";
        }
    }
}



