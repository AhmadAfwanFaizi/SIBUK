<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_m extends CI_Model {

    public function tambah($data)
    {
        return $this->db->insert('tb_tamu', $data);
    }

}