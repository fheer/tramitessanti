<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asignados extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tramite_model');
        $this->load->model('TipoTramite_model');
        $this->load->model('Persona_model');
        $this->load->model('Funcionario_model');
        $this->load->model('PersonaTramite_model');
        $this->load->model('ProcesoTramite_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';

        require_once  APPPATH.'third_party/tcpdf/tcpdf.php';
        require_once  APPPATH.'third_party/tcpdf/fonts/courier.php';
    }

    /**
     * Index inicia la vista header index y footer para funcionario.
     */
    function index()
    {
        $data['funcionario'] = $this->Asignados_model->getAllPersona(2);    
        $this->load->view('layout/header');
        $this->load->view('funcionario/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para funcionario.
     */
    function insert($idtramite)
    {
        $idusuario = $this->session->userdata('idpersona');
        ///*
        $data['personatramite'] = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        $data['tramite'] = $this->Tramite_model->getTramite($idtramite);
        $data['tipotramite'] = $this->TipoTramite_model->getTipoTramiteId($data['tramite']['idtipotramite']);
        $data['persona'] = $this->Persona_model->getPersonaId($data['personatramite']['idpersona']);
        $data['observaciones'] = $this->ProcesoTramite_model->getObservacionesId($data['tramite']['idtramite']);
        $data['funcionario'] = $this->Funcionario_model->getAllFuncionarioFullName($idusuario);

        ///* 
        $this->load->view('layout/header');
        $this->load->view('asignados/view',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para funcionario.
     */
    function editar($slug, $opcion)
    {
        $data['opcion'] = $opcion;
        $data['funcionario'] = $this->Asignados_model->getPersona($slug);
        $idexpedido = $data['funcionario']['idexpedido'];
        $idfuncionario = $data['funcionario']['idpersona'];
        $data['cargo'] = $this->Funcionario_model->getFuncionarioId($idfuncionario);
        $idcargo = $data['cargo']['idcargo'];
        $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
        $data['act'] = $this->Cargo_model->getCargo($idcargo);
        $data['cargo'] = $this->Cargo_model->getAllCargo();
        $data['expedido'] = $this->Expedido_model->getAllExpedido();
        
        ///* 
        $this->load->view('layout/header');
        $this->load->view('funcionario/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Asignados_model para guardar datos.
     */
    function guardarDB()
    {   

        $idpersonatramite = $this->input->post('idpersonatramite');
        $idtramite = $this->input->post('idtramite');
        $idusuario = $this->input->post('idusuario');
        if (!empty($this->input->post('idusuarioNew'))) {
            $idusuarioNew = $this->input->post('idusuarioNew');
        }else{
            $idusuarioNew = $this->input->post('idusuario');
        }
        
        
        $datosFuncionario = $this->Persona_model->getDatosfuncionarioUsuario($idusuario);
        
        $idpersona = $this->input->post('idpersona');
        $observaciones = $this->input->post('observaciones');
        $accion = $this->input->post('accion');
        $fechaInicio = date("Y-m-d");
        $fechaFin = date("Y-m-d");
        //*/
        $this->formValidation();
        
        if($this->form_validation->run())     
        {   
            switch (strtolower($this->input->post('accion'))) {
              case "si":
              if ($idusuario==$idusuarioNew) {

                $data['personatramite'] = $this->PersonaTramite_model->getPersonaTramite($idtramite);
                $data['tramite'] = $this->Tramite_model->getTramite($idtramite);
                $data['tipotramite'] = $this->TipoTramite_model->getTipoTramite($data['tramite']['idtipotramite']);
                $data['persona'] = $this->Persona_model->getPersonaId($data['personatramite']['idpersona']);
                $data['observaciones'] = $this->ProcesoTramite_model->getObservacionesId($data['tramite']['idtramite']);

                $data['funcionario'] = $this->Funcionario_model->getAllFuncionarioFullName($idusuario);
                    //print_r($data);
                $data['mensaje'] = "No puede este Tramite al mismo funcionario."; 
                    //*/
                    ///*
                $this->load->view('layout/header');
                $this->load->view('asignados/view',$data);
                $this->load->view('layout/footer');
                    //*/
                
            }else {

                $data['funcionario'] = $this->Funcionario_model->getAllFuncionarioIdCargo($idusuarioNew);


                if ($data['funcionario']['idcargo']==3) {
                    $fase = "1";
                }
                if ($data['funcionario']['idcargo']==2) {
                    $fase = "2";
                }
                if ($data['funcionario']['idcargo']==1) {
                    $fase = "3";
                }
                if ($data['funcionario']['idcargo']==4) {
                    $fase = "4";
                }

                $params = $this->datosUpdateTramitePersona($idtramite, $idusuario, $idpersona, $fechaFin);
                $persona_tramite_id = $this->ProcesoTramite_model->updatePersonaTramite($idpersonatramite, $params);
                $paramsSave = $this->datosSaveTramitePersona($idtramite, $idusuarioNew, $idpersona, $fechaInicio, $idusuarioNew,$fase);

                $persona_tramite_id = $this->PersonaTramite_model->addPersonaTramite($paramsSave, $idtramite, $idusuario, $idusuarioNew);

                $paramsTramiteObservacion = array(
                    'idtramite' => $idtramite,
                    'observaciones' => $observaciones,
                );

                    //print_r($params);
                $this->db->insert('observacion',$paramsTramiteObservacion);
                    //*/
            }
            break;
            case "no":
            $idusuarioNew = $idusuario;
              ///*
            $params = $this->datosUpdateTramitePersona($idtramite, $idusuario, $idpersona, $fechaFin);
            $persona_tramite_id = $this->ProcesoTramite_model->updatePersonaTramite($idpersonatramite, $params);       
            $paramsSave = $this->datosSaveTramitePersona($idtramite, $idusuario, $idpersona, $fechaInicio, $idusuarioNew);
            $persona_tramite_id = $this->PersonaTramite_model->addPersonaTramite($paramsSave, $idtramite, $idusuario, $idusuarioNew);
            $paramsTramiteObservacion = array(
                'idtramite' => $idtramite,
                'observaciones' => $observaciones,
            );
            $this->db->insert('observacion',$paramsTramiteObservacion);
                //*/
            break;
            case "terminado":

            $params = $this->datosUpdateTramitePersona($idtramite, $idusuario, $idpersona, $fechaFin);
            $persona_tramite_id = $this->ProcesoTramite_model->updatePersonaTramite($idpersonatramite, $params);

            $paramsTramiteUnidad = array(
                'idtramite' => $idtramite,
                'de' => $idusuario,
                'a' => $idusuarioNew,
            );
            //$this->db->insert('tramiteunidad',$paramsTramiteUnidad);

            $paramsTramiteObservacion = array(
                'idtramite' => $idtramite,
                'observaciones' => $observaciones,
            );
            $this->db->insert('observacion',$paramsTramiteObservacion);

            $paramsTerminado = array(
                'idtramite' => $idtramite,
                'estado' => 0,
            );
            $persona_tramite_id = $this->ProcesoTramite_model->updatePTTerminado($idtramite, $paramsTerminado);

            break;
                //*/
        }

        redirect(base_url().'main');           

    }else {   

        $data['personatramite'] = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        $data['tramite'] = $this->Tramite_model->getTramite($idtramite);
        $data['tipotramite'] = $this->TipoTramite_model->getTipoTramite($data['tramite']['idtipotramite']);
        $data['persona'] = $this->Persona_model->getPersonaId($data['personatramite']['idpersona']);
        $data['observaciones'] = $this->ProcesoTramite_model->getObservacionesId($data['tramite']['idtramite']);
        $data['funcionario'] = $this->Funcionario_model->getAllFuncionarioFullName($idusuario);

        $this->load->view('layout/header');
        $this->load->view('asignados/view',$data);
        $this->load->view('layout/footer');
    }
        //*/
}

    /**
     * EditarDB envia los datos a para modificar.
     */
    function editarDB()
    {   

    }

    /**
     * CambiarEstado envia los datos a Asignados_model para cambiar el campo condición.
     */
    function cambiarEstado($idfuncionario,$activo)
    {
        $params = array(
            'estado' => $activo,
        );

        $this->Asignados_model->cambiarEstado($idfuncionario,$params);

        redirect(base_url().'funcionario');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosUpdateTramitePersona($idtramite, $idfuncionario, $idpersona, $fechaFin)
    {   

        $params = array(
            /*'idpersona' => $idpersona,
            'idtramite' => $idtramite,
            'idfuncionario' => $idfuncionario,*/
            'pdf' => $this->subirPDF(),
            'fechaFin' => $fechaFin,
            'activo' => 0,
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosSaveTramitePersona($idtramite, $idfuncionario, $idpersona, $fechaInicio = null, $idusuarioNew = null,$fase)
    {        
        $params = array(
            'idpersona' => $idpersona,
            'idtramite' => $idtramite,
            'idfuncionario' => $idusuarioNew,
            'fechaInicio' => $fechaInicio,
            'pdf' => $this->subirPDF(),
            'fase' => $fase,
            'fechaFin' => null,
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('observaciones','Observaciones','required');
   }

    /**
     * ReportePersona genera el reporte de funcionarios en formato pdf.
     */
    public function imprimir($idtramite)
    {
        $idusuario = $this->session->userdata('idusuario');
        $dataPersona = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        $dataTramite = $this->Tramite_model->getTramite($idtramite);
        $tipoTramite = $this->TipoTramite_model->getTipoTramite($dataTramite['idtipotramite']);
        $dataObservaciones = $this->ProcesoTramite_model->getObservacionesId($idtramite);
        //$data = $this->ProcesoTramite_model->getIdPersonaByIdTramite($idtramite);
        $codigo = $this->Tramite_model->getCodigoTramite($idtramite);
        $codigoTramite = $codigo['codigo'];
        $nombreTramite = $tipoTramite['nombre'];
        $idpersona = $dataPersona['idpersona'];
        $data = $this->Persona_model->getPersonaId($idpersona);
        $nombreCompleto = $data['nombreCompleto'];
        $latitud = $dataTramite['latitud'];
        $longitud = $dataTramite['longitud'];
        
        $data= $this->Funcionario_model->getFuncionarioFullNameReporte($idusuario);
        //print_r($data);
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetLeftMargin(15);
        $pdf->SetRightMargin(15);
        $pdf->SetFillColor(300,300,300);
        $pdf->SetXY(31, 11);
        $logoConsejo = base_url()."fotos/logo.jpg";
        //$pdf->Image($logoConsejo, 175, 5, 25, 23);
        $logo = base_url()."fotos/consejo.jpg";
        //$pdf->Image($logo, 15, 5, 25, 23);
        //$pdf->Ln(25);
        $pdf->SetFont('Arial','',12);
        $pdf->SetWidths(array(10,60,30,60,25));
        $mapa = 'https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/'.$longitud.','.$latitud.',14.25,0,60/600x600?access_token=pk.eyJ1IjoiZmhlZXIyMiIsImEiOiJjbDI0dnNjcDUwM2hlM2pwZzVhcGI2dXRuIn0.hPwwCroDIYML95QVTJJ-tg';
        $indice=1;
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(180,3,utf8_decode('FICHA TÉCNICA'),0,0,'C');    
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(71,3,utf8_decode('Solicitante: ').utf8_decode($nombreCompleto),0,0,'L');    
        $pdf->Ln(15);
        $pdf->Cell(62,3,utf8_decode('Número de tramite: ').($codigoTramite),0,0,'L');  
        $pdf->Ln(15);
        $pdf->Cell(97,3,utf8_decode('Tramite: ').utf8_decode($nombreTramite),0,0,'L');
        $pdf->Ln(15);
        //
        $pdf->SetFont('Arial','B',12);
        $pdf->SetWidths(array(180));
        $pdf->Cell(97,3,utf8_decode('Resumen: '),0,0,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',12);
        foreach ($dataObservaciones as $row) {
            $pdf->Row(array(utf8_decode($row['observaciones'])));
        }
        
        $pdf->Output("tramite.pdf","I");
        
    }

    public function reporte2($idtramite){
        $idusuario = $this->session->userdata('idusuario');
        $dataPersona = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        $dataTramite = $this->Tramite_model->getTramite($idtramite);
        $tipoTramite = $this->TipoTramite_model->getTipoTramiteId($dataTramite['idtipotramite']);
        $dataObservaciones = $this->ProcesoTramite_model->getObservacionesId($idtramite);
        //$data = $this->ProcesoTramite_model->getIdPersonaByIdTramite($idtramite);
        $codigo = $this->Tramite_model->getCodigoTramite($idtramite);
        $codigoTramite = $codigo['codigo'];
        $nombreTramite = $tipoTramite['nombreRequisito'];
        $idpersona = $dataPersona['idpersona'];
        $data = $this->Persona_model->getPersonaId($idpersona);
        $nombreCompleto = $data['nombreCompleto'];
        $latitud = $dataTramite['latitud'];
        $longitud = $dataTramite['longitud'];
        
        $data= $this->Funcionario_model->getFuncionarioFullNameReporte($idusuario);

        $mapa = 'https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/'.$longitud.','.$latitud.',14.25,0,60/600x600?access_token=pk.eyJ1IjoiZmhlZXIyMiIsImEiOiJjbDI0dnNjcDUwM2hlM2pwZzVhcGI2dXRuIn0.hPwwCroDIYML95QVTJJ-tg';
        

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        //$pdf->SetCreator(PDF_CREATOR);
        //$pathImg = APPPATH."fotos/consejo.jpg";
        //$pathImg = realpath('../page-template/img.png'); 
        //$imagen .='<img src="'.$pathImg.'" width="50" height="50">'; 
        //$pdf->writeHTML($imagen,true, 0, true, 0);  

// set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,80));

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
        $pdf->SetFont('courier', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

// set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
        
        $html = <<<EOD
        <h1 style="text-align:center">FICHA TÉCNICA</h1>
        EOD;
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->Ln(10);
        $pdf->Cell(0, 0, 'Solicitante: '.utf8_decode($nombreCompleto) , 0, 0, 'L', 0, '', 0);
        $pdf->Ln(10);
        $pdf->Cell(0, 0, 'Número de tramite: '.($codigoTramite) , 0, 0, 'L', 0, '', 0);
        $pdf->Ln(10);
        $pdf->Cell(0, 0, 'Trámite: '.$nombreTramite , 0, 0, 'L', 0, '', 0);
        $pdf->Ln(10);
        
        $pdf->Cell(0, 0, 'Localización: ', 0, 0, 'L', 0, '', 0);
        $pdf->Ln(10);
        $html1 = '<img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/'.$longitud.','.$latitud.',14.25,0,60/600x600?access_token=pk.eyJ1IjoiZmhlZXIyMiIsImEiOiJjbDI0dnNjcDUwM2hlM2pwZzVhcGI2dXRuIn0.hPwwCroDIYML95QVTJJ-tg" width="300" height="200">';
// Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html1, 0, 1, 0, true, 'C', true);
        $pdf->Ln(5);
        $pdf->Cell(0, 0, 'Resumen: ', 0, 0, 'L', 0, '', 0);
        $pdf->Ln(10);
        $content = '<table style="width:100%" border="1">';
        foreach ($dataObservaciones as $row) {
        $content .= '
                <tr>
                    <td >'.$row['observaciones'].'</td>
                </tr>
                '; 
        }
        $content .= '</table>';
        $pdf->writeHTML($content); 
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
        $pdf->Output('tramite.pdf', 'I');
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

    public function subirPDF(){

        if($_FILES['userfile']['tmp_name'] != ""){
            $config['upload_path'] = './fotos/documentos/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '15120';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("userfile")) {
                $data['uploadError'] = $this->upload->display_errors();
                //echo $this->upload->display_errors();
                return $this->upload->display_errors();
            } else {
                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }
        }else{
            return $this->input->post('pdf');
        }
    }
}

