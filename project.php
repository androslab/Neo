<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $full = isset($meta->project->layout) && $meta->project->layout == "full";  ?>

<!--project-->
<div class="row-fluid project">
	
	<?php if ($full): ?>
	<div class="span12">
		<?php $t->template->get_part(compact("full"),"projectmedia"); ?>
	</div>
</div>
<div class="row-fluid project">
	<?php else: ?>
	<div class="span9">
		<?php $t->template->get_part(compact("full"),"projectmedia"); ?>
	</div>
	
	<?php endif; ?>
	

	<!--description-->
	<div class="<?php echo $full ? "span12 projectFullWidth" : "span3" ?>">
		
		<div class="item-description">
			<h4>
				<?php echo $meta->project->subtitle; ?>
			</h4>
			<div class="date">
				<?php $content->date(); ?>
			</div>
			
			<?php $content->content(); ?>
			<?php get_template_part("common-sharebuttons"); ?>
		</div>
		
	</div>
	
</div>
<!--end project-->
