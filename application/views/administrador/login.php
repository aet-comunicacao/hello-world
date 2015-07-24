<div class="container-fluid padding-top-20">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong><span class="glyphicon glyphicon-star"></span> Acessar Sistema</strong>
				</div>
				<div class="panel-body">					
					<div class="row">
						<form action="<?php echo base_url('administrador/login'); ?>" method="post">
						  <div class="col-md-6 col-xs-12">
							  <div class="form-group">
							    <label>Login</label>
							    <input type="text" name="login" class="form-control">
							  </div>
						  </div>
						  <div class="col-md-6 col-xs-12">
							  <div class="form-group">
							    <label>Senha</label>
							    <input type="password" name="senha" class="form-control">
							  </div>
						  </div>
						  <div class="col-md-12 col-xs-12">
						  	<input type="submit" class="btn btn-success" style="width:100%;" value="ACESSAR CONTA">
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
