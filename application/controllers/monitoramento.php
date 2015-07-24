<?php	

	class monitoramento extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		
		function __construct(){
			parent::__construct();
			$this->load->model('monitoramento_model', 'monitoramento');
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
		    $total_rows = $this->monitoramento->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);
			//selecionando os dados
			//$this->dados['checklists'] = $this->checklist->getAll(null, null, $limit);
			$qry = "select distinct monitoramento_dia, count(monitoramento_id) as qtd from monitoramento group by monitoramento_dia order by monitoramento_dia desc ";
			$this->dados['monitoramentos'] = $this->monitoramento->execute($qry);
			$this->dados['pagination'] = $this->pagination->create_links();
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'list');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		public function relatorio(){
			$this->dados['monitoramentos'] = false;
			$this->dados['data_dia'] = null;
			if($this->input->post()){
				$data_dia = dateToDb($this->input->post('data'));
				$this->dados['monitoramentos'] = $this->monitoramento->getWhere(array('monitoramento_dia'=>$data_dia), array('m.veiculo_id','asc'));
				$this->dados['data_dia'] = $this->input->post('data');
			}
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'relatorio');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		//cadastrando ou alterando o registro
		public function edit($monitoramento_dia=null){
			$pagina = page($this->dados['modulo'], 'form');			
			$this->load->model('veiculo_model');
			$this->dados['monitoramento_dia']=null;
			$this->dados['veiculos'] = $this->veiculo_model->getAll(array('veiculo_status'=>1), array('veiculo_nome','asc'));
			if($monitoramento_dia>0){
				$this->dados['monitoramento_dia'] = dateFromDb($monitoramento_dia);
				$monitoramento = $this->monitoramento->getWhere(array('monitoramento_dia'=>$monitoramento_dia));
				$this->dados['monitoramentos'] = $monitoramento;
				if(count($monitoramento)>0){
					foreach($monitoramento as $value){
						$collection[$value['veiculo_id']] = $value;
					}
				}
				$this->dados['collection'] = $collection;
			}			
			//pagina do formulário
			$this->template->view($pagina, $this->dados);
		}

		//alterando o status
		public function delete(){
			$checklist_data_dia = str_replace('_', '-', $this->input->post('dataDia'));
			$qry = "delete from monitoramento where monitoramento_dia = '".$checklist_data_dia."' ";
			return $this->monitoramento->execute($qry);
		}	

		/*AJAX*/

		//alterando o status
		public function status()	{
			$this->monitoramento->update($this->input->post('id'), array('monitoramento_status' => $this->input->post('status')));
		}

		public function insert(){

			if($this->input->post('valor') != null && $this->input->post('valor') != ''){

				$campo = $this->input->post('campo');
				$valor = $this->input->post('valor');
				$veiculo_id = $this->input->post('veiculo_id');
				$dia = dateToDb($this->input->post('dia'));

				$checkMonitoramento = $this->monitoramento->getWhere(array(
					'm.monitoramento_dia' => $dia,
					'm.veiculo_id' => $veiculo_id,
				));

				$data = array(
					'administrador_id' => $this->administrador_id,
					'veiculo_id' => $veiculo_id,
					$campo => $valor,
					'monitoramento_dia' => $dia,
					'monitoramento_data' => date('Y-m-d H:i:s')
				);

				if(is_null($checkMonitoramento)){
					$this->monitoramento->insert($data);
				}
				else{
					$this->monitoramento->update($checkMonitoramento[0]['monitoramento_id'], $data);
				}

			}

		}

	}

?>