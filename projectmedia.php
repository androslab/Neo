<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $full = isset($t->template->args["full"]) ? $t->template->args["full"] : false; ?>
<?php $w = $full ? 940 : 680; ?>
<?php $h = $full ? 470 : 450; ?>

<?php if (!$full): ?>
<div class="innerSpacer">
<?php endif; ?>
	
	<?php switch ($content->format()): case "image": ?>
	<!--image-->
	<div class="portfolioItem">
		<a class="peOverInfo" 
		   data-target="flare" 
		   data-flare-scale="<?php echo $meta->image->scale ?>" 
		   href="<?php $content->origImage() ?>">
			<?php $content->img($w,$h) ?>
		</a>
	</div>
	<?php break; case "video": ?>
	<div class="portfolioItem">
		<?php $t->video->show($meta->video->id); ?>
	</div>
	<?php break; case "gallery": ?>
	<?php switch ($meta->gallery->type): case "thumbnails": ?>
	<div class="post post-thumbs">
		<?php $t->template->intro_gallery($meta->gallery->id,480,396,"thumbnails"); ?>
	</div>
	<?php break; case "fullscreen": ?>
	<div class="post post-thumbs">
		<?php $t->template->gallery_cover($w,$h); ?>
		<?php $t->template->intro_gallery($meta->gallery->id,90,74,"fullscreen"); ?>
	</div>
	<?php break; case "single": ?>
	<?php $t->template->intro_gallery($meta->gallery->id,$w,$h,"thumbnails",-1,"portfolioItem"); ?>
	<?php break; case "slider": ?>
	<div class="portfolioItem">
		<?php $t->template->slider_volo($t->gallery->getSliderLoop($meta->gallery->id,$w,$h,4,"span4",array("config"=>$meta->gallery))); ?>
	</div>
	<?php endswitch; ?>
	<?php break; ?>
	<?php default: ?>
	<div class="portfolioItem">
		<?php $t->content->img($w,$h) ?>
	</div>
	<?php endswitch; ?>
	
<?php if (!$full): ?>
</div>
<?php endif; ?>