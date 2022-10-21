<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo_model extends CI_Model
{
    /**
     * Cargo_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetCargo.
     * @param $idcargo Id del Cargo.
     * @return row_array con datos de un cargo.
     */
    function getCargo($idcargo)
    {
        return $this->db->get_where('cargo',array('idcargo'=>$idcargo))->row_array();
    }

    function sacaCargo($idpersona)
    {

        $this->db->select('c.cargo as actividad');
        $this->db->FROM('cargo c');
        $this->db->join('persona p','c.idcargo=c.idcargo','inner');
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

    function validarCi($ci)
    {
        $this->db->select('idcargo,ci');
        $this->db->FROM('cargo');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idcargo;
        }else{
            return 0;
        }
    }

    /**
     * GetAllCargoCount.
     * @return entero Cantidad de cargos.
     */
    function getAllCargoCount()
    {
        $this->db->select('count(idcargo) as contador');
        $this->db->from('cargo');
        $this->db->where('tipo_cargo','Cargo');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllCargo.
     * @return result_array con datos de varios cargos.
     */
    function getAllCargo()
    {
        $this->db->order_by('idcargo', 'asc');       
        $this->db->where('idcargo<>', 5);  
        return $this->db->get('cargo')->result_array();
    }

    /**
     * AddCargo.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos cargo guardado.
     */
    function addCargo($params)
    {
        $this->db->insert('cargo',$params);
        return $this->db->insert_id();
    }

    /**
     * AddCargo.
     * @param $idcargo Id del cargo.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del cargo modificado
     */
    function updateCargo($idcargo,$params)
    {
        $this->db->where('idcargo',$idcargo);
        return $this->db->update('cargo',$params);
    }

    /**
     * CambiarEstado.
     * @param $idcargo Id del cargo.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idcargo,$params)
    {
        $this->db->where('idcargo',$idcargo);
        return $this->db->update('cargo',$params);
    }

    /**
     * GetCargosReporte.
     * @return result con idcargo, nombre, direccion, telefono, email.
     */
    public function getCargosReporte(){
        $this->db->select('idcargo, nombre, direccion, telefono, email');
        $this->db->from('cargo');
        $this->db->Where('tipoCargo','Cargo');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
