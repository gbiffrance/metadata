
var $ = jQuery.noConflict();

function check_selects (domid)
	{
	alert(domid)
	var this_val=jQuery(domid+" option:selected").val();
	
	$domid=jQuery(domid);
	var this_id=domid.substr(1);	
	
	if ($domid.find("option:selected").val()=='') 
	{
	$domid.addClass('select_alert')//.parent().addClass('select_alert');
			return false;
	}
	else
	{
	if ($domid.hasClass('select_alert')) $domid.removeClass('select_alert').parent().removeClass('select_alert');
		$domid.attr('style','');
		}
	}
	
function IsValidEmail(email)

{

var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

return filter.test(email);

}

jQuery.fn.setReadOnly=function(readonly)
{
//alert(readonly)
return this.attr('readonly',readonly).css('opacity', readonly ? 0.5 : 1.0)

}

function check_empty (my_id,my_value)
{
var $my_div=jQuery('#'+my_id);
//var $my_alert=jQuery('.'+my_id);
if (my_value=='')
{
error="<span class='"+my_id+" error' style='display:none;padding-left: 30px;'>  You cannot leave it empty</span>";

if ($my_div.next().size()>0)
{
if (!$my_div.next().hasClass('error')) 
{
$my_div.next().remove()
$my_div.after(error).next().fadeIn('slow')
}
}
else
$my_div.after(error).next().fadeIn('slow')
}
else
if ($my_div.next().hasClass('error')) 
 $my_div.next().remove()
}


function check_mail (this_id,my_value)
{
var $ = jQuery.noConflict();
var $error=jQuery("<div class='"+this_id+" alert' style='display:none;padding-left: 30px;'>  This is not a valid mail!</div>");
var $my_error=jQuery('.'+this_id);

if (!IsValidEmail(my_value))
{
if ($my_error.length==0)
{
jQuery('#'+this_id).after($error);
$error.fadeIn('slow').css('display','inline');
}
}
else
{
if ($my_error.length>0) $my_error.fadeOut('slow').remove()

}
}

var check_number=function (my_id,my_value)
{
var $ = jQuery.noConflict();
var class_error,error;
var my_id_s=jQuery('#'+my_id);

var not_empty=jQuery(my_id_s).hasClass('not_empty');
if (!not_empty)
{
class_error=my_id;
}

error="<span class='"+my_id+" error' style='display:none;padding-left: 30px;'>  Not a number!</span>";

var $my_error=jQuery('.'+my_id);
if (my_value=='')
{
console.warn($my_error)
if ($my_error.length>0) my_id_s.next().fadeOut();
}
else
{
if (isNaN(my_value)) 
{
if ($my_error.length==0) my_id_s.after(error).next().fadeIn();

}
else
{
if ($my_error.length>0) $my_error.fadeOut().remove()
}
}
}

	var $ = jQuery.noConflict();



