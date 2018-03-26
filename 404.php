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
						<div class="row-fluid pageTitle">
							<div class="span12"><h1><?php echo $t->options->get("404title") ?></h1></div>
						</div>

						<!--404 error-->
						<div class="row-fluid">
							<div class="span12">
								
								
								<!--alert error-->
								<div class="alert alert-block alert-error fade in">
									<?php echo $t->options->get("404content") ?>
								</div>
								
							</div>
						</div>

					</div>
				</div>
			</div>
          
			<?php get_sidebar() ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
