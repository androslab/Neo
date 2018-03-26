<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $cols = isset($t->template->args["cols"]) ? $t->template->args["cols"] : 4 ; ?>
<?php $divClass = isset($t->template->args["divClass"]) ? $t->template->args["divClass"] : "" ; ?>

<div class="<?php echo $divClass; ?> portfolioItem">
	<a href="<?php echo get_permalink(); ?>" class="peOverInfo peOverBW">
		<div class="title">
			<div class="infoWrap">
				<span class="peOverElementIconBG">
					<span class="peOverElementIcon">
						<i class="<?php echo $meta->project->icon; ?> icon-white"></i>
					</span>
				</span>
				<?php if ($cols < 6): ?>
				<span class="peOverElementText"><?php echo apply_filters("pe_theme_project_gridcell_title",$t->utils->truncateString(get_the_title(),30)); ?></span>
				<p class="peOverElementText"><?php echo apply_filters("pe_theme_project_gridcell_excerpt",$t->utils->truncateString(get_the_excerpt(),30)); ?></p>
				<?php endif; ?>
			</div>
			<div class="peOverElementInnerBG"></div>
		</div>	
		<?php $t->content->img(460,294) ?>
	</a>
</div>