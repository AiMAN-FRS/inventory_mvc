<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->model('Keluar_model');
    }
        
    public function barangkeluar() {
        $data = $this->data;

        // Kirim ke semua views template
        $datanotif['notif'] = $this->Stock_model->get_notif_counts(); // Ambil data notifikasi dari model

        $data['customerList'] = $this->Keluar_model->get_customer_list();

        $data['barang'] = $this->Keluar_model->get_all_barang(); ///

        $stok_barang = [];
        foreach ($data['barang'] as $b) {
            $stok_barang[$b['idbarang']] = number_format($b['stock']);
        }
        $data['stok_barang'] = $stok_barang;

        $tgl_mulai = $this->input->post('tgl_mulaiklr');
        $tgl_selesai = $this->input->post('tgl_selesaiklr');
        $customer = $this->input->post('customer');

        // // Cek jika tombol filter ditekan
        // if ($this->input->post('filter_msk') !== null) {
        //     $data['barangmasuk'] = $this->Masuk_model->filter_barang_masuk($tgl_mulai, $tgl_selesai, $customer);
        // } else {
        //     $data['barangmasuk'] = $this->Masuk_model->filter_barang_masuk(null, null, null);
        // }
        
        // Cek jika tombol filter ditekan
        if ($this->input->post('filter_klr') !== null) {
            // Cek jika semua input kosong
            if (empty($tgl_mulai) && empty($tgl_selesai) && empty($customer)) {
                // Tampilkan data 2 minggu terakhir
                $data['barangkeluar'] = $this->Keluar_model->get_data_2minggu_terakhir();
            } else {
                // Filter sesuai input
                $data['barangkeluar'] = $this->Keluar_model->filter_barang_keluar($tgl_mulai, $tgl_selesai, $customer);
            }
        } else {
            // Default tampil data 2 minggu terakhir
            $data['barangkeluar'] = $this->Keluar_model->get_data_2minggu_terakhir();
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('keluar/barangkeluar', $data);
        $this->load->view('templates/footer');
    }
        
///////////////////////////////////////////////////////////////////////////

    // public function tambahkeluar()
    // {
    //     if ($this->input->method() === 'post') {
    //         $tanggalklr = date('Y-m-d', strtotime($this->input->post('tanggal')));
    //         $barangnya  = $this->input->post('barangnya');
    //         $qty        = $this->input->post('qty');
    //         $penerima   = $this->input->post('penerima');

    //         // Cek stock sekarang
    //         $barang = $this->Keluar_model->get_stock_by_id($barangnya);

    //         if ($barang) {
    //             $stocksekarang = $barang['stock'];
    //             $kurangistock   = $stocksekarang - $qty;

    //             // Insert ke tabel 'keluar'
    //             $data_keluar = [
    //                 'idbarang'   => $barangnya,
    //                 'tanggal'    => $tanggalklr,
    //                 'penerima'   => $penerima,
    //                 'qty'        => $qty
    //             ];
    //             $this->db->insert('keluar', $data_keluar);

    //             // Update stok barang
    //             $this->db->where('idbarang', $barangnya);
    //             $this->db->update('stock', ['stock' => $kurangistock]);

    //             redirect('keluar/barangkeluar');
    //         } else {
    //             echo "Barang tidak ditemukan!";
    //         }
    //     } else {
    //         echo "Form tidak dikirim!";
    //     }
    // }

    public function tambahkeluar()
    {
        if ($this->input->method() === 'post') {
            $tanggalklr = date('Y-m-d', strtotime($this->input->post('tanggal')));
            $barangnya  = $this->input->post('barangnya');
            $qty        = $this->input->post('qty');
            $penerima   = $this->input->post('penerima');

            // Cek stock sekarang
            $barang = $this->Keluar_model->get_stock_by_id($barangnya);

            if ($barang) {
                $stocksekarang = $barang['stock'];

                if ($stocksekarang >= $qty) {
                    // Update stok barang
                    $kurangistock = $stocksekarang - $qty;
                    
                    // Insert ke tabel 'keluar'
                    $data_keluar = [
                        'idbarang'   => $barangnya,
                        'tanggal'    => $tanggalklr,
                        'penerima'   => $penerima,
                        'qty'        => $qty
                    ];
                    $this->db->insert('keluar', $data_keluar);

                    // Update stok barang
                    $this->db->where('idbarang', $barangnya);
                    $this->db->update('stock', ['stock' => $kurangistock]);

                    // Redirect setelah berhasil
                    redirect('keluar/barangkeluar');
                } else {
                    // Jika stok tidak mencukupi
                    echo '<script>alert("Stock barang saat ini tidak mencukupi!"); window.location.href="' . site_url('keluar/barangkeluar') . '";</script>';
                }
            } else {
                echo "Barang tidak ditemukan!";
            }
        } else {
            echo "Form tidak dikirim!";
        }
    }

    public function updatebarangkeluar()
    {
        // Ambil data dari POST
        if ($this->input->method() === 'post') {
            $idbarang = $this->input->post('idbarang');
            $idk = $this->input->post('idk');
            $qty = $this->input->post('qty');
            $penerima = $this->input->post('penerima');

            // Ambil stok sekarang
            $barang = $this->Keluar_model->get_stock_by_id($idbarang);
            $stocksekarang = $barang['stock'];

            // Ambil qty sebelumnya
            $qtysekarang = $this->Keluar_model->get_qty_keluar($idk);

            // Jika qty baru lebih besar dari qty sebelumnya
            if ($qty > $qtysekarang) {
                $selisih = $qty - $qtysekarang;
                $kurangin = $stocksekarang - $selisih;

                // Periksa apakah stok cukup
                if ($selisih <= $stocksekarang) {
                    // Update stok setelah barang keluar
                    $update_stock = $this->Keluar_model->update_stock($idbarang, $kurangin);

                    // Update data barang keluar
                    $data = [
                        'qty' => $qty,
                        'penerima' => $penerima
                    ];
                    $update_barang_keluar = $this->Keluar_model->update_barang_keluar($idk, $data);

                    if ($update_stock && $update_barang_keluar) {
                        // Redirect jika berhasil
                        redirect('keluar/barangkeluar');
                    } else {
                        echo "Gagal memperbarui data barang keluar!";
                    }
                } else {
                    // Jika stok tidak mencukupi
                    echo '<script>alert("Stock Barang Tidak Mencukupi"); window.location.href="' . site_url('keluar/barangkeluar') . '";</script>';
                }
            } else {
                // Jika qty baru lebih kecil, kembalikan stok
                $selisih = $qtysekarang - $qty;
                $kurangin = $stocksekarang + $selisih;

                // Update stok setelah barang keluar
                $update_stock = $this->Keluar_model->update_stock($idbarang, $kurangin);

                // Update data barang keluar
                $data = [
                    'qty' => $qty,
                    'penerima' => $penerima
                ];
                $update_barang_keluar = $this->Keluar_model->update_barang_keluar($idk, $data);

                if ($update_stock && $update_barang_keluar) {
                    // Redirect jika berhasil
                    redirect('keluar/barangkeluar');
                } else {
                    echo "Gagal memperbarui data barang keluar!";
                }
            }
        } else {
            echo "Form tidak dikirim!";
        }
    }

    //Controller Keluar
    public function hapusbarangkeluar()
    {
        if ($this->input->method() === 'post') {
            $idbarang = $this->input->post('idbarang');
            $idk      = $this->input->post('idk');

            if ($this->Keluar_model->hapus_data_keluar_dan_update_stok($idbarang, $idk)) {
                redirect('keluar/barangkeluar');
            } else {
                echo "Gagal Hapus Data Keluar!";
            }
        } else {
            echo "Form tidak dikirim!";
        }
    }




}

