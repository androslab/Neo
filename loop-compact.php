<?php 
$types = 
	array(
		  "page" => __pe("Page"),
		  "post" => __pe("Post"),
		  "project" => __pe("Project")
		  );
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $media = isset($t->template->args["media"]) ? $t->template->args["media"] : true; ?>		
<div class="row-fluid">
	<div class="span12">
		<?php while ($t->content->looping() ) : ?>
		<?php $format = $t->content->format(); ?>
		<!--result-->
		<div class="row-fluid result">
			<?php if ($media): ?>	
			<div class="span2 post-image">
				<a href="<?php $t->content->link() ?>">
					<?php $content->img(100,100); ?>
				</a>
			</div>
			<?php endif; ?>
			<div class="<?php echo $media ? "span10" : "span12"; ?> result-title">
				<h3>
					<a href="<?php $t->content->link() ?>">
						<?php $t->content->title() ?>
					</a>
				</h3>
				<?php $t->content->content() ?>
			</div>
		</div>
		<!--end result-->
		<?php endwhile; ?>
	</div>                  
</div>