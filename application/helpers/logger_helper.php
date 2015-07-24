<?php
		
	function logger($data=null){	
		$CI =& get_instance();	
		if(count($CI->session->userdata('dados_acesso'))>0){
			$dados_acesso = $CI->session->userdata('dados_acesso');
			if($dados_acesso['administrador_id'] > 0){
				if(is_null($data)){
					$model = $CI->uri->segment(1) ? $CI->uri->segment(1) : 'processo';
					$action = $CI->uri->segment(2) ? $CI->uri->segment(2) : 'select';
					$registro_id = $CI->uri->segment(3) ? $CI->uri->segment(3) : 0;
				}
				else{
					$model = $data[0];
					$action = $data[1];
					$registro_id = $data[2];
				}
				/*$CI->load->model('log_model');			
				$data = array(
					'administrador_id' => $dados_acesso['administrador_id'],
					'modulo' => $model,
					'metodo' => $action,
					'registro_id' => $registro_id,
					'data' => date('Y-m-d H:i:s')
				);
				$CI->log_model->insert($data);*/
			}
		}
	}

?>