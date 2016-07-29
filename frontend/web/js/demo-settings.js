

jQuery(document).ready(function() {
	jQuery("body").append("<div class='demo-settings'></div>");
	jQuery(".demo-settings").append("<a href='#show-settings' class='demo-button'><span class='icon-text'>&#9881;</span>Тусламж</a>");
	jQuery(".demo-settings").append("<div class='demo-options'>"+
										"<div class='title'>Танд туслая</div>"+
										"<a href='#demo' rel='font-options' class='option'><img src='images/demo/image-1.png' class='demo-icon' alt='' /><span>Font Settings</span><font>Change Fonts</font></a>"+
										"<div class='option-box' rel='font-options'>"+
											"<div alt='font-options'>"+
												"<b class='sub-title'>Titles & Menu Font</b>"+
												"<a href='#' class='font-bulb active' style='font-family:\"Titillium Web\", sans-serif;'>Aa</a>"+
												"<a href='#' class='font-bulb' style='font-family:\"Fenix\", serif;'>Aa</a>"+
												"<a href='#' class='font-bulb' style='font-family:\"Karla\", sans-serif;'>Aa</a>"+
												"<a href='#' class='font-bulb' style='font-family:\"Alef\", sans-serif;'>Aa</a>"+
												"<a href='#' class='font-bulb' style='font-family:\"Cabin\", sans-serif;'>Aa</a>"+
											"</div>"+
										"</div>"+
										"<a href='#demo' rel='color-options' class='option'><img src='images/demo/image-2.png' class='demo-icon' alt='' /><span>Color Options</span><font>Color schemes</font></a>"+
										"<div class='option-box' rel='color-options'>"+
											"<div alt='color-options'>"+
												"<b class='sub-title'>Main Color Scheme</b>"+
												"<a href='#' class='color-bulb active' style='background: #5a9e25;'>&nbsp;</a>"+
												"<a href='#' class='color-bulb active' style='background: #2582bd;'>&nbsp;</a>"+
												"<a href='#' class='color-bulb ' style='background: #c03425;'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: #2c3e50;'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: #d86c0d;'>&nbsp;</a>"+
											"</div>"+
										"</div>"+
										// "<div class='option-box sequal' rel='color-options'>"+
										// 	"<div alt='link-colors'>"+
										// 		"<b class='sub-title'>Link Colors</b>"+
										// 		"<a href='#' class='color-bulb active' style='background: #2582bd;'>&nbsp;</a>"+
										// 		"<a href='#' class='color-bulb' style='background: #75c025;'>&nbsp;</a>"+
										// 		"<a href='#' class='color-bulb' style='background: #c03425;'>&nbsp;</a>"+
										// 		"<a href='#' class='color-bulb' style='background: #8725c0;'>&nbsp;</a>"+
										// 		"<a href='#' class='color-bulb' style='background: #d86c0d;'>&nbsp;</a>"+
										// 	"</div>"+
										// "</div>"+
										"<a href='#demo' rel='background' class='option'><img src='images/demo/image-3.png' class='demo-icon' alt='' /><span>Background</span><font>Backgorund textures</font></a>"+
										"<div class='option-box' rel='background'>"+
											"<div alt='background'>"+
												"<b class='sub-title'>Background Texture</b>"+
												"<a href='#' class='color-bulb active' style='background: url(images/background-texture-3.jpg);'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: url(images/background-texture-1.jpg);'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: url(images/background-texture-2.jpg);'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: url(images/background-texture-4.jpg);'>&nbsp;</a>"+
												"<a href='#' class='color-bulb' style='background: url(images/background-texture-5.jpg);'>&nbsp;</a>"+
											"</div>"+
										"</div>"+
										"<a href='#demo' rel='page-width' class='option'><img src='images/demo/image-4.png' class='demo-icon' alt='' /><span>Change Width</span><font>Boxed or Full-Width</font></a>"+
										"<div class='option-box' rel='page-width'>"+
											"<div alt='option-box'>"+
												"<b class='sub-title'>Switch Page Width</b>"+
												"<a href='#' class='option-bulb active' rel='full'>Full-Width</a>"+
												"<a href='#' class='option-bulb' rel='boxed'>Boxed-Width</a>"+
											"</div>"+
										"</div>"+
									"</div>");
	
	jQuery(".demo-settings a[href=#demo]").click(function(){
		var thiselem = jQuery(this);
		thiselem.parent().find("div[rel="+thiselem.attr("rel")+"]").toggle();
		return false;
	});
	
	jQuery(".option-box div .color-bulb").click(function(){
		var thiselem = jQuery(this);
		var newcolor = thiselem.css("background-color");
		thiselem.siblings().removeClass("active");
		thiselem.addClass("active");

		if(thiselem.parent().attr("alt") == "color-options"){
			jQuery(".header, .breaking-news .the-title, .widget > h3, .button, .hover-effect, .block-title, #wp-calendar td#today, .small-button, #writecomment p input[type=submit]").css("background-color", newcolor);
			jQuery(".widget .meta a").css("color", newcolor);
		}

		return false;
	});
	
	jQuery(".option-box div .color-bulb").click(function(){
		var thiselem = jQuery(this);
		var newcolor = thiselem.css("background");
		thiselem.siblings().removeClass("active");
		thiselem.addClass("active");

		if(thiselem.parent().attr("alt") == "background"){
			jQuery("body").css("background", newcolor);
		}

		return false;
	});
	
	jQuery(".option-box div .font-bulb").click(function(){
		var thiselem = jQuery(this);
		var newfont = thiselem.css("font-family");
		thiselem.siblings().removeClass("active");
		thiselem.addClass("active");

		if(thiselem.parent().attr("alt") == "font-options"){
			jQuery(".main-menu .the-menu li a, .secondary-menu ul li a, .list-title, h1, h2, h3, h4, h5, h6").css("font-family", newfont);
		}

		return false;
	});
	
	jQuery(".option-box div .option-bulb").click(function(){
		var thiselem = jQuery(this);
		var newsize = thiselem.attr("rel");
		thiselem.siblings().removeClass("active");
		thiselem.addClass("active");

		if(thiselem.parent().attr("alt") == "option-box"){
			if(newsize == "boxed"){
				jQuery(".boxed").addClass("active");
			}else
			if(newsize == "full"){
				jQuery(".boxed").removeClass("active");
			}
		}

		return false;
	});
	
	jQuery(".demo-settings").mouseleave(function(){
		var thiselem = jQuery(this);
		thiselem.removeClass("active");
		return false;
	});
	
	jQuery(".demo-settings .demo-button").click(function(){
		jQuery(".demo-settings").addClass("active");
		return false;
	});
});

