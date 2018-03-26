<?php $t =& peTheme() ?>
<?php $slider = $t->content->meta()->slider; ?>
<?php if ($slider->id): ?>
<section class="sliderWrap">
	<div class="container">                
		<!--slider-->
		<div class="row-fluid slider">
			<div class="span12">
				<?php $t->template->slider_volo($t->gallery->getSliderLoop($slider->id,980,450,4,"span4",array("config" => $slider))); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
