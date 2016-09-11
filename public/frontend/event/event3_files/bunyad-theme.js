/**
 * Motive Theme Utilities 
 */
var Bunyad_Theme = (function($) {
	"use strict";
	
	var has_touch = false,
		responsive_menu = false;
	
	// module
	return {
		
		init: function() 
		{			
			// posts grid 
			var grid = $('.posts-grid').data('grid-count');
			if (parseInt(grid) > 0) {
				$('.posts-grid .column:nth-child(' + grid + 'n)').addClass('last');
			}
			
			// fit videos to container
			$('.featured-vid, .post-content').fitVids();
			
			// fix limitation of inline read more text
			$('.read-more').each(function() { 
				if ($(this).position().left === 0) { 
					$(this).addClass('new-line'); 
				}
			});
			
			/**
			 * Social Share 
			 */
			$('.share-links .more').click(function() {
				
				$(this).parent().find('.share-more').addClass('active');
				$(this).remove();
				
				return false;
			});
						
			// social icons widget
			$('.lower-footer .social-icons a, .share-links a').data('toggle', 'tooltip').tooltip({placement: 'top'});
			$('.social-icons a').tooltip({placement: 'bottom'});
			
			$('.search-box .top-icon').click(function() {
				$(this).parent().toggleClass('active');
				return false;
			});
			
			// news focus block
			$('.news-focus .subcats a').click(function() {
				
				var active = $(this).parents('.subcats').find('a.active'),
					parent = $(this).parents('.news-focus');
				
				// show the news and hide the other block
				parent.find('.news-' + active.data('id')).hide();
				parent.find('.news-' + $(this).data('id')).fadeIn('slow');
				
				$(this).addClass('active');
				active.removeClass('active');
				
				return false;
			});
			
			// setup all sliders
			this.sliders();
			
			// handle shortcodes
			this.shortcodes();
			
			// setup mobile navigation
			this.responsive_nav();
			
			// start the news ticker
			this.news_ticker();
			
			// setup the lightbox
			this.lightbox();
			
			// use sticky navigation if enabled
			this.sticky_nav();
			
			this.user_ratings();
			
			this.content_slideshow();
			
			/**
			 * IE fixes
			 */
			if ($.browser.msie && 8 == parseInt($.browser.version)) {
				
				// fontawesome4 fails to draw sometimes on IE8
			    $(function() {
			        var $ss = $('#motive-font-awesome-css');
			        $ss[0].href = $ss[0].href;
			    });

				// background image fix for IE8
				var bg = $('body').css('background-attachment'),
					bg_url = $('body').css('background-image').replace(/^url\((['"]?)(.*)\1\)$/, '$2');
			
				if (bg == 'fixed' && bg_url) {
			 							
					$('body').append('<style type="text/css">.bg-overlay { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + bg_url + '\', sizingMethod=\'scale\'); \
						-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + bg_url + '\', sizingMethod=\'scale\')"; }</style>');
					
					$('<div class="bg-overlay"></div>').appendTo('body');
				}
			}
			
			// add support for placeholder in IE8/IE9
			$('input, textarea').placeholder();				
		},
		
		news_ticker: function()
		{
			$('.trending-ticker ul').each(function() {
				if (!$(this).find('li.active').length) {
					$(this).find('li:first').addClass('active');
				}
				
				var ticker = $(this);
				
				window.setInterval(function() {
					
					
					var active = ticker.find('li.active');
					active.fadeOut(function() {
						
						var next = active.next();
						if (!next.length) {
							next = ticker.find('li:first');
						}
						
						next.addClass('active').fadeIn();
						active.removeClass('active');
					});
					
					
					
				}, 8000);
			});
		},

		responsive_nav: function()
		{
			// detect touch capability dynamically
			$(window).on('touchstart', function() {
				has_touch = true;
				$('body').addClass('touch');
			});
			
			this.init_responsive_nav();
			this.touch_nav();
			var that = this;

			$(window).on('resize orientationchange', function() {
				that.init_responsive_nav();
			});		
		},
		
		/**
		 * Setup the responsive nav events and markup
		 */
		init_responsive_nav: function() {
			
			if ($(window).width() > 939 || responsive_menu) {
				return;
			}
			
			// set responsive initialized
			responsive_menu = true;
			
			// clone navigation for mobile
			var clone = $('.navigation > div[class$="-container"]').clone().addClass('mobile-menu-container'),
				mobile_search = false,
				off_canvas = true;
			
			// off-canvas setup?
			if (off_canvas) {
				clone.addClass('off-canvas');
				clone.find('.menu').prepend($('<li class="close"><a href="#"><span>' + $('.navigation .selected .text').text()  + '</span> <i class="fa fa-times-circle"></i></a></li>'));
				$('body').addClass('nav-off-canvas');
			}
			
			clone.find('.menu').addClass('mobile-menu')
				.find('.mega-menu.links').removeClass('mega-menu links ts-row');
			
			clone.find('div.mega-menu').each(function() {
				$(this).replaceWith('<ul>' + $(this).find('.sub-nav').html() + '</ul>');
			});
			
			clone.appendTo('.navigation');
			
			// register click handlers for mobile menu
			$('.navigation .mobile .selected').click(function(e) {
				
				// search active?
				if ($(e.target).hasClass('hamburger') || !mobile_search  || !$(this).find('.search .query').is(':visible')) {
                   
                    if (off_canvas) {
                        $('.navigation .mobile-menu').addClass('active');
                    	$('body').toggleClass('off-canvas-active');
                    }
                    else {
                        $('.navigation .mobile-menu').toggleClass('active');
                    }
                    
                    return false;
				}
			});
			
			// off-canvas close
			$('.off-canvas .close').click(function() {
				$('body').toggleClass('off-canvas-active');
			});
			
			// setup mobile menu click handlers
			$('.navigation .mobile-menu li > a').each(function() {
				
				if ($(this).parent().children('ul').length) {
					$('<a href="#" class="chevron"><i class="fa fa-caret-down"></i></a>').appendTo($(this));
				}
			});
			
			$('.navigation .mobile-menu li .chevron').click(function() {
					$(this).closest('li').find('ul').first().slideToggle().parent().toggleClass('active item-active');
					return false;
			});
			
			// add active item
			if (!$('body').hasClass('home')) {
				var last = $('.mobile-menu .current-menu-item').last().find('> a');
				if (last.length) {
					
					var selected = $('.navigation .mobile .selected'),
						current  = selected.find('.current'),
						cur_text = selected.find('.text').text();
					
					if (cur_text.slice(-1) !== ':') {
						selected.find('.text').text(cur_text + ':');
					}
					
					current.text(last.text());
				}
			}
		},

		touch_nav: function() {
			
			var targets = $('.menu:not(.mobile-menu) a'),
				open_class = 'item-active',
				child_tag = 'ul, .mega-menu';
			
			targets.each(function() {
				
				var $this = $(this),
					$parent = $this.parent('li'),
					$siblings = $parent.siblings().find('a');
				
				$this.click(function(e) {
					
					if (!has_touch) {
						return;
					}
					
					var $this = $(this);
					e.stopPropagation();
					
					$siblings.parent('li').removeClass(open_class);
					
					// has a child? open the menu on tap
					if (!$this.parent().hasClass(open_class) && $this.next(child_tag).length > 0 && !$this.parents('.mega-menu.links').length) {
						e.preventDefault();
						$this.parent().addClass(open_class);
					}
				});
			});
			
			// close all menus
			$(document).click(function(e) {
				if (!$(e.target).is('.menu') && !$(e.target).parents('.menu').length) {
					targets.parent('li').removeClass(open_class);
				}
			});
		},
		
		sticky_nav: function()
		{
			var nav = $('.navigation'),
			nav_top = nav.offset().top;
		
			// not enabled?
			if (!nav.data('sticky-nav')) {
				return;
			}
			
			if (nav.find('.sticky-logo').length) {
				nav.addClass('has-logo');
			}
			
			var sticky = function() {
	
				if (!nav.data('sticky-nav') || $(window).width() < 800) {
					return;
				}
				
				// make it sticky when viewport is scrolled beyond the navigation
				if ($(window).scrollTop() > nav_top) {
					
					if (!nav.hasClass('sticky')) {
						nav.addClass('sticky no-transition');
					
						setTimeout(function() { 
							nav.removeClass('no-transition'); 
						}, 100);
					}
					
				} else {
					nav.removeClass('sticky'); 
				}
			};
	
			sticky();
	
			$(window).scroll(function() {
				sticky();
			});
			
		},
		
		/**
		 * Setup all the sliders available
		 */
		sliders: function()
		{
		
			var is_rtl = $('html').attr('dir') == 'rtl' ? true : false;
			
			// Setup carousels for blocks
			$('.owl-carousel').each(function() {
				
				var per_slide = $(this).data('items') || 3;
				
				$(this).owlCarousel({
					nav: false,
					responsive: {
						0: {items: 1},
						600: {items: (per_slide > 2 ? 2 : per_slide)},
						768: {items: (per_slide > 3 ? 3 : per_slide)},
						940: {items: per_slide}
					},
					margin: $(this).data('margin') || 22,
					stagePadding: $(this).data('stage-pad') || 0,
					slideBy: 'page',
					rtl: is_rtl
				});
			});
			
			// attach event handlers to carousel nav bars
			var owl_nav_handler = function(container, selector) {
				$(container).find(selector).click(function() {
	
					var owl = $(this).closest(container).parent().find('.owl-carousel');
					owl.owlCarousel();
					
					var action = ($(this).hasClass('next') ? 'next' : 'prev');
					owl.trigger(action + '.owl.carousel');
					
					return false;
				});
			};
			
			owl_nav_handler('.carousel-nav-bar', 'a');			
			
			
			// Fire up main slider
			 $('.main-slider').each(function() {
				 
				$(this).addClass('owl-carousel').owlCarousel({
					items: 1,
					animateOut: ($(this).data('animation') == 'fade' ? 'fadeOut' : null),
					loop: true,
					autoplay: $(this).data('autoplay') || 0,
					autoplayTimeout: $(this).data('autoplay-interval') || 0,
					nav: true,
					rtl: is_rtl,
					navText: ['', ''],
	                autoplayHoverPause: true
				});
			 });
			//  CSS hover event won't trigger while animating - set JS events
			$('.main-slider.as-primary a').hover(
				function() {
					$(this).closest('.owl-carousel').find('.active').addClass('hover');
				}, 
					
				function() {
					$(this).closest('.owl-carousel').find('.hover').removeClass('hover');
				}
			);

			/**
			 * Grid Slider
			 */
			var grid_owl = $('.featured-grid .grid'),
				grid_carousel = function() {
				
					grid_owl.addClass('owl-carousel').owlCarousel({
						items: 1,
						animateOut: 'fadeOut',
						loop: false,
						nav: false,
						autoplayHoverPause: true,
						rtl: is_rtl
					});
				};

			// convert featured grid to slider on mobile devices
			var resize_grid_carousel = function() {
				
				var has_carousel = grid_owl.hasClass('owl-carousel');
				
				if ($(window).width() > 939) {
					if (!has_carousel) {
						return;
					}
					
					grid_owl.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
					grid_owl.find('.owl-stage-outer').children().unwrap();
				}
				else {
					if (!has_carousel) {					
						grid_carousel();
					}
				}
			};
		
			// on init and resize
			resize_grid_carousel();
			$(window).on('resize', resize_grid_carousel);
			
			
			// Twitter widget carousel
			$('.latest-tweets .tweets').addClass('owl-carousel').owlCarousel({
				items: 1,
				mouseDrag: false,
				rtl: is_rtl
			});
			
			owl_nav_handler('.twitter-widget', '.tweet-nav a');
		},
		
		/**
		 * Multi-page Post content slideshow
		 */
		content_slideshow: function()
		{
			
			var slideshow_cache = {},
				slideshow_wrap  = '.post-slideshow .post-pagination-next',
				that = this;
			
			if ($(slideshow_wrap).length && $(slideshow_wrap).data('type') == 'ajax') {
			
				var processing;
				
				$('.main-content').on('click', '.post-slideshow .post-pagination-next a', function() {
					
						// showing on home-page?
						if ($('body').hasClass('page')) {
							return;
						}
						
						// abort existing request
						if (processing && processing.hasOwnProperty('abort')) {
							processing.abort();
						}
						
						var parent = $(this).closest('.post-slideshow'),
							url    = $(this).attr('href');
						
						parent.css('height', parent.height() + 'px');
						parent.find('.content-page').removeClass('active').addClass('hidden previous');
					
						var show_slide = function(data) {
							
							// change browser url
							if (history.pushState) {
								history.pushState({}, '', url);
							}
							
							var page = $(data).find('.post-slideshow');
							
							if (page.length) {
								parent.find('.post-pagination-next').html(page.find('.post-pagination-next').html());
								parent.prepend(page.find('.content-page').addClass('hidden loading'));
								
								parent.find('.content-page.previous').remove();
								
								// rebind lightbox
								that.lightbox();
								
								setTimeout(function() {
									parent.css('height', 'auto');
									parent.find('.content-page.loading').removeClass('previous hidden loading');
								}, 1);
							}
							
							processing = null;
							
						};
						
						// in cache?
						if (slideshow_cache[url]) {
							show_slide(slideshow_cache[url]);
						}
						else {
							
							// get via ajax
							processing = $.get(url, function(data) {
								slideshow_cache[url] = data;
								show_slide(data);
							});
						}
						
						return false;
				});
				
				// keyboard nav
				$(document).on('keyup', function(e) {				
						if (e.which == 37) {
							$(slideshow_wrap).find('.prev').parent().click();
						}
						else if (e.which == 39) {
							$(slideshow_wrap).find('.next').parent().click();
						}
				});
				
			} // end slideshow wrap
		},
		
		/**
		 * Register shortcode related events
		 */
		shortcodes: function()
		{
			// normal tabs
			$('.tabs-list a').click(function() {

				var tab = $(this).data('tab'),
					tabs_data = $(this).closest('.tabs-list').siblings('.tabs-data'),
					parent = $(this).parent().parent(),
					active = parent.find('.active');
				
				if (!active.length) {
					active = parent.find('li:first-child');
				}

				active.removeClass('active').addClass('inactive');
				$(this).parent().addClass('active').removeClass('inactive');
				
				// hide current and show the clicked one
				var active_data = tabs_data.find('.tab-posts.active');
				if (!active_data.length) {
					active_data = tabs_data.find('.tab-posts:first-child');
				}
				
				active_data.hide();
				
				tabs_data.find('#recent-tab-' + tab).fadeIn().addClass('active').removeClass('inactive');
				
				// fix for li counters in IE <=9
				if ($.browser.msie && parseInt($.browser.version) <= 9) {
					setTimeout(function() {
						$('#recent-tab-' + tab).hide().delay(1).show();
					}, 2);
				}
				
				return false;
				
			});
			
			/**
			 * Shortcode: Tabs
			 */
			$('.sc-tabs a').click(function() {
	
				// tabs first
				var tabs = $(this).parents('ul');
				tabs.find('.active').removeClass('active');
				$(this).parent().addClass('active');
				
				// panes second
				var panes = tabs.siblings('.sc-tabs-panes');
				
				panes.find('.active').hide().removeClass('active');
				panes.find('#sc-pane-' + $(this).data('id')).addClass('active').fadeIn();
				
				return false;
			});
			
			/**
			 * Shortcode: Accordions & Toggles
			 */
			$('.sc-accordion-title > a').click(function() {
				
				var container = $(this).parents('.sc-accordions');
				container.find('.sc-accordion-title').removeClass('active');
				container.find('.sc-accordion-pane').slideUp().removeClass('active');
				
				var pane = $(this).parent().next();
				if (!pane.is(':visible')) {
					$(this).parent().addClass('active');
					pane.slideDown().addClass('active');
				}
				
				return false;
			});
			
			$('.sc-toggle-title > a').click(function() {
				$(this).parent().toggleClass('active');
				$(this).parent().next().slideToggle().toggleClass('active');
				
				return false;
			});
	
		},
		
		/**
		 * User Ratings handling
		 */
		user_ratings: function() 
		{
			
			$('.user-ratings')
				.on('click', '.criterion', function() {
					
					var parent = $(this).parent();
					if (parent.hasClass('voted')) {
						return false;
					}
					
					parent.find('.user-rate').toggle(500);		
				});
			
			$('.user-ratings .rate-button').on('click', function() {
			
				var user_ratings = $(this).closest('.user-ratings'),
					bar = user_ratings.find('.label');
				
				// get current votes
				var votes = user_ratings.find('.vote-number'),
					cur_votes = parseInt(votes.text()) || 0;
				
				// setup ajax post data
				var post_data = {
						'action': 'bunyad_rate', 
						'id': user_ratings.data('post-id'), 
						'rating': user_ratings.find('select').val() * 10
				};
				
				user_ratings.css('opacity', '0.3');
				
				// add to votes and disable further voting 
				votes.text((cur_votes + 1).toString());
				user_ratings.addClass('voted');
				
				$.post(Bunyad.ajaxurl, post_data, function(data) {
					
					// update data
					if (data === Object(data)) {

						// change rating
						var cur_rating = user_ratings.find('.number').text();
						user_ratings.find('.number').text( cur_rating.search('%') !== -1 ? data.percent + ' %' : data.decimal );
						
						bar.css('width', data.percent + '%');
						
						$('.review-box .user-rate').fadeOut('slow');
					}
					
					user_ratings.addClass('voted').hide().css('opacity', 1).fadeIn('slow');	
					
				}, 'json');
				
			});
		},
		
		
		/**
		 * Setup Lightbox
		 */
		lightbox: function() {
			
			// disabled on mobile screens
			if (!$.fn.magnificPopup) {
				return;
			}
		
			// filter to handle valid images only
			var filter_images = function() {
				
				if (!$(this).attr('href')) {
					return false;
				}
				
				if ($(this).closest('.owl-item.cloned').length) {
					return false;
				}
				
				return $(this).attr('href').match(/\.(jpe?g|png|bmp|gif)$/); 
			};			
			
			/**
			 * Handle Galleries in post
			 */
			
			var gal_selectors = '.gallery-slider, .post-content .gallery, .post-content .tiled-gallery';
			
			// filter to only tie valid images
			$(gal_selectors).find('a').has('img').filter(filter_images).addClass('lightbox-gallery-img');
			
			// attach the lightbox as gallery
			$(gal_selectors).magnificPopup({
				delegate: '.lightbox-gallery-img',
				type: 'image',
				gallery: {enabled: true},
				removalDelay: 300,
				image: {
					titleSrc: function(item) {
						var image = item.el.find('img'), caption = item.el.find('.caption').html();
						return (caption || image.attr('title') || ' ');
					}
				},
				mainClass: 'mfp-fade'
			});
			
			// lightbox for non-gallery images in posts
			var selector = $('.post-content, .main .featured').find('a:not(.lightbox-gallery-img)').has('img');
			
			selector.add('.post-content, .main .featured, .lightbox-img').filter(filter_images).magnificPopup({
				type: 'image',
				removalDelay: 300,
				mainClass: 'mfp-fade'
			});
		}
		
	}; // end return
	
})(jQuery);

// load when ready
jQuery(function($) {
	Bunyad_Theme.init();
});


/**
 * Plugins and 3rd Party Libraries
 */

/**
 * Author Christopher Blum
 * Based on the idea of Remy Sharp, http://remysharp.com/2009/01/26/element-in-view-event-plugin/
 * 
 * License: WTFPL
 */
(function(b){function t(){var e,a={height:k.innerHeight,width:k.innerWidth};a.height||!(e=l.compatMode)&&b.support.boxModel||(e="CSS1Compat"===e?f:l.body,a={height:e.clientHeight,width:e.clientWidth});return a}function u(){var e=b(),g,q=0;b.each(m,function(a,b){var c=b.data.selector,d=b.$element;e=e.add(c?d.find(c):d)});if(g=e.length)for(d=d||t(),a=a||{top:k.pageYOffset||f.scrollTop||l.body.scrollTop,left:k.pageXOffset||f.scrollLeft||l.body.scrollLeft};q<g;q++)if(b.contains(f,e[q])){var h=b(e[q]),n=h.height(),p=h.width(),c=h.offset(),r=h.data("inview");if(!a||!d)break;c.top+n>a.top&&c.top<a.top+d.height&&c.left+p>a.left&&c.left<a.left+d.width?(p=a.left>c.left?"right":a.left+d.width<c.left+p?"left":"both",n=a.top>c.top?"bottom":a.top+d.height<c.top+n?"top":"both",c=p+"-"+n,r&&r===c||h.data("inview",c).trigger("inview",[!0,p,n])):r&&h.data("inview",!1).trigger("inview",[!1])}}var m={},d,a,l=document,k=window,f=l.documentElement,s=b.expando,g;b.event.special.inview={add:function(a){m[a.guid+"-"+this[s]]={data:a,$element:b(this)};g||b.isEmptyObject(m)||(g=setInterval(u,250))},remove:function(a){try{delete m[a.guid+"-"+this[s]]}catch(d){}b.isEmptyObject(m)&&(clearInterval(g),g=null)}};b(k).bind("scroll resize",function(){d=a=null});!f.addEventListener&&f.attachEvent&&f.attachEvent("onfocusin",function(){a=null})})(jQuery);

/**
 * Bootstrap: tooltip.js v3.2.0
 * http://getbootstrap.com/javascript/#tooltip
 * Licensed under MIT 
 */
+function(t){"use strict";function e(e){return this.each(function(){var o=t(this),n=o.data("bs.tooltip"),s="object"==typeof e&&e;(n||"destroy"!=e)&&(n||o.data("bs.tooltip",n=new i(this,s)),"string"==typeof e&&n[e]())})}var i=function(t,e){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null,this.init("tooltip",t,e)};i.VERSION="3.2.0",i.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},i.prototype.init=function(e,i,o){this.enabled=!0,this.type=e,this.$element=t(i),this.options=this.getOptions(o),this.$viewport=this.options.viewport&&t(this.options.viewport.selector||this.options.viewport);for(var n=this.options.trigger.split(" "),s=n.length;s--;){var r=n[s];if("click"==r)this.$element.on("click."+this.type,this.options.selector,t.proxy(this.toggle,this));else if("manual"!=r){var a="hover"==r?"mouseenter":"focusin",p="hover"==r?"mouseleave":"focusout";this.$element.on(a+"."+this.type,this.options.selector,t.proxy(this.enter,this)),this.$element.on(p+"."+this.type,this.options.selector,t.proxy(this.leave,this))}}this.options.selector?this._options=t.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},i.prototype.getDefaults=function(){return i.DEFAULTS},i.prototype.getOptions=function(e){return e=t.extend({},this.getDefaults(),this.$element.data(),e),e.delay&&"number"==typeof e.delay&&(e.delay={show:e.delay,hide:e.delay}),e},i.prototype.getDelegateOptions=function(){var e={},i=this.getDefaults();return this._options&&t.each(this._options,function(t,o){i[t]!=o&&(e[t]=o)}),e},i.prototype.enter=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);return i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),clearTimeout(i.timeout),i.hoverState="in",i.options.delay&&i.options.delay.show?void(i.timeout=setTimeout(function(){"in"==i.hoverState&&i.show()},i.options.delay.show)):i.show()},i.prototype.leave=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);return i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),clearTimeout(i.timeout),i.hoverState="out",i.options.delay&&i.options.delay.hide?void(i.timeout=setTimeout(function(){"out"==i.hoverState&&i.hide()},i.options.delay.hide)):i.hide()},i.prototype.show=function(){var e=t.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(e);var i=t.contains(document.documentElement,this.$element[0]);if(e.isDefaultPrevented()||!i)return;var o=this,n=this.tip(),s=this.getUID(this.type);this.setContent(),n.attr("id",s),this.$element.attr("aria-describedby",s),this.options.animation&&n.addClass("fade");var r="function"==typeof this.options.placement?this.options.placement.call(this,n[0],this.$element[0]):this.options.placement,a=/\s?auto?\s?/i,p=a.test(r);p&&(r=r.replace(a,"")||"top"),n.detach().css({top:0,left:0,display:"block"}).addClass(r).data("bs."+this.type,this),this.options.container?n.appendTo(this.options.container):n.insertAfter(this.$element);var l=this.getPosition(),h=n[0].offsetWidth,f=n[0].offsetHeight;if(p){var u=r,d=this.$element.parent(),c=this.getPosition(d);r="bottom"==r&&l.top+l.height+f-c.scroll>c.height?"top":"top"==r&&l.top-c.scroll-f<0?"bottom":"right"==r&&l.right+h>c.width?"left":"left"==r&&l.left-h<c.left?"right":r,n.removeClass(u).addClass(r)}var g=this.getCalculatedOffset(r,l,h,f);this.applyPlacement(g,r);var y=function(){o.$element.trigger("shown.bs."+o.type),o.hoverState=null};t.support.transition&&this.$tip.hasClass("fade")?n.one("bsTransitionEnd",y).emulateTransitionEnd(150):y()}},i.prototype.applyPlacement=function(e,i){var o=this.tip(),n=o[0].offsetWidth,s=o[0].offsetHeight,r=parseInt(o.css("margin-top"),10),a=parseInt(o.css("margin-left"),10);isNaN(r)&&(r=0),isNaN(a)&&(a=0),e.top=e.top+r,e.left=e.left+a,t.offset.setOffset(o[0],t.extend({using:function(t){o.css({top:Math.round(t.top),left:Math.round(t.left)})}},e),0),o.addClass("in");var p=o[0].offsetWidth,l=o[0].offsetHeight;"top"==i&&l!=s&&(e.top=e.top+s-l);var h=this.getViewportAdjustedDelta(i,e,p,l);h.left?e.left+=h.left:e.top+=h.top;var f=h.left?2*h.left-n+p:2*h.top-s+l,u=h.left?"left":"top",d=h.left?"offsetWidth":"offsetHeight";o.offset(e),this.replaceArrow(f,o[0][d],u)},i.prototype.replaceArrow=function(t,e,i){this.arrow().css(i,t?50*(1-t/e)+"%":"")},i.prototype.setContent=function(){var t=this.tip(),e=this.getTitle();t.find(".tooltip-inner")[this.options.html?"html":"text"](e),t.removeClass("fade in top bottom left right")},i.prototype.hide=function(){function e(){"in"!=i.hoverState&&o.detach(),i.$element.trigger("hidden.bs."+i.type)}var i=this,o=this.tip(),n=t.Event("hide.bs."+this.type);return this.$element.removeAttr("aria-describedby"),this.$element.trigger(n),n.isDefaultPrevented()?void 0:(o.removeClass("in"),t.support.transition&&this.$tip.hasClass("fade")?o.one("bsTransitionEnd",e).emulateTransitionEnd(150):e(),this.hoverState=null,this)},i.prototype.fixTitle=function(){var t=this.$element;(t.attr("title")||"string"!=typeof t.attr("data-original-title"))&&t.attr("data-original-title",t.attr("title")||"").attr("title","")},i.prototype.hasContent=function(){return this.getTitle()},i.prototype.getPosition=function(e){e=e||this.$element;var i=e[0],o="BODY"==i.tagName;return t.extend({},"function"==typeof i.getBoundingClientRect?i.getBoundingClientRect():null,{scroll:o?document.documentElement.scrollTop||document.body.scrollTop:e.scrollTop(),width:o?t(window).width():e.outerWidth(),height:o?t(window).height():e.outerHeight()},o?{top:0,left:0}:e.offset())},i.prototype.getCalculatedOffset=function(t,e,i,o){return"bottom"==t?{top:e.top+e.height,left:e.left+e.width/2-i/2}:"top"==t?{top:e.top-o,left:e.left+e.width/2-i/2}:"left"==t?{top:e.top+e.height/2-o/2,left:e.left-i}:{top:e.top+e.height/2-o/2,left:e.left+e.width}},i.prototype.getViewportAdjustedDelta=function(t,e,i,o){var n={top:0,left:0};if(!this.$viewport)return n;var s=this.options.viewport&&this.options.viewport.padding||0,r=this.getPosition(this.$viewport);if(/right|left/.test(t)){var a=e.top-s-r.scroll,p=e.top+s-r.scroll+o;a<r.top?n.top=r.top-a:p>r.top+r.height&&(n.top=r.top+r.height-p)}else{var l=e.left-s,h=e.left+s+i;l<r.left?n.left=r.left-l:h>r.width&&(n.left=r.left+r.width-h)}return n},i.prototype.getTitle=function(){var t,e=this.$element,i=this.options;return t=e.attr("data-original-title")||("function"==typeof i.title?i.title.call(e[0]):i.title)},i.prototype.getUID=function(t){do t+=~~(1e6*Math.random());while(document.getElementById(t));return t},i.prototype.tip=function(){return this.$tip=this.$tip||t(this.options.template)},i.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},i.prototype.validate=function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},i.prototype.enable=function(){this.enabled=!0},i.prototype.disable=function(){this.enabled=!1},i.prototype.toggleEnabled=function(){this.enabled=!this.enabled},i.prototype.toggle=function(e){var i=this;e&&(i=t(e.currentTarget).data("bs."+this.type),i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i))),i.tip().hasClass("in")?i.leave(i):i.enter(i)},i.prototype.destroy=function(){clearTimeout(this.timeout),this.hide().$element.off("."+this.type).removeData("bs."+this.type)};var o=t.fn.tooltip;t.fn.tooltip=e,t.fn.tooltip.Constructor=i,t.fn.tooltip.noConflict=function(){return t.fn.tooltip=o,this}}(jQuery),+function(t){"use strict";function e(){var t=document.createElement("bootstrap"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in e)if(void 0!==t.style[i])return{end:e[i]};return!1}t.fn.emulateTransitionEnd=function(e){var i=!1,o=this;t(this).one("bsTransitionEnd",function(){i=!0});var n=function(){i||t(o).trigger(t.support.transition.end)};return setTimeout(n,e),this},t(function(){t.support.transition=e(),t.support.transition&&(t.event.special.bsTransitionEnd={bindType:t.support.transition.end,delegateType:t.support.transition.end,handle:function(e){return t(e.target).is(this)?e.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery);

/**
 *  FitVids 1.1 - https://github.com/davatron5000/FitVids.js
 */
(function($){$.fn.fitVids=function(options){var settings={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var head=document.head||document.getElementsByTagName("head")[0];var css=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var div=document.createElement("div");div.innerHTML='<p>x</p><style id="fit-vids-style">'+css+"</style>";head.appendChild(div.childNodes[1])}if(options)$.extend(settings,options);return this.each(function(){var selectors=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(settings.customSelector)selectors.push(settings.customSelector);var ignoreList=".fitvidsignore";if(settings.ignore)ignoreList=ignoreList+", "+settings.ignore;var $allVideos=$(this).find(selectors.join(","));$allVideos=$allVideos.not("object object");$allVideos=$allVideos.not(ignoreList);$allVideos.each(function(){var $this=$(this);if($this.parents(ignoreList).length>0)return;if(this.tagName.toLowerCase()==="embed"&&$this.parent("object").length||$this.parent(".fluid-width-video-wrapper").length)return;if(!$this.css("height")&&!$this.css("width")&&(isNaN($this.attr("height"))||isNaN($this.attr("width")))){$this.attr("height",9);$this.attr("width",16)}var height=this.tagName.toLowerCase()==="object"||$this.attr("height")&&!isNaN(parseInt($this.attr("height"),10))?parseInt($this.attr("height"),10):$this.height(),width=!isNaN(parseInt($this.attr("width"),10))?parseInt($this.attr("width"),10):$this.width(),aspectRatio=height/width;if(!$this.attr("id")){var videoID="fitvid"+Math.floor(Math.random()*999999);$this.attr("id",videoID)}$this.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",aspectRatio*100+"%");$this.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);


/*! http://mths.be/placeholder v2.0.7 by @mathias */
(function(q,f,d){function r(b){var a={},c=/^jQuery\d+$/;d.each(b.attributes,function(b,d){d.specified&&!c.test(d.name)&&(a[d.name]=d.value)});return a}function g(b,a){var c=d(this);if(this.value==c.attr("placeholder")&&c.hasClass("placeholder"))if(c.data("placeholder-password")){c=c.hide().next().show().attr("id",c.removeAttr("id").data("placeholder-id"));if(!0===b)return c[0].value=a;c.focus()}else this.value="",c.removeClass("placeholder"),this==m()&&this.select()}function k(){var b,a=d(this),c=this.id;if(""==this.value){if("password"==this.type){if(!a.data("placeholder-textinput")){try{b=a.clone().attr({type:"text"})}catch(e){b=d("<input>").attr(d.extend(r(this),{type:"text"}))}b.removeAttr("name").data({"placeholder-password":a,"placeholder-id":c}).bind("focus.placeholder",g);a.data({"placeholder-textinput":b,"placeholder-id":c}).before(b)}a=a.removeAttr("id").hide().prev().attr("id",c).show()}a.addClass("placeholder");a[0].value=a.attr("placeholder")}else a.removeClass("placeholder")}function m(){try{return f.activeElement}catch(b){}}var h="placeholder"in f.createElement("input"),l="placeholder"in f.createElement("textarea"),e=d.fn,n=d.valHooks,p=d.propHooks;h&&l?(e=e.placeholder=function(){return this},e.input=e.textarea=!0):(e=e.placeholder=function(){this.filter((h?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":g,"blur.placeholder":k}).data("placeholder-enabled",!0).trigger("blur.placeholder");return this},e.input=h,e.textarea=l,e={get:function(b){var a=d(b),c=a.data("placeholder-password");return c?c[0].value:a.data("placeholder-enabled")&&a.hasClass("placeholder")?"":b.value},set:function(b,a){var c=d(b),e=c.data("placeholder-password");if(e)return e[0].value=a;if(!c.data("placeholder-enabled"))return b.value=a;""==a?(b.value=a,b!=m()&&k.call(b)):c.hasClass("placeholder")?g.call(b,!0,a)||(b.value=a):b.value=a;return c}},h||(n.input=e,p.value=e),l||(n.textarea=e,p.value=e),d(function(){d(f).delegate("form","submit.placeholder",function(){var b=d(".placeholder",this).each(g);setTimeout(function(){b.each(k)},10)})}),d(q).bind("beforeunload.placeholder",function(){d(".placeholder").each(function(){this.value=""})}))})(this,document,jQuery);