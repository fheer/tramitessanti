<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisito_model extends CI_Model
{
    /**
     * Requisito_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetRequisito.
     * @param $slug del Requisito.
     * @return row_array con datos de un requisito.
     */
    function getRequisitoSlug($slug)
    {
        return $this->db->get_where('requisito',array('slug'=>$slug))->row_array();
    }

    /**
     * GetRequisito.
     * @param $idrequisito Id del Requisito.
     * @return row_array con datos de un requisito.
     */
    function getRequisitoId($idrequisito)
    {
        return $this->db->get_where('requisito',array('idrequisito'=>$idrequisito))->row_array();
    }

    /**
     * GetRequisito.
     * @param $nombreRequisito Nombre Requisito del Requisito.
     * @return row_array con datos de un requisito.
     */
    function getRequisitoByNombreRequisito($nombreRequisito)
    {
        return $this->db->get_where('requisito',array('nombreRequisito'=>$nombreRequisito))->row_array();
    }

    function validarNombreRequisito($nombreRequisito)
    {
        $this->db->select('idrequisito,nombreRequisito');
        $this->db->FROM('requisito');
        $this->db->WHERE('nombreRequisito', $nombreRequisito);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idrequisito;
        }else{
            return 0;
        }
    }

    /**
     * GetAllRequisitoCount.
     * @return entero Cantidad de requisitos.
     */
    function getAllRequisitoCount()
    {
        $this->db->select('count(idrequisito) as contador');
        $this->db->from('requisito');
        $this->db->where('tipo_requisito','Requisito');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllRequisito.
     * @return result_array con datos de varios requisitos.
     */
    function getAllRequisito()
    {
        $this->db->order_by('idrequisito', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('requisito')->result_array();
    }

    /**
     * AddRequisito.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos requisito guardado.
     */
    function addRequisito($params)
    {
        $this->db->insert('requisito',$params);
        return $this->db->insert_id();
    }

    /**
     * AddRequisito.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos requisito guardado.
     */
    function addTipoTramiteRequisito($params)
    {
        $this->db->insert('tipotramiterequisito',$params);
        return $this->db->insert_id();
    }


    /**
     * AddRequisito.
     * @param $idrequisito Id del requisito.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del requisito modificado
     */
    function updateRequisito($slug,$params)
    {
        $this->db->where('slug',$slug);
        return $this->db->update('requisito',$params);
    }

    /**
     * CambiarEstado.
     * @param $idrequisito Id del requisito.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idrequisito,$params)
    {
        $this->db->where('idrequisito',$idrequisito);
        return $this->db->update('requisito',$params);
    }

    /**
     * GetRequisitosReporte.
     * @return result con idrequisito, nombre, direccion, telefono, email.
     */
    public function getRequisitosReporte(){
        $this->db->select('idrequisito, nombre, direccion, telefono, email');
        $this->db->from('requisito');
        $this->db->Where('tipoRequisito','Requisito');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
