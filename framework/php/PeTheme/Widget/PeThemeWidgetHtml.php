<?php

class PeThemeWidgetHtml extends PeThemeWidget {

	public function __construct() {
		$this->name = __pe("Pixelentity - Html");
		$this->description = __pe("HTML Block");

		$this->fields = array(
							  "content" => 
							  array(
									"label"=>__pe("HTML"),
									"type"=>"TextArea",
									"description" => __pe("HTML Content"),
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		return $instance["content"];
	}


}
?>
