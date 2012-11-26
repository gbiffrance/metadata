var empty_error="<div class='error' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</div>";

alert('sdsfd')

function IsValidEmail(email)

{

var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

return filter.test(email);

}

function check_mail()
{

var my_mail=jQuery('#user_mail').val();
var $has_error=jQuery('#user_mail').next().hasClass('error');
if (my_mail=='')
{
jQuery('#user_mail').after(empty_error);
}
else
{
var error="<div class='error' style='display:inline;padding-left: 30px;'>  This is not a valid mail!</div>";
if (!IsValidEmail(my_mail))  //NOT VALID MAIL
{
if (!$has_error) jQuery('#user_mail').after(error);
}
else
{
if ($has_error) jQuery('#user_mail').next().fadeOut();
}
}
}

jQuery(document).ready(function()
{

jQuery('input').bind('blur',function()
{
$has_error=jQuery(this).next().hasClass('error');
if (jQuery(this).attr('id')=='user_mail') 
{

if ($has_error) 
jQuery(this).next().remove();
check_mail()
}
else 
{
if (jQuery(this).val()=='') 
{
if (!$has_error) jQuery(this).after(empty_error);
}
else
{
if ($has_error) jQuery(this).next().remove();
}
}

})

jQuery('.spacer').click(function()
{
jQuery('#user_mail,#user_pwd').trigger('blur');

if (!jQuery('.alert, .error').length>0)
{
var data=jQuery('#user_mail,#user_pwd').serialize();
//console.info(data);

jQuery.ajax({url:'http://www.gbif.fr/wp-content/themes/gbif/metadata/my_php/login.php',
   		data: data, 
   		type: 'POST',
   		dataType: 'text',
   		error: function ()
   		{
   		//$("#not_found").show();$ajouter_button.hide();	
 alert("Your passwords don't match")
   		},
   		success: function (info)
   		{
 //alert('Congratulations, we will send you a mail soon')
window.location.href='http://lully.snv.jussieu.fr/gbif/wordpress_pere/?page_id=1253';
  
   }
   })
}
else
{
return false;
}
})

})