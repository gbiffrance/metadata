<?php
class Modifdata extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Jeu de donn&eacute;es modifi&eacute;";
		$dataH['log'] = "oui";
		$this->load->view('header', $dataH);
		
		// Body
		if ($this->session->userdata('username') == FALSE)
		{
			$data['error'] = "Vous devez &ecirc;tre connect&eacute; pour acc&egrave;der &agrave; cette page.";
			$this->load->view('connexion', $data);
		}
		else
		{
			$this->load->model('Bdd_insert');
			$this->load->model('Bdd_select');
			// Validation formulaire
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
			$this->form_validation->set_rules('inst','Institution','required');
			$this->form_validation->set_rules('nomData','Nom','required|max_length[100]');
			$this->form_validation->set_rules('idGbif','Identifiant GBIF','numeric');
			$this->form_validation->set_rules('idGbifFrance','Identifiant GBIF France','numeric');
			$this->form_validation->set_rules('descData','Description','required');
			$this->form_validation->set_rules('rights','Droits','');
			$this->form_validation->set_rules('purpose','But','');
			$this->form_validation->set_rules('type','onttype','required');
			$this->form_validation->set_rules('IdTypeData','Type','required');
			$this->form_validation->set_rules('IdNature[]','Nature','required');
			$this->form_validation->set_rules('parentData','parentData','');
			$this->form_validation->set_rules('IdContinent[]','Continent','');
			$this->form_validation->set_rules('IdCountry[]','Pays','');
			$this->form_validation->set_rules('precisiongeo','precisiongeo','');
			$this->form_validation->set_rules('latmin','Latitude min','numeric|max_length[10]');
			$this->form_validation->set_rules('latmax','Latitude max','numeric|max_length[10]');
			$this->form_validation->set_rules('longmin','Longitude min','numeric|max_length[10]');
			$this->form_validation->set_rules('longmax','Longitude max','numeric|max_length[10]');
			$this->form_validation->set_rules('IdKingdom[]','Regne','');
			$this->form_validation->set_rules('IdPhylum[]','Phylum','');
			$this->form_validation->set_rules('newphylum','newphylum','');
			$this->form_validation->set_rules('IdClass[]','Classe','');
			$this->form_validation->set_rules('newclasse','newclasse','');
			$this->form_validation->set_rules('IdOrder[]','Ordre','');
			$this->form_validation->set_rules('newordre','newordre','');
			$this->form_validation->set_rules('precisiontaxo','precisiontaxo','');
			$this->form_validation->set_rules('nomcommun','nomcommun','');
			$this->form_validation->set_rules('temporel[]','temporel','');
			$this->form_validation->set_rules('newfossile','Fossile','');
			$this->form_validation->set_rules('IdAncien[]','Ancien','');
			$this->form_validation->set_rules('newAncient','newAncient','');
			$this->form_validation->set_rules('IdActuel[]','Actuel','');
			$this->form_validation->set_rules('newCurrent','newCurrent','');
			$this->form_validation->set_rules('collecte','collecte','');
			$this->form_validation->set_rules('preservation','preservation','');
			$this->form_validation->set_rules('qualite','qualite','');
			$this->form_validation->set_rules('titreP','titre Projet','max_length[20]');
			$this->form_validation->set_rules('domaineP','domaine Projet','max_length[20]');
			$this->form_validation->set_rules('descP','desc Projet','');
			$this->form_validation->set_rules('fondP','fonds Projet','');
			$this->form_validation->set_rules('refB','ref Biblio','');
			$this->form_validation->set_rules('typeB','type Biblio','');
			$this->form_validation->set_rules('nb','nombre du stockage physique','integer');
			$this->form_validation->set_rules('unit','unit&eacute; du stockage physique','max_length[50]');
			$this->form_validation->set_rules('IdSupport[]','IdSupport[]','');
			$this->form_validation->set_rules('urlbdd','url de la base de donn&eacute;esbdd','max_length[100]|valid_url');
			$this->form_validation->set_rules('nivinfo','niveau informatisation','max_length[10]');
			// On initialise la variable nb personne pour le premier appel du formulaire
			$nbPers = 1;
			if(isset($_POST['nbPers']))
			{
				$nbPers = $_POST['nbPers'];
			}
			// On crée les règles pour toutes les personnes
			for($i=1;$i<=$nbPers;$i++)
			{
				$this->form_validation->set_rules('prefixPers'.$i,'prefix '.$i.'eme Personne','max_length[10]');
				$this->form_validation->set_rules('nomPers'.$i,'nom '.$i.'eme Personne','required|max_length[20]');
				$this->form_validation->set_rules('prenomPers'.$i,'prenom '.$i.'eme Personne','required|max_length[20]');
				$this->form_validation->set_rules('naissancePers'.$i,'naissance '.$i.'eme Personne','integer|max_length[4]');
				$this->form_validation->set_rules('decesPers'.$i,'deces '.$i.'eme Personne','integer|max_length[4]');
				$this->form_validation->set_rules('mailPers'.$i,'mail '.$i.'eme Personne','valid_email|max_length[50]');
				$this->form_validation->set_rules('telPers'.$i,'tel '.$i.'eme Personne','integer|max_length[20]');
				$this->form_validation->set_rules('adressePers'.$i,'adresse '.$i.'eme Personne','max_length[150]');
				$this->form_validation->set_rules('IdRole'.$i,'IdRole '.$i.'eme','required');
			}
		
			if ($this->form_validation->run() == FALSE)
			{
				// On récupère les champs des listes déroulantes
				// Type dataset
				$data['typedata'] = $this->Bdd_select->list_typeData();
				// Nature dataset
				$data['naturedata'] = $this->Bdd_select->list_natureData();
				// Institutions
				$data['inst'] = $this->Bdd_select->list_inst();
				// Dataset pour le dataset père
				$data['dataset'] = $this->Bdd_select->list_dataset();
				// Continent
				$data['continent'] = $this->Bdd_select->list_continent();
				// Pays
				$data['pays'] = $this->Bdd_select->list_pays();
				// Royaume taxonomie
				$data['kingdom'] = $this->Bdd_select->list_kingdom();
				// Phylum taxonomie
				$data['phylum'] = $this->Bdd_select->list_phylum();
				// Classe taxonomie
				$data['class'] = $this->Bdd_select->list_class();
				// Ordre taxonomie
				$data['ordertaxo'] = $this->Bdd_select->list_orderTaxo();
				// Temporel
				$data['temporel'] = $this->Bdd_select->list_Time();
				$data['ancient'] = $this->Bdd_select->list_Ancient();
				$data['current'] = $this->Bdd_select->list_Current();
				// Support
				$data['support'] = $this->Bdd_select->list_Support();
				// Rôle personnes
				$data['role'] = $this->Bdd_select->list_Role();
		
				// On récupère les infos du dataset
				$id = $_POST['idData'];
				$data['data'] = $this->Bdd_select->get_infoData($id);		
				// Sur les personnes
				$persId = $this->Bdd_select->get_persData($id);
				foreach ($persId as $pers)
				{
					$data['personneD'][] = $this->Bdd_select->get_infoPers($pers->IdPersonne);
				}
		
				// Sur les autres éléments
				$data['natureD'] = $this->Bdd_select->get_natureData($id);
				$data['geoD'] = $this->Bdd_select->get_infoGeo($id);
				$data['taxoD'] = $this->Bdd_select->get_infoTaxo($id);
				$data['tempoD'] = $this->Bdd_select->get_infoTempo($id);
				$data['methD'] = $this->Bdd_select->get_infoMethode($id);
				$data['ProjetD'] = $this->Bdd_select->get_infoProjet($id);
				$data['BiblioD'] = $this->Bdd_select->get_infoBiblio($id);
				$data['StockD'] = $this->Bdd_select->get_infoStock($id);

				// On charge la vue avec tous ces éléments
				$this->load->view('modification', $data);
			}
			else
			{
				// On récupère tous les résultats de $_POST
				$idinst = $_POST['inst'];
				$name = $_POST['nomData'];
				$gbif = $_POST['idGbif'];
				$gbiffr = $_POST['idGbifFrance'];
				$desc = $_POST['descData'];
				$droits = $_POST['rights'];
				$but = $_POST['purpose'];
				$onttype = $_POST['type'];
				$idtype = $_POST['IdTypeData'];
				$iddataparent = $_POST['parentData'];
				$collecte = $_POST['collecte'];
				$preservation = $_POST['preservation'];
				$quality = $_POST['qualite'];
				$titleP = $_POST['titreP'];
				$domainP = $_POST['domaineP'];
				$descP = $_POST['descP'];
				$fundsP = $_POST['fondP'];
				$refB = $_POST['refB'];
				$typeB = $_POST['typeB'];
				$tab_physical['nb'] = $_POST['nb'];
				$tab_physical['unit'] = $_POST['unit'];
				$tab_database['url'] = $_POST['urlbdd'];
				//$tab_database['langage'] = $_POST['langagebdd'];
				$tab_database['nivinfo'] = $_POST['nivinfo'];
				$precisiongeo = $_POST['precisiongeo'];
				$latmin = $_POST['latmin'];
				$latmax = $_POST['latmax'];
				$longmin = $_POST['longmin'];
				$longmax = $_POST['longmax'];
				$precisiontaxo = $_POST['precisiontaxo'];
				$nomcommun = $_POST['nomcommun'];
				// Pour les personnes
				$nbPers = $_POST['nbPers'];
				for($i=1;$i<=$nbPers;$i++)
				{
					$tab_pers[$i] = array (
						'prenom' => $_POST['prenomPers'.$i],
						'nom' => $_POST['nomPers'.$i],
						'prefix' => $_POST['prefixPers'.$i],
						'naissance' => $_POST['naissancePers'.$i],
						'deces' => $_POST['decesPers'.$i],
						'mail' => $_POST['mailPers'.$i],
						'tel' => $_POST['telPers'.$i],
						'adresse' => $_POST['adressePers'.$i],
						'IdRole' => $_POST['IdRole'.$i]
					);
				}
				// On déclare les tableaux vide
				$tab_continent = array();
				$tab_pays = array();
				$tab_kingdom = array();
				$tab_phylum = array();
				$tab_class = array();
				$tab_order = array();
				$tab_ancient = array();
				$tab_current = array();
				$tab_support = array();
				// On les rempli éventuellement
				foreach($_POST['IdNature'] as $value)
				{
					$tab_nature[] = $value;
				}
				if(isset($_POST['IdContinent']))
				{
					foreach($_POST['IdContinent'] as $value)
					{
						$tab_continent[] = $value;
					}
				}
				if(isset($_POST['IdCountry']))
				{
					foreach($_POST['IdCountry'] as $value)
					{
						$tab_pays[] = $value;
					}
				}
				if(isset($_POST['IdKingdom']))
				{
					foreach($_POST['IdKingdom'] as $value)
					{
						$tab_kingdom[] = $value;
					}
				}
				if(isset($_POST['IdPhylum']))
				{
					foreach($_POST['IdPhylum'] as $value)
					{
						// Si nouveau
						if ($value == 0)
						{
							// On vérifie que le nouveau nom n'est pas déjà dans la base
							// On récupère tous les noms
							$tab_temp = $this->Bdd_select->list_phylum();
							$exist = 0;
							// On teste si le nouveau nom existe déjà dans la base
							foreach($tab_temp as $item2)
							{
								// Si oui, on stocke l'Id
								if(strcasecmp($item2['PhylumTaxo'], $_POST['newphylum']) == 0)
								{
									$tab_phylum[] = $item2['IdPhylum'];
									$exist = 1;
								}
							}
							// Si non, on le rajoute
							if($exist == 0)
							{
								$tab_phylum[] = $this->Bdd_insert->add_phylum($_POST['newphylum']);
							}
						}
						else
						{
							$tab_phylum[] = $value;
						}
					}
				}
				if(isset($_POST['IdClass']))
				{
					foreach($_POST['IdClass'] as $value)
					{
						// Si nouveau
						if ($value == 0)
						{
							// On vérifie que le nouveau nom n'est pas déjà dans la base
							// On récupère tous les noms
							$tab_temp = $this->Bdd_select->list_class();
							$exist = 0;
							// On teste si le nouveau nom existe déjà dans la base
							foreach($tab_temp as $item2)
							{
								// Si oui, on stocke l'Id
								if(strcasecmp($item2['ClassTaxo'], $_POST['newclasse']) == 0)
								{
									$tab_class[] = $item2['IdClass'];
									$exist = 1;
								}
							}
							// Si non, on le rajoute
							if($exist == 0)
							{
								$tab_class[] = $this->Bdd_insert->add_class($_POST['newclasse']);
							}
						}
						else
						{
							$tab_class[] = $value;
						}
					}
				}
				if(isset($_POST['IdOrder']))
				{
					foreach($_POST['IdOrder'] as $value)
					{
						// Si nouveau
						if ($value == 0)
						{
							// On vérifie que le nouveau nom n'est pas déjà dans la base
							// On récupère tous les noms
							$tab_temp = $this->Bdd_select->list_orderTaxo();
							$exist = 0;
							// On teste si le nouveau nom existe déjà dans la base
							foreach($tab_temp as $item2)
							{
								// Si oui, on stocke l'Id
								if(strcasecmp($item2['OrderTaxo'], $_POST['newordre']) == 0)
								{
									$tab_order[] = $item2['IdOrder'];
									$exist = 1;
								}
							}
							// Si non, on le rajoute
							if($exist == 0)
							{
								$tab_order[] = $this->Bdd_insert->add_order($_POST['newordre']);
							}
						}
						else
						{
							$tab_order[] = $value;
						}
					}
				}
				if(isset($_POST['temporel']))
				{
					foreach($_POST['temporel'] as $value)
					{
						$fossil = $_POST['newfossile'];
						// Si ancien
						if ($value == 'Ancien')
						{
							foreach($_POST['IdAncien'] as $value)
							{
								// Si nouveau
								if ($value == 0)
								{
									// On vérifie que le nouveau nom n'est pas déjà dans la base
									// On récupère tous les noms
									$tab_temp = $this->Bdd_select->list_Ancient();
									$exist = 0;
									// On teste si le nouveau nom existe déjà dans la base
									foreach($tab_temp as $item2)
									{
										// Si oui, on stocke l'Id
										if(strcasecmp($item2['CenturyAncient'], $_POST['newAncient']) == 0)
										{
											$tab_ancient[] = $item2['IdAncient'];
											$exist = 1;
										}
									}
									// Si non, on le rajoute
									if($exist == 0)
									{
										$tab_ancient[] = $this->Bdd_insert->add_ancient($_POST['newAncient']);
									}
								}
								else
								{
									$tab_ancient[] = $value;
								}
							}
						}
					// Si actuel
						elseif ($value == 'Actuel')
						{
							foreach($_POST['IdActuel'] as $value)
							{
								// Si nouveau
								if ($value == 0)
								{
									// On vérifie que le nouveau nom n'est pas déjà dans la base
									// On récupère tous les noms
									$tab_temp = $this->Bdd_select->list_Current();
									$exist = 0;
									// On teste si le nouveau nom existe déjà dans la base
									foreach($tab_temp as $item2)
									{
										// Si oui, on stocke l'Id
										if(strcasecmp($item2['YearCurrent'], $_POST['newCurrent']) == 0)
										{
											$tab_current[] = $item2['IdCurrent'];
											$exist = 1;
										}
									}
									// Si non, on le rajoute
									if($exist == 0)
									{
										$tab_current[] = $this->Bdd_insert->add_current($_POST['newCurrent']);
									}
								}
								else
								{
									$tab_current[] = $value;
								}
							}
						}
					}
				}
				if(isset($_POST['IdSupport']))
				{
					foreach($_POST['IdSupport'] as $value)
					{
						$tab_support[] = $value;
					}
				}
				$idData = $_POST['idData'];
				// On fait la maj dans la bdd
				// Maj du dataset
				$this->Bdd_insert->update_dataset($idData, $gbif, $gbiffr, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature);
				// Ajout ou maj géographie
				if(isset($_POST['idGeo']))
				{
					$idG = $_POST['idGeo'];
					$this->Bdd_insert->update_geographie($idG, $precisiongeo, $latmin, $latmax, $longmin, $longmax, $tab_continent, $tab_pays);
				}
				elseif(isset($_POST['IdContinent']) || isset($_POST['IdCountry']) || $precisiongeo != '' || $latmin != 0 || $latmax != 0 || $longmin != 0 || $longmax != 0)
				{
					$this->Bdd_insert->add_geographie($precisiongeo, $latmin, $latmax, $longmin, $longmax, $idData, $tab_continent, $tab_pays);
				}
				// Ajout ou maj taxonomie
				if(isset($_POST['idTaxo']))
				{
					$idTaxo = $_POST['idTaxo'];
					$this->Bdd_insert->update_taxonomy($idTaxo, $precisiontaxo, $nomcommun, $tab_kingdom, $tab_phylum, $tab_class, $tab_order);
				}
				elseif(isset($_POST['IdKingdom']) || isset($_POST['IdPhylum']) || isset($_POST['IdClass']) || isset($_POST['IdOrder']) || $precisiontaxo != '' || $nomcommun != '')
				{
					$this->Bdd_insert->add_taxonomy($precisiontaxo, $nomcommun, $idData, $tab_kingdom, $tab_phylum, $tab_class, $tab_order);
				}
				// Ajout ou maj temporel
				if(isset($_POST['idTempo']))
				{
					$idTempo = $_POST['idTempo'];
					$this->Bdd_insert->update_temporal($idTempo, $fossil, $tab_ancient, $tab_current);
				}
				elseif(isset($_POST['temporel']))
				{
					$this->Bdd_insert->add_temporal($fossil, $idData, $tab_ancient, $tab_current);
				}
				// Ajout ou maj methodes
				if(isset($_POST['idMeth']))
				{
					$idM = $_POST['idMeth'];
					$this->Bdd_insert->update_method($idM, $collecte, $preservation, $quality);
				}
				elseif($collecte != '' || $preservation != '' || $quality != '')
				{
					$this->Bdd_insert->add_method($collecte, $preservation, $quality, $idData);
				}
				// Ajout ou maj stockage
				if(isset($_POST['idPhysicalSize']) || isset($_POST['idInfoDatabase']))
				{
					if(isset($_POST['idPhysicalSize']))
					{
						$tab_physical['id'] = $_POST['idPhysicalSize'];
					}
					if(isset($_POST['idInfoDatabase']))
					{
						$tab_database['id'] = $_POST['idInfoDatabase'];
					}
					$this->Bdd_insert->update_stockage($idData, $tab_support, $tab_physical, $tab_database);
				}
				elseif(count($tab_support) != 0 || $tab_physical['nb'] != '' || $tab_database['nivinfo'] != '')
				{
					$this->Bdd_insert->add_stockage($idData, $tab_support, $tab_physical, $tab_database);
				}
				// Ajout ou maj project
				if(isset($_POST['idProject']))
				{
					$idP = $_POST['idProject'];
					$this->Bdd_insert->update_project($idP, $titleP, $domainP, $descP, $fundsP);
				}
				elseif($titleP != '' || $domainP != '' || $descP != '' || $fundsP != '' )
				{
					$this->Bdd_insert->add_project($titleP, $domainP, $descP, $fundsP, $idData);
				}
				// Ajout ou maj biblio
				if(isset($_POST['idBiblio']))
				{
					$idB = $_POST['idBiblio'];
					$this->Bdd_insert->update_biblio($idB, $refB, $typeB);
				}
				elseif($refB != '' || $typeB != '')
				{
					$this->Bdd_insert->add_biblio($refB, $typeB, $idData);
				}
				// Ajout ou maj personnes
				for($i=1;$i<=$nbPers;$i++)
				{
					if(isset($_POST['idPers'.$i]))
					{
						$idPers = $_POST['idPers'.$i];
						$this->Bdd_insert->update_pers($idPers,$tab_pers[$i]['nom'], $tab_pers[$i]['prenom'], $tab_pers[$i]['prefix'], $tab_pers[$i]['naissance'], $tab_pers[$i]['deces'], $tab_pers[$i]['mail'], $tab_pers[$i]['tel'], $tab_pers[$i]['adresse'], $tab_pers[$i]['IdRole']);
					}
					else
					{
						$this->Bdd_insert->add_pers($tab_pers[$i]['nom'], $tab_pers[$i]['prenom'], $tab_pers[$i]['prefix'], $tab_pers[$i]['naissance'], $tab_pers[$i]['deces'], $tab_pers[$i]['mail'], $tab_pers[$i]['tel'], $tab_pers[$i]['adresse'], $tab_pers[$i]['IdRole'], $data['id']);
					}
				}
		
				// On stocke le nom et l'id du dataset pour le passer à la vue
				$data['id'] = $_POST['idData'];
				$data['name'] = $_POST['nomData'];
		
				// On charge la vue.
				$this->load->view('ajoutdata', $data);
			}
		}
		
		// Footer
		$this->load->view('footer');
	}
}
