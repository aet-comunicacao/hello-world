<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sql {

	private $ci;
	public $table = null;
    public $table_id = null;
   
    public function __construct() {      
        $this->ci =& get_instance();
    }
    
    //selecionando os registros do bd pelos parâmetros passados
    public function getAll($where = null, $order = null, $limit = null)
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        if (!is_null($where)) {
            $this->ci->db->where($where);
        }
        if (!is_null($order)) {
            $this->ci->db->order_by($order[0], $order[1]);
        }
        if (!is_null($limit)) {
            $this->ci->db->limit($limit[0], $limit[1]);
        }
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    //selecionando o registro pelo id
    public function getWhere(Array $where=array())
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->where($where);
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    //selecionando o registro pelo id
    public function getOne(Array $where=array())
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->where($where);
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0];
        } else {
            return null;
        }
    }
    
    //selecionando o registro pelo id
    public function getById($id)
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->where(array(
            $this->table_id => $id
        ));
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0];
        } else {
            return null;
        }
    }
    
    //selecionando o registro pela coluna
    public function getBy($column, $value)
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->where(array(
            $column => $value
        ));
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    //selecionando um registro pela coluna
    public function getOneBy($column, $value)
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->where(array(
            $column => $value
        ));
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0];
        } else {
            return null;
        }
    }

    //selecionando o registro pela coluna LIKE
    public function getByLike($column, $value, $param=null)
    {
        $param = is_null($param) ? 'both' : $param;
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        $this->ci->db->like($column, $value, $param); 
        $query = $this->ci->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    //realizando uma consulta com a query livre
    public function get($qry)
    {
        $query = $this->ci->db->query($qry);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    //contando a quantidade de registros da consulta
    public function count($where=null)
    {
        $this->ci->db->select('*');
        $this->ci->db->from($this->table);
        if (!is_null($where)) {
            $this->ci->db->where($where);
        }
        $query = $this->ci->db->get();
        return $query->num_rows();
    }
    
    //inserindo registros no bd
    public function insert(Array $data = array())
    {
        $this->ci->db->insert($this->table, $data);
        return $this->ci->db->insert_id();
    }
    
    //alterando o registro no db
    public function update($id, Array $data = array())
    {
       foreach ($data as $key => $value) {
           if ($value != NULL && $value != ''){
             $this->ci->db->set($key, $value);
           }
       }
       $this->ci->db->where($this->table_id, $id);
       return $this->ci->db->update($this->table);
    }
    
    //excluindo o registro do bd
    public function delete($id)
    {
        return $this->ci->db->delete($this->table, array(
            $this->table_id => $id
        ));
    }
    
    //realizando um requisição livre
    //se retornar algum registro retorna em forma de array
    public function execute($qry)
    {
        $query = $this->ci->db->query($qry);
        if (is_object($query)) {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return null;
            }
        } else {
            return true;
        }
    }

}