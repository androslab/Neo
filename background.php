<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php if ($background = $t->background->conf()): ?>
<!--background component-->
<div 
	class="peBackground clearfix" 
	id="backgroundSlider"
	data-resource="<?php echo $background->resource; ?>"
	<?php if ($background->image): ?>
	data-color="<?php echo $background->image; ?>"
	data-bw="<?php echo $background->image; ?>"
	<?php endif; ?>
	<?php if ($background->images): ?>
	data-slideshow="<?php echo $background->images; ?>"
	<?php endif; ?>
	>
</div>

<?php if ($background->overlay): ?>
<?php if ($background->overlayImage): ?>
<!--bg overlay-->
<div class="pePatternOverlay" style="background-image: url('<?php echo $background->overlayImage; ?>')"></div>
<?php endif; ?>
<!--bg color overlay-->
<div class="peOverlay bgColor"></div>
<?php endif; ?>
<?php endif; ?>
