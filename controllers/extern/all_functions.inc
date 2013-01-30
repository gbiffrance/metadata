<?php
require("../../ci_core.php");


/// -------- COLLECTION FUNCTIONS --------
/*
 * Return instution ID which manage the collection corresponding to the given id.
 */
function collection_getInstID($coll_id)
{
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$data['dataset'] = $ci->Bdd_select->get_infoData($coll_id);
	
	return intval($data['dataset']->IdInst);
} // collection_getInstID

/*
 * Give all general info about the collection corresponding to the given id.
 */
function collection_result($coll_id)
{
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$ci->load->helper('url');
	$output="";
	
	if (!$ci->Bdd_select->get_infoData($coll_id)) // Si le dataset n'est pas trouvé
	{
		$data['error'] = "Le jeu de donn&eacute;e n'existe pas";
	}
	else
	{
		$data['dataset'] = $ci->Bdd_select->get_infoData($coll_id);
		// On recupere le type et la nature
		$data['typeData'] = $ci->Bdd_select->get_typeData($data['dataset']->IdTypeData);
		$data['nature'] = $ci->Bdd_select->get_natureData($coll_id);
		// On vérifie s'il y a un dataset parent
		if ($ci->Bdd_select->get_infoData($data['dataset']->IdDataParent))
		{
			$data['dataParent'] = $ci->Bdd_select->get_infoData($data['dataset']->IdDataParent);
		}
		// On verifie s'il y a des datasets fils
		if ($ci->Bdd_select->get_dataChild($coll_id))
		{
			$data['dataChild'] = $ci->Bdd_select->get_dataChild($coll_id);
		}
		// On recupere les infos de l'institution
		$data['inst'] = $ci->Bdd_select->get_infoInst($data['dataset']->IdInst);
		$data['type'] = $ci->Bdd_select->get_typeInst($data['dataset']->IdInst);
		$data['region'] = $ci->Bdd_select->get_regionInst($data['inst']->IdRegion);
		$data['town'] = $ci->Bdd_select->get_townInst($data['inst']->IdTown);
		// On verifie s'il y a une institution mère
		if ($ci->Bdd_select->get_infoInst($data['inst']->IdInstParent))
		{
			$data['instmere'] = $ci->Bdd_select->get_infoInst($data['inst']->IdInstParent);
		}
		// On vérifie s'il y a des institutions filles
		if ($ci->Bdd_select->get_instChild($data['dataset']->IdInst))
		{
			$data['instChild'] = $ci->Bdd_select->get_instChild($data['dataset']->IdInst);
		}
		
		$output.= "<span class='inst_titular'>Nom : </span>".$data['dataset']->NameData."<br/>\n";
		if($data['dataset']->DescriptionData) // Description
			$output.= "<span class='inst_titular'>Description : </span>".$data['dataset']->DescriptionData."<br/>\n";
		if($data['dataset']->Purpose) // But
			$output.= "<span class='inst_titular'>But : </span>".$data['dataset']->Purpose."<br/>\n";
		if($data['dataset']->Rights) // Droits d'utilisation
			$output.= "<span class='inst_titular'>Droits d'utilisation : </span>".$data['dataset']->Rights."<br/>\n";
		$gbif = trim($data['dataset']->IdGbif);
		$output.= "<span class='inst_titular'>Connect&eacute; au GBIF : </span>";
		if (!empty($gbif))
		{
			$output.= "<a href='http://data.gbif.org/datasets/resource/".$data['dataset']->IdGbif."' target='blank'>http://data.gbif.org/datasets/resource/".$data['dataset']->IdGbif."</a><br/>\n";
		}
		else
		{
			$output.= "Non<br/>\n";
		}
		$output.="<br />\n";
		
		if($data['nature']) // Nature
			$output.= "<span class='inst_titular'>Nature des donn&eacute;es : </span>".$data['nature']."<br/>\n";
		$output.= "<span class='inst_titular'>Poss&egrave;de des types : </span>";
		if ($data['dataset']->HaveType)
		{
			if ($data['dataset']->HaveType == "OUI")
			{
				$output.= "Oui<br/>\n";
			}
			else
			{
				$output.= "Non<br/>\n";
			}
		}
		else
		{
			$output.= "Non renseign&eacute;<br/>\n";
		}
		if($data['dataset']->Rights) // Droits d'utilisation
			$output.= "<span class='inst_titular'>Droits d'utilisation : </span>".$data['dataset']->Rights."<br/>\n";
		
		if($data['dataset']->CreationDateData) // Date de creation
			$output.= "<span class='inst_titular'>Date de cr&eacute;ation du jeu de donn&eacute;es dans l'annuaire : </span>".$data['dataset']->CreationDateData."<br/>\n";
		if($data['dataset']->UpdateDateData) // Mise a jour
			$output.= "<span class='inst_titular'>Date de mise à jour du jeu de donn&eacute;es dans l'annuaire : </span>".$data['dataset']->UpdateDateData."<br/>\n";
		
		// S'il existe un dataset père
		if (isset($data['dataParent']))
		{
			$segments = array('detailresultat', 'dataset', $data['dataParent']->IdData);
			$output.= "<span class='inst_titular'>Jeu de donn&eacute;es p&egrave;re : </span><a href='";
			$output.= site_url($segments)."'>".trim($data['dataParent']->NameData)."</a><br/>\n";
		}
		
		// S'il existe des dataset fils
		if (isset($data['dataChild']))
		{
			// S'il y en a qu'une
			if (sizeof($data['dataChild']) == 1)
			{
				$output.= "<span class='inst_titular'>Jeu de donn&eacute;es fils : </span>";
			}
			// S'il y en a plusieurs
			else
			{
				$output.= "<span class='inst_titular'>Jeux de donn&eacute;es fils : </span>";
			}
			for($i=0;$i<sizeof($data['dataChild']);$i++)
			{
				$segments = array('detailresultat', 'dataset', $data['dataChild'][$i]->IdData);
				$output.= "<a href='".site_url($segments)."'>".trim($data['dataChild'][$i]->NameData)."</a>";
				// Si ce n'est pas la dernière
				if ($i < sizeof($data['dataChild'])-1)
				{
					$output.=  ", ";
				}
			}
			$output.= "<br/>\n";
		}
	}

	return $output;
} // collection_result

