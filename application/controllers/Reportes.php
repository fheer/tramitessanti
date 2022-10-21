<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller{

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
        /*
        $logoConsejo = base_url()."fotos/logo.jpg";
        $pdf->Image($logoConsejo, 175, 5, 25, 23);
        $logo = base_url()."fotos/consejo.jpg";
        $pdf->Image($logo, 15, 5, 25, 23);     
        */
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(30);
        $pdf->Cell(100,10,utf8_decode('LISTA REQUISITOS'),0,0,'C');

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
}
