<?php

class PeThemeNeo extends PeThemeController {

	public $preview = array();

	public function __construct() {
		// not yet finished, we'll have to wait next update for this feature
		add_action("customize_register",array(&$this,"customize_register"));
		add_filter("customize_value_skin",array(&$this,"customize_value_skin_filter"));
		add_action("customize_preview_skin",array(&$this,"customize_preview_skin"));
		add_action("customize_save_skin",array(&$this,"customize_save_skin"));

		add_filter("pe_theme_menu_nth_level_icon",array(&$this,"pe_theme_menu_nth_level_icon_filter"));
		add_filter("pe_theme_social_links",array(&$this,"pe_theme_social_links_filter"),10,2);
		add_filter("pe_theme_body_class",array(&$this,"pe_theme_body_class_filter"),10,2);
		add_filter("pe_theme_slider_slide_attributes",array(&$this,"pe_theme_slider_slide_attributes_filter"),10,3);
		add_filter("pe_theme_slider_attributes",array(&$this,"pe_theme_slider_attributes_filter"));
		add_filter("pe_theme_available_sliders",array(&$this,"pe_theme_available_sliders_filter"),10,2);

		add_filter("pe_theme_project_layouts",array(&$this,"pe_theme_project_layouts_filter"));
		add_filter("pe_theme_comment_submit_class",array(&$this,"pe_theme_comment_submit_class_filter"));
		add_filter("pe_theme_image_over_class",array(&$this,"pe_theme_image_over_class_filter"),10,3);

		add_filter("pe_theme_gallery_cover_info",array(&$this,"pe_theme_gallery_cover_info_filter"));
		add_filter("pe_theme_gallery_cover_icon",array(&$this,"pe_theme_gallery_cover_icon_filter"),10,4);

		add_action("pe_theme_admin_options",array($this,"pe_theme_admin_options"));
		add_action("pe_theme_admin_options_render",array($this,"pe_theme_admin_options_render"));
	}

	public function pe_theme_menu_nth_level_icon_filter($icon) {
		return '<span class="icon-chevron-right"></span>';
	}

	public function pe_theme_comment_submit_class_filter($icon) {
		return 'btn-info';
	}
	
	public function pe_theme_social_links_filter($links,$section) {
		if ($section == "footer") {
			$links = str_replace("sm-icon ","sm-icon icon-white ",$links);
		}
		return $links;
	}

	public function pe_theme_available_sliders_filter($sliders) {
		$sliders[__pe("Refine (Multiple transition types)")] = "peRefineSlide";
		return $sliders;
	}

	public function pe_theme_slider_attributes_filter($attr) {
		$attr["controls-bullets"] = "disabled";
		$attr["controls-arrows"] = "edges";
		return $attr;
	}

	public function pe_theme_slider_slide_attributes_filter($attr,$slide,$slider) {
		$background =& $this->background->conf();
		if ($background && $background->resource == "slider" && isset($slide->img)) {
			$attr["background"] = $background->type == "color" ? $slide->img : $this->image->bw($slide->img);
		}
		return $attr;
	}


	public function pe_theme_body_class_filter($classes) {
		$back = $this->background->conf();
		if ($back && ($back->resource == "slider" || $back->resource == "gallery")) $classes = "$classes black";
		return $classes;
	}

	public function pe_theme_project_layouts_filter($layouts) {
		$layouts = 
			array(
				  __pe("Content on right") => "right",
				  __pe("Full width content") => "full"
				  );
		return $layouts;
	}

	public function pe_theme_image_over_class_filter($overClass,$where = "",$thumbClass = "") {
		if ($where === "gallery_thumbnail" && $thumbClass != "portfolioItem") return "peOverBW peOverInfo";
		return "peOverInfo";
	}

	public function pe_theme_gallery_cover_info_filter($info) {
		return "";
	}

	public function pe_theme_gallery_cover_icon_filter($info,$count,$title,$fullscreen) {
		if (!$fullscreen) return "";
		return sprintf('<div class="title"><div class="infoWrap"><span class="peOverElementIconBG"><span class="peOverElementIcon"><i class="icon-gallery icon-white"></i></span></span>%s<p class="peOverElementText">%s</p></div><div class="peOverElementInnerBG"></div></div>',
					   $title ? "<span class=\"peOverElementText\">$title</span>" : "",
					   "$count ".__pe("Images")
					   );
	}

