<div id="menu-topo" class="container-fluid">
<?php
$dados_acesso = $this->session->userdata('dados_acesso') != false ? $this->session->userdata('dados_acesso') : null;
if(!is_null($dados_acesso)){
	switch($dados_acesso['administrador_nivel']){
		case 'A':
		$nivel = '<em>Administrador</em>';
		break;
		case 'U':
		$nivel = '<em>Usuário</em>';
		break;
		case 'S':
		$nivel = '<em>Suporte</em>';
		break;
	}
	$nome = $dados_acesso['administrador_nome'];
	$caminho_menu = base_url();
	echo '
	<div class="col-md-9 col-xs-12">
		<ul class="nav nav-pills">
			<li>
				<a href="'.$caminho_menu.'ocorrencia">
					<img src="'.$caminho_menu.'assets/img/icone/vagas.png" style="position: relative; top: -2px; margin-right: 5px; max-height: 18px;" /> 
					OCORRÊNCIAS
				</a>
			</li>';
			if($dados_acesso['administrador_nivel'] != 'U'){
			echo'
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				<img src="'.$caminho_menu.'assets/img/icone/cadastrar.png" /> MONITORAMENTO <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="'.$caminho_menu.'checklist">Chechklist Diário da Frota</a></li>
					<li><a href="'.$caminho_menu.'monitoramento">Monitoramento Diário</a></li>
				</ul>
			</li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				<img src="'.$caminho_menu.'assets/img/icone/cadastrar.png" /> RELATÓRIOS <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="'.$caminho_menu.'checklist/relatorio">Relatório Chechklist Diário da Frota</a></li>
					<li><a href="'.$caminho_menu.'ocorrencia/relatorio">Relatório de Ocorrências</a></li>
					<li><a href="'.$caminho_menu.'monitoramento/relatorio">Relatório de Monitoramento Diário</a></li>
				</ul>
			</li>
			<li>
				<a href="'.$caminho_menu.'administrador/select">
					<img src="'.$caminho_menu.'assets/img/icone/administrativo.png" style="position: relative; top: -2px; margin-right: 5px; max-height: 18px;" /> 
					USUÁRIOS
				</a>
			</li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				<img src="'.$caminho_menu.'assets/img/icone/cadastrar.png" /> CADASTROS <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="'.$caminho_menu.'computador">Computadores</a></li>					
					<li><a href="'.$caminho_menu.'sistema">Sistemas</a></li>					
					<li><a href="'.$caminho_menu.'tipo_ocorrencia">Tipo Ocorrência</a></li>
					<li><a href="'.$caminho_menu.'veiculo">Veículos</a></li>
				</ul>
			</li>';
			}
		
		echo '			
		</ul>
	</div>';

	echo '
	<div class="col-md-2 col-xs-12">
		<p float-right" style="text-align:right; padding-top:7px;">
			<em>Logado como: <strong>'.$nome.' ('.$nivel.')</strong></em>
		</p>
	</div>
	<div class="col-md-1 col-xs-12">
		<ul class="nav nav-pills float-right">
			<li role="presentation"><a href="'.$caminho_menu.'administrador/logout"><img src="'.$caminho_menu.'assets/img/icone/sair.png" /> SAIR</a></li>
		</ul>
	</div>
	';
}
?>
</div>