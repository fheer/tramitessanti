<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TramiteUnidad_model extends CI_Model
{
    /**
     * TramiteUnidad_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetTramiteUnidad.
     * @param $idtramiteunidad Id del TramiteUnidad.
     * @return row_array con datos de un tramiteunidad.
     */
    function getTramiteUnidad($idtramiteunidad)
    {
        return $this->db->get_where('tramiteunidad',array('idtramiteunidad'=>$idtramiteunidad))->row_array();
    }

    /**
     * GetTramiteUnidad.
     * @param $idtramiteunidad Id del TramiteUnidad.
     * @return row_array con datos de un tramiteunidad.
     */
    function getTramiteUnidadBySlug($slug)
    {
        return $this->db->get_where('tramiteunidad',array('slug'=>$slug))->row_array();
    }


    function validarNombre($tramiteunidad)
    {
        $this->db->select('idtramiteunidad,tramiteunidad');
        $this->db->FROM('tramiteunidad');
        $this->db->WHERE('tramiteunidad', $tramiteunidad);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtramiteunidad;
        }else{
            return 0;
        }
    }

    function validarCi($num_documento)
    {
        $this->db->select('idtramiteunidad,num_documento');
        $this->db->FROM('tramiteunidad');
        $this->db->WHERE('num_documento', $num_documento);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtramiteunidad;
        }else{
            return 0;
        }
    }

    /**
     * GetAllTramiteUnidadCount.
     * @return entero Cantidad de tramiteunidads.
     */
    function getAllTramiteUnidadCount()
    {
        $this->db->select('count(idtramiteunidad) as contador');
        $this->db->from('tramiteunidad');
        $this->db->where('tipo_tramiteunidad','TramiteUnidad');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllTramiteUnidad.
     * @return result_array con datos de varios tramiteunidads.
     */
    function getAllTramiteUnidad()
    {
        $this->db->order_by('idtramiteunidad', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('tramiteunidad')->result_array();
    }

    /**
     * AddTramiteUnidad.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos tramiteunidad guardado.
     */
    function addTramiteUnidad($params)
    {
        $this->db->insert('tramiteunidad',$params);
        return $this->db->insert_id();
    }

    /**
     * AddTramiteUnidad.
     * @param $idtramiteunidad Id del tramiteunidad.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del tramiteunidad modificado
     */
    function updateTramiteUnidad($slug,$params)
    {
        ///*
        $this->db->where('slug',$slug);
        return $this->db->update('tramiteunidad',$params);
        //*/
    }

    /**
     * CambiarEstado.
     * @param $idtramiteunidad Id del tramiteunidad.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idtramiteunidad,$params)
    {
        $this->db->where('idtramiteunidad',$idtramiteunidad);
        return $this->db->update('tramiteunidad',$params);
    }

    /**
     * GetTramiteUnidadsReporte.
     * @return result con idtramiteunidad, nombre, direccion, telefono, email.
     */
    public function getTramiteUnidadsReporte(){
        $this->db->select('idtramiteunidad, nombre, direccion, telefono, email');
        $this->db->from('tramiteunidad');
        $this->db->Where('tipoTramiteUnidad','TramiteUnidad');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
