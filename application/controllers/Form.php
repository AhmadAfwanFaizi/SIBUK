<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('form_m');
	}

	public function index()
	{
		$this->template->load('template', 'form');
	}

	public function getDataTamu()
    {
        $list = $this->form_m->get_datatables_tamu();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->nama;
            $row[] = $item->alamat;
            $row[] = $item->uang;
            $row[] = $item->beras;
            $row[] = $item->keterangan;
            $row[] = $item->dibuat;
            $row[] = '<button type="button" class="btn btn-sm btn-danger mr-1" onclick="modalHapus()">Hapus</button>
            <button type="button" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#ubahDivisiModal" onclick="modalUbah()">Ubah</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->form_m->count_all_tamu(),
                    "recordsFiltered" => $this->form_m->count_filtered_tamu(),
                    "data" => $data,
                );
        echo json_encode($output);
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
				'nama'       => htmlspecialchars($post['nama']),
				'alamat'     => htmlspecialchars($post['alamat']),
				'uang'       => htmlspecialchars($post['uang']),
				'beras'      => htmlspecialchars($post['beras']),
				'keterangan' => htmlspecialchars($post['keterangan']),
				'status'     => 'BARU',
				'dibuat'     => date('Y-m-d H:i:s')
			];
            $this->form_m->tambah($data);
            if($this->db->affected_rows() > 0) {
                echo json_encode('true');
            }
        }
	}


// END CLASS	
}
