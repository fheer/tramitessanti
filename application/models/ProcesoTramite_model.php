<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcesoTramite_model extends CI_Model
{
    /**
     * ProcesoTramite_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetProcesoTramite.
     * @param $idtramite Id de ProcesoTramite por key.
     * @return row_array con datos de un tramite.
     */
    function getProcesoTramite($key)
    {
        return $this->db->get_where('tramite',array('key'=>$key))->row_array();
    }

    /**
     * GetProcesoTramite.
     * @param $idtramite Id de ProcesoTramite por key.
     * @return row_array con datos de un tramite.
     */
    function getDocsTramite($idtramite)
    {
        return $this->db->get_where('requisitoimagen',array('idtramite'=>$idtramite))->result_array();
    }

    /**
     * GetProcesoTramite. revisar si se esta utilizando
     * @param $idtramite Id del ProcesoTramite por idtramite.
     * @return row_array con datos de un tramite.
     */
    function getProcesoTramiteId($idtramite)
    {
        //$this->db->select("idtramite, codigo, fechaInicio, fechaFin, idtipotramite");
        return $this->db->get_where('tramite',array('idtramite'=>$idtramite))->row_array();
    }

    /**
     * GetProcesoTramite.
     * @param $idtramite Id del ProcesoTramite por idtramite.
     * @return row_array con datos de un tramite.
     */
    /*
    function getProcesoTramiteId($idtramite)
    {
        $this->db->select("t.idtramite, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto, genero, estadoCivil, fechaNacimiento, tipoProcesoTramite, direccion, telefono, celular, key, estado, idexpedido");
        $this->db->from('tramite t');
        $this->db->join('personatramite pt','pt.idtramite=t.idtramite');
        $this->db->join('persona p','p.idpersona=pt.idpersona');
        $this->db->
        $this->db->
        $this->db->
        $this->db->
        return $this->db->get_where('tramite',array('idtramite'=>$idtramite))->row_array();
    }
    */

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

    /**
     * AddPersonaTramite.
     * @param $idactividad Id del actividad.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del actividad modificado
     */
    function updatePersonaTramite($idpersonatramite,$params)
    {
        $this->db->where('idpersonatramite',$idpersonatramite);
        
        return $this->db->update('personatramite',$params);
    }
    
    /**
     * GetProcesoTramite.
     * @param $idtramite Id del ProcesoTramite por idtramite.
     * @return row_array con datos de un tramite.
     */
    function getObservacionesId($idtramite)
    {
        $this->db->select("idtramite, idobservacion, observaciones");
        return $this->db->get_where('observacion',array('idtramite'=>$idtramite))->result_array();
    }

    /**
     * GetProcesoTramite.
     * @param $idtramite Id del ProcesoTramite por idtramite.
     * @return row_array con datos de un tramite.
     */
    function getIdPersonaByIdTramite($idtramite)
    {
       //$this->db->select("idtramite, idobservacion, observaciones");
        return $this->db->get_where('personatramite',array('idtramite'=>$idtramite))->result_array();
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

    function validarCi($ci)
    {
        $this->db->select('idtramite,ci');
        $this->db->FROM('tramite');
        $this->db->WHERE('ci', $ci);
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
     * GetAllProcesoTramiteCount.
     * @return entero Cantidad de tramites.
     */
    function getAllProcesoTramiteCount($idtipotramite)
    {
        $this->db->select('count(idtramite) as contador');
        $this->db->from('tramite');
        $this->db->where('idtipotramite',$idtipotramite);
        $resultado = $this->db->get();
        if ($resultado->num_rows()>0) {
            $r = $resultado->row();
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllProcesoTramiteCount.
     * @return entero Cantidad de tramites.
     */
    function countAllProcesoTramite()
    {
        $this->db->select('count(idtramite) as contador');
        $this->db->from('tramite');
        $this->db->where('estado',1);
        $resultado = $this->db->get();
        if ($resultado->num_rows()>0) {
            $r = $resultado->row();
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllProcesoTramiteCount.
     * @return entero Cantidad de tramites.
     */
    function countAllProcesoTramiteFinalizado()
    {
        $this->db->select('count(idtramite) as contador');
        $this->db->from('tramite');
        $this->db->where('estado',0);
        $resultado = $this->db->get();
        if ($resultado->num_rows()>0) {
            $r = $resultado->row();
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllProcesoTramite($opcion)
    {
        if ($opcion==1) {
            $this->db->where('estado', 1);
        }else{
            $this->db->where('estado', 0);
        }
        $this->db->order_by('estado', 'desc');       
        return $this->db->get('tramite')->result_array();
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllTramiteFechas($de, $hasta)
    {

        $this->db->select("COUNT(estado) AS cantidad , IF(estado=0, 'Aprobados', 'En curso') AS estado");
        $this->db->where('fechaInicio>=', $de);
        $this->db->where('fechaInicio<=', $hasta);
        $this->db->group_by('estado');
        return $this->db->get('tramite')->result_array();        
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getTipoTramiteFechas($de, $hasta)
    {

        $this->db->select("COUNT(t.idtipotramite) AS cantidad , tt.nombreRequisito AS tipoTramite");
        $this->db->from('tramite t');
        $this->db->join('tipotramite tt', 'ON tt.idtipotramite=t.idtipotramite');
        $this->db->where('fechaInicio>=', $de);
        $this->db->where('fechaInicio<=', $hasta);
        $this->db->group_by('t.idtipotramite');
        return $this->db->get()->result_array();        
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllTramiteFechasActivo($opcion, $de, $hasta)
    {
        $this->db->select('COUNT(idtramite) AS terminado, fechaInicio');
        $this->db->where('fechaInicio>=', $de);
        $this->db->where('fechaInicio<=', $hasta);
        $this->db->where('estado', 1);
        $this->db->order_by('fechaInicio', 'desc');
        return $this->db->get('tramite')->result_array();
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllTramiteFase($fase, $de, $hasta)
    {
        ///*
        $this->db->from('tramite t');
        $this->db->join('personatramite pt','t.idtramite=pt.idtramite');
        $this->db->where('pt.fase', $fase);
        $this->db->where('t.fechaInicio BETWEEN "'.$de. '" and "'.$hasta.'"');

        return $this->db->get()->result_array();
        //*/
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllProcesoTramiteByEstado($estado)
    {
        $this->db->where('estado', $estado);
        $this->db->order_by('estado', 'desc');       
        return $this->db->get('tramite')->result_array();
    }

    function procesoTramiteById($idpersona)
    {
        $this->db->from('personatramite pt');
        $this->db->join('tramite t', 't.idtramite=pt.idtramite', 'inner');
        $this->db->join('persona p', 'p.idpersona=pt.idpersona', 'inner');
        $this->db->where('pt.idpersona',$idpersona);
        return $this->db->get()->result_array();
    }

    function procesoTramiteByIdPersonaIdtramite($idpersona, $idtramite)
    {
        $this->db->from('personatramite pt');
        $this->db->join('tramite t', 't.idtramite=pt.idtramite', 'inner');
        $this->db->join('persona p', 'p.idpersona=pt.idpersona', 'inner');
        $this->db->where('pt.idpersona',$idpersona);
        $this->db->where('pt.idtramite',$idtramite);
        return $this->db->get()->result_array();
    }

    function procesoOnlyTramiteById($idpersona)
    {
        $this->db->select('DISTINCT(pt.idtramite)');
        $this->db->from('personatramite pt');
        //$this->db->where('activo',1);
        $this->db->where('pt.idpersona',$idpersona);

        return $this->db->get()->result_array();
    }

    function procesoTramiteByCodigo($codigo)
    {

        $this->db->from('personatramite pt');
        $this->db->join('tramite t', 't.idtramite=pt.idtramite', 'inner');
        $this->db->join('persona p', 'p.idpersona=pt.idpersona', 'inner');
        $this->db->where('t.codigo',$codigo);
        return $this->db->get()->result_array();
    }

    function procesoTramiteByIdBitacora($idtramite)
    {

        $this->db->from('personatramite pt');
        $this->db->join('tramite t', 't.idtramite=pt.idtramite', 'inner');
        $this->db->join('persona p', 'p.idpersona=pt.idpersona', 'inner');
        $this->db->where('t.idtramite',$idtramite);
        return $this->db->get()->result_array();
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getAllProcesoTramiteFullName($tipoProcesoTramite)
    {
        $this->db->select("idtramite, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto ");
        $this->db->from('tramite p');
        $this->db->join('usuario u','idtramite<>u.idtramite');
        $this->db->order_by('apellidoPaterno', 'asc');
        $this->db->order_by('apellidoMaterno', 'asc');  
        $this->db->where('tipoProcesoTramite', $tipoProcesoTramite);  
        $this->db->where('estado', 1);
        return $this->db->get('tramite')->result_array();
    }

    /**
     * GetAllProcesoTramite.
     * @return result_array con datos de varios tramites.
     */
    function getTodasProcesoTramitesFullName()
    {
        $this->db->select("idtramite, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto ");
        $this->db->from('tramite');
        $this->db->order_by('apellidoPaterno', 'asc');
        $this->db->order_by('apellidoMaterno', 'asc');  
        $this->db->where('estado', 1);
        return $this->db->get('tramite')->result_array();
    }

    /**
     * AddProcesoTramite.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos tramite guardado.
     */
    function addProcesoTramite($params, $idfuncionario, $idfuncionarioNew, $idpersona, $fechaInicio, $fechaFin, $fase,$iddatotecnico)
                            //($idtramite,$params, $observaciones)
    {
        $this->db->trans_begin();
        $this->db->insert('tramite',$params);
        
        $idtramite = $this->db->insert_id();
        
        $paramsPersonaTramite = array(
            'idpersona' => $idpersona,
            'idtramite' => $idtramite,
            'idfuncionario' => $idfuncionarioNew,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'fase' => $fase,
            'activo' => 1,
        );
        
        $this->db->insert('personatramite',$paramsPersonaTramite);

        /*
        $paramsPersonaTramite = array(
            'idpersona' => $idpersona,
            'idtramite' => $idtramite,
            'idfuncionario' => $idfuncionarioNew,
            'fechaInicio' => $fechaInicio,
        );
        $this->db->insert('personatramite',$paramsPersonaTramite);
        */
        $originalDate = $fechaInicio;
        $newDate = date("d/m/Y", strtotime($originalDate));
        $observaciones = 'Inicio trámite Fecha: '.$newDate;
        $paramsTramiteObservacion = array(
            'idtramite' => $idtramite,
            'observaciones' => $observaciones,
        );
        $this->db->insert('observacion',$paramsTramiteObservacion);

        $formData = array(
            'estado' => 0,
        );

        $this->db->where('iddatotecnico',$iddatotecnico);
        $this->db->update('datotecnico',$formData);

        if ($this->db->trans_status() === FALSE){
            //Hubo errores en la consulta, entonces se cancela la transacción.
            $this->db->trans_rollback();
            return 0;
        }else{
            //Todas las consultas se hicieron correctamente.
            $this->db->trans_commit();
            return $idtramite;
        }    
    }

    function addImages($params)
    {
        $this->db->insert('requisitoimagen',$params);
        return $this->db->insert_id();
    }

    function recuperarImages($idtramite, $idrequisito)
    {
        //$this->db->
        return $this->db->get_where('requisitoimagen',array('idtramite'=>$idtramite, 'idrequisito'=>$idrequisito))->row_array();
    }

    /**
     * UpdateProcesoTramite.
     * @param $idtramite Id del tramite.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del tramite modificado
     */
    function updateProcesoTramite($idtramite, $params, $idfuncionario, $idpersona, $fechaInicio, $fechaFin)
    {
                     
        $this->db->trans_begin();

        $this->db->where('idtramite',$idtramite);
        $this->db->update('tramite',$params);
        //*/   
        
        $originalDate = date('Y-m-d');
        $newDate = date("d/m/Y", strtotime($originalDate));
        $observaciones = 'Se realizo una actualización en su tramite en fecha : '.$newDate;
      
        $paramsTramiteObservacion = array(
            'idtramite' => $idtramite,
            'observaciones' => $observaciones,
        );
        $this->db->insert('observacion',$paramsTramiteObservacion);

        if ($this->db->trans_status() === FALSE){
            //Hubo errores en la consulta, entonces se cancela la transacción.
            $this->db->trans_rollback();
            return 0;
        }else{
            //Todas las consultas se hicieron correctamente.
            $this->db->trans_commit();
            return $idtramite;
        }
        //*/
    }

    /**
     * UpdateProcesoTramite.
     * @param $idtramite Id del tramite.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del tramite modificado
     */
    function updatePTTerminado($idtramite, $params)
    {

        $this->db->trans_begin();

        $this->db->where('idtramite',$idtramite);
        $this->db->update('tramite',$params);
        //*/

        if ($this->db->trans_status() === FALSE){
            //Hubo errores en la consulta, entonces se cancela la transacción.
            $this->db->trans_rollback();
            return 0;
        }else{
            //Todas las consultas se hicieron correctamente.
            $this->db->trans_commit();
            return $idtramite;
        }
        //*/
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
     * GetProcesoTramitesReporte.
     * @return result con idtramite, nombre, direccion, telefono, email.
     */
    public function getProcesoTramitesReporte(){
        $this->db->select('idtramite, nombre, direccion, telefono, email');
        $this->db->from('tramite');
        $this->db->Where('tipoProcesoTramite','ProcesoTramite');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }

    
}
