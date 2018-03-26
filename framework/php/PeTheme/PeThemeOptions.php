<?php

class PeThemeOptions {

	protected $master;
	public $options;
	public $slug;

	public function __construct(&$master) {
		$this->slug = "pe_theme_".PE_THEME_NAME."_options";
		$this->master =& $master;
		$this->options = (object) array_merge((array) $this->defaults(), (array) get_option($this->slug,null));
	}

	public function &defaults() {
		$optionDef =& PeGlobal::$config["options"];
		$def = new stdClass();
		foreach ($optionDef as $option=>$data) {
			if ($data["type"] == "Help") {
				continue;
			}
			$def->$option = $data["default"];
		}
		return $def;
	}

	public function save(&$options) {
		$this->options =& update_option($this->slug, (object) $options);
	}

	public function saveSingle($name,$value) {
		$this->options->{$name} = $value;
		$this->save($this->options);
		
	}

	public function __get($what) {
		if (isset($this->options) && isset($this->options->$what)) {
			return $this->options->$what;
		}
		return "";
	}

	public function &all() {
		return $this->options;
	}

	public function get($key) {
		return isset($this->options->$key) ? $this->options->$key : null;
	}

	public function set($key,$value) {
		$this->options->$key = $value;
	}

}

?>