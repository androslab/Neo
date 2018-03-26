(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	function noop() {
		return false;
	}
	
	function imgfilter() {
		return this.href.match(/\.(jpg|jpeg|png|gif)$/i);
	}
	
	pixelentity.classes.Controller = function() {
		
		var top = $("#peBackToTop");
		var jwin = $(window);
		var sc = $("body,html");
		var menu = $("header ul.nav > li > ul");
		
		function setActiveMenuItem(url) {
			var page = url.split(/\//).pop();
			var m = $("header ul.nav");
			m.find('a[href$="'+page+'"]').parents("li").addClass("active");
		}

		
		function scrollHandler(e) {
			var pos = jwin.scrollTop();
			top[pos > 100 ? "removeClass" : "addClass"]("disabled");
		}
		
		function menuAlign(idx) {
			var item = menu.eq(idx);
			var sitem,submenu = item.find("ul.sub-menu").removeClass("rightAlign");
			var w = jwin.width();
			var endPos = item.width()+item.parent().offset().left;
			if (endPos >= w) {
				item.addClass("rightAlign");
			} else {
				for (var i=0;i<submenu.length;i++) {
					sitem = submenu.eq(i);
					if (endPos+sitem.width() > w) {
						sitem.addClass("rightAlign");
					}
				}
			}
		}

		
		function resize() {
			menu.removeClass("rightAlign").each(menuAlign);
			/*
			if ($.pixelentity.themeBackgroundSlider) {
				$.pixelentity.themeBackgroundSlider.resize();
			}
			*/
			
		}

		
		function scroll() {
			sc.animate({scrollTop:0},500);
			return false;
		}
		
		function autoFlare(idx,el) {
			el = $(el);
			el.attr("data-target","flare");
			var img = el.find("img:first");
			if (img.length === 1 && !(el.parent().hasClass("wp-caption") || img.hasClass("alignleft") || img.hasClass("alignleft"))) {
				el.addClass("peOverInfo");
			}
		}

		function navHandler(e) {
			var el = $(e.currentTarget);
			var sub = el.next();
			sub.css("visibility",sub.css("visibility") == "visible" ? "hidden" : "visible");
		}

		
		
		function start() {
			if ($.pixelentity.browser.mobile) {
				$("html").addClass("mobile");
			}
			//setActiveMenuItem(location.href);
			if (!$.pixelentity.browser.mobile) {
				top.click(scroll);				
				jwin.scroll(scrollHandler);
			}
			$('.navbar ul.nav a[href="#"]').click(noop);
			
			$('a[data-target!="flare"]').filter(imgfilter).each(autoFlare);
			
			if ($.pixelentity.browser.iDev) {
				$(".nav > li.dropdown a, .nav > li.dropdown .dropdown-menu a").click(navHandler);
			}
			
			
			// silly ie8 carousel bug fix
			if(jQuery.browser.msie && jQuery.browser.version < 9) {
				jQuery(".portfolioItem img, img.alignnone, img.alignleft, img.alignright").removeAttr("width");
			}
			
			
			if ($("aside.sidebar").length > 0) {
				$("body").addClass("hasSidebar");
			}
			
			var options;
			if ((options = window.peThemeOptions)) {
				if ($.pixelentity.browser.android || (options.backgroundMinWidth > 0 && $(window).width() < options.backgroundMinWidth)) {
					$(".peBackground, .pePatternOverlay, .peOverlay").detach();
					$("body").removeClass("black");
				}
			}
			
			$.pixelentity.widgets.build($("body"),{});
			if ($("pre.prettyprint").length > 0) {
				prettyPrint();
			}
			
			jwin.resize(resize);
			resize();
		}
		
		start();
	};
	
}(jQuery));
