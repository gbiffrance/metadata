var $=jQuery.noConflict();



function IsValidEmail(email)

{
var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
return filter.test(email);
}

function check_mail (my_id,my_value)
{
var $=jQuery.noConflict();
var $my_div=$('#'+my_id);
console.warn($my_div)
var $my_alert=$('.'+my_id);
error="<span class='"+my_id+" error' style='display:none;padding-left: 30px;'>  Not a valid mail!</span>";

if (!IsValidEmail(my_value))
{
if (!$my_alert.size()>0)
{
$my_div.after(error).next().fadeIn('slow')
}
}
else
{
if ($my_alert.size()>0) $my_alert.fadeOut('slow').remove()
}
}
function check_number (my_id,my_value)
{
var $=jQuery.noConflict();
var $my_div=$('#'+my_id);
var $my_alert=$('.'+my_id);

error="<span class='"+my_id+" alert' style='display:none;padding-left: 30px;'>  Not a number!</span>";
if (my_value!=='')
{
if (isNaN(my_value)) 
{
if (!$my_alert.size()>0)
{
$my_div.after(error).next().fadeIn('slow')
}
}
else
{
if ($my_alert.size()>0) $my_alert.fadeOut('slow').remove()
}
}
else 
{

//check_empty (my_id,my_value)
}
}

function check_empty (my_id,my_value)
{
var $=jQuery.noConflict();
var $my_div=$('#'+my_id);
//var $my_alert=$('.'+my_id);
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

$(document).ready(function()
{
var $=jQuery.noConflict();
$('input').bind('focusout',function()
{


if ($(this).hasClass('obligatoire'))
{
check_empty($(this).attr('id'),$(this).val())
}

if ($(this).hasClass('number')) 
{
check_number($(this).attr('id'),$(this).val())
}

if ($(this).hasClass('mail'))
{
check_mail($(this).attr('id'),$(this).val())
}


})

$('#accept2').live('click',function()
{
$("#standout").fadeOut('slow').remove()
$('.page-content').unwrap();
$('.page-content').unwrap();
})

function show_msg (msg)
{
var $=jQuery.noConflict();
 my_html='<div id="standout" style="opacity:0.01;left: 150px; top: 100px;">'+msg+'</br><div id="accept2" style="color:#5AAD62;cursor: pointer">Come back</div></div>';
 
  $('.page-content').wrap("<div id='lights-off'/>")
  $('.page-content').wrap("<div id='lights-off'/>")
   
   $("#lights-off").prepend(my_html)
   $("#lights-off").fadeTo("slow",0.9);
 $("#standout").animate({opacity:1},'slow')
}

$('.spacer').click(function()
{
var $=jQuery.noConflict();
$('.content input').trigger('focusout')
var $errors=$('.alert,.error','.content');
if ($errors.size()>0)
{
$errors.each(function()
{
console.warn($(this))
$(this).animate(

 {backgroundColor: "blue",
	color: "black"
  }, 1000 );

})
}

else
{
var $=jQuery.noConflict();
var data=$('.content input').serialize()
jQuery.ajax({url:'http://www.gbif.fr/wp-content/themes/gbif/metadata/my_php/validate.php',
   		data: data, 
   		type: 'POST',
   		dataType: 'text',
   		error: function ()
   		{
   		//$("#not_found").show();$ajouter_button.hide();	
  show_msg("Your passwords don't match")
   		},
   		success: function (info)
   		{
  show_msg('Congratulations, we will send you a mail soon')
  
   }
   })
}
})
//$('.content input').serialize()

})

