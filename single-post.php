<?php $t =& peTheme(); ?>
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
						
						<!--post-->
						<div class="row-fluid">
							<div class="span12 post full">
								<div class="row-fluid">
									<div class="span12 post-title">
										<h3><?php $t->content->title() ?></h3>
										<p class="post-meta"><?php $t->content->date(__pe("Posted on ")); ?>, <?php peTheme()->content->author(__pe("by")) ?>, <?php peTheme()->content->category(__pe("in")) ?>, <?php echo __pe("tagged"); ?> <?php peTheme()->content->tags() ?></p>
									</div>
								</div>
								
								<?php get_template_part("intro-post",$t->content->format()) ?>
								
								<!--post content-->
								<div class="contentWrap">
									<div class="row-fluid">
										<div class="span12">
											<?php $t->content->content(); ?>
										</div>
									</div>
								</div>
								<!--end post content-->
								<?php get_template_part("common-sharebuttons"); ?>
								
							</div>                  
						</div>
						<!--end post-->

						<?php get_template_part("common-pager"); ?>
						<?php comments_template(); ?>
								
						<?php endwhile; ?>

                
					</div>
				</div>
			</div>
          
			<?php get_sidebar() ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
