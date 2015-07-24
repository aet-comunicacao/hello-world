<?php
	
	//metodo para autenticação de acesso
	function authentication(){
		$CI = & get_instance();
		if(count($CI->session->userdata('dados_acesso'))>0){
			$dados_acesso = $CI->session->userdata('dados_acesso');
			if($dados_acesso['administrador_status'] == null || $dados_acesso['administrador_status'] == 0){
				redirect('/');
			}
		}
		else{
			redirect('/');
		}
	}

?>