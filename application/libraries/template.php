<?php
	
	class template{

		private $CI;
		private $title = 'SBC-Trans - Central de Monitoramento';

		function __construct() {
			$this -> CI = &get_instance();
		}

		public function view($view, $data) {
			$data['view'] = $view;
			$data['title'] = $this->getTitle($data);
			$this -> CI -> load -> view("template", $data);
		}

		public function maso($view, $data) {
			$data['view'] = $view;
			$data['title'] = $this->getTitle($data);
			$this -> CI -> load -> view("template_maso", $data);
		}

		private function getTitle($data){
			return isset($data['title']) && !is_null($data['title']) && !empty($data['title']) ? $data['title'] : $this->title;
		}

	}

?>