/*
 * Give 'more details' (geo, taxo, method, biblio...) about the collection 
 * corresponding to the given id.
 */
function collection_details($coll_id)
{
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$ci->load->helper('url');
	$output="";
	
	// On recupere les infos geographiques
	if ($ci->Bdd_select->get_infoGeo($coll_id))
	{
		$data['geo'] = $ci->Bdd_select->get_infoGeo($coll_id);
	}
	// On recupere les infos taxonomiques
	if ($ci->Bdd_select->get_infoTaxo($coll_id))
	{
		$data['taxo'] = $ci->Bdd_select->get_infoTaxo($coll_id);
	}
	// On recupere les infos temporelles
	if ($ci->Bdd_select->get_infoTempo($coll_id))
	{
		$data['tempo'] = $ci->Bdd_select->get_infoTempo($coll_id);
	}
	// On recupere les methodes
	if ($ci->Bdd_select->get_infoMethode($coll_id))
	{
		$data['methode'] = $ci->Bdd_select->get_infoMethode($coll_id);
	}
	// On recupere les projets
	if ($ci->Bdd_select->get_infoProjet($coll_id))
	{
		$data['projet'] = $ci->Bdd_select->get_infoProjet($coll_id);
	}
	// On recupere la biblio
	if ($ci->Bdd_select->get_infoBiblio($coll_id))
	{
		$data['biblio'] = $ci->Bdd_select->get_infoBiblio($coll_id);
	}
	// On recupere les stock
	if ($ci->Bdd_select->get_infoStock($coll_id))
	{
		$data['stock'] = $ci->Bdd_select->get_infoStock($coll_id);
	}
	
	// Geographie
	if (isset($data['geo']))
	{
		$output.= "<br/><span class='inst_titular'>Informations g&eacute;ographiques</span>\n";
		$output.= "<ul>\n";
		// On affiche les infos seulement si elles existent
		if ($data['geo']->NameContinent != "")
		{
			$output.= "\t<li>Continents : ".$data['geo']->NameContinent."</li>\n";
		}
		if ($data['geo']->NameCountry != "")
		{
			$output.= "\t<li>Pays : ".$data['geo']->NameCountry."</li>\n";
		}
		if ($data['geo']->PrecisionGeo != "")
		{
			$output.= "\t<li>Pr&eacute;cision : ".$data['geo']->PrecisionGeo."</li>\n";
		}
		if ($data['geo']->LatMin != 0 && $data['geo']->LatMax != 0 && $data['geo']->LongMin != 0 && $data['geo']->LongMax != 0)
		{
			$output.= "\t<li>Bounding box : Lat(".$data['geo']->LatMin." - ".$data['geo']->LatMax.")/Long(".$data['geo']->LongMin." - ".$data['geo']->LongMax.")</li>\n";
		}
		$output.= "</ul>\n";
	}
	// Taxonomie
	if (isset($data['taxo']))
	{
		$output.= "<br/><span class='inst_titular'>Informations taxonomiques</span>\n";
		$output.= "<ul>\n";
		// On affiche les infos seulement si elles existent
		if ($data['taxo']->KingdomTaxo != "")
		{
			$output.= "\t<li>R&egrave;gne : ".$data['taxo']->KingdomTaxo."</li>\n";
		}
		if ($data['taxo']->PhylumTaxo != "")
		{
			$output.= "\t<li>Phylum : ".$data['taxo']->PhylumTaxo."</li>\n";
		}
		if ($data['taxo']->ClassTaxo != "")
		{
			$output.= "\t<li>Classe : ".$data['taxo']->ClassTaxo."</li>\n";
		}
		if ($data['taxo']->OrderTaxo != "")
		{
			$output.= "\t<li>Ordre : ".$data['taxo']->OrderTaxo."</li>\n";
		}
		/* Pour le moment, on va pas plus precis que l'ordre
		if ($data['taxo']->FamilyTaxo != "")
		{
			$output.= "\t<li>Famille : ".$data['taxo']->FamilyTaxo."</li>\n";
		}
		if ($data['taxo']->GenusTaxo != "")
		{
			$output.= "\t<li>Genre : ".$data['taxo']->GenusTaxo."</li>\n";
		}
		if ($data['taxo']->SpecieTaxo != "")
		{
			$output.= "\t<li>Esp&egrave;ce : ".$data['taxo']->SpecieTaxo."</li>\n";
		}	*/
		if ($data['taxo']->PrecisionTaxo != "")
		{
			$output.= "\t<li>Pr&eacute;cision : ".$data['taxo']->PrecisionTaxo."</li>\n";
		}
		if ($data['taxo']->CommonName != "")
		{
			$output.= "\t<li>Noms communs : ".$data['taxo']->CommonName."</li>\n";
		}
		$output.= "</ul>\n";
	}
	// Temporel
	if (isset($data['tempo']))
	{
		$output.= "<br/><span class='inst_titular'>Informations temporelles</span> :\n";
		$output.= "<ul>\n";
		// On affiche les infos seulement si elles existent
		if ($data['tempo']->TextFossil != "")
		{
			$output.= "\t<li>P&eacute;riode fossile : ".$data['tempo']->TextFossil."</li>\n";
		}
		if ($data['tempo']->CenturyAncient != "")
		{
			$output.= "\t<li>P&eacute;riode ancienne : ".$data['tempo']->CenturyAncient."</li>\n";
		}
		if ($data['tempo']->YearCurrent != "")
		{
			$output.= "\t<li>P&eacute;riode actuelle : ".$data['tempo']->YearCurrent."</li>\n";
		}
		$output.= "</ul>\n";
	}
	// Methodes
	if (isset($data['methode']))
	{
		$output.= "<br/><span class='inst_titular'>M&eacute;thodes</span> :\n";
		$output.= "<ul>\n";
		if ($data['methode']->CollecteMeth != "")
		{
			$output.= "\t<li>De collecte : ".$data['methode']->CollecteMeth."</li>\n";
		}
		if ($data['methode']->PreservationMeth != "")
		{
			$output.= "\t<li>De pr&eacute;servation : ".$data['methode']->PreservationMeth."</li>\n";
		}
		if ($data['methode']->QualityControl != "")
		{
			$output.= "\t<li>Contr&ocirc;le qualit&eacute; : ".$data['methode']->QualityControl."</li>\n";
		}
		$output.= "</ul>\n";
	}
	// Projet de recherche
	if (isset($data['projet']))
	{
		$output.= "<br/><span class='inst_titular'>Projets de recherche</span> :\n";
		$output.= "<ul>\n";
		// Il peut y en avoir plusieurs
		for($i=0;$i<sizeof($data['projet']);$i++)
		{
			$output.= "\t<li>Projet ".($i+1);
			$output.= "\t<ul>";
			$output.= "\t\t<li>Titre : ".$data['projet'][$i]->TitleProject."</li>\n";
			$output.= "\t\t<li>Domaine : ".$data['projet'][$i]->DomainProject."</li>\n";
			$output.= "\t\t<li>Description : ".$data['projet'][$i]->DescriptionProjet."</li>\n";
			$output.= "\t\t<li>Fonds : ".$data['projet'][$i]->FundsProject."</li>\n";
			$output.= "\t</ul></li>\n";
		}
		$output.= "</ul>\n";
	}
	// Biblio
	if (isset($data['biblio']))
	{
		$output.= "<br/><span class='inst_titular'>Ressources</span> :\n";
		$output.= "<ul>\n";
		// Il peut y en avoir plusieurs
		for($i=0;$i<sizeof($data['biblio']);$i++)
		{
			$output.= "\t<li>".trim($data['biblio'][$i]->TypeRessource)." : ".$data['biblio'][$i]->RefBiblio."</li>\n";
		}
		$output.= "</ul>\n";
	}
	// Stockage
	if (!empty($data['stock']->physique) || $data['stock']->FormatSupport != "" || !empty($data['stock']->bdd))
	{
		$output.= "<br/><span class='inst_titular'>Stockage</span> :\n";
		$output.= "<ul>\n";
		if (!empty($data['stock']->physique))
		{
			$output.= "<li>Estimation de la taille";
			for($i=0;$i<sizeof($data['stock']->physique);$i++)
			{
				$output.= "\t<ul>\n";
				$output.= "\t\t<li>".$data['stock']->physique[$i]->phys."</li>\n";
				$output.= "\t</ul>\n";
			}
			$output.= "\t</li>\n";
		}
		if ($data['stock']->FormatSupport != "")
		{
			$output.= "\t<li>Formats de support : ".$data['stock']->FormatSupport."</li>\n";
		}
		if (!empty($data['stock']->bdd))
		{
			$output.= "\t<li><span style='text-decoration:underline'>Base de donn&eacute;es</span>";
			for($i=0;$i<sizeof($data['stock']->bdd);$i++)
			{
				$output.= "\t<ul>\n";
				$output.= "\t\t<li>Niveau d'informatisation : ".$data['stock']->bdd[$i]->NivInformatisation."</li>\n";
				if (!empty($data['stock']->bdd[$i]->UrlDatabase))
				{
					$output.= "\t\t<li>URL accessible : ".$data['stock']->bdd[$i]->UrlDatabase."</li>\n";
				}
				$output.= "\t</ul>\n";
			}
			$output.= "\t</li>\n";
		}
		$output.= "</ul>\n";
	}
	
	return $output;
} // collection_details

