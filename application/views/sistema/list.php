				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>sistemas cadastrados</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('sistema/edit'); ?>" class="btn btn-success btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									NOVO SISTEMA
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
										<th>Status</th>
										<th>Data</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(count($sistemas)){
										foreach ($sistemas as $sistema) {
											$status = $sistema['sistema_status'] == 1 ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
									?>
									<tr>
										<td><?php echo $sistema['sistema_nome']; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo dateFromDb($sistema['sistema_data']); ?></td>
										<td>
											<a href="<?php echo base_url('sistema/edit/'.$sistema['sistema_id']); ?>" class="btn btn-primary">Alterar</a>
											<?php if($sistema['sistema_status'] == 1){ ?>
												<a href="#" onclick="inativar(<?php echo $sistema['sistema_id']; ?>)" class="btn btn-danger">Inativar</a>
											<?php }else{ ?>
												<a href="#" onclick="ativar(<?php echo $sistema['sistema_id']; ?>)" class="btn btn-success">Ativar</a>
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
