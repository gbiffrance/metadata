<div id=body >
	<table border=1>
	<?php
	// DEBUT MODIFS NICOLAS
	if (isset($institution))
	{
		echo "<div class=\"content\">";
			echo "<p>";
				echo "<br /><br />";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>";
			echo "</p>";
			echo "<div id=\"container\">";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">";
					echo "<thead>";
						echo "<tr>";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='20%'>Institution</th>";
							echo "<th width='20%'>Collection</th>";
							echo "<th width='20%'>Ville</th>";
							echo "<th width='20%'>Nom</th>";
							echo "<th width='20%'>Pr&eacute;nom</th>";
							echo "<th width='20%'>Role</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					echo "</tbody>";
					echo "<tfoot>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='20%'>Institution</th>";
							echo "<th width='20%'>Collection</th>";
							echo "<th width='20%'>Ville</th>";
							echo "<th width='20%'>Nom</th>";
							echo "<th width='20%'>Pr&eacute;nom</th>";
							echo "<th width='20%'>Role</th>";
						echo "</tr>";
					echo "</tfoot>";
				echo "</table>";
			echo "</div> <!-- id container -->";
		echo "</div> <!-- class content -->";
	} // else if institution
	else if (isset($dataset))
	{
		echo "<div class=\"content\">";
			echo "<p>";
				echo "<br /><br />";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>";
			echo "</p>";
			echo "<div id=\"container\">";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">";
					echo "<thead>";
						echo "<tr>";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='20%'>Institution</th>";
							echo "<th width='20%'>Collection</th>";
							echo "<th width='20%'>Ville</th>";
							echo "<th width='20%'>Nom</th>";
							echo "<th width='20%'>Pr&eacute;nom</th>";
							echo "<th width='20%'>Role</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					echo "</tbody>";
					echo "<tfoot>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='20%'>Institution</th>";
							echo "<th width='20%'>Collection</th>";
							echo "<th width='20%'>Ville</th>";
							echo "<th width='20%'>Nom</th>";
							echo "<th width='20%'>Pr&eacute;nom</th>";
							echo "<th width='20%'>Role</th>";
						echo "</tr>";
					echo "</tfoot>";
				echo "</table>";
			echo "</div> <!-- id container -->";
		echo "</div> <!-- class content -->";
	} // else if dataset
	else if (isset($person))
	{
		echo "<div class=\"content\">";
			echo "<p>";
				echo "<br /><br />";
				echo "Retour sur la <a href='consultation'> Recherche des m&eacute;tadonn&eacute;es</a>";
			echo "</p>";
			echo "<div id=\"container\">";
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"consult\">";
					echo "<thead>";
						echo "<tr>";
							echo "<td colspan=\"3\" class=\"dataTables_empty\">Chargement des donn&eacute;es depuis le serveur</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='25%'>Nom</th>";
							echo "<th width='25%'>Institution</th>";
							echo "<th width='25%'>Collection</th>";
							echo "<th width='25%'>Role</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					echo "</tbody>";
					echo "<tfoot>";
						echo "<tr>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='0%'></th>";
							echo "<th width='25%'>Nom</th>";
							echo "<th width='25%'>Institution</th>";
							echo "<th width='25%'>Collection</th>";
							echo "<th width='25%'>Role</th>";
						echo "</tr>";
					echo "</tfoot>";
				echo "</table>";
			echo "</div> <!-- id container -->";
		echo "</div> <!-- class content -->";
	} // else if person
	// FIN MODIFS NICOLAS
	
	
	// DEPHINE PART
// 		if (isset($inst))
// 		{
// 			echo "<tr><th>Nom de l'institution</th><th>Type(s) de l'institution</th><th>R&eacute;gion</th><th>Ville</th></tr>";
// 			for($i=0;$i<sizeof($inst);$i++)
// 			{
// 				echo "<tr><td><a href='detailresultat/inst/".$inst[$i]['IdInst']."'>".$inst[$i]['NameInst']."</a></td><td>".$inst[$i]['NameTypeInst']."</td><td>".$inst[$i]['NameRegion']."</td><td>".$inst[$i]['NameTown']."</td></tr>";
// 			}
// 		}
// 		else if (isset($dataset))
// 		{
// 			echo "<tr><th>Nom du jeu de donn&eacute;e</th><th>Institution</th><th>Collection/Observation</th><th>Nature du jeu de donn&eacute;e</th></tr>";
// 			for($i=0;$i<sizeof($dataset);$i++)
// 			{
// 				echo "<tr><td><a href='detailresultat/dataset/".$dataset[$i]['IdData']."'>".$dataset[$i]['NameData']."</a></td><td><a href='detailresultat/inst/".$dataset[$i]['IdInst']."'>".$dataset[$i]['NameInst']."</a></td><td>".$dataset[$i]['NameTypeData']."</td><td>".$dataset[$i]['NameNature']."</td></tr>";
// 			}
// 		}
// 		else if (isset($pers))
// 		{
// 			echo "<tr><th>Nom de la personne</th><th>Nom du jeu de donn&eacute;e</th><th>R&ocirc;le sur le jeu de donn&eacute;e</th></tr>";
// 			for($i=0;$i<sizeof($pers);$i++)
// 			{
// 				echo "<tr><td><a href='detailresultat/pers/".$pers[$i]['IdPersonne']."'>".$pers[$i]['SurNamePers']." ".$pers[$i]['FirstNamePers']."</a></td><td><a href='detailresultat/dataset/".$pers[$i]['IdData']."'>".$pers[$i]['NameData']."</a></td><td>".$pers[$i]['NameRole']."</td></tr>";
// 			}
// 		}
		if (isset($advanceDataset)) // recherche avancee
		{
			echo "<tr><th>Nom du jeu de donn&eacute;e</th><th>Institution</th><th>Collection/Observation</th><th>Nature du jeu de donn&eacute;e</th></tr>";
			for($i=0;$i<sizeof($advanceDataset);$i++)
			{
				echo "<tr><td><a href='detailresultat/dataset/".$advanceDataset[$i]['IdData']."'>".$advanceDataset[$i]['NameData']."</a></td><td><a href='detailresultat/inst/".$advanceDataset[$i]['IdInst']."'>".$advanceDataset[$i]['NameInst']."</a></td><td>".$advanceDataset[$i]['NameTypeData']."</td><td>".$advanceDataset[$i]['NameNature']."</td></tr>";
			}
		}
	?>
	</table>
</div>
