<?php

	class administrador_model extends CI_Model{

		private $table;
		private $table_id;

		public function __construct(){
			$this->table = 'administrador';
			$this->table_id = $this->table.'_id';
		}

		//checagem de acesso
		public function checkLogin($data=array()){
	        $login = trim($data['login']);
	        $senha = md5(trim($data['senha']));
	        $where = array(
	            'administrador_nome' => $login,
	            'administrador_senha' => $senha,
	            'administrador_status' => 1
	        );
	        //pegando os dados do administrador
	        $dataLogin = $this->getWhere($where);
	        if(!is_null($dataLogin)){
		        //montando as sessoes do administrador
		        $this->setSessions($dataLogin[0]);
		        //montando a sessão para validações e abrindo o maso
		        return true;
	    	}
	    	else{
	    		return false;
	    	}
    	}

    	//montando a sessão do administrador
    	private function setSessions($dataLogin){
	        //sessoa do administardor
	        $usuario = array(
	            'administrador_id' => $dataLogin['administrador_id'],
	            'administrador_nome' => $dataLogin['administrador_nome'],
	            'administrador_status' => $dataLogin['administrador_status'],
	            'administrador_nivel' => $dataLogin['administrador_nivel'],
	            'logado' => true,
	        );
	        $this->session->set_userdata('dados_acesso', $usuario);
	        return true;
    	}

		//selecionando os registros do bd pelos parâmetros passados
	    public function getAll($where = array(), $order = null, $limit = null){
	        $this->db->select('*');
	        $this->db->from($this->table);
	        if (count($where)>0) {
	            $this->db->where($where);
	        }
	        if (!is_null($order)) {
	            $this->db->order_by($order[0], $order[1]);
	        } else {
	            $this->db->order_by($this->table_id, 'desc');
	        }
	        if (!is_null($limit)) {
	            $this->db->limit($limit[0], $limit[1]);
	        }
	        $query = $this->db->get();
	        //echo $this->db->last_query();
	        if ($query->num_rows() > 0) {
	            return $query->result_array();
	        } else {
	            return null;
	        }
	    }
	    
	    //selecionando o registro pelo id
	    public function getById($id){
	        $this->db->select('*');
	        $this->db->from($this->table);
	        $this->db->where(array(
	            $this->table_id => $id
	        ));
	        $query = $this->db->get();
	        if ($query->num_rows() > 0) {
	            $resultado = $query->result_array();
	            return $resultado[0];
	        } else {
	            return null;
	        }
	    }
	    
	    //selecionando o registro pela coluna
	    public function getBy($column, $value){
	        $this->db->select('*');
	        $this->db->from($this->table);
	        $this->db->where(array(
	            $column => $value
	        ));
	        $query = $this->db->get();
	        if ($query->num_rows() > 0) {
	            $resultado = $query->result_array();
	            return $resultado[0];
	        } else {
	            return null;
	        }
	    }

	    //selecionando o registro pela coluna
	    public function getWhere(Array $where=array()){
	        $this->db->select('*');
	        $this->db->from($this->table);
	        $this->db->where($where);
	        $query = $this->db->get();
	        //echo $this->db->last_query();
	        if ($query->num_rows() > 0) {
	            return $query->result_array();
	        } else {
	            return null;
	        }
	    }
	    
	    //realizando uma consulta com a query livre
	    public function get($qry){
	        $query = $this->db->query($qry);
	        if ($query->num_rows() > 0) {
	            return $query->result_array();
	        } else {
	            return null;
	        }
	    }
	    
	    //contando a quantidade de registros da consulta
	    public function count($where=null){
	        $this->db->select('*');
	        $this->db->from($this->table);
	        if (!is_null($where)) {
	            $this->db->where($where);
	        }
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	    
	    //inserindo registros no bd
	    public function insert($data = array()){
	        $this->db->insert($this->table, $data);
	        return $this->db->insert_id();
	    }
	    
	    //alterando o registro no db
	    public function update($id, $data = array()){
	        $this->db->where($this->table_id, $id);
	        return $this->db->update($this->table, $data);
	    }
	    
	    //excluindo o registro do bd
	    public function delete($id){
	        return $this->db->delete($this->table, array(
	            $this->table_id => $id
	        ));
	    }
	    
	    //realizando um requisição livre
	    //se retornar algum registro retorna e forma de array
	    public function execute($qry){
	        $query = $this->db->query($qry);
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

?>