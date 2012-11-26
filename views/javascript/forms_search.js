/*
setTimeout(
function(){
document.getElementById("advanced_search" ).reset();
},
5
);
*/
var $ = jQuery.noConflict();
$(document).ready(function()
{
/*$("#dateofmodif,#dateofcreation").datepicker({
	changeMonth: true,
	changeYear: true
	})
*/
})

function collect_params()
{
var to_php='';
jQuery('.box input').each(function()
{
var value=jQuery(this).attr('value');
if (value !='')
{
var input=this;
////console.warn(this)
to_php+=jQuery(this).attr('name')+'='+value+'&';
}
})

jQuery('.box select').each(function()
{
var value=jQuery(this).find('option:selected').attr('value');
if (value !='null')
{
var input=this;
//console.warn(this)
to_php+=jQuery(this).attr('name')+'='+value+'&';
}
})

to_php=to_php.substr(0,to_php.length-1);
return to_php;
}

function do_it()
{

//e.preventDefault();
// $('form').get(0).setAttribute('action', 'baz');
jQuery('.green').attr('href','index.php?page_id=798&d=advanced_results&'+collect_params());

////console.log($('.green').attr('href'));

//$('.green').trigger('click')		
//event.preventDefault();
}




/*			  
var defs={
		"bProcessing": true,
		"bServerSide": true,
		"iDisplayLength": 5,
		"sPaginationType": "full_numbers",	
			"sAjaxSource": "http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/server_advanced.php?"+to_php ,
							"fnServerData": function( sUrl, aoData, fnCallback ) 
							{
				jQuery.ajax( {
									"url": sUrl,
									"data": aoData,
									"success":function(json) 
									{				
							//console.warn(json)
									}
				})
							}
			};

			
jQuery('#example').dataTable(defs);
*/
