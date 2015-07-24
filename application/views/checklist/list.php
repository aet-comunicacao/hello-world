				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>checklists cadastrados</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('checklist/edit'); ?>" class="btn btn-success btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									NOVO CHECKLIST
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
										<th>Data</th>										
										<th>Quantidade de Veículos</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(count($checklists)){ 
										foreach($checklists as $checklist){
											$checklist_data_dia = str_replace('-', '_', $checklist['checklist_data_dia']);
									?>
										<tr>
											<td><?php echo dateFromDb($checklist['checklist_data_dia']); ?></td>
											<td><?php echo $checklist['qtd']; ?></td>
											<td>
												<a href="<?php echo base_url('checklist/edit/'.$checklist['checklist_data_dia']); ?>" class="btn btn-primary">Detalhes</a>
												<a href="#" onclick="excluir('<?php echo $checklist_data_dia; ?>')" class="btn btn-danger">Excluir</a>
											</td>
										<tr>
									<?php }} ?>
								</tbody>
							</table>
							<?php //echo (isset($pagination)) ? $pagination : null; ?>
						</div>
					</div>
				</div>
