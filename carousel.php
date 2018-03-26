<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $isProject = $content->type() == "project" ; ?>
<?php $count = apply_filters("pe_theme_related_projects_count",$t->options->get($isProject ? "projectRelatedSize" : "projectLatestSize")); ?>
<?php if ($count > 0): ?>
<?php $delay = $t->options->get($isProject ? "projectRelatedDelay" : "projectLatestDelay"); ?>
<?php $filter = $isProject ? "prj-category" : ""; ?>
<?php $custom = $isProject ? array("post__not_in" => array(get_the_ID())) : null; ?>
<?php $cols = 4; ?>
<?php $title = apply_filters("pe_theme_related_projects_title",$isProject ? __pe("Related Projects") : __pe("Latest Projects")); ?>
<?php if ($loop =& $content->customLoop("project",$count,apply_filters("pe_theme_related_projects_filter",$filter),apply_filters("pe_theme_related_projects_custom",$custom))): ?>
<div class="row-fluid">
	<div class="span12 related-projects">
		<?php if ($title): ?><h3 class="related"><?php echo $title ?></h3><?php endif; ?>
		<!-- carousel -->
		<?php while ($content->looping()): ?>
		<?php $idx = $content->idx(); ?>
		<?php $last = $content->last(); ?>
		<?php if ($cols > 0 && ($idx % $cols) == 0): ?>
		<div class="row-fluid">
			<?php endif; ?>
			<?php $divClass = "span3" ; $t->template->get_part(compact("divClass"),"project","gridcell"); ?>
			<?php if ($cols > 0 && (($idx == $last) || ($idx % $cols) == ($cols-1))): ?>
		</div>
		<?php endif; ?>
		<?php endwhile; ?>
	</div>
</div>
<?php endif; ?>
<?php $content->resetLoop(); ?>
<?php endif; ?>