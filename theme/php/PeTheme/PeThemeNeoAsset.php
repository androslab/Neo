<?php

class PeThemeNeoAsset extends PeThemeAsset  {

	public function __construct(&$master) {
		$this->minifiedJS = "theme/compressed/theme.min.js";
		$this->minifiedCSS = "theme/compressed/theme.min.css";
		parent::__construct($master);
	}

	public function registerAssets() {

		add_filter("pe_theme_minified_js_deps",array(&$this,"pe_theme_minified_js_deps_filter"));

		parent::registerAssets();

		// override projekktor skin
		wp_deregister_style("pe_theme_projekktor");
		$this->addStyle("framework/js/pe.flare/video/theme/style.css",array(),"pe_theme_projekktor");


		if ($this->minifyCSS) {
			$deps = 
				array(
					  "pe_theme_compressed"
					  );
		} else {

			// theme styles
			$this->addStyle("css/bg_component.css",array(),"pe_theme_bg_component");
			$this->addStyle("css/pe_over.css",array(),"pe_theme_pe_over");
			$this->addStyle("css/menu_layout.css",array(),"pe_theme_menu_layout");
			$this->addStyle("css/menu_skin.css",array(),"pe_theme_menu_skin");
			$this->addStyle("css/slider_ui.css",array(),"pe_theme_slider_ui");
			$this->addStyle("css/slider_captions.css",array(),"pe_theme_slider_captions");
			$this->addStyle("css/style.css",array(),"pe_theme_styles");

			$this->addStyle("css/skin_default.css",array(),"pe_theme_skin_default");
			$this->addStyle("css/skin_dark.css",array(),"pe_theme_skin_dark");

			$deps = 
				array(
					  "pe_theme_refineslide",
					  "pe_theme_volo",
					  "pe_theme_flare",
					  "pe_theme_prettify",
					  "pe_theme_bootstrap_responsive",
					  "pe_theme_bg_component",
					  "pe_theme_pe_over",
					  "pe_theme_menu_layout",
					  "pe_theme_menu_skin",
					  "pe_theme_slider_ui",
					  "pe_theme_slider_captions",
					  "pe_theme_styles",
					  "pe_theme_skin_default",
					  "pe_theme_skin_dark"
					  );
		}

		$this->addStyle("style.css",$deps,"pe_theme_init");

		$this->addScript("theme/js/pe/pixelentity.controller.js",
						 array(
							   "pe_theme_prettify",
							   "pe_theme_effects_info",
							   "pe_theme_effects_bw",
							   "pe_theme_flare",
							   "pe_theme_perefineslide",

							   "pe_theme_widgets_contact",
							   "pe_theme_widgets_bslinks",
							   "pe_theme_widgets_bootstrap",
							   "pe_theme_widgets_isotope",
							   "pe_theme_widgets_backgroundSlider",
							   "pe_theme_widgets_volo",
							   "pe_theme_widgets_twitter",
							   "pe_theme_widgets_flickr",
							   "pe_theme_widgets_newsletter",
							   "pe_theme_widgets_gmap",
							   "pe_theme_widgets_social_facebook",
							   "pe_theme_widgets_social_twitter",
							   "pe_theme_widgets_social_google",
							   "pe_theme_widgets_social_pinterest",
							   "pe_theme_widgets_carousel",
							   "pe_theme_widgets_dynamicBackground"

							   ),"pe_theme_controller");

		$options =& $this->master->options->all();
		wp_localize_script("pe_theme_init", 'peThemeOptions',
						   array(
								 "backgroundMinWidth" => absint($options->backgroundMinWidth)
								 ));
		

	}

	public function pe_theme_minified_js_deps_filter($deps) {
		return array("jquery","json2");
	}


	public function style() {
		bloginfo("stylesheet_url"); 
	}

	public function enqueueAssets() {
		$this->registerAssets();
		
		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/init.js")) {
			$this->addScript("preview/init.js",array("jquery"),"pe_theme_preview_init");
			wp_enqueue_script("pe_theme_preview_init");
		}	
		
		wp_enqueue_style("pe_theme_init");
		wp_enqueue_script("pe_theme_init");

		if ($this->minifyJS && file_exists(PE_THEME_PATH."/preview/preview.js")) {
			$this->addScript("preview/preview.js",array("pe_theme_init"),"pe_theme_skin_chooser");
			wp_localize_script("pe_theme_skin_chooser","pe_skin_chooser",array("url"=>urlencode(PE_THEME_URL."/")));
			wp_enqueue_script("pe_theme_skin_chooser");
		}
	}


}

?>