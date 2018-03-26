<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $project =& $t->project; ?>

<?php $cols = $meta->portfolio->columns; ?>
<?php $filterable = $meta->portfolio->filterable == "yes" && $cols > 1; ?>
<?php $count = $cols > 1 ? -1 : $t->options->get("projectPageSize");  ?>

<!--page title & filter-->
<div class="row-fluid pageTitle portfolio">
	<div class="span5"><h1><?php $content->title() ?></h1></div>
	
	<?php if ($filterable): ?>
	<div class="span7 filter peIsotopeFilter">
		<p><?php $project->filter('',"keyword"); ?></p>
	</div>
	<?php endif; ?>
</div>

<?php if (!post_password_required()): ?>
<?php if ($loop = $project->customLoop($count,$meta->portfolio->tags,$cols == 1)): ?>
<?php $mainClass = array("span9","span6","span4","span3","span2","span2"); ?>
<?php $rowClass = $cols > 1 ? " post-thumbs" : ""; ?>
<?php $mainClass = $mainClass[$cols-1]; ?>
<div class="peIsotopeContainer">
	<?php while ($content->looping()): ?>
	<?php $meta =& $content->meta(); ?>
	<?php $idx = $content->idx(); ?>
	<?php $last = $content->last(); ?>
	<?php if ($cols > 0 && ($idx % $cols) == 0): ?>
	<div class="row-fluid<?php echo $rowClass ?>">
		<?php endif; ?>
		<?php if ($cols > 1): ?>
		<div class="<?php echo $mainClass ?> peIsotopeItem <?php $project->filterClasses(); ?>">
			<?php $t->template->get_part(compact("cols"),"project","gridcell"); ?>
		</div>
		<?php else: ?>
		<div class="span9">
			<div class="innerSpacer">
				
				<div class="portfolioItem">							
					<a class="peOverInfo"  href="<?php echo get_permalink(); ?>">
						<?php $t->content->img(680,350) ?>
					</a>
				</div>
			</div>
		</div>
		
		<!--description-->
		<div class="span3">
			
			<div class="item-description">
				<h3>
					<a href="<?php echo get_permalink(); ?>"><?php $content->title(); ?></a>
				</h3>
				<span class="projectIcon">
					<i class="<?php echo $content->meta()->project->icon; ?> icon-white"></i>
				</span>
				<span class="date"><?php $t->content->date(); ?></span>
				<?php $content->content(); ?>
			</div>
			
		</div>
		
		<div class="divider solid clearfix"><span></span></div>
		<?php endif; ?>
		<?php if ($cols > 0 && (($idx == $last) || ($idx % $cols) == ($cols-1))): ?>
	</div>
	<?php endif; ?>
	<?php endwhile; ?>
</div>
<?php endif; ?>
<?php if ($cols == 1) $content->pager("span10");  ?>
<?php endif; ?>