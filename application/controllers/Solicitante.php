<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitante extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Solicitante_model');
        $this->load->model('Funcionario_model');
        $this->load->model('Actividad_model');
        $this->load->model('Expedido_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para persona.
     */
    function index()
    {
        $data['persona'] = $this->Persona_model->getAllPersona(1);    
        $this->load->view('layout/header');
        $this->load->view('persona/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para persona.
     */
    function insert($opcion)
    {
        $data['opcion'] = $opcion;
        $data['actividad'] = $this->Actividad_model->getAllActividad();

        ///* 
        $this->load->view('layout/header');
        $this->load->view('persona/add',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para persona.
     */
    function editar($key, $opcion)
    {
        $data['opcion'] = $opcion;
    	$data['solicitante'] = $this->Persona_model->getPersona($key);
        $idpersona = $data['solicitante']['idpersona'];
        $data['actividad'] = $this->Solicitante_model->getSolicitanteId($idpersona);
        $idactividad = $data['actividad']['idactividad'];
        $data['act'] = $this->Actividad_model->getActividad($idactividad);
        $data['actividad'] = $this->Actividad_model->getAllActividad();
        
        ///* 
    	$this->load->view('layout/header');
        $this->load->view('persona/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     *
     */
    public function validarCi($ci)
    {
        echo $this->Persona_model->validarCi($ci);
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
                    $persona_id = $this->Persona_model->addPersona($params);
                    
                    if ($opcion == 1) {
                        redirect(base_url().'solicitante');           
                    }else{
                        redirect(base_url().'proceso/nuevo');
                    }
                    
                }else{
                    $data['mensaje'] = 'El Número de CI se encuentra registrado';
                    $data['opcion'] = $opcion;
                    $data['actividad'] = $this->Actividad_model->getAllActividad();
                    $data['expedido'] = $this->Expedido_model->getAllExpedido();
                    $this->load->view('layout/header');
                    $this->load->view('persona/add',$data);
                    $this->load->view('layout/footer');
                }
            
        }
        else
        {   
            $data['opcion'] = $opcion;
            $data['actividad'] = $this->Actividad_model->getAllActividad();
            $data['expedido'] = $this->Expedido_model->getAllExpedido();
            $this->load->view('layout/header');
            $this->load->view('persona/add',$data);
            $this->load->view('layout/footer');
        }
        
    }

    /**
     *
     */
    public function buscarApellido($ci)
    {

        echo $this->Persona_model->validarCi($ci);
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function editarDB()
    {   
    		$idpersona = $this->input->post('idpersona');
            $opcion = $this->input->post('opcion');
            $tipoPersona = $this->input->post('tipoPersona');
            $actividadCargo = $this->input->post('idactividad');
        	$this->formValidation();
			if($this->form_validation->run())     
            {   
                $params = $this->datos();

                $this->Persona_model->updatePersona($idpersona,$params);    

                if ($opcion == 1) {
                    redirect(base_url().'solicitante');           
                }else{
                    redirect(base_url().'perfil/ver/'.$this->session->userdata('token'));
                }
            }
            else
            {
                $data['opcion'] = $opcion;
                $data['solicitante'] = $this->Persona_model->getPersona($key);
                $idexpedido = $data['solicitante']['idexpedido'];
                $idactividad = $data['solicitante']['idactividad'];
                $data['exp'] = $this->Expedido_model->getExpedido($idexpedido);
                $data['act'] = $this->Actividad_model->getActividad($idactividad);
                $data['actividad'] = $this->Actividad_model->getAllActividad();
                $data['expedido'] = $this->Expedido_model->getAllExpedido();     
            }
        
    }

    /**
     * CambiarEstado envia los datos a Persona_model para cambiar el campo condición.
     */
    function cambiarEstado($idpersona,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            $this->Persona_model->cambiarEstado($idpersona,$params);

            redirect(base_url().'solicitante');
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
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('ci','C.I.','required|min_length[4]|max_length[12]|callback_ci');
        $this->form_validation->set_rules('idactividad','Actividad','required');
		$this->form_validation->set_rules('apellidoPaterno','Apellido Paterno','min_length[2]|max_length[45]|callback_alpha_acento');
        if (!empty($this->input->post('apellidoMaterno'))) {
            $this->form_validation->set_rules('apellidoMaterno','Apellido Materno','callback_alpha_acento');
        }
        
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
     * ReportePersona genera el reporte de personas en formato pdf.
     */
    public function reportePersona()
    {
        $data = $this->Persona_model->getAllPersonaReporte();
             
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

        $pdf->Cell(180,10,utf8_decode('LISTA DE SOLICITANTES'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,60,60,30,25));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("NOMBRE COMPLETO"),utf8_decode("DIRRECIÓN"),utf8_decode("TELEFONO"),utf8_decode("CELULAR")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            /*
            $funcionario = $this->Persona_model->getPersona($row['idpersona']);
            $cargo = $this->Funcionario_model->getFuncionarioId($row['idpersona']);
            $idcargo = $data['cargo']['idcargo'];
            $dataCargo = $this->Cargo_model->getCargo($idcargo);
            */
            $pdf->Row(array($indice,utf8_decode($row['nombreCompleto']),utf8_decode($row['direccion']),utf8_decode($row['telefono']),utf8_decode($row['celular'])));
            //$pdf->Ln(5);
            $indice++;
        }

        $pdf->Output("listasolicitantes.pdf","I");
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
    public function generateSlug($key)
    {
        // Hash
        $key = password_hash($key, PASSWORD_BCRYPT,[5]);
        $resultado = str_replace("$", "", $key);
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

    /**
     * Insert inicia la vista header add y footer para procesoTramite.
     */
    function actividadAjax()
    {
        $data = json_encode($this->Actividad_model->getAllActividad());
        echo $data;
        //*/
    }

    function personaAjax()
    {
        $data = json_encode($this->Persona_model->getTodasPersonasFullName());
        echo $data;
    }

    function funcionarioAjax()
    {
        $data = json_encode($this->Funcionario_model->getAllFuncionario());
        echo $data;
    }
}
