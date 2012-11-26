// Show details about a collection or a person
$j=jQuery.noConflict();

var p = document.location.href;
var url = document.location.href;
var ind = document.location.href.search('index.php');
var type = '';

p=p.substr(ind,p.length);
p=p.split('/');

if (p[2] == 'dataset')
{
	type = 'coll';
	var info=p[3]; // collection id
}

if (p[2] == 'pers')
{
	type='pers';
	var info=p[3]; // collection id
}

var url = url.substr(0,ind)+"application/controllers/extern/detailed_results.php?i="+info+"&type="+type;

if (type == 'coll')
{

	var defs=
	{
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
			jQuery("h3").eq(0).next().append(jQuery(json['collection'][0]));
			jQuery("h3").eq(1).next().append(jQuery(json['institution'][0]));
			jQuery("h3").eq(2).next().append(jQuery(json['collection_person'][0]));
			jQuery("h3").eq(3).next().append(jQuery(json['collection_details'][0]));
			jQuery(".accordion h3").click(function()
			{
				jQuery(this).next("div").slideToggle("slow")
				//  .siblings("div:visible").slideUp("slow");
				jQuery(this).toggleClass("active");
				jQuery(this).siblings("h3").removeClass("active");
			})
			jQuery(".accordion h3").eq(0).trigger('click');
		}
	} //end DEFS
	
	jQuery.ajax(defs);
}
else
{
	var person_opts=
	{
		url:url,
		dataType: "html",
		dataFilter: function(data, type) { return jQuery.parseJSON(data) },
		error:function (xhr, ajaxOptions, thrownError)
		{
			alert(xhr.status);
			alert(thrownError);
		},
		success: function(json, status, xhr)
		{
			jQuery("h3").eq(0).next().append(jQuery(json['person'][0]));
			jQuery("h3").eq(1).next().append(jQuery(json['person_dataset'][0]));
			jQuery(".accordion h3").click(function()
			{
				jQuery(this).next("div").slideToggle("slow")
				//  .siblings("div:visible").slideUp("slow");
				jQuery(this).toggleClass("active");
				jQuery(this).siblings("h3").removeClass("active");
			})
			jQuery(".accordion h3").eq(0).trigger('click');
		}
	} //end person_opts
	
	jQuery.ajax(person_opts);
}
