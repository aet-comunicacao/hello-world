<?php	

	class administrador extends CI_Controller{

		//array dados da classe
		private $dados = array();
		
		function __construct(){
			parent::__construct();
			$this->load->model('administrador_model', 'administrador');
			$this->dados['modulo'] = __CLASS__;
			logger();
		}

		/********************métodos principais********************/

		//validando o login
		public function login(){
			if($this->input->post()){
				if($this->administrador->checkLogin($this->input->post())){
					redirect('ocorrencia');
				}
				else{
					$this->session->set_flashdata('error', 'Login e senha não conferem.');
					redirect('administrador');
				}
			}
		}

		//saindo do sistema
		public function logout(){
			//destruindo a sessão do administrador
			$this->session->unset_userdata('dados_acesso');
			$this->session->sess_destroy();
			//voltando para a tela de login
			redirect('/');
		}

		//mostrando a lista de registros
		public function index(){
			echo 'aqui na index do login';
			//selecionando os dados
			$this->dados['administradores'] = null;
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'login');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		//lista de administradores
		public function select(){

			//criando paginação
		    $this->load->helper('pagination_helper');
		    $total_rows = $this->administrador->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);

			//selecionando os dados
			$this->dados['administradores'] = $this->administrador->getAll(null, null, $limit);
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

				//senha
				if($data['administrador_senha'] != null && $data['administrador_senha'] != ''){
					$data['administrador_senha'] = md5($data['administrador_senha']);
				}
				else{
					unset($data['administrador_senha']);
				}

				//alteracao
				if($data['administrador_id']>0){
					$this->administrador->update($data['administrador_id'], $data);
				}
				//cadastro
				else{
					$data['administrador_data'] = date('Y-m-d H:i:s');
					$this->administrador->insert($data);
				}
				redirect('administrador/select');
			}
			else{
				//alteracao
				if(!is_null($id)){
					$this->dados['administrador'] = $this->administrador->getById($id);
				}
				//pagina do formulário
				$this->template->view($pagina, $this->dados);
			}
		}

		//excluindo o registro
		public function delete($id){
			$this->administrador->delete($id);
			redirect('administrador/select');
		}

		/*AJAX*/

		//alterando o status
		public function status(){		
			$log = array(__CLASS__, __FUNCTION__, $this->input->post('id'));
			logger($log);
			$this->administrador->update($this->input->post('id'), array('administrador_status' => $this->input->post('status')));
		}

	}

?>