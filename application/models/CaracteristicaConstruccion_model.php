<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CaracteristicaConstruccion_model extends CI_Model
{
    /**
     * CaracteristicaConstruccion_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetCaracteristicaConstruccion.
     * @param $idcaracteristicaconstruccion Id del CaracteristicaConstruccion.
     * @return row_array con datos de un caracteristicaconstruccion.
     */
    function getCaracteristicaConstruccion($idcaracteristicaconstruccion)
    {
        return $this->db->get_where('caracteristicaconstruccion',array('idcaracteristicaconstruccion'=>$idcaracteristicaconstruccion))->row_array();
    }

    /**
     * GetAllCaracteristicaConstruccion.
     * @return result_array con datos de varios caracteristicaconstruccions.
     */
    function getCaracteristicaConstruccionByCatasral($codigocatastral)
    {
        $this->db->where('codigocatastral', $codigocatastral);
        return $this->db->get('caracteristicaconstruccion')->result_array();
    }

    function sacaCaracteristicaConstruccion($idpersona)
    {

        $this->db->select('c.caracteristicaconstruccion as actividad');
        $this->db->FROM('caracteristicaconstruccion c');
        $this->db->join('persona p','c.idcaracteristicaconstruccion=c.idcaracteristicaconstruccion','inner');
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
        $this->db->select('idcaracteristicaconstruccion,ci');
        $this->db->FROM('caracteristicaconstruccion');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return $r->idcaracteristicaconstruccion;
        }else{
            return 0;
        }
    }

    /**
     * GetAllCaracteristicaConstruccionCount.
     * @return entero Cantidad de caracteristicaconstruccions.
     */
    function getAllCaracteristicaConstruccionCount()
    {
        $this->db->select('count(idcaracteristicaconstruccion) as contador');
        $this->db->from('caracteristicaconstruccion');
        $this->db->where('tipo_caracteristicaconstruccion','CaracteristicaConstruccion');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllCaracteristicaConstruccion.
     * @return result_array con datos de varios caracteristicaconstruccions.
     */
    function getAllCaracteristicaConstruccion()
    {
        $this->db->order_by('idcaracteristicaconstruccion', 'asc');
        $this->db->where('idcaracteristicaconstruccion<>', 5);
        return $this->db->get('caracteristicaconstruccion')->result_array();
    }

    /**
     * AddCaracteristicaConstruccion.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos caracteristicaconstruccion guardado.
     */
    function addCaracteristicaConstruccion($params)
    {
        $this->db->insert('caracteristicaconstruccion',$params);
        return $this->db->insert_id();
    }

    /**
     * AddCaracteristicaConstruccion.
     * @param $idcaracteristicaconstruccion Id del caracteristicaconstruccion.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del caracteristicaconstruccion modificado
     */
    function updateCaracteristicaConstruccion($idcaracteristicaconstruccion,$params)
    {
        $this->db->where('idcaracteristicaconstruccion',$idcaracteristicaconstruccion);
        return $this->db->update('caracteristicaconstruccion',$params);
    }

    /**
     * CambiarEstado.
     * @param $idcaracteristicaconstruccion Id del caracteristicaconstruccion.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idcaracteristicaconstruccion,$params)
    {
        $this->db->where('idcaracteristicaconstruccion',$idcaracteristicaconstruccion);
        return $this->db->update('caracteristicaconstruccion',$params);
    }

    /**
     * GetCaracteristicaConstruccionsReporte.
     * @return result con idcaracteristicaconstruccion, nombre, direccion, telefono, email.
     */
    public function getCaracteristicaConstruccionsReporte(){
        $this->db->select('idcaracteristicaconstruccion, nombre, direccion, telefono, email');
        $this->db->from('caracteristicaconstruccion');
        $this->db->Where('tipoCaracteristicaConstruccion','CaracteristicaConstruccion');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
