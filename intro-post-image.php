<?php $t =& peTheme(); ?>
<?php if ($t->content->hasFeatImage()): ?>
<div class="row-fluid">
	<div class="span12 post-image">
		<a class="peOverInfo" data-target="flare" data-flare-scale="<?php echo $t->content->meta()->image->scale ?>" href="<?php $t->content->origImage() ?>">
			<?php $t->content->img(680,350) ?>
		</a>
	</div>
</div>
<?php endif; ?>
		