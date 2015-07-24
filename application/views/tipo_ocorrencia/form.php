				<?php
				$tipo_ocorrencia_id = isset($tipo_ocorrencia['tipo_ocorrencia_id']) ? $tipo_ocorrencia['tipo_ocorrencia_id'] : 0;
				$tipo_ocorrencia_nome = isset($tipo_ocorrencia['tipo_ocorrencia_nome']) ? $tipo_ocorrencia['tipo_ocorrencia_nome'] : null;
				$tipo_ocorrencia_status = isset($tipo_ocorrencia['tipo_ocorrencia_status']) ? $tipo_ocorrencia['tipo_ocorrencia_status'] : 1;
				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do tipo de ocorrência</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('tipo_ocorrencia'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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
							
							<form action="<?php echo base_url('tipo_ocorrencia/edit'); ?>" method="post">

								<input type="hidden" name="tipo_ocorrencia_id" value="<?php echo $tipo_ocorrencia_id; ?>">
								
								<div class="form-group">
									<label>Nome:</label><br/>
									<input type="text" name="tipo_ocorrencia_nome" class="form-control" id="tipo_ocorrencia_nome" value="<?php echo $tipo_ocorrencia_nome; ?>">
								</div>
								
								<div class="form-group">
									<label>Status:</label><br/>
									<select name="tipo_ocorrencia_status" class="form-control">
										<option value="1" <?php echo $tipo_ocorrencia_status == 1 ? 'selected' : null; ?>>Ativo</option>
										<option value="0" <?php echo $tipo_ocorrencia_status == 0 ? 'selected' : null; ?>>Inativo</option>
									</select>
								</div>
								
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Salvar">
								</div>

							</form>

						</div>
					</div>
				</div>