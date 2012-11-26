
jQuery(document).ready(function()
{
jQuery('.collections').click(function()
{
if (jQuery('#selColl').val()=='')
{
return false;
}
else
{
location.href='http://www.gbif.fr/?page_id=976&id='+jQuery('#selColl').val();
}
})

jQuery('.institutions').click(function()
{
if (jQuery('#selInst').val()=='')
{
return false;
}
else
{
location.href='http://www.gbif.fr/?page_id=981&action=get_institution_php&id='+jQuery('#selInst').val();
}
})
})
