<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	/**
     * Constructor Welcome.
     */
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Usuario_model');
        $this->load->model('Tramite_model');
        
        //require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function error()
	{
		$data['mensaje'] = 'Tiene que iniciar sesión';
		$this->load->view('login', $data);
	}

	public function inicio()
	{
		///*
		$this->load->view('layout/header');
		$this->load->view('main');
		$this->load->view('layout/footer');
		//*/
	}


}

