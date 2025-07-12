<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    public function get_notif_counts() {
        $notif = [];

        // Barang habis stok / sangat rendah
        $this->db->where('stock <', 1);
        $this->db->or_where('stock < min_stock / 2', NULL, FALSE);
        $notif['habis'] = $this->db->get('stock')->num_rows();

        // Barang hampir habis
        $this->db->where('(stock < min_stock OR stock = min_stock)', NULL, FALSE);
        $this->db->where('stock >= min_stock / 2', NULL, FALSE);
        $notif['mau_habis'] = $this->db->get('stock')->num_rows();

        // Barang berlebih
        $this->db->where('stock > max_stock');
        $notif['berlebih'] = $this->db->get('stock')->num_rows();

        $notif['total'] = $notif['habis'] + $notif['mau_habis'] + $notif['berlebih'];

        return $notif;
    }

    public function get_all_stock() {
        $this->db->order_by('namabarang', 'ASC');
        return $this->db->get('stock')->result();
    }

    
}
