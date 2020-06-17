<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_m');
    }

    public function index()
    {
        $data = [
            'kampung' => $this->getKampung()
        ];

        $this->template->load('template', 'data', $data);
    }

    public function getKampung()
    {
        $this->db->select("DISTINCT(alamat) as kampung")
                    ->from('tb_tamu');
        return $this->db->get();
    }

    public function tandai()
    {
        $id = $this->input->post('id', true);
        $this->data_m->tandai($id);
        if($this->db->affected_rows() > 0) {
            echo json_encode(['res' => 'true']);
        }
    }

    public function getDataTamu()
    {
        $kampung = $this->input->post('kampung', true);

        $list = $this->data_m->get_datatables_tamu($kampung);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            if($item->status == 'BARU' || $item->status == '' || $item->status == NULL) {
                $tombol = '<button type="button" class="btn btn-sm btn-primary mr-1" value="'.$item->status.'" onclick="tandai('."'$item->id'".')" >Tandai</button>';
            } else {
                $tombol = '';
            }

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
            $row[] = $item->status;
            $row[] = $tombol;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->data_m->count_all_tamu($kampung),
                    "recordsFiltered" => $this->data_m->count_filtered_tamu($kampung),
                    "data" => $data,
                );
        echo json_encode($output);
    }

}