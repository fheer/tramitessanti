<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->model('Funcionario_model');
        $this->load->model('Cargo_model');
        $this->load->model('Expedido_model');
        $this->load->model('Solicitante_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para funcionario.
     */
    function index()
    {
        $data['funcionario'] = $this->Persona_model->getAllPersona(2);    
        $this->load->view('layout/header');
        $this->load->view('funcionario/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para funcionario.
     */
    function insert($opcion)
    {
        $data['opcion'] = $opcion;
        $data['cargo'] = $this->Cargo_model->getAllCargo();

        ///* 
        $this->load->view('layout/header');
        $this->load->view('funcionario/add',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para funcionario.
     */
    function editar($key, $opcion)
    {
        $data['opcion'] = $opcion;
    	$data['funcionario'] = $this->Persona_model->getPersona($key);
        $idpersona = $data['funcionario']['idpersona'];
        $data['cargo'] = $this->Funcionario_model->getFuncionarioId($idpersona);
        $idcargo = $data['cargo']['idcargo'];
        $data['act'] = $this->Cargo_model->getCargo($idcargo);
        $data['cargo'] = $this->Cargo_model->getAllCargo();
        
        ///* 
    	$this->load->view('layout/header');
        $this->load->view('funcionario/edit',$data);
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
        $opcion = $this->input->post('opcion');
        $tipoPersona = $this->input->post('tipoPersona');

        $this->formValidation();
        
		if($this->form_validation->run())     
        {   
            
                if ($this->Persona_model->validarCi($ci)==0) {
                    $params = $this->datos();  
                    $cargoCargo = $this->input->post('idcargo'); 

                    $funcionario_id = $this->Persona_model->addPersona($params);
                    
                    if ($opcion == 1) {
                        redirect(base_url().'funcionario');           
                    }else{
                        redirect(base_url().'proceso/nuevo');
                    }
                    
                }else{
                    $data['mensaje'] = 'El Número de CI se encuentra registrado';
                    $data['opcion'] = $opcion;
                    $data['cargo'] = $this->Cargo_model->getAllCargo();
                    $this->load->view('layout/header');
                    $this->load->view('funcionario/add',$data);
                    $this->load->view('layout/footer');
                }
            
        }
        else
        {   
            $data['opcion'] = $opcion;
            $data['cargo'] = $this->Cargo_model->getAllCargo();
            $data['expedido'] = $this->Expedido_model->getAllExpedido();
            $this->load->view('layout/header');
            $this->load->view('funcionario/add',$data);
            $this->load->view('layout/footer');
        }
        
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function editarDB()
    {   
    		$idfuncionario = $this->input->post('idpersona');
            $opcion = $this->input->post('opcion');
        	
            $this->formValidation();
			
            if($this->form_validation->run())     
            {   
                $params = $this->datos();

                $this->Persona_model->updatePersona($idfuncionario,$params);            
                if ($opcion == 2) {
                    redirect(base_url().'funcionario');           
                }else{
                    redirect(base_url().'perfil/ver/'.$this->session->userdata('token'));
                }
            }
            else
            {
                $data['opcion'] = $opcion;
                $data['funcionario'] = $this->Persona_model->getPersona($key);
                $idcargo = $data['funcionario']['idcargo'];
                $data['act'] = $this->Cargo_model->getActividad($idcargo);
                $data['cargo'] = $this->Cargo_model->getAllActividad();

                redirect(base_url().'ventas/insert');    
            }
        
    }

    /**
     * EditarDB envia los datos a Persona_model para modificar datos.
     */
    function editarDBPerfil()
    {   
            $idfuncionario = $this->input->post('idpersona');
            $opcion = $this->input->post('opcion');
            
            $this->formValidation();
            
            if($this->form_validation->run())     
            {   
                $params = $this->datosPerfil();

                $idpersona = $this->Persona_model->updatePersona($idfuncionario,$params);
                $token = $this->Funcionario_model->getFuncionarioId($idpersona);
                if ($opcion == 2) {
                    redirect(base_url().'funcionario');           
                }else{

                    redirect(base_url().'perfil/ver/'.$token['key']);
                }
            }
            else
            {
                $idpersona = $this->session->userdata('idPersona');
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
        
    }

    /**
     * CambiarEstado envia los datos a Persona_model para cambiar el campo condición.
     */
    function cambiarEstado($idfuncionario,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            $this->Persona_model->cambiarEstado($idfuncionario,$params);

            redirect(base_url().'funcionario');
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
            'tipoPersona' => $this->input->post('tipoPersona'),
            'fechaNacimiento' => $this->input->post('fechaNacimiento'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular'),
            'idcargo' => $this->input->post('idcargo'),
            'idactividad' => 3,
            'key' => $this->generateSlug($this->input->post('ci')),
            'usuario' => $this->generarNombreUsuario($nombres, $apellidoPaterno, $apellidoMaterno, $ci),
            'clave' => $this->generarPassword($ci),
            'permisos' => MD5(4).'#',
        );
        return $params;
    }

    function datosPerfil()
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
            'tipoPersona' => $this->input->post('tipoPersona'),
            'fechaNacimiento' => $this->input->post('fechaNacimiento'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular'),
            'idcargo' => $this->input->post('idcargo'),
            'idactividad' => 3,
            'key' => $this->generateSlug($this->input->post('ci')),
            'usuario' => $this->generarNombreUsuario($nombres, $apellidoPaterno, $apellidoMaterno, $ci),
            'clave' => $this->generarPassword($ci),
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
        $this->form_validation->set_rules('idcargo','Actividad','required');
		$this->form_validation->set_rules('apellidoPaterno','Apellido Paterno','min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('apellidoMaterno','Apellido Materno','min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('nombres','Nombres(s)','required|min_length[2]|max_length[45]|callback_alpha_acento');
        $this->form_validation->set_rules('genero','Genero','required');
        $this->form_validation->set_rules('estadoCivil','estadoCivil','required');
        $this->form_validation->set_rules('fechaNacimiento','Fecha de Nacimiento','required');
		$this->form_validation->set_rules('direccion','Dirección','max_length[200]|callback_address');
        $this->form_validation->set_rules('telefono','Telefono','max_length[10]|numeric');
        $this->form_validation->set_rules('celular','Celular','max_length[10]|numeric');
        
    }

    /**
     * ReportePersona genera el reporte de funcionarios en formato pdf.
     */
    public function reporteFuncionario()
    {
        $data = $this->Funcionario_model->getAllFuncionarioFullNameReporte();
             
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
        $pdf->Image($logoConsejo, 15, 5, 25, 23);
        
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(5);
        //$pdf->Cell(161,3,utf8_decode('FONDO DE DESARROLLO EMPRESARIAL'),0,0,'R');
        //$pdf->Ln(5);
        //$pdf->Cell(182,3,utf8_decode('Dirección: Av. Lanza Edificio Delagadillo Oficina 10'),0,0,'R');
        $pdf->Ln(5);
        */
        //$pdf->Cell(182,3,utf8_decode('Usuario: '.$this->session->userdata('s_login')),0,0,'R');
        //$pdf->Ln(5);
        //$pdf->Cell(182,3,utf8_decode('Fecha Impresión: ').date('d-m-Y'),0,0,'R');        
        $pdf->SetFont('Arial','B',12);
        //$pdf->Ln(15);
        $pdf->Cell(30);
        $pdf->Cell(100,10,utf8_decode('LISTA DE FUNCIONARIOS'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,60,30,60,25));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("NOMBRE COMPLETO"),utf8_decode("CARGO"),utf8_decode("DIRRECIÓN"),utf8_decode("CELULAR")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            /*
            $funcionario = $this->Persona_model->getPersona($row['idpersona']);
            $cargo = $this->Funcionario_model->getFuncionarioId($row['idpersona']);
            $idcargo = $data['cargo']['idcargo'];
            $dataCargo = $this->Cargo_model->getCargo($idcargo);
            */
            $pdf->Row(array($indice,utf8_decode($row['nombreCompleto']),utf8_decode($row['cargo']),utf8_decode($row['direccion']),utf8_decode($row['celular'])));
            //$pdf->Ln(5);
            $indice++;
        }

        $pdf->Output("listafuncionarios.pdf","I");
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

        if (preg_match('/^[A-ZáéíóúÑñ ]+$/i', $str))
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
}
