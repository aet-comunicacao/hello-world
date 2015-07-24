				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Administradores cadastrados</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('administrador/edit'); ?>" class="btn btn-success btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									NOVO ADMINISTRADOR
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
										<th>Nome</th>
										<th>E-mail</th>
										<th>Status</th>
										<th>Nível</th>
										<th>Data de Cadastro</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(count($administradores)){
										foreach ($administradores as $administrador) {
											$status = $administrador['administrador_status'] == 1 ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
											switch($administrador['administrador_nivel']){
												case 'A':
												$nivel = '<span class="label label-default">Administrador</span>';
												break;

												case 'U':
												$nivel = '<span class="label label-primary">Usuário</span>';
												break;

												case 'S':
												$nivel = '<span class="label label-warning">Suporte</span>';
												break;
											}
									?>
									<tr>
										<td><?php echo $administrador['administrador_nome']; ?></td>
										<td><?php echo $administrador['administrador_email']; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $nivel; ?></td>
										<td><?php echo dateFromDb($administrador['administrador_data']); ?></td>
										<td>
											<a href="<?php echo base_url('administrador/edit/'.$administrador['administrador_id']); ?>" class="btn btn-primary">Alterar</a>
											<?php if($administrador['administrador_status'] == 1){ ?>
												<a href="#" onclick="inativar(<?php echo $administrador['administrador_id']; ?>)" class="btn btn-danger">Inativar</a>
											<?php }else{ ?>
												<a href="#" onclick="ativar(<?php echo $administrador['administrador_id']; ?>)" class="btn btn-success">Ativar</a>
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