<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario_model extends CI_Model
{
    /**
     * Funcionario_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * GetFuncionario.
     * @param $idfuncionario Id de Funcionario por key.
     * @return row_array con datos de un funcionario.
     */
    function getFuncionario($key)
    {
        return $this->db->get_where('funcionario',array('key'=>$key))->row_array();
    }

    /**
     * GetFuncionario.
     * @param $idfuncionario Id del Funcionario por idfuncionario.
     * @return row_array con datos de un funcionario.
     */
    function getFuncionarioId($idpersona)
    {
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    function getFuncionarioIdPersona($idpersona)
    {
        return $this->db->get_where('persona',array('idpersona'=>$idpersona))->row_array();
    }

    function getIdPersonaByIdfuncionario($idfuncionario)
    {
        $this->db->where('idfuncionario', $idfuncionario);
        return $this->db->get_where('funcionario')->row_array();
    }

    function validarNombre($nombre)
    {
        $this->db->select('idfuncionario,nombre');
        $this->db->FROM('funcionario');
        $this->db->WHERE('nombre', $nombre);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idfuncionario;
        }else{
            return 0;
        }
    }

    function validarCi($ci)
    {
        $this->db->select('idfuncionario,ci');
        $this->db->FROM('funcionario');
        $this->db->WHERE('ci', $ci);
        $this->db->WHERE('estado', 1);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            $r = $resultado->row(); 
            return $r->idfuncionario;
        }else{
            return 0;
        }
    }

    /**
     * GetAllFuncionarioCount.
     * @return entero Cantidad de funcionarios.
     */
    function getAllFuncionarioCount()
    {
        $this->db->select('count(idfuncionario) as contador');
        $this->db->from('funcionario');
        $this->db->where('tipo_funcionario','Funcionario');
        $r = $this->db->get();
        $resultado = $r->row();
        return $resultado->contador;
    }

    /**
     * GetAllFuncionario.
     * @return result_array con datos de varios funcionarios.
     */
    function getAllFuncionario()
    {
        $this->db->select("p.idpersona, c.cargo, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompletofunncionario,  p.direccion, p.celular");
        $this->db->from('persona p');
        $this->db->join('cargo c','c.idcargo=p.idcargo'); 
        $this->db->where('p.tipopersona', 2);  
        return $this->db->get()->result_array();
    }

    /**
     * GetAllFuncionario.
     * @return result_array con datos de varios funcionarios.
     */
    function getFuncionarioFullNameReporte($idusuario)
    {
        $this->db->select("p.idpersona, c.cargo, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompletofunncionario, cargo, direccion, celular");
        $this->db->from('persona p');
        $this->db->join('cargo c','c.idcargo=p.idcargo');
        $this->db->order_by('p.idpersona', 'asc');  
        $this->db->where('p.tipoPersona', 2);
        $this->db->where('p.idpersona<>', $idusuario);
        return $this->db->get()->result_array();
    }



    /**
     * GetAllFuncionario.
     * @return result_array con datos de varios funcionarios.
     */
    function getAllFuncionarioFullNameReporte()
    {
        $this->db->select("p.idpersona, c.cargo, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto, cargo, direccion, celular");
        $this->db->from('persona p');
        $this->db->join('cargo c','c.idcargo=p.idcargo');
        $this->db->order_by('p.idpersona', 'asc');  
        $this->db->where('p.tipoPersona', 2);
        
        return $this->db->get()->result_array();
    }

    /**
     * GetAllFuncionario.
     * @return result_array con datos de varios funcionarios.
     */
    function getAllFuncionarioFullName()
    {
        $this->db->select("p.idpersona, c.cargo, concat_ws(' ',p.nombres,IFNULL(p.apellidoPaterno, ''),IFNULL(p.apellidoMaterno, '')) as nombreCompleto ");
        $this->db->from('persona p');
        $this->db->join('cargo c','c.idcargo=p.idcargo');
        $this->db->order_by('p.idpersona', 'asc');  
        $this->db->where('p.tipoPersona', 2);

        return $this->db->get()->result_array();
    }
}
