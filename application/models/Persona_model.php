<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model
{
    /**
     * Persona_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    function getPersonaTramite($idtramite)
    {
        $this->db->where('idtramite', $idtramite);
        return $this->db->get('personatramite')->row_array();
    }

    function getIdPersonaTramite($idtramite)
    {
        $this->db->select('DISTINCT(idpersona)');
        $this->db->from('personatramite');
        $this->db->where('idtramite', $idtramite);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idpersona;
        }else{
            return 0;
        }
        
    }

    function getPersonaTramiteById($idtramite)
    {
        $this->db->select('idpersona, idfuncionario, idtramite, idpersonatramite');
        $this->db->from('personatramite');
        $this->db->where('idtramite', $idtramite);
        $this->db->order_by('idpersonatramite DESC');
        //$this->db->limit(1,1);
        //print_r($this->db->get()->row_array());
        return $this->db->get()->row_array();
    }

    /**
     * GetPersona.
     * @param $idpersona Id de Persona por key.
     * @return row_array con datos de un persona.
     */
    function getPersona($key)
    {
        return $this->db->get_where('persona',array('key'=>$key))->row_array();
    }

    /**
     * GetPersona.
     * @param $idpersona Id de Persona por key.
     * @return row_array con datos de un persona.
     */
    function getPersonaById($idpredio)
    {
        return $this->db->get_where('persona',array('idpredio'=>$idpredio))->row_array();
    }

    /**
     * GetPersona.
     * @param $idpersona Id del Persona por idpersona.
     * @return row_array con datos de un persona.
     */
    function getPersonaId($idpersona)
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto,nombres, apellidoPaterno, apellidoMaterno, ci, genero, estadoCivil, fechaNacimiento, tipoPersona, direccion, telefono, celular, key, estado, idexpedido");
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    /**
     * GetPersona.
     * @param $idpersona Id del Persona por idpersona.
     * @return row_array con datos de un persona.
     */
    function getPersonaByIdfuncionario($idpersona)
    {
        $this->db->select("p.idpersona, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto,p.nombres, p.apellidoPaterno, p.apellidoMaterno, p.ci, p.genero, p.estadoCivil, p.fechaNacimiento, p.tipoPersona, p.direccion, p.telefono, p.celular, p.key, p.estado, p.idexpedido, idactividad, idcargo");
        $this->db->from('persona p');
        $this->db->where('p.idpersona',$idpersona);
        return $this->db->get()->row_array();
    }

    /**
     * GetPersona.
     * @param $idpersona Id del Persona por idpersona.
     * @return row_array con datos de un persona.
     */
    function getUnidadIdfuncionario($idpersona)
    {
        $this->db->select("p.idpersona, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto,p.nombres, p.apellidoPaterno, p.apellidoMaterno, p.ci, p.genero, p.estadoCivil, p.fechaNacimiento, p.tipoPersona, p.direccion, p.telefono, p.celular, p.key, p.estado, p.idexpedido, idactividad, idcargo");
        $this->db->from('usuario u');
        $this->db->join('persona p','p.idpersona=p.idpersona','inner');
        $this->db->where('p.p.idpersona',$idpersona);
        return $this->db->get()->row_array();
    }

    function getPersonaCI($ci)
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto,nombres, apellidoPaterno, apellidoMaterno, ci, genero, estadoCivil, fechaNacimiento, tipoPersona, direccion, telefono, celular, key, estado, idexpedido");
        return $this->db->get_where('persona',array('ci'=>$ci))->row_array();
    }

    function getPersonaByApellido($apellido)
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto");
        $this->db->like('apellidoPaterno',$apellido);
        $this->db->like('apellidoMaterno',$apellido);
        return $this->db->get('persona',array('ci'=>$ci))->result_array();
    }

    function getPersonaHojaById($idpersona)
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto,nombres, apellidoPaterno, apellidoMaterno, ci, genero, estadoCivil, fechaNacimiento, tipoPersona, direccion, telefono, celular, key, estado, idexpedido");
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    function getDatosfuncionarioUsuario($idfuncionario)
    {
        $this->db->Select('p.idpersona');
        $this->db->from('persona p');
        $this->db->where('p.idpersona', $idfuncionario);
        $this->db->where('p.estado', 1);
        return $this->db->get()->row_array();
    }

    function getPersonaByIdUsuario($idusuario)
    {
        $this->db->select("p.idpersona, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto, p.ci, p.genero, p.estadoCivil, p.fechaNacimiento, p.tipoPersona, p.direccion, p.telefono, p.celular, p.key, p.estado, p.idexpedido");
        $this->db->from('persona p');
        $this->db->where('p.idpersona', $idusuario);
        return $this->db->get()->row_array();
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
     * GetAllPersonaCount.
     * @return entero Cantidad de personas.
     */
    function getSolicitanteCount()
    {
        $this->db->select('count(idpersona) as contador');
        $this->db->from('persona');
        $this->db->where('tipoPersona',1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllPersonaCount.
     * @return entero Cantidad de personas.
     */
    function getFuncionarioCount()
    {
        $this->db->select('count(idpersona) as contador');
        $this->db->from('persona');
        $this->db->where('tipoPersona',2);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->contador;
        }else{
            return 0;
        }
    }

    /**
     * GetAllPersona.
     * @return result_array con datos de varios personas.
     */
    function getAllPersona($tipoPersona)
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto, genero, estadoCivil, fechaNacimiento, tipoPersona, direccion, telefono, celular, key, estado, idexpedido, idcargo");
        $this->db->order_by('idpersona', 'desc');       
        $this->db->where('tipoPersona', $tipoPersona);  
        //$this->db->where('estado', 1);
        return $this->db->get('persona')->result_array();
    }

    /**
     * GetAllPersona.
     * @return result_array con datos de varios personas.
     */
    function getAllPersonaReporte()
    {
        $this->db->select("idpersona, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto, genero, estadoCivil, fechaNacimiento, tipoPersona, direccion, telefono, celular, key, estado, idexpedido");
        $this->db->order_by('idpersona', 'desc');       
        $this->db->where('tipoPersona', 1);  
        $this->db->where('estado', 1);
        return $this->db->get('persona')->result_array();
    }

    /**
     * GetAllPersona.
     * @return result_array con datos de varios personas.
     */
    function getAllPersonaFullName($tipoPersona)
    {
        $this->db->select("p.idpersona, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto ");
        $this->db->from('persona p');
        $this->db->join('usuario u','p.idpersona<>p.idpersona');
        $this->db->order_by('p.apellidoPaterno', 'asc');
        $this->db->order_by('p.apellidoMaterno', 'asc');  
        $this->db->where('p.tipoPersona', $tipoPersona);  
        $this->db->where('p.estado', 1);
        return $this->db->get()->result_array();
    }

    /**
     * GetAllPersona.
     * @return result_array con datos de varios personas.
     */
    function getTodasPersonasFullName()
    {
        $this->db->select("idpersona,ci, concat_ws(' ',nombres,IFNULL(apellidoPaterno, ''),IFNULL(apellidoMaterno, '')) as nombreCompleto ");
        $this->db->order_by('apellidoPaterno', 'asc');
        $this->db->order_by('apellidoMaterno', 'asc');  
        $this->db->where('estado', 1);
        return $this->db->get('persona')->result_array();
    }

    /**
     * AddPersona.
     * @param $params Datos de los campos de la base de datos y su valor a guardar.
     * @return Id del ultimos persona guardado.
     */
    function addPersona($params)
    {
        $this->db->trans_begin();
        $this->db->insert('persona',$params);
        $idpersona = $this->db->insert_id();
        
        if ($this->db->trans_status() === FALSE){
            //Hubo errores en la consulta, entonces se cancela la transacción.
            $this->db->trans_rollback();
            return 0;
        }else{
            //Todas las consultas se hicieron correctamente.
            $this->db->trans_commit();
            return $idpersona;
        }
    }

    /**
     * guardarUsuario.
     * @param $idpersona Id del persona.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del usuario registrado
     */
    function guardarUsuario($idpersona,$user, $psw, $keyUsuario, $permiso)
    {
        $paramsUsuario = array(
            'idpersona' => $idpersona,
            'usuario' => $user,
            'clave' => $psw,
            'key' => $keyUsuario,
            'permisos' => MD5($permiso).'#',
            );
        $this->db->insert('usuario',$paramsUsuario);
        return $this->db->insert_id();
    }

    /**
     * AddPersona.
     * @param $idpersona Id del persona.
     * @param $params Datos de los campos de la base de datos y su valor a modificar.
     * @return Id del persona modificado
     */
    function updatePersona($idpersona,$params)
    {
        //$tipo, $actividadCargo, $user, $psw

        $this->db->trans_begin();
        $this->db->where('idpersona',$idpersona);
        $this->db->update('persona',$params); 

        if ($this->db->trans_status() === FALSE){
            //Hubo errores en la consulta, entonces se cancela la transacción.
            $this->db->trans_rollback();
            return 0;
        }else{
            //Todas las consultas se hicieron correctamente.
            $this->db->trans_commit();
            //return $idpersona;
        }
    }

    /**
     * CambiarEstado.
     * @param $idpersona Id del persona.
     * @param $params estado 1 o 0.
     * @return bool.
     */
    function cambiarEstado($idpersona,$params)
    {
        $this->db->where('idpersona',$idpersona);
        return $this->db->update('persona',$params);
    }

    /**
     * GetPersonasReporte.
     * @return result con idpersona, nombre, direccion, telefono, email.
     */
    public function getPersonasReporte(){
        $this->db->select('idpersona, nombre, direccion, telefono, email');
        $this->db->from('persona');
        $this->db->Where('tipoPersona','Persona');
        $this->db->order_by('nombre','asc');

        $r = $this->db->get();
        return $r->result();
    }
}
