<?php echo $this->load->view('includes/header'); ?>
<?php echo $this->load->view('includes/menu'); ?>

<!-- CONTEUDO -->
<div class="content container-fluid padding-top-20">
	<?php
	if($this->session->flashdata('error')){
    	echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
    }
    if($this->session->flashdata('success')){
    	echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
    }
	?>
	<input type="hidden" class="base_url" name="base_url" value="<?php echo base_url(); ?>">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="panel panel-default">				
				<?php $this->load->view($view); ?>			
			</div>
		</div>
	</div>
</div>
<!-- CONTEUDO -->
<?php echo $this->load->view('includes/footer'); ?>