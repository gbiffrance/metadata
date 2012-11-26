
	var people=0;

var $ = jQuery.noConflict();

function IsValidEmail(email)

{

var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

return filter.test(email);

}

jQuery(document).ready(init);

	function check_selects (domid)
	{
	var this_val=jQuery(domid+" option:selected").val();
	var parent_id=jQuery(domid).data('step');	

	$domid=jQuery(domid);

	var this_id=domid.substr(1);
	
	if (parent_id=='step0')
	{ 
	new_id=this_id.substr(2);  // o_
	}
	else
	{
	new_id='o_'+this_id;
	}
	var $new_id=jQuery("#"+new_id);
	if ($domid.find("option:selected").val()=='') 
	{

	$domid.addClass('select_alert')//.parent().addClass('select_alert');
	$new_id.addClass('select_alert')//.parent().addClass('select_alert');
			return false;
	}
	else
	{
	if ($domid.hasClass('select_alert')) $domid.removeClass('select_alert').parent().removeClass('select_alert');
		$domid.attr('style','');
	$new_id.removeClass('select_alert').parent().removeClass('select_alert');
	}
	
	
	}

	function init () {
	
	/*
	function change_radio($original_div,target_div)
	{
	var radio_index=$original_div.find('input:radio:checked').index();
	console.warn(radio_index)
    console.warn(jQuery(target_div))
	jQuery(target_div).get(radio_index).setAttribute('checked', 'checked');
	
	
	}
	
	var $original_div, target_div;
	jQuery('.preferredformofname_class').click(function()
	{
	
	if (jQuery(this).attr('id')=='o_preferredformofname_div')
	{
	$original_div=jQuery("#o_preferredformofname_div")
	target_div="#preferredformofname_div"
	to_fieldset=false;
	}
	else
	{
	$original_div=jQuery("#preferredformofname_div")
	target_div="#o_preferredformofname_div";
	to_fieldset=true;
	}
	
	change_radio($original_div,target_div)
	})
	*/
	function add_person (i)
	{
	if (jQuery('#person_added fieldset').size()==0)
		jQuery("#personnes span").not(':first').animate({width:"120px"}, "slow")
	
	jQuery("#person_added ul").append("<li id=person_"+i+"><a href='#' class='remove'><img style='float: left;padding-right: 20px' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/close.png' width='12' height='12' alt='close content' title='change input' /></a><a href='#' class='change'> <img  style='float: left;' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/modify.png' width='12 height='12 alt='add content' title='change input' /></a> <span class='form3'> "+jQuery("#person_nom").val()+"</span></li>")
		
		var new_person_fieldset="#fieldset_person_"+i;
		jQuery('#personnes').clone().hide().appendTo('#person_added ul').attr('id',"fieldset_person_"+i).css({'background-color':'#A89E9E','z-index': 2000});
		
		jQuery(new_person_fieldset).find('#person_added').remove();
		jQuery(new_person_fieldset).find('#preferredformofname_div').attr('id','preferredformofname_div_'+i);
		jQuery(new_person_fieldset+" input").removeClass('person')

	    var radio_index=jQuery("#preferredformofname_div").find('input:radio:checked').index();
jQuery(new_person_fieldset+" #preferredformofname_div_"+i).get(radio_index).setAttribute('checked', 'checked');
	    // Selected options on cloning Select are not automatically checked 
	    
	    
		var role_index=jQuery('#personnes option:selected').index();
		jQuery(new_person_fieldset+" select option").get(role_index).setAttribute('selected', 'selected');
		
		jQuery('#person_added span.form').removeClass('form').addClass('form2')
		jQuery('#person_added span.text').remove();
		
		
		
		jQuery("#personnes .person").each(function()
		{
		jQuery(this).val('');
		})
		
		jQuery("input[type!=submit],select","#o_personnes").val('')
	//	jQuery("#personnes input[type='radio']").attr('checked','checked');
		
		jQuery(new_person_fieldset).append("<input type='submit' id='update_person' value='Update personne' style='margin-left: 50px;margin-right: 20px;background:#655870'/></input><input type='submit' id='remove_person' style='background:#655870' value='Remove personne'></input>")
		jQuery(new_person_fieldset).addClass('new_person');
		
		jQuery(new_person_fieldset).find('input').each(function()
		{
		jQuery(this).data('not_empty',true);
		jQuery(this).data('alert_class',my_id);
		
		//jQuery(this).check_val(jQuery(this).data('not_empty'),jQuery(this).data('number'),jQuery(this).data('mail'),my_id,"not_new_id")
		})
	
		
		jQuery('#fieldset_person_'+i+' input[type="submit"]').button();
	
			
				i++;
	}
	
	//jQuery(".geo").attr('disabled',true)
	jQuery(".postal_code").attr('disabled',false)
	
	
	if ($.browser.webkit==true)
	{
	var safari = ( $.browser.safari && /chrome/.test(navigator.userAgent.toLowerCase()) ) ? false : true;
	
	}
	
	
	
	function hide_multiselects(array_multi)
	{
	
	for (var i = array_multi.length - 1; i >= 0; i--)
	{
	jQuery('#'+array_multi[i]).toggle()

/*	if (safari==true)	
	jQuery('#'+array_multi[i]).prev().prev().toggleClass('form')
	else
	
	*/
	jQuery('#'+array_multi[i]).prev().find('span').toggleClass('form')
	}
	}
	
//	hide_multiselects(['multiselect3','multiselect2'])
	
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

	document.cookie = 'name=David' ;
	
	jQuery("select,radio,input[type!='submit'],textarea").each(function()
	{
	
	//O_MYFIELD will be allways the identifier class of alerts!
	var my_id=jQuery(this).attr('id');
	var my_step=jQuery(this).parents('div:first').attr('id');
	
	if (my_step=='step0')
	{

	var new_id='#'+my_id.substr(2);
	

	jQuery(new_id).data('not_empty',true);
	jQuery(this).data('not_empty',true);
    jQuery(this).data('alert_class',my_id);
    


	jQuery(this).data('step', 'step0');

	}
	
	
	else
	{
	if (jQuery(this).hasClass('number')) jQuery(this).data('number',true);
	if (jQuery(this).hasClass('mail')) jQuery(this).data('mail',true);
		jQuery(this).data('alert_class',my_id);
	}
	
	//ONLY NECESSARY for postal_code
	if (my_step=='step1') jQuery(this).data('step', 'step1');
	
	if (jQuery(this).hasClass('number'))
	{ jQuery(this).data('number',true); jQuery(new_id).data('number',true)
	} else { jQuery(this).data('number',false); jQuery(new_id).data('number',false) }
	
	if (jQuery(this).hasClass('mail')) 
	{
	
	jQuery(this).data('mail',true); jQuery(new_id).data('mail',true)
	} else
	{
	jQuery(this).data('mail',false); jQuery(new_id).data('mail',false)
	}
	
	})

jQuery('#accept2').live('click',function()
{
jQuery("#standout").fadeOut('slow').remove()
jQuery('.page-content').unwrap();
jQuery('.page-content').unwrap();
})


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



    jQuery(".button_form2").click(function(e)
    {

 
  //  var data=jQuery('#step3 select, #step3 input').serialize();
    var data='';
    var estimations='';

    jQuery("#estimations li").each(function()
    {
    
    estimations+=jQuery(this).text().replace(/\s+/gi,''); 
    estimations+='$';
    })
    
    data+=estimations.substring(estimations.length-1,0)
    
     if (jQuery('#person_added ul fieldset').size()>0)
     {
    var persons='';
    jQuery("#person_added li").next().each(function()
    {
    
    persons+=jQuery(this).find("input[type!='submit']").map(function()
    {
    return jQuery(this).val();
    }).get().join(',')
    persons+='$';
    })
    persons=persons.substring(persons.length-1,0)

    }
     data+='&persons='+persons;
    //apply substring
var my_errors=[]
    jQuery('#o_mother_institute_params,#o_institute_params').each(function()
    {
    
    if (jQuery(this).find('.postal_code').is(':visible'))
    {
    jQuery(this).find('input').not('.geo').each(function()
    {
    jQuery(this).trigger('blur')
    })
    

    jQuery(this).find('.postal_code').trigger('blur')
    var select=jQuery(this).find('.type').attr('id');
    check_selects('#'+select)
    
    //var role_index=jQuery('#personnes option:selected').index();
    //jQuery(new_person_fieldset+" select option").get(role_index).setAttribute('selected', 'selected');
    //alert('errors'+jQuery(this).find('.alert,.error').size())
  
    }
    else
    {
    var $first_select=jQuery(this).find('.first_select')
    if ($first_select.val()=='')
    {
    var my_error='selects'
    check_selects('#'+$first_select.attr('id'))

   // report_error('select_error')
    }

    }
    
    
    })
    
    jQuery('input,textarea','#o_collection').trigger('blur')
    if (!jQuery('#person_added ul fieldset').size()>0) 
    {
    var $x=jQuery('input[type!=radio],select','#o_personnes').filter(function()
    {
    if (jQuery(this).val()=='') return jQuery(this)
    })
    if ($x.size()>0)  $x.trigger('blur')
    else alert('you filled all but not confirmed person!')
    }
    
   if(jQuery('#step0 fieldset').find('.alert,.error,.select_alert,.textarea_alert').size()>0)
   {
   my_html='<div id="standout" style="opacity:0.01">Some error in your fields!</br></br>Please check the marked errors in the Obligatoire tab</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
   
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   jQuery('.page-content').wrap("<div id='lights-off'/>")
   
   jQuery("#lights-off").prepend(my_html)
   
   
   jQuery("#lights-off").fadeTo("slow",0.9);
   jQuery("#standout").show()
   
   setTimeout('positioning(jQuery("#standout"),jQuery("#lights-off"),"center center","center center","0 0"); jQuery("#standout").fadeTo("slow",1);',1000)  
   process=false;
   }
   else
   {

   
   e.preventDefault();
   data=''
  
  // data+=jQuery('input[type!=submit],textarea,select','#step0').not('#serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step1').serialize()
   //PERSONS SERIALIZE NOT NECESSARY
 //     data+='&'+jQuery('input[type!=submit],textarea,select','#step2').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step3').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step4').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step5').serialize()
   data+='&'+jQuery('input[type!=submit],textarea,select','#step6').serialize()
   data+='&userid='+jQuery('.userid').html();
   var persons='';
       jQuery("#person_added li").next().each(function()
       {
       
       persons+=jQuery(this).find("input[type!='submit'][type!='radio'],select").map(function()
       {
   
       return jQuery(this).val();
       }).get().join(',')
   
       persons+=','+jQuery(this).find("input:radio:checked").val();
   //FALLA PARCIALMENT
       persons+='$';
       
       })
   
       persons=persons.substring(persons.length-1,0)
      data+='&persons='+persons
      var estimations='&estimations='
       jQuery("#estimations li").each(function()
       {
       
       estimations+=jQuery(this).text().replace(/\s+/gi,''); 
       estimations+='$';
       })
       
       estimations=estimations.substring(estimations.length-1,0)
       data+=estimations
   
   
//   data+='&institute_name='+jQuery('#o_inst_nom').val();

     data+='&'+get_mots('news_types')
   data+='&'+get_mots('news_taxons')
   data+='&'+get_mots('news_objects')
   data+='&'+get_mots('news_commons')
   data+='&'+get_mots('news_preservations')
   
 	
 //	var my_html;
   jQuery.ajax({url:'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/unserialize2.php',
   		data: data, 
   		type: 'POST',
   		dataType: 'json',
   		error: function (info)
   		{
   		
   		},
   		success: function (info)
   		{
   		console.warn(info);
   		if (info)
   		{
   		if(info.error_type=='repeated collection')
   		{
   		alert(info['collectionid']);
   		alert(info.error_type);
   		  my_html='<div id="standout" style="opacity:0.01">Error: collection already entered before. Use <a href="http://lully.snv.jussieu.fr/gbif/wordpress_pere/?page_id=927&id='+info['collectionid']+'" >update collection</a> to change it</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';	
   		  
   		
   		  }
   		 }
   		  else
   		  {
     my_html='<div id="standout" style="opacity:0.01">Congratulations! we will send you soon a mail</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
     }
     
     
     jQuery('.page-content').wrap("<div id='lights-off'/>")
     jQuery('.page-content').wrap("<div id='lights-off'/>")
     
     jQuery("#lights-off").prepend(my_html)
     
     
     jQuery("#lights-off").fadeTo("slow",0.9);
     jQuery("#standout").show()
     
     setTimeout('positioning(jQuery("#standout"),jQuery("#lights-off"),"center center","center center","0 0"); jQuery("#standout").fadeTo("slow",1);',1000)  
   }
   })  //ajax end
   
   
   

 e.preventDefault();

}	
       })
    
	
	//jQuery('.multiselect2,.multiselect3').hide().prev().hide();

	
	jQuery.fn.multiselect = function() {
	
	jQuery(this).each(function() {	

	
	switch (jQuery(this).attr('class'))
	{
	case 'multiselect':
	var my_class="multiselect-on";break;
	
	case 'multiselect2':
	var my_class="multiselect2-on";break;
	
	case 'multiselect3':
	var my_class="multiselect3-on";break;
	
	case 'multiselect4':
	var my_class="multiselect4-on";break;
	
	}
	
  var checkboxes = jQuery(this).find("input:checkbox");

        checkboxes.each(function() {
            var checkbox = jQuery(this);
            // Highlight pre-selected checkboxes
            if (checkbox.attr("checked"))
                checkbox.parent().attr("class",my_class);
 
            // Highlight checkboxes that the user selects
            checkbox.change(function() {

                if (checkbox.attr("checked"))
                    checkbox.parent().attr("class",my_class);
                else
                    checkbox.parent().attr("class","");
            });

	        });  
	    });  //end checkboxes.each
	};  //end multiselect function
	var countries;
var france=false;
	jQuery('#multiselect').click(function(event,target)
	{
	
	var $target = jQuery(event.target);

    checked=$target.attr('checked');
  
	var area_code=$target.attr('value');

	//map(): Pass each element in the current matched set through a function, producing a new jQuery //object containing the return values.

if (jQuery('#multiselect input:checked').length==0)
{

jQuery('#multiselect2,#multiselect3').empty();
var array=[]

jQuery('#multiselect2,#multiselect3,#multiselect4').each(function()
{
if (jQuery(this).is(':visible'))
{
array.push(jQuery(this).attr('id'));
}


})

hide_multiselects(array)
//hide_multiselects(['multiselect2','multiselect3'])

}
else
{
	areas=jQuery('#multiselect input:checked').map(function()
	{
	return this.value
	}).get().join(',');

	//get transforma objecte a array

	$.get('http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/geo_lists.php?context=by_area&area='+areas,function(d)
	{
	//console.log(jQuery('.multiselect2 input:checked'))
	var $multiselect2=jQuery('#multiselect2');
	if ($multiselect2.is(':visible'))
	{
	countries=$multiselect2.find('input:checked');
	}
	else
	{
	jQuery('#step5 form').animate({scrollTop:jQuery(".multiselect").scrollTop()+200},900) 
	}

	$multiselect2.empty().append(d);		

	if (checked==true) 
	{
	$multiselect2.scrollTop(0) 
	
	selector=".multiselect2 label:contains('"+area_code+"')";
	
		var destination=jQuery(selector).position().top;
	

	$multiselect2.animate({scrollTop:destination}, 2000);
	}

	if (!$multiselect2.is(':visible')) hide_multiselects(['multiselect2'])
	
	if (areas.length!==0)
	{
	//hide_multiselects(['multiselect2']);
	setTimeout('jQuery("#multiselect2").multiselect();',300);
	
	if (countries)
	{	
	countries.each(function()
	{
	var d="#multiselect2 input[value='"+jQuery(this).val()+"']";

	jQuery("#multiselect2 input[value='"+jQuery(this).val()+"']").attr('checked', true);
	if (jQuery(this).val()=='France')
	france=true;
	})
	}


	var countries;
	$multiselect2.find('input').click(function(event,target)
	{
	t=jQuery(this).parent().text();	
	checked=jQuery(event.target).attr('checked');
	
	if (t=='France' && checked) 
	france=true;
	if (t=='France' && !checked)
	{
	hide_multiselects(['multiselect4']);france=false;
	}
	if (t!=='France')france=false;
	if ($multiselect2.find('input:checked').length ==0)
	{
	hide_multiselects(['multiselect3'])
	}
	else
	{
	var c=jQuery('#multiselect2 input:checked').map(function()
	{
	return this.value
	}).get().join(',');
	//get transforma objecte a array
	
	$.get('http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/geo_lists.php?context=by_country&country_abbr='+c,function(d)
	{	
	if (d=='') 
	{
	hide_multiselects(['multiselect3']);
	return false; 
	}
	var $multiselect3=jQuery('#multiselect3');
	//console.log(jQuery('.multiselect2 input:checked'))
	if ($multiselect3.is(':visible'))
	{
	countries=$multiselect3.find('input:checked');
	}
	else
	{
	hide_multiselects(['multiselect3'])
	}
//	jQuery("#mots_cle .form:last").css('padding-bottom','190px')
	
		$multiselect3.empty().append(d)		
		//jQuery("#mots_cle .form:last").css('padding-bottom','280px')

	setTimeout('jQuery("#multiselect3").multiselect();',200);

//    console.warn(".multiselect3 label:contains('"+t+"')")
    var selector="#multiselect3 label:contains('"+t+"')";
    if (jQuery(selector).length>0)
    {
    $multiselect3.scrollTop(0)
    jQuery('#step5 form').animate({scrollTop:jQuery(".multiselect").scrollTop()+200},900)
    var destination=jQuery(selector).position().top    

    $multiselect3.animate({scrollTop:destination}, 2000);
    }

  
	if (countries)
	{
	jQuery(countries).each(function()
	{
	jQuery("#multiselect3 input[value='"+jQuery(this).val()+"']").attr('checked', true);
	})
	
	}  //end if countries
	
	
	jQuery('#multiselect3 input').click(function()
		{
		var $multiselect=jQuery("#multiselect3");
		t=jQuery(this).parent().text();		
	//	alert(jQuery(this).attr('name'))
		if (jQuery(this).attr('name')=='FRA') france=true;
		
		if ($multiselect3.find('input:checked').length ==0)
		{
		hide_multiselects(['multiselect4'])
		}
		else
		{
	//alert(france)
	//console.warn("FRANCE is "+france)
		if (france==false)
		{
	
		return;
		}
		else
		{
	
		var c=$multiselect3.find('input:checked').map(function()
		{
		if (this.name=='FRA')
		return this.value
		}).get().join(',');
		//get transforma objecte a array
	
		$.get('http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/geo_lists.php?context=by_france&fr_region='+c,function(d)
		{	
		if (d=='') 
		{
		hide_multiselects(['multiselect4']);
		return false; 
		}
	    var $multiselect4=jQuery('#multiselect4');
		
		if ($multiselect4.is(':visible'))
		{
		var departements=$multiselect4.find('input:checked');
	//	console.log($multiselect4.find('input:checked'))
		}
		else
		{
		hide_multiselects(['multiselect4'])
		}
		
			$multiselect4.empty().append(d)		
			//jQuery("#mots_cle .form:last").css('padding-bottom','280px')
	
		setTimeout('jQuery("#multiselect4").multiselect();',200);
	
	 //   console.warn(".multiselect4 label:contains('"+t+"')")
	    var selector="#multiselect4 label:contains('"+t+"')";
	    if (jQuery(selector).length>0)
	    {
	    $multiselect4.scrollTop(0)
	    jQuery('#step5 form').animate({scrollTop:jQuery(".multiselect").scrollTop()+300},1200)
	    var destination=jQuery(selector).position().top    

	    $multiselect4.animate({scrollTop:destination}, 2000);
	    }
	
	  
		if (departements)
		{
	
		jQuery(departements).each(function()
		{
		$multiselect4.find("input[value='"+jQuery(this).val()+"']").attr('checked', true);
		})
		
		}  //end if countries
	
	
	})  //end get 
		
		france=false;
		}
		
		}
	
		})


})  //end get 

	

	}

	
})  //end multiselect2 input click

}
})
}
})
	
	
	
	
	jQuery("#multiselect").multiselect();
	jQuery("#multiselect2,#multiselect3,#multiselect4").hide();
	

	
jQuery("a[href=#step2]").click(function()
{
if (jQuery('#person_added fieldset').length>0)
{
setTimeout('positioning(jQuery("#personnes .alert3"),jQuery("#personnes"),"center top","center top","10 0")',100)

}
})	
	
	jQuery("#o_personnes input:submit").click(function(e)
	{
  
    jQuery('#o_personnes input[type!="radio"]').trigger('blur');

	check_selects("#o_roles");
	var person_error=jQuery('.alert, .error,.select_alert', '#o_personnes')
	if (person_error.length>0)
	{
	jQuery(person_error).animate(
	
	 {backgroundColor: "#DD90AC",
		color: "black"
	  }, 1000 );
	
	}
	else
	{
add_person(people);
jQuery('#o_personnes input[type!=submit]').val('')
people++;
if (jQuery('#person_added fieldset').length==1)
{
jQuery("#personnes").append("<div class='alert3' style='width:450px'>You already added a person. Don't add more persons if not necessary</div>");

//setTimeout('positioning(jQuery("#o_personnes .alert3"),jQuery("#o_personnes"),"right right","center top","330 240")',300)
//warning will be positioned on clicking href=2
jQuery("#o_personnes .alert3").fadeIn('slow')
}

	}
	//return false;
	e.preventDefault();
	})
	
	
		
var estimations_count=0;	
jQuery("#collection_estimation :button").click(function()
{
jQuery("#collection_estimation span").animate({width:"200px"}, "slow")

setTimeout('positioning (jQuery("#estimations"),jQuery("#collection_estimation input:first"),"left top","right top","10 10")',500)

jQuery("#estimations ul").append("<li id='taille_collection_"+estimations_count+"'><a href='#' class='remove'><img style='float: left;padding-right: 20px' src='http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/themes/gbif/img/close.png' width='12' height='12' alt='close content' title='change input' /></a><span class='form2'> "+jQuery("#collection_estimation input").eq(0).val()+" / "+jQuery("#collection_estimation input").eq(estimations_count).val()+"</span></li>")
estimations_count++;


})

jQuery("#estimations .remove").live('click',function()
{
jQuery(this).parent().remove();
return false;
})
		
	jQuery( "input:button, input:submit" ).button()
	

	var offset=jQuery("#roles").offset();
	
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
 	
 	jQuery("input[type!=submit],select","#personnes,#o_personnes").val('')
 
	jQuery("#personnes .person").setReadOnly(false);
	jQuery('#roles,#personnes radio').attr('disabled',false)

		
	jQuery('#add_person,#person_added li').show()
	people--;
	})
	
	
	jQuery('#update_person').live('click',function()
	{
	var parent_id=jQuery(this).parent().attr('id')
	
	var person="#"+parent_id.substr(9,parent_id.length)

	jQuery(person).find('span').html(jQuery(this).parent().find('#person_prenom').val())
	jQuery(this).parent().hide();
	
	jQuery('input[type!="submit"]','#personnes').filter(function()
{
//console.log(jQuery(this).parent().attr('id'))
return jQuery(this).parent().attr('id')=='personnes'
}).val('').setReadOnly(false);

   

		jQuery('#roles,#personnes radio').attr('disabled',false)
	jQuery('#add_person,#person_added li').show()
	})
	
	jQuery('#person_added').show();
