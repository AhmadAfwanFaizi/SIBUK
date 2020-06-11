<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sibuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'jumlah_tamu'       => $this->jumlah()->jumlah_tamu,
			'jumlah_uang'       => rupiah($this->jumlah()->jumlah_uang),
			'jumlah_beras'      => $this->jumlah()->jumlah_beras,
			'jumlah_keterangan' => $this->jumlah()->jumlah_keterangan
		];
		
		// var_dump($data);
		// die;

		$this->template->load('template', 'dashboard', $data);
	}

	public function jumlah()
	{
		$this->db->select("COUNT(id) as jumlah_tamu, SUM(uang) as jumlah_uang, SUM(beras) as jumlah_beras, count(keterangan) as jumlah_keterangan")
						->from('tb_tamu');
		return $this->db->get()->row();
	}



// END CLASS	
}
