<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//carregando os principais .css/.js do sistema
	 function mainAssets(){
	 	$path = base_url("assets");
	 	$asset = null;
	 	/*jqueries*/
	 	$asset .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>\n";
	 	$asset .= "<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>\n";
	 	$asset .= "<link rel='stylesheet' href='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css' />\n";
	 	$asset .= "<script src='".$path."/js/jqueryMask/jquery.mask.min.js'></script>\n";
	 	/*bootstrap*/
	 	$asset .= "<link rel='stylesheet' href='".$path."/js/bootstrap/css/bootstrap.min.css' />\n";
	 	$asset .= "<script src='".$path."/js/bootstrap/js/bootstrap.min.js'></script>\n";
	 	/*gerais*/
	 	$asset .= "<script src='".$path."/js/main.js'></script>\n";
	 	$asset .= "<link rel='stylesheet' href='".$path."/css/bootstrap.css' />\n";
	 	$asset .= "<link rel='stylesheet' href='".$path."/css/layout.css' />\n";
	 	$asset .= "<link rel='stylesheet' href='".$path."/css/main.css' />\n\n";
	 	return $asset;
	 }
	
	 //carregando o .css/.js referente ao modulo, caso existam
     function moduleAssets(){
     	$CI = & get_instance();
     	$controller = $CI->uri->segment(1) == false ? 'cliente' : strtolower($CI->uri->segment(1));
     	$css = "assets/css/{$controller}.css";
     	$js = "assets/js/{$controller}.js";
     	$files = null;
     	if(file_exists($css)){
     		$files .= "<link rel='stylesheet' type='text/css' href='".base_url($css)."' />\n";
     	}
     	if(file_exists($js)){
     		$files .= "<script src='".base_url($js)."'></script>\n";
     	}
     	return $files;
	 }

?>