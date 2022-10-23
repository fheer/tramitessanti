<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller{

    /**
     * Constructor usuario.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Usuario_model');
        $this->load->model('Funcionario_model');
        $this->load->model('Solicitante_model');
        $this->load->model('Actividad_model');
        $this->load->model('Cargo_model');        
        $this->load->model('Expedido_model');
        
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para usuario.
     */
    function index()
    {

        $data['usuario'] = $this->Usuario_model->getAllUsuario();
 
        $this->load->view('layout/header');
        $this->load->view('usuario/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para usuario.
     */
    function insert()
    {
        //
        $data['persona'] = $this->Persona_model->getAllPersonaFullName();
         
        $this->load->view('layout/header');
        $this->load->view('usuario/add',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Editar inicia la vista header edit y footer para usuario.
     */
    function editar($slug)
    {
        $data['usuario'] = $this->Usuario_model->getUsuario($slug);
        $idpersona = $data['usuario']['idpersona'];
    	$data['persona'] = $this->Persona_model->getPersonaId($idpersona);
        //print_r($data);

    	$this->load->view('layout/header');
        $this->load->view('usuario/edit',$data);
        $this->load->view('layout/footer');
    }

    function update($slug)
    {
        $data['usuario'] = $this->Usuario_model->getUsuario($slug);
        $idpersona = $data['usuario']['idpersona'];
        $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
        //print_r($data);

        $this->load->view('layout/header');
        $this->load->view('usuario/update',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Editar inicia la vista header edit y footer para persona.
     */
    function editarBoth($idpersona)
    {
        $opcion = 3;
        $data['opcion'] = $opcion;
        $data['solicitante'] = $this->Persona_model->getPersonaId($idpersona);
        $idexpedido = $data['solicitante']['idexpedido'];
        $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
        $data['expedido'] = $this->Expedido_model->getAllExpedido();
        $data['actividad'] = $this->Solicitante_model->getSolicitanteIdPersona($idpersona);

        if ($data['actividad']['idactividad'] <> 3) {
            $idactividad = $data['actividad']['idactividad'];        
            $data['act'] = $this->Actividad_model->getActividad($idactividad);
            $data['actividad'] = $this->Actividad_model->getAllActividad();
        }else{
            $data['cargo'] = $this->Funcionario_model->getFuncionarioIdPersona($idpersona);
            $idcargo = $data['cargo']['idcargo'];
            $data['position'] = $this->Cargo_model->getCargo($idcargo);
            $data['cargo'] = $this->Cargo_model->getAllCargo();
        }
            
        ///* 
        $this->load->view('layout/header');
        $this->load->view('usuario/updateDatos',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Persona_model para guardar datos.
     */
    function guardarDB()
    {   
        $nombre = $this->input->post('nombre');
        $ci = $this->input->post('ci');
        $opcion = 'Sol';
        $this->formValidation();
        
		if($this->form_validation->run())     
        {   
            
                if ($this->Persona_model->validarCi($ci)==0) {
                    $params = $this->datos();    
                    $usuario_id = $this->Persona_model->addPersona($params);
                    //$data['usuario'] = $this->Persona_model->getAllPersona();
                    if ($opcion=='Sol') {
                        redirect(base_url().'solicitante');           
                    }else{
                        redirect(base_url().'ventas/insert');
                    }
                    
                }else{
                    $data['mensaje'] = 'El CI de usuario se encuentra registrado';
                    $data['opcion'] = 'Sol';
                    $data['actividad'] = $this->Actividad_model->getAllActividad();
                    $data['expedido'] = $this->Expedido_model->getAllExpedido();
                    $this->load->view('layout/header');
                    $this->load->view('usuario/add',$data);
                    $this->load->view('layout/footer');
                }
            
        }
        else
        {   
            $data['opcion'] = 'Sol';
            $data['actividad'] = $this->Actividad_model->getAllActividad();
            $data['expedido'] = $this->Expedido_model->getAllExpedido();
            $this->load->view('layout/header');
            $this->load->view('usuario/add',$data);
            $this->load->view('layout/footer');
        }
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function editarDB()
    {   
    		$idusuario = $this->input->post('idusuario');
            
        	$this->formValidation();
			if($this->form_validation->run())     
            {   
                $params = $this->datos();
                $this->Usuario_model->updateUsuario($idusuario,$params);            
                
                redirect(base_url().'utente');
            }
            else
            {
                echo $this->input->post('slug');
                $data['usuario'] = $this->Usuario_model->getUsuario($this->input->post('slug'));

                $idpersona = $data['usuario']['idpersona'];
                $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
                //print_r($data);
                
                ///*
                $this->load->view('layout/header');
                $this->load->view('usuario/edit', $data);
                $this->load->view('layout/footer');    
                //*/
            }
        
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function updateDB()
    {   
            $idusuario = $this->input->post('idusuario');
            
            $this->formValidationUpdate();
            if($this->form_validation->run())     
            {   
                $params = $this->datosUpdate();
                $idusuario = $this->Usuario_model->updateUsuario($idusuario,$params);
                $data['usuario'] = $this->Usuario_model->getUsuarioById($idusuario);
                $data['mensaje'] = 'Salga de la aplicación e ingrese con su nueva contraseña'; 

                $data['modificado'] = 1;

                $this->load->view('layout/header');
                $this->load->view('usuario/perfil', $data);
                $this->load->view('layout/footer'); 
            }
            else
            {
                //echo $this->input->post('slug');
                $data['usuario'] = $this->Usuario_model->getUsuario($this->input->post('slug'));

                $idpersona = $data['usuario']['idpersona'];
                $data['persona'] = $this->Persona_model->getPersonaId($idpersona);
                //print_r($data);
                
                ///*
                $this->load->view('layout/header');
                $this->load->view('usuario/update', $data);
                $this->load->view('layout/footer');    
                //*/
            }
        
    }

    /**
     * CambiarEstado envia los datos a Persona_model para cambiar el campo condición.
     */
    function cambiarEstado($idusuario,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            $this->Persona_model->cambiarEstado($idusuario,$params);

            redirect(base_url().'solicitante');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datos()
    {
        $permisos = '';
        if(!empty($_POST['permisos'])){
            foreach($_POST['permisos'] as $selected){
                $permisos  .= md5($selected).'#';
            }
        }

        $params = array(
            'permisos' => $permisos,
            'foto' => $this->subirImagen(),
            'key' => $this->generateSlug($this->input->post('usuario')),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('nombres','Nombre','required');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datosUpdate()
    {
        $clave = $this->generarPassword($this->input->post('clave'));
        $usuario = $this->input->post('usuario');
        $params = array(
            'clave' => $clave,
            'foto' => $this->subirImagen(),
            'key' => $this->generateSlug($this->input->post('usuario')),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidationUpdate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('clave','Contraseña','required|min_length[7]|max_length[20]');
    }

    /**
     * Index inicia la vista header index y footer para perfil.
     */
    function perfil($slug)
    {
        $data['usuario'] = $this->Usuario_model->getUsuario($slug);    
        $data['persona'] = $this->Persona_model->getPersonaId($data['usuario']['idpersona']);
        echo $data['persona']['tipoPersona'];
        if ($data['persona']['tipoPersona'] == 1) {
            $data['actividad'] = $this->Actividad_model->sacaActividad($data['persona']['idpersona']);

        } else {
            $data['actividad'] = $this->Cargo_model->sacaCargo($data['persona']['idpersona']);
            //echo $data['actividad'];
        }
        ///*
        $this->load->view('layout/header');
        $this->load->view('usuario/perfil',$data);
        $this->load->view('layout/footer');
        //*/
    }

    public function ingresar(){
        $user = $this->input->post('user');
        $psw = $this->input->post('psw');
        $res = $this->Usuario_model->ingresar($user,$psw);
        if ($res == 1){
            redirect('welcome/inicio');
        }else{
            $data['mensaje'] = "Usuario y/o contraseña incorrectos";
            $this->load->view('login',$data);
        }
    }

    public function cerrarSesion() {
     $s_user = array(
         'logueado' => 0,
      );
      $this->session->set_userdata($s_user);
      //$this->session->unset_userdata('idusuario');
      $this->load->view('login');
    }

    /**
     * ReportePersona genera el reporte de usuarios en formato pdf.
     */
    public function reporteUsuario()
    {
        $data = $this->Usuario_model->getAllUsuario();
             
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
        $pdf->Cell(100,10,utf8_decode('LISTA DE USUARIOS'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,85,85));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("NOMBRE COMPLETO"),utf8_decode("NOMBRE USUARIO")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            $datospersona= $this->Persona_model->getPersonaId($row['idpersona']);
            //*/
            $pdf->Row(array($indice,utf8_decode($datospersona['nombreCompleto']),utf8_decode($row['usuario'])));
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

    public function subirImagen(){

        if($_FILES['userfile']['tmp_name'] == ""){
            return $this->input->post('foto');
        } else {
            $config['upload_path'] = './fotos/usuarios/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '5120';
            $config['max_width'] = '4048';
            $config['max_height'] = '4016';

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload("userfile")) {
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
