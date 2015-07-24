<?php	

	class ocorrencia extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		private $administrador_nivel;
		
		function __construct(){
			parent::__construct();
			$this->load->model('ocorrencia_model', 'ocorrencia');
			$this->dados['modulo'] = __CLASS__;
			//dados do administrador
			$dados_acesso = $this->session->userdata('dados_acesso');
			$this->administrador_id = $dados_acesso['administrador_id'];
			$this->administrador_nivel = $dados_acesso['administrador_nivel'];
			logger();
		}

		/********************métodos principais********************/		

		//mostrando a lista de registros
		public function index(){
			//criando paginação
		    $this->load->helper('pagination_helper');
		    $total_rows = $this->ocorrencia->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);		

		    //se for ADMINISTRADOR mostra todas as ocorrencias pendentes e ativas de TODOS os usuários
			//se for USUÁRIO mostra SÓ as ocorrencias QUE ELE cadastro
		    $where = ($this->administrador_nivel == 'A') ? array('oc.ocorrencia_status != '=>'I') : array('oc.administrador_id'=>$this->administrador_id);

		    //selecionando os dados
		    $this->dados['ocorrencias'] = $this->ocorrencia->getAll($where, array('oc.ocorrencia_id','desc'), $limit);
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

				if(isset($data['ocorrencia_pagamento_tarifa'])){$data['ocorrencia_pagamento_tarifa']=dateToDb($data['ocorrencia_pagamento_tarifa']);}
				if(isset($data['ocorrencia_passageiro_descendo'])){$data['ocorrencia_passageiro_descendo']=dateToDb($data['ocorrencia_passageiro_descendo']);}
				if(isset($data['ocorrencia_encerramento_catraca'])){$data['ocorrencia_encerramento_catraca']=dateToDb($data['ocorrencia_encerramento_catraca']);}
				if(isset($data['ocorrencia_data_filmagem'])){$data['ocorrencia_data_filmagem']=dateToDb($data['ocorrencia_data_filmagem']);}

				if(isset($_FILES['ocorrencia_img']['name']) && $_FILES['ocorrencia_img']['name'] != ''){
					$data['ocorrencia_img'] = $this->uploadImg();
				}

				/*echo '<pre>';
				var_dump($data);
				exit;*/

				//alteracao
				if($data['ocorrencia_id']>0){
					$this->ocorrencia->update($data['ocorrencia_id'], $data);
				}
				//cadastro
				else{
					$data['ocorrencia_data'] = date('Y-m-d H:i:s');
					$this->ocorrencia->insert($data);
				}

				redirect('ocorrencia');
			}
			else{

				/*$this->load->model('computador_model');
				$this->dados['computadores'] = $this->computador_model->getAll(array('computador_status'=>1),array('computador_nome','asc'));*/
				$this->load->model('sistema_model');
				$this->dados['sistemas'] = $this->sistema_model->getAll(array('sistema_status'=>1),array('sistema_nome','asc'));
				$this->load->model('veiculo_model');
				$this->dados['veiculos'] = $this->veiculo_model->getAll(array('veiculo_status'=>1),array('veiculo_nome','asc'));
				$this->load->model('tipo_ocorrencia_model');
				$this->dados['tipo_ocorrencias'] = $this->tipo_ocorrencia_model->getAll(array('tipo_ocorrencia_status'=>1),array('tipo_ocorrencia_nome','asc'));
				//alteracao
				//alteracao
				if(!is_null($id)){
					$this->dados['ocorrencia'] = $this->ocorrencia->getById($id);
				}
				//pagina do formulário
				$this->template->view($pagina, $this->dados);
			}
		}

		public function relatorio(){
			if($this->input->post()){
				$this->dados['data_inicial'] = null;
				$this->dados['data_final'] = null;
				$this->dados['tipo_ocorrencia_id'] = null;
				$this->dados['veiculo_id'] = null;
				$data = setData($this->input->post());
				$where = 'oc.ocorrencia_status = "A" ';
				if(isset($data['data_de']) && isset($data['data_ate'])){
					$data_de = dateToDb($data['data_de']);
					$data_ate = dateToDb($data['data_ate']);
					$this->dados['data_inicial'] = $data['data_de'];
					$this->dados['data_final'] = $data['data_ate'];
					$where .= " AND ocorrencia_data BETWEEN '{$data_de}' AND '{$data_ate}' ";
				}
				if(isset($data['tipo_ocorrencia_id']) && $data['tipo_ocorrencia_id']>0){
					$where .= " AND oc.tipo_ocorrencia_id = '{$data['tipo_ocorrencia_id']}' ";
					$this->dados['tipo_ocorrencia_id'] = $data['tipo_ocorrencia_id'];
				}
				if(isset($data['veiculo_id']) && $data['veiculo_id'] > 0){
					$where .= " AND oc.veiculo_id = '{$data['veiculo_id']}' ";
					$this->dados['veiculo_id'] = $data['veiculo_id'];
				}
				$where .= ' order by oc.ocorrencia_id DESC';
				$this->dados['ocorrencias'] = $this->ocorrencia->getWhere($where);
			}
			$this->load->model('tipo_ocorrencia_model');
			$this->dados['tipo_ocorrencias'] = $this->tipo_ocorrencia_model->getAll(array('tipo_ocorrencia_status'=>1),array('tipo_ocorrencia_nome','asc'));
			$this->load->model('veiculo_model');
			$this->dados['veiculos'] = $this->veiculo_model->getAll(array('veiculo_status'=>1),array('veiculo_nome','asc'));
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'relatorio');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		//excluindo o registro
		public function delete($id){
			$this->ocorrencia->delete($id);
			redirect('ocorrencia/select');
		}

		private function uploadImg(){

			$dir= 'uploads/ocorrencia/';

            if(!file_exists($dir)){
				mkdir($dir, 0777, true);
            }
                              
            $config = array(
				// onde irá salvar a imagem
				'upload_path' => $dir, 
                //extenções permitidas
                'allowed_types' => 'jpg|png',
                //Tamanho máximo do arquivo, caso 5MB 
                'max_size' => '5000'
            );

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ocorrencia_img')) {
                $arquivo = $this->upload->upload_path . DIRECTORY_SEPARATOR . $this->upload->file_name; 
                return $this->upload->file_name;
            }
            else{
                 $this->session->set_flashdata('error',  $this->upload->display_errors());
                 redirect('ocorrencia/edit');
            }
		}

		/*AJAX*/

		//alterando o status
		public function status(){
			if($this->ocorrencia->update($this->input->post('id'), array('ocorrencia_status' => $this->input->post('status')))){
				if($this->input->post('status') == 'A'){
					$this->insertAprovacaoOcorrencia($this->input->post('id'));
				}				
				elseif($this->input->post('status') == 'R'){
					$this->insertReprovacaoOcorrencia($this->input->post('id'));
				}
			}
		}

		private function insertAprovacaoOcorrencia($ocorrencia_id){
			//cadastrando o administrador que aprovou a ocorrencia
			$this->load->model('aprovacao_ocorrencia_model');
			$data = array(
				'administrador_id' => $this->administrador_id,
				'ocorrencia_id' => $ocorrencia_id,
				'aprovacao_ocorrencia_data' => date('Y-m-d H:i:s')
			);
			return $this->aprovacao_ocorrencia_model->insert($data);
		}

		private function insertReprovacaoOcorrencia($ocorrencia_id){
			//cadastrando o administrador que aprovou a ocorrencia
			$this->load->model('reprovacao_ocorrencia_model');
			$data = array(
				'administrador_id' => $this->administrador_id,
				'ocorrencia_id' => $ocorrencia_id,
				'reprovacao_ocorrencia_data' => date('Y-m-d H:i:s')
			);
			return $this->reprovacao_ocorrencia_model->insert($data);
		}

	}

?>