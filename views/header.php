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
		<link rel="stylesheet" href="http://www.gbif.fr/wp-content/themes/gbif/stylesheets/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
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
		} // if	isset 
	?>
</head>

<body>
	<?php
		// Store current loaded view name
		$cut_url = explode("index.php/",$_SERVER['REQUEST_URI']);
		$cut_path = explode("/",$cut_url[1]); // split current page path
		$cur_page = $cut_path[0]; // keep main category page name
	?>
	<div class="container" id="container">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="http://www.gbif.fr" accesskey="1" title="GBIF France">
				GBIF France
				</a>
					<div id="navbar-menu">
						<ul id="menu-header" class="nav">
							<li id="menu-item-1480" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1480"><a href="http://www.gbif.fr/portal" >Portail</a></li>
							<li id="menu-item-326" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-326"><a href="http://www.gbif.fr/?page_id=324" >GBIF</a></li>
							<li id="menu-item-149" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-149"><a href="http://www.gbif.fr/?category_name=actualites" >Actualités</a></li>
							<li id="menu-item-515" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-515"><a href="http://www.gbif.fr/?page_id=121" >Participer</a></li>
							<li id="menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608"><a href="http://www.gbif.fr/?page_id=225" >Documentation</a></li>
							<li id="menu-item-1483" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-1483"><a href="http://www.gbif.fr/metadata/index.php/metadata" >Métadonnées</a></li>
						</ul>
						<div style="float:right;">
							<img height="70" width="70" style="margin:10px;" src="http://www.gbif.fr/wp-content/themes/gbif/img/paint-simple-gbif-logo-120px.png"/>
						</div>
					</div>
					<div id="sub-menu" style="float:left;">
						<i class="icon-chevron-right icon-white" style="float:left;"></i>
						<ul id="menu-metadata" class="nav">
							<?php
								if($cur_page == 'metadata')
									echo "<li id=\"menu-item-mhome\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-mhome current-menu-item\"><a href=\"".site_url('metadata')."\">Accueil</a></li>";
								else
									echo "<li id=\"menu-item-mhome\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-mhome\"><a href=\"".site_url('metadata')."\">Accueil</a></li>";
								
								if($cur_page == 'consultation' || $cur_page == 'resultat' || $cur_page == 'detailresultat')
									echo "<li id=\"menu-item-view\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-view current-menu-item\"><a href=\"".site_url('consultation')."\">Consultation</a></li>";
								else
									echo "<li id=\"menu-item-view\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-view\"><a href=\"".site_url('consultation')."\">Consultation</a></li>";

								if($cur_page == 'statistiques')
									echo "<li id=\"menu-item-stat\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-stat current-menu-item\"><a href=\"".site_url('statistiques')."\">Statistiques</a></li>";
								else
									echo "<li id=\"menu-item-stat\" class=\"menu-item menu-item-type-taxonomy menu-item-object-category menu-item-stat\"><a href=\"".site_url('statistiques')."\">Statistiques</a></li>";
								
								// Si l'utilisateur est connecté
								if ($log == "oui")
								{
									if($cur_page == 'ajout' || $cur_page == 'ajoutinst' || $cur_page == 'ajoutdata')
										echo "<li id=\"menu-item-new\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-new current-menu-item\"><a href=\"".site_url('ajout')."\">Saisie</a></li>";
									else
										echo "<li id=\"menu-item-new\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-new\"><a href=\"".site_url('ajout')."\">Saisie</a></li>";
									
									// S'il a au moins un niveau de contributeur
									if ($this->session->userdata('droits') >= 2)
									{
										if($cur_page == 'modification')
											echo "<li id=\"menu-item-modif\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-modif current-menu-item\"><a href=\"".site_url('modification')."\">Modification</a></li>";
										else
											echo "<li id=\"menu-item-modif\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-modif\"><a href=\"".site_url('modification')."\">Modification</a></li>";
										}
										// S'il a au moins un niveau d'admin
										if ($this->session->userdata('droits') >= 4)
										{
											if($cur_page == 'gestion')
												echo "<li id=\"menu-item-manage\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-manage current-menu-item\"><a href=\"".site_url('gestion')."\">Gestion des comptes</a></li>";
											else
												echo "<li id=\"menu-item-manage\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-manage\"><a href=\"".site_url('gestion')."\">Gestion des comptes</a></li>";
									}
									if($cur_page == 'compte')
										echo "<li id=\"menu-item-user\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-user current-menu-item\"><a href=\"".site_url('compte')."\">Modifier mon compte</a></li>";
									else
										echo "<li id=\"menu-item-user\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-user\"><a href=\"".site_url('compte')."\">Modifier mon compte</a></li>";
									
// 									if($cur_page == 'deconnexion')
// 										echo "<li id=\"menu-item-logout\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-logout current-menu-item\"><a href=\"".site_url('deconnexion')."\">Se d&eacute;connecter</a></li>";
// 									else
// 										echo "<li id=\"menu-item-logout\" class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-logout\"><a href=\"".site_url('deconnexion')."\">Se d&eacute;connecter</a></li>";
								}
								else
								{
									if($cur_page == 'connexion')
										echo "<li id=\"menu-item-loggin\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-loggin current-menu-item\"><a href=\"".site_url('connexion')."\">Se connecter</a></li>";
									else
										echo "<li id=\"menu-item-loggin\" class=\"menu-item menu-item-type-post_type menu-item-object-page menu-item-loggin\"><a href=\"".site_url('connexion')."\">Se connecter</a></li>";
								}
								?> 
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container content">
		<h1 class="page-title well"><?php echo $title; ?></h1>

		<?php
			if ($log == "oui")
				echo "<span id=\"logout\"><a href=\"".site_url('deconnexion')."\">Se d&eacute;connecter</a></span>";
		?>
