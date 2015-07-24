				<?php
				$veiculo_id = isset($veiculo['veiculo_id']) ? $veiculo['veiculo_id'] : 0;
				$veiculo_nome = isset($veiculo['veiculo_nome']) ? $veiculo['veiculo_nome'] : null;
				$veiculo_status = isset($veiculo['veiculo_status']) ? $veiculo['veiculo_status'] : 1;
				$computador_id = isset($veiculo['computador_id']) ? $veiculo['computador_id'] : null;
				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do veículo</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('veiculo'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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
							
							<form action="<?php echo base_url('veiculo/edit'); ?>" method="post">

								<input type="hidden" name="veiculo_id" value="<?php echo $veiculo_id; ?>">
								
								<div class="form-group">
									<label>Nome:</label><br/>
									<input type="text" name="veiculo_nome" class="form-control" id="veiculo_nome" value="<?php echo $veiculo_nome; ?>">
								</div>

								<div class="form-group">
									<label>Computador:</label>
									<select name="computador_id" class="form-control">
										<?php
										if(count($computadores)){
											foreach($computadores as $computador){
												$select = ($computador['computador_id'] == $computador_id) ? 'selected' : null;
												echo "<option value='".$computador['computador_id']."' {$select}>{$computador['computador_nome']}</option>";
											}
										}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<label>Status:</label><br/>
									<select name="veiculo_status" class="form-control">
										<option value="1" <?php echo $veiculo_status == 1 ? 'selected' : null; ?>>Ativo</option>
										<option value="0" <?php echo $veiculo_status == 0 ? 'selected' : null; ?>>Inativo</option>
									</select>
								</div>
								
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Salvar">
								</div>

							</form>

						</div>
					</div>
				</div>