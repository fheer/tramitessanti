<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisito extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Requisito_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para requisito.
     */
    function index()
    {
        $data['requisito'] = $this->Requisito_model->getAllRequisito();    
        $this->load->view('layout/header');
        $this->load->view('requisito/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para requisito.
     */
    function insert()
    {
        ///* 
        $this->load->view('layout/header');
        $this->load->view('requisito/add');
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para requisito.
     */
    function editar($slug)
    {
    	$data['requisito'] = $this->Requisito_model->getRequisitoSlug($slug);    
        ///* 
    	$this->load->view('layout/header');
        $this->load->view('requisito/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a Requisito_model para guardar datos.
     */
    function guardarDB()
    {   
        $nombreRequisito = $this->input->post('nombreRequisito');
        
        $this->formValidation();
        
		if($this->form_validation->run())     
        {   
            
                if ($this->Requisito_model->validarNombreRequisito($nombreRequisito)==0) {
                    $params = $this->datos($nombreRequisito);  
                    $slugUsuario = $this->generateSlug($nombreRequisito);
                    $requisito_id = $this->Requisito_model->addRequisito($params);
                    
                        redirect(base_url().'requisito/lista');           
                    
                }else{
                    $data['mensaje'] = 'El Nombre del Requisito se encuentra registrado';

                    $this->load->view('layout/header');
                    $this->load->view('requisito/add',$data);
                    $this->load->view('layout/footer');
                }
            
        }
        else
        {   
            $this->load->view('layout/header');
            $this->load->view('requisito/add');
            $this->load->view('layout/footer');
        }
        
    }

    /**
     * EditarDB envia los datos a Requisito_model para modificar datos.
     */
    function editarDB()
    {   
    		$nombreRequisito = $this->input->post('nombreRequisito');
            $slug = $this->input->post('slug');
        	$this->formValidation();

			if($this->form_validation->run())     
            {   
                $params = $this->datos($nombreRequisito);

                $this->Requisito_model->updateRequisito($slug,$params);            
                redirect(base_url().'requisito/lista');           
               
            }
            else
            {
                $data['requisito'] = $this->Requisito_model->getRequisitoSlug($slug);
                ///* 
                $this->load->view('layout/header');
                $this->load->view('requisito/edit',$data);
                $this->load->view('layout/footer');    
            }
        
    }

    /**
     * CambiarEstado envia los datos a Requisito_model para cambiar el campo condición.
     */
    function cambiarEstado($idrequisito,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            $this->Requisito_model->cambiarEstado($idrequisito,$params);

            redirect(base_url().'requisito');
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datos($nombreRequisito)
    {
        $params = array(
            'nombreRequisito' => $this->input->post('nombreRequisito'),
            'descripcion' => $this->input->post('descripcion'),
            'slug' => $this->generateSlug($nombreRequisito),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');

        $this->form_validation->set_rules('nombreRequisito','Nombre Requisito','required|min_length[10]|max_length[256]|callback_alpha_requisito');
		$this->form_validation->set_rules('descripcion','Descripción Requisito','required|min_length[10]|max_length[256]|callback_alpha_requisito');       
    }

    /**
     * ReportePersona genera el reporte de requisitos en formato pdf.
     */
    public function reporteRequisito()
    {
        $data = $this->Requisito_model->getAllRequisito();
             
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


        
        $pdf->Cell(180,10,utf8_decode('LISTA REQUISITOS'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,85,85));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("REQUISITO"),utf8_decode("DESCRIPCIÓN")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {
            //*/
            $pdf->Row(array($indice,utf8_decode($row['nombreRequisito']),utf8_decode($row['descripcion'])));
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
    public function alpha_requisito($str)
    {

        if (preg_match('/^[A-Záéíóú0123456789,() -]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('alpha_requisito', 'El campo {field} solo puede contener caracteres alfabéticos, números, paréntesis y gión .');
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
