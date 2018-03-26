<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$t =& peTheme();
?>

<footer>
            
	<!--footer main-->
	<section class="footerMain">
		<div class="container">
			<div class="row-fluid">
				<?php $t->footer->widgets(); ?>                        
			</div>
		</div>
	</section>
	<!--end footer main-->
            
	
	<!--footer lower-->
	
            <section class="footerLower">
                <div class="container">
                    <div class="row-fluid">
                        
                        <!--social media icons-->
                        
                        <div class="span4 smedia">
							<?php $t->content->socialLinks($t->options->get("footerSocialLinks"),"footer"); ?>
                        </div>  
                        
                        
                        
                        <!--back to top button-->
						<a href="#top" id="peBackToTop" class="label btt disabled"><span class="icon-chevron-up icon-white"></span></a>
                                
                        <!--footer menu-->
                        
                        <div class="span8 footNav">
							<?php $t->menu->show("footer","simple"); ?>
                        </div>                        
                        
                    </div>
                </div>
            </section>
            <!--end footer lower-->
            
        </footer>
        <!--end footer-->
    
    </div>
    <!--end siteWrapper-->
    
    <!--social media icons-->
    
    <div class="copyrightWrapper">
        <!--copyright statement-->
        <div class="row-fluid">
            <div class="span12 copyright"><p><?php echo $t->options->get("footerCopyright") ?></p></div>
        </div>
    </div>


<?php $t->footer->wp_footer(); ?>

</body>
</html>