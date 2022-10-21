<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model
{
    /**
     * Actividad_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetActividad.
     * @param $idactividad Id del Actividad.
     * @return row_array con datos de un actividad.
     */
    function getActividad($idactividad)
    {
        return $this->db->get_where('actividad',array('idactividad'=>$idactividad))->row_array();
    }

    function sacaActividad($idpersona)
    {

        $this->db->select('a.actividad as actividad');
        $this->db->FROM('actividad a');
        $this->db->join('persona p','p.idactividad=a.idactividad','inner');
        $this->db->WHERE('p.idpersona', $idpersona);
        $this->db->WHERE('p.estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->actividad;
        }else{
            return '';
        }
    }

    function validarCi($num_documento)
    {
        $this->db->select('idactividad,num_documento');
        $this->db->FROM('actividad');
        $this->db->WHERE('num_documento', $num_documento);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idactividad;
        }else{
            return 0;
        }
    }

    /**
     * GetAllActividadCount.
     * @return entero Cantidad de actividads.
     */
    function getAllActividadCount()
    {
        $this->db->select('count(idactividad) as contador');
        $this->db->from('actividad');
        $this->db->where('tipo_actividad','Actividad');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllActividad.
     * @return result_array con datos de varios actividads.
     */
    function getAllActividad()
    {
        $this->db->order_by('idactividad', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('actividad')->result_array();
    }

    /**
     * AddActividad.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos actividad guardado.
     */
    function addActividad($params)
    {
        $this->db->insert('actividad',$params);
        return $this->db->insert_id();
    }

    /**
     * AddActividad.
     * @param $idactividad Id del actividad.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del actividad modificado
     */
    function updateActividad($idactividad,$params)
    {
        $this->db->where('idactividad',$idactividad);
        return $this->db->update('actividad',$params);
    }

    /**
     * CambiarEstado.
     * @param $idactividad Id del actividad.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idactividad,$params)
    {
        $this->db->where('idactividad',$idactividad);
        return $this->db->update('actividad',$params);
    }

    /**
     * GetActividadsReporte.
     * @return result con idactividad, nombre, direccion, telefono, email.
     */
    public function getActividadsReporte(){
        $this->db->select('idactividad, nombre, direccion, telefono, email');
        $this->db->from('actividad');
        $this->db->Where('tipoActividad','Actividad');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
