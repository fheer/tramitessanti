<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcesoTramite extends CI_Controller{

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
        $this->load->model('Usuario_model');
        $this->load->model('Tramite_model');
        $this->load->model('Funcionario_model');
        $this->load->model('TramiteUnidad_model');
        $this->load->model('Requisito_model');
        
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para procesoTramite.
     */
    function index($opcion)
    {
        //echo $opcion;
        ///*
        $data['tramite'] = $this->ProcesoTramite_model->getAllProcesoTramite($opcion);
        
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/index',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Index inicia la vista header index y footer para procesoTramite.
     */
    function listar($estado)
    {
        $data['tramite'] = $this->ProcesoTramite_model->getAllProcesoTramiteByEstado($estado);
        
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Index inicia la vista header index y footer para procesoTramite.
     */
    function docs($idtramite)
    {
        $data['docs'] = $this->ProcesoTramite_model->getDocsTramite($idtramite);
        
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/docs',$data);
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
     * Abrir documento pdf
     */
    function abrirNamualPdf($pdf)
    {
        $data['nombre'] = $pdf;

        $this->load->view('layout/header');
        $this->load->view('procesoTramite/manual',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function insert()
    {
        $data['persona'] = $this->Persona_model->getTodasPersonasFullName();
        $data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
        $data['funcionario'] = $this->Funcionario_model->getAllFuncionario();

        //*
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/add',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function nuevo($idtipotramite,$idpersona)
    {
        $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
        $data['tipotramite'] = $this->TipoTramite_model->getTipoTramiteId($idtipotramite);
        $data['funcionario'] = $this->Funcionario_model->getAllFuncionario();

        //*
        $this->load->view('layout/header');
        $this->load->view('procesoTramite/add',$data);
        $this->load->view('layout/footer');
        //*/
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
    function getTramiteDias($idtipotramite)
    {
        $data = json_encode($this->TipoTramite_model->getTipoTramite($idtipotramite));
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
        //print_r($idtramite);
        $data['personatramite'] = $this->PersonaTramite_model->getPersonaTramite($idtramite);
        
        $idpersona = $data['personatramite']['idpersona'];
        $idfuncionario = $data['personatramite']['idfuncionario'];
        
        $data['idfuncionario'] = $this->Usuario_model->getUsuarioById($idfuncionario);
        $idPersonaIdFuncionario = $data['idfuncionario']['idpersona'];
        //
        $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
        $data['unfuncionario'] = $this->Persona_model->getPersonaId($idPersonaIdFuncionario);
        $data['solicitante'] = $this->Persona_model->getTodasPersonasFullName();
        //$data['funcionario'] = $this->Persona_model->getAllPersona(2);
        $data['funcionario'] = $this->Funcionario_model->getAllFuncionario();
        $data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
        
        $idtipotramite = $data['procesoTramite']['idtipotramite'];
        $data['nombretramite'] = $this->TipoTramite_model->getTipoTramite($idtipotramite);

        $data['requistosTramite']  = $this->TipoTramite_model->getTramiteRequisitos($idtipotramite);

        //print_r($data['fotos']);

        //* 
    	$this->load->view('layout/header');
        $this->load->view('procesoTramite/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function guardarDB()
    {   
        $idpersona = $this->input->post('idpersona');
        $idtipotramite = $this->input->post('idtipotramite');

        $idfuncionario = $this->session->userdata('idusuario');
        $idfuncionarioNew = $this->input->post('idfuncionario');
        //echo 'hola';
        $direccion = $this->input->post('direccion');
        $latitud = $this->input->post('latitud');
        $longitud = $this->input->post('longitud');
        $datosFuncionario = $this->Persona_model->getDatosfuncionarioUsuario($idfuncionario);
        //print_r($datosFuncionario);
        $idusuario = $datosFuncionario['idpersona'];

        ///*
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaInicio = date("Y-m-d", strtotime($fechaInicio));
        $fechaFin = $this->input->post('fechaFin');

        $date = str_replace('/', '-', $fechaFin);
        $fechaFin = date('Y-m-d', strtotime($date));
        //$documentos = $this->input->post('userfile');
        //echo $documentos;
        ///*
        if ($idtipotramite <> 0) {
            $this->formValidation();
        
            if($this->form_validation->run())     
            {   
                $tipoTramite['nombreTipo'] = $this->TipoTramite_model->getTipoTramiteCodigo($idtipotramite);
                $nombreTipoTramite = $tipoTramite['nombreTipo']['nombreRequisito'];
                $cantidadTramites = $this->ProcesoTramite_model->getAllProcesoTramiteCount($idtipotramite);
                $codigo = $this->generarCodigo($nombreTipoTramite, $cantidadTramites);
                $params = $this->datosTramite($idtipotramite,$codigo, $fechaInicio, $fechaFin,$direccion,$latitud,$longitud);
                //print_r($params);
                $procesoTratmiteId = $this->ProcesoTramite_model->addProcesoTramite($params, $idusuario, $idfuncionarioNew, $idpersona, $fechaInicio, $fechaFin);

                $this->datosArchivosTramite($procesoTratmiteId);

                redirect(base_url().'proceso/lista'); 
            }else{
                $data['persona'] = $this->Persona_model->getTodasPersonasFullName();
                $data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
                $data['funcionario'] = $this->Funcionario_model->getAllFuncionario();
         
                $this->load->view('layout/header');
                $this->load->view('procesoTramite/add',$data);
                $this->load->view('layout/footer');
            }
        
        }else{
            $data['mensaje'] = 'Selecione Tipo de tramite';
            $data['persona'] = $this->Persona_model->getTodasPersonasFullName();
            $data['tipotramite'] = $this->TipoTramite_model->getTodosLosTramites();
            $data['funcionario'] = $this->Funcionario_model->getAllFuncionario();
             
            $this->load->view('layout/header');
            $this->load->view('procesoTramite/add',$data);
            $this->load->view('layout/footer');
        }
        //*/
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function editarDB()
    {   
      $idpersona = $this->input->post('idpersona');
      $idtipotramite = $this->input->post('idtipotramite');
      $idfuncionario = $this->input->post('idfuncionario');
      $fechaInicio = $this->input->post('fechaInicio');
      $fechaInicio = date("Y-m-d", strtotime($fechaInicio));
      $fechaFin = $this->input->post('fechaFin');
      $idtramite = $this->input->post('idtramite');
      $direccion = $this->input->post('direccion');
      $mapa = $this->input->post('mapa');
      $latitud = $this->input->post('latitud');
      $longitud = $this->input->post('longitud');
      $documentos = $this->input->post('userfile');
      //echo $documentos;
      
      $this->formValidation();
      if($this->form_validation->run())     
      {
        $tipoTramite['nombreTipo'] = $this->TipoTramite_model->getTipoTramite($idtipotramite);
            $nombreTipoTramite = $tipoTramite['nombreTipo']['nombreRequisito'];
            $cantidadTramites = $this->ProcesoTramite_model->getAllProcesoTramiteCount($idtipotramite);
            $codigo = $this->input->post('codigo');
            $params = $this->datosTramiteUpdate($idtipotramite, $codigo, $fechaInicio, $fechaFin,$direccion,$latitud,$longitud);

            $this->ProcesoTramite_model->updateProcesoTramite($idtramite, $params, $idfuncionario, $idpersona, $fechaInicio, $fechaFin);
            if(!empty($_POST['archivos'])){
                $this->datosArchivosTramite($idtramite);
            }
            redirect(base_url().'proceso/lista');
      }else{
            echo 'else form validation';
      }
    //*/
    }

    /**
     * CambiarEstado envia los datos a Persona_model para cambiar el campo condición.
     */
    function cambiarEstado($idprocesoTramite,$activo)
    {
            $params = array(
                'estado' => $activo,
            );

            $this->ProcesoTramite_model->cambiarEstado($idprocesoTramite,$params);

            redirect(base_url().'procesoTramite');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosTramite($idtipotramite,$codigo, $fechaInicio, $fechaFin, $direccion=null, $latitud=null, $longitud=null)
    {
        $requisitos = '';
        if(!empty($_POST['requisitos'])){
            foreach($_POST['requisitos'] as $selected){
                $requisitos  .= $selected.'#';
            }
        }
        $params = array(
            'idtipotramite' => $idtipotramite,
            'codigo' => $codigo,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'requisitos' => $requisitos,
            //'documentos' => $this->subirImagen($codigo),
            'direccion' => $direccion,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'key' => $this->generateSlug($codigo),
            'idusuario' => $this->session->userdata('idusuario'),
            //'documentos' => $this->subirImagen($codigo),
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosTramiteUpdate($idtipotramite, $codigo, $fechaInicio, $fechaFin, $direccion=null,$latitud=null, $longitud=null)
    {
        $requisitos = '';
        if(!empty($_POST['requisitos'])){
            foreach($_POST['requisitos'] as $selected){
                $requisitos  .= $selected.'#';
            }
        }
        $params = array(
            'idtipotramite' => $idtipotramite,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'requisitos' => $requisitos,
            'direccion' => $direccion,
            'latitud' => $latitud,
            'longitud' => $longitud,
            //'documentos' => $this->subirImagen($codigo),
            'key' => $this->generateSlug($codigo),
            'idusuario' => $this->session->userdata('idusuario'),
        );
        return $params;
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosArchivosTramite($idtramite)
    {
        $requisitos = '';
        $i=0;
        $directorio = "./fotos/documentos/";
        if(!empty($_POST['requisitos'])){
            foreach($_POST['requisitos'] as $selected){

                $idrequisito['idrequisito'] = $this->Requisito_model->getRequisitoByNombreRequisito($selected);
                
                $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
                $name = $_FILES["archivos"]["name"][$i];
                //echo $name;
                $tipoArchivo = pathinfo($name, PATHINFO_EXTENSION);
                $adjunto = $idtramite.$idrequisito['idrequisito']['idrequisito']. "." . $tipoArchivo;
                
                $nuevaUbicacion = $directorio . $adjunto;
                # Mover
                $resultado = move_uploaded_file($ubicacionTemporal, $nuevaUbicacion);


                move_uploaded_file($ubicacionTemporal, $nuevaUbicacion);
                
                $params = array(
                'idrequisito' => $idrequisito['idrequisito']['idrequisito'],
                'idtramite' => $idtramite,
                'ruta' => $adjunto,
                );
                $id = $this->ProcesoTramite_model->addImages($params);
                //return $params;
                $i++;
            }
        }
        
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('idpersona','Persona','required');
        //$this->form_validation->set_rules('idtipotramite','Tramite','required');
        $this->form_validation->set_rules('idfuncionario','Funcionario','required');
        //$this->form_validation->set_rules('userfile','Pdf','required');
    }

    /**
     * ReportePersona genera el reporte de procesoTramites en formato pdf.
     */
    public function reporteTramite()
    {
        $data = $this->ProcesoTramite_model->getAllProcesoTramite();
             
        $pdf = new PDF_MC_Table();
        //$pdf=new FPDF();
        $pdf->AddPage('L','A4');
        $pdf->AliasNbPages();
        $pdf->SetLeftMargin(15);
        $pdf->SetRightMargin(15);
        $pdf->SetFillColor(300,300,300);
        $pdf->SetXY(31, 11);
        /*
        $logoConsejo = base_url()."fotos/logo.jpg";
        $pdf->Image($logoConsejo, 255, 5, 25, 23);
        $logo = base_url()."fotos/consejo.jpg";
        $pdf->Image($logo, 15, 5, 25, 23);
        */
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(30);
        $pdf->Cell(185,10,utf8_decode('LISTA TRAMITES'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(20,30,70,70,40,35));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("Nº TRAMITE"),utf8_decode("SOLICIANTE"),utf8_decode("TIPO DE TRAMITE"),utf8_decode("FECHA INICIO"),utf8_decode("FECHA FIN")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            ///*
            $personatramite = $this->Persona_model->getPersonaTramite($row['idtramite']);
            $idsolicitante = $personatramite['idpersonatramite'];
            $usuario = $personatramite['idfuncionario'];

            $solicitante = $this->Persona_model->getPersonaId($personatramite['idpersona']);
            //$usuario = $this->Persona_model->getPersonaByIdUsuario($personatramite['idfuncionario']);
            $tipotramite = $this->TipoTramite_model->getTipoTramite($row['idtipotramite']);
            
            $originalDate = $row['fechaInicio'];
            $fechaInicio = date("d-m-Y", strtotime($originalDate));

            $originalDate = $row['fechaFin'];
            $fechaFin = date("d-m-Y", strtotime($originalDate));
            //*/
            $pdf->Row(array($indice,utf8_decode($row['codigo']),utf8_decode($solicitante['nombreCompleto']),utf8_decode($tipotramite['nombre']),utf8_decode($fechaInicio),utf8_decode($fechaFin)));
            //$pdf->Ln(5);
            $indice++;
        }

        $pdf->Output("listarequisitos.pdf","I");
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

    public function subirImagen($codigo){

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