/*
 * Get some informations about relative people involve in the collection
 */
function collection_person($coll_id)
{
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$ci->load->helper('url');
	$output="";
	
	// On récupère la liste des personnes
	if ($ci->Bdd_select->get_persData($coll_id))
	{
		$data['persData'] = $ci->Bdd_select->get_persData($coll_id);
	}
	
	if (isset($data['persData']))
	{
		$output.= "<div>\n";
		$output.= "\t<span class='inst_titular'>Personnes impliqu&eacute;es dans cette collection</span><br/>\n";
		$output.= "\t<ul>\n";
		// On parcourt la liste des personnes
		for($i=0;$i<sizeof($data['persData']);$i++)
		{
			// On affiche le lien vers la personne
			$segments = array('detailresultat', 'pers', $data['persData'][$i]->IdPersonne);
			$output.="\t\t<li><a href='".site_url($segments)."'>".trim($data['persData'][$i]->SurNamePers)." ".trim($data['persData'][$i]->FirstNamePers)."</a> (r&ocirc;le : ".trim($data['persData'][$i]->NameRole).")</li>\n";
		}
		$output.= "\t</ul>\n";
		$output.= "</div>\n";
	}
	else
	{
		$output.= "Aucune information sur le personnel impliqu&eacute; dans cette collection<br />\n";
	}
	
	return $output;
} // collection_person