	public function pe_theme_admin_options() {
		PeThemeMetaBoxBackground::addScript();
		wp_enqueue_script("pe_theme_metabox_background");
	}

	public function pe_theme_admin_options_render() {
		printf('<script>jQuery("#tab3").peMetaboxBackground({id:"%s"});</script>',"pe_theme_options_background");
	}

	public function boot() {
		parent::boot();

		PeGlobal::$config["content-width"] = 940;
		PeGlobal::$config["post-formats"] = array("image","video","quote","gallery");
		PeGlobal::$config["post-formats-project"] = array("image","video","gallery");

		PeGlobal::$config["image-sizes"]["thumbnail"] = array(120,90,true);
		PeGlobal::$config["image-sizes"]["medium"] = array(480,396,true);
		PeGlobal::$config["image-sizes"]["large"] = array(680,300,true);
		PeGlobal::$config["image-sizes"]["post-thumbnail"] = PeGlobal::$config["image-sizes"]["medium"];
		

		PeGlobal::$config["nav-menus"]["footer"] = __pe("Footer menu");

		// blog layouts
		PeGlobal::$config["blog"] =
			array(
				  __pe("Full") => "",
				  __pe("Compact") => "compact",
				  __pe("Mini") => "mini"
				  );

		PeGlobal::$config["widgets"] = 
			array(
				  "Video",
				  "Contacts",
				  "Html",
				  "Stats",
				  "RecentPosts",
				  "Newsletter",
				  "Twitter",
				  "Flickr",
				  "SocialLinks",
				  "Tabs",
				  "Project",
				  "Slider",
				  "Gallery",
				  "Menu"
				  );

		PeGlobal::$config["shortcodes"] = 
			array(
				  "BS_ContentBox",
				  "BS_Widget",
				  "BS_Testimonial",
				  "BS_Staff",
				  "BS_Projects",
				  "BS_Feature",
				  "BS_Blog",
				  "BS_Button",
				  "BS_Columns",
				  "BS_Alert",
				  "BS_Divider",
				  "BS_Icon",
				  "BS_Label",
				  "BS_Badge",
				  "BS_Tooltip",
				  "BS_Video",
				  "BS_Hero",
				  "BS_Faq",
				  "BS_Code",
				  "BS_PriceBox",
				  "BS_Popover",
				  "BS_Tabs",
				  "BS_Accordion",
				  "BS_Share"
				  );

		PeGlobal::$config["sidebars"] =
			array(
				  "footer" => __pe("Footer Widgets"),
				  "default" => __pe("Default post/page")
				  );

		PeGlobal::$config["skins"] = 
			array(
				  __pe("Light")=>"default",
				  __pe("Dark")=>"dark"
				  );

		/*
		PeGlobal::$config["colors"] = 
			array(
				  "colorPrimary" => 
				  array(
						"label" => __pe("Primary Color"),
						"selectors" => 
						array(
								".mainContent a.label:hover" => "background-color",
								".mainContent a:hover > span.label" => "background-color",
								".accordion-heading a:hover" => "background-color",
								".nav-list > .active > a" => "background-color",
								".nav-list > .active > a" => "background-color",
								".navbar .nav .active > a" => "background-color",
								".navbar .nav .active > a:hover" => "background-color",
								".btt" => "background-color",
								".label.btt" => "background-color",
								".dropdown-menu li > a:hover" => "background-color",
								".dropdown-menu .active > a" => "background-color",
								".dropdown-menu .active > a:hover" => "background-color",
								".navbar .nav .open > .dropdown-toggle" => "background-color",
								".navbar .nav .active > .dropdown-toggle" => "background-color",
								".navbar .nav .open.active > .dropdown-toggle" => "background-color",
								"#comments .reply .label:hover" => "background-color",
								".pagination li.active a" => "background-color",
								".pager a:hover" => "background-color",
								".portfolio .filter a.active" => "background-color",
								".portfolio .filter a.active:hover" => "background-color",
								".nav-tabs > li > a:hover" => "background-color",
								".project-nav > div > a:hover" => "background-color",
								".carousel-nav div a:hover" => "background-color",
								".widget_recent_entries h3 a .label" => "background-color",
								".pe_widget.widget_recent_entries h3 a .label" => "background-color",
								".widget_recent_entries p a:hover .label" => "background-color",
								".widget_twitter .followBtn:hover span" => "background-color",
								".footerLower .footNav a:hover" => "background-color",
								".navbar .nav .active > a, .navbar .nav .active > a:hover" => "background-color",
								".pe_widget.widget_recent_entries li .thumb:hover img" => "background-color",
								
								
								".navbar .brand" => "border-bottom-color",
								".navbar .nav > li > a:hover" => "border-bottom-color",
								".navbar .nav .active > a" => "border-bottom-color",
								".navbar .nav .active > a:hover" => "border-bottom-color",
								
								".navbar .dropdown-menu" => "border-top-color",
								"footer .footerMain" => "border-top-color",
								
								".bypostauthor > .comment-body > .comment-author img" => "border-color",
								".pagination .active a" => "border-color",
								".widget_stats a" => "color",
								".widget_recent_entries li .thumb:hover img" => "border-color"
								
								//small rez
								//".navbar .dropdown-menu a:hover" => "background-color",
								//".btn-navbar:hover" => "background-color",
								
								//".navbar .nav .active > a, .navbar .nav .active > a:hover " => "border-left-color",
								//".navbar .nav > li > a:hover" => "border-left-color"
							  ),
						"default" => "#9aae4c"
						),
				  "colorSecondary" => 
				  array(
						"label" => __pe("Secondary Color"),
						"selectors" => 
						array(
							  ".navbar .nav > li > a" => "border-bottom-color"
							  
							  //small rez
							  //".navbar .nav > li > a"  => "border-left-color"
							  ),
						"default" => "#D2D9B5"
						),
				  "colorGrey1" => 
				  array(
						"label" => __pe("Primary Grey"),
						"selectors" => 
						array(
							  ".taglineWrap" => "background-color",
							  ".result" => "border-bottom-color",
							  ".pageTitle.portfolio" => "border-bottom-color",
							  ".share" => "border-top-color",
							  ".related-work .section-title" => "border-bottom-color",
							  ".widget_recent_entries p" => "border-bottom-color"
							  
							  //small rez
							  //"footer .footerMain .widget" => "border-bottom-color",
							  //".navbar .nav > li > a" => "background-color"
							  ),
						"default" => "#eeeeee"
						),
				  "colorGrey2" => 
				  array(
						"label" => __pe("Secondary Grey"),
						"selectors" => 
						array(
							  ".label" => "background-color",
							  ".widget_recent_entries h3 a:hover .label" => "background-color"
							  
							  //small rez
							  //".btn-navbar" => "background-color",
							  //".navbar .nav > li > a:hover" => "background-color"
							  ),
						"default" => "#C1C1BF"
						),
				  "colorGrey3" => 
				  array(
						"label" => __pe("Third Grey"),
						"selectors" => 
						array(
							  ".accordion-heading a" => "background-color",
							  ".faq-heading" => "background-color",
							  ".nav-tabs > li > a" => "background-color"
							  ),
						"default" => "#e5e5e5"
						),
				  "colorPageBg" => 
				  array(
						"label" => __pe("Page Background"),
						"selectors" => 
						array(
							  "body" => "background-color"
							  ),
						"default" => "#fcfcfc"
						),
				  "colorH1" => 
				  array(
						"label" => __pe("Page Titles"),
						"selectors" => 
						array(
							  "h1" => "color"
							  ),
						"default" => "#2f2f2f"
						),
				  "colorH2" => 
				  array(
						"label" => __pe("Tagline Text"),
						"selectors" => 
						array(
							  "h2" => "color"
							  ),
						"default" => "#5f5f5f"
						),
				  "colorH3" => 
				  array(
						"label" => __pe("Page Subtitles & Widget Headings"),
						"selectors" => 
						array(
							  "h3" => "color",
							  ),
						"default" => "#2f2f2f",
						),
				  "colorBlockquote" => 
				  array(
						"label" => __pe("Testimonial Text"),
						"selectors" => 
						array(
							  "footer blockquote p" => "color",
							  "blockquote p" => "color"
							  ),
						"default" => "#888888"
						),
				  "colorLink" => 
				  array(
						"label" => __pe("Links"),
						"selectors" => 
						array(
							  "a" => "color",
							  ".post .post-meta .post-date"  => "color", 
							  ".widget_links li span" => "color",
							  ".widget_links li a:hover" => "color",
							  ".widget_pages li a:hover" => "color",
							  ".widget_meta li a:hover" => "color",
							  ".widget_nav_menu li a:hover" => "color",
							  ".widget_recent_entries li a:hover" => "color"
							  ),
						"default" => "#0088CC"
						),
				  "colorLinkHover" => 
				  array(
						"label" => __pe("Links Hover"),
						"selectors" => 
						array(
							  "a:hover" => "color"
							  ),
						"default" => "#005580"
						),
				  "colorBtnText" => 
				  array(
						"label" => __pe("Button Labels"),
						"selectors" => 
						array(
							  ".btn" => "color",
							  ".label" => "color"
							  ),
						"default" => "#ffffff"
						),
				  );
		*/

		PeGlobal::$config["fonts"] = 
			array(
				  "fontBody" => 
				  array(
						"label" => __pe("Body, Paragraph Text"),
						"selectors" => 
						array(
							  "body",
							  "p"
							  ),
						"default" => ""
						),
				  "fontH1" => 
				  array(
						"label" => __pe("Page Titles, Heading 1"),
						"selectors" => 
						array(
							  "h1",
							  ),
						"default" => ""
						),
				  "fontH2" => 
				  array(
						"label" => __pe("Tagline Text, Heading 2"),
						"selectors" => 
						array(
							  "h2",
							  ),
						"default" => ""
						),
				  "fontH3" => 
				  array(
						"label" => __pe("Section Titles, Widget Titles, Heading 3"),
						"selectors" => 
						array(
							  "h3",
							  ),
						"default" => ""
						),
				  "fontCaptionMain" => 
				  array(
						"label" => __pe("Slider Captions Main (h3)"),
						"selectors" => 
						array(
							  ".peSlider >  div.peCaption h3",
							  ),
						"default" => ""
						),
				  "fontCaptionSub" => 
				  array(
						"label" => __pe("Slider Captions Sub (h4)"),
						"selectors" => 
						array(
							  ".peCaption h4",
							  ),
						"default" => ""
						),
				  "fontH4" => 
				  array(
						"label" => __pe("Heading 4"),
						"selectors" => 
						array(
							  "h4",
							  ),
						"default" => ""
						),
				  "fontH5" => 
				  array(
						"label" => __pe("Heading 5"),
						"selectors" => 
						array(
							  "h5",
							  ),
						"default" => ""
						),
				  "fontMainMenu" => 
				  array(
						"label" => __pe("Main Menu"),
						"selectors" => 
						array(
							  ".nav a",
							  ".navbar .nav .nav-header",
							  ),
						"default" => ""
						),
				  "fontBlockquote" => 
				  array(
						"label" => __pe("Blockquote"),
						"selectors" => 
						array(
							  "blockquote p",
							  ),
						"default" => ""
						)
				  );

		PeGlobal::$config["post_types"]["project"] =
				  array(
						'labels' => 
						array(
							  'name'              => __pe("Projects"),
							  'singular_name'     => __pe("Project"),
							  'add_new_item'      => __pe("Add New Project"),
							  'search_items'      => __pe('Search Projects'),
							  'popular_items' 	  => __pe('Popular Projects'),		
							  'all_items' 		  => __pe('All Projects'),
							  'parent_item' 	  => __pe('Parent Project'),
							  'parent_item_colon' => __pe('Parent Project:'),
							  'edit_item' 		  => __pe('Edit Project'), 
							  'update_item' 	  => __pe('Update Project'),
							  'add_new_item' 	  => __pe('Add New Project'),
							  'new_item_name' 	  => __pe('New Project Name')
							  ),
						'public' => true,
						'has_archive' => false,
						"supports" => array("title","editor","thumbnail","post-formats"),
						"taxonomies" => array("post_format")
						);

		PeGlobal::$config["taxonomies"]["prj-category"] =
				  array(
						'project',
						array(
							  'label' => __pe('Project Tags'),
							  'sort' => true,
							  'args' => array('orderby' => 'term_order' ),
							  'show_in_nav_menus' => false,
							  'rewrite' => array('slug' => 'projects' )
							  )
						);

		$def404content = <<<EOL
<h4>The Page You Are Looking For Cannot Be Found</h4>
<br />
<p>You may want to check the following links:</p>
<br />
<a href="#" class="btn btn-danger">Home</a>
<a href="#" class="btn btn-danger">Contact</a>
EOL;



		$options = array();

		if (!defined('PE_HIDE_IMPORT_DEMO') || !PE_HIDE_IMPORT_DEMO) {
			$options["import_demo"] = $this->defaultOptions["import_demo"];
		}

		$options = array_merge($options,
			array(
				  "skin" => 
				  array(
						"label"=>__pe("Skin"),
						"type"=>"RadioUI",
						"section"=>__pe("General"),
						"description" => __pe("Select Theme Skin"),
						"options" => PeGlobal::$config["skins"],
						"default"=>"default"
						),
				  "logo" => 
				  array(
						"label"=>__pe("Logo"),
						"type"=>"Upload",
						"section"=>__pe("General"),
						"description" => __pe("This is the main site logo image. The image should be a .png file with aprox dimensions of 125x100px"),
						"default"=> PE_THEME_URL."/img/content/logo.png"
						),
				  "logoLow" => 
				  array(
						"label"=>__pe("Logo (Small Version)"),
						"type"=>"Upload",
						"section"=>__pe("General"),
						"description" => __pe("This is a small version of the logo which will be used for low resolution viewport devices like phones. The image should be a .png file with aprox dimensions less than or equal to the main logo."),
						"default"=> PE_THEME_URL."/img/content/logo_sml.png"
						),
				  "favicon" => 
				  array(
						"label"=>__pe("Favicon"),
						"type"=>"Upload",
						"section"=>__pe("General"),
						"description" => __pe("This is the favicon for your site. The image can be a .jpg, .ico or .png with dimensions of 16x16px "),
						"default"=> PE_THEME_URL."/img/content/favicon.jpg"
						),  
				  "customCSS" => $this->defaultOptions["customCSS"],
				  "customJS" => $this->defaultOptions["customJS"],
				  "googleFonts" => 
				  array(
						"label"=>__pe("Google Web Fonts"),
						"type"=>"Help",
						"section"=>__pe("Google Fonts"),
						"description" => __pe("In this page you can set the typefaces to be used throughout the theme. For each elements listed below you can choose any front from the Google Web Font library. Once you have chosen a font from the list, you will see a preview of this font immediately beneath the list box. The icons on the right hand side of the font preview, indicate what weights are available for that typeface.<br/><br/><strong>R</strong> -- Regular,<br/><strong>B</strong> -- Bold,<br/><strong>I</strong> -- Italics,<br/><strong>BI</strong> -- Bold Italics<br/><br/>When decideing what font to use, ensure that the chosen font contains the font weight required by the element. For example, main headings are bold, so you need to select a new font for these elements which supports a bold font weight. If you select a font which does not have a bold icon, the font will not be applied. <br/><br/>Browse the online <a href='http://www.google.com/webfonts'>Google Font Library</a>"),
						)  
				  ));

		$options = array_merge($options,$this->font->options());

		$options["backgroundMinWidth"] = 
				  array(
						"label"=>__pe("Disable width"),
						"type"=>"Text",
						"section"=>__pe("Background"),
						"description" => __pe("Disable background image component when device width is less than this value (in pixels). Disabling the background component in mobile and tablet devices (default) will improve performance."),
						"default"=> "1025"
						);

		$options = array_merge($options,PeGlobal::$const->background->options);

		//$options = array_merge($options,$this->color->options());

		$options = array_merge($options,
		    array(
				  "headerCallUs" => 
				  array(
						"label"=>__pe("Call Us."),
						"type"=>"Text",
						"section"=>__pe("Header"),
						"description" => __pe("Call Us box content."),
						"default"=> "Call Us +44 123 456 78"
						),
				  "headerTaglineQuote" => 
				  array(
						"label"=>__pe("Tagline Text Content"),
						"type"=>"TextArea",
						"section"=>__pe("Header"),
						"description" => __pe("This is the text content of the header tagline area which appears on each page. Simple HTML tags are supported. "),
						"default"=> sprintf('<h2>Another awesome theme from pixelentity</h2>%s<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit pellen.</p>',"\n")
						),
				  "footerLayout" => 
				  array(
						"label"=>__pe("Layout"),
						"type"=>"Select",
						"section"=>__pe("Footer"),
						"description" => __pe("Footer columns layout"),
						"options" => array(__pe("3 Columns (center wide)")=>"default",__pe("3 Columns")=>"3cols",__pe("4 Columns")=>"4cols"),
						"default"=>"default"
						),
				  "footerCopyright" => 
				  array(
						"label"=>__pe("Copyright"),
						"type"=>"Text",
						"section"=>__pe("Footer"),
						"description" => __pe("Copyright notice. Simple HTML tags are supported. "),
						"default"=> "&copy; 2012+ Business"
						),
				  "footerSocialLinks" => 
				  array(
						"label"=>__pe("Social Profile Links"),
						"type"=>"Links",
						"section"=>__pe("Footer"),
						"description" => __pe("Add the link to your common social media profiles. Paste links one at a time and click the 'Add New' button. The links will appear in a table below and an icons will be inserted automatically based on the domain in the url."),
						"sortable" => true,
						"default"=>""
						),
				  "sidebars" => 
				  array(
						"label"=>__pe("Widget Areas"),
						"type"=>"Sidebars",
						"section"=>__pe("Widget Areas"),
						"description" => __pe("Create new widget areas by entering the area name and clicking the add button. The new widget area will appear in the table below. Once a widget area has been created, widgets may be added via the widgets page."),
						"default"=>""
						),
				  "projectPageSize" => 
				  array(
						"label"=>__pe("Projects Per Page"),
						"type"=>"Text",
						"section"=>__pe("Projects"),
						"description" => __pe("The number of projects to show in the portfolio single column layout page before a pager is inserted."),
						"default"=> "10"
						),
				  "projectRelatedSize" => 
				  array(
						"label"=>__pe("Related Projects Number"),
						"type"=>"Text",
						"section"=>__pe("Projects"),
						"description" => __pe("The number of projects to show in the related projects section of the project pages."),
						"default"=> "10"
						),
				  "contactEmail" => $this->defaultOptions["contactEmail"],
				  "contactSubject" => $this->defaultOptions["contactSubject"],
				  "404title" => 
				  array(
						"label"=>__pe("Title"),
						"type"=>"Text",
						"section"=>__pe("Custom 404"),
						"description" => __pe("Title of 404 (not found) page"),
						"default"=> "404 Error - Page not found"
						),
				  "404content" => 
				  array(
						"label"=>__pe("Content"),
						"type"=>"TextArea",
						"section"=>__pe("Custom 404"),
						"description" => __pe("Content of 404 (not found) page"),
						"default"=> $def404content
						)
				  ));

		$options["minifyJS"] =& $this->defaultOptions["minifyJS"];
		$options["minifyCSS"] =& $this->defaultOptions["minifyCSS"];

		$options["adminThumbs"] =& $this->defaultOptions["adminThumbs"];
		$options["mediaQuick"] =& $this->defaultOptions["mediaQuick"];
		$options["mediaQuickDefault"] =& $this->defaultOptions["mediaQuickDefault"];

		$options["updateCheck"] =& $this->defaultOptions["updateCheck"];
		$options["updateUsername"] =& $this->defaultOptions["updateUsername"];
		$options["updateAPIKey"] =& $this->defaultOptions["updateAPIKey"];

		$options["adminLogo"] =& $this->defaultOptions["adminLogo"];
		$options["adminUrl"] =& $this->defaultOptions["adminUrl"];
		
		PeGlobal::$config["options"] =& apply_filters("pe_theme_options",$options);

		PeGlobal::$config["metaboxes-post"] = 
			array(
				  "image" => PeGlobal::$const->image->metaboxScale,
				  "video" => PeGlobal::$const->video->metaboxPost,
				  "sidebar" => PeGlobal::$const->sidebar->metabox,
				  "footer" => PeGlobal::$const->sidebar->metaboxFooter,
				  "gallery" => PeGlobal::$const->gallery->metaboxPostNoSingle,
				  "quote" => PeGlobal::$const->quote->metabox,
				  "background" => PeGlobal::$const->background->metabox
				  );

		PeGlobal::$config["metaboxes-page"] = 
			array(
				  "extra" => 
				  array(
						"type" =>"",
						"title" =>__pe("Action Block"),
						"priority" => "core",
						"where" => 
						array(
							  "page" => "page-home",
							  ),
						"content"=>
						array(
							  "content" => 	
							  array(
									"label"=>__pe("Content"),
									"type"=>"TextArea",
									"description" => __pe("This is the content to the right of this page's title (Under the slider). Simple HTML tags are supported."),
									"default"=>'Lorem ipsum dolor sit amet, <a class="btn btn-info btn-large" href="#">Action Btn</a>'
									)
							  )
						),				  
				  "slider" => PeGlobal::$const->gallery->metaboxSlider,
				  "project" => PeGlobal::$const->project->metaboxFeatured,
				  "sidebar" => array_merge(PeGlobal::$const->sidebar->metabox,array("where"=>array("post"=>"default, page-contact, page-left, page-portfolio"))),
				  "footer" => PeGlobal::$const->sidebar->metaboxFooter,
				  "portfolio" => PeGlobal::$const->portfolio->metabox,
				  "contact" => PeGlobal::$const->contact->metabox,
				  "gmap" => PeGlobal::$const->gmap->metabox,
				  "background" => PeGlobal::$const->background->metabox
				  );


		PeGlobal::$config["metaboxes-project"] = 
			array(
				  "project" => PeGlobal::$const->project->metabox,
				  "sidebar" => PeGlobal::$const->sidebar->metabox,
				  "footer" => PeGlobal::$const->sidebar->metaboxFooter,
				  "image" => PeGlobal::$const->image->metaboxScale,
				  "gallery" => PeGlobal::$const->gallery->metaboxPost,
				  "video" => PeGlobal::$const->video->metaboxPost,
				  "background" => PeGlobal::$const->background->metabox
				  );

		PeGlobal::$config["metaboxes-gallery"] = 
			array(
				  "gallery" => PeGlobal::$const->gallery->metabox,
				  "background" => PeGlobal::$const->background->metabox				  
				  );

		PeGlobal::$config["metaboxes-video"] = 
			array(
				  "video" => PeGlobal::$const->video->metabox,
				  "background" => PeGlobal::$const->background->metabox				  
				  );

		
	}

