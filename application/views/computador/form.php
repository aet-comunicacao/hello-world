				<?php
				$computador_id = isset($computador['computador_id']) ? $computador['computador_id'] : 0;
				$computador_nome = isset($computador['computador_nome']) ? $computador['computador_nome'] : null;
				$computador_status = isset($computador['computador_status']) ? $computador['computador_status'] : 1;
				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do computador</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('computador'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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
							
							<form action="<?php echo base_url('computador/edit'); ?>" method="post">

								<input type="hidden" name="computador_id" value="<?php echo $computador_id; ?>">
								
								<div class="form-group">
									<label>Nome:</label><br/>
									<input type="text" name="computador_nome" class="form-control" id="computador_nome" value="<?php echo $computador_nome; ?>">
								</div>
								
								<div class="form-group">
									<label>Status:</label><br/>
									<select name="computador_status" class="form-control">
										<option value="1" <?php echo $computador_status == 1 ? 'selected' : null; ?>>Ativo</option>
										<option value="0" <?php echo $computador_status == 0 ? 'selected' : null; ?>>Inativo</option>
									</select>
								</div>
								
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Salvar">
								</div>

							</form>

						</div>
					</div>
				</div>