/// -------- INSTITUTION FUNCTIONS --------
/*
 * Get collections number of the institution corresponding to the given ID.
*/
function num_collections ($inst_id) {
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$data['datasetInst'] = $ci->Bdd_select->get_datasetInst($inst_id);
	if (!$data['datasetInst'])
	{
		$data['error'] = "Aucune collection disponible pour cette institution";
		$num_colls = 0;
	}
	else
	{
		$num_colls = sizeof($data['datasetInst']);
	}
	
	return $num_colls;
} // num_collections

/*
 * Give all collections of the institution corresponding to the given id
*/
function list_collections ($inst_id) {
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$data['datasetInst'] = $ci->Bdd_select->get_datasetInst($inst_id);
	
	// Affichage des datasets associés à une institution
	if (!$data['datasetInst'])
	{
		return false;
	}
	else
	{
		$num_rows=sizeof($data['datasetInst']); // nb lines
		$pages=ceil($num_rows/10);  //  27/10=2
		$prop=intval($num_rows/$pages)+1;
		if ($num_rows<10) 
		{
			$pages=1;
			$prop=10;
		}
		
		$vals=array();
		for ($i=0; $i <= $pages; $i++)
		{
			$vals[$i]['group']=$i;
			$vals[$i]['label']="<ul id='".($i+1)."'>\n";
			$vals[$i]['min']=$i*$prop;
			$vals[$i]['max']=($i+1)*$prop;
		}
		$cur_page=0;
		$showColl_n=0;
		
		$colls = array(); // all pages code
		$cur_coll = ""; // current page code
		
		// On parcourt la liste des dataset
		for($i=0;$i<$num_rows;$i++)
		{
			if (intval($data['datasetInst'][$i]->IdDataParent == 0)) // S'il n'y a pas de dataset parent
			{
				if($showColl_n==$vals[$cur_page]['min']) // if first of current page
				{
					//$cur_coll="<li>".$cur_page."DEB-<a href='".site_url($segments)."'>".trim($data['datasetInst'][$i]->NameData)."</a></li>"; // TODO : REMOVE
					$cur_coll .= $vals[$cur_page]['label'];
				}
				
				// On affiche le lien vers le dataset
				$segments = array('detailresultat', 'dataset', $data['datasetInst'][$i]->IdData);
				$cur_coll.="<li><a href='".site_url($segments)."'>".trim($data['datasetInst'][$i]->NameData)."</a></li>\n";
				
				if($showColl_n==($vals[$cur_page]['max']-1) || $showColl_n==($num_rows-1)) // if last of current page or last one
				{
					//$cur_coll="<li><a href='".site_url($segments)."'>".trim($data['datasetInst'][$i]->NameData)."</a>-END".$cur_page."</li>"; // TODO : REMOVE
					$colls[] = $cur_coll."</ul>\n";
					$cur_coll = "";
					$cur_page++;
				}
				$showColl_n++;
				
				// Ensuite, on parcourt à nouveau la liste des dataset pour chercher les dataset fils
				for($j=0;$j<$num_rows;$j++)
				{
					if (intval($data['datasetInst'][$j]->IdDataParent == $data['datasetInst'][$i]->IdData))
					{
						if($showColl_n==$vals[$cur_page]['min']) // if first of current page
						{
							//$cur_coll="<li>".$cur_page."DEB-<a href='".site_url($segments)."'>".trim($data['datasetInst'][$j]->NameData)."</a></li>"; // TODO : REMOVE
							$cur_coll .= $vals[$cur_page]['label'];
						}
						
						// On affiche le lien vers le dataset
						$segments = array('detailresultat', 'dataset', $data['datasetInst'][$j]->IdData);
						$cur_coll.="<li><a href='".site_url($segments)."'>".trim($data['datasetInst'][$j]->NameData)."</a></li>";
						
						if($showColl_n==($vals[$cur_page]['max']-1) || $showColl_n==($num_rows-1)) // if last of current page or last one
						{
							//$cur_coll="<li><a href='".site_url($segments)."'>".trim($data['datasetInst'][$j]->NameData)."</a>-END".$cur_page."</li>"; // TODO : REMOVE
							$colls[] = $cur_coll."</ul>\n";
							$cur_coll = "";
							$cur_page++;
						}
						$showColl_n++;
					} // if
				} // for $j
			} // if
		} // for $i
	} // else
	
	return $colls;
} // list_collections

