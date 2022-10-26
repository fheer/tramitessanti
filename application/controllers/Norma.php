<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Norma extends CI_Controller{

    /**
     * Persona constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('NormaLegal_model');
        require_once  APPPATH.'controllers/PDF_MC_Table.php';
    }

    /**
     * Index inicia la vista header index y footer para norma.
     */
    function index()
    {
        $data['norma'] = $this->NormaLegal_model->getAllNormaLegal();    
        $this->load->view('layout/header');
        $this->load->view('norma/index',$data);
        $this->load->view('layout/footer');
    }

    /**
     * Insert inicia la vista header add y footer para norma.
     */
    function insert()
    {
        ///* 
        $this->load->view('layout/header');
        $this->load->view('norma/add');
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * Editar inicia la vista header edit y footer para norma.
     */
    function editar($slug)
    {
    	$data['normalegal'] = $this->NormaLegal_model->getNormaLegalBySlug($slug);    
        ///* 
    	$this->load->view('layout/header');
        $this->load->view('norma/edit',$data);
        $this->load->view('layout/footer');
        //*/
    }

    /**
     * GuardarDB envia los datos a NormaLegal_model para guardar datos.
     */
    function guardarDB()
    {   
        $normalegal = $this->input->post('normalegal');
        
        $this->formValidation();
        
		if($this->form_validation->run())     
        {   
            
                if ($this->NormaLegal_model->validarNombre($normalegal)==0) {
                    $params = $this->datos($normalegal);  
                    
                    $norma_id = $this->NormaLegal_model->addNormaLegal($params);
                    
                    redirect(base_url().'norma');           
                    
                }else{
                    $data['mensaje'] = 'El Nombre del Norma se encuentra registrado';

                    $this->load->view('layout/header');
                    $this->load->view('norma/add',$data);
                    $this->load->view('layout/footer');
                }
            
        }
        else
        {   
            $this->load->view('layout/header');
            $this->load->view('norma/add');
            $this->load->view('layout/footer');
        }
        
    }

    /**
     * EditarDB envia los datos a NormaLegal_model para modificar datos.
     */
    function editarDB()
    {   
    		$normalegal = $this->input->post('normalegal');
            $slug = $this->input->post('slug');
        	$this->formValidation();

			if($this->form_validation->run())     
            {   
                $params = $this->datos($normalegal);

                $this->NormaLegal_model->updateNormaLegal($slug,$params);            
                redirect(base_url().'norma');           
               
            }
            else
            {
                $data['normalegal'] = $this->NormaLegal_model->getNormaLegalBySlug($slug);    
                ///* 
                $this->load->view('layout/header');
                $this->load->view('norma/edit',$data);
                $this->load->view('layout/footer'); 
                //*/ 
            }
        
    }

    /**
     * CambiarEstado envia los datos a NormaLegal_model para cambiar el campo condición.
     */
    function cambiarEstado($idnormalegal,$activo)
    {
            $params = array(
                    'estado' => $activo,
            );

            ///*
            $this->NormaLegal_model->cambiarEstado($idnormalegal,$params);

            redirect(base_url().'norma');
            //*/
    }

    /**
     * Datos setea los datos para utilizar en GuardarDB y EditarDB.
     */
    function datos($normalegal)
    {
        $params = array(
            'normalegal' => $this->input->post('normalegal'),
            'key' => $this->generateSlug($normalegal),
        );
        return $params;
    }

    /**
     * FormValidation setea los campos para ser validados.
     */
    public function formValidation()
    {
      	$this->load->library('form_validation');

        $this->form_validation->set_rules('normalegal','Nombre Norma Legal','required|min_length[4]|max_length[12]|callback_alpha_space');      
    }

    /**
     * ReportePersona genera el reporte de normas en formato pdf.
     */
    public function reporteNorma()
    {
        $data = $this->NormaLegal_model->getAllNormaLegal(); 
             
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
        $pdf->Cell(100,10,utf8_decode('LISTA NORMA LEGAL'),0,0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',11);
        $pdf->SetWidths(array(10,170));
        $pdf->Row(array(utf8_decode("Nº"),utf8_decode("NORMA LEGAL")));
        $pdf->SetFont('Arial','',10);
        $indice=1;

        foreach ($data as $row) {

            $pdf->Row(array($indice,utf8_decode($row['normalegal'])));
            //$pdf->Ln(5);
            $indice++;
        }

        $pdf->Output("listanormalegal.pdf","I");
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

        if (preg_match('/^[A-Záéíóú1234567890 -]+$/i', $str))
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
    public function alpha_norma($str)
    {

        if (preg_match('/^[A-Záéíóú0123456789,() -]+$/i', $str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('alpha_norma', 'El campo {field} solo puede contener caracteres alfabéticos, números, paréntesis y gión .');
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
