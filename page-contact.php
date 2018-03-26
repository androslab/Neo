<?php
/*
Template Name: Contact
*/
?><?php $t =& peTheme(); ?>
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
						<?php $gmap =& $t->content->meta()->gmap; ?>
						<?php $contact =& $t->content->meta()->contact; ?>

						<!--google maps-->
						<?php if ($gmap->show == "yes"): ?>
						<div class="row-fluid gmapWrap">
							<div class="span12 gmap" data-latitude="<?php echo $gmap->latitude; ?>" data-longitude="<?php echo $gmap->longitude; ?>" data-title="<?php echo esc_attr($gmap->title); ?>" data-zoom="<?php echo $gmap->zoom; ?>" >
								<div class="description"><?php echo $gmap->description; ?></div>
							</div>
						</div>
						<?php endif; ?>

						<!--contact form-->
						<div class="row-fluid">
							<div class="span12 contact">
								<h1><?php $content->title(); ?></h1>
								<?php $content->content(); ?>
								<form method="post" class="peThemeContactForm">
									
									<div class="control-group">
										<div class="controls">
											<input id="name" type="text" name="author" class="span5 required" data-fieldid="0" />
										</div>
										<label class="control-label" for="name">Naam<span class="required">*</span></label>
									</div>
										
									<div class="control-group">
										<div class="controls">
											<input id="email" type="text" name="email" class="span5 required" data-fieldid="1" data-validation="email"/>
										</div>
										<label class="control-label" for="email">Email<span class="required">*</span></label>
									</div>
											
									<div class="control-group">
										<div class="controls">
											<input id="website" type="text" name="website" data-fieldid="2" class="span5"/>
										</div>
										<label class="control-label" for="website">Onderwerp</label>
									</div>
												
									<div class="control-group">
										<textarea name="message" id="message" class="span7 required" data-fieldid="3" cols="45" rows="8" placeholder="Typ hier uw bericht.."></textarea>
									</div>
												
									<button id="submit" class="btn btn-info" type="submit" name="submit">Verzend bericht</button>
												
												
								</form>
											
								<!--alert success-->
								<div id="contactFormSent" class="formSent alert alert-success fade in">
									<?php echo $contact->msgOK; ?>
								</div>
											
								<!--alert error-->
								<div id="contactFormError" class="formError alert alert-error fade in">
									<?php echo $contact->msgKO; ?>
								</div>
											
							</div>
						</div>
						<!--end contact form-->

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
