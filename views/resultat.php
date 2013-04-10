	<div id=body >
	<table border=1>
	<?php
	if (isset($institution))
	{
		echo "<div class=\"content_res\">\n";
			echo "<p>\n";
				echo "<br /><br />\n";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>\n";
			echo "</p>\n";
			echo "<div id=\"container\">\n";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">\n";
					echo "<thead>\n";
						echo "<tr>\n";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>\n";
						echo "</tr>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='20%'>Institution</th>\n";
							echo "<th width='20%'>Collection</th>\n";
							echo "<th width='20%'>Ville</th>\n";
							echo "<th width='20%'>Nom</th>\n";
							echo "<th width='20%'>Pr&eacute;nom</th>\n";
							echo "<th width='20%'>Role</th>\n";
						echo "</tr>\n";
					echo "</thead>\n";
					echo "<tbody>\n";
					echo "</tbody>\n";
					echo "<tfoot>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='20%'>Institution</th>\n";
							echo "<th width='20%'>Collection</th>\n";
							echo "<th width='20%'>Ville</th>\n";
							echo "<th width='20%'>Nom</th>\n";
							echo "<th width='20%'>Pr&eacute;nom</th>\n";
							echo "<th width='20%'>Role</th>\n";
						echo "</tr>\n";
					echo "</tfoot>\n";
				echo "</table>\n";
			echo "</div> <!-- id container -->\n";
		echo "</div> <!-- class content_res -->\n";
	} // else if institution
	else if (isset($dataset))
	{
		echo "<div class=\"content_res\">\n";
			echo "<p>\n";
				echo "<br /><br />\n";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>\n";
			echo "</p>\n";
			echo "<div id=\"container\">\n";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">\n";
					echo "<thead>\n";
						echo "<tr>\n";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>\n";
						echo "</tr>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='20%'>Collection</th>\n";
							echo "<th width='20%'>Institution</th>\n";
							echo "<th width='20%'>Ville</th>\n";
							echo "<th width='20%'>Nom</th>\n";
							echo "<th width='20%'>Pr&eacute;nom</th>\n";
							echo "<th width='20%'>Role</th>\n";
						echo "</tr>\n";
					echo "</thead>\n";
					echo "<tbody>\n";
					echo "</tbody>\n";
					echo "<tfoot>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='20%'>Collection</th>\n";
							echo "<th width='20%'>Institution</th>\n";
							echo "<th width='20%'>Ville</th>\n";
							echo "<th width='20%'>Nom</th>\n";
							echo "<th width='20%'>Pr&eacute;nom</th>\n";
							echo "<th width='20%'>Role</th>\n";
						echo "</tr>\n";
					echo "</tfoot>\n";
				echo "</table>\n";
			echo "</div> <!-- id container -->\n";
		echo "</div> <!-- class content_res -->\n";
	} // else if dataset
	else if (isset($person))
	{
		echo "<div class=\"content_res\">\n";
			echo "<p>\n";
				echo "<br /><br />\n";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>\n";
			echo "</p>\n";
			echo "<div id=\"container\">\n";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">\n";
					echo "<thead>\n";
						echo "<tr>\n";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>\n";
						echo "</tr>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='25%'>Nom</th>\n";
							echo "<th width='25%'>Institution</th>\n";
							echo "<th width='25%'>Collection</th>\n";
							echo "<th width='25%'>Role</th>\n";
						echo "</tr>\n";
					echo "</thead>\n";
					echo "<tbody>\n";
					echo "</tbody>\n";
					echo "<tfoot>\n";
						echo "<tr>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='0%'></th>\n";
							echo "<th width='25%'>Nom</th>\n";
							echo "<th width='25%'>Institution</th>\n";
							echo "<th width='25%'>Collection</th>\n";
							echo "<th width='25%'>Role</th>\n";
						echo "</tr>\n";
					echo "</tfoot>\n";
				echo "</table>\n";
			echo "</div> <!-- id container -->\n";
		echo "</div> <!-- class content_res -->\n";
	} // else if person
	
	if (isset($advanceDataset)) // recherche avancee
	{
		echo "<tr><th>Nom du jeu de donn&eacute;e</th><th>Institution</th><th>Collection/Observation</th><th>Nature du jeu de donn&eacute;e</th></tr>\n";
		for($i=0;$i<sizeof($advanceDataset);$i++)
		{
			echo "<tr><td><a href='detailresultat/dataset/".$advanceDataset[$i]['IdData']."'>".$advanceDataset[$i]['NameData']."</a></td><td><a href='detailresultat/inst/".$advanceDataset[$i]['IdInst']."'>".$advanceDataset[$i]['NameInst']."</a></td><td>".$advanceDataset[$i]['NameTypeData']."</td><td>".$advanceDataset[$i]['NameNature']."</td></tr>\n";
		}
	}
	?>
	</table>
</div>
