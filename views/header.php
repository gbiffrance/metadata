<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
	?>
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style.css" type="text/css" media="screen" />

<!-- DEBUT MODIFS NICOLAS -->
<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style_pere.css" type="text/css" media="screen" />
<?php
echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/jquery.js?ver=1.4.4\"></script>\n";
if(isset($ajax_f))
{
	if($ajax_f == "res_list")
	{
		echo "<script type='text/javascript'>\nvar info='".$choix."';\nvar sword='".$sWord."';\n</script>\n";
		echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/DataTables/jquery.dataTables.js?ver=3.1\"></script>\n";
		echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/DataTables/my_tables.js?ver=3.1\"></script>\n";

	}
	else if($ajax_f == "inst_details")
	{
		echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/pager/jquery.pager.js?ver=3.1\"></script>\n";
 		echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/pager/my_pager.js?ver=3.1\"></script>\n";
		
		echo "<link rel=\"stylesheet\" href=\"".base_url()."application/views/css/Pager.css\" type=\"text/css\" media=\"screen\" />"; // CSS
	}
	else if($ajax_f == "coll_details" || $ajax_f == "pers_details")
	{
		echo "<script type='text/javascript' src=\"".base_url()."application/views/javascript/description.js?ver=3.1\"></script>\n";
	}
} // if isset 
?>
<!-- FIN MODIFS NICOLAS -->

	</head>
	<body>
		<div id="header">
			<div id="header-holder">
				<div id="banner">
					<div id="logo">
						<h1>
							<a href="http://www.gbif.fr" accesskey="1" title="GBIF France">
								<img alt="gbif.fr" src="<?php echo base_url();?>application/views/images/gbif-logo2.gif" />
							</a>.FR
						</h1>
					</div>
					<div id="slogan">
					<p>
						Système mondial d'information sur la biodiversité<br/>
						M&eacute;tadonn&eacute;es fran&ccedil;aises 
					</p>
				</div>
				<!--menus-->
				<div id="nav">
					<p>
						<a href="<?php echo site_url('metadata'); ?>">Accueil</a>&nbsp; <b>|</b> &nbsp;
						<a href="<?php echo site_url('consultation'); ?>">Consultation</a>&nbsp; <b>|</b> &nbsp;
						<!--<a href="http://www.gbif.fr/gbif_old/themes/gbif/metadata/stat/php/displayview.php">Statistiques</a>&nbsp; <b>|</b> &nbsp;-->
						<?php
							// Si l'utilisateur est connecté
							if ($log == "oui")
							{
								?>
									<a href="<?php echo site_url('ajout'); ?>">Saisie</a> &nbsp;<b>|</b> &nbsp;
								<?php 
									// S'il a au moins un niveau de contributeur
									if ($this->session->userdata('droits') >= 2)
									{
										?>
											 <a href="<?php echo site_url('modification'); ?>">Modification</a> &nbsp;<b>|</b> &nbsp;
										<?php
									}
									// S'il a au moins un niveau d'admin
									if ($this->session->userdata('droits') >= 4)
									{
										?>
											 <a href="<?php echo site_url('gestion'); ?>">Gestion des utilisateurs</a> &nbsp;<b>|</b> &nbsp;
										<?php
									}
								?>
									<a href="<?php echo site_url('compte'); ?>">Modifier son compte</a> &nbsp;<b>|</b> &nbsp;
									<a href="<?php echo site_url('deconnexion'); ?>">Se d&eacute;connecter</a>
								<?php
							}
							else
							{
								?>
									<a href="<?php echo site_url('connexion'); ?>">Se connecter</a>&nbsp; <b>|</b> &nbsp;
									<a href="<?php echo site_url('enregistrement'); ?>">S'enregistrer</a>
								<?php
							}
						?> 
					</p>
				</div>
			</div>	
		</div>
	</div>

	<div id=titre >
<!-- NL MODIFS -->
		<h1><?php echo $title; ?></h1>
<!-- NL MODIFS -->
	</div>	

