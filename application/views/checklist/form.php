				<?php

				/*echo '<pre>';
				var_dump($checklist, $collection);
				echo '</pre>';*/

				$checklist_id = isset($checklist['checklist_id']) ? $checklist['checklist_id'] : 0;
				$checklist_nome = isset($checklist['checklist_nome']) ? $checklist['checklist_nome'] : null;
				$checklist_status = isset($checklist['checklist_status']) ? $checklist['checklist_status'] : 1;
				$checklist_data_inicio = isset($checklist['checklist_data_inicio']) ? dateFromDb($checklist['checklist_data_inicio']) : null;
				//$checklist_data_dia = isset($checklist[0]['checklist_data_dia']) ? dateFromDb($checklist[0]['checklist_data_dia']) : date('d/m/Y');				

				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do checklist</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('checklist'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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

								<input type="hidden" name="checklist_id" id="checklist_id" value="<?php echo $checklist_id; ?>">
								
								<div class="col-md-11 form-group">
									<label>Data Hoje Checklist:</label><br/>
									<input type="text" name="checklist_data_dia" class="data form-control" id="checklist_data_dia" 
									value="<?php echo $checklist_data_dia; ?>" <?php echo $checklist_data_dia > 0 ? 'readonly="true"' : null; ?> autofocus="autofocus">
								</div>

								<div class="col-md-1 form-group" style="padding-top:26px;">
									<input type="button" value="Cadastrar Data" id="btnDataHoje" class="btn btn-primary">
								</div>
								
								<div class="form-group">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Veículo</th>
											<th>Início</th>
											<th>Status das Câmeras</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(count($veiculos)){
											foreach($veiculos as $veiculo){
											$data_ini = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['checklist_data_inicio'] : null;
											$status_cam = isset($collection[$veiculo['veiculo_id']]) ? $collection[$veiculo['veiculo_id']]['checklist_status_cameras'] : null;
										?>
										<tr>
											<td><?php echo $veiculo['veiculo_nome']; ?></td>
											<td>
												<input type="text" name="checklist_data_inicio" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="hora checklist_data_inicio form-control" value="<?php echo $data_ini; ?>">
											</td>
											<td>
												<input type="text" name="checklist_status_camera" vid="<?php echo $veiculo['veiculo_id']; ?>" 
												class="checklist_status_camera form-control" value="<?php echo $status_cam; ?>">
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