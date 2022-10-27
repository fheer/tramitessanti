<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Actividad_model');
        $this->load->model('TipoTramite_model');
        $this->load->model('DatosTecnicos_model');
        $this->load->model('Requisito_model');


        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Insert inicia la vista header add y footer para persona.
     */
    function insert()
    {
        $data['opcion'] = 1;
        $data['actividad'] = $this->Actividad_model->getAllActividad();

        $this->load->view('layout/header');
        $this->load->view('form/form',$data);
        $this->load->view('layout/footer');

    }

    /**
     * Insert inicia la vista header add y footer para persona.
     */
    function listaSolicitud()
    {
        //$data['opcion'] = 1;
        $data['solicitud'] = $this->DatosTecnicos_model->geListaDatosTecnicos();

        $this->load->view('layout/header');
        $this->load->view('form/lista',$data);
        $this->load->view('layout/footer');

    }


    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
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

            if ($this->Persona_model->validarCi($ci)==0) {
                $params = $this->datos();
                $actividadCargo = $this->input->post('idactividad');
                $user = $this->generarNombreUsuario($this->input->post('nombres'), $this->input->post('apellidoPaterno'), $this->input->post('apellidoMaterno'), $this->input->post('ci'));
                $slugUsuario = $this->generateSlug($user);
                $persona_id = $this->Persona_model->addPersona($params, $user, $this->generarPassword($this->input->post('ci')), $slugUsuario);
                $data['idpersona'] = $persona_id;
                $this->load->view('layout/header');
                $this->load->view('form/datostecnicos',$data);
                $this->load->view('layout/footer');
            }else{
                $data['actividad'] = $this->Actividad_model->getAllActividad();

                $this->load->view('layout/header');
                $this->load->view('form/form',$data);
                $this->load->view('layout/footer');
            }
            
        }
        else
        {   
            $data['opcion'] = $opcion;
            $data['actividad'] = $this->Actividad_model->getAllActividad();
            //$data['expedido'] = $this->Expedido_model->getAllExpedido();
            $this->load->view('layout/header');
            $this->load->view('form/form',$data);
            $this->load->view('layout/footer');
        }
    }

    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function guardarDT()
    {
        $idpersona = $this->input->post('idpersona');
        $tipotramite = $this->input->post('tipotramite');

        ///*
        if ($tipotramite == 'Seleccione') {
            $data['idpersona'] = $idpersona;
            $data['mensaje'] = 'Seleccione el Tipo trámite';
            $this->load->view('layout/header');
            $this->load->view('form/datostecnicos',$data);
            $this->load->view('layout/footer');
        }else{
            $params = $this->datosTecnicosArray();
            
            if (!empty($idpersona)) {
                $this->formValidationDatosTecnicos();
        
                if($this->form_validation->run())
                {
                    $id = $this->DatosTecnicos_model->addDatosTecnicos($params);
                    if ($id > 0) {
                        $this->reporteSolicitud($id, $idpersona);
                    }else{
                        $data['idpersona'] = $idpersona;
                        $data['mensaje'] = 'Error al guardar los datos intente nuevamente';
                        $this->load->view('layout/header');
                        $this->load->view('form/datostecnicos',$data);
                        $this->load->view('layout/footer');
                    }
                }else{
                        $data['idpersona'] = $idpersona;
                        $this->load->view('layout/header');
                        $this->load->view('form/datostecnicos',$data);
                        $this->load->view('layout/footer');
                }
                
            }
        }
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para persona.
     */
    function datoTecnicos()
    {
        $data['idpersona'] = $this->input->post('idpersonadatos');
        //$data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
        $this->load->view('layout/header');
        $this->load->view('form/datostecnicos',$data);
        $this->load->view('layout/footer');

    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datos()
    {
        $ci = $this->input->post('ci');
        $nombres = $this->input->post('nombres');
        $apellidoPaterno = $this->input->post('apellidoPaterno');
        $apellidoMaterno = $this->input->post('apellidoMaterno');
        $params = array(
            'ci' => $this->input->post('ci'),
            'nombres' => $this->input->post('nombres'),
            'apellidoPaterno' => $this->input->post('apellidoPaterno'),
            'apellidoMaterno' => $this->input->post('apellidoMaterno'),
            'genero' => $this->input->post('genero'),
            'idexpedido' => $this->input->post('idexpedido'),
            'estadoCivil' => $this->input->post('estadoCivil'),
            'fechaNacimiento' => $this->input->post('fechaNacimiento'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular'),
            'idcargo' => 5,
            'idactividad' => $this->input->post('idactividad'),
            'key' => $this->generateSlug($this->input->post('ci')),
            'usuario' => $this->generarNombreUsuario($nombres, $apellidoPaterno, $apellidoMaterno, $ci),
            'clave' => $this->generarPassword($ci),
            'permisos' => MD5(4).'#'.MD5(6).'#',
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosTecnicosArray()
    {
        $params = array(
            'idpersona' => $this->input->post('idpersona'),
            'idtipotramite' => $this->input->post('tipotramite'),
            'fecha' => date('Y-m-d'),
            'zona' => $this->input->post('zona'),
            'direccion' => $this->input->post('direccion'),
            'manzano' => $this->input->post('manzano'),
            'predio' => $this->input->post('predio'),
            'avaluo' => $this->input->post('avaluo'),
            'codigo' => $this->input->post('codigo'),
            'distrito' => $this->input->post('distrito'),
            'subdistrito' => $this->input->post('subdistrito'),            
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ci','C.I.','required|min_length[4]|max_length[12]|callback_ci');
        $this->form_validation->set_rules('idactividad','Actividad','required');
        $this->form_validation->set_rules('apellidoPaterno','Apellido Paterno','required|min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('apellidoMaterno','Apellido Materno','required|min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('nombres','Nombres(s)','required|min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('genero','Genero','required');
        $this->form_validation->set_rules('estadoCivil','estadoCivil','required');
        $this->form_validation->set_rules('fechaNacimiento','Fecha de Nacimiento','required');
        $this->form_validation->set_rules('direccion','Dirección','max_length[200]|callback_address');
        $this->form_validation->set_rules('telefono','Telefono','max_length[10]|numeric');
        $this->form_validation->set_rules('celular','Celular','max_length[10]|numeric');
        //$this->form_validation->set_rules('email','email','max_length[50]|valid_email');
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidationDatosTecnicos()
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('tipotramite','Tipo Trámite','required');
       $this->form_validation->set_rules('zona','Zona','required|min_length[5]|max_length[50]');
       $this->form_validation->set_rules('direccion','Dirección','required|max_length[200]|callback_address');
       $this->form_validation->set_rules('manzano','Manzano','required');
       $this->form_validation->set_rules('predio','Predio(Lote)','required');
       $this->form_validation->set_rules('avaluo','Avalúo Catastral','required');
       $this->form_validation->set_rules('codigo','Código Catastral','required');
       $this->form_validation->set_rules('distrito','Distrito','required');
       $this->form_validation->set_rules('subdistrito','Sub Distrito','required');
   }

    /**
     * ReportePersona genera el reporte de personas en formato pdf.
     */
    public function reporteSolicitud($iddatotecnico, $idpersona)
    {
        $data = $this->Persona_model->getPersonaId($idpersona);
        $dataDatos = $this->DatosTecnicos_model->getDatosTecnicosReporte($iddatotecnico, $idpersona);
        $tipotramite = $this->TipoTramite_model->getTipoTramiteId($dataDatos['idtipotramite']);
        $requisito = $this->Requisito_model->getRequisitoId($dataDatos['idtipotramite']);
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
        $nombreSolicitante = strtoupper(utf8_decode($data['nombreCompleto']));

        $datosConstancia = 'Yo '. $nombreSolicitante .' con C.I. expedido en '. 
        utf8_decode($data['idexpedido']).',';

        //$constancia = 'en condición de propietario o representante legal, de acuerdo al Art. 1322 del Código Civil, declaro expresamente que los datos proporcionados mediante el presente formulário son verídicos y fidedignos; para lo que manifiesto pleno conocimiento, entera conformidad y absoluta aceptación para que el Gobierno Autónomo Municipal de Tiquipaya, en uso de sus especificas funciones y atribuciones establecidas por ley, proceda a las inspecciones, reinspecciones y verificaciones, vigilancia alimentaria, análisis de laboratorio, controles de contaminación y fiscalización de los mismos in situ, autorizado y otorgado a dicho efecto las máximas seguridades de ingreso y permanencia al personal técnico designado a practicar las acciones anteriormente señaladas.';
        //
        $constancia = 'en condición de propietario o representante legal, de acuerdo al Art. 1322 del Código Civil, declaro expresamente que los datos proporcionados mediante el presente formulário son verídicos y fidedignos; para lo que manifiesto pleno conocimiento, entera conformidad y absoluta aceptación para que el Gobierno Autónomo Municipal, en uso de sus especificas funciones y atribuciones establecidas por ley, proceda a las inspecciones, reinspecciones y verificaciones, vigilancia alimentaria, análisis de laboratorio, controles de contaminación y fiscalización de los mismos in situ, autorizado y otorgado a dicho efecto las máximas seguridades de ingreso y permanencia al personal técnico designado a practicar las acciones anteriormente señaladas.';
        //$originalDate = "2021-07-18";
        $newDate = date("d-m-Y", strtotime($dataDatos['fecha']));
        $pdf->SetFont('Arial','B',11);
        //$pdf->Cell(30);
        $pdf->Cell(180,10,utf8_decode('FORMULARIO DE SOLICITUD DE TRÁMITE'),0,0,'C');
        $pdf->Ln(15);
        $pdf->Cell(130,10,utf8_decode('FECHA: ').utf8_decode($newDate),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('C.I.: ').utf8_decode($data['ci'].' '.$data['idexpedido']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('SOLICITANTE: ').utf8_decode($data['nombreCompleto']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('DIRECCIÓN: ').utf8_decode($data['direccion']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('TELEFONO: ').utf8_decode($data['telefono']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('CELULAR: ').utf8_decode($data['celular']),0,0,'L');
        $pdf->Ln(20);
        $pdf->Cell(180,10,utf8_decode('DATOS TÉCNICOS'),0,0,'C');
        $pdf->Ln(15);
        $pdf->Cell(130,10,utf8_decode('TIPO DE TRÁMITE: ').utf8_decode($tipotramite['nombreRequisito']),0,0,'L');
        /*requisito
        $pdf->Ln(5);
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("REQUISITO")));
        $i = 1;
        foreach ($requisito as $row) {
            $pdf->Row(array($i,utf8_decode($row['nombreRequisito'])));
            //$pdf->Ln(5);
            $i++;
        }
        //*/
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('ZONA: ').utf8_decode($dataDatos['zona']),0,0,'L');
        $pdf->Ln(5);
                $pdf->Cell(130,10,utf8_decode('DIRECCIÓN: ').utf8_decode($dataDatos['direccion']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('NÚMERO DE MANZANO: ').utf8_decode($dataDatos['manzano']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('NÚMERO DE PREDIO: ').utf8_decode($dataDatos['predio']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('AVALÚO CATASTRAL: ').utf8_decode($dataDatos['avaluo']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('CÓDIGO CATASTRAL: ').utf8_decode($dataDatos['codigo']),0,0,'L');
        $pdf->Ln(5);

        $pdf->Cell(130,10,utf8_decode('DISTRITO: ').utf8_decode($dataDatos['distrito']),0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(130,10,utf8_decode('SUB DISTRITO: ').utf8_decode($dataDatos['subdistrito']),0,0,'L');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',9);
        
        $pdf->Cell(130,10,utf8_decode('Yo '.strtoupper($data['nombreCompleto'])).' con C.I. '.$data['ci'].' expedido '.$data['idexpedido'].',',0,0,'L');
        $pdf->Ln(7);
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(180,5,utf8_decode($constancia),0,'J');

        $pdf->Ln(30);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(180,5,utf8_decode($data['nombreCompleto']),0,0,'C',1);
        $pdf->Ln(5);
        $pdf->Cell(180,5,utf8_decode($data['ci'].' '.$data['idexpedido']),0,0,'C',1);

        $pdf->Output("formulariosolicitud.pdf","I");
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
            $this->form_validation->set_message('alpha_acento', 'El campo {field} solo puede contener caracteres alfabéticos.');
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

    /*
     * Generate hash passsword
     */
    public function generarPassword($password)
    {
        // Hash
        $password = password_hash($password, PASSWORD_BCRYPT,[5]);
        // Hash
        $hash = substr($password, 0, 60);
        return $hash;
    }
    
    function generarNombreUsuario($nombres, $apellidoPaterno, $apellidoMaterno, $ci)
    {
        $inicialNombre = substr(trim($nombres),0,1);
        $inicialApellidoPaterno = substr(trim($apellidoPaterno),0,1);
        $inicialApellidoMaterno = substr(trim($apellidoMaterno),0,1);

        return $inicialNombre.$inicialApellidoPaterno.$inicialApellidoMaterno.$ci;

    }
}
