<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatosTecnicos_model extends CI_Model
{
    /**
     * DatosTecnicos_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetDatosTecnicos.
     * @param $iddatotecnico Id del DatosTecnicos.
     * @return row_array con datos de un datotecnico.
     */
    function getDatosTecnicos($iddatotecnico)
    {
        return $this->db->get_where('datotecnico',array('iddatotecnico'=>$iddatotecnico))->row_array();
    }

    function sacaDatosTecnicos($iddatotecnico)
    {

        $this->db->select('c.datotecnico as actividad');
        $this->db->FROM('datotecnico c');
        $this->db->join('persona p','c.iddatotecnico=c.iddatotecnico','inner');
        $this->db->WHERE('p.iddatotecnico', $iddatotecnico);
        $this->db->WHERE('p.estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return $r->actividad;
        }else{
            return '';
        }
    }

    /**
     * GetAllDatosTecnicosCount.
     * @return entero Cantidad de datotecnicos.
     */
    function getAllDatosTecnicosCount()
    {
        $this->db->select('count(iddatotecnico) as contador');
        $this->db->from('datotecnico');
        $this->db->where('tipo_datotecnico','DatosTecnicos');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllDatosTecnicos.
     * @return result_array con datos de varios datotecnicos.
     */
    function getAllDatosTecnicos()
    {
        $this->db->order_by('iddatotecnico', 'asc');
        $this->db->where('iddatotecnico<>', 5);
        return $this->db->get('datotecnico')->result_array();
    }

    /**
     * AddDatosTecnicos.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos datotecnico guardado.
     */
    function addDatosTecnicos($params)
    {
        $this->db->insert('datotecnico',$params);
        return $this->db->insert_id();
    }

    /**
     * AddDatosTecnicos.
     * @param $iddatotecnico Id del datotecnico.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del datotecnico modificado
     */
    function updateDatosTecnicos($iddatotecnico,$params)
    {
        $this->db->where('iddatotecnico',$iddatotecnico);
        return $this->db->update('datotecnico',$params);
    }

    /**
     * CambiarEstado.
     * @param $iddatotecnico Id del datotecnico.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($iddatotecnico,$params)
    {
        $this->db->where('iddatotecnico',$iddatotecnico);
        return $this->db->update('datotecnico',$params);
    }

    /**
     * GetDatosTecnicossReporte.
     * @return result con iddatotecnico, nombre, direccion, telefono, email.
     */
    public function getDatosTecnicosReporte($iddatotecnico, $idpersona){
        $this->db->select('iddatotecnico, tipotramite, fecha,zona, direccion, manzano, predio, avaluo,codigo,distrito,subdistrito');
        $this->db->Where('iddatotecnico',$iddatotecnico);
        $this->db->Where('idpersona',$idpersona);
        return $this->db->get('datotecnico')->row_array();
    }
}
