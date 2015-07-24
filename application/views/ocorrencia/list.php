				<?php $dados_acesso = $this->session->userdata('dados_acesso');	?>
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>ocorrências cadastradas</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('ocorrencia/edit'); ?>" class="btn btn-success btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									NOVA OCORRÊNCIA
								</strong>
							</a>
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
										<th><?php echo $dados_acesso['administrador_nivel'] != 'U' ? 'Cadastrado por' : 'Por'; ?></th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(count($ocorrencias)){
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
										<td>
										<?php
											if($dados_acesso['administrador_nivel'] == 'A'){
												echo !is_null($ocorrencia['adm_cadastro']) ? $ocorrencia['adm_cadastro'] : '-';
											}
											else{
												echo !is_null($ocorrencia['adm_aprovacao']) ? $ocorrencia['adm_aprovacao'] : null;
												echo !is_null($ocorrencia['adm_reprovacao']) ? $ocorrencia['adm_reprovacao'] : null;												
											}
										?>
										</td>
										<td>

											<a href="<?php echo base_url('ocorrencia/edit/'.$ocorrencia['ocorrencia_id']); ?>" class="btn btn-primary">Detalhes</a>

											<!--NÃO ADMINISTRADOR-->
											<?php if($dados_acesso['administrador_nivel'] == 'U' && $ocorrencia['ocorrencia_status'] == 'P'){ ?>
												<a href="#" onclick="inativar(<?php echo $ocorrencia['ocorrencia_id']; ?>)" class="btn btn-danger">Inativar</a>
											<?php }elseif($dados_acesso['administrador_nivel'] != 'U' && ($ocorrencia['ocorrencia_status'] == 'A' || $ocorrencia['ocorrencia_status'] == 'P')){?>
												<a href="#" onclick="reprovar(<?php echo $ocorrencia['ocorrencia_id']; ?>)" class="btn btn-default">Reprovar</a>
											<?php } ?>

											<!--NÃO USUÁRIO-->											
											<?php if($dados_acesso['administrador_nivel'] != 'U' && ($ocorrencia['ocorrencia_status'] == 'R' || $ocorrencia['ocorrencia_status'] == 'P')){ ?>
												<a href="#" onclick="ativar(<?php echo $ocorrencia['ocorrencia_id']; ?>)" class="btn btn-success">Aprovar</a>
											<?php } ?>

										</td>
									</tr>
									<?php }} ?>
								</tbody>
							</table>
							<?php echo (isset($pagination)) ? $pagination : null; ?>
						</div>
					</div>
				</div>
