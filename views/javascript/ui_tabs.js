
jQuery(document).ready(function()
{
jQuery("#tabs").tabs();

jQuery(".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *") 
	.removeClass("ui-corner-all ui-corner-top") 
	.addClass("ui-corner-bottom");

//return false;
})