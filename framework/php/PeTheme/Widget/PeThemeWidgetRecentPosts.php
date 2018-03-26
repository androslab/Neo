<?php

class PeThemeWidgetRecentPosts extends PeThemeWidget {

	public function __construct() {
		$this->name = __pe("Pixelentity - Recent posts");
		$this->description = __pe("The most recent posts on your site");
		$this->wclass = "pe_widget widget_recent_entries";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__pe("Title"),
									"type"=>"Text",
									"description" => __pe("Widget title"),
									"default"=>"Recent Posts"
									),
							  "link" => 
							  array(
									"label"=>__pe("Blog Link"),
									"type"=>"Text",
									"description" => __pe("Blog link text. If empty, no link will be shown."),
									"default"=>"Visit The Blog"
									),
							  "url" => 
							  array(
									"label"=>__pe("Blog Link Url"),
									"type"=>"Text",
									"description" => __pe("Blog url. If empty, theme will try to autodetect."),
									"default"=>""
									),
							  "count" => 
							  array(
									"label"=>__pe("Number Of Posts"),
									"type"=>"Select",
									"description" => __pe("Select the number of recent posts to show in this widget."),
									"single" => true,
									"options" => range(1,10),
									"default"=>2
									),
							  "chars" => 
							  array(
									"label"=>__pe("Excerpt Length"),
									"type"=>"Text",
									"description" => __pe("Excerpt lenght in characters. This number is then rounded so as not to cut a word."),
									"default"=>130
									)
							 
							  );
		

		parent::__construct();
	}

	public function &getContent(&$instance) {
		extract($instance);
		$title = isset($title) ? $title : "";
		if (isset($link)) {
			$url = isset($url) && $url ? $url : peTheme()->content->getBlogLink();
			$title .= sprintf('<a href="%s"><span class="label">%s</span></a>',$url,$link);
		}
		$html = $title ? "<h3>$title</h3>" : "";
		$count = intval($count);
		$count = $count > 0 ? $count : 2;

		$chars = intval($chars);
		$chars = $chars > 0 ? $chars : 130;

		$r = new WP_Query(
						  array(
								'posts_per_page' => $count, 
								'no_found_rows' => true,
								'post_status' => 'publish',
								'ignore_sticky_posts' => true
								)
						  );

		if ($r->have_posts()) {
			$counter = 0;
			while ($r->have_posts()) {
				$counter++;
				$r->the_post();
				$class = $counter == $r->post_count ? ' class="last"' : ""; 
				$html .= "<ul><li$class>";
				$thumb = peTheme()->content->resizedImg(50,50);
				$link = get_permalink();
				if ($thumb) {
					$html .= "<a class=\"thumb insetHighlight\" href=\"$link\">$thumb</a>";
				}
				$html .= "<div>";
				$html .= "<a class=\"title\" href=\"$link\">".get_the_title()."</a>";
				$html .= "<p>".peTheme()->utils->truncateString(get_the_excerpt(),$chars)."</p>";
				$html .= "</div>";
				$html .= "</li></ul>";
			}
			wp_reset_postdata();
		}
		return $html;
	}


}
?>
