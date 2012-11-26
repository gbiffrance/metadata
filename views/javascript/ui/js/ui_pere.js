var $ = jQuery.noConflict();
$(document).ready(init);

	// create the global variables here
	var strDOB = '';
	var strFIN = '';
	var strverni = '';
	var strlegende = '';
	//var strCountry 	= '';
	
	function init () {
$("#dateofbirth,#dateofdeath").datepicker({
	changeMonth: true,
	changeYear: true
	})
//	$( "input:submit" ).button();
		// set up the elements for instantiation
				
		$("#tabs").tabs({
			selected: 0
		});
		
		$(".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *") 
			.removeClass("ui-corner-all ui-corner-top") 
			.addClass("ui-corner-bottom");
			
		// make all button elements a jquery button
		$("button").button();
		// add trhe progress bar
		$("#progressBar").progressbar({ value: 0 });
		
		var taxons=[];
		jQuery("input[id='taxon']").keyup(function()
		{
		if (jQuery('#taxoncoverage'))
		{ 
		jQuery('#taxoncoverage').remove()
		jQuery('.taxon_cols').remove()
		}
		jQuery.ajax({url:'http://lully.snv.jussieu.fr/gbif/wordpress_pere/wp-content/my_php/completion/taxoncov2.php?foo='+$(this).val(), 
		type: 'POST',
		dataType: 'text',
		error: function ()
		{
		$("#not_found").show();
		},
		success: function (info)
		{
		var d=info;
		if ($("#not_found").is('visible')) $("#not_found").hide();
		jQuery(".remove_taxa").live('click',function()
		{
		taxons.splice($.inArray($(this).text(),taxons),1);
		$(this).parent().remove()
		})
		console.warn('info diff that not')
		jQuery("#taxon_result").append(info);
		
		jQuery(".taxon_cols").click(function()
		{
		var to_add=jQuery("#taxon_result option:selected").val();
		if (to_add !=='')
		{
		if ($.inArray(to_add,taxons)==-1) 
		{
		jQuery("#mots_cle").append("<div><input type='button' class='remove_taxa' value='remove it'>"+to_add+"</input><br><div>");
		if (! jQuery('#mots_cle').is('visible')) jQuery('#mots_cle').fadeIn()
		taxons.push(to_add);
		}
		}
		
		}) //taxon_cols

		}
		}) //ajax
		})
		
		// I run on change of the progressBar element
		// and manage the css styles of the background colour		
		$("#progressBar").bind('progressbarchange', function(event, ui) {
			var element = "#" + this.id + " > div";
            var value = this.getAttribute( "aria-valuenow" );
            if (value < 20){
                $(element).css({ 'background': 'Red' });
            } else if (value < 40){
                $(element).css({ 'background': 'Orange' });
            } else if (value < 60){
                $(element).css({ 'background': 'Yellow' });
            } else if (value < 80){
                $(element).css({ 'background': 'LightGreen' });
            } else {
                $(element).css({ 'background': 'Green' });
            }
		});
				
		// create a non-selectable sortable list
		$("#sortable").sortable().disableSelection();						
		
		$("#textBox").sortable().disableSelection();
		$("#textBox2").sortable().disableSelection();
		
//		$('#switcher').themeswitcher();
		
		$("#messageBox").html('<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Ok!</strong> Formulaire à remplir.</p>');
		
				
		// ensure the radio button groups use the button widget
		//$("#radio, #radio2").buttonset();
		// by default, set the progress buttons to disabled
		$("#openTwo, #openThree, #openFour, #openFive, #complete").button({ disabled: true });
	
						
		$("#dateofbirth").datepicker({
			changeMonth: true,
			changeYear: true,
			//maxDate: '-10Y',
			onSelect: function(dateText, inst) {
				$("#openThree").button({ disabled: false });
				strDOB = dateText;
			}
		});
		$("#dateofbirth2").datepicker({
			changeMonth: true,
			changeYear: true,
			//maxDate: '-10Y',
			onSelect: function(dateText, inst) {
				$("#openThree").button({ disabled: false });
				strFIN = dateText;
			}
		});
		$("#dateofbirth3").datepicker({
			changeMonth: true,
			changeYear: true,
			//maxDate: '-1Y',
			onSelect: function(dateText, inst) {
				$("#openThree").button({ disabled: false });
				strverni = dateText;
			}
		});
		
		// I am the default source for the autocomplete
		//var countryList = ["Paris", "Lyon", "Marseille", "Lille"];
				
		//$("#country").autocomplete({
			//source: countryList,
			//select: function(event, ui) {
				//activate('openFour');
				//strCountry = ui.item.label;
			//}
		//});
		
		// I set the dialog window element
		// complete with event handler for action
		$("#dialog").dialog({
			autoOpen: false,
			modal: true,
			buttons: { "Merci": function() { 
					$(this).dialog("close");
					makeProgress(5, 100);
					$("#complete").button({ disabled: true });
					addListItem2('Le formulaire est fini!','');
					allDone();
				}
			}
		});
	}
	
	// this function creates a list item and appends 
	// it to the sortable un-ordered list
	function addListItem(text, item) {
		var str = '';
		str = text + ' ' + item;
		$("#sortable").append("<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>" + str + "</li>");
	}
	
	function addListItem2(text, item) {
		var str = '';
		$('#sortable').hide();
		str = text + ' ' + item;
		$("#textBox").append("<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>" + str + "</li>");
	}
	function addListItem3(text, item) {
		var str = '';
		$('#textBox').hide();
		str = text + ' ' + item;
		$("#textBox2").append("<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>" + str + "</li>");
	}
	// this function increases the value of the progress bar
	// and disables the tab we have just left
	function makeProgress(selectTab, progressValue) {
		var $tabs = $("#tabs").tabs();
		$tabs.tabs('select', selectTab);									
		$("#progressBar").progressbar({ value: progressValue });
		
		// disable the current tab
		$tabs.tabs('disable', selectTab-1);
		
		return false;
	}
	function getFormul(){
      var nom_expoValue = $("#nom_expo").val();
		var nom_photographeValue = $("#nom_photographe").val();
		var nom_galerieValue = $("#nom_galerie").val();
		var adresse = $("#adresse").val();
		var lieu_cp = $("#CP").val();
		var lieu_ville = $("#ville").val();
		var site = $("#site").val();
		var email = $("#email").val();
		var date_debut = strDOB;
		var date_fin = strFIN;
		var vernissage = strverni;
		var resume = $("#resume").val();
		var image = $("#image").val();
		var strlegende = $("#strlegende").val();
      $.get("enreg_info_form.php", { "nom_expoValue": nom_expoValue, "nom_photographeValue": nom_photographeValue, "nom_galerieValue": nom_galerieValue, "adresse": adresse, "lieu_cp": lieu_cp, "lieu_ville": lieu_ville, "site": site, "email": email, "date_debut": date_debut, "date_fin": date_fin, "vernissage": vernissage, "resume": resume, "image": image, "strlegende": strlegende}, addListItem3); 
	  }
	  function aff_annonce(){
       var nom_expoValue = $("#nom_expo").val();
	   var nom_photographeValue = $("#nom_photographe").val();
		$('#photo').hide();
      $.get("aff_annonce.php", { "nom_expoValue": nom_expoValue, "nom_photographeValue": nom_photographeValue}, processResult2);
    }
	function processResult2(data, textStatus){
      $("#step5").html(data);
	  }
	
	function getRadioValue() {
		var nom_expoValue = $("#nom_expo").val();
		var nom_photographeValue = $("#nom_photographe").val();
		var nom_galerieValue = $("#nom_galerie").val();
		addListItem('Titre exposition: ', nom_expoValue);
		addListItem('Photographe: ', nom_photographeValue);
		addListItem('Lieu: ', nom_galerieValue);
		addListItem('Adresse:', $('#adresse').val());
		addListItem('Site:', $('#site').val());
		addListItem('Ville:', $('#ville').val());
		addListItem('CP:', $('#CP').val());
	}
	function getTextValue() {
		var nom_text_present = $("#resume").val();
		addListItem2('Texte présentation expo: ', nom_text_present);
	}
	function getTextValue2() {
		var strlegende = $("#strlegende").val();
	addListItem2('Transfert image reussi:', strlegende);
	}
	// this function used only in the first stage to
	// enable the proceed button
	function activate(buttonID) {
		$("#" + buttonID + "").button({ disabled: false });
	}

	// this function is used on the final stage, called
	// from the dialog box
	function allDone() {
		$("#messageBox").removeClass('ui-state-error').addClass('ui-state-highlight');
		$("#messageBox").html('<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Parution prochaine: </strong> Après validation de votre annonce par nos services.</p>');
	}
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}