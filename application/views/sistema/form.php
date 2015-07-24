				<?php
				$sistema_id = isset($sistema['sistema_id']) ? $sistema['sistema_id'] : 0;
				$sistema_nome = isset($sistema['sistema_nome']) ? $sistema['sistema_nome'] : null;
				$sistema_status = isset($sistema['sistema_status']) ? $sistema['sistema_status'] : 1;
				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do sistema</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('sistema'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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
							
							<form action="<?php echo base_url('sistema/edit'); ?>" method="post">

								<input type="hidden" name="sistema_id" value="<?php echo $sistema_id; ?>">
								
								<div class="form-group">
									<label>Nome:</label><br/>
									<input type="text" name="sistema_nome" class="form-control" id="sistema_nome" value="<?php echo $sistema_nome; ?>">
								</div>
								
								<div class="form-group">
									<label>Status:</label><br/>
									<select name="sistema_status" class="form-control">
										<option value="1" <?php echo $sistema_status == 1 ? 'selected' : null; ?>>Ativo</option>
										<option value="0" <?php echo $sistema_status == 0 ? 'selected' : null; ?>>Inativo</option>
									</select>
								</div>
								
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Salvar">
								</div>

							</form>

						</div>
					</div>
				</div>