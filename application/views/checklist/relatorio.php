				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">							
							<form action="<?php base_url('checklist/relatorio'); ?>" method="post" class="form-inline">
								<label>Data do checklist:</label>
								<input type="text" name="data" class="data form-control" autofocus="autofocus" value="<?php echo isset($data_dia) ? $data_dia: null; ?>">
								<input type="submit" value="Buscar" class="btn btn-primary">
								<a href="<?php base_url('checklist/relatorio'); ?>" class="btn btn-warning">Limpar</a>
							</form>
						</div>
					</div>
				</div>

				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12 col-xs-12 padding-bottom-20">							
							<?php

								//var_dump($checklists);

								if($checklists){ 
									if($checklists != 'NULL'){
							?>

							<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Veículo</th>
											<th>Início</th>
											<th>Status das Câmeras</th>
										</tr>
									</thead>
									<tbody>

							<?php foreach($checklists  as $value){ ?>
								
								<tr>
									<td><?php echo $value['veiculo_nome']; ?></td>
									<td><?php echo $value['checklist_data_inicio']; ?></td>
									<td><?php echo $value['checklist_status_cameras']; ?></td>
								<tr>

							<?php }	?>

									</tbody>
								</table>

							<?php
									}else{
										echo '<div class="alert alert-danger">Nenhum registro encontrado nessa data.</div>';
									}
								}
								else{
									//echo '<div class="alert alert-danger">Nenhum registro foi encontrado nesta data.</div>';
								}
							?>
						</div>
					</div>
				</div>
