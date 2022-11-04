<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonaTramite_model extends CI_Model
{
    /**
     * PersonaTramite_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetPersonaTramite.
     * @param $idactividad Id del PersonaTramite.
     * @return row_array con datos de un actividad.
     */
    function getPersonaTramite($idtramite)
    {

        $this->db->select("idpersonatramite, idpersona, idtramite, idfuncionario, fechaInicio, fechaFin, activo");
        $this->db->from("personatramite");
        $this->db->where("idtramite", $idtramite);
        $this->db->order_by('idpersonatramite','DESC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    /**
     * GetPersonaTramite.
     * @param $idactividad Id del PersonaTramite.
     * @return row_array con datos de un actividad.
     */
    function getTramiteIdFuncionario($idfuncionario)
    {

        $this->db->select("idpersonatramite, idpersona, idtramite, idfuncionario, fechaInicio, fechaFin, activo");
        $this->db->from("personatramite");
        $this->db->where("activo", 1);
        $this->db->where("idfuncionario", $idfuncionario);
        $this->db->order_by('idpersonatramite','DESC');
        //$this->db->limit(1);
        return $this->db->get()->result_array();
    }

    /**
     * GetPersonaTramite.
     * @param $idactividad Id del PersonaTramite.
     * @return row_array con datos de un actividad.
     */
    function getPersonaTramiteOld($idtramite)
    {

        $this->db->select("idpersonatramite, idpersona, idtramite, idfuncionario, fechaInicio, fechaFin, activo");
        $this->db->from("personatramite");
        $this->db->where("idtramite", $idtramite);
        $this->db->order_by('idpersonatramite','DESC');
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

    function sacaPersonaTramite($idpersona)
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

    function getUnidadTramite($idtramite, $idfuncionario)
    {


        $this->db->select('u.nombreunidad AS nombre');
        $this->db->FROM('personaunidad pu');
        $this->db->join('unidad u','u.idunidad=pu.idunidad','inner');
        $this->db->WHERE('pu.idtramite', $idtramite);
        $this->db->WHERE('pu.idpersona', $idfuncionario);
        $this->db->WHERE('u.estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->nombre;
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
     * GetAllPersonaTramiteCount.
     * @return entero Cantidad de actividads.
     */
    function getAllPersonaTramiteCount()
    {
        $this->db->select('count(idactividad) as contador');
        $this->db->from('actividad');
        $this->db->where('tipo_actividad','PersonaTramite');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllPersonaTramite.
     * @return result_array con datos de varios actividads.
     */
    function getAllPersonaTramite()
    {
        $this->db->order_by('idactividad', 'asc');       
        $this->db->where('estado', 1);  
        return $this->db->get('actividad')->result_array();
    }

    /**
     * AddPersonaTramite.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos actividad guardado.
     */
    function addPersonaTramite($params, $idtramite, $idfuncionario, $idfuncionarioNew)
    {
        $this->db->insert('personatramite',$params);

        return $this->db->insert_id();
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
     * GetPersonaTramitesReporte.
     * @return result con idactividad, nombre, direccion, telefono, email.
     */
    public function getPersonaTramitesReporte(){
        $this->db->select('idactividad, nombre, direccion, telefono, email');
        $this->db->from('actividad');
        $this->db->Where('tipoPersonaTramite','PersonaTramite');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
