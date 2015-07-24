				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>tipos de ocorrência cadastrados</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('tipo_ocorrencia/edit'); ?>" class="btn btn-success btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									NOVO TIPO DE OCORRÊNCIA
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
									if(count($tipo_ocorrencias)){
										foreach ($tipo_ocorrencias as $tipo_ocorrencia) {
											$status = $tipo_ocorrencia['tipo_ocorrencia_status'] == 1 ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
									?>
									<tr>
										<td><?php echo $tipo_ocorrencia['tipo_ocorrencia_nome']; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo dateFromDb($tipo_ocorrencia['tipo_ocorrencia_data']); ?></td>
										<td>
											<a href="<?php echo base_url('tipo_ocorrencia/edit/'.$tipo_ocorrencia['tipo_ocorrencia_id']); ?>" class="btn btn-primary">Alterar</a>
											<?php if($tipo_ocorrencia['tipo_ocorrencia_status'] == 1){ ?>
												<a href="#" onclick="inativar(<?php echo $tipo_ocorrencia['tipo_ocorrencia_id']; ?>)" class="btn btn-danger">Inativar</a>
											<?php }else{ ?>
												<a href="#" onclick="ativar(<?php echo $tipo_ocorrencia['tipo_ocorrencia_id']; ?>)" class="btn btn-success">Ativar</a>
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
