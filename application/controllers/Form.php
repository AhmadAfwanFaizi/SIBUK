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

    public function getData()
    {
        $id = $this->input->post('id', true);
        echo json_encode($this->db->get_where('tb_tamu', ['id' => $id])->row());
    }

	public function getDataTamu()
    {
        $list = $this->form_m->get_datatables_tamu();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $item->nama;
            $row[] = $item->alamat;
            $row[] = rupiah(intval($item->uang));
            $row[] = $item->beras;
            $row[] = $item->keterangan;
            $row[] = substr($item->dibuat, 0, 10);
            $row[] = substr($item->dibuat, 11,19);
            $row[] = '<button type="button" class="btn btn-sm btn-warning mr-1" onclick="formUbah('.$item->id.')">Ubah</button>';
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

	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
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
                'uang'       => str_replace('.', '', htmlspecialchars($post['uang'])),
                'beras'      => htmlspecialchars($post['beras']),
                'keterangan' => $post['keterangan'] ? htmlspecialchars($post['keterangan']) : null,
                'status'     => 'BARU',
                'dibuat'     => date('Y-m-d H:i:s')
            ];
            $this->form_m->tambah($data);
            if($this->db->affected_rows() > 0) {
                echo json_encode([
                    'res'  => 'true',
                    'nama' => $post['nama']
                ]);
            }
        }
    }

    public function ubah()
    {
       
        $this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_message('required', '{field} Tidak boleh kosong');

        if($this->form_validation->run() == FALSE) {
            echo json_encode([
				'nama'   => form_error('nama'),
				'alamat' => form_error('alamat')
				]);

        } else {

			$post = $this->input->post(null, TRUE);
			$data = [
                'id'         => htmlspecialchars($post['id']),
				'nama'       => htmlspecialchars($post['nama']),
				'alamat'     => htmlspecialchars($post['alamat']),
				'uang'       => str_replace('.', '', htmlspecialchars($post['uang'])),
				'beras'      => htmlspecialchars($post['beras']),
				'keterangan' => $post['keterangan'] ? htmlspecialchars($post['keterangan']) : null,
				'status'     => 'BARU',
				'dibuat'     => date('Y-m-d H:i:s')
            ];
            $this->form_m->ubah($data);
            if($this->db->affected_rows() > 0) {
                echo json_encode([
                    'res'  => 'true',
                    'nama' => $post['nama']
                ]);
            }
        }
    }
    
    


// END CLASS	
}
