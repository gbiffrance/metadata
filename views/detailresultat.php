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
			// DEBUT MODIFS NICOLAS
			echo "
				<p>\n
					Retour sur la <a href='".site_url()."/consultation'> Recherche des m&eacute;tadonn&eacute;es</a>\n
				</p>\n";
			
			// Affichage des infos de l'institution
			if(isset($dataset))
			{
				echo "
					<div class=\"accordion\">\n
						<div id='content'>\n
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
							<div id='content'>\n
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
						<div id='content'>\n
							<h3>Personne</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
							
							<h3>Jeux de donn&eacute;es</h3>\n
							<div style='display: none;' class='accordion_content'></div>\n
						</div>\n
					</div>\n";
			}
			// FIN MODIFS NICOLAS
			
			// DELPHINE PART
			// Affichage des infos de l'institution
// 			if (isset($inst))
// 			{
// 				echo "<h4>Institution</h4>";
// 				// Je mets une condition sur l'affichage de l'image car sinon sous google chrome ça affiche un truc bizarre
// 				if ($inst->LogoUrlInst != '')
// 				{
// 					echo "<img src='".trim($inst->LogoUrlInst)."' /><br/>";
// 				}
// 				echo "Nom : ".$inst->NameInst."<br/>";
// 				echo "Sigle : ".$inst->SigleInst."<br/>";
// 				echo "Description : ".$inst->DescriptionInst."<br/>";
// 				echo "Types : ".$type."<br/>";
// 				echo "Adresse : ".trim($inst->AddressInst)." ".trim($inst->PostalCode)." ".$town."<br/>";
// 				echo "Tel : ".$inst->PhoneInst."<br/>";
// 				echo "E-mail : ".$inst->EmailInst."<br/>";
// 				echo "URL : ".$inst->UrlInst."<br/>";
// 				// S'il existe une institution mere
// 				if (isset($instmere))
// 				{
// 					$segments = array('detailresultat', 'inst', $instmere->IdInst);
// 					echo "Institution m&egrave;re : <a href='".site_url($segments)."'>".trim($instmere->NameInst)."</a><br/>";
// 				}
// 				// S'il existe des institutions fille
// 				if (isset($instChild))
// 				{
// 					// S'il y en a qu'une
// 					if (sizeof($instChild) == 1)
// 					{
// 						echo "Institution fille : ";
// 					}
// 					// S'il y en a plusieurs
// 					else
// 					{
// 						echo "Institutions filles : ";
// 					}
// 					for($i=0;$i<sizeof($instChild);$i++)
// 					{
// 						$segments = array('detailresultat', 'inst', $instChild[$i]->IdInst);
// 						echo "<a href='".site_url($segments)."'>".trim($instChild[$i]->NameInst)."</a>";
// 						// Si ce n'est pas la dernière
// 						if ($i < sizeof($instChild)-1)
// 						{
// 							echo ", ";
// 						}
// 					}
// 					echo "<br/>";
// 				}
// 				echo "R&eacute;gion : ".$region."<br/>";
// 			}
			
			// Affichage des datasets associés à une institution
