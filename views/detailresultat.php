<div id=body >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
		// S'il y a un message d'erreur
		if (isset($error))
		{
			echo "<p class='error'>".$error."</p>";
		}
		else
		{
			echo "
				<p>\n
					Retour sur la <a href='".site_url()."/consultation'> Recherche des m&eacute;tadonn&eacute;es</a>\n
				</p>\n";
			
			// Affichage des infos de l'institution
			if(isset($dataset))
			{
				echo "
					<div class=\"accordion\">\n
						<div class='content_res'>\n
							<h3>Collection</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
							
							<h3>Institution</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
							
							<h3>Personnel</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
							
							<h3>Plus de d&eacute;tails</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
						</div>\n
					</div>\n";
			}
			else if (isset($inst))
			{
				echo "
					<div class=\"accordion\">\n
							<div class='content_res'>\n
							<h3>Institution</h3>\n
							
							<div style='display: none;'></div>\n
							<h3>Collections</h3>\n
							<div id='info' class='notClicked' style='display: block;'></div>\n
						</div>\n
						<div id='pager'></div>\n
						<br />\n";
				echo "<div>";
			}
			else if (isset($pers))
			{
				echo "
					<div class=\"accordion\">\n
						<div class='content_res'>\n
							<h3>Personne</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
							
							<h3>Jeux de donn&eacute;es</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
						</div>\n
					</div>\n";
			}
		}
	?>
</div>
