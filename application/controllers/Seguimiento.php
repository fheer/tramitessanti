<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguimiento extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('ProcesoTramite_model');
        $this->load->model('PersonaTramite_model');
        $this->load->model('TipoTramite_model');
        $this->load->model('Funcionario_model');
        $this->load->model('Tramite_model');
        $this->load->model("Cargo_model");
        $this->load->model("Actividad_model");

        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para procesoTramite.
     */
    function index()
    {
        $this->load->view('layout/header');
        $this->load->view('seguimiento/buscar');
        $this->load->view('layout/footer');
    }


    /**
     * Abrir documento pdf
     */
    function abrirPdf($pdf)
    {
        $data['nombre'] = $pdf;
        
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/pdf',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function buscar()
    {
        $data['persona'] = $this->Persona_model->getTodasPersonasFullName();
        $data['tramite'] = $this->ProcesoTramite_model->getAllProcesoTramite();

        ///* 
        $this->load->view('layout/header');
        $this->load->view('seguimiento/buscar',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function buscarTramite()
    {
        $ci = $this->input->post('ci');
        //echo $this->session->userdata('ci');
        ///*
        $this->formValidation();
        
        if($this->form_validation->run())     
        {   
            if ($ci != $this->session->userdata('ci')) {
                $data['mensaje'] = 'Ud solo puede realizar busquedas e sus tramites ingrese su Cedula de Identidad';
            ///* 
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar',$data);
            $this->load->view('layout/footer');
            }else{
            $data['persona'] = $this->Persona_model->getPersonaCI($ci);
            $data['tramite'] = $this->ProcesoTramite_model->procesoTramiteById($data['persona']['idpersona']);
            //print_r($data);

            ///* 
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar',$data);
            $this->load->view('layout/footer');
            }
         
        }
        else
        {   
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar');
            $this->load->view('layout/footer');
        }
        //*/
    }

    /**
     * Index inicia la vista header index y footer para procesoTramite.
     */
    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function hojaderuta($idpersona,$idtramite)
    {   

            $data['persona'] = $this->Persona_model->getPersonaHojaById($idpersona);
            $data['tramite'] = $this->ProcesoTramite_model->procesoTramiteByIdPersonaIdtramite($data['persona']['idpersona'],$idtramite);
            //print_r($data['tramite']);

            ///*
            $this->load->view('layout/header');
            $this->load->view('seguimiento/hojaruta',$data);
            $this->load->view('layout/footer');
            //*/
       
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function buscarHoja()
    {
        $codigo = $this->input->post('codigo');
        
        $this->formValidationCodigo();
        
        if($this->form_validation->run())     
        {   
            $data= $this->ProcesoTramite_model->procesoTramiteByCodigo($codigo);
            
            foreach ($data as $rowDatos) {
                $nombreCompleto = $this->Persona_model->getPersonaId($rowDatos['idpersona']);
                $codigo = $rowDatos['codigo'];
            }
            //$persona = $this->Persona_model->getPersonaId($data['idpersona']);

            $pdf = new PDF_MC_Table();
            $pdf->AddPage();
            $pdf->AliasNbPages();
            $pdf->SetLeftMargin(15);
            $pdf->SetRightMargin(15);
            $pdf->SetFillColor(300,300,300);
            $pdf->SetXY(31, 11);
            /*
            $logoConsejo = base_url()."fotos/logo.jpg";
            $pdf->Image($logoConsejo, 175, 5, 25, 23);
            $logo = base_url()."fotos/consejo.jpg";
            $pdf->Image($logo, 15, 5, 25, 23);
            */
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(30);
            $pdf->Cell(100,10,utf8_decode('HOJA DE RUTA'),0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(130,10,utf8_decode('SOLICITANTE '.$nombreCompleto['nombreCompleto']),0,0,'L');
            $pdf->Ln(5);
            $pdf->Cell(130,10,utf8_decode('Nº TRAMITE '.$codigo),0,0,'L');
            $pdf->Ln(5);


            $pdf->SetFont('Arial','',11);
            $pdf->SetWidths(array(10,40,40,45,45));
            $pdf->Row(array(utf8_decode("Nº"),utf8_decode("UNIDAD ORIGEN"),utf8_decode("FECHA INICIO"),utf8_decode("FECHA FIN")));
            $pdf->SetFont('Arial','',10);
            $indice=1;

            foreach ($data as $row) {
                $funcionario = $this->Persona_model->getPersonaByIdfuncionario($row['idfuncionario']);
                $unidadOrigen = $this->PersonaTramite_model->getUnidadTramite($row['idtramite'], $row['idfuncionario']);

                foreach ($data as $row) {
                    
                }
                $pdf->Row(array($indice,utf8_decode($unidadOrigen.' - '.$funcionario['nombreCompleto']),utf8_decode($row['fechaInicio']),utf8_decode($row['fechaFin'])));
                $indice++;
            }

            $pdf->Output("hojaderuta.pdf","I");

            /* 
            $this->load->view('layout/header');
            $this->load->view('seguimiento/hojaruta',$data);
            $this->load->view('layout/footer');
            //*/
        }
        else
        {   
            $data['mensaje'] = "Ingrese el Número de tramite";
            $this->load->view('layout/header');
            $this->load->view('seguimiento/hojaruta');
            $this->load->view('layout/footer');
        }
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function bitacora($idtramite)
    {

        $data= $this->ProcesoTramite_model->procesoTramiteByIdBitacora($idtramite);

        $dataTramite = $this->Tramite_model->getTramite($idtramite);
        $tipoTramite = $this->TipoTramite_model->getTipoTramiteId($dataTramite['idtipotramite']);
        $nombreTramite = $tipoTramite['nombreRequisito'];

        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetLeftMargin(15);
        $pdf->SetRightMargin(15);
        $pdf->SetFillColor(300,300,300);
        $pdf->SetXY(31, 11);

        foreach ($data as $rowDatos) {
                $nombreCompleto = $this->Persona_model->getPersonaId($rowDatos['idpersona']);
                //$solicitante = $nombreCompleto['nombreCompleto'];
                $codigo = $rowDatos['codigo'];
        }
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

            $pdf->Cell(180,10,utf8_decode('BITACORA'),0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(130,10,utf8_decode('SOLICITANTE: '.$nombreCompleto['nombreCompleto']),0,0,'L');
            $pdf->Ln(5);
            $pdf->Cell(130,10,utf8_decode('Nº TRAMITE: '.$codigo),0,0,'L');
            $pdf->Ln(5);
            $pdf->Cell(130, 10, utf8_decode('Trámite: '.$nombreTramite),0,0,'L');
            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',11);
            $pdf->SetWidths(array(10,50,30,30,30,40));
            $pdf->Row(array(utf8_decode("Nº"),utf8_decode("FUNCIONARIO - CARGO"),utf8_decode("FASE"),utf8_decode("FECHA INICIO"),utf8_decode("FECHA FIN"),utf8_decode("OBSERVACIÓN")));
            $pdf->SetFont('Arial','',10);
            $indice=1;
            $obs= $this->ProcesoTramite_model->getObservacionesId($idtramite);

            //$numero = count($obs);
            $i = 0;
            foreach ($obs as $key) {
                    // code...
                if ($i == 0) {
                    //$fase = $key['observaciones'];
                }
                if ($i == 1) {
                    $fase1 = $key['observaciones'];
                }
                if ($i == 2) {
                    $fase2 = $key['observaciones'];
                }
                if ($i == 3) {
                    $fase3 = $key['observaciones'];
                }
                if ($i == 4) {
                    $fase3 = $key['observaciones'];
                }
                $i++;
            }

            $var1 = 0;
            $var2 = 0;
            $var3 = 0;
            $var4 = 0;

            foreach ($data as $row) {
                $funcionario = $this->Persona_model->getPersonaByIdfuncionario($row['idfuncionario']);
                $cargo = $this->Cargo_model->getCargo($funcionario['idcargo']);

                if ($indice==1) {
                    if (empty($fase1)) {
                        $fase1 = '';
                    }
                    $pdf->Row(array($indice,utf8_decode($cargo['cargo'].' - '.$funcionario['nombreCompleto']),utf8_decode($row['fase']),utf8_decode($row['fechaInicio']),utf8_decode($row['fechaFin']),utf8_decode($fase1)));
                }

                if ($indice==2) {
                    if (empty($fase2)) {
                        $fase2 = '';
                    }
                    $pdf->Row(array($indice,utf8_decode($cargo['cargo'].' - '.$funcionario['nombreCompleto']),utf8_decode($row['fase']),utf8_decode($row['fechaInicio']),utf8_decode($row['fechaFin']),utf8_decode($fase2)));
                }
                if ($indice==3) {
                    if (empty($fase3)) {
                        $fase3 = ' ';
                    }
                    $pdf->Row(array($indice,utf8_decode($cargo['cargo'].' - '.$funcionario['nombreCompleto']),utf8_decode($row['fase']),utf8_decode($row['fechaInicio']),utf8_decode($row['fechaFin']),utf8_decode($fase3)));
                }
                if ($indice==4) {
                    if (empty($fase4)) {
                        $fase4 = ' ' ;
                    }
                    $pdf->Row(array($indice,utf8_decode($cargo['cargo'].' - '.$funcionario['nombreCompleto']),utf8_decode($row['fase']),utf8_decode($row['fechaInicio']),utf8_decode($row['fechaFin']),utf8_decode($fase4)));
                }
                $indice++;
            }

            $pdf->Output("bitacora.pdf","I");
    }



    /**
     * GetTramiteRequisitos.
     * @return result_array con datos de requisitos de los tipotramites.
     */
    function getTramiteRequisitos($idtipotramite)
    {
        $data = json_encode($this->TipoTramite_model->getTramiteRequisitos($idtipotramite));
        echo $data;
    }

    /**
     * GetTramiteRequisitos.
     * @return result_array con datos de requisitos de los tipotramites.
     */
    function getTramiteRequisitosPhp($idtipotramite)
    {
        return $this->TipoTramite_model->getTramiteRequisitos($idtipotramite);
    }

    /**
     * Editar inicia la vista header edit y footer para procesoTramite.
     */
    function editar($slug, $opcion)
    {
        $data['opcion'] = $opcion;
    	$data['procesoTramite'] = $this->ProcesoTramite_model->getProcesoTramite($slug);
        $idtramite = $data['procesoTramite']['idtramite'];
        $data['personatramite'] = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        $idpersona = $data['personatramite']['idpersona'];
        $idfuncionario = $data['personatramite']['idfuncionario'];
        
        $data['idfuncionario'] = $this->Funcionario_model->getIdPersonaByIdfuncionario($idfuncionario);
        $idPersonaIdFuncionario = $data['idfuncionario']['idpersona'];
        //
        $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
        $data['unfuncionario'] = $this->Persona_model->getPersonaId($idPersonaIdFuncionario);
        $data['solicitante'] = $this->Persona_model->getTodasPersonasFullName();
        $data['funcionario'] = $this->Persona_model->getAllPersona(2);
        $data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
        
        $idtipotramite = $data['procesoTramite']['idtipotramite'];
        $data['nombretramite'] = $this->TipoTramite_model->getTipoTramite($idtipotramite);

        $data['requistosTramite']  = $this->TipoTramite_model->getTramiteRequisitos($idtipotramite);
        //* 
    	$this->load->view('layout/header');
        $this->load->view('procesoTramite/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function buscarByCi()
    {   
        $ci = $this->input->post('ci');

        $this->formValidation();

        if($this->form_validation->run())
        {
            if ($this->session->userdata('tipo') == 2) {
                $data['persona'] = $this->Persona_model->getPersonaCI($ci);
                if (!empty($data['persona'])) {
                    $data['personatramite'] = $this->ProcesoTramite_model->procesoOnlyTramiteById($data['persona']['idpersona']);
                    if (!empty($data['personatramite'])) {
                        $this->load->view('layout/header');
                        $this->load->view('seguimiento/buscar',$data);
                        $this->load->view('layout/footer');
                    }else{
                        $data['mensaje'] = 'El solicitante no tiene trámites';
                        $this->load->view('layout/header');
                        $this->load->view('seguimiento/buscar',$data);
                        $this->load->view('layout/footer');
                    }
                }else{
                    $data['mensaje'] = 'El solicitante no tiene trámites';
                    $this->load->view('layout/header');
                    $this->load->view('seguimiento/buscar',$data);
                    $this->load->view('layout/footer');
                }
            }else{
                if ($ci != $this->session->userdata('ci')) {
                $data['mensaje'] = 'Ud solo puede realizar busquedas de sus tramites ingrese su Cedula de Identidad';
                ///* 
                $this->load->view('layout/header');
                $this->load->view('seguimiento/buscar',$data);
                $this->load->view('layout/footer');
            }else{
                $data['persona'] = $this->Persona_model->getPersonaCI($ci);
                if (!empty($data['persona'])) {
                    $data['personatramite'] = $this->ProcesoTramite_model->procesoOnlyTramiteById($data['persona']['idpersona']);
                    if (!empty($data['personatramite'])) {
                        $this->load->view('layout/header');
                        $this->load->view('seguimiento/buscar',$data);
                        $this->load->view('layout/footer');
                    }else{
                        $data['mensaje'] = 'El solicitante no tiene trámites';
                        $this->load->view('layout/header');
                        $this->load->view('seguimiento/buscar',$data);
                        $this->load->view('layout/footer');
                    }
                }else{
                    $data['mensaje'] = 'El solicitante no tiene trámites';
                    $this->load->view('layout/header');
                    $this->load->view('seguimiento/buscar',$data);
                    $this->load->view('layout/footer');
                }
            }

            }
            
        }else{
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar');
            $this->load->view('layout/footer');
        }       
    }

    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function buscarDB()
    {   

        $ci = $this->input->post('ci');

        $this->formValidation();
        
        if($this->form_validation->run())     
        {   
            $data['persona'] = $this->Persona_model->getPersonaCI($ci);
            $data['tramite'] = $this->ProcesoTramite_model->procesoTramiteById($data['persona']['idpersona']);
            //print_r($data);

            ///* 
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar',$data);
            $this->load->view('layout/footer');
            //*/
        }
        else
        {   
            $this->load->view('layout/header');
            $this->load->view('seguimiento/buscar',$data);
            $this->load->view('layout/footer');
        }       
    }



    

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosBuscar($ci)
    {
        $params = array(
            'ci' => $ci,
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('ci','C.I.','required');
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidationCodigo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('codigo','Código','required');
    }

    /**
     * ReportePersona genera el reporte de procesoTramites en formato pdf.
     */
    public function reportePersona()
    {
        
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

        if (preg_match('/^[A-Záéíóú]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('alpha_acento', 'El campo {field} solo puede contener caracteres alfabéticos.');
            return FALSE;
        }
    }

    
    function generarCodigo($tramite, $cantidadRegistros)
    {

        $arrayTramite = explode(" ",$tramite);

        $codigo='';
        foreach($arrayTramite as $palabra) {
            $codigo .= substr(trim($palabra),0,1);
        }
        $cantidadRegistros += 1000;
        return strtoupper($codigo).'-'.$cantidadRegistros;

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

    public function subirImagen($nombreArchivo){

        if ($_FILES['userfile']['name'] == NULL) {
            return $this->input->post('foto');
        } else {

            $config['upload_path'] = './documentos/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '10240';
            $config['file_name'] = $nombreArchivo;
            //$config['max_width'] = '2024';
            //$config['max_height'] = '10240';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("userfile")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return '';
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;
                
                return $imagen;
            }

        }
    }
}