//	positioning(jQuery('#person_added'),jQuery('#personnes input:first'),'left top','right top','0 0')
	
	positioning(jQuery('#person_added'),jQuery('#personnes select'),'left top','right top','0 0');
	
	
	jQuery('#add_person').click(function(event) 
	
	{
	jQuery('#o_personnes input[type!="radio"][type!="submit"]').trigger('blur')

	check_selects("#o_roles");
		
	var alerts=jQuery('#step2 .alert, #step2 .select_alert')

	if (alerts.size()>0)
	{
	alerts.each(function()
	{
	jQuery(this).animate({
						backgroundColor: "#aa0000",
						color: "black"
						
					}, 1000 );
	})

	}
	else
	{
	add_person(people);
	people++;


	if (jQuery('#person_added fieldset').length==1)
	{
	jQuery("#personnes").append("<div class='alert3' style='width:450px'>You already added a person. Don't add more persons if not necessary</div>");
	setTimeout('positioning(jQuery("#personnes .alert3"),jQuery("#personnes"),"center top","center top","10 0")',100)
	jQuery("#o_personnes .alert3").fadeIn('slow');
	
	}
	
	}
	
	event.preventDefault()
		});	
		

	
	jQuery("#person_added li a").live('click',function(event)
	{

				
	if (jQuery(this).hasClass('change'))
	{
	
	var this_id=jQuery(this).parent().attr('id')
	change_fieldset='#fieldset_'+this_id;
	//console.warn(change_fieldset)
	//$).addClass('50_transparent')
		jQuery(change_fieldset).fadeIn().css('background','none repeat scroll 0pt 0pt rgb(211, 209, 209)');
			jQuery(change_fieldset).css('width','384px')

	

   positioning (jQuery(change_fieldset),jQuery("#personnes"),"center center","center center","-10 20");

	jQuery(change_fieldset).find("input[id='add_person']").hide()	
	//positioning (jQuery("#fieldset_person_0"),jQuery("#step2"),"center center","center center","10 10")
//	jQuery("#person_added li").hide()	
	jQuery("#step2 .person").setReadOnly(true);
	
	jQuery(change_fieldset).find('input').setReadOnly(false);
	jQuery(change_fieldset).find('select').attr('disabled',false);
	//jQuery('#roles,#personnes radio').attr('disabled',true)
//	jQuery(change_fieldset).removeClass('new_person')
		
		//	jQuery(change_fieldset).css('width','520px').animate({top:'200px',left: '-320px'},'slow')
		//jQuery('#add_person').hide()
		
	}
	else
	{

	var fieldset="#fieldset_"+jQuery(this).parent().attr('id');

	jQuery(this).parent().fadeOut('slow').remove();
	jQuery(fieldset).remove();  	
	people--;
	
	if (jQuery('#person_added fieldset').size()==0)
	{
	jQuery("#personnes span").animate({width:"200px"}, "slow");
	jQuery("#personnes .person_alert").animate({width:"520px"}, "slow");
	jQuery("#personnes .alert3").fadeOut('slow').remove();
	jQuery("#o_personnes .alert3").hide();
	}
	jQuery("#step2 .person").setReadOnly(false);
	jQuery('#roles,#personnes radio').attr('disabled',false)

    
	}
	
	
	return false; 
	
	})
	
	
	$.fn.setReadOnly=function(readonly)
	{
	//alert(readonly)
	return this.attr('readonly',readonly).css('opacity', readonly ? 0.5 : 1.0)
	
	}
	
