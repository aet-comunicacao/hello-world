				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do checklist</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('monitoramento'); ?>" class="btn btn-danger btn-sm" style="float: right;">
								<strong>
									<span class="glyphicon glyphicon-plus-sign"></span> 
									VOLTAR
								</strong>
							</a>
						</div>
					</div>
				</div>

				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12 col-xs-12 padding-bottom-20">
							
							<form action="<?php echo base_url('checklist/edit'); ?>" method="post">

								<div class="col-md-11 form-group">
									<label>Data Hoje Monitoramento:</label><br/>
									<input type="text" name="monitoramento_dia" class="data form-control" id="monitoramento_dia" 
									value="<?php echo $monitoramento_dia; ?>" <?php echo $monitoramento_dia > 0 ? 'readonly="true"' : null; ?> autofocus="autofocus">
								</div>

								<div class="col-md-1 form-group" style="padding-top:26px;">
									<input type="button" value="Cadastrar Data" id="btnDataHoje" class="btn btn-primary">
								</div>						
								
								<div class="form-group">
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
										<?php
										if(count($veiculos)){
											foreach($veiculos as $veiculo){
											$monitoramento_retirado = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_retirado'] : null;
											$monitoramento_inserido = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_inserido'] : null;
											$monitoramento_cam1 = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_cam1'] : null;
											$monitoramento_cam2 = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_cam2'] : null;
											$monitoramento_cam3 = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_cam3'] : null;
											$monitoramento_cam4 = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_cam4'] : null;
											$monitoramento_mdvr = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_mdvr'] : null;
											$monitoramento_lacre = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_lacre'] : null;
											$monitoramento_ass = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['monitoramento_ass'] : null;
										?>
										<tr>
											<td><?php echo $veiculo['veiculo_nome']; ?></td>
											<td>
												<input type="text" name="monitoramento_retirado" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_retirado form-control" campo="monitoramento_retirado" value="<?php echo $monitoramento_retirado; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_inserido" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_inserido form-control" campo="monitoramento_inserido" value="<?php echo $monitoramento_inserido; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_cam1" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_cam1 form-control" campo="monitoramento_cam1" value="<?php echo $monitoramento_cam1; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_cam2" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_cam2 form-control" campo="monitoramento_cam2" value="<?php echo $monitoramento_cam2; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_cam3" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_cam3 form-control" campo="monitoramento_cam3" value="<?php echo $monitoramento_cam3; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_cam4" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_cam4 form-control" campo="monitoramento_cam4" value="<?php echo $monitoramento_cam4; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_mdvr" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_mdvr form-control" campo="monitoramento_mdvr" value="<?php echo $monitoramento_mdvr; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_lacre" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_lacre form-control" campo="monitoramento_lacre" value="<?php echo $monitoramento_lacre; ?>">
											</td>
											<td>
												<input type="text" name="monitoramento_ass" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="monitoramento_ass form-control" campo="monitoramento_ass" value="<?php echo $monitoramento_ass; ?>">
											</td>						
											
										</tr>
										<?php }} ?>
									</tbody>
								</table>
								</div>
								
								<div class="form-group">
									<a href="<?php echo base_url('checklist'); ?>" class='btn btn-success'>Salvar</a>
								</div>

							</form>

						</div>
					</div>
				</div>