function update_dom()
{

jQuery("select,radio,input[type!='submit'],textarea").each(function()
		{
		
		var my_id=jQuery(this).attr('id');
	
		if (jQuery(this).hasClass('not_empty'))
		{
		jQuery(this).data('not_empty',true);
		jQuery(this).data('alert_class',my_id);
	
		}
		else
		{
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		if (jQuery(this).hasClass('mail')) jQuery(this).data('mail',true);
		jQuery(this).data('alert_class',my_id);
		}
		
		//ONLY NECESSARY for postal_code
	//	if (my_step=='step1') jQuery(this).data('step', 'step1');
		
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		else jQuery(this).data('number',false);
		
		if (jQuery(this).hasClass('mail')) 
		jQuery(this).data('mail',true); 
		 else		
		jQuery(this).data('mail',false); 

		
		})
jQuery("select,radio,input[type!='submit'],textarea").each(function()
		{
		
		var my_id=jQuery(this).attr('id');
		if (jQuery(this).hasClass('not_empty'))
		{
		jQuery(this).data('not_empty',true);
		jQuery(this).data('alert_class',my_id);
	
		}
		else
		{
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		if (jQuery(this).hasClass('mail')) jQuery(this).data('mail',true);
		jQuery(this).data('alert_class',my_id);
		}
		
		//ONLY NECESSARY for postal_code
	//	if (my_step=='step1') jQuery(this).data('step', 'step1');
		
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		else jQuery(this).data('number',false);
		
		if (jQuery(this).hasClass('mail')) 
		jQuery(this).data('mail',true); 
		 else		
		jQuery(this).data('mail',false); 

		
		})



	jQuery('.geo').setReadOnly(true);
	jQuery('.postal_code').setReadOnly(false);
	
jQuery("#inst_postal_code").live("blur",function(event) {
					//	console.warn("blurring postal code")
					
						    var autocomplete = jQuery(this).data("autocomplete");
							autocomplete.selectedItem=undefined;
		    
	 var matcher = new RegExp("^" + jQuery.ui.autocomplete.escapeRegex(jQuery(this).val()) + "$", "i");
		
						    var myInput = jQuery(this);

			autocomplete.widget().children(".ui-menu-item").each(function() {
						        //Check if each autocomplete item is a case-insensitive match on the input
					var item = jQuery(this).data("item.autocomplete");

					if (matcher.test(item.postalcode))
						         {
						      //   console.log("found"+item.postalcode)
						            //There was a match, lets stop checking
						            autocomplete.selectedItem = item;
						      //      console.warn(jQuery(this).val())
						            return;
						        }
						
						      
						    });

						    if (autocomplete.selectedItem) 						    
						    {

							var $target=jQuery(event.target)

							if ($target.next().hasClass('alert')) $target.next().remove()
						
							
							
						    } 
						    else  // no matching 
						    {

						    jQuery('.geo').val('');	
						   	var autocomplete=undefined;
						    }
						});
						
		
	//var $list_autcomplete=jQuery("#inst_adress")		

//console.log(jQuery("#inst_postal_code"));				
	jQuery("#inst_postal_code").autocomplete(			
			{
			autoFocus: true,
			autoSelect: true,
			search: function (event,ui)
			{
			my_val=jQuery(event.target).val();
			my_id=jQuery(event.target).attr('id');
			parent_id=jQuery(event.target).parent().attr('id');	
			parent_div_id=jQuery(event.target).parent().parent().attr('id');	
			},
					source : function( request, response ) {
						jQuery.ajax({url: 'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/postalcodes.php?term='+my_val,
							success: function(data, status, xhr)
							{ 
			json=jQuery.parseJSON(data);
			
			response( 
			jQuery.map( json, function( item ) {
			return {
				label: item.postalcode + (item.commune ? ", " + item.commune : "") + ", " + item.arrond,
				value: item.postalcode,
				postalcode: item.postalcode,
				commune: item.commune,
				region: item.region,
				departement: item.departement,
				arrond: item.arrond
			}
		}));

								}
							})
					
						},						
					minLength: 3,					
					select: function( event, ui ) 
					
					{				

var ids=jQuery(event.target).attr('id')					

//a mistery italert(ids) doesn't work for Safari....
//if (jQuery.browser.safari==true) var parent_id=jQuery(event.target).parents()[2].id

//if (safari == true)
//var parent_id=jQuery("#"+ids).parents()[2].id
//else
//var parent_id=jQuery(event.target).parent().attr('id');		
	

var $geo_childrens=jQuery(".geo");
//var parent_div='#'+parent_div_id;

//if (jQuery(event.target).data('step')=='step0') var step0=true;
//else var step0=false;

$geo_childrens.each(function(i,val)
{

var new_id;
var ids=jQuery(this).attr('id');

var $my_id=jQuery('#'+ids)
//console.warn($my_id+' in value '+i)

switch (i)
{

case 0:

        $my_id.val(ui.item.postalcode)
	//	$new_id.val(ui.item.postalcode);
		
		break;
		
case 1: $my_id.val(ui.item.region)
	//	$new_id.val(ui.item.region)

		break;
case 2: $my_id.val(ui.item.departement)
	//	$new_id.val(ui.item.departement)

		break;
case 3: $my_id.val(ui.item.arrond)
	//	$new_id.val(ui.item.arrond)
		
				break;
case 4: $my_id.val(ui.item.commune)
	//	$new_id.val(ui.item.commune)

		break;				
			
}

})


				
					}
				})
				
}				

/*
jQuery.ajax({
  url: 'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/json/testing.json',
  cache: false,
  dataType: "json",error:function (xhr){alert("some error"+xhr.status+"and "+xhr.statusText)},
  
  success:function(data)

	 {
var $ = jQuery.noConflict();
//alert(data)
	jQuery.each(data, function(entryIndex, entry) 
	{ 
	jQuery.each(entry, function(key, value) 
	{ 
	console.warn(key)
	jQuery('#'+key).val(value)
	})
	
	})
	*/
	
		jQuery("select,radio,input[type!='submit'],textarea").each(function()
		{
		
		var my_id=jQuery(this).attr('id');
		alert(my_id)
		if (jQuery(this).hasClass('not_empty'))
		{
		jQuery(this).data('not_empty',true);
		jQuery(this).data('alert_class',my_id);
	
		}
		else
		{
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		if (jQuery(this).hasClass('mail')) jQuery(this).data('mail',true);
		jQuery(this).data('alert_class',my_id);
		}
		
		//ONLY NECESSARY for postal_code
	//	if (my_step=='step1') jQuery(this).data('step', 'step1');
		
		if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
		else jQuery(this).data('number',false);
		
		if (jQuery(this).hasClass('mail')) 
		jQuery(this).data('mail',true); 
		 else		
		jQuery(this).data('mail',false); 

		
		})
	
	jQuery('input[type!="submit"][type!="radio"][type!="button"],textarea').bind('blur',function(event)
	{
	
	var alert_class=jQuery(this).data('alert_class');
	var not_empty=jQuery(this).hasClass('not_empty');
	
	var this_id=jQuery(this).attr('id');
	var my_value=jQuery(this).val();

	if (my_value!=='')
	{
	if (jQuery(this).data('number')) 
	{
	check_number(this_id,my_value)
	}
	else if (jQuery(this).data('mail')) 
	{ 
	check_mail(this_id,my_value)
	} 
	else
	{
	if (jQuery(this)[0].tagName=='TEXTAREA' && jQuery(this).hasClass('textarea_alert')) jQuery(this).removeClass('textarea_alert');
		
	if (jQuery(this).next().hasClass('alert')) jQuery(this).next().remove()		
	
	}
	}
	else  // my_value=''
	{
	if (not_empty)
	{	
	if (jQuery(this)[0].tagName=='TEXTAREA')
	{
	jQuery(this).addClass('textarea_alert');
	}
	else
	{
		if (jQuery('.'+alert_class).length==0)
		{
		var alert="<div class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</div>";
		jQuery(this).after(alert);
	
		
		}
	} 
	}
	else
	{
	if (jQuery('.'+alert_class).length>0) jQuery('.'+alert_class).remove()
	}
	
	
	
	}  //end alert_class (obligatoire)
	
	
	
	})
	
		//}

	//})
	
jQuery(document).ready(function()
{	
update_dom();


jQuery('input').bind('focusout',function()
{
if (jQuery(this).hasClass('number')) 
{
check_number(jQuery(this).attr('id'),jQuery(this).val())
}

if (jQuery(this).hasClass('mail'))
{
check_mail(jQuery(this).attr('id'),jQuery(this).val())
}

if (jQuery(this).hasClass('not_empty'))
{
check_empty(jQuery(this).attr('id'),jQuery(this).val())
}
})


var postal_code=jQuery('#inst_postal_code').val()
if (jQuery('#inst_commune').val()=='')
{
jQuery('.postal_code').autocomplete('search', postal_code)
}

jQuery('#accept2').live('click',function()
{
jQuery("#standout").fadeOut('slow').remove()
jQuery('.page-content').unwrap();
jQuery('.page-content').unwrap();
})

function show_msg (msg)
{
 my_html='<div id="standout" style="opacity:0.01;left: 250px; top: 200px;">'+msg+'</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
 
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   
   jQuery("#lights-off").prepend(my_html)
   jQuery("#lights-off").fadeTo("slow",0.9);
 
   jQuery("#standout").animate({opacity:1},'slow')
}

jQuery('.spacer').click(function()
{
jQuery('.content input').trigger('focusout')
var $errors=jQuery('.alert,.error','.content');
if ($errors.size()>0)
{
$errors.each(function()
{
console.warn(jQuery(this))
jQuery(this).animate(

 {backgroundColor: "blue",
	color: "black"
  }, 1000 );

})
}

else
{
var data=jQuery('.content input').serialize()
jQuery.ajax({url:'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/validate.php',
   		data: data, 
   		type: 'POST',
   		dataType: 'text',
   		error: function ()
   		{
   		//jQuery("#not_found").show();$ajouter_button.hide();	
  show_msg("Your passwords don't match")
   		},
   		success: function (info)
   		{
  show_msg('Congratulations, we will send you a mail soon')
  
   }
   })
}
})
})
      