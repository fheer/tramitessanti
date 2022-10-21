<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expedido_model extends CI_Model
{
    /**
     * Expedido_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetExpedido.
     * @param $idexpedido Id del Expedido.
     * @return row_array con datos de un expedido.
     */
    function getExpedido($idexpedido)
    {
        return $this->db->get_where('expedido',array('idexpedido'=>$idexpedido))->row_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idexpedido,nombre');
        $this->db->FROM('expedido');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idexpedido;
        }else{
            return 0;
        }
    }

    function validarCi($num_documento)
    {
        $this->db->select('idexpedido,num_documento');
        $this->db->FROM('expedido');
        $this->db->WHERE('num_documento', $num_documento);
        $this->db->WHERE('condicion', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idexpedido;
        }else{
            return 0;
        }
    }

    /**
     * GetAllExpedidoCount.
     * @return entero Cantidad de expedidos.
     */
    function getAllExpedidoCount()
    {
        $this->db->select('count(idexpedido) as contador');
        $this->db->from('expedido');
        $this->db->where('tipo_expedido','Expedido');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllExpedido.
     * @return result_array con datos de varios expedidos.
     */
    function getAllExpedido()
    {
        $this->db->order_by('idexpedido', 'asc');       
        //$this->db->where('estado', 1);  
        return $this->db->get('expedido')->result_array();
    }

    /**
     * AddExpedido.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos expedido guardado.
     */
    function addExpedido($params)
    {
        $this->db->insert('expedido',$params);
        return $this->db->insert_id();
    }

    /**
     * AddExpedido.
     * @param $idexpedido Id del expedido.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del expedido modificado
     */
    function updateExpedido($idexpedido,$params)
    {
        $this->db->where('idexpedido',$idexpedido);
        return $this->db->update('expedido',$params);
    }

    /**
     * CambiarEstado.
     * @param $idexpedido Id del expedido.
     * @param $params condicion 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idexpedido,$params)
    {
        $this->db->where('idexpedido',$idexpedido);
        return $this->db->update('expedido',$params);
    }

    /**
     * GetExpedidosReporte.
     * @return result con idexpedido, nombre, direccion, telefono, email.
     */
    public function getExpedidosReporte(){
        $this->db->select('idexpedido, nombre, direccion, telefono, email');
        $this->db->from('expedido');
        $this->db->Where('tipoExpedido','Expedido');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
