<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function index()
	{
		$this->template->load('template', 'form');
	}

	public function tambahTamu()
	{
		$this->form_validation->set_rules('nama', 'Nama Divisi', 'required');
		$this->form_validation->set_rules('alamat', 'Nama Divisi', 'required');
        $this->form_validation->set_message('required', '{field} Tidak boleh kosong');

        if($this->form_validation->run() == FALSE) {
            echo json_encode([
				'nama'   => form_error('nama'),
				'alamat' => form_error('alamat')
				]);

        } else {

			$post = $this->input->post(null, TRUE);
			$data = [
				'nama' => htmlspecialchars($post['nama']),
				'alamat' => htmlspecialchars($post['alamat']),
				'uang' => htmlspecialchars($post['uang']),
				'beras' => htmlspecialchars($post['beras']),
				'catatan' => htmlspecialchars($post['catatan']),
				'status' => 'BARU',
				'dibuat' => date('Y-m-d H:i:s')
			];
            $this->form_m->tambah($data);
            if($this->db->affected_rows() > 0) {
                echo json_encode('true');
            }
        }
	}


// END CLASS	
}
