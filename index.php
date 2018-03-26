<?php get_header(); ?>

<!--main content-->
<section class="mainContentWrap">
	<div class="container mainContent">
        <div class="row-fluid">
			<div class="span9">
				<div class="row-fluid">
					<div class="innerSpacer">
						<?php get_template_part("common-mobilesearch"); ?>
						<?php peTheme()->content->loop(is_search() || is_tax("prj-category") ? "search" : "") ?>
						<?php get_template_part("common-pager"); ?>
						
					</div>
				</div>
			</div>
          
			<?php get_sidebar() ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
