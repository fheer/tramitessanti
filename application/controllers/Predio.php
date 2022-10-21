<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Options;

class Predio extends CI_Controller{

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
        $this->load->model('Predio_model');
        $this->load->model('ProcesoTramite_model');
        $this->load->model('CaracteristicaConstruccion_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
        
        //require_once  APPPATH.'third_party/tcpdf/tcpdf.php';
        //require_once  APPPATH.'third_party/tcpdf/fonts/courier.php';
    }

    /**
     * Index inicia la vista header index y footer para predio.
     */
    function index()
    {
        $data['predio'] = $this->Predio_model->getAllPredio();
        $this->load->view('layout/header');
        $this->load->view('predio/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Index inicia la vista header index y footer para predio.
     */
    function tramitesasignados()
    {
        $idusuario = $this->session->userdata('idusuario');
        $data['personatramite'] = $this->PersonaTramite_model->getTramiteIdFuncionario($idusuario);

        //print_r($data);
        //$data['tramites'] = $this->Predio_model->getAllPredio();
        ///*
        $this->load->view('layout/header');
        $this->load->view('predio/listatramites',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para predio.
     */
    function insert($codigocatastral,$idpersona,$codigotramite)
    {

        ///*
        $data['codigocatastral'] = $codigocatastral;
        $data['idpersona'] = $idpersona;
        $data['codigotramite'] = $codigotramite;
        $data['solicitante'] = $this->Persona_model->getPersonaId($idpersona);
        //echo $data['codigotramite'];
        ///*
        $this->load->view('layout/header');
        $this->load->view('predio/add',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para predio.
     */
    function insertCaracteristica($codigocatastral,$idpersona,$codigotramite)
    {
        ///*
        $data['codigocatastral'] = $codigocatastral;
        $data['idpersona'] = $idpersona;
        $data['codigotramite'] = $codigotramite;
        $data['solicitante'] = $this->Persona_model->getPersonaId($idpersona);

        ///*
        $this->load->view('layout/header');
        $this->load->view('predio/addcaracteristica',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para predio.
     */
    function editar($idpredio)
    {

        //$data['opcion'] = $opcion;
        $data['predio'] = $this->Predio_model->getPredio($idpredio);
        print_r($data['predio'] );
        $data['tramite'] = $this->Tramite_model->getTramite($data['predio']['idtramite']);
        $data['funcionario'] = $this->Funcionario_model->getFuncionarioId($data['tramite']['idtramite']);
        $idexpedido = $data['funcionario']['idexpedido'];
        $idpersona = $data['funcionario']['idpersona'];
        $data['cargo'] = $this->Funcionario_model->getFuncionarioId($idpersona);
        $idcargo = $data['cargo']['idcargo'];
        $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
        $data['act'] = $this->Cargo_model->getCargo($idcargo);
        $data['cargo'] = $this->Cargo_model->getAllCargo();
        $data['expedido'] = $this->Expedido_model->getAllExpedido();

        /*
        $this->load->view('layout/header');
        $this->load->view('predio/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Predio_model para guardar datos.
     */
    function guardarDB()
    {

        //*/
        $this->formValidation();

        if($this->form_validation->run())
        {

            $paramsPredio = $this->datosPredio();
            $idpredio = $this->Predio_model->addPredio($paramsPredio);
            redirect(base_url().'predio');

        }else {

            $codigocatastral = $this->input->post('codigocatastral');
            $idpersona = $this->input->post('idpersona');
            $codigotramite = $this->input->post('codigotramite');

            $data['codigocatastral'] = $codigocatastral;
            $data['idpersona'] = $idpersona;
            $data['codigotramite'] = $codigotramite;
            $data['solicitante'] = $this->Persona_model->getPersonaId($idpersona);

            ///*
            $this->load->view('layout/header');
            $this->load->view('predio/add',$data);
            $this->load->view('layout/footer');
            //*/
        }
        
    }

    /**
     * guardarCaracteristica envia los datos a Predio_model para guardar datos.
     */
    function guardarCaracteristica()
    {
        //*/
        $this->formValidationCaracteristica();

        if($this->form_validation->run())
        {

            $paramsCaracterisca = $this->datosCaracteristica();
            $idpredio = $this->CaracteristicaConstruccion_model->addCaracteristicaConstruccion($paramsCaracterisca);
            redirect(base_url().'predio/tramites-asignados');

        }else {
            $codigocatastral = $this->input->post('codigocatastral');
            $idpersona = $this->input->post('idpersona');
            $codigotramite = $this->input->post('codigotramite');

            $data['idpersona'] = $idpersona;
            $data['codigotramite'] = $codigotramite;
            $data['codigocatastral'] = $codigocatastral;
            $data['solicitante'] = $this->Persona_model->getPersonaId($idpersona);
       
            ///*
            $this->load->view('layout/header');
            $this->load->view('predio/addcaracteristica',$data);
            $this->load->view('layout/footer');
            //*/
        }
        
    }

    /**
     * EditarDB envia los datos a para modificar.
     */
    function editarDB()
    {
        $idpredio = $this->input->post('idpredio');
        $opcion = $this->input->post('opcion');
        $this->formValidation();

        if($this->form_validation->run())
        {

            $paramsPredio = $this->datosPredio();
            $idpredio = $this->Predio_model->updatePredio($idpredio, $paramsPredio);
            redirect(base_url().'predio');

        }else {

            $data['opcion'] = $opcion;
            $data['predio'] = $this->Predio_model->getPersona($slug);
            $idexpedido = $data['predio']['idexpedido'];
            $idpredio = $data['predio']['idpersona'];
            $data['cargo'] = $this->Funcionario_model->getFuncionarioId($idpredio);
            $idcargo = $data['cargo']['idcargo'];
            $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
            $data['act'] = $this->Cargo_model->getCargo($idcargo);
            $data['cargo'] = $this->Cargo_model->getAllCargo();
            $data['expedido'] = $this->Expedido_model->getAllExpedido();

            ///*
            $this->load->view('layout/header');
            $this->load->view('predio/edit',$data);
            $this->load->view('layout/footer');
            //*/
        }
    }

    /**
     * CambiarEstado envia los datos a Predio_model para cambiar el campo condición.
     */
    function cambiarEstado($idpredio,$activo)
    {
        $params = array(
            'estado' => $activo,
        );

        $this->Predio_model->cambiarEstado($idpredio,$params);

        redirect(base_url().'predio');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosUpdateTramitePersona($idtramite, $idpredio, $idpersona, $fechaFin)
    {

        $params = array(
            /*'idpersona' => $idpersona,
            'idtramite' => $idtramite,
            'idpredio' => $idpredio,*/
            'pdf' => $this->subirPDF(),
            'fechaFin' => $fechaFin,
            'activo' => 0,
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosCaracteristica()
    {
        $params = array(
            'modificado' => $this->input->post('modificado'),
            'construccion' => $this->input->post('construccion'),
            'bloque' => $this->input->post('bloque'),
            'superficieconstruida' => $this->input->post('superficieconstruida'),
            'pisos' => $this->input->post('pisos'),
            'tipologia' => $this->input->post('tipologia'),
            'puntaje' => $this->input->post('puntaje'),
            'codigocatastral' => $this->input->post('codigocatastral'),
            'codigotramite' => $this->input->post('codigotramite'),
            'idtramite' => $this->input->post('idtramite'),
            
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosPredio()
    {
        $params = array(
            'solicitante' => $this->input->post('solicitante'),
            'codigocatastral' => $this->input->post('codigocatastral'),
            'matricula' => $this->input->post('matricula'),
            'asiento' => $this->input->post('asiento'),
            'fechaddrr' => $this->input->post('fechaddrr'),
            'fechaimpresion' => $this->input->post('fechaimpresion'),
            'codigoform' => $this->input->post('codigoform'),
            'calle' => $this->input->post('calle'),
            'edificio' => $this->input->post('edificio'),
            'frente' => $this->input->post('frente'),
            'fondo' => $this->input->post('fondo'),
            'superficie' => $this->input->post('superficie'),
            'ubicacion' => $this->input->post('ubicacion'),
            'zona' => $this->input->post('zona'),
            'materialvia' => $this->input->post('materialvia'),
            'inclinacion' => $this->input->post('inclinacion'),
            'forma' => $this->input->post('forma'),
            'alcantarillado' => $this->input->post('alcantarillado'),
            'electrica' => $this->input->post('electrica'),
            'telefono' => $this->input->post('telefono'),
            'aguapotable' => $this->input->post('aguapotable'),
            'codigotramite' => $this->input->post('codigotramite'),
            'idtramite' => $this->input->post('idtramite'),
            'croquis' => $this->subirCroquis(),
            'croquisubicacion' => $this->subirCroquisUbicacion(),
            'fachadauno' => $this->subirFachadaUno(),
            'fachadados' => $this->subirFachadaDos(),
            'interior' => $this->subirInterior(),
            'observaciones' => $this->input->post('observaciones'),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('codigocatastral','Codigo Catastral','required');
   }

   /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidationCaracteristica()
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('modificado','Año de modificación','required|integer');
       $this->form_validation->set_rules('construccion','Año de construcción','required|integer');
       $this->form_validation->set_rules('bloque','Bloque','required|alpha');
       $this->form_validation->set_rules('superficieconstruida','Superficie','required|numeric');
       $this->form_validation->set_rules('pisos','Pisos','required|integer');
       $this->form_validation->set_rules('tipologia','Tipologia','required|alpha');
       $this->form_validation->set_rules('puntaje','Puntaje','required|numeric');
   }

    /**
     * ReportePersona genera el reporte de predios en formato pdf.
     */
    public function imprimir($codigocatastral, $idpersona)
    {
        $data['infoPredio'] = $this->Predio_model->getPredioByCodigoCatastral($codigocatastral);
        $data['caracteristica'] = $this->CaracteristicaConstruccion_model->getCaracteristicaConstruccionByCatasral($codigocatastral);
        $data['persona'] = $this->Persona_model->getPersonaId($idpersona);

        $this->load->view('predio/imprimir',$data);
        
        $html = $this->output->get_output();
        //print_r($html);
        /*
        echo '<br>';
        print_r($data);
        //*/
        /*
        $this->load->library('pdf');
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));
        //*/
        
        ///*
        // Get output html
        //$html = $this->output->get_output();
        
        // Load pdf library
        $this->load->library('pdf');
        
        $options = new Options(); 
        $options->set('isRemoteEnabled', true);
        //$options->setIsRemoteEnabled(true); 
        $pdf = new pdf($options);
        // Load HTML content
        $this->pdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $this->pdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
        //*/
    }

    public function reporte2($idtramite){
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

    public function subirCroquis(){

        if($_FILES['croquis']['tmp_name'] == ""){
            return $this->input->post('croquis');
        } else {
            $config['upload_path'] = './fotos/datostecnicos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("croquis")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }

        }
    }

    public function subirFachadaUno(){

        if($_FILES['fachadauno']['tmp_name'] == ""){
            //return $this->input->post('croquis');
        } else {
            $config['upload_path'] = './fotos/datostecnicos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("fachadauno")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }

        }
    }

    public function subirFachadaDos(){

        if($_FILES['fachadados']['tmp_name'] == ""){
            //return $this->input->post('croquis');
        } else {
            $config['upload_path'] = './fotos/datostecnicos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("fachadados")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }

        }
    }

    public function subirCroquisUbicacion(){

        if($_FILES['croquisubicacion']['tmp_name'] == ""){
            //return $this->input->post('croquis');
        } else {
            $config['upload_path'] = './fotos/datostecnicos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("croquisubicacion")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }

        }
    }

    public function subirInterior(){

        if($_FILES['interior']['tmp_name'] == ""){
            //return $this->input->post('croquis');
        } else {
            $config['upload_path'] = './fotos/datostecnicos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("interior")) {
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            } else {

                $file_info = $this->upload->data();
                $imagen = $file_info['file_name'];
                $data['imagen'] = $imagen;

                return $imagen;
            }

        }
    }


}


