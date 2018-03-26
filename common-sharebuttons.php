<?php $content =& peTheme()->content; ?>
<?php $meta =& $content->meta(); ?>
<!--share buttons-->
<div class="row-fluid">
	
	<div class="span12 shareBox">                        
		
		<h4>Share: </h4>
		<!--tweet this button-->
		<button class="share twitter"></button>
		
		<!--pinterest button-->
		<button class="share pinterest"></button>
		
		<?php if ($content->type() != "project" || (isset($meta->project->layout) && $meta->project->layout == "full")): ?>
		<!--google plus 1 button-->
		<button class="share google"></button>
		
		<!--facebook like btn-->
		<button class="share facebook"></button>
		<?php endif; ?>
		
	</div>
</div>