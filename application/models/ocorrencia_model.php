<?php

	class ocorrencia_model extends CI_Model{

		private $table;
		private $table_id;

		public function __construct(){
			$this->table = 'ocorrencia';
			$this->table_id = $this->table.'_id';
		}

		//selecionando os registros do bd pelos parâmetros passados
	    public function getAll($where = array(), $order = null, $limit = null){
	        $this->db->select('oc.ocorrencia_id, oc.ocorrencia_status, oc.ocorrencia_data, oc.ocorrencia_data_filmagem');
	        $this->db->select('toc.tipo_ocorrencia_nome');
	        $this->db->select('v.veiculo_nome');
	        $this->db->select('s.sistema_nome');
	        $this->db->select('a.administrador_nome as adm_aprovacao');
	        $this->db->select('adm.administrador_nome as adm_cadastro');
	        $this->db->select('adm2.administrador_nome as adm_reprovacao');

	        $this->db->join('tipo_ocorrencia toc', 'oc.tipo_ocorrencia_id = toc.tipo_ocorrencia_id', 'left');
	        $this->db->join('veiculo v', 'oc.veiculo_id = v.veiculo_id', 'left');
	        $this->db->join('sistema s', 'oc.sistema_id = s.sistema_id', 'left');
	        $this->db->join('aprovacao_ocorrencia ap', 'oc.ocorrencia_id = ap.ocorrencia_id', 'left');
	        $this->db->join('reprovacao_ocorrencia re', 'oc.ocorrencia_id = re.ocorrencia_id', 'left');
	        $this->db->join('administrador a', 'ap.administrador_id = a.administrador_id', 'left');
	        $this->db->join('administrador adm', 'oc.administrador_id = adm.administrador_id', 'left');
	        $this->db->join('administrador adm2', 're.administrador_id = adm2.administrador_id', 'left');

	        $this->db->from("$this->table oc");
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
	        $this->db->join('tipo_ocorrencia toc', 'oc.tipo_ocorrencia_id = toc.tipo_ocorrencia_id', 'left');
	        $this->db->join('veiculo v', 'oc.veiculo_id = v.veiculo_id', 'left');
	        $this->db->join('sistema s', 'oc.sistema_id = s.sistema_id', 'left');
	        $this->db->from("$this->table oc");
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
	        $this->db->join('tipo_ocorrencia toc', 'oc.tipo_ocorrencia_id = toc.tipo_ocorrencia_id', 'left');
	        $this->db->join('veiculo v', 'oc.veiculo_id = v.veiculo_id', 'left');
	        $this->db->join('sistema s', 'oc.sistema_id = s.sistema_id', 'left');
	        $this->db->from("$this->table oc");
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
	    public function getWhere($where){
	        $this->db->select('oc.ocorrencia_id, oc.ocorrencia_status, oc.ocorrencia_data, oc.ocorrencia_data_filmagem');
	        $this->db->select('toc.tipo_ocorrencia_nome');
	        $this->db->select('v.veiculo_nome');
	        $this->db->select('s.sistema_nome');
	        $this->db->select('a.administrador_nome as adm_aprovacao');
	        $this->db->select('adm.administrador_nome as adm_cadastro');
	        $this->db->select('adm2.administrador_nome as adm_reprovacao');

	        $this->db->join('tipo_ocorrencia toc', 'oc.tipo_ocorrencia_id = toc.tipo_ocorrencia_id', 'left');
	        $this->db->join('veiculo v', 'oc.veiculo_id = v.veiculo_id', 'left');
	        $this->db->join('sistema s', 'oc.sistema_id = s.sistema_id', 'left');
	        $this->db->join('aprovacao_ocorrencia ap', 'oc.ocorrencia_id = ap.ocorrencia_id', 'left');
	        $this->db->join('reprovacao_ocorrencia re', 'oc.ocorrencia_id = re.ocorrencia_id', 'left');
	        $this->db->join('administrador a', 'ap.administrador_id = a.administrador_id', 'left');
	        $this->db->join('administrador adm', 'oc.administrador_id = adm.administrador_id', 'left');
	        $this->db->join('administrador adm2', 're.administrador_id = adm2.administrador_id', 'left');

	        $this->db->from("$this->table oc");
	        $this->db->where($where, null, false);
	        $query = $this->db->get();
	        //echo $this->db->last_query();exit;
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