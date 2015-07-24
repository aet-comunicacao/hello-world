<?php

	function getCI(){
	 	$CI = &get_instance();
	 	return $CI;
	}

	function aprovarPasso($data){
		$CI = getCI();

		/*echo '<pre>';
		var_dump($data);
		exit;*/

		$CI->load->model('passo_model');
		$qry = "select passo from passo where processo_id = {$data['processo_id']} ";
		$passos = $CI->passo_model->execute($qry);

		$restantes=array();
		if(count($passos)>0){
			foreach($passos as $passo){
				if($passo['passo'] > $data['passo_atual']){
					$restantes[] = $passo['passo'];
				}
			}
		}		

		//se for o ultimo passo
		if(count($restantes) == 0){			
			//inativar processo
			inativarProcesso($data);
			//inativar todos os candidatos a vaga
			inativarCandidatosVagas($data);
			//inativando o candidato 
			inativarCandidato($data);
			//integracao do candidato
			insertIntegracao($data);
		}
		else{
			$data['proximo_passo_id'] = $restantes[0];
			$data['proximo_passo_nome'] = getPasso($restantes[0]);
			//cadastro de dados iniciais
			insertDadosIniciais($data);
			//atualizar candidato_vaga
			aprovar($data);
		}
		return;
	}

	//cadastrando os dados iniciais do proximo passo
	function insertDadosIniciais($data){
		$CI = getCI();
		$insert = array(
			'administrador_id' => $data['administrador_id'],
			'candidato_vaga_id' => $data['candidato_vaga_id']
		);
		$model = "{$data['proximo_passo_nome']}_model";
		$CI->load->model($model);
		$CI->$model->insert($insert);
		return;
	}	

	//dados iniciais da intregracao
	function insertIntegracao($data){
		$CI = getCI();
		$insert = array(
			'administrador_id' => $data['administrador_id'],
			'candidato_vaga_id' => $data['candidato_vaga_id'],
			'candidato_id' => $data['candidato_id'],
			'processo_id' => $data['processo_id'],
			'integracao_data' => dateToDB($data['integracao_data'])
		);
		$CI->load->model('integracao_model');
		$CI->integracao_model->insert($insert);
		return;
	}

	//inativando/fechando o processo
	function inativarProcesso($data){
		$CI = getCI();
		$CI->load->model('processo_model');
		$CI->processo_model->update($data['processo_id'], array('processo_status'=>'I'));
		return;
	}

	//inativando todos os candidato a vaga e integrando o candidato a empresa
	function inativarCandidatosVagas($data){
		$CI = getCI();
		$CI->load->model('candidato_vaga_model');
		//inativando todos os candidatos do processo
		$qryInativar = "update candidato_vaga set candidato_vaga_status = 'I' where processo_id = {$data['processo_id']} ";
		$CI->candidato_vaga_model->execute($qryInativar);
		//inativando o candidato de todos os processos em andamento
		$qryCandidato = "update candidato_vaga set candidato_vaga_status = 'I' where candidato_id = {$data['candidato_id']} ";
		$CI->candidato_vaga_model->execute($qryCandidato);
		//integrando o candidato
		$qryIntegrar = "update candidato_vaga set candidato_vaga_status = 'IN' where candidato_vaga_id = {$data['candidato_vaga_id']} ";
		$CI->candidato_vaga_model->execute($qryIntegrar);
		return;
	}

	//inativando o candidato
	function inativarCandidato($data){
		$CI = getCI();
		$CI->load->model('candidato_model');
		$CI->candidato_model->update($data['candidato_id'], array('candidato_status'=>0));
		return;
	}

	//aprovando o candidato
	function aprovar($data){
		$CI = getCI();
		$CI->load->model('candidato_vaga_model');
		$CI->candidato_vaga_model->status($data['candidato_vaga_id'], $data['proximo_passo_id']);
		return;
	}

	//verificando qual é o passo
	function getPasso($passo){
		switch($passo){
			case 1:
			return 'entrevista';
			break;
			case 2:
			return 'pesquisa_social';
			break;
			case 3:
			return 'avaliacao_psicologica';
			break;
			case 4:
			return 'entrevista_lider';
			break;
			case 5:
			return 'avaliacao_pratica1';
			break;
			case 6:
			return 'pre_teste';
			break;
			case 7:
			return 'avaliacao_pratica2';
			break;
			case 8:
			return 'exame_medico';
			break;
		}
	}

?>