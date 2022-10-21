<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caracteristica_model extends CI_Model
{
    /**
     * Caracteristica_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetCaracteristica.
     * @param $idcaracteristica Id del Caracteristica.
     * @return row_array con datos de un caracteristica.
     */
    function getCaracteristica($idcaracteristica)
    {
        return $this->db->get_where('caracteristica',array('idcaracteristica'=>$idcaracteristica))->row_array();
    }

    function sacaCaracteristica($idpersona)
    {

        $this->db->select('c.caracteristica as actividad');
        $this->db->FROM('caracteristica c');
        $this->db->join('persona p','c.idcaracteristica=c.idcaracteristica','inner');
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
        $this->db->select('idcaracteristica,ci');
        $this->db->FROM('caracteristica');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return $r->idcaracteristica;
        }else{
            return 0;
        }
    }

    /**
     * GetAllCaracteristicaCount.
     * @return entero Cantidad de caracteristicas.
     */
    function getAllCaracteristicaCount()
    {
        $this->db->select('count(idcaracteristica) as contador');
        $this->db->from('caracteristica');
        $this->db->where('tipo_caracteristica','Caracteristica');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllCaracteristica.
     * @return result_array con datos de varios caracteristicas.
     */
    function getAllCaracteristica()
    {
        $this->db->order_by('idcaracteristica', 'asc');
        $this->db->where('idcaracteristica<>', 5);
        return $this->db->get('caracteristica')->result_array();
    }

    /**
     * AddCaracteristica.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos caracteristica guardado.
     */
    function addCaracteristica($params)
    {
        $this->db->insert('caracteristica',$params);
        return $this->db->insert_id();
    }

    /**
     * AddCaracteristica.
     * @param $idcaracteristica Id del caracteristica.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del caracteristica modificado
     */
    function updateCaracteristica($idcaracteristica,$params)
    {
        $this->db->where('idcaracteristica',$idcaracteristica);
        return $this->db->update('caracteristica',$params);
    }

    /**
     * CambiarEstado.
     * @param $idcaracteristica Id del caracteristica.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idcaracteristica,$params)
    {
        $this->db->where('idcaracteristica',$idcaracteristica);
        return $this->db->update('caracteristica',$params);
    }

    /**
     * GetCaracteristicasReporte.
     * @return result con idcaracteristica, nombre, direccion, telefono, email.
     */
    public function getCaracteristicasReporte(){
        $this->db->select('idcaracteristica, nombre, direccion, telefono, email');
        $this->db->from('caracteristica');
        $this->db->Where('tipoCaracteristica','Caracteristica');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