/*
 * Get all institution details from a given institution ID
*/
function institution_result ($inst_id, $isNameLink=false) {
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$ci->load->helper('url');
	
	// Get all informations from given institution
	if (!$ci->Bdd_select->get_infoInst($inst_id))
	{
		$data['error'] = "L'institution n'existe pas !";
	}
	else
	{
		$data['inst'] = $ci->Bdd_select->get_infoInst($inst_id);
		// On récupère le type
		$data['type'] = $ci->Bdd_select->get_typeInst($inst_id);
		// On récupère la région
		$data['region'] = $ci->Bdd_select->get_regionInst($data['inst']->IdRegion);
		// On récupère la ville
		$data['town'] = $ci->Bdd_select->get_townInst($data['inst']->IdTown);
		// On vérifie s'il y a des datasets
		if ($ci->Bdd_select->get_datasetInst($inst_id))
		{
			$data['datasetInst'] = $ci->Bdd_select->get_datasetInst($inst_id);
		}
		// On vérifie s'il y a une institution mère
		if ($ci->Bdd_select->get_infoInst($data['inst']->IdInstParent))
		{
			$data['instmere'] = $ci->Bdd_select->get_infoInst($data['inst']->IdInstParent);
		}
		// On vérifie s'il y a des institutions filles
		if ($ci->Bdd_select->get_instChild($inst_id))
		{
			$data['instChild'] = $ci->Bdd_select->get_instChild($inst_id);
		}
	} // ELSE
	
	// AFFICHAGE DES RESULTATS ----
	$info="";
	if ($data['inst']->LogoUrlInst != '') {
		$info.="<span class=\"logo_img\"><img src='".trim($data['inst']->LogoUrlInst)."' /></span><br/>\n";
	}
	if($isNameLink)
	{
		$info.= "<span class='inst_titular'>Nom: </span><a href='".site_url(array('detailresultat', 'inst', $data['inst']->IdInst))."'>".$data['inst']->NameInst."</a><br />\n";
	}
	else
	{
		$info.= "<span class='inst_titular'>Nom: </span>".$data['inst']->NameInst."<br />\n";
	}
	
	if($data['inst']->SigleInst)
		$info.= "<span class='inst_titular'>Sigle: </span>".$data['inst']->SigleInst."<br />\n";
	$info.= "<span class='inst_titular'>Type d'institution: </span>".$data['type']."<br />\n";
	
	if ($data['inst']->DescriptionInst) {
		$info.= "<span class='inst_titular'>Description: </span>".$data['inst']->DescriptionInst."<br />\n";
	}
	
	if ($data['inst']->UrlInst) {
		if (strncasecmp("http", $data['inst']->UrlInst, 4) != 0)
			$data['inst']->UrlInst='http://'.$data['inst']->UrlInst;
		$info.= "<span class='inst_titular'>URL: </span><a href=".$data['inst']->UrlInst." target='_blank'>".$data['inst']->UrlInst."</a><br />\n";
	}
	
	$info.="<br />\n";
	$info.= "<span class='inst_titular'>Adresse: </span>";
	$info.= trim($data['inst']->AddressInst)." ".trim($data['inst']->PostalCode)." ".$data['town']."<br />\n";
	if ($data['inst']->PhoneInst) 
		$info.= "<span class='inst_titular'>Tél: </span>".$data['inst']->PhoneInst."<br />\n";
	if ($data['inst']->EmailInst) {
		// if (ereg("@",$data['inst']->EmailInst)) // EREG function is deprecated !
		if (preg_match("/@/",$data['inst']->EmailInst))
			$info.= "<span class='inst_titular'>e-mail: </span><a href=mailto:".$data['inst']->EmailInst.">".$data['inst']->EmailInst."</a><br />\n";
		else
			$info.= "<span class='inst_titular'>e-mail: </span><a href=".$data['inst']->EmailInst." target='_blank'>".$data['inst']->EmailInst."</a><br />\n";
	}
	
	$info.="<br />\n";
	$info.= "<span class='inst_titular'>R&eacute;gion : </span>".$data['region']."<br/>\n";
	$info.= "<span class='inst_titular'>Nombre de collections : </span>".num_collections($inst_id)."<br />\n";
	
	// Look for a parent institution
	if (isset($data['instmere'])) {
		$parents=array('detailresultat', 'inst', $data['instmere']->IdInst);
		$info.= "<span class='inst_titular'>Institution m&egrave;re : </span><a href='".site_url($parents)."'>".trim($data['instmere']->NameInst)."</a> <br />\n";
	}
	
	// Look for child(s) institution(s)
	if (isset($data['instChild'])){
		if (sizeof($data['instChild']) == 1) // only one child
			$info.= "<span class='inst_titular'>Institution fille: </span><br />\n";
		else // several childs
			$info.= "<span class='inst_titular'>Institutions filles: </span><br />\n";

		for($i=0;$i<sizeof($data['instChild']);$i++)
		{
			$childs = array('detailresultat', 'inst', $data['instChild'][$i]->IdInst);
			$info.= "<span style='padding-left:40px;display:block'><a href='".site_url($childs)."'>".trim($data['instChild'][$i]->NameInst)."</a></span>\n";
		} // for $i
	} // if isset

	$info.="<br />\n";
	
	return $info;
} // institution_result

