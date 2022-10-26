<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NormaLegal_model extends CI_Model
{
    /**
     * NormaLegal_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetNormaLegal.
     * @param $idnormalegal Id del NormaLegal.
     * @return row_array con datos de un normalegal.
     */
    function getNormaLegal($idnormalegal)
    {
        return $this->db->get_where('normalegal',array('idnormalegal'=>$idnormalegal))->row_array();
    }

    /**
     * GetNormaLegal.
     * @param $idnormalegal Id del NormaLegal.
     * @return row_array con datos de un normalegal.
     */
    function getNormaLegalBySlug($slug)
    {
        return $this->db->get_where('normalegal',array('key'=>$slug))->row_array();
    }


    function validarNombre($normalegal)
    {
        $this->db->select('idnormalegal,normalegal');
        $this->db->FROM('normalegal');
        $this->db->WHERE('normalegal', $normalegal);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idnormalegal;
        }else{
            return 0;
        }
    }

    function validarCi($num_documento)
    {
        $this->db->select('idnormalegal,num_documento');
        $this->db->FROM('normalegal');
        $this->db->WHERE('num_documento', $num_documento);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idnormalegal;
        }else{
            return 0;
        }
    }

    /**
     * GetAllNormaLegalCount.
     * @return entero Cantidad de normalegals.
     */
    function getAllNormaLegalCount()
    {
        $this->db->select('count(idnormalegal) as contador');
        $this->db->from('normalegal');
        $this->db->where('tipo_normalegal','NormaLegal');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllNormaLegal.
     * @return result_array con datos de varios normalegals.
     */
    function getAllNormaLegal()
    {
        $this->db->order_by('idnormalegal', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('normalegal')->result_array();
    }

    /**
     * AddNormaLegal.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos normalegal guardado.
     */
    function addNormaLegal($params)
    {
        $this->db->insert('normalegal',$params);
        return $this->db->insert_id();
    }

    /**
     * AddNormaLegal.
     * @param $idnormalegal Id del normalegal.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del normalegal modificado
     */
    function updateNormaLegal($slug,$params)
    {
        ///*
        $this->db->where('key',$slug);
        return $this->db->update('normalegal',$params);
        //*/
    }

    /**
     * CambiarEstado.
     * @param $idnormalegal Id del normalegal.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idnormalegal,$params)
    {
        $this->db->where('idnormalegal',$idnormalegal);
        return $this->db->update('normalegal',$params);
    }

    /**
     * GetNormaLegalsReporte.
     * @return result con idnormalegal, nombre, direccion, telefono, email.
     */
    public function getNormaLegalsReporte(){
        $this->db->select('idnormalegal, nombre, direccion, telefono, email');
        $this->db->from('normalegal');
        $this->db->Where('tipoNormaLegal','NormaLegal');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
