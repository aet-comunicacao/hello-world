				<?php
				$ocorrencia_id = isset($ocorrencia['ocorrencia_id']) ? $ocorrencia['ocorrencia_id'] : 0;
				$ocorrencia_status = isset($ocorrencia['ocorrencia_status']) ? $ocorrencia['ocorrencia_status'] : 1;
				$veiculo_id = isset($ocorrencia['veiculo_id']) ? $ocorrencia['veiculo_id'] : null;
				$sistema_id = isset($ocorrencia['sistema_id']) ? $ocorrencia['sistema_id'] : null;
				$tipo_ocorrecia_id = isset($ocorrencia['tipo_ocorrecia_id']) ? $ocorrencia['tipo_ocorrecia_id'] : null;
				$ocorrencia_qtd_passageiros = isset($ocorrencia['ocorrencia_qtd_passageiros']) ? $ocorrencia['ocorrencia_qtd_passageiros'] : null;
				$ocorrencia_pagamento_tarifa = isset($ocorrencia['ocorrencia_pagamento_tarifa']) ? dateFromDb($ocorrencia['ocorrencia_pagamento_tarifa']) : null;
				$ocorrencia_passageiro_descendo = isset($ocorrencia['ocorrencia_passageiro_descendo']) ? dateFromDb($ocorrencia['ocorrencia_passageiro_descendo']) : null;
				$ocorrencia_encerramento_catraca = isset($ocorrencia['ocorrencia_encerramento_catraca']) ? dateFromDb($ocorrencia['ocorrencia_encerramento_catraca']) : null;
				$ocorrencia_data_filmagem = isset($ocorrencia['ocorrencia_data_filmagem']) ? dateFromDb($ocorrencia['ocorrencia_data_filmagem']) : null;
				$ocorrencia_img = isset($ocorrencia['ocorrencia_img']) ? $ocorrencia['ocorrencia_img'] : null;
				$disabled=null;

				//verificando se disabilita a edição
				if($ocorrencia_id > 0){
					$dados_acesso = $this->session->userdata('dados_acesso');
					//só pode alterar os dados se for um USUÁRIO e a ocorrencia estiver PENDENTE
						
					//var_dump($ocorrencia_status, $dados_acesso['administrador_nivel']);

					if($ocorrencia_status == 'P'){
						if($dados_acesso['administrador_nivel'] == 'A'){
							$disabled = 'disabled="disabled"';
						}
					}elseif($ocorrencia_status != 'P'){
						if($dados_acesso['administrador_nivel'] == 'U'){
							$disabled = 'disabled="disabled"';
						}
					}

				}

				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados da ocorrência</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('ocorrencia'); ?>" class="btn btn-danger btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									VOLTAR
								</strong>
							</a>
						</div>
					</div>
				</div>

				<div class="panel-body">

					<div class="msgErro alert alert-danger"></div>
					
					<div class="row">
						<div class="col-md-12 col-xs-12 padding-bottom-20">
							
							<form action="<?php echo base_url('ocorrencia/edit'); ?>" method="post" onsubmit="return validForm()" enctype="multipart/form-data">

								<input type="hidden" name="ocorrencia_id" value="<?php echo $ocorrencia_id; ?>">

								<div class="form-group">
									<label>Tipo ocorrência:</label><br/>
									<select name="tipo_ocorrencia_id" class="form-control" autofocus="autofocus" <?php echo $disabled; ?>>
										<?php
										if(count($tipo_ocorrencias)>0){
											foreach($tipo_ocorrencias as $tipo_ocorrencia){
												$selected = $tipo_ocorrencia['tipo_ocorrencia_id'] == $tipo_ocorrencia_id ? 'selected' : null;
												echo "<option value='".$tipo_ocorrencia['tipo_ocorrencia_id']."' {$selected}>{$tipo_ocorrencia['tipo_ocorrencia_nome']}</option>";
											}
										}
										?>
									</select>
								</div>
								
								<!--
								<div class="form-group">
									<label>Computador:</label><br/>
									<select name="computador_id" id="computador_id" class="form-control">
										<option value="0">Lista de Computadores</option>
										<?php
										/*if(count($computadores)>0){
											foreach($computadores as $computador){
												$selected = $computador['computador_id'] == $computador_id ? 'selected' : null;
												echo "<option value='".$computador['computador_id']."' {$selected}>{$computador['computador_nome']}</option>";
											}
										}*/
										?>
									</select>
								</div>
								-->

								<div class="form-group">
									<label>Veículo:</label><br/>
									<select name="veiculo_id" id="veiculo_id" class="form-control" <?php echo $disabled; ?>>
										<option value="0">Lista de Veículos</option>
										<?php
										if(count($veiculos)>0){
											foreach($veiculos as $veiculo){
												$selected = $veiculo['veiculo_id'] == $veiculo_id ? 'selected' : null;
												echo "<option value='".$veiculo['veiculo_id']."' {$selected}>{$veiculo['veiculo_nome']}</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label>Sistema:</label><br/>
									<select name="sistema_id" class="form-control" <?php echo $disabled; ?>>
										<?php
										if(count($sistemas)>0){
											foreach($sistemas as $sistema){
												$selected = $sistema['sistema_id'] == $sistema_id ? 'selected' : null;
												echo "<option value='".$sistema['sistema_id']."' {$selected}>{$sistema['sistema_nome']}</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label>Data/hora filmagem:</label><br/>
									<input type="text" name="ocorrencia_data_filmagem" class="data_hora form-control" id="ocorrencia_nome" 
									value="<?php echo $ocorrencia_data_filmagem; ?>" <?php echo $disabled; ?>>
								</div>

								<div class="form-group">
									<label>Pagamento de Tarifa:</label><br/>
									<input type="text" name="ocorrencia_pagamento_tarifa" class="data_hora form-control" id="ocorrencia_nome" 
									value="<?php echo $ocorrencia_pagamento_tarifa; ?>" <?php echo $disabled; ?>>
								</div>

								<div class="form-group">
									<label>Passageiro Descendo:</label><br/>
									<input type="text" name="ocorrencia_passageiro_descendo" class="data_hora form-control" id="ocorrencia_nome" 
									value="<?php echo $ocorrencia_passageiro_descendo; ?>" <?php echo $disabled; ?>>
								</div>

								<div class="form-group">
									<label>Encerramento da catraca ponto final:</label><br/>
									<input type="text" name="ocorrencia_passageiro_descendo" class="data_hora form-control" id="ocorrencia_nome" 
									value="<?php echo $ocorrencia_passageiro_descendo; ?>" <?php echo $disabled; ?>>
								</div>

								<div class="form-group">
									<label>Quantidade de Passageiros:</label><br/>
									<input type="text" name="ocorrencia_qtd_passageiros" class="form-control" id="ocorrencia_nome" 
									value="<?php echo $ocorrencia_qtd_passageiros; ?>" <?php echo $disabled; ?>>
								</div>

								<div class="form-group">
									<label>Anexar Imagem:</label><br/>
									<input type="file" name="ocorrencia_img" class="form-control" id="ocorrencia_img" 
									value="<?php echo $ocorrencia_qtd_passageiros; ?>" <?php echo $disabled; ?>>
								</div>

								<?php
									if(isset($ocorrencia_img)){
										echo '<div class="form-group"><img src="'.base_url("uploads/ocorrencia/{$ocorrencia_img}").'"></div>';
									}
								?>
								
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Salvar">
								</div>

							</form>

						</div>
					</div>
				</div>