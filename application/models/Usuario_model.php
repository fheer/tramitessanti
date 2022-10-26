<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    /**
     * Usuario_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetUsuario.
     * @param $idpersona Id.
     * @return row_array con datos de un usuario.
     */
    function getUsuario($key)
    {
        return $this->db->get_where('persona',array('key'=>$key))->row_array();
    }

    /**
     * GetUsuario.
     * @param $idpersona Id.
     * @return row_array con datos de un usuario.
     */
    function getUsuarioById($idpersona)
    {
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idpersona,nombre');
        $this->db->FROM('persona');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idpersona;
        }else{
            return 0;
        }
    }

    function validarCi($ci)
    {
        $this->db->select('idpersona,ci');
        $this->db->FROM('persona');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idpersona;
        }else{
            return 0;
        }
    }

    /**
     * GetAllUsuarioCount.
     * @return entero Cantidad de usuarios.
     */
    function getAllUsuarioCount()
    {
        $this->db->select('count(idpersona) as contador');
        $this->db->from('persona');
        $this->db->where('estado', 1);
        
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllUsuario.
     * @return result_array con datos de varios usuarios.
     */
    function getAllUsuario()
    {
        $this->db->order_by('idpersona', 'desc');
        $this->db->where('estado', 1);  
        return $this->db->get('persona')->result_array();
    }

    /**
     * TramitesActivos.
     * @return result_array con datos de varios usuarios.
     */
    function tramitesActivos($idfuncionario)
    {
        $this->db->order_by('fechaInicio', 'asc');       
        $this->db->where('idfuncionario', $idfuncionario);  
        $this->db->where('activo', 1);  
        return $this->db->get('personatramite')->result_array();
    }

    /**
     * TramitesActivos.
     * @return result_array con datos de varios usuarios.
     */
    function countTramitesActivos($idfuncionario)
    {
        $this->db->select('COUNT(idfuncionario) AS cantidad');
        $this->db->from('personatramite');
        $this->db->order_by('fechaInicio', 'asc');       
        $this->db->where('idfuncionario', $idfuncionario);  
        $this->db->where('activo', 1);  
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->cantidad;
        }else{
            return 0;
        }
    }

    /**
     * TramitesActivos.
     * @return result_array con datos de varios usuarios.
     */
    function tramitesActivosSolicitante($idpersona)
    {
        $this->db->order_by('fechaInicio', 'asc');       
        $this->db->where('idpersona', $idpersona);  
        $this->db->where('activo', 1);  
        return $this->db->get('personatramite')->result_array();
    }

    /**
     * TramitesActivos.
     * @return result_array con datos de varios usuarios.
     */
    function countTramitesActivosSolicitante($idpersona)
    {
        $this->db->select('COUNT(idpersona) AS cantidad');
        $this->db->from('personatramite');
        $this->db->order_by('fechaInicio', 'asc');       
        $this->db->where('idpersona', $idpersona);  
        $this->db->where('activo', 1);  
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->cantidad;
        }else{
            return 0;
        }
    }

    /**
     * AddUsuario.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos usuario guardado.
     */
    function addUsuario($params)
    {
        $this->db->insert('persona',$params);
        return $this->db->insert_id();
    }

    /**
     * AddUsuario.
     * @param $idpersona Id del usuario.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del usuario modificado
     */
    function updateUsuario($idpersona,$params)
    {
        $this->db->where('idpersona',$idpersona);
        return $this->db->update('persona',$params);
    }

    /**
     * CambiarEstado.
     * @param $idpersona Id del usuario.
     * @param $params estado 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idpersona,$params)
    {
        $this->db->where('idpersona',$idpersona);
        return $this->db->update('persona',$params);
    }

    /**
     * GetUsuariosReporte.
     * @return result con idpersona, nombre, direccion, telefono, email.
     */
    public function getUsuariosReporte(){
        $this->db->select('idpersona, nombre, direccion, telefono, email');
        $this->db->from('persona');
        $this->db->Where('tipoUsuario','Usuario');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }

    /**
     * GetAllUsuario.
     * @return result_array con datos de varios usuarios.
     */
    function getPermisoUsuario($idpersona, $idpermiso)
    {
        $this->db->order_by('idpermiso', 'asc');       
        $this->db->where('idpersona', $idpersona);
        $this->db->where('idpermiso', $idpermiso);  
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idpersona;
        }else{
            return 0;
        }
    }

    public function ingresar($user,$psw){
        $this->db->select("concat_ws(' ',ifnull(ApellidoPaterno, ''),ifnull(ApellidoMaterno, '')) as apellidos ,usuario, key, estado, idpersona, foto,permisos,clave,nombres, ci,key,tipoPersona");
        $this->db->FROM('persona');
        $this->db->WHERE('usuario',$user);
        $resultado = $this->db->get();
        $ru = $resultado->row();
        if ($resultado->num_rows() == 1) {
        $clave = $ru->clave;
        }else {
            return 0;
        }
        if (password_verify($psw, $clave))
        {
            $s_user = array(
                'idpersona' => $ru->idpersona,
                'ci' => $ru->ci,
                'nomUser' => $ru->nombres,
                'apUser' => $ru->apellidos,
                'foto' => $ru->foto,
                'tipo' => $ru->tipoPersona,
                'idusuario' => $ru->idpersona,
                'token' => $ru->key,
                'logueado' => TRUE
            );
            $this->session->set_userdata($s_user);
            return 1;

        }else{
            return 0;
        }
    }

}
