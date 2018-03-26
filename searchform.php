<form class="form-inline" action="<?php echo esc_url(home_url("/")); ?>" id="searchform" method="get" role="search">
	 <input name="s" id="s" type="text" class="input-medium span3"  value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr(__pe("Search")); ?>"/>
	 <button class="icon-search" type="submit"></button>
</form>