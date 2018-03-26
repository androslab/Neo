<?php

class PeThemeFont {

	public $master;
	public $customCSS;

	public function __construct($master) {
		$this->master =& $master;
		$this->fonts =& PeGlobal::$config["fonts"];
	}

	public function &options() {
		$options = array();
		foreach ($this->fonts as $key=>$value) {
			$options[$key] =
				array(
					  "label"=>$value["label"],
					  "type"=>"Fonts",
					  "section"=>__pe("Google Fonts"),
					  "default"=>$value["default"]
					  );			
		}
		return $options;
	}
	
	public function load() {
		$options = $this->master->options->all();
		$googleFonts =& PeGlobal::$const->fonts->google->all;
		$install = array();
		$customCSS = "";
		$skins = false;
		if (isset(PeGlobal::$config["skins"])) {
			$skins = array_values(PeGlobal::$config["skins"]);
			// drop default skin
			array_shift($skins);
		}
		foreach ($this->fonts as $key => $values) {
			if ($font = $options->{$key}) {
				$install[$googleFonts[$font]["request"]] = true;
				$selectors = $values["selectors"];
				$rule = join(",",$selectors);
				if ($skins) {
					foreach ($skins as $skin) {
						foreach ($selectors as $selector) {
							$rule .= ",html.skin_$skin $selector";
						}
					}
				}
				$customCSS .= "$rule{font-family:'$font';}";
			}
		}

		if (count($install) > 0) {
			printf('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=%s">',strtr(join("|",array_keys($install))," ","+"));
			$this->customCSS = $customCSS;
		}
	}

	public function apply() {
		if ($this->customCSS) {
			printf('<style type="text/css">%s</style>',$this->customCSS);
		}
	}



}

?>