<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $media = isset($t->template->args["media"]) ? $t->template->args["media"] : true; ?>
<div class="row-fluid">
	<div class="span12 compact">
		<?php while ($t->content->looping() ) : ?>
		<div class="row-fluid result">
			<?php if ($media): ?>
			<div class="span2 post-image">
				<a href="<?php $t->content->link() ?>">
					<?php $content->img(50,50); ?>
				</a>
			</div>
			<?php endif; ?>
			<div class="<?php echo $media ? "span10" : "span12"; ?> result-title">
				<a class="postTitle" href="<?php $t->content->link() ?>">
					<?php $t->content->title() ?>
				</a>
				

				<p><?php echo peTheme()->utils->truncateString(get_the_excerpt(),apply_filters("pe_theme_loop_compact_excerpt_length",180)); ?></p><a class="label moreBtn" href="<?php $t->content->link() ?>"><?php e__pe("more"); ?></a>
			</div>
		</div>
		<?php endwhile; ?>
	</div>                  
</div>