// 			if (isset($datasetInst))
// 			{
// 				echo "<h4>Jeux de donn&eacute;es</h4>";
// 				echo "<ul>";
// 				// On parcourt la liste des dataset
// 				for($i=0;$i<sizeof($datasetInst);$i++)
// 				{
// 					// S'il n'y a pas de dataset père
// 					if ($datasetInst[$i]->IdDataParent == 0)
// 					{
// 						// On affiche le lien vers le dataset
// 						$segments = array('detailresultat', 'dataset', $datasetInst[$i]->IdData);
// 						echo "<li><a href='".site_url($segments)."'>".trim($datasetInst[$i]->NameData)."</a></li><ul>";
// 						// Ensuite, on parcourt à nouveau la liste des dataset pour chercher les dataset fils
// 						for($j=0;$j<sizeof($datasetInst);$j++)
// 						{
// 							if ($datasetInst[$j]->IdDataParent == $datasetInst[$i]->IdData)
// 							{
// 								$segments = array('detailresultat', 'dataset', $datasetInst[$j]->IdData);
// 								echo "<li><a href='".site_url($segments)."'>".trim($datasetInst[$j]->NameData)."</a></li>";
// 							}
// 						}
// 						echo "</ul>";
// 					}
// 				}
// 				echo "</ul>";
// 			}
			
			// Affichage des infos du dataset
			if (isset($dataset))
			{
// 				echo "<h4>$typeData</h4>";
// 				$gbif = trim($dataset->IdGbif);
// 				if (!empty($gbif))
// 				{
// 					echo "Connect&eacute; au GBIF : http://data.gbif.org/datasets/resource/".$dataset->IdGbif."<br/>";
// 				}
// 				echo "Nom : ".$dataset->NameData."<br/>";
// 				echo "Description : ".$dataset->DescriptionData."<br/>";
// 				echo "Droits d'utilisation : ".$dataset->Rights."<br/>";
// 				echo "But : ".$dataset->Purpose."<br/>";
// 				echo "Poss&egrave;de des types : ";
// 				if ($dataset->HaveType == "OUI")
// 				{
// 					echo "Oui<br/>";
// 				}
// 				else
// 				{
// 					echo "Non<br/>";
// 				}
// 				echo "Nature : ".$nature."<br/>";
// 				echo "Date de cr&eacute;ation du jeu de donn&eacute;es : ".$dataset->CreationDateData."<br/>";
// 				echo "Date de mise à jour du jeu de donn&eacute;es : ".$dataset->UpdateDateData."<br/>";
// 				// S'il existe un dataset père
// 				if (isset($datapere))
// 				{
// 					$segments = array('detailresultat', 'dataset', $datapere->IdData);
// 					echo "Jeu de donn&eacute;es p&egrave;re : <a href='".site_url($segments)."'>".trim($datapere->NameData)."</a><br/>";
// 				}
				// S'il existe des dataset fils
// 				if (isset($dataChild))
// 				{
// 					// S'il y en a qu'une
// 					if (sizeof($dataChild) == 1)
// 					{
// 						echo "Jeu de donn&eacute;es fils : ";
// 					}
// 					// S'il y en a plusieurs
// 					else
// 					{
// 						echo "Jeux de donn&eacute;es fils : ";
// 					}
// 					for($i=0;$i<sizeof($dataChild);$i++)
// 					{
// 						$segments = array('detailresultat', 'dataset', $dataChild[$i]->IdData);
// 						echo "<a href='".site_url($segments)."'>".trim($dataChild[$i]->NameData)."</a>";
// 						// Si ce n'est pas la dernière
// 						if ($i < sizeof($dataChild)-1)
// 						{
// 							echo ", ";
// 						}
// 					}
// 					echo "<br/>";
// 				}
				// Géographie
// 				if (isset($geo))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Informations g&eacute;ographiques</span> :";
// 					echo "<ul>";
// 					// On affiche les infos seulement si elles existent
// 					if ($geo->NameContinent != "")
// 					{
// 						echo "<li>Continents : ".$geo->NameContinent."</li>";
// 					}
// 					if ($geo->NameCountry != "")
// 					{
// 						echo "<li>Pays : ".$geo->NameCountry."</li>";
// 					}
// 					if ($geo->PrecisionGeo != "")
// 					{
// 						echo "<li>Pr&eacute;cision : ".$geo->PrecisionGeo."</li>";
// 					}
// 					if ($geo->LatMin != 0 && $geo->LatMax != 0 && $geo->LongMin != 0 && $geo->LongMax != 0)
// 					{
// 						echo "<li>Bounding box : Lat(".$geo->LatMin." - ".$geo->LatMax.")/Long(".$geo->LongMin." - ".$geo->LongMax.")</li>";
// 					}
// 					echo "</ul>";
// 				}
				// Taxonomie
// 				if (isset($taxo))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Informations taxonomiques</span> :";
// 					echo "<ul>";
// 					// On affiche les infos seulement si elles existent
// 					if ($taxo->KingdomTaxo != "")
// 					{
// 						echo "<li>R&egrave;gne : ".$taxo->KingdomTaxo."</li>";
// 					}
// 					if ($taxo->PhylumTaxo != "")
// 					{
// 						echo "<li>Phylum : ".$taxo->PhylumTaxo."</li>";
// 					}
// 					if ($taxo->ClassTaxo != "")
// 					{
// 						echo "<li>Classe : ".$taxo->ClassTaxo."</li>";
// 					}
// 					if ($taxo->OrderTaxo != "")
// 					{
// 						echo "<li>Ordre : ".$taxo->OrderTaxo."</li>";
// 					}
// 					/* Pour le moment, on va pas plus précis que l'ordre
// 					if ($taxo->FamilyTaxo != "")
// 					{
// 						echo "<li>Famille : ".$taxo->FamilyTaxo."</li>";
// 					}
// 					if ($taxo->GenusTaxo != "")
// 					{
// 						echo "<li>Genre : ".$taxo->GenusTaxo."</li>";
// 					}
// 					if ($taxo->SpecieTaxo != "")
// 					{
// 						echo "<li>Esp&egrave;ce : ".$taxo->SpecieTaxo."</li>";
// 					}	*/
// 					if ($taxo->PrecisionTaxo != "")
// 					{
// 						echo "<li>Pr&eacute;cision : ".$taxo->PrecisionTaxo."</li>";
// 					}
// 					if ($taxo->CommonName != "")
// 					{
// 						echo "<li>Noms communs : ".$taxo->CommonName."</li>";
// 					}
// 					echo "</ul>";
// 				}
				// Temporel
// 				if (isset($tempo))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Informations temporelles</span> :";
// 					echo "<ul>";
// 					// On affiche les infos seulement si elles existent
// 					if ($tempo->TextFossil != "")
// 					{
// 						echo "<li>P&eacute;riode fossile : ".$tempo->TextFossil."</li>";
// 					}
// 					if ($tempo->CenturyAncient != "")
// 					{
// 						echo "<li>P&eacute;riode ancienne : ".$tempo->CenturyAncient."</li>";
// 					}
// 					if ($tempo->YearCurrent != "")
// 					{
// 						echo "<li>P&eacute;riode actuelle : ".$tempo->YearCurrent."</li>";
// 					}
// 					echo "</ul>";
// 				}
				// Méthodes
// 				if (isset($methode))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>M&eacute;thodes</span> :";
// 					echo "<ul>";
// 					if ($methode->CollecteMeth != "")
// 					{
// 						echo "<li>De collecte : ".$methode->CollecteMeth."</li>";
// 					}
// 					if ($methode->PreservationMeth != "")
// 					{
// 						echo "<li>De pr&eacute;servation : ".$methode->PreservationMeth."</li>";
// 					}
// 					if ($methode->QualityControl != "")
// 					{
// 						echo "<li>Contr&ocirc;le qualit&eacute; : ".$methode->QualityControl."</li>";
// 					}
// 					echo "</ul>";
// 				}
// 				// Projet de recherche
// 				if (isset($projet))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Projets de recherche</span> :";
// 					echo "<ul>";
// 					// Il peut y en avoir plusieurs
// 					for($i=0;$i<sizeof($projet);$i++)
// 					{
// 						echo "<li>Projet ".($i+1);
// 						echo "<ul>";
// 						echo "<li>Titre : ".$projet[$i]->TitleProject."</li>";
// 						echo "<li>Domaine : ".$projet[$i]->DomainProject."</li>";
// 						echo "<li>Description : ".$projet[$i]->DescriptionProjet."</li>";
// 						echo "<li>Fonds : ".$projet[$i]->FundsProject."</li>";
// 						echo "</ul></li>";
// 					}
// 					echo "</ul>";
// 				}
				// Biblio
// 				if (isset($biblio))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Bibliographie</span> :";
// 					echo "<ul>";
// 					// Il peut y en avoir plusieurs
// 					for($i=0;$i<sizeof($biblio);$i++)
// 					{
// 						echo "<li>".trim($biblio[$i]->TypeRessource)." : ".$biblio[$i]->RefBiblio."</li>";
// 					}
// 					echo "</ul>";
// 				}
				// Stockage
// 				if (!empty($stock->physique) || $stock->FormatSupport != "" || !empty($stock->bdd))
// 				{
// 					echo "<br/><span style='text-decoration:underline'>Stockage</span> :";
// 					echo "<ul>";
// 					if (!empty($stock->physique))
// 					{
// 						echo "<li>Estimation de la taille";
// 						for($i=0;$i<sizeof($stock->physique);$i++)
// 						{
// 							echo "<ul>";
// 							echo "<li>".$stock->physique[$i]->phys."</li>";
// 							echo "</ul>";
// 						}
// 						echo "</li>";
// 					}
// 					if ($stock->FormatSupport != "")
// 					{
// 						echo "<li>Formats de support : ".$stock->FormatSupport."</li>";
// 					}
// 					if (!empty($stock->bdd))
// 					{
// 						echo "<li>Base de donn&eacute;es";
// 						for($i=0;$i<sizeof($stock->bdd);$i++)
// 						{
// 							echo "<ul>";
// 							echo "<li>Niveau d'informatisation : ".$stock->bdd[$i]->NivInformatisation."</li>";
// 							if (!empty($stock->bdd[$i]->UrlDatabase))
// 							{
// 								echo "<li>URL accessible : ".$stock->bdd[$i]->UrlDatabase."</li>";
// 							}
// 							echo "</ul>";
// 						}
// 						echo "</li>";
// 					}
// 					echo "</ul>";
// 				}
			}
			
			// Affichage des personnes associées à un dataset
