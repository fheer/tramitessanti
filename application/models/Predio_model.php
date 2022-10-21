<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predio_model extends CI_Model
{
    /**
     * Predio_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetPredio.
     * @param $idpredio Id del Predio.
     * @return row_array con datos de un predio.
     */
    function getPredio($idpredio)
    {
        return $this->db->get_where('predio',array('idpredio'=>$idpredio))->row_array();
    }

    /**
     * GetPredio.
     * @param $idpredio Id del Predio.
     * @return row_array con datos de un predio.
     */
    function getPredioByCodigoCatastral($codigocatastral)
    {
        return $this->db->get_where('predio',array('codigocatastral'=>$codigocatastral))->row_array();
    }

    function sacaPredio($idpersona)
    {

        $this->db->select('c.predio as actividad');
        $this->db->FROM('predio c');
        $this->db->join('persona p','c.idpredio=c.idpredio','inner');
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
        $this->db->select('idpredio,ci');
        $this->db->FROM('predio');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return $r->idpredio;
        }else{
            return 0;
        }
    }

    /**
     * GetAllPredioCount.
     * @return entero Cantidad de predios.
     */
    function getAllPredioCount()
    {
        $this->db->select('count(idpredio) as contador');
        $this->db->from('predio');
        $this->db->where('tipo_predio','Predio');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllPredio.
     * @return result_array con datos de varios predios.
     */
    function getAllPredio()
    {
        $this->db->order_by('idpredio', 'asc');
        return $this->db->get('predio')->result_array();
    }

    /**
     * AddPredio.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos predio guardado.
     */
    function addPredio($params)
    {
        $this->db->insert('predio',$params);
        return $this->db->insert_id();
    }

    /**
     * AddPredio.
     * @param $idpredio Id del predio.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del predio modificado
     */
    function updatePredio($idpredio,$params)
    {
        $this->db->where('idpredio',$idpredio);
        return $this->db->update('predio',$params);
    }

    /**
     * CambiarEstado.
     * @param $idpredio Id del predio.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idpredio,$params)
    {
        $this->db->where('idpredio',$idpredio);
        return $this->db->update('predio',$params);
    }

    /**
     * GetPrediosReporte.
     * @return result con idpredio, nombre, direccion, telefono, email.
     */
    public function getPrediosReporte(){
        $this->db->select('idpredio, nombre, direccion, telefono, email');
        $this->db->from('predio');
        $this->db->Where('tipoPredio','Predio');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
