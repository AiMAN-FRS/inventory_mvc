<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar_model extends CI_Model {

    // public function get_customer_list() {
    //     $this->db->select('DISTINCT(customer)');
    //     $this->db->from('stock');
    //     return $this->db->get()->result_array();
    // }

    public function filter_barang_keluar($tgl_mulai, $tgl_selesai, $customer = null)
    {
        $this->db->select('k.*, s.*');
        $this->db->from('keluar k');
        $this->db->join('stock s', 's.idbarang = k.idbarang');

        // Filter tanggal jika ada
        if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
            $this->db->where('k.tanggal >=', $tgl_mulai);
            $this->db->where('k.tanggal <=', $tgl_selesai);
        } else {
            // Default ambil data 2 minggu terakhir
            $paramKlr = date('Y-m-d', strtotime('-2 weeks'));
            $this->db->where('k.tanggal >=', $paramKlr);
        }

        // Filter customer jika dipilih
        if (!empty($customer)) {
            $this->db->where('s.customer', $customer);
        }

        $this->db->order_by('k.tanggal', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query(); // Debug query yang jalan
        return $query->result_array();
    }

    public function get_customer_list()
    {
        $this->db->select('DISTINCT(customer)');
        $this->db->from('stock');
        $this->db->order_by('customer', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_data_2minggu_terakhir()
    {
        // $paramKlr = date('Y-m-d', strtotime('-2 weeks'));

        // $this->db->select('k.*, s.*');
        // $this->db->from('keluar k');
        // $this->db->join('stock s', 's.idbarang = k.idbarang');
        // $this->db->where('k.tanggal >=', $paramKlr);
        // $this->db->order_by('k.tanggal', 'DESC');

        $this->db->select('keluar.idkeluar as idk, keluar.*, stock.*');
        $this->db->from('keluar');
        $this->db->join('stock', 'keluar.idbarang = stock.idbarang');
        $this->db->where('keluar.tanggal >=', date('Y-m-d', strtotime('-14 days')));
        $this->db->order_by('keluar.idkeluar', 'DESC');

        return $this->db->get()->result_array();
    }

    public function get_all_barang()
    {
        return $this->db->order_by('namabarang', 'ASC')->get('stock')->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////////////

    public function get_stock_by_id($idbarang) {
        return $this->db->get_where('stock', ['idbarang' => $idbarang])->row_array();
    }
    
    public function insert_barang_keluar($data) {
        return $this->db->insert('keluar', $data);
    }
    
    public function update_stock($idbarang, $stock_baru) {
        $this->db->where('idbarang', $idbarang);
        return $this->db->update('stock', ['stock' => $stock_baru]);
    }

    
    public function get_stock_sekarang($idbarang)
    {
        $this->db->where('idbarang', $idbarang);
        $result = $this->db->get('stock')->row_array();
        return $result['stock']; // ambil nilai 'stock'-nya
    }

    public function get_qty_keluar($idkeluar)
    {
        $this->db->where('idkeluar', $idkeluar);
        $result = $this->db->get('keluar')->row_array();
        return isset($result['qty']) ? $result['qty'] : 0;
    }

    public function update_barang_keluar($idkeluar, $data)
    {
        $this->db->where('idkeluar', $idkeluar);
        return $this->db->update('keluar', $data);
    }

    //Keluar_model
    public function hapus_barang_keluar($idkeluar)
    {
        $this->db->where('idkeluar', $idkeluar);
        return $this->db->delete('keluar');
    }

    public function hapus_data_keluar_dan_update_stok($idbarang, $idkeluar)
    {
        // Ambil qty dari tabel keluar
        $qty = $this->get_qty_keluar($idkeluar);

        // Ambil stok sekarang
        $stockskrg = $this->get_stock_sekarang($idbarang);

        // Tambah stok kembali
        $stockbaru = $stockskrg + $qty;

        // Update stok barang
        $update = $this->update_stock($idbarang, $stockbaru);

        // Hapus data barang keluar
        $hapus = $this->hapus_barang_keluar($idkeluar);

        // Return hasil proses, true jika keduanya berhasil
        return $update && $hapus;
    }


}
