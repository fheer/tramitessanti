<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoTramite_model extends CI_Model
{
    /**
     * TipoTramite_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramite($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->result_array();
    }

    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramiteByIdTipoTramite($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->row_array();
    }

    function getTipoTramiteIdTipoTramite($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->row_array();
    }

    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramiteReporte($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->row_array();
    }


    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramiteCodigo($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->row_array();
    }


    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramiteId($idtipotramite)
    {
        return $this->db->get_where('tipotramite',array('idtipotramite'=>$idtipotramite))->row_array();
    }

    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getTipoTramiteSlug($key)
    {
        return $this->db->get_where('tipotramite',array('key'=>$key))->row_array();
    }

    /**
     * GetTipoTramite.
     * @param $idtipotramite Id del TipoTramite.
     * @return row_array con datos de un tipotramite.
     */
    function getIdBySlug($key)
    {
        $this->db->select('idtipotramite,nombreRequisito');
        $this->db->FROM('tipotramite');
        $this->db->WHERE('key', $key);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtipotramite;
        }else{
            return 0;
        }
    }

    function getRequisitos($idtipotramite)
    {
        $this->db->select('idrequisito');
        $this->db->from('tipotramiterequisito');
        $this->db->where('idtipotramite',$idtipotramite);
        return $this->db->get()->result_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idtipotramite,nombre');
        $this->db->FROM('tipotramite');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtipotramite;
        }else{
            return 0;
        }
    }

    function validarNombreTipoTramite($nombre)
    {
        $this->db->select('idtipotramite,nombre');
        $this->db->FROM('tipotramite');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtipotramite;
        }else{
            return 0;
        }
    }

    /**
     * GetAllTipoTramiteCount.
     * @return entero Cantidad de tipotramites.
     */
    function getAllTipoTramiteCount()
    {
        $this->db->select('count(idtipotramite) as contador');
        $this->db->from('tipotramite');
        $this->db->where('tipo_tipotramite','TipoTramite');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllTipoTramite.
     * @return result_array con datos de varios tipotramites.
     */
    function getAllTipoTramite()
    {
        $this->db->order_by('idtipotramite', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('tipotramite')->result_array();
    }

    /**
     * GetTramiteRequisitos.
     * @return result_array con datos de requisitos de los tipotramites.
     */
    function getTramiteRequisitos($idtipotramite)
    {
        $this->db->select('r.nombreRequisito');
        $this->db->from('tipotramite tt');
        $this->db->join('tipotramiterequisito ttr','tt.idtipotramite=ttr.idtipotramite','inner');
        $this->db->join('requisito r','r.idrequisito=ttr.idrequisito','inner');
        $this->db->where('ttr.idtipotramite', $idtipotramite); 
        $this->db->order_by('r.nombreRequisito', 'asc');       
        return $this->db->get()->result_array();
    }

    /**
     * GetTodosLosTramites.
     * @return result_array con datos de varios tipotramites.
     */
    function getTodosLosTramites()
    {
        $this->db->where('estado', 1);  
        $this->db->order_by('idtipotramite', 'asc');       
        return $this->db->get('tipotramite')->result_array();
    }

    /**
     * AddTipoTramite.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos tipotramite guardado.
     */
    function addTipoTramite($params)
    {
        $this->db->insert('tipotramite',$params);
        return $this->db->insert_id();
    }

    /**
     * AddTipoTramite.
     * @param $idtipotramite Id del tipotramite.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del tipotramite modificado
     */
    function updateTipoTramite($idtipotramite,$params)
    {
        $this->db->where('idtipotramite',$idtipotramite);
        return $this->db->update('tipotramite',$params);
    }

    /**
     * delete.
     * @param $idtipotramite Id del tipotramite.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     */
    function delete($params)
    {
        $this->db->delete('tipotramiterequisito',$params);
    }

    /**
     * CambiarEstado.
     * @param $idtipotramite Id del tipotramite.
     * @param $params estado 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idtipotramite,$params)
    {
        $this->db->where('idtipotramite',$idtipotramite);
        return $this->db->update('tipotramite',$params);
    }

    /**
     * GetTipoTramitesReporte.
     * @return result con idtipotramite, nombre, direccion, telefono, email.
     */
    public function getTipoTramitesReporte(){
        $this->db->select('idtipotramite, nombre, direccion, telefono, email');
        $this->db->from('tipotramite');
        $this->db->Where('tipoTipoTramite','TipoTramite');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
