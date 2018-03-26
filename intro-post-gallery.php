<?php $t =& peTheme(); ?>
<?php $gallery = $t->content->meta()->gallery ?>
<?php $gtype = $gallery->type ?>
<div class="row-fluid">
	<div class="span12 post-image">
		<?php switch ($gtype): case "slider": ?>
		<?php $gallery->delay = is_single() ? $gallery->delay : 0; ?>
		<?php $loop = $t->gallery->getSliderLoop($gallery->id,680,350,4,"span4",array("config" => $gallery)); ?>
		<?php $t->template->slider_volo($loop); ?>
		<?php break; case "thumbnails": ?>
		<?php if (is_single()): ?>
		<?php $t->template->intro_gallery($gallery->id,480,396,"thumbnails"); ?>
		<?php else: ?>
		<?php $t->template->gallery_cover(680,350); ?>
		<?php endif; ?>
		<?php break; case "fullscreen": ?>
		<?php $t->template->gallery_cover(680,350); ?>
		<?php if (is_single()): ?>
		<?php $t->template->intro_gallery($gallery->id,90,74,"fullscreen"); ?>
		<?php endif; ?>
		<?php endswitch; ?>
	</div>
</div>
