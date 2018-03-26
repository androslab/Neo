<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<!--main content-->
<section class="mainContentWrap">
	<?php while ($t->content->looping() ) : ?>
	
	<div class="container projectTitleBar">
		<!--title and pager-->
		<?php get_template_part("common-pager"); ?>
	</div>

	<div class="container mainContent">
        <div class="row-fluid">
			
			<!--main content-->
			<?php
				// check if sidebar allowed or enabled
				$sidebar = 
					isset($meta->project->layout) && 
					$meta->project->layout == "full" && 
					isset($meta->sidebar->value) && 
					$meta->sidebar->value != "-none-"; 
			?>
			
			<div class="<?php echo $sidebar ? 'span9' : 'span12' ?>">
				<?php get_template_part("common-mobilesearch"); ?>
				<div class="row-fluid">
					<?php if ($sidebar): ?>
					<div class="innerSpacer">
						<?php endif; ?>
					
						<?php if (!post_password_required()): ?>
						<?php get_template_part("project"); ?>
						<?php get_template_part("carousel"); ?>
						<?php comments_template(); ?>
						<?php else: ?>
						<?php $content->content(); // show password ?>
						<?php endif; ?>
						<?php if ($sidebar): ?>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
			<?php if ($sidebar) get_sidebar(); ?>
        </div>
		
	</div>
<?php endwhile; ?>
</section>

<?php get_footer(); ?>
