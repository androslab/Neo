<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<!--main content-->
<section class="mainContentWrap">
	<div class="container mainContent">
        <div class="row-fluid">
			<div class="span9">
				<div class="row-fluid">
					<div class="innerSpacer">
						
						<?php get_template_part("common-mobilesearch"); ?>
						<?php while ($t->content->looping() ) : ?>
						<div class="row-fluid pageTitle">
							<div class="span12"><h1><?php $content->title(); ?></h1></div>
						</div>
						<div class="row-fluid">
							<?php $content->content(); ?>
						</div>
						<?php endwhile; ?>
						<?php comments_template(); ?>
						
					</div>
				</div>
			</div>
          
			<?php get_sidebar() ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
