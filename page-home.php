<?php
/*
Template Name: Home (slider)
*/
?><?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<?php putRevSlider("slider1","homepage") ?>
<!--main content-->
<section class="mainContentWrap">
	<div class="container mainContent wide">
        <div class="row-fluid">
       
			<div class="span12">
				<?php get_template_part("common-mobilesearch"); ?>
				<?php while ($t->content->looping() ) : ?>
				<?php $meta =& $t->content->meta(); ?>

				<div class="row-fluid">
					<div class="span12">
						<h1 class="featuredTitle"><?php $content->title(); ?></h1>
						<p class="action">
							<?php echo $meta->extra->content; ?>
						</p>
					</div>
				</div>

				<div class="row-fluid featuredContent">
					<?php $content->content(); ?>	
				</div>
		
				<?php endwhile; ?>
				<?php comments_template(); ?>

			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
