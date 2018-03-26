<?php

class PeThemeShortcode {

	public $master;
	public $group;
	public $name = "";
	public $trigger = "";
	public $description = "";
	public $fields;

	static $clean = 
		array(
			  "<p></p>" => "",
			  "<p> </p>" => "",
			  "<p><div>" => "",
			  "<div></p>" => ""
			  );

	public function __construct(&$master) {
		$this->master =& $master;
		$this->group = __pe("DEFAULT");
	}

	public function registerAssets() {
	}


	public function render() {
		if (isset($this->fields)) {
			foreach ($this->fields as $name => $data) {
				$class = "PeThemeFormElement".$data["type"];
				$field =& new $class($this->trigger,$name,$data);
				$field->render();			
			}
		}
	}

	public static function parseContent($content) {

		/* Parse nested shortcodes and add formatting. */
		$content = trim(do_shortcode(shortcode_unautop($content)));

		/* Remove '' from the start of the string. */
		if ( substr( $content, 0, 4 ) == '</p>' )
			$content = substr( $content, 4 );

		/* Remove '' from the end of the string. */
		if ( substr( $content, -3, 3 ) == '<p>')
			$content = substr( $content, 0, -3 );

		$content = strtr($content,PeThemeShortcode::$clean);

		return $content;
	}


	public function output($atts,$content=null,$code="") {
		return "";
	}

}

?>