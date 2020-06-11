<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_m extends CI_Model {

    public function tambah($data)
    {
        return $this->db->insert('tb_tamu', $data);
    }

    public function ubah($data)
    {
        
    }

    var $kolom_order_tamu = array(null, 'nama', 'alamat', 'uang', 'beras', 'keterangan', 'dibuat');
    var $search_tamu      = array('nama', 'alamat', 'uang', 'beras', 'keterangan');
    var $order_t          = array('dibuat' => 'asc');

    private function _get_datatables_tamu() {
        $this->db->select("*");
        $this->db->from('tb_tamu');
        $i = 0;
        foreach ($this->search_tamu as $item) { 
            if(@$_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->search_tamu) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by($this->kolom_order_tamu[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order_t)) {
            $order_t = $this->order_t;
            $this->db->order_by(key($order_t), $order_t[key($order_t)]);
        }
    }
    function get_datatables_tamu() {
        $this->_get_datatables_tamu();
        $this->db->order_by('dibuat', 'desc');
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_tamu() {
        $this->_get_datatables_tamu();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_tamu() {
        $this->db->from('tb_tamu');
        return $this->db->count_all_results();
    }

}