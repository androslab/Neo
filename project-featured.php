<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>

<!--project-->
<div class="container featuredProject">
	<div class="row-fluid project featured">
		<div class="span12">
			<div class="titleWrap">
				<span class="iconBg"><i class="<?php echo $meta->project->icon; ?> icon-white"></i></span>
				<h3><span class="featuredStub"><?php echo __pe("Featured:"); ?></span> <a href="<?php $content->link(); ?>"><?php $content->title(); ?></a></h3>
				
				<div class="shareBtns">
					<!--facebook like btn-->
					<button class="share facebook"></button>
					<!--tweet this button-->
					<button class="share twitter"></button>
				</div>
				
			</div>
			<?php $full = true; $t->template->get_part(compact("full"),"projectmedia"); ?>
		</div>
	</div>	
</div>
<!--end project-->
