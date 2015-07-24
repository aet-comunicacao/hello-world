				<?php
				$administrador_id = isset($administrador['administrador_id']) ? $administrador['administrador_id'] : 0;
				$administrador_nome = isset($administrador['administrador_nome']) ? $administrador['administrador_nome'] : null;
				$administrador_email = isset($administrador['administrador_email']) ? $administrador['administrador_email'] : null;
				$administrador_status = isset($administrador['administrador_status']) ? $administrador['administrador_status'] : 1;
				$administrador_nivel = isset($administrador['administrador_nivel']) ? $administrador['administrador_nivel'] : null;
				?>

				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6 col-xs-12 alinha-texto-esquerda">
							<strong>Dados do administrador</strong>
						</div>
						<div class="col-md-6 col-xs-12 alinha-texto-direita">
							<a href="<?php echo base_url('administrador/select'); ?>" class="btn btn-danger btn-sm" style="float: right;">
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
							
							<form action="<?php echo base_url('administrador/edit'); ?>" method="post">

								<input type="hidden" name="administrador_id" value="<?php echo $administrador_id; ?>">

								<label>Nome:</label><br/>
								<input type="text" name="administrador_nome" class="form-control" id="administrador_nome" value="<?php echo $administrador_nome; ?>">

								<br/>

								<label>E-mail:</label><br/>
								<input type="email" name="administrador_email" class="form-control" value="<?php echo $administrador_email; ?>">

								<br/>

								<label>Senha:</label><br/>
								<input type="password" name="administrador_senha" class="form-control" value="">

								<br/>

								<label>Status:</label><br/>
								<select name="administrador_status" class="form-control">
									<option value="1" <?php echo $administrador_status == 1 ? 'selected' : null; ?>>Ativo</option>
									<option value="0" <?php echo $administrador_status == 0 ? 'selected' : null; ?>>Inativo</option>
								</select>

								<br/>

								<label>Nível de acesso:</label><br/>
								<select name="administrador_nivel" class="form-control">
									<option value="U" <?php echo $administrador_nivel == 'U' ? 'selected' : null; ?>>Usuário</option>
									<option value="S" <?php echo $administrador_nivel == 'S' ? 'selected' : null; ?>>Suporte</option>
									<option value="A" <?php echo $administrador_nivel == 'A' ? 'selected' : null; ?>>Administrador</option>
								</select>

								<br/>

								<input type="submit" class="btn btn-success" value="Salvar">

							</form>

						</div>
					</div>
				</div>