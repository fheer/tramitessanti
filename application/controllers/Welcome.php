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
        $this->load->model('ProcesoTramite_model');
        $this->load->model('Persona_model');
        
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
		$ci = $this->session->userdata('ci');

		$data['persona'] = $this->Persona_model->getPersonaCI($ci);
		$data['personatramite'] = $this->ProcesoTramite_model->procesoOnlyTramiteById($data['persona']['idpersona']);
		$tipo = $this->session->userdata('tipo');
		if ($tipo == 1) {
			$this->load->view('layout/header');
			$this->load->view('main', $data);
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header');
			$this->load->view('mainf');
			$this->load->view('layout/footer');
		}
		
		//*/
	}


}

