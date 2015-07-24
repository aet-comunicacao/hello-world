<?php	

	class checklist extends CI_Controller{

		//array dados da classe
		private $dados = array();
		private $administrador_id;
		
		function __construct(){
			parent::__construct();
			$this->load->model('checklist_model', 'checklist');
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
		    $total_rows = $this->checklist->count();
		    $limit[0] = _PER_PAGE;
		    $limit[1] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		    setPagination($total_rows, __CLASS__.'/'.__FUNCTION__);
			//selecionando os dados
			//$this->dados['checklists'] = $this->checklist->getAll(null, null, $limit);
			$qry = "select distinct checklist_data_dia, count(checklist_id) as qtd from checklist group by checklist_data_dia order by checklist_data_dia desc ";
			$this->dados['checklists'] = $this->checklist->execute($qry);
			$this->dados['pagination'] = $this->pagination->create_links();
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'list');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		public function relatorio(){
			$this->dados['checklists'] = false;
			$this->dados['data_dia'] = null;
			if($this->input->post()){
				$data_dia = dateToDb($this->input->post('data'));
				$this->dados['checklists'] = $this->checklist->getWhere(array('checklist_data_dia'=>$data_dia), array('ch.veiculo_id','asc'));
				$this->dados['data_dia'] = $this->input->post('data');
			}
			//padronizando o caminho da página
			$pagina = page($this->dados['modulo'], 'relatorio');
			//chamando a pagina pelo template
			$this->template->view($pagina, $this->dados);
		}

		//cadastrando ou alterando o registro
		public function edit($checklist_data_dia=null){
			$pagina = page($this->dados['modulo'], 'form');			
			$this->load->model('veiculo_model');
			$this->dados['veiculos'] = $this->veiculo_model->getAll(array('veiculo_status'=>1), array('veiculo_nome','asc'));
			$this->dados['checklist_data_dia'] = null;
			if($checklist_data_dia>0){
				$this->dados['checklist_data_dia'] = dateFromDb($checklist_data_dia);
				$checklist = $this->checklist->getWhere(array('checklist_data_dia'=>$checklist_data_dia));
				$this->dados['checklist'] = $checklist;
				if(count($checklist)>0){
					foreach($checklist as $value){
						$collection[$value['veiculo_id']] = $value;
					}
				}
				$this->dados['collection'] = $collection;
			}
			//pagina do formulário
			$this->template->view($pagina, $this->dados);
		}

		/*AJAX*/

		//alterando o status
		public function delete(){
			$checklist_data_dia = str_replace('_', '-', $this->input->post('dataDia'));
			$qry = "delete from checklist where checklist_data_dia = '".$checklist_data_dia."' ";
			return $this->checklist->execute($qry);
		}		

		public function insertDataInicio(){
			if(!is_null($this->input->post('inicio')) && $this->input->post('inicio') != ''){
				$checklist_data_dia = dateToDb($this->input->post('hoje'));
				$checklist = $this->checklist->getWhere(
				array(
					'ch.checklist_data_dia'=>$checklist_data_dia,
					'ch.veiculo_id'=>$this->input->post('veiculo_id')
				));
				$data = array(
					'administrador_id' => $this->administrador_id,
					'veiculo_id' => $this->input->post('veiculo_id'),
					'checklist_data_dia' => $checklist_data_dia,
					'checklist_data_inicio' => $this->input->post('inicio'),
					'checklist_data' => date('Y-m-d H:i:s')
				);
				if(is_null($checklist)){				
					echo $this->checklist->insert($data);
				}
				else{
					echo $this->checklist->update($checklist[0]['checklist_id'], $data);
				}
			}			
		}

		public function insertCameraStatus(){
			if(!is_null($this->input->post('status')) && $this->input->post('status') != ''){
				$checklist_data_dia = dateToDb($this->input->post('hoje'));
				$checklist = $this->checklist->getWhere(
				array(
					'ch.checklist_data_dia'=>$checklist_data_dia,
					'ch.veiculo_id'=>$this->input->post('veiculo_id')
				));
				$data = array(
					'administrador_id' => $this->administrador_id,
					'veiculo_id' => $this->input->post('veiculo_id'),
					'checklist_data_dia' => $checklist_data_dia,
					'checklist_status_cameras' => $this->input->post('status'),
					'checklist_data' => date('Y-m-d H:i:s')
				);
				if(is_null($checklist)){				
					echo $this->checklist->insert($data);
				}
				else{
					echo $this->checklist->update($checklist[0]['checklist_id'], $data);
				}
			}			
		}

	}

?>