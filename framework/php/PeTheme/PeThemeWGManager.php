<?php

class PeThemeWGManager {

	protected $master;
	protected $reqFields;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function add() {
		$widgets =& PeGlobal::$config["widgets"];

		if (is_array($widgets) && count($widgets) > 0) {
			foreach ($widgets as $widget) {
				register_widget("PeThemeWidget$widget");
			}
		}
	}

	public function admin() {
		$widgets =& PeGlobal::$config["widgets"];

		if (is_array($widgets) && count($widgets) > 0) {
			$seen = array();
			foreach ($widgets as $widget) {
				$class = "PeThemeWidget$widget";
				$wg =& new $class();

				// include widget assets
				$wg->registerAssets();

				// include fields assets
				if (isset($wg->fields)) {
					foreach ($wg->fields as $name => $data) {
						$class = "PeThemeFormElement".$data["type"];
						if (!isset($seen[$class])) {
							$seen[$class] = true;
							$field =& new $class("widget",$name,$data);
							$field->registerAssets();
						}
					}
				}

			}
		}
	}

}

?>
