// Show list of institutions, collections or persons
$j=jQuery.noConflict();

var p = document.location.href;
var ind = document.location.href.search('index.php');
var defs;

var url = p.substr(0,ind)+"application/controllers/extern/server_processing_pgsql.php"+"?info="+info;

if(info == 'colls_by_region')
{
	url = url+"&id="+id;
}

jQuery(document).ready(function($j) {

jQuery("#consult thead").empty();
jQuery("#consult tfoot").empty();

if (info=='regions') info2='régions';
else info2=info;
jQuery('.page-title').html('Liste des '+info2);


switch (info)
{
	case 'institutions':
		// so many TH as fields requested in our sql! (even if some will be hidden later, it is necessary for DataTables jquery plugin
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'></th><th width='30%' title='Résultats triés'>Institution</th><th width='30%' title='Résultats triés'>Type</th><th width='30%' title='Résultats triés'>Ville</th></tr>");
		jQuery("#consult tfoot").html("<tr><th width='0%' class='invisible'></th><th width='30%'>Institution</th><th width='30%'>Type</th><th width='30%'>Ville</th></tr>");
		break;
	
	case 'collections':
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='30%' title='Résultats triés'>Institution</th><th width='30%' title='Résultats triés'>Collection</th><th width='10%' title='Résultats triés'>Collections/Observations</th><th width='30%' title='Résultats triés'>Nature du jeu de donn&eacute;es</th></tr>");
		jQuery("#consult tfoot").empty();
		jQuery("#consult tfoot").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='30%'>Institution</th><th width='30%'>Collection</th><th width='10%' title='Résultats triés'>Collections/Observations</th><th width='30%' title='Résultats triés'>Nature du jeu de donn&eacute;es</th></tr>");
		break;
		
	case 'colls_by_region':
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='30%' title='Résultats triés'>Institution</th><th width='30%' title='Résultats triés'>Collection</th><th width='30%' title='Résultats triés'>Ville</th></tr>");
		jQuery("#consult tfoot").empty();
		jQuery("#consult tfoot").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='30%'>Collection</th><th width='30%'>Institution</th><th width='30%'>Ville</th></tr>");
		break;
	
	case 'personnes':
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='25%' title='Résultats triés'>Nom</th><th width='25%' title='Résultats triés'>Institution</th><th width='25%' title='Résultats triés'>Collection</th><th width='25%' title='Résultats triés'>Rôle</th></tr>");
		jQuery("#consult tfoot").empty();
		jQuery("#consult tfoot").html("<tr><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='0%' class='invisible'></th><th width='25%'>Nom</th><th width='25%'>Institution</th><th width='25%'>Collection</th><th width='25%'>Rôle</th></tr>");
		break;
	
	case 'regions':
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'><th width='0%' class='invisible'>Région<th width='20%' title='Résultats triés'>Nombre d'institutions</th><th width='20%' title='Résultats triés'>Nombre de collections</th></tr>");
		jQuery("#consult thead").html("<tr><th width='0%' class='invisible'><th width='0%' class='invisible'>Région<th width='20%' title='Résultats triés'>Nombre d'institutions</th><th width='20%' title='Résultats triés'>Nombre de collections</th></tr>");
		break;
} // switch

defs=
{
	"bProcessing": true,
	"bServerSide": true,
	"iDisplayLength": 10,
	"sPaginationType": "full_numbers",
	"sAjaxSource": url,
	"oSearch": {"sSearch": sword},
	"fnServerData": function( sUrl, aoData, fnCallback ) {
		jQuery.ajax( {
			"url": sUrl,
			"data": aoData,
			"success":function(json) 
			{
				jQuery(json.aaData).each(function(i,val)
				{
					if (jQuery.inArray(null,val)!==-1)
					{
						jQuery(val).each(function(i2,val2)
						{
							if (val2==null)
							{
								////console.log('present')
								val[jQuery.inArray(null,val)]='Pas d\'information';
								////console.info(jQuery.inArray(null,val))
							}
						})
					}
				})
				
				function fx(json)
				{
					fnCallback(json);
					var th_sup_target=jQuery('#consult thead th');
					var th_foot_target=jQuery('#consult tfoot th'); //hidding TH
					var hide_th=function(ths)
					{	
						  jQuery(ths).each(function(i,val)
						  {
							jQuery(json.ids_to_hide).each(function(p,val)
								{
									if (i==p)
										jQuery(ths).eq(i).hide();
								})
						  })
					}
						  
					hide_th(th_sup_target);
					hide_th(th_foot_target);
					
					// hidding TDs from TR
					jQuery('#consult tbody tr').each(function()
					{
						td_target=jQuery(this).find('td'); ////console.warn(td_target)
						jQuery(json.ids_to_hide).each(function(i,val)
						{
							var new_i=parseInt(i)+jQuery(json.ids_to_hide).size();
							jQuery(td_target).eq(i).hide();
							
							new_target=jQuery(td_target).eq(new_i);
							data=jQuery(td_target).eq(i).html();

							new_html2=null;
							switch (i)
							{
								case 0:
								//INSTITUTION
									if (data==0)
									{
										new_html="";
									}
									else
									{
										if (info=='regions')
											
											new_html="<a href='detailresultat/dataset/"+data+"'>"+jQuery(new_target).html()+"</a>";	
										else 
											new_html="<a href='detailresultat/inst/"+data+"'>"+jQuery(new_target).html()+"</a>";	
										
										if (info=='personnes')
										{
											new_html="<a href='detailresultat/pers/"+data+"'>"+jQuery(td_target).eq(3).html()+"</a>";
											////console.warn(jQuery(td_target).eq(4));
										}
									}
								break;
								
								case 1:
								// COLLECTION
									if (data==0)
									{
										new_html="Pas d'information disponible";
									}
									else
									{
										if(info=='personnes')
										{
											  new_html="<a href='detailresultat/inst/"+data+"'>"+jQuery(td_target).eq(4).html()+"</a>";
										}
										else
										{
											new_html="<a href='detailresultat/dataset/"+data+"'>"+jQuery(new_target).html()+"</a>";
										}
									}
								break;
								
								case 2:
									//VILLE or PERSONID
									////console.log(info)
									if (data==0)
										new_html="Information non disponible";	
									else
									{
										if(info=='personnes')
											new_html="<a href='detailresultat/dataset/"+data+"'>"+jQuery(td_target).eq(5).html()+"</a>";
										else
											new_html="<a href='detailresultat/inst/"+data+"'>"+jQuery(new_target).html()+"</a>";
									}
								break;
							}
							
						jQuery(new_target).html(new_html);
						
						})
						
					});
				}
				setTimeout(fx(json),2000);
			},
			
			"dataType": "jsonp",
			"cache": false
		} );
	}
}; //END DEFS

	switch (info)
	{
		case 'personnes':
			var person_opts={'aoColumnDefs': [{ 'bSearchable': false,'aTargets': [1] }] };
			jQuery('#consult').dataTable( jQuery.extend( true , defs, person_opts));
			jQuery('#consult').dataTable(defs);
			break;
		
		case 'regions':
			var region_opts={'aoColumnDefs': [{ 'bSearchable': false,'aTargets': [2] },{ 'bSearchable': false,'aTargets': [3] }] };
			jQuery('#consult').dataTable( jQuery.extend( true , defs, region_opts));
			jQuery('#consult').dataTable(defs);
			break;
			
		case 'institutions':
			jQuery('#consult').dataTable(defs);
			jQuery('#consult_filter input').val(sword).trigger($.Event("keyup", { keyCode: 13 }));
 			break;
			
		default:
			jQuery('#consult').dataTable(defs);
			break;
	} // switch info
	
	if (typeof sword != "undefined") sword = undefined;
	jQuery('.page-content').css('padding' , '10px 10px 0px 0px');
} );
