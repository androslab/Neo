<?php
/**
 * Theme Header
 */

$t =& peTheme();
?><!DOCTYPE html>
<?php $skin = $t->options->get("skin"); ?>
<?php $class = "skin_$skin"; ?>
<!--[if IE 7 ]><html class="ie7 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie8 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie9 no-js <?php echo $class ?>" <?php language_attributes(); ?>><![endif]--> 
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js <?php echo $class ?>" <?php language_attributes();?>><!--<![endif]-->
   
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php $t->header->title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<!-- http://remysharp.com/2009/01/07/html5-enabling-script/ -->
		<!--[if lt IE 9]>
			<script type="text/javascript">/*@cc_on'abbr article aside audio canvas details figcaption figure footer header hgroup mark meter nav output progress section summary subline time video'.replace(/\w+/g,function(n){document.createElement(n)})@*/</script>
			<![endif]-->
		<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
		
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo $t->options->get("favicon") ?>" />

		<?php $t->font->load(); ?>

		<!-- scripts and wp_head() here -->
		<?php $t->header->wp_head(); ?>
		<?php $t->font->apply(); ?>
		<?php /*$t->color->apply();*/ ?>

		<?php if ($customCSS = $t->options->get("customCSS")): ?>
		<style type="text/css"><?php echo stripslashes($customCSS) ?></style>
		<?php endif; ?>
		<?php if ($customJS = $t->options->get("customJS")): ?>
		<script type="text/javascript"><?php echo stripslashes($customJS) ?></script>
		<?php endif; ?>
		

	</head>

	<body <?php $t->content->body_class(); ?>>

		<?php get_template_part("background") ?>

		<!--top info-->
		<div class="infoTop"><span><?php echo $t->options->get("headerCallUs") ?></span></div>
    
    <!--main site container-->
    <div class="siteWrapper">
        
        <!--header and menu-->
        <header class="navbar navbar-fixed-top" id="top">
            <div class="navbar-inner">
                <div class="container">
                    
                    <!--mobile/tablet menu btn-->
                    
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="btnTitle">Menu</span>
                        <span class="icon-chevron-down icon-white"></span>
                    </a>
                    
                    <div class="row-fluid">
                        
                        <!--logo-->
                        
                        <div class="span3 brandHolder clearfix">
                            <a class="brand clearfix" href="<?php echo home_url(); ?>" title="Home">
								<img class="highres" src="<?php echo $t->options->get("logo") ?>" alt="logo" />
								<img class="lowres" src="<?php echo $t->options->get("logoLow") ?>" alt="logo" />
								<img class="logoBg" src="<?php echo PE_THEME_URL; ?>/img/skin/logo_panel.png" alt="logo background" />
                            </a>
                        </div>
                        
                        <!--tagline-->
                        
                        <div class="span9  tagline">
							<div class="taglineContent"><?php echo $t->options->get("headerTaglineQuote"); ?></div>
                        </div>
                    </div>
                    
                    
                <div class="nav-collapse clearfix">
                        
                        <div class="row-fluid">
                            <div class="span12 mainNav clearfix">
                                
                                <!--main nav-->
								<?php $t->menu->show("main"); ?>
                                
                                <!-- nav bar search -->
<!--                                <div class="navBarSearch">
									<?php get_template_part("searchform"); ?>
                                </div>-->
                                
                            </div>
                        </div>						
                        
                    </div>
                <!--end nav collapse-->
                
                </div>
                <!--end container-->
                
            </div>
        </header>


