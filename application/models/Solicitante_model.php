<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitante_model extends CI_Model
{
    /**
     * Solicitante_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetSolicitante.
     * @param $idsolicitante Id de Solicitante por slug.
     * @return row_array con datos de un solicitante.
     */
    function getSolicitante($slug)
    {
        return $this->db->get_where('solicitante',array('slug'=>$slug))->row_array();
    }

    /**
     * GetSolicitante.
     * @param $idsolicitante Id del Solicitante por idsolicitante.
     * @return row_array con datos de un solicitante.
     */
    function getSolicitanteId($idpersona)
    {
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    /**
     * GetSolicitanteIdPersona.
     * @param $idsolicitante Id de la Persona por idpersona.
     * @return row_array con datos de un solicitante.
     */
    function getSolicitanteIdPersona($idpersona)
    {
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idsolicitante,nombre');
        $this->db->FROM('solicitante');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idsolicitante;
        }else{
            return 0;
        }
    }

    function validarCi($ci)
    {
        $this->db->select('idsolicitante,ci');
        $this->db->FROM('solicitante');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idsolicitante;
        }else{
            return 0;
        }
    }

    /**
     * GetAllSolicitanteCount.
     * @return entero Cantidad de solicitantes.
     */
    function getAllSolicitanteCount()
    {
        $this->db->select('count(idsolicitante) as contador');
        $this->db->from('solicitante');
        $this->db->where('tipo_solicitante','Solicitante');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllSolicitante.
     * @return result_array con datos de varios solicitantes.
     */
    function getAllSolicitante()
    {
        $this->db->order_by('idsolicitante', 'desc');       
        $this->db->where('tipoSolicitante', 1);  
        return $this->db->get('solicitante')->result_array();
    }

    /**
     * GetAllSolicitante.
     * @return result_array con datos de varios solicitantes.
     */
    function getAllSolicitanteFullName()
    {
        $this->db->select("p.idsolicitante, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto ");
        $this->db->from('solicitante p');
        $this->db->join('usuario u','p.idsolicitante<>u.idsolicitante');
        $this->db->order_by('p.apellidoPaterno', 'asc');
        $this->db->order_by('p.apellidoMaterno', 'asc');  
        $this->db->where('p.tipoSolicitante', 2);  
        return $this->db->get('solicitante')->result_array();
    }
}
