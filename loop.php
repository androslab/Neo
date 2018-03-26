<?php $t =& peTheme(); ?>
<?php while ($t->content->looping() ) : ?>
<?php $format = $t->content->format(); ?>
<?php $media = isset($t->template->args["media"]) ? $t->template->args["media"] : true; ?>
<!--post-->
<div class="row-fluid">
	<div <?php $t->content->classes("span12"); ?>>
		
		<?php if ($media): ?>
		<?php get_template_part("intro-post",$t->content->format()); ?>
		<?php endif; ?>

		<?php if ($format != "quote" || get_the_content()): ?>
		<!--post content-->
		<div class="row-fluid post-content">
			
			<?php if ($format != "quote"): ?>
			<div class="row-fluid">
				<div class="span2 relative">
					<span class="postTypeIcon">
						<?php switch ($format): case "video":?>
						<?php /* VIDEO ICON */ ?>
						<i class="video"></i>
						<?php break; case "gallery": ?>
						<?php switch ($t->content->meta()->gallery->type): case "slider": ?>
						<?php /* SLIDER ICON */ ?>
						<i class="slider"></i>
						<?php break; case "thumbnails": ?>
						<?php /* GALLERY GRID ICON */ ?>
						<i class="grid"></i>
						<?php break; default: ?>
						<?php /* GALLERY FS ICON */ ?>
						<i class="fullscreen"></i>
						<?php endswitch; ?>
						<?php break; default: ?>
						<?php /* DEFAULT ICONS */ ?>
						<i class="<?php echo $t->content->hasFeatImage() ? "image" : "standard" ?>"></i>
						<?php endswitch; ?>
					</span>
					<?php if (is_sticky()): ?>
					<a class="stickyPost" data-rel="tooltip" href="#" title="<?php e__pe("Sticky Post"); ?>">
						<span class="stickyIcon"></span>
					</a>
					<?php endif; ?>
				</div>
				<div class="span10 post-title">
					<h3>
						<a href="<?php $t->content->link() ?>"><?php $t->content->title() ?></a> 
					</h3>
				</div>
			</div>
			<?php endif; ?>

			
			<div class="row-fluid">
				<div class="span10 pe-offset2">
					<?php $t->content->content() ?>
					
					<div class="post-meta">
						<?php echo __pe("Posted by "); ?><span class="post-author"><?php $t->content->author(); ?></span>,
						<span class="post-date"><?php $t->content->date(); ?></span>,
						<?php echo __pe("Tagged as "); ?><span class="tags"><?php $t->content->tags() ?></span>,
						<?php echo __pe("With "); ?><span class="comments-num"><a href="<?php $t->content->link() ?>"> <?php $t->content->comments() ?><i class="icon-comment"> </i></a></span> <?php edit_post_link(__pe("Edit Post")); ?>
					</div>
					
				</div>
			</div>
			
		</div>
		<!--end post content-->
		<?php endif; ?>
		
	</div>                  
</div>
<!--end post-->
<?php endwhile; ?>