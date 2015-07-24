				<?php $dados_acesso = $this->session->userdata('dados_acesso');?>
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-12 col-xs-12 alinha-texto-esquerda">							
							<form action="<?php base_url('ocorrencia/relatorio'); ?>" method="post" class="form-inline">
								<label>Data Inicial de Cadastro:</label>
								<input type="text" name="data_de" class="data form-control" autofocus="autofocus" value="<?php echo isset($data_inicial) ? $data_inicial: null; ?>">

								<label>Data Final:</label>
								<input type="text" name="data_ate" class="data form-control" value="<?php echo isset($data_final) ? $data_final: null; ?>">

								<label>Tipo Ocorrência:</label>
								<select name="tipo_ocorrencia_id" class="form-control">
									<option value="0">Todos</option>
									<?php
									if(count($tipo_ocorrencias)){
										foreach($tipo_ocorrencias as $tipo){
											$selected = (isset($tipo_ocorrencia_id) && $tipo['tipo_ocorrencia_id'] == $tipo_ocorrencia_id) ? 'selected' : null;
											echo "<option value=".$tipo['tipo_ocorrencia_id']." {$selected}>{$tipo['tipo_ocorrencia_nome']}</option>";
										}
									}
									?>
								</select>

								<label>Veículo:</label>
								<select name="veiculo_id" class="form-control">
									<option value="0">Todos</option>
									<?php
									if(count($veiculos)){
										foreach($veiculos as $veiculo){
											$selected = (isset($veiculo_id) && $veiculo['veiculo_id'] == $veiculo_id) ? 'selected' : null;
											echo "<option value=".$veiculo['veiculo_id']." {$selected}>{$veiculo['veiculo_nome']}</option>";
										}
									}
									?>
								</select>

								<input type="submit" value="Buscar" class="btn btn-primary">
								<a href="<?php base_url('ocorrencia/relatorio'); ?>" class="btn btn-warning">Limpar</a>
							</form>
						</div>
					</div>
				</div>

				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12 col-xs-12 padding-bottom-20">							
							<table class="table table-striped table-hover">									
								<thead>
									<tr>
										<th>Protocolo</th>
										<th>Tipo Ocorrência</th>
										<th>Veículo</th>
										<th>Sistema</th>
										<th>Data Filmagem</th>
										<th>Data Cadastro</th>
										<th>Status</th>
										<th>Cadastrado por</th>
										<th>Aprovado por</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($ocorrencias) && count($ocorrencias)>0){

										$qtd = count($ocorrencias);
										echo "<p>Foram encontardos:<span class='label label-primary'>$qtd regístros</span></p>";

										foreach ($ocorrencias as $ocorrencia) {
											switch($ocorrencia['ocorrencia_status']){

												case 'P':
												$status = '<span class="label label-warning">Pendente</span>';
												break;

												case 'A':
												$status = '<span class="label label-success">Aprovado</span>';
												break;

												case 'R':
												$status = '<span class="label label-default">Reprovado</span>';
												break;

												case 'I':
												$status = '<span class="label label-danger">Inativo</span>';
												break;

											}
									?>
									<tr>
										<td><?php echo $ocorrencia['ocorrencia_id']; ?></td>
										<td><?php echo $ocorrencia['tipo_ocorrencia_nome']; ?></td>
										<td><?php echo $ocorrencia['veiculo_nome']; ?></td>
										<td><?php echo $ocorrencia['sistema_nome']; ?></td>
										<td><?php echo dateFromDb($ocorrencia['ocorrencia_data_filmagem']); ?></td>										
										<td><?php echo dateFromDb($ocorrencia['ocorrencia_data']); ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $ocorrencia['adm_cadastro'];	?></td>		
										<td><?php echo $ocorrencia['adm_aprovacao']; ?></td>								
									</tr>
									<?php }} ?>
								</tbody>
							</table>
							<?php echo (isset($pagination)) ? $pagination : null; ?>
						</div>
					</div>

				</div>