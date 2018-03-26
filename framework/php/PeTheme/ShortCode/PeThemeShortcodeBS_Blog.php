<?php

class PeThemeShortcodeBS_Blog extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "blog";
		$this->group = __pe("CONTENT");
		$this->name = __pe("Blog");
		$this->description = __pe("Blog");
		$this->fields = array(
							  "layout" =>
							  array(
									"label"=>__pe("Layout"),
									"type"=>"RadioUI",
									"description" => __pe("Select the required post layout. 'Full' - denotes a full width normal blog layout. 'Compact' - denotes a full width list style layout. 'Mini' - denotes a compressed layout with small post thumbnails."),
									"options" => PeGlobal::$config["blog"],
									"default"=>""
									),
							  "count" =>
							  array(
									"label" => __pe("Max Posts"),
									"type" => "Text",
									"description" => __pe("Maximum number of posts to show."),
									"default" => 10,
									),
							  "media" => 
							  array(
									"label"=>__pe("Show Media"),
									"type"=>"RadioUI",
									"description" => __pe("Specify if the post's image/video/gallery media is displayed."),
									"options" => PeGlobal::$const->data->yesno,
									"default"=>"yes"
									),
							  "pager" => 
							  array(
									"label"=>__pe("Paged Result"),
									"type"=>"RadioUI",
									"description" => __pe("Display a pager when more posts are found than specified in the 'Maximum' field. "),
									"options" => PeGlobal::$const->data->yesno,
									"default"=>"yes"
									),
							  "sticky" => 
							  array(
									"label"=>__pe("Include Sticky Posts"),
									"type"=>"RadioUI",
									"description" => __pe("Include sticky posts in the displayed list."),
									"options" => PeGlobal::$const->data->yesno,
									"default"=>"yes"
									),
							  "category" =>
							  array(
									"label" => __pe("Category"),
									"type" => "Select",
									"description" => __pe("Only show posts from a specific category."),
									"options" => array_merge(array(__pe("All")=>""),peTheme()->data->getTaxOptions("category")),
									"default" => ""
									),
							  "tag" =>
							  array(
									"label" => __pe("Tag"),
									"type" => "Select",
									"description" => __pe("Only show posts with a specific tag."),
									"options" => array_merge(array(__pe("All")=>""),peTheme()->data->getTaxOptions("post_tag")),
									"default" => ""
									),
							  "format" =>
							  array(
									"label" => __pe("Post Format"),
									"type" => "Select",
									"description" => __pe("Only show posts of a specific format."),
									"options" => array_merge(array(__pe("All")=>""),array_combine(PeGlobal::$config["post-formats"],PeGlobal::$config["post-formats"])),
									"default" => ""
									)
							  );

	}

	public function output($atts,$content=null,$code="") {
		global $post;

		extract($atts);
		$pager = (isset($pager) && $pager !== "no");
		$count = isset($count) ? intval($count) : 10;

		// prevents loops
		if (isset($post) && $post) {
			$custom = array("post__not_in" => array($post->ID));
		}

		$custom["ignore_sticky_posts"] = (isset($sticky) && $sticky === "no") ? 1 : 0;
		
		if (isset($category) && $category !== "") {
			$custom["category_name"] = $category;
		}
		
		if (isset($tag) && $tag !== "") {
			$custom["tag"] = $tag;
		}
		
		if (isset($format) && $format !== "") {
			$tax_query = array(
								array(
									  'taxonomy' => 'post_format',
									  'field' => 'slug',
									  'terms' => array("post-format-$format")
									  )
								);
			$custom["tax_query"] = $tax_query;
		}

		$media = isset($media) && $media != "no";

		$t =& peTheme();
		$t->content->customLoop("post",$count,null,$custom,$pager);
		ob_start();
		$t->template->get_part(compact("media"),"loop",isset($layout) ? $layout : "");
		$t->content->pager();
		$t->content->resetLoop();
		$content =& ob_get_contents();
		ob_end_clean();
		return $content;

	}


}

?>
