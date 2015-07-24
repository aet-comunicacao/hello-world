<?php	

	class tipo_ocorrencia extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		
		function __construct(){
			parent::__construct();
			$this->load->model('tipo_ocorrencia_model', 'tipo_ocorrencia');
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
		    $total_rows = $this->tipo_ocorrencia->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);
			//selecionando os dados
			$this->dados['tipo_ocorrencias'] = $this->tipo_ocorrencia->getAll(null, null, $limit);
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
				if($data['tipo_ocorrencia_id']>0){
					$this->tipo_ocorrencia->update($data['tipo_ocorrencia_id'], $data);
				}
				//cadastro
				else{
					$data['tipo_ocorrencia_data'] = date('Y-m-d H:i:s');
					$this->tipo_ocorrencia->insert($data);
				}
				redirect('tipo_ocorrencia');
			}
			else{
				//alteracao
				if(!is_null($id)){
					$this->dados['tipo_ocorrencia'] = $this->tipo_ocorrencia->getById($id);
				}
				//pagina do formulário
				$this->template->view($pagina, $this->dados);
			}
		}

		//excluindo o registro
		public function delete($id){
			$this->tipo_ocorrencia->delete($id);
			redirect('tipo_ocorrencia/select');
		}

		/*AJAX*/

		//alterando o status
		public function status()	{
			$this->tipo_ocorrencia->update($this->input->post('id'), array('tipo_ocorrencia_status' => $this->input->post('status')));
		}

	}

?>