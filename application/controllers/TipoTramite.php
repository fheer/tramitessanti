<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoTramite extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Requisito_model');
        $this->load->model('TipoTramite_model');
        $this->load->model('NormaLegal_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para tipotramite.
     */
    function index()
    {
        $data['tipotramite'] = $this->TipoTramite_model->getAllTipoTramite();    
        $this->load->view('layout/header');
        $this->load->view('tipotramite/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para tipotramite.
     */
    function insert()
    {
        $data['normalegal'] = $this->NormaLegal_model->getAllNormaLegal();
        $data['requisito'] = $this->Requisito_model->getAllRequisito();

        ///* 
        $this->load->view('layout/header');
        $this->load->view('tipotramite/add',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para tipotramite.
     */
    function editar($slug)
    {
    	$data['tipotramite'] = $this->TipoTramite_model->getTipoTramiteSlug($slug);
        $idtipotramite = $this->TipoTramite_model->getIdBySlug($slug);
        $data['requisito'] = $this->Requisito_model->getAllRequisito();
        $data['requisitos'] = $this->TipoTramite_model->getRequisitos($idtipotramite);
        $data['normalegalID'] = $this->NormaLegal_model->getNormaLegal($data['tipotramite']['idnormaLegal']);
        $data['normalegal'] = $this->NormaLegal_model->getAllNormaLegal();
        ///* 
    	$this->load->view('layout/header');
        $this->load->view('tipotramite/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a TipoTramite_model para guardar datos.
     */
    function guardarDB()
    {   
        $nombre = $this->input->post('nombre');
        $ci = $this->input->post('ci');
        $opcion = $this->input->post('opcion');
        $tipoPersona = $this->input->post('tipoPersona');

        $this->formValidation();
        
		if($this->form_validation->run())     
        {   
            
            if ($this->TipoTramite_model->validarNombreTipoTramite($nombre)==0) {
                $params = $this->datos();
                
                if(!empty($_POST['requisitos'])){
                    $tipotramite_id = $this->TipoTramite_model->addTipoTramite($params);

                    $requisitos = '';
                    foreach($_POST['requisitos'] as $selected){
                        $paramsRequisitos = array(
                            'idtipotramite' => $tipotramite_id,
                            'idrequisito' => $selected,
                        );
                        $requisito_id =  $this->Requisito_model->addTipoTramiteRequisito($paramsRequisitos);
                    }
                    $data['mensaje'] = 'Tipo trámite Registrado con exito';
                    $data['tipotramite'] = $this->TipoTramite_model->getAllTipoTramite();    
                    $this->load->view('layout/header');
                    $this->load->view('tipotramite/index',$data);
                    $this->load->view('layout/footer');
                }else{
                    $data['mensaje'] = 'Seleccione Requisitos';
                    $data['normalegal'] = $this->NormaLegal_model->getAllNormaLegal();
                    $data['requisito'] = $this->Requisito_model->getAllRequisito();
                    ///* 
                    $this->load->view('layout/header');
                    $this->load->view('tipotramite/add',$data);
                    $this->load->view('layout/footer');
                    //*/
                }                         
            }else{
                $data['mensaje'] = 'El Nombre del Requisito se encuentra registrado';
                $data['normalegal'] = $this->NormaLegal_model->getAllNormaLegal();
                $data['requisito'] = $this->Requisito_model->getAllRequisito();

                ///* 
                $this->load->view('layout/header');
                $this->load->view('tipotramite/add',$data);
                $this->load->view('layout/footer');
                //*/
            }
            
        }
        else
        {   
            $data['normalegal'] = $this->NormaLegal_model->getAllNormaLegal();
            $data['requisito'] = $this->Requisito_model->getAllRequisito();

                ///* 
            $this->load->view('layout/header');
            $this->load->view('tipotramite/add',$data);
            $this->load->view('layout/footer');
        }
        
    }

    /**
     * EditarDB envia los datos a TipoTramite_model para modificar datos.
     */
    function editarDB()
    {   
    		$idtipotramite = $this->input->post('idtipotramite');
        	$this->formValidation();
			if($this->form_validation->run())     
            {   
                $params = $this->datos();
                $allRequisitos = $this->TipoTramite_model->getRequisitos($idtipotramite);
                $paramsDelete = array(
                    'idtipotramite' => $idtipotramite,
                );
                
                $this->TipoTramite_model->updateTipoTramite($idtipotramite,$params);
                $this->TipoTramite_model->delete($paramsDelete);
                foreach($_POST['requisitos'] as $selected){
                    $paramsRequisitos = array(
                        'idtipotramite' => $idtipotramite,
                        'idrequisito' => $selected,
                        );
                    $requisito_id =  $this->Requisito_model->addTipoTramiteRequisito($paramsRequisitos);
                }
                $data['mensaje'] = 'Tipo trámite Modificado con exito';
                $data['tipotramite'] = $this->TipoTramite_model->getAllTipoTramite();    
                $this->load->view('layout/header');
                $this->load->view('tipotramite/index',$data);
                $this->load->view('layout/footer');
            }
            else
            {
                $data['opcion'] = $opcion;
                $data['tipotramite'] = $this->TipoTramite_model->getPersona($slug);
                $idexpedido = $data['tipotramite']['idexpedido'];
                $idcargo = $data['tipotramite']['idcargo'];
                $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
                $data['act'] = $this->Cargo_model->getActividad($idcargo);
                $data['cargo'] = $this->Cargo_model->getAllActividad();
                $data['expedido'] = $this->Expedido_model->getAllExpedido();     
            }
        
    }

    /**
     * CambiarEstado envia los datos a TipoTramite_model para cambiar el campo condición.
     */
    function cambiarEstado($idtipotramite,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            $this->TipoTramite_model->cambiarEstado($idtipotramite,$params);

            redirect(base_url().'tipotramite/lista');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datos()
    {
        $params = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'tiempoEstimado' => $this->input->post('tiempoEstimado'),
            'slug' => $this->generateSlug($this->input->post('nombre')),
            'idnormalegal' => $this->input->post('idnormalegal'),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('nombre','Nombre Tipo Trámite','required|min_length[5]|max_length[100]|callback_alpha_acento');
        $this->form_validation->set_rules('descripcion','Descripción Tipo Trámite','required|min_length[5]|max_length[100]|callback_alpha_acento');
        $this->form_validation->set_rules('tiempoEstimado','Tiempo Estimado','max_length[3]|max_length[100]|numeric');
       
    }

    /**
     * ReportePersona genera el reporte de tipotramites en formato pdf.
     */
    public function reporteTipoTramite()
    {
        $data = $this->TipoTramite_model->getAllTipoTramite();    
             
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetLeftMargin(15);
        $pdf->SetRightMargin(15);
        $pdf->SetFillColor(300,300,300);
        $pdf->SetXY(31, 11);

        $logo = base_url()."fotos/logo1.jpg";
            $pdf->Image($logo, 15, 5, 25, 23);

            date_default_timezone_set("America/La_Paz");

            $hoy = date("d/m/Y H:i:s");

            $pdf->SetXY(15, 11);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(185,10,utf8_decode('GOBIERNO AUTONOMO MUNCIPAL'),0,0,'R');
            $pdf->SetXY(15, 15);
            $pdf->Cell(185,10,utf8_decode('Fecha Impresion '. $hoy),0,0,'R');
            $pdf->SetXY(15, 19);
            $pdf->Cell(185,10,utf8_decode('Usuario: '.$this->session->userdata('usuario')),0,0,'R');
            $pdf->Ln(15);
            $pdf->SetFont('Arial','B',14);
        

        $pdf->Cell(180,10,utf8_decode('LISTA DE TRÁMITES'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,85,85));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("TIPO TRAMITE"),utf8_decode("DESCRIPCIÓN")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            /*

            //*/
            $pdf->Row(array($indice,utf8_decode($row['nombreRequisito']),utf8_decode($row['descripcion'])));
            //$pdf->Ln(5);
            $indice++;
        }

        $pdf->Output("listatipotramite.pdf","I");
    }

    /**
     * Método para validar direccion
     */
    public function address($str)
    {
        if (preg_match('/^[A-Z0-9áéíóú.#,()* ]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('address', 'El campo {field} solo puede contener caracteres alfabéticos . y/o #  .');
            return FALSE;
        }
    }
    
    /**
     * Método para validar cadenas con espacio
     */
    public function alpha_space($str)
    {

        if (preg_match('/^[A-Záéíóú ]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('alpha_space', 'El campo {field} solo puede contener caracteres alfabéticos y espacio.');
            return FALSE;
        }
    }


    /**
     * Método para validar carnet de identidad
     */
    public function ci($str)
    {

        if (preg_match('/^[A-Z0123456789]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('ci', 'El campo {field} solo puede contener caracteres alfabéticos y espacio.');
            return FALSE;
        }
    }

    /**
     * Método para validar cadenas con acentos
     */
    public function alpha_acento($str)
    {

        if (preg_match('/^[A-Záéíóú ]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('alpha_acento', 'El campo {field} solo puede contener caracteres alfabéticos y espacios.');
            return FALSE;
        }
    }

    /**
     * Método para generar un codigo sin $ y /
     */
    public function generateSlug($slug)
    {
        // Hash
        $slug = password_hash($slug, PASSWORD_BCRYPT,[5]);
        $resultado = str_replace("$", "", $slug);
        $resultado = str_replace("/", "", $resultado);
        return $resultado;
    }
}