// 			if (isset($persData))
// 			{
// 				echo "<h4>Personnel</h4>";
// 				echo "<ul>";
// 				// On parcourt la liste des personnes
// 				for($i=0;$i<sizeof($persData);$i++)
// 				{
// 					// On affiche le lien vers la personne
// 					$segments = array('detailresultat', 'pers', $persData[$i]->IdPersonne);
// 					echo "<li><a href='".site_url($segments)."'>".trim($persData[$i]->SurNamePers)." ".trim($persData[$i]->FirstNamePers)."</a> (r&ocirc;le : ".trim($persData[$i]->NameRole).")</li>";
// 				}
// 				echo "</ul>";
// 			}
			
			// Affichage des infos de la personne
// 			if (isset($pers))
// 			{
// 				echo "Nom : ".trim($pers->PrefixPers)." ".trim($pers->SurNamePers)." ".trim($pers->FirstNamePers)."<br/>";
// 				// On n'affiche les années que s'il y a eu décès
// 				if ($pers->DeathYear != NULL)
// 				{
// 					echo "(".trim($pers->BirthYear)." - ".trim($pers->DeathYear).")<br/>";
// 				}
// 				echo "Email : ".$pers->EmailPers."<br/>";
// 				echo "Tel : ".$pers->PhonePers."<br/>";
// 				echo "Adresse : ".$pers->AddressPers."<br/>";
// 			}
			
			// Affichage des datasets associés à une personne
