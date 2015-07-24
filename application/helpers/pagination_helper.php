<?php

function setPagination($total_rows, $url, $segment=3, $cur_page=0){
	$CI =& get_instance();
	$CI->load->library('pagination');
	$config['base_url'] = base_url($url);
	$config['uri_segment'] = $segment;
	$config['cur_page'] = $cur_page;
	$config['first_link'] = 'Primeiro';
	$config['last_link'] = 'Último';
	$config['next_link'] = 'Próximo';
	$config['prev_link'] = 'Anterior';
	$config['per_page'] = _PER_PAGE;
	$config['num_links'] = _NUM_LINKS;
	$config['total_rows'] = $total_rows;
	return $CI->pagination->initialize($config);
} 

?>