//jQuery(".submit").button();


//Safari Fials
jQuery("#o_mother_institute_params,#o_institute_params,#mother_institute_params,#institute_params").each(function()
{
jQuery(this).children().hide();
//console.log(jQuery(this).find('.first_select'))
if ($.browser.mozilla==true)
{
jQuery(this).find('.first_select').show();
}
else
{
jQuery(this).find('p').eq(0).show();
jQuery(this).find('select').show();
}

jQuery(this).find('legend').show()
//jQuery(this).find('.form2').show()

})



/*
//Safari Fials
jQuery("#o_mother_institute_params,#o_institute_params,#mother_institute_params,#institute_params").each(function()
{
jQuery(this).children().hide();
console.log(jQuery(this).find('.first_select'))
jQuery(this).find('.first_select').show();
jQuery(this).find('legend').show()

})
*/
//var context=jQuery('#step0, #step1, #step3,#step3')




$.fn.check_val=function(not_empty,number,mail,my_id,new_id)
{
var alert_class=jQuery(this).data('alert_class');
var new_id_s='#'+new_id;

alert(jQuery(this)[0].tagName)
if (not_empty)
{
if (this.val()=='')
{
//console.warn(jQuery(this)[0].tagName)
//if (!jQuery("."+alert_class).size()>0)
if (!jQuery("."+my_id).hasClass('alert'))
{

if (jQuery(this)[0].tagName=='TEXTAREA')
{
jQuery(this).css('border','1px dotted black')
}
else
{
jQuery(this).after("<span class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</span>")
jQuery(this).addClass('not_valid');


jQuery(new_id_s).after("<span class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>   You cannot leave it empty</span>")
jQuery(new_id_s).addClass('not_valid');
}

}
}
else  //this.val diferent than ''
{

if (jQuery("."+my_id).size()>0)
{
jQuery("."+my_id).fadeOut().remove();

}

if (number)
{
if (isNaN(jQuery(this).val())) 
{

jQuery(this).after("<span class='"+alert_class+" error' style='display:inline;padding-left: 30px;'>  Not a number!</span>").fadeIn();
jQuery(this).addClass('not_valid');
//console.warn("new _id"+new_id_s+" exists")

jQuery(new_id).after("<span class='"+alert_class+" error' style='display:inline;padding-left: 30px;'>  Not a number!</span>").fadeIn();
jQuery(new_id_s).addClass('not_valid');

}
//jQuery(this).next().empty()
}

//MAIL VALIDATION

if (mail)
{
if (!IsValidEmail(jQuery(this).val()))
{
if (!jQuery("."+alert_class).length>0)
{

jQuery(this).after("<div class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  This is not a valid mail!</div>");

jQuery(new_id).after("<div class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  This is not a valid mail!</div>")

}
}

}


}

}
}
/*
jQuery("#step0 select").change(function()
{
check_selects("#step0 select");
var this_id=jQuery(this).attr('id');
var new_id=this_id.substr(2);
var valor=jQuery(this).val();

jQuery(this).data('not_empty',true);
jQuery(this).data('alert_class',my_id);
var alert_class=my_id;
if (valor=='')
{
if (jQuery("."+alert_class).length==0)
{
jQuery(this).after("<span class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</span>")
jQuery(this).addClass('not_valid');
console.warn("new _id"+new_id+" exists")
jQuery(new_id).after("<span class='"+alert_class+" alert' style='display:inline;padding-left: 30px;'>   You cannot leave it empty</span>")
jQuery(new_id).addClass('not_valid');
} 
}
else
{
if (jQuery("."+alert_class).length>0) {  jQuery("."+alert_class).remove(); }
}

})
*/

function check_mail (this_id,my_value)
{
var my_id_s=jQuery('#'+this_id)
var not_empty=jQuery(my_id_s).data('alert_class');


if (not_empty)
{
if (jQuery(my_id_s).data('step')=='step0')
{
var new_id='#'+this_id.substr(2);
var class_error=this_id;
var new_class_error='.'+this_id.substr(2);
}
else
{
var new_id='#o_'+this_id;
var class_error='o_'+this_id;
//var new_class_error='.o_'+this_id;
}
}
else
{
var class_error='.'+this_id;
}

var error="<div class='"+class_error+" alert' style='display:none;padding-left: 30px;'>  This is not a valid mail!</div>";

if (!IsValidEmail(my_value))
{
if (jQuery('.'+class_error).length==0)
{

jQuery(my_id_s).after(error);
jQuery(new_id).after(error);
//console.info(jQuery('.'+class_error))
jQuery('.'+class_error).fadeIn('slow').css('display','inline');
}
}

else
{
if (jQuery('.'+class_error).length>0)
{
jQuery('.'+class_error).fadeOut('slow').remove()

}
}

}


function check_number (my_id,my_value)
{

var class_error,error;
var my_id_s=jQuery('#'+my_id);

var not_empty=jQuery(my_id_s).data('alert_class');
if (not_empty)
{

if (my_id_s.data('step')=='step0')
{
var new_id='#'+my_id.substr(2);
class_error=my_id;
new_class_error=jQuery('.'+class_error);

}
else
{
var new_id='#o_'+my_id;
class_error='o_'+my_id
new_class_error=jQuery('.'+class_error);
}

jQuery('.'+class_error).remove();

new_class_error.remove();
}
error="<span class='"+class_error+" error' style='display:none;padding-left: 30px;'>  Not a number!</span>";


if (isNaN(my_value)) 
{

//console.warn("not number"+class_error);
if (jQuery('.'+class_error).length==0)
{
my_id_s.after(error)

//if (not_empty)
if (jQuery(new_id).length >0)
jQuery(new_id).after(error)

jQuery('.'+class_error).fadeIn();
}
}
else
{

if (jQuery('.'+class_error).length>0) jQuery('.'+class_error).fadeOut().remove()
}
}

jQuery('input[type!="submit"][type!="radio"][type!="button"],textarea').bind('blur',function(event)
{

var alert_class=jQuery(this).data('alert_class');

var not_empty=jQuery(this).data('not_empty');

var this_id=jQuery(this).attr('id');
var my_value=jQuery(this).val();
if (not_empty)  // step0 and consecuent will have o_pp alert_class  NOT EMPTY!
{
if (jQuery(this).data('step')=='step0')
{
var new_id='#'+this_id.substr(2);
var new_alert_class=alert_class.substr(2);
}
else
{
var new_id='#o_'+this_id;
var new_alert_class='o_'+alert_class;
}

if (jQuery('.'+new_alert_class).size()>0) 
{
jQuery('.'+new_alert_class).remove()
jQuery('.'+this_id).remove()
}


if (my_value!=='')
{
jQuery(new_id).val(my_value);
if (jQuery(this).data('number')) {
check_number(this_id,my_value)
}
else if (jQuery(this).data('mail')) 
{ 
check_mail(this_id,my_value)
} 
else
{
if (jQuery(this)[0].tagName=='TEXTAREA' && jQuery(this).hasClass('