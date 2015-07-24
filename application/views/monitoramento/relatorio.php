				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">							
							<form action="<?php base_url('monitoramento/relatorio'); ?>" method="post" class="form-inline">
								<label>Data do monitoramento:</label>
								<input type="text" name="data" class="data form-control" autofocus="autofocus" value="<?php echo isset($data_dia) ? $data_dia: null; ?>">
								<input type="submit" value="Buscar" class="btn btn-primary">
								<a href="<?php base_url('monitoramento/relatorio'); ?>" class="btn btn-warning">Limpar</a>
							</form>
						</div>
					</div>
				</div>

				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12 col-xs-12 padding-bottom-20">							
							<?php

								//var_dump($checklists);

								if($monitoramentos){ 
									if($monitoramentos != 'NULL'){
							?>

							<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Veículo</th>
											<th>Retirado</th>
											<th>Inserido</th>
											<th>Cam 1</th>
											<th>Cam 2</th>
											<th>Cam 3</th>
											<th>Cam 4</th>
											<th>MDVR</th>
											<th>Lacre</th>
											<th>Ass.</th>
										</tr>
									</thead>
									<tbody>

							<?php foreach($monitoramentos  as $value){ ?>
								
								<tr>
									<td><?php echo $value['veiculo_nome']; ?></td>
									<td><?php echo $value['monitoramento_retirado']; ?></td>
									<td><?php echo $value['monitoramento_inserido']; ?></td>
									<td><?php echo $value['monitoramento_cam1']; ?></td>
									<td><?php echo $value['monitoramento_cam2']; ?></td>
									<td><?php echo $value['monitoramento_cam3']; ?></td>
									<td><?php echo $value['monitoramento_cam4']; ?></td>
									<td><?php echo $value['monitoramento_mdvr']; ?></td>
									<td><?php echo $value['monitoramento_lacre']; ?></td>
									<td><?php echo $value['monitoramento_ass']; ?></td>
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