/// -------- PERSON FUNCTIONS --------
/*
 * Get datasets number of the person corresponding to the given ID.
*/
function num_dataset_person ($pers_id) {
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$data['datasetPers'] = $ci->Bdd_select->get_datasetPers($pers_id);
	
	if (!$data['datasetPers'])
	{
		// Aucune collection disponible pour cette personne
		$num_datasets = 0;
	}
	else
	{
		$num_datasets = sizeof($data['datasetPers']);
	}
	
	return $num_datasets;
} // num_dataset_person

/*
 * Get informations about person
 */
function person_information($pers_id)
{
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	
	$info = '';
	
	if (!$ci->Bdd_select->get_infoPers($pers_id))
	{
		$data['error'] = "La personne n'existe pas";	
	}
	else
	{
		$data['pers'] = $ci->Bdd_select->get_infoPers($pers_id);
// 		// On recupere le role
// 		$data['role'] = $ci->Bdd_select->get_rolePers($data['pers']->IdRole);
		// On verifie s'il y a des datasets
		if ($ci->Bdd_select->get_datasetPers($pers_id))
		{
			$data['datasetPers'] = $ci->Bdd_select->get_datasetPers($pers_id);
		}
	}
	
	$info.= "<span class='inst_titular'>Nom: </span>".trim($data['pers']->PrefixPers)." ".trim($data['pers']->SurNamePers)." ".trim($data['pers']->FirstNamePers);
	// On n'affiche les années que s'il y a eu décès
	if ($data['pers']->DeathYear != NULL)
	{
		$info.= " (".trim($data['pers']->BirthYear)." - ".trim($data['pers']->DeathYear).")";
	}
	$info.= "<br />\n";
	if($data['pers']->EmailPers)
		$info.= "<span class='inst_titular'>Email : </span>".$data['pers']->EmailPers."<br/>\n";
	if($data['pers']->PhonePers)
		$info.= "<span class='inst_titular'>T&eacute;l : </span>".$data['pers']->PhonePers."<br/>\n";
	if($data['pers']->AddressPers)
		$info.= "<span class='inst_titular'>Adresse : </span>".$data['pers']->AddressPers."<br/>\n";
	$info.= "<span class='inst_titular'>Nombre de jeux de donn&eacute;es associ&eacute;s : </span>".num_dataset_person($pers_id)."<br/>\n";
	
	return $info;
} // person_information

