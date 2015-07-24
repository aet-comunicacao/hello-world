<?php	

	class sistema extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		
		function __construct(){
			parent::__construct();
			$this->load->model('sistema_model', 'sistema');
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
		    $total_rows = $this->sistema->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);
			//selecionando os dados
			$this->dados['sistemas'] = $this->sistema->getAll(null, null, $limit);
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
				if($data['sistema_id']>0){
					$this->sistema->update($data['sistema_id'], $data);
				}
				//cadastro
				else{
					$data['sistema_data'] = date('Y-m-d H:i:s');
					$this->sistema->insert($data);
				}
				redirect('sistema');
			}
			else{
				//alteracao
				if(!is_null($id)){
					$this->dados['sistema'] = $this->sistema->getById($id);
				}
				//pagina do formulário
				$this->template->view($pagina, $this->dados);
			}
		}

		//excluindo o registro
		public function delete($id){
			$this->sistema->delete($id);
			redirect('sistema/select');
		}

		/*AJAX*/

		//alterando o status
		public function status()	{
			$this->sistema->update($this->input->post('id'), array('sistema_status' => $this->input->post('status')));
		}

	}

?>