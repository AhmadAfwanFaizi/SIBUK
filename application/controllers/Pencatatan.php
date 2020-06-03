<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencatatan extends CI_Controller {

	public function index()
	{
		$this->template->load('template/index', 'dashboard');
	}

// END CLASS	
}
