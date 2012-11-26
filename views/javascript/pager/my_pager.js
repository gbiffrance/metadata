// Show details about an institution
$j=jQuery.noConflict();

var p = document.location.href;
var url = document.location.href;
var ind = document.location.href.search('index.php');
var defs;

p=p.substr(ind,p.length);
p=p.split('/');
if (p[1])
{
	var id=p[3]; // institution id
}
url = url.substr(0,ind)+"application/controllers/extern/detailed_results.php"+"?i="+id+"&type=inst";

var num_pages;
// LISS
PageClick = function(pageclickednumber) 
{
	$j("#info ul").hide();

	$j("#info ul[id='"+pageclickednumber+"']").show();   
	$j("#pager").pager({ pagenumber: pageclickednumber, pagecount: num_pages, buttonClickCallback: PageClick });  
}


$j().ready(function() 
{
	jQuery.ajax({
		url:url,
		dataType: "html",
		dataFilter: function(data, type) { return jQuery.parseJSON(data) },
		// dataType: 'text/html', 
		error:function (xhr, ajaxOptions, thrownError)
		{
			alert(xhr.status);
			alert(thrownError);
		},
		success: function(json, status, xhr) 
		{
			num_pages=json['pages']; // //console.warn(
			// alert(num_pages)
			if (num_pages!==0)
			{
				jQuery("#pager").pager({ pagenumber: 1, pagecount: num_pages, buttonClickCallback: PageClick });
			}
			jQuery("h3").eq(0).next().append(jQuery(json['institutions'][0]));
			
			//  //console.warn(json['pages']);
			if (jQuery(json['list_collections'][0]).size()==0)
			{
				$j("h3").eq(1).replaceWith('<span class="none">Aucune collection disponible pour cette institution</span>');
			}
			else
			{
				jQuery(json['list_collections']).each(function(i,val)
				{
					jQuery("h3").eq(1).next().append(val);
				});
			}
			
			jQuery("#info li").css('margin-top','2px');
			jQuery("#info").hide();
			jQuery(".accordion ul").hide(); 
			jQuery("#pager").hide();
			
			jQuery(".accordion h3").click(function()
			{
				jQuery(this).next("div").slideToggle("slow")
				//.siblings("div:visible").slideUp("slow");
				jQuery(this).toggleClass("active");
				jQuery(this).siblings("h3").removeClass("active");
				if (jQuery(this).next("div").attr('id')!=='info')
				{
					//jQuery("#pager").hide();
					//jQuery("#pager ul").hide();
				}
				else
				{
					jQuery("#info ul").toggle()
					if ((num_pages>0))
					{
						jQuery("#pager").toggle();
						PageClick(1)
					}
				} // else
			})   //END CLICK H3
			
			jQuery(".accordion h3").eq(0).trigger('click');
			
		}  //END OF AJAX PROPERTIES LIST {   }
	})  //END AJAX
});

