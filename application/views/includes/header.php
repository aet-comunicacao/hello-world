<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<title><?php echo $title; ?></title>
<meta name="author" content="Arte & Tecnologia Comunicação" />
<?php
	echo mainAssets();
	echo moduleAssets();
?>

<!--textext autocomplete-->
<script src="<?php echo base_url("assets/js/textext/src/js/textext.core.js"); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("assets/js/textext/src/js/textext.plugin.autocomplete.js"); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("assets/js/textext/src/js/textext.plugin.ajax.js"); ?>" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/js/textext/src/css/textext.plugin.autocomplete.css"); ?>" type="text/css" />
<!--textext autocomplete-->

<script src="<?php echo base_url('assets/js/bootbox.min.js'); ?>" type="text/javascript"></script>

</head>
<!-- TOPO -->
<div id="topo" class="container-fluid">
	<div class="col-md-12 col-xs-12 gradiente-amarelo-topo padding-top-5">
		<img src=<?php echo base_url("assets/img/layout/logotipo-sbctrans.png"); ?> title="SBC-Trans" />
	</div>
</div>
<!-- TOPO -->
<body>