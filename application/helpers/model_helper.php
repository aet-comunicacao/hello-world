<?php
	
	//padronizando o caminho da página pelo módulo
	function page($modulo, $pagina){
		if(!is_null($modulo) || !empty($modulo)){
			if(!is_null($pagina) || !empty($pagina)){
				return strtolower($modulo.'/'.$pagina);
			}	
			else{
				die('Pagina vazio!');
			}
		}	
		else{
			die('Modulo vazio!');
		}
	}

	//populando os dados no array
	function setData(Array $data=array()){
		$collectionData=array();
        if(count($data)>0){
        	foreach($data as $key => $value){
        		if(!is_null($value) && $value != ''){
        			$collectionData[$key] = !is_array($value) ? trim($value) : $value;
        		}
        	}
        }
        return $collectionData;
	}

	//consulta de enredeço pelo cep
	function getAddress($cep){
		$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);		 
		$dados['sucesso'] = (string) $reg->resultado;
		$dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
		$dados['bairro']  = (string) $reg->bairro;
		$dados['cidade']  = (string) $reg->cidade;
		$dados['estado']  = (string) $reg->uf;		 
		return json_encode($dados);
	}

?>