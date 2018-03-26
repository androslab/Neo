<?php $t =& peTheme(); ?>
<?php $videoID = $t->content->meta()->video->id; ?>
<?php if ($t->video->exists($videoID)): ?>
<div class="row-fluid post-image">			
	<div class="span12">
		<div class="portfolioItem">
			<?php $t->video->show($videoID); ?>
		</div>
	</div>
</div>
<?php endif; ?>