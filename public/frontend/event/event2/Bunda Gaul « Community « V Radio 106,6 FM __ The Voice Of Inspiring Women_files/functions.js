$(document).ready(function(){						   
//banners
	$('#banner-slides').cycle({
		 fx:     'blindY,blindX,blindZ,cover,fade,fadeZoom,growX,growY,scrollDown,scrollLeft,turnUp,turnDown,turnLeft,turnRight,uncover,wipe,zoom,scrollRight,scrollUp',
		 randomizeEffects: true, 
		 speed:   1000,
		 timeout: 6000,
		 delay:  -2000,
		 pause: 1
	});		
	
	$('.streaming-audio').popupWindow({
		windowURL:base_url+'index.php/player/audio',
		windowName:'audio',
		centerScreen:1,
		height:260,
		width:520
	});
	
	$('.streaming-video').popupWindow({
		windowURL:base_url+'index.php/player/video',
		windowName:'video',
		centerScreen:1,
		height:670,
		width:682
	});
	
	$('#client').carouFredSel({
		auto: true,
		prev: '#prev2',
		next: '#next2',
		pagination: "#pager2"
	});
	
	$('.lightbox').divbox({caption: false, path:'/players/'});
		
	// tab-content event
	$('#mod3-mask').css({'height':$('#mod3-panel1').height()});	
	$('#mod3-panel').width(parseInt($('#mod3-mask').width() * $('#mod3-panel div').length));
	$('#mod3-panel div').width($('#mod3-mask').width());
	
	//Get all the links with rel as panel
	$('a[rel=mod3-panel]').click(function () {
		var panelheight = $($(this).attr('href')).height();
		$('a[rel=mod3-panel]').removeClass('selected');
		$(this).addClass('selected');
		
		$('#mod3-mask').animate({'height':panelheight},{queue:false, duration:500});			
		
		$('#mod3-mask').scrollTo($(this).attr('href'), 800);	
		return false;
	});
	
//lava
	$(function() {
		$('#menu-top').lavaLamp({fx: 'swing', speed:400});
	});

//back to top
	$('.back-top a').click(function(){
		var to = $(this).attr('href');		
		$.scrollTo(to, 1200);		
		return false;
	});
	
//tab
	$("ul.tab-nav a").click(function() {
		var curChildIndex = $(this).parent().prevAll().length + 1;
		$(this).parent().parent().children('.current').removeClass('current');
		$(this).parent().addClass('current');
		$(this).parent().parent().next('.tab-container').children('.current').slideUp('slow',function() {
		$(this).removeClass('current');
		$(this).parent().children('div:nth-child('+curChildIndex+')').slideDown('slow',function() {
		$(this).addClass('current');
		});
	});
	return false;								
	});
	
	/*$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				mp3:"http://www.vradiofm.com/uploads/userfiles/atm-bersama-full-version.mp3"
			});
		},
		swfPath: "js",
		supplied: "mp3",
		wmode: "window",
		smoothPlayBar: true,
		keyEnabled: true
	});*/
	
//color box
	$("a[rel='photo-gallery']").colorbox();
	$("a.colorbox").colorbox();
	$('input[title!=""], textarea[title!=""]').hint();
	$('textarea').elastic();	
	$(".pop-member").colorbox({width:"600px", inline:true, href:"#pop-member"});
	$(".call-signin").colorbox({inline:false, href:base_url+"member/callsignin"});
	$(".call-member").colorbox();
	
// accordion side bar
	$(".mod-accor h3").eq(0).addClass("active");
	$(".mod-accor .side-accor-inside").eq(0).show();

	$(".mod-accor h3").click(function(){
		$(this).next(".side-accor-inside").slideToggle("slow")
		.siblings(".side-accor-inside:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	})
	
// accordion faq
	$(".accordion02 h3").eq(0).addClass("active");
	$(".accordion02 .accor-inside").eq(0).show();

	$(".accordion02 h3").click(function(){
		$(this).next(".accor-inside").slideToggle("slow")
		.siblings(".accor-inside:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});
	
//sitemap
	$("#navigation").treeview({
		animated: "fast",
		persist: "location",
		collapsed: true,
		unique: true
	});	

// Validation	
	var validator1= $("#form-contact").validate({
		event: "blur",
		errorElement: "div",
		focusInvalid:true,	
		// Declare Rules
		rules: {
			contact_footer_name: {
				required: true,
				maxlength: 255				
			},
			contact_footer_email: {
				required: true,
				email: true,

				maxlength: 255				
			},
			contact_footer_message: {
				required: true
			},
		},
		
		// Provide Error Message
		messages: {
			contact_footer_name: {
				required: "Please enter your name",
				maxlength: "Your email must consist of at max 255 characters"
			},
			contact_footer_email: {
				required: "Please enter your email address",
				email: "Please enter a valid email address",
				maxlength: "Your email must consist of at max 255 characters"
			},
			contact_footer_message: {
				required: "Please enter your message"
			},						

		},
		
		// Error Placement Setting
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent());
			else if ( element.is(":checkbox") )
				error.appendTo ( element.parent());
			else
				error.appendTo(element.parent());
		},
		
		// Send via AJAX
		submitHandler: function(form) {
			$("#result-contact").hide();
			jQuery(form).ajaxSubmit({
				target: "#result-contact",
				clearForm:true,
				beforeSend: function () { 
					$(".loading-contact").show();
				},				
				success: function() {				
					$(".loading-contact").hide();										
					$("#result-contact").show("normal");
					$(".footer_error").hide();
					$("#result-contact").fadeTo(2000,1,function(){
						$(this).fadeOut("slow");
					});				
				}
			});
		}		
	});
	// Validation	
	var validator2= $("#form-request").validate({
		event: "blur",
		errorElement: "div",
		focusInvalid:true,	
		// Declare Rules
		rules: {
			request_artist: {
				required: true,
				maxlength: 255				
			},
			request_title: {
				required: true,
				maxlength: 255
			},
			request_msg: {
				required: true
				
			},
		},
		
		// Provide Error Message
		messages: {
			request_artist: {
				required: "Please enter your request artist",
				maxlength: "Your request artist must consist of at max 255 characters"
			},
			request_title: {
				required: "Please enter your request song",
				maxlength: "Your request song must consist of at max 255 characters"
			},
			request_msg: {
				required: "Please enter your message"
			},						

		},
		
		// Error Placement Setting
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent());
			else if ( element.is(":checkbox") )
				error.appendTo ( element.parent());
			else
				error.appendTo(element.parent());
		},
		
		// Send via AJAX
		submitHandler: function(form) {
			$("#result-request").hide();
			jQuery(form).ajaxSubmit({
				target: "#result-request",
				clearForm:true,
				beforeSend: function () { 
					$(".loading-request").show();
				},				
				success: function() {				
					$(".loading-request").hide();										
					$("#result-request").show("normal");
					$(".request_error").hide();
					$("#result-request").fadeTo(2000,1,function(){
						$(this).fadeOut("slow");
					});				
				}
			});
		}		
	});
	
});

//corner
addEvent(this, 'load', initCorners);

function initCorners() {
  var settings = {
    tl: { radius: 10 },
    tr: { radius: 10 },
    bl: { radius: 10 },
    br: { radius: 10 },
    antiAlias: true
  }
  curvyCorners(settings, "#box-streaming");
	
  var settings = {
    tl: { radius: 0 },
    tr: { radius: 0 },
    bl: { radius: 20 },
    br: { radius: 20 },
    antiAlias: true
  }
  curvyCorners(settings, "#footer2");
  
	
	// Tips
	$("#btn-contact-footer").click(function(){
		if(($("#contact-footer-name").val()!='name...') && ($("#contact-footer-email").val()!='email...') && ($("#contact-footer-message").val()!='write your message...')){
			return true;
		}else{
			return false;
		}
	});
	
		// New Rotate
	
	$('#sliderContent').cycle({
		 fx:     'fade',
		 speed:   1000,
		 timeout: 6000,
		 delay:  -2000,
		 pause: 1,

		 before: onBefore
	});
	
	function onBefore() {
		var $ht = $(this).height();
		$(this).parent().animate({height: $ht});
	}
};