<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('NormaLegal_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para norma.
     */
    function index($latitud, $longitud)
    {
        $data['latitud'] = $latitud;
        $data['longitud'] = $longitud;
        
        $this->load->view('layout/header');
        $this->load->view('mapa/mostrar',$data);
        $this->load->view('layout/footer');
    }
}
