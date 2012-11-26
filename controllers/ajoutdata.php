<?php
class Ajoutdata extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Nouveau jeu de donn&eacute;es ajout&eacute;";
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
			$this->form_validation->set_rules('prefixPers','prefix Personne','max_length[10]');
			$this->form_validation->set_rules('nomPers','nom Personne','required|max_length[20]');
			$this->form_validation->set_rules('prenomPers','prenom Personne','required|max_length[20]');
			$this->form_validation->set_rules('naissancePers','naissance Personne','integer|max_length[4]');
			$this->form_validation->set_rules('decesPers','deces Personne','integer|max_length[4]');
			$this->form_validation->set_rules('mailPers','mail Personne','valid_email|max_length[50]');
			$this->form_validation->set_rules('telPers','tel Personne','integer|max_length[20]');
			$this->form_validation->set_rules('adressePers','adresse Personne','max_length[150]');
			$this->form_validation->set_rules('IdRole','IdRole','required');
		
			if ($this->form_validation->run() == FALSE)
			{
				// On récupère les champs des listes déroulantes
				$this->load->model('Bdd_select');
				// Type dataset
				$data['typedata'] = $this->Bdd_select->list_typeData();
				// Nature dataset
				$data['naturedata'] = $this->Bdd_select->list_natureData();
				// Institutions
				$data['inst'] = $this->Bdd_select->list_inst();
				// Dataset pour le dataset père
				$data['dataset'] = $this->Bdd_select->list_dataset();
				// Continent
				$data['contient'] = $this->Bdd_select->list_continent();
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
				// On charge la vue avec tous ces éléments
				$this->load->view('ajout', $data);
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
				$prenomPers = $_POST['prenomPers'];
				$nomPers = $_POST['nomPers'];
				$prefixPers = $_POST['prefixPers'];
				$naissancePers = $_POST['naissancePers'];
				$decesPers = $_POST['decesPers'];
				$mailPers = $_POST['mailPers'];
				$telPers = $_POST['telPers'];
				$adressePers = $_POST['adressePers'];
				$IdRole = $_POST['IdRole'];
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
							$tab_phylum[] = $this->Bdd_insert->add_phylum($_POST['newphylum']);
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
							$tab_class[] = $this->Bdd_insert->add_class($_POST['newclasse']);
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
							$tab_order[] = $this->Bdd_insert->add_order($_POST['newordre']);
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
									$tab_ancient[] = $this->Bdd_insert->add_ancient($_POST['newAncient']);
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
									$tab_current[] = $this->Bdd_insert->add_current($_POST['newCurrent']);
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
		
				// On fait l'ajout dans la bdd
				// Création du dataset
				$data['id'] = $this->Bdd_insert->add_dataset($gbif, $gbiffr, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature);
				// On associe l'agent à ce jeu de donnée
				$this->Bdd_insert->add_agentdata($data['id'], $this->session->userdata('id'));
				// Création géographie si besoin
				if(isset($_POST['IdContinent']) || isset($_POST['IdCountry']) || $precisiongeo != '' || $latmin != 0 || $latmax != 0 || $longmin != 0 || $longmax != 0)
				{
					$this->Bdd_insert->add_geographie($precisiongeo, $latmin, $latmax, $longmin, $longmax, $data['id'], $tab_continent, $tab_pays);
				}
				// Création taxonomie si besoin
				if(isset($_POST['IdKingdom']) || isset($_POST['IdPhylum']) || isset($_POST['IdClass']) || isset($_POST['IdOrder']) || $precisiontaxo != '' || $nomcommun != '')
				{
					$this->Bdd_insert->add_taxonomy($precisiontaxo, $nomcommun, $data['id'], $tab_kingdom, $tab_phylum, $tab_class, $tab_order);
				}
				// Création temporel si besoin
				if(isset($_POST['temporel']))
				{
					$this->Bdd_insert->add_temporal($fossil, $data['id'], $tab_ancient, $tab_current);
				}
				// Création methodes si besoin
				if($collecte != '' || $preservation != '' || $quality != '')
				{
					$this->Bdd_insert->add_method($collecte, $preservation, $quality, $data['id']);
				}
				// Création stockage si besoin
				if(count($tab_support) != 0 || $tab_physical['nb'] != '' || $tab_database['nivinfo'] != '')
				{
					$this->Bdd_insert->add_stockage($data['id'], $tab_support, $tab_physical, $tab_database);
				}
				// Création project si besoin
				if($titleP != '' || $domainP != '' || $descP != '' || $fundsP != '' )
				{
					$this->Bdd_insert->add_project($titleP, $domainP, $descP, $fundsP, $data['id']);
				}
				// Création biblio si besoin
				if($refB != '' || $typeB != '')
				{
					$this->Bdd_insert->add_biblio($refB, $typeB, $data['id']);
				}
				// Création personnes
				$this->Bdd_insert->add_pers($prenomPers, $nomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole, $data['id']);
		
				// On passe l'agent en droit = 2 s'il était à 1
				if ($this->session->userdata('droits') == 1)
				{
					$this->Bdd_insert->modif_agentdroit($this->session->userdata('id'), 2);
					// On met à jour la session
					$newdata = array('droits' => 2);
					$this->session->set_userdata($newdata);
				}
				// On stocke le nom du dataset pour le passer à la vue
				$data['name'] = $_POST['nomData'];
		
				// On charge la vue.
				$this->load->view('ajoutdata', $data);
			}
		}
		// Footer
		$this->load->view('footer');
	}

}
