<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tramite_model extends CI_Model
{
    /**
     * Tramite_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetTramite.
     * @param $idtramite Id del Tramite.
     * @return row_array con datos de un tramite.
     */
    function getTramite($idtramite)
    {
        return $this->db->get_where('tramite',array('idtramite'=>$idtramite))->row_array();
    }

    /**
     * GetTramite.
     * @param $idtramite Id del Tramite.
     * @return row_array con datos de un tramite.
     */
    function getTramiteByCodigo($codigo)
    {
        return $this->db->get_where('tramite',array('codigo'=>$codigo))->row_array();
    }

    /**
     * GetTramite.
     * @param $idtramite Id del Tramite.
     * @return row_array con datos de un tramite.
     */
    function getTramiteByIdAndEstadoCero($idtramite)
    {
        $this->db->select('count(idtramite) as contador');
        $this->db->from('tramite');
        $this->db->where('idtipotramite',$idtipotramite);
        return $this->db->get_where('tramite',array('idtramite'=>$idtramite))->row_array();
    }

    /**
     * GetTramite.
     * @param $idtramite Id del Tramite.
     * @return row_array con datos de un tramite.
     */
    function getCodigoTramite($idtramite)
    {
        $this->db->select('codigo');
        $this->db->from('tramite');
        $this->db->where('idtramite',$idtramite);
        return $this->db->get()->row_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idtramite,nombre');
        $this->db->FROM('tramite');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtramite;
        }else{
            return 0;
        }
    }

    function validarCi($num_documento)
    {
        $this->db->select('idtramite,num_documento');
        $this->db->FROM('tramite');
        $this->db->WHERE('num_documento', $num_documento);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idtramite;
        }else{
            return 0;
        }
    }

    /**
     * GetAllTramiteCount.
     * @return entero Cantidad de tramites.
     */
    function getAllTramiteCount($idtipotramite)
    {
        $this->db->select('count(idtramite) as contador');
        $this->db->from('tramite');
        $this->db->where('idtipotramite',$idtipotramite);
        $r = $this->db->get();
        $resultado = $r->row();
        if ($resultado->num_rows()>0) {
            return $resultado->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllTramite()
    {
        $this->db->order_by('idtramite', 'asc');       
        $this->db->where('estado', 1);  
        return $this->db->get('tramite')->result_array();
    }

    /**
     * GetTramiteRequisitos.
     * @return result_array con datos de requisitos de los tramites.
     */
    function getTramiteRequisitos($idtramite)
    {
        $this->db->select('r.nombreRequisito');
        $this->db->from('tramite tt');
        $this->db->join('tramiterequisito ttr','tt.idtramite=ttr.idtramite','inner');
        $this->db->join('requisito r','r.idrequisito=ttr.idrequisito','inner');
        $this->db->where('ttr.idtramite', $idtramite); 
        $this->db->order_by('r.nombreRequisito', 'asc');       
        return $this->db->get()->result_array();
    }

    /**
     * GetTodosLosTramites.
     * @return result_array con datos de varios tramites.
     */
    function getTodosLosTramites()
    {
        $this->db->where('estado', 1);  
        $this->db->order_by('idtramite', 'asc');       
        return $this->db->get('tramite')->result_array();
    }

    /**
     * AddTramite.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos tramite guardado.
     */
    function addTramite($params)
    {
        $this->db->insert('tramite',$params);
        return $this->db->insert_id();
    }

    /**
     * AddTramite.
     * @param $idtramite Id del tramite.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del tramite modificado
     */
    function updateTramite($idtramite,$params)
    {
        $this->db->where('idtramite',$idtramite);
        return $this->db->update('tramite',$params);
    }

    /**
     * CambiarEstado.
     * @param $idtramite Id del tramite.
     * @param $params estado 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idtramite,$params)
    {
        $this->db->where('idtramite',$idtramite);
        return $this->db->update('tramite',$params);
    }

    /**
     * GetTramitesReporte.
     * @return result con idtramite, nombre, direccion, telefono, email.
     */
    public function getTramitesReporte(){
        $this->db->select('idtramite, nombre, direccion, telefono, email');
        $this->db->from('tramite');
        $this->db->Where('tipoTramite','Tramite');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
