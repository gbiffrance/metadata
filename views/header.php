<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
	?>
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- /!\ On production server, use relative address /wp-content/themes/gbif/stylesheets/bootstrap/css/bootstrap.css /!\ -->
		<link rel="stylesheet" href="/wp-content/themes/gbif/stylesheets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style_res.css" type="text/css" media="screen" />
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

</head>
<body>

	<div class="container" id="container">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="http://www.gbif.fr" accesskey="1" title="GBIF France">
				GBIF France
				</a>
					<div id="navbar-menu">
						<ul id="menu-header" class="nav">
							<li id="menu-item-mhome" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-mhome"><a href="<?php echo site_url('metadata'); ?>">M&eacute;tadonn&eacute;es</a></li>
							<li id="menu-item-view" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-view"><a href="<?php echo site_url('consultation'); ?>">Consultation</a></li>
							<li id="menu-item-stat" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-stat"><a href="<?php echo site_url('statistiques'); ?>">Statistiques</a></li>
							
							<?php
								// Si l'utilisateur est connecté
								if ($log == "oui")
								{
								?>
									<li id="menu-item-new" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-new"><a href="<?php echo site_url('ajout'); ?>">Saisie</a></li>
									<?php 
									// S'il a au moins un niveau de contributeur
									if ($this->session->userdata('droits') >= 2)
									{
									?>
										<li id="menu-item-modif" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-modif"><a href="<?php echo site_url('modification'); ?>">Modification</a></li>
										<?php
									}
									// S'il a au moins un niveau d'admin
									if ($this->session->userdata('droits') >= 4)
									{
									?>
										<li id="menu-item-manage" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-manage"><a href="<?php echo site_url('gestion'); ?>">Gestion des utilisateurs</a></li>
									<?php
									}
									?>
									<li id="menu-item-user" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-user"><a href="<?php echo site_url('compte'); ?>">Modifier son compte</a></li>
									<li id="menu-item-logout" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-logout"><a href="<?php echo site_url('deconnexion'); ?>">Se d&eacute;connecter</a></li>
									<?php
									}
									else
									{
									?>
										<li id="menu-item-loggin" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-loggin"><a href="<?php echo site_url('connexion'); ?>">Se connecter</a></li>
									<?php
									}
									?> 
						</ul>
						<div style="float:right;">
							<img height="70" width="70" style="margin:10px;" src="http://www.gbif.fr/wp-content/themes/gbif/img/paint-simple-gbif-logo-120px.png"/>
						</div>
					</div>
					<div id="sub-menu" style="float:left;">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container content">
		<h1 class="page-title well"><?php echo $title; ?></h1>

