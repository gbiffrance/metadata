
var $ = jQuery.noConflict();


var check_inputs=function (context,select,fx)
{
jQuery(context).find('input[type!="radio"]').trigger('blur');
check_selects(select)
var person_error=jQuery('.alert, .error,.select_alert',context)


if (person_error.length>0)
{
jQuery(person_error).animate(
 {backgroundColor: "#DD90AC",
	color: "black"
  }, 1000 );
  return false;
}
else
{
fx()

}


}
function check_selects (domid)
	{
	//alert(domid)
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

/*
	function add_person (i)
	{
	//if (jQuery('#person_added fieldset').size()==0)
	//	jQuery("#personnes span").not(':first').animate({width:"120px"}, "slow")
	
	jQuery("#person_added ul").append("<li id=person_"+i+"><a href='#' class='remove'><img style='float: left;padding-right: 20px' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/close.png' width='12' height='12' alt='close content' title='change input' /></a><a href='#' class='change'> <img  style='float: left;' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/modify.png' width='12 height='12 alt='add content' title='change input' /></a> <span class='form3'> "+jQuery("#personnes2 #person_nom").val()+"</span></li>")
		
		var new_person_fieldset="#fieldset_person_"+i;
		
		jQuery('#personnes2').clone().hide().appendTo('#person_added ul').attr('id',"fieldset_person_"+i).css({'background-color':'#A89E9E','z-index': 2000});
		jQuery('#personnes2 input').removeClass('person_form').addClass('person_form2')
		//attach events to fields
		update_dom(new_person_fieldset)
		
		var $new_person_fieldset=jQuery(new_person_fieldset);
		$new_person_fieldset.find('#person_added').remove();
		$new_person_fieldset.find('#preferredformofname_div').attr('id','preferredformofname_div_'+i);
		//$new_person_fieldset.find('input').removeClass('person')

	    var radio_index=jQuery("#personnes2 #preferredformofname_div").find('input:radio:checked').index();
	    console.info('radio index'+radio_index)
		jQuery(new_person_fieldset+" #preferredformofname_div_"+i).get(radio_index).setAttribute('checked', 'checked');
		jQuery("#personnes2 input[type='radio']").get(0).setAttribute('checked', 'checked');
		
	    // Selected options on cloning Select are not automatically checked 
	    
	    
		var role_index=jQuery('#personnes2 option:selected').index();
		
		//console.warn(jQuery(new_person_fieldset+" select option"))
		jQuery(new_person_fieldset+" select option").get(role_index).setAttribute('selected', 'selected');
		
	//	jQuery('#person_added span.form').removeClass('form').addClass('form2')
	//	jQuery('#person_added span.text').remove();

		jQuery("#personnes2 input[type!='radio']").each(function()
		{
		console.warn(jQuery(this))
		jQuery(this).val('');
		})
		
	//	jQuery("input[type!=submit],select","#o_personnes").val('')

		
		jQuery(new_person_fieldset).append("<input type='submit' class='update_person' value='Update personne' style='margin-left: 50px;margin-right: 20px;background:#655870'/></input><input type='submit' id='remove_person' style='background:#655870' value='Remove personne'></input>")
		jQuery(new_person_fieldset).addClass('new_person');
		jQuery('#fieldset_person_'+i+' input[type="submit"]').button();

				i++;
	}

*/
positioning=function (elem,parent,my,at,offset ) {		
    elem.position({
	of: parent,
	
	//my:  Defines which position on the element being positioned to align with the target element: "horizontal vertical" alignment. A single value such as "right" will default to "right center",top" will default to "center top"
	my: my,
	at: at,
	offset: offset
	//using: "flit"
//	collision: jQuery( "#collision_horizontal" ).val() + ' ' + jQuery( "#collision_vertical" ).val()
	});
	}
function add_close_icon(remove_button_class,text)
{
return "<div style='padding-bottom: 5px;padding-right: 20px'><a href='#' class='"+remove_button_class+"'><img style='float: left;padding-right: 20px' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/close.png' width='12' height='12' alt='close content' title='change input' /></a>"+text+"</div>"
}

function check_not_duplicated (text,array,$news_mots,remove_button_class)
{
if (jQuery.inArray(text,array)==-1) 
		{		
		$news_mots.append(add_close_icon (remove_button_class,text));			
		//add_close_icon (remove_button_class,text);			
		array.push(text);
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

function check_empty (my_id,my_value,fieldset_id)
{
var $my_div=jQuery('#'+my_id);
//var $my_alert=jQuery('.'+my_id);
if (my_value=='')
{
if ($my_div[0].tagName=='TEXTAREA')
{
$my_div.addClass('select_alert')//.parent().addClass('select_alert');

}
else
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
}
}
else //my_value different than ''
{
if ($my_div[0].tagName=='TEXTAREA') 
$my_div.removeClass('select_alert')//.parent().addClass('select_alert');
else {
     if ($my_div.next().hasClass('error')) $my_div.next().remove()
	 }
} 
}


function check_mail (this_id,my_value,fieldset_id)
{

var $this_fieldset=jQuery('#'+fieldset_id);

var error="<div class='"+this_id+" alert' style='display:inline;padding-left: 30px;'>  This is not a valid mail!</div>";

var $my_error=$this_fieldset.find('.'+this_id);

var $my_target=$this_fieldset.find('#'+this_id);
console.info($my_target);

if ($my_error.length>0) $my_error.remove()

if (!IsValidEmail(my_value))  //NOT VALID MAIL
{
$my_target.after(error);
}

}

var check_number=function (this_id,my_value,fieldset_id)
{
var $this_fieldset=jQuery('#'+fieldset_id)

var $my_target=$this_fieldset.find('#'+this_id);

var not_empty=$my_target.hasClass('not_empty');


error="<span class='"+this_id+" error' style='display:inline;padding-left: 30px;'>  Not a number!</span>";

var $my_error=$this_fieldset.find('.'+this_id);

if ($my_error.length>0) $my_error.remove()

if (isNaN(my_value)) 
{
$my_target.after(error);
}

}

	var $ = jQuery.noConflict();



function update_dom(context)
{

jQuery("select,radio,input[type!='submit'],textarea",context).each(function()
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
						
}	
		
jQuery(document).ready(function()
{	



update_dom('body');
jQuery('.person_fieldset').hide();

jQuery('input[type="submit"]').button();

//jQuery('input[type="submit"]').button();


jQuery('.update_person').live('click',function(event)
	{
event.preventDefault()

	if (jQuery(this).parent()[0].tagName=='FIELDSET')
	$this_fieldset=jQuery(this).parent();
	else
	if (jQuery(this).parent().parent()[0].tagName=='FIELDSET')
	$this_fieldset=jQuery(this).parent().parent();
	else
	if (jQuery(this).parent().parent().parent()[0].tagName=='FIELDSET')
	$this_fieldset=jQuery(this).parent().parent().parent();
	
	var parent_id=$this_fieldset.attr('id');
	
	var $this=jQuery(this);
	var fx=function()
	{
	var p=parent_id.substr(9,parent_id.length);
	var person="#"+p;
	jQuery(person).find('span').html($this.parent().find('#person_prenom').val())
	jQuery('#fieldset_'+p).fadeOut('slow');
	jQuery("input,textarea,select","#step0").setReadOnly(false);	
	jQuery('#step0 .ui-button').button("enable");
	}
	var select='#'+parent_id+' #roles';
	check_inputs('#'+parent_id,select,fx);

	})


jQuery("#personnes2").hide();

jQuery('#add_person').bind('click',function(event)
{
event.preventDefault();
jQuery("#personnes2").show();
jQuery('#step0').scrollTop(0) 
jQuery('#step0').animate({scrollTop:jQuery('#personnes2').position().top},1200) 
jQuery('#add_person').hide();
//jQuery('#add_person2,#remove_person2').show();

})



jQuery('#add_person2').live('click',function(event)
{
//function to develop if no error in formulaire
var fx=function()
{
var people=jQuery('#person_added li').length;
if (people!=0)
var people=people-1;
else
var people=0;
add_person(people);
jQuery('#personnes2').fadeOut();
jQuery('#add_person').show()
}
check_inputs('#personnes2','#personnes2 #roles',fx);

event.preventDefault()

})

	jQuery('input[type!="submit"][type!="radio"][type!="button"],textarea').live('blur',function(event)
	{
	
	var alert_class=jQuery(this).data('alert_class');
	var not_empty=jQuery(this).data('not_empty');
	
	var this_id=jQuery(this).attr('id');
console.info(jQuery(this).parent())
if (jQuery(this).parent()[0].tagName=='FIELDSET')
$this_fieldset=jQuery(this).parent();
else
{
if (jQuery(this).parent().parent()[0].tagName=='FIELDSET')
$this_fieldset=jQuery(this).parent().parent();
else
if (jQuery(this).parent().parent().parent()[0].tagName=='FIELDSET')
$this_fieldset=jQuery(this).parent().parent().parent();
}
console.warn($this_fieldset)
var fieldset_id=$this_fieldset.attr('id');
var my_value=jQuery(this).val();

	if (my_value!=='')
	{
	if (jQuery(this).data('number')) 
	{
	check_number(this_id,my_value,fieldset_id)
	}
	else if (jQuery(this).data('mail')) 
	{ 
	check_mail(this_id,my_value,fieldset_id)
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
	var $my_error=$this_fieldset.find('.'+alert_class);
		if ($my_error.length>0) $my_error.remove();
		
		var alert="<div class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</div>";
		jQuery(this).after(alert);

		
	} 
	}
	else
	{
	var $my_error=$this_fieldset.find('.'+alert_class);
	if ($my_error.length>0) $my_error.remove();
	}
	}  //end alert_class (obligatoire)
	
	})
//jQuery('#personnes2').hide();
jQuery("#tabs").tabs({

        show: function(event, ui) {

            var lastOpenedPanel = jQuery(this).data("lastOpenedPanel");

            if (!jQuery(this).data("topPositionTab")) {
                jQuery(this).data("topPositionTab", jQuery(ui.panel).position().top)
            }         

            //Dont use the builtin fx effects. This will fade in/out both tabs, we dont want that
            //Fadein the new tab yourself            
            jQuery(ui.panel).hide().fadeIn(800);

            if (lastOpenedPanel) {

                // 1. Show the previous opened tab by removing the jQuery UI class
                // 2. Make the tab temporary position:absolute so the two tabs will overlap
                // 3. Set topposition so they will overlap if you go from tab 1 to tab 0
                // 4. Remove position:absolute after animation
                lastOpenedPanel
                    .toggleClass("ui-tabs-hide")
                    .css("position", "absolute")
                    .css("top", jQuery(this).data("topPositionTab") + "px")
                    .fadeOut(800, function() {
                        jQuery(this)
                        .css("position", "");
                    });

            }

            //Saving the last tab has been opened
            jQuery(this).data("lastOpenedPanel", jQuery(ui.panel));

        }

    },
    {
    click: function(){alert('sdffds')}
    });
   
 
jQuery(".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *") 
	.removeClass("ui-corner-all ui-corner-top") 
	.addClass("ui-corner-bottom"); 

jQuery('#person_added fieldset').hide();

var people=jQuery('#person_added li').size();
jQuery("#person_added li a").live('click',function(event)
	{	
	var this_id=jQuery(this).parent().attr('id');
	var $change_fieldset=jQuery('#fieldset_'+this_id);
			
	if (jQuery(this).hasClass('change'))
	{

	jQuery('#person_added fieldset:visible').hide()

		//jQuery(change_fieldset).addClass('new_person');
		
		$change_fieldset.find('input').each(function()
		{
		var my_id=jQuery(this).attr('id');
		jQuery(this).data('not_empty',true);
		jQuery(this).data('alert_class',my_id);
		})
	
		
		$change_fieldset.find('input[type="submit"]').button();
	
	$change_fieldset.fadeIn().css('background','none repeat scroll 0pt 0pt rgb(211, 209, 209)');
	$change_fieldset.css('width','584px')

 //  positioning ($change_fieldset,jQuery("#step0"),"left center","left center","150 20");
   jQuery('#step0').scrollTop(0) 
   jQuery('#step0').animate({scrollTop:jQuery('#personnes').position().top+jQuery('#person_added li:last').position().top},1200) 
jQuery('#step0 .ui-button').button("disable");
jQuery('#person_added .ui-button').button("enable");
	//jQuery(change_fieldset).find("input[id='add_person']").hide()	
	jQuery('#step0').find('input,textarea,radio').setReadOnly(true);
	$change_fieldset.find('input,textarea,radio').setReadOnly(false);
	$change_fieldset.find('select').attr('disabled',false);
	}
	else
	{
	//var fieldset="#fieldset_"+jQuery(this).parent().attr('id');

	jQuery(this).parent().fadeOut('slow').remove();
	$change_fieldset.remove();  	
	people--;
	jQuery("input,textarea,select","#step0").setReadOnly(false);

	}
	
	
	return false; 
	
	})
	
	jQuery('#remove_person2').bind('click',function(e)
	{
	jQuery('#personnes2 input:text').val('');
	jQuery('.error,.alert','#personnes2').remove();
	jQuery('#personnes2').fadeOut('slow');
	jQuery('#add_person').show()
	e.preventDefault();
	})
	
	jQuery('#remove_person').live('click',function()
	{
	//var remove_id=jQuery(this).parent().parent().attr('id');

	//fieldset_person_x
	var remove_id=jQuery(this).parent().attr('id')
	jQuery(remove_id).find('.alert')
	//removing fieldset from fieldset_person_x
	remove_id2=remove_id.substr(9,remove_id.length)

	jQuery("#"+remove_id2).remove();


	jQuery("#person_added fieldset:visible").fadeOut('slow').remove();
 	
 	//jQuery("input[type!=submit],select","#personnes,#o_personnes").val('')
 
	//jQuery("#personnes .person").setReadOnly(false);
	//jQuery('#roles,#personnes radio').attr('disabled',false)

		
	jQuery('#add_person,#person_added li').show()
	people--;
	jQuery("input,textarea,select","#step0").setReadOnly(false);
	})
	
	
	
var commons=jQuery('#news_commons div').map(function()
{
return jQuery(this).text()
}).get()

var taxons=jQuery('#news_taxons div').map(function()
{
return jQuery(this).text()
}).get()
console.info(commons)

//var commons=jQuery('.news_commons div').text();
//var objects=[];
var objects=jQuery('#news_objects div').map(function()
{
return jQuery(this).text()
}).get()

var types=[];

jQuery(".remove_taxa").live('click',function()
	{
	taxons.splice(jQuery.inArray(jQuery(this).text(),taxons),1);
	jQuery(this).parent().remove();
	return false;
	})
jQuery(".remove_common").live('click',function()
		{
		commons.splice(jQuery.inArray(jQuery(this).text(),commons),1);
		jQuery(this).parent().remove();
		return false;
		})
jQuery(".remove_object").live('click',function()
	{
	objects.splice(jQuery.inArray(jQuery(this).text(),objects),1);
	jQuery(this).parent().remove();
	return false;
	})

var f;


var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

	jQuery(".mots").keyup(function()
       {
	var type=jQuery(this).attr('id');
	var keyup=jQuery(this).val();
	var $input=jQuery("#"+type);

       delay(function(){
       var input="#"+type;
       	switch (type)
       	{
       	case 'taxon':
       				
       				
       				 var $coverage=jQuery('#TaxonCoverage');
       				 var $ajouter_button=jQuery('#taxon_cols');
       				 var remove_button_class='remove_taxa';		
       				
       				 var url='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/completion/taxoncov2.php?foo='+keyup;
       				 var to_add="#TaxonCoverage option:selected";
       				 var $selects=jQuery("#TaxonCoverage option");
       				 var $news_mots=jQuery('#news_taxons');
       				 var array=taxons;
       				 
       				 $news_mots.hide();
       				  exec_mot();	
     
       				 break;
     
       	case 'common_names':
       	
       	
       			 var $coverage=jQuery('#CommonCoverage');
       			 var $ajouter_button=jQuery('#common_cols');
       			var remove_button_class='remove_common';			
       	
       			 url='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/completion/common_names.php?foo='+keyup;
       			 var to_add="#CommonCoverage option:selected";
       			 var $selects=jQuery("#CommonCoverage option");
       			 var $news_mots=jQuery('#news_commons');
       			 var array=commons;

       			$news_mots.hide();
       			 exec_mot();				 
   
			//	positioning(jQuery("#news_commons"),jQuery("#common_names"),'left top','right bottom','-60 10')
       			 
       				  break;
       				 
          case 'object_names':
          			 var $coverage=jQuery('#ObjectCoverage');
          			 var $ajouter_button=jQuery('#objects_cols');
          			 var remove_button_class='remove_object';			
          			
          			 url='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/completion/object2.php?foo='+keyup;
          			 var to_add="#ObjectCoverage option:selected";
          			 var $selects=jQuery("#ObjectCoverage option");
          			 var $news_mots=jQuery('#news_objects');
          			 var array=objects;
          			 
          			 $news_mots.hide();
          			 exec_mot();
         
          			
          			 break;
          	       	
       	}


	function exec_mot()
		{
	    $coverage.empty().hide();
	    $ajouter_button.hide()

	    if (keyup=='')
	    {
		$news_mots.fadeIn('slow');
	    positioning($news_mots,$input,'left top','left bottom','0 10')
	    $coverage.fadeOut('slow');
	    return false;
	    }     
	    else
	    {	    
		jQuery.ajax({url:url, 
		type: 'POST',
		dataType: 'text',
		error: function ()
		{
		jQuery("#not_found").show();$ajouter_button.hide();	
		},
		success: function (info)
		{

		var d=info;		
		$coverage.append(info);
		if (jQuery("#not_found").is(':visible')) jQuery("#not_found").hide();	
	/*	jQuery("."+remove_button_class).live('click',function()
			{
			array.splice(jQuery.inArray(jQuery(this).text(),array),1);
			jQuery(this).parent().remove();
			return false;
			})
			*/
		$coverage.append(info);	//.show();
		$selects.length==0?$coverage.hide():$coverage.show();

		$news_mots.fadeIn();
		positioning($news_mots,$input,'left top','left bottom','0 10')		

		$ajouter_button.fadeIn('slow')		
		$ajouter_button.click(function()
			{
			if (jQuery(to_add).length !==0)  //SOMETHING SELECTED
			{
			if (jQuery(to_add).text() !=='')  //NOT BLANCK VALUES
			{			
			check_not_duplicated (jQuery(to_add).text(),array,$news_mots,remove_button_class)				
			}
			}
			else  //NOTHING SELECTED (ADDING NEW MOTS)
			{
			check_not_duplicated ($input.val(),array,$news_mots,remove_button_class)	
			}  

				}) //ajouter_button click
			
		}
		}) //ajax
		}  //keyup !==''
	}  //end exec_mot

    
	}, 500 );  //end delay


		})  //end keyup

if (estimations_count==0)
estimations_count=0
else
estimations_count=estimations_count-1;

var estimations_count=jQuery("#estimations li").length;	
jQuery("#collection_estimation :button").click(function()
{
//jQuery("#collection_estimation span").animate({width:"200px"}, "slow")

//setTimeout('positioning (jQuery("#estimations"),jQuery("#collection_estimation input:first"),"left top","right top","10 10")',500)

jQuery("#estimations ul").append("<li id='taille_collection_"+estimations_count+"'><a href='#' class='remove'><img style='float: left;padding-right: 20px' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/close.png' width='12' height='12' alt='close content' title='change input' /></a><span class='form2'> "+jQuery("#collection_estimation input").eq(0).val()+" / "+jQuery("#collection_estimation input").eq(1).val()+"</span></li>")
estimations_count++;


})

jQuery("#estimations .remove").live('click',function()
{
jQuery(this).parent().remove();
return false;
})



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

  jQuery(".button_form2").click(function(e)
    {


jQuery('#person_added fieldset').size()
    if (!jQuery('#person_added fieldset').size()>0) //NO PERSON ADDED
    {

    if (jQuery('#personnes2').is(':visible'))
    {
    var $x=jQuery('input[type!=radio],select','#personnes2').filter(function()
    {
    if (jQuery(this).val()=='') return jQuery(this)
    })
    if ($x.size()>0)  $x.trigger('blur')
    else alert('you filled all but not confirmed person!')
    }
    else alert ('you need a person')
    }
else
{
var data='';

 if (jQuery('#person_added fieldset').size()>0)
     {
    var persons='';
    jQuery('#person_added fieldset').each(function()
    {
persons+=jQuery(this).find("input[type!='submit'][type!='radio'],select").map(function()
    {

    return jQuery(this).val();
    }).get().join(',')
console.info(jQuery(this));
console.warn(jQuery(this).find("input:radio:checked"));
    persons+=','+jQuery(this).find("input:radio:checked").val();
//FALLA PARCIALMENT
    persons+='$';
    })
    persons=persons.substring(persons.length-1,0)

    }
     data+='&persons='+persons;

 if(jQuery('#step0 fieldset').find('.alert,.error,.select_alert,.textarea_alert').size()>0)
   {
   my_html='<div id="standout" style="opacity:0.01">Some error in your fields!</br></br>Please check the marked errors in the Obligatoire tab</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
   process=false;
   }
   else
   {
   my_html='<div id="standout" style="opacity:0.01">Congratulations! we will send you soon a mail</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
   process=true;
   }

  

 if (process==true)
   {

function get_mots (div)
{
var selector='#'+div;
var d=div+'=';
d+=jQuery(selector).find("div").map(function()
   {
   
   return jQuery(this).text().replace(/\s+/gi,''); 
   
   }).get().join(',')
return d;
}
   
   e.preventDefault();

   data+='&'+jQuery('input[type!=submit],textarea,select','#step3').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step4').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step5').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step6').serialize()


data+='&collectiontype='+jQuery('#collectiontype_div input:checked').map(function()
{
return this.id;
}).get().join(',');

   var estimations='&estimations='
   jQuery("#estimations li").each(function()
       {       
       estimations+=jQuery(this).text().replace(/\s+/gi,''); 
       estimations+='$';
       })       
   estimations=estimations.substring(estimations.length-1,0)
   data+=estimations
   data+='&'+get_mots('news_types')
   data+='&'+get_mots('news_taxons')
   data+='&'+get_mots('news_objects')
   data+='&'+get_mots('news_commons')
   data+='&'+get_mots('news_preservations')
   data+='&collectionid='+jQuery('#collectionid').html();
   
   
console.warn(data)

 e.preventDefault();
 jQuery.ajax({url:'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/update_collection_pere.php',
 		data: data, 
 		type: 'POST',
 		dataType: 'text',
 		error: function (d)
 		{
 		//jQuery("#not_found").show();$ajouter_button.hide();	
 		},
 		success: function (info)
 		{
//d.preventDefault();
 }
 })
}
 
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   
   jQuery("#lights-off").prepend(my_html)
   
   
   jQuery("#lights-off").fadeTo("slow",0.9);
   jQuery("#standout").show()
   
   setTimeout('positioning(jQuery("#standout"),jQuery("#lights-off"),"center center","center center","0 0"); jQuery("#standout").fadeTo("slow",1);',1000) 
}

})
})
      