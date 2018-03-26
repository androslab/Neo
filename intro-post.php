<?php $t =& peTheme(); ?>
<?php if ($t->content->hasFeatImage()): ?>
<div class="row-fluid">
	<div class="span12 post-image">
		<?php $t->content->img(680,350) ?>
	</div>
</div>
<?php endif; ?>
