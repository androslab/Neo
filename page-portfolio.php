<?php
/*
Template Name: Portfolio
*/
?><?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<!--main content-->
<section class="mainContentWrap">
	
	<?php while ($t->content->looping() ) : ?>
	
	<!-- fetured project -->
	<?php if (!post_password_required() && isset($meta->project->featured)):  ?>
	<?php $t->template->get_for($meta->project->featured,"project","featured"); ?>
	<?php endif; ?>
	
	<div class="container mainContent">
		
		<?php $cols = $meta->portfolio->columns; ?>
		<?php $filterable = $meta->portfolio->filterable == "yes" && $cols > 1; ?>
		<?php $sidebar = $cols > 1 && isset($meta->sidebar->value) && $meta->sidebar->value != "-none-"; ?>

        <div class="row-fluid<?php echo $filterable ? " peIsotope" : ""; ?>">
			<div class="span12">
				<?php get_template_part("common-mobilesearch"); ?>

				

				<?php if ($sidebar): ?>
				<div class="row-fluid">
					<div class="span9">
						<div class="row-fluid">
							<div class="innerSpacer">
								<?php endif; ?>

								<?php get_template_part("portfolio"); ?>
								<?php $content->resetLoop(); ?>
								<?php $content->content(); ?>
								<?php comments_template(); ?>

								<?php if ($sidebar): ?>
							</div>
						</div>
					</div>
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endwhile; ?>					

	
</section>

<?php get_footer(); ?>