	public function pre_get_posts_filter($query) {
		if ($query->is_search) {
			$query->set('post_type',array('post',"project","page"));
		}

		return $query;
	}

	protected function init_asset() {
		return new PeThemeNeoAsset($this);
	}

	public function customize_register($wp_customize) {

		$o =& PeGlobal::$config["options"];

		$wp_customize->add_section("pe_theme_color",
									array(
										  "title" => __pe("Color Scheme"),
										  "priority" => 35,
										  ));

		$wp_customize->add_setting("skin", 
									array(
										  "default" => $o["skin"]["default"],
										  "type" => "custom",
										  "capability" => "edit_theme_options",
										  "transport" => "postMessage"
										  )
								   );

		
		$wp_customize->add_control("skin_control", 
								   array(
										 "label"      => $o["skin"]["label"],
										 "section"    => "pe_theme_color",
										 "settings"   => "skin",
										 "type"       => "select",
										 "choices"    => array_flip($o["skin"]["options"])
										 )
								   );
		

		
		$setting = $wp_customize->get_setting("skin");
		$this->preview["skin"] = $setting->post_value();

		if ( $wp_customize->is_preview() && ! is_admin() ) {
			add_action("wp_footer",array(&$this,"customize_preview"),21);
		}

	}

	

	public function customize_preview() {
		?>
<script type="text/javascript">
	( function( $ ){
	wp.customize("skin",function( value ) {
		value.bind(function(skin) {
			var jhtml = $("html");
			var classList = jhtml[0].className;
			jhtml[0].className = classList.replace(/skin_\w+\s*/,"")+" "+"skin_"+skin;
		});
	});
	} )( jQuery )
</script>
	<?php
	}


	public function customize_value_skin_filter() {
		return $this->options->get("skin");
	}

	public function customize_preview_skin() {
		$this->options->set("skin",$this->preview["skin"]);
	}

	public function customize_save_skin() {
		$this->options->saveSingle("skin",$this->preview["skin"]);
	}



}

?>
