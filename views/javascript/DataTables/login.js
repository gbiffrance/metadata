var empty_error="<div class='error' style='display:inline;padding-left: 30px;'>  You cannot leave it empty</div>";

$('input').bind('blur',function()
{
if ($(this).attr('id')=='user_mail') check_mail()
else 
{
if ($(this).val()=='') 
{
if (!$(this).next().hasClass('error')) $(this).after(empty_error);
}
}

})

function IsValidEmail(email)

{

var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

return filter.test(email);

}

function check_mail()
{
var $error=$('.error,.mail);
if ($error.length>0) $error.remove();
var my_mail=$('#user_mail').val();
if (my_mail=='')
{
$('#user_mail').after(empty_error);
}
else
{
var error="<div class='error' style='display:inline;padding-left: 30px;'>  This is not a valid mail!</div>";
if (!IsValidEmail())  //NOT VALID MAIL
{
if (!$('#user_mail').next().hasClass('error')) $('#user_mail').after(error);
}
}
}


$('.spacer').click(function()
{
$('input').trigger('blur');

if (!jQuery('.alert, .error').length>0)
{
alert('ok')
}
else
{
return false;
}
})