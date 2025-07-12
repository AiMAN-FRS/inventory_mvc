<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk_model extends CI_Model {

    // public function get_customer_list() {
    //     $this->db->select('DISTINCT(customer)');
    //     $this->db->from('stock');
    //     return $this->db->get()->result_array();
    // }

    public function filter_barang_masuk($tgl_mulai, $tgl_selesai, $customer = null)
    {
        $this->db->select('m.*, s.*');
        $this->db->from('masuk m');
        $this->db->join('stock s', 's.idbarang = m.idbarang');

        // Filter tanggal jika ada
        if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
            $this->db->where('m.tanggal >=', $tgl_mulai);
            $this->db->where('m.tanggal <=', $tgl_selesai);
        } else {
            // Default ambil data 2 minggu terakhir
            $paramMsk = date('Y-m-d', strtotime('-2 weeks'));
            $this->db->where('m.tanggal >=', $paramMsk);
        }

        // Filter customer jika dipilih
        if (!empty($customer)) {
            $this->db->where('s.customer', $customer);
        }

        $this->db->order_by('m.tanggal', 'DESC');

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
        // $paramMsk = date('Y-m-d', strtotime('-2 weeks'));

        // $this->db->select('m.*, s.*');
        // $this->db->from('masuk m');
        // $this->db->join('stock s', 's.idbarang = m.idbarang');
        // $this->db->where('m.tanggal >=', $paramMsk);
        // $this->db->order_by('m.tanggal', 'DESC');

        $this->db->select('masuk.idmasuk as idm, masuk.*, stock.*');
        $this->db->from('masuk');
        $this->db->join('stock', 'masuk.idbarang = stock.idbarang');
        $this->db->where('masuk.tanggal >=', date('Y-m-d', strtotime('-14 days')));
        $this->db->order_by('masuk.idmasuk', 'DESC');

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
    
    public function insert_barang_masuk($data) {
        return $this->db->insert('masuk', $data);
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
        //return $this->db->get('stock')->row_array();
    }

    public function get_qty_masuk($idmasuk)
    {
        $this->db->where('idmasuk', $idmasuk);
        $result = $this->db->get('masuk')->row_array();
        return isset($result['qty']) ? $result['qty'] : 0;
        //return $this->db->get('masuk')->row_array();
    }

    public function update_barang_masuk($idmasuk, $data)
    {
        $this->db->where('idmasuk', $idmasuk);
        $this->db->update('masuk', $data);
    }

    public function hapus_barang_masuk($idmasuk)
    {
        $this->db->where('idmasuk', $idmasuk);
        return $this->db->delete('masuk');
    }

}
