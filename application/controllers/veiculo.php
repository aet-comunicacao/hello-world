<?php	

	class veiculo extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		
		function __construct(){
			parent::__construct();
			$this->load->model('veiculo_model', 'veiculo');
			$this->dados['modulo'] = __CLASS__;
			
			//dados do administrador
			$dados_acesso = $this->session->userdata('dados_acesso');
			$this->administrador_id = $dados_acesso['administrador_id'];
			logger();
		}

		/********************métodos principais********************/		

		//mostrando a lista de registros
		public function index(){
			//criando paginação
		    $this->load->helper('pagination_helper');
		    $total_rows = $this->veiculo->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);
			//selecionando os dados
			$this->dados['veiculos'] = $this->veiculo->getAll(null, null, $limit);
			$this->dados['pagination'] = $this->pagination->create_links();
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'list');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		//cadastrando ou alterando o registro
		public function edit($id=null){
			$pagina = page($this->dados['modulo'], 'form');			
			//se formulário for submetido
			if($this->input->post()){
				//setando os valores a serem enviado ao bd
				$data = setData($this->input->post());	
				$data['administrador_id'] = $this->administrador_id;
				//alteracao
				if($data['veiculo_id']>0){
					$this->veiculo->update($data['veiculo_id'], $data);
				}
				//cadastro
				else{
					$data['veiculo_data'] = date('Y-m-d H:i:s');
					$this->veiculo->insert($data);
				}
				redirect('veiculo');
			}
			else{
				$this->load->model('computador_model');
				$this->dados['computadores'] = $this->computador_model->getAll(array('computador_status'=>1), array('computador_nome','asc'));
				//alteracao
				if(!is_null($id)){
					$this->dados['veiculo'] = $this->veiculo->getById($id);
				}
				//pagina do formulário
				$this->template->view($pagina, $this->dados);
			}
		}

		//excluindo o registro
		public function delete($id){
			$this->veiculo->delete($id);
			redirect('veiculo/select');
		}

		/*AJAX*/

		//alterando o status
		public function status()	{
			$this->veiculo->update($this->input->post('id'), array('veiculo_status' => $this->input->post('status')));
		}

		//pegando todos os veiculos pelo computador
		public function getByComputador(){
			$data = $this->veiculo->getWhere(array('v.computador_id'=>$this->input->post('computador_id'), 'veiculo_status'=>1),array('veiculo_nome','asc'));
			echo json_encode($data);
		}

	}

?>