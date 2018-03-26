<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<!--pagination-->
<?php if (is_single()): ?>
<?php if (peTheme()->content->type() == "project"): ?>
<div class="row-fluid pageTitle portfolio">
	<div class="span8">
		<span class="iconBg"><i class="<?php echo $content->meta()->project->icon; ?> icon-white"></i></span>
		<h1><?php $content->title() ?></h1>
	</div>
	<div class="span4 project-nav">
		<div class="pull-right">
			<a 
				href="<?php echo (($prev = $content->prevPostLink()) ? $prev : "#");  ?>" 
				class="prev-project pull-left label<?php echo ($prev ? "": " disabled"); ?>">
				<i class="icon-chevron-left icon-white"></i>
			</a>
			<a 
				href="<?php echo (($next = $content->nextPostLink()) ? $next : "#");  ?>" 
				class="next-project pull-left label<?php echo ($next ? "": " disabled"); ?>">
				<i class="icon-chevron-right icon-white"></i>
			</a>
		</div>
	</div>
</div>
					
<?php else: ?>
<div class="row-fluid post-pager">
	<div class="span12">
		
		<ul class="pager">
			<li class="previous<?php echo (($prev = $t->content->prevPostLink())  ? "" : " disabled") ?>">
				<a href="<?php echo ($prev ? $prev : "#"); ?>">&larr; <span><?php e__pe("Previous Post"); ?></span></a>
			</li>
			<li class="next<?php echo (($next = $t->content->nextPostLink())  ? "" : " disabled") ?>">
				<a href="<?php echo ($next ? $next : "#"); ?>"><span><?php e__pe("Next Post"); ?></span> &rarr;</a>
			</li>
		</ul> 
		
	</div>
</div>
<?php endif; ?>
<?php else: ?>
<?php $t->content->pager(); ?>
<?php endif; ?>
<!--end pagination-->