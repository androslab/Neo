<?php

class PeThemeVideo {

	protected $master;
	protected $options;
	protected $cache;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"video",
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__pe("No videos defined")=>-1);
		}
		return $options;
	}


	public function &get($id) {
		$post = false;
		if (!isset($id) || $id == "" ) return $post;
		if (isset($this->cache[$id])) return $this->cache[$id];
		$post =& get_post($id);
		if (!$post) return $post;
		$meta =& $this->master->meta->get($id,$post->post_type);
		$post->meta = $meta;
		if (!isset($meta->video->cover)) {
			$poster = wp_get_attachment_url(get_post_thumbnail_id($id));
			if ($poster) {
				$meta->video->poster = $poster;
			}
		}

		return $post;
	}

	public function exists($id) {
		return $this->get($id) !== false;
		
	}

	public function inline($id) {
		$post = $this->get($id);
		if (!$post) return null;
		$video =& $post->meta->video;
		
		if ($video->fullscreen === "yes" ) {
			$template = '<a href="%s" data-target="flare" data-flare-videoformats="%s" data-poster="%s" data-flare-videoposter="%s" class="peVideo"></a>';
		} else {
			$template = '<a href="%s" data-formats="%s" data-poster="%s" class="peVideo"></a>';
		}

		return sprintf($template,
					   $video->url,
					   join(",",$video->formats),
					   $video->poster,
					   $video->poster
					   );
	}

	public function show($id) {
		$inline = $this->inline($id);
		if ($inline) {
			echo $inline;
		}
		
	}


}

?>