/*
 * Get all datasets of a person
 */
function person_dataset($pers_id)
{
	$info = '';
	$ci = get_instance();
	$ci->load->model('Bdd_select');
	$ci->load->helper('url');
	
	if ($ci->Bdd_select->get_infoPers($pers_id))
	{
		$data['pers'] = $ci->Bdd_select->get_infoPers($pers_id);
		$data['role'] = $ci->Bdd_select->get_rolePers($data['pers']->IdRole); // On recupere le role
	}
	$data['datasetPers'] = $ci->Bdd_select->get_datasetPers($pers_id);
	
	// Affichage des datasets associés à une personne
	if (isset($data['datasetPers']))
	{
		$info.= "<ul>\n";
		// On parcourt la liste des dataset
		for($i=0;$i<sizeof($data['datasetPers']);$i++)
		{
			// On affiche le lien vers le dataset
			$segments = array('detailresultat', 'dataset', $data['datasetPers'][$i]->IdData);
			$info.= "\t<li><a href='".site_url($segments)."'>".trim($data['datasetPers'][$i]->NameData)."</a> (r&ocirc;le : ".trim($data['role']).")</li>\n";
			$info.= "\t<ul>\n";
			// Ensuite, on parcourt à nouveau la liste des dataset pour chercher les dataset fils
			for($j=0;$j<sizeof($data['datasetPers']);$j++)
			{
				if (intval($data['datasetPers'][$j]->IdDataParent == $data['datasetPers'][$i]->IdData))
				{
					$segments = array('detailresultat', 'dataset', $data['datasetPers'][$j]->IdData);
					$info.= "\t\t<li><a href='".site_url($segments)."'>".trim($data['datasetPers'][$j]->NameData)."</a> (r&ocirc;le : ".trim($data['role']).")</li>\n";
				}
			}
			$info.= "\t</ul>\n";
		}
		$info.= "</ul>\n";
	}
	
	return $info;
} // person_dataset

?>