// 			if (isset($datasetPers))
// 			{
// 				echo "<h4>Jeux de donn&eacute;es</h4>";
// 				echo "<ul>";
// 				// On parcourt la liste des dataset
// 				for($i=0;$i<sizeof($datasetPers);$i++)
// 				{
// 					// S'il n'y a pas de dataset père
// 					if ($datasetPers[$i]->IdDataParent == 0)
// 					{
// 						// On affiche le lien vers le dataset
// 						$segments = array('detailresultat', 'dataset', $datasetPers[$i]->IdData);
// 						echo "<li><a href='".site_url($segments)."'>".trim($datasetPers[$i]->NameData)."</a> (r&ocirc;le : ".trim($role).")</li><ul>";
// 						// Ensuite, on parcourt à nouveau la liste des dataset pour chercher les dataset fils
// 						for($j=0;$j<sizeof($datasetPers);$j++)
// 						{
// 							if ($datasetPers[$j]->IdDataParent == $datasetPers[$i]->IdData)
// 							{
// 								$segments = array('detailresultat', 'dataset', $datasetPers[$j]->IdData);
// 								echo "<li><a href='".site_url($segments)."'>".trim($datasetPers[$j]->NameData)."</a> (r&ocirc;le : ".trim($role).")</li>";
// 							}
// 						}
// 						echo "</ul>";
// 					}
// 				}
// 				echo "</ul>";
// 			}
		}
	?>
</div>
