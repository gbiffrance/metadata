<?php
class Bdd_insert extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
		
		/*
		Liste des fonctions :
			add_agent($name, $pass, $email, $orga)
			add_town($name)
			add_institution($name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type)
			add_agentinst($idinst, $idagent)
			add_dataset($gbif, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature)
			add_agentdata($iddata, $idagent)
			add_geographie($precision, $latmin, $latmax, $longmini, $longmax, $iddata, $tab_continent, $tab_pays)
			add_kingdom($name)
			add_phylum($name)
			add_class($name)
			add_order($name)
			add_taxonomy($precision, $nomcommun, $iddata, $tab_kingdom, $tab_phylum, $tab_class, $tab_order)
			add_ancient($century)
			add_current($year)
			add_temporal($fossil, $iddata, $tab_ancient, $tab_current, $tab_time=NULL)
			add_method($collecte, $preservation, $quality, $iddata)
			add_stockage($iddata, $tab_support, $tab_physical, $tab_database)
			add_project($title, $domain, $desc, $funds, $iddata)
			add_biblio($ref, $type, $iddata)
			add_pers(($nomPers, $prenomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole, $iddata)
			modif_agentdroit($id, $droit)
			update_agent($idagent, $nom, $mail, $nameOrga, $pass=NULL)
			update_institution($id, $name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type)
			update_dataset($idData, $gbif, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature)
			update_geographie($idG, $precisiongeo, $latmin, $latmax, $longmin, $longmax, $tab_continent, $tab_pays)
			update_taxonomy($idTaxo, $precisiontaxo, $nomcommun, $tab_kingdom, $tab_phylum, $tab_class, $tab_order)
			update_temporal($idTempo, $fossil, $tab_ancient, $tab_current)
			update_method($idM, $collecte, $preservation, $quality)
			update_stockage($idData, $tab_support, $tab_physical, $tab_database)
			update_project($idP, $titleP, $domainP, $descP, $fundsP)
			update_biblio($idB, $refB, $typeB)
			update_pers($idPers, $nomPers, $prenomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole)
			delete_agentinst($idinst, $idagent)
			delete_agentdata($iddata, $idagent)
		*/
		
		/*
		Passage postgres -> Mysql
		champs et table protégés par \" -> `
		operateur || -> CONCAT()
		array_to_string(array_agg("champs"), 'séparateur') -> GROUP_CONCAT()
		*/
		
		function add_agent($name, $pass, $email, $orga)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			$email = $this->db->escape($email);
			$orga = $this->db->escape($orga);
			// On hash le mot de passe
			$this->load->model('Bdd_select');
			$pass = $this->Bdd_select->hash_mdp($pass);
			// On construit la requête avec le droit minimum
			$requete = "INSERT INTO \"Agent\" VALUES (DEFAULT, $name, '$pass', $email, $orga, 1) RETURNING \"IdAgent\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_town($name)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Town\" VALUES (DEFAULT, $name) RETURNING \"IdTown\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id de la ville
			return $this->db->insert_id();
		}
		
		function add_institution($name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			$desc = $this->db->escape($desc);
			$sigle = $this->db->escape($sigle);
			$adresse = $this->db->escape($adresse);
			$codepost = $this->db->escape($codepost);
			$phone = $this->db->escape($phone);
			$email = $this->db->escape($email);
			$logo = $this->db->escape($logo);
			$url = $this->db->escape($url);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Institution\" VALUES (DEFAULT, $name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown)  RETURNING \"IdInst\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idinst = $this->db->insert_id();
			// On rempli la table Type_Inst
			foreach ($tab_type as $item)
			{
				$requete = "INSERT INTO \"Type_Inst\" VALUES ($idinst, $item)";
				$query = $this->db->query($requete);
			}
			// On retourne l'id de l'institution
			return $idinst;
		}
		
		function add_agentinst($idinst, $idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "INSERT INTO \"Agent_Inst\" VALUES ($idinst, $idagent)";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function add_dataset($gbif, $gbiffr, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$gbif = $this->db->escape($gbif);
			$name = $this->db->escape($name);
			$desc = $this->db->escape($desc);
			$droits = $this->db->escape($droits);
			$but = $this->db->escape($but);
			$onttype = $this->db->escape($onttype);	
			$gbiffr = $this->db->escape($gbiffr);	
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Dataset\" VALUES (DEFAULT, $gbif, $name, $desc, $droits, $but, $onttype, current_date, current_date, $iddataparent, $idtype, $idinst, $gbiffr)  RETURNING \"IdData\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$iddata = $this->db->insert_id();
			// On rempli la table Nature_Data
			foreach ($tab_nature as $item)
			{
				$requete = "INSERT INTO \"Nature_Data\" VALUES ($iddata, $item)";
				$query = $this->db->query($requete);
			}
			// On retourne l'id du dataset
			return $iddata;
		}
		
		function add_agentdata($iddata, $idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "INSERT INTO \"Agent_Data\" VALUES ($idagent, $iddata)";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function add_geographie($precision, $latmin, $latmax, $longmin, $longmax, $iddata, $tab_continent, $tab_pays)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$precision = $this->db->escape($precision);	
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($latmin) || $latmin == '')
			{
				$latmin = 0;
			}
			if (empty($latmax) || $latmax == '')
			{
				$latmax = 0;
			}
			if (empty($longmin) || $longmin == '')
			{
				$longmin = 0;
			}
			if (empty($longmax) || $longmax == '')
			{
				$longmax = 0;
			}
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Geographie\" VALUES (DEFAULT, $precision, $latmin, $latmax, $longmin, $longmax, $iddata)  RETURNING \"IdGeo\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idgeo = $this->db->insert_id();
			// On rempli la table Continent_Geo
			foreach ($tab_continent as $item)
			{
				$requete = "INSERT INTO \"Continent_Geo\" VALUES ($idgeo, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table Country_Geo
			foreach ($tab_pays as $item)
			{
				// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
				$item = $this->db->escape($item);	
				$requete = "INSERT INTO \"Country_Geo\" VALUES ($idgeo, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function add_kingdom($name)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Kingdom\" VALUES (DEFAULT, $name) RETURNING \"IdKingdom\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_phylum($name)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Phylum\" VALUES (DEFAULT, $name) RETURNING \"IdPhylum\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_class($name)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Class\" VALUES (DEFAULT, $name) RETURNING \"IdClass\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_order($name)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Order\" VALUES (DEFAULT, $name) RETURNING \"IdOrder\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_taxonomy($precision, $nomcommun, $iddata, $tab_kingdom, $tab_phylum, $tab_class, $tab_order)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$precision = $this->db->escape($precision);	
			$nomcommun = $this->db->escape($nomcommun);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Taxonomy\" VALUES (DEFAULT, $precision, $nomcommun, $iddata)  RETURNING \"IdTaxo\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idtaxo = $this->db->insert_id();
			// On rempli la table Kingdom_Taxo
			foreach ($tab_kingdom as $item)
			{
				$requete = "INSERT INTO \"Kingdom_Taxo\" VALUES ($idtaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table Phylum_Taxo
			foreach ($tab_phylum as $item)
			{
				$requete = "INSERT INTO \"Phylum_Taxo\" VALUES ($idtaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table Class_Taxo
			foreach ($tab_class as $item)
			{
				$requete = "INSERT INTO \"Class_Taxo\" VALUES ($idtaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table Order_Taxo
			foreach ($tab_order as $item)
			{
				$requete = "INSERT INTO \"Order_Taxo\" VALUES ($idtaxo, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function add_ancient($century)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$century = $this->db->escape($century);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Ancient\" VALUES (DEFAULT, $century) RETURNING \"IdAncient\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_current($year)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$year = $this->db->escape($year);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Current\" VALUES (DEFAULT, $year) RETURNING \"IdCurrent\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne l'id
			return $this->db->insert_id();
		}
		
		function add_temporal($fossil, $iddata, $tab_ancient, $tab_current, $tab_time=NULL)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$fossil = $this->db->escape($fossil);	
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Temporal\" VALUES (DEFAULT, $fossil, $iddata) RETURNING \"IdTempo\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idtempo = $this->db->insert_id();
			// On rempli la table Time_Tempo : inutilisé
			/*foreach ($tab_time as $item)
			{
				$requete = "INSERT INTO \"Time_Tempo\" VALUES ($idtempo, $item)";
				$query = $this->db->query($requete);
			}*/
			// On rempli la table Ancient_Tempo
			foreach ($tab_ancient as $item)
			{
				$requete = "INSERT INTO \"Ancient_Tempo\" VALUES ($idtempo, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table Current_Tempo
			foreach ($tab_current as $item)
			{
				$requete = "INSERT INTO \"Current_Tempo\" VALUES ($idtempo, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function add_method($collecte, $preservation, $quality, $iddata)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$collecte = $this->db->escape($collecte);	
			$preservation = $this->db->escape($preservation);
			$quality = $this->db->escape($quality);
			// On construit la requête
			$requete = "INSERT INTO \"Methods\" VALUES (DEFAULT, $collecte, $preservation, $quality, $iddata)";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function add_stockage($iddata, $tab_support, $tab_physical, $tab_database)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Stockage\" VALUES (DEFAULT, $iddata) RETURNING \"IdStock\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idstock = $this->db->insert_id();
			// On rempli la table Support_Stock
			foreach ($tab_support as $item)
			{
				$requete = "INSERT INTO \"Support_Stock\" VALUES ($idstock, $item)";
				$query = $this->db->query($requete);
			}
			// On rempli la table PhysicalSize
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$nb = $tab_physical['nb'];
			$unit = $this->db->escape($tab_physical['unit']);		
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($nb) || $nb == '')
			{
				$nb = 0;
			}
			// On construit la requête
			$requete = "INSERT INTO \"PhysicalSize\" VALUES (DEFAULT, $nb, $unit, $idstock)";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On rempli la table infoDatabase
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$url = $this->db->escape($tab_database['url']);	
			$langage = $this->db->escape('');	
			$niv = $this->db->escape($tab_database['nivinfo']);	
			// On construit la requête
			$requete = "INSERT INTO \"InfoDatabase\" VALUES (DEFAULT, $url, $langage, $niv, $idstock)";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function add_project($title, $domain, $desc, $funds, $iddata)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$title = $this->db->escape($title);	
			$domain = $this->db->escape($domain);
			$desc = $this->db->escape($desc);
			$funds = $this->db->escape($funds);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"ProjectResearch\" VALUES (DEFAULT, $title, $domain, $desc, $funds) RETURNING \"IdProject\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idproject = $this->db->insert_id();
			// On rempli la table Project_Data
			$requete = "INSERT INTO \"Project_Data\" VALUES ($iddata, $idproject)";
			$query = $this->db->query($requete);
		}
		
		function add_biblio($ref, $type, $iddata)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$ref = $this->db->escape($ref);	
			$type = $this->db->escape($type);
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Biblio\" VALUES (DEFAULT, $ref, $type) RETURNING \"IdBiblio\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idbiblio = $this->db->insert_id();
			// On rempli la table Project_Data
			$requete = "INSERT INTO \"Biblio_Data\" VALUES ($iddata, $idbiblio)";
			$query = $this->db->query($requete);
		}
		
		function add_pers($nomPers, $prenomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole, $iddata)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$prenomPers = $this->db->escape($prenomPers);
			$nomPers = $this->db->escape($nomPers);
			$prefixPers = $this->db->escape($prefixPers);
			$mailPers = $this->db->escape($mailPers);
			$telPers = $this->db->escape($telPers);
			$adressePers = $this->db->escape($adressePers);
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($naissancePers) || $naissancePers == '')
			{
				$naissancePers = 0;
			}
			if (empty($decesPers) || $decesPers == '')
			{
				$decesPers = 0;
			}
			// On construit la requête qui retourne l'id associé
			$requete = "INSERT INTO \"Personne\" VALUES (DEFAULT, $nomPers, $prenomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole) RETURNING \"IdPersonne\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère l'id
			$idpers = $this->db->insert_id();
			// On rempli la table Project_Data
			$requete = "INSERT INTO \"Data_Pers\" VALUES ($idpers, $iddata)";
			$query = $this->db->query($requete);
		}

		function modif_agentdroit($id, $droit)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "UPDATE \"Agent\" SET \"IdDroit\" = $droit WHERE \"IdAgent\" = $id";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_agent($idagent, $nom, $mail, $nameOrga, $pass=NULL)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$nom = $this->db->escape($nom);
			$mail = $this->db->escape($mail);
			$nameOrga = $this->db->escape($nameOrga);
			// On construit la requête
			$requete = "UPDATE \"Agent\" 
										SET \"NameAgent\" = $nom, 
										\"EmailAgent\" = $mail, 
										\"NameOrga\" = $nameOrga";
			if(isset($pass))
			{
				$requete .= ", \"PassAgent\" = $pass";
			}
			$requete .= "WHERE \"IdAgent\" = $idagent";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_institution($id, $name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$name = $this->db->escape($name);
			$desc = $this->db->escape($desc);
			$sigle = $this->db->escape($sigle);
			$adresse = $this->db->escape($adresse);
			$codepost = $this->db->escape($codepost);
			$phone = $this->db->escape($phone);
			$email = $this->db->escape($email);
			$logo = $this->db->escape($logo);
			$url = $this->db->escape($url);
			// On construit la requête
			$requete = "UPDATE \"Institution\" 
										SET \"NameInst\" = $name,
										\"DescriptionInst\" = $desc,
										\"SigleInst\" = $sigle,
										\"AddressInst\" = $adresse,
										\"PostalCode\" = $codepost,
										\"PhoneInst\" = $phone,
										\"EmailInst\" = $email,
										\"LogoUrlInst\" = $logo,
										\"UrlInst\" = $url,
										\"IdInstParent\" = $idinstparent,
										\"IdRegion\" = $idregion,
										\"IdTown\" = $idtown
										WHERE \"IdInst\" = $id";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On maj la table Type_Inst
			// On delete les idtype déjà associés à cette institution (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Type_Inst\" WHERE \"IdInst\" = $id";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux 
			foreach ($tab_type as $item)
			{
				$requete = "INSERT INTO \"Type_Inst\" VALUES ($id, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function update_dataset($idData, $gbif, $gbiffr, $name, $desc, $droits, $but, $onttype, $iddataparent, $idtype, $idinst, $tab_nature)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$gbif = $this->db->escape($gbif);
			$name = $this->db->escape($name);
			$desc = $this->db->escape($desc);
			$droits = $this->db->escape($droits);
			$but = $this->db->escape($but);
			$onttype = $this->db->escape($onttype);
			$gbiffr = $this->db->escape($gbiffr);
			// On construit la requête
			$requete = "UPDATE \"Dataset\" 
										SET \"IdGbif\" = $gbif,
										\"IdGbifFrance\" = $gbiffr,
										\"NameData\" = $name,
										\"DescriptionData\" = $desc,
										\"Rights\" = $droits,
										\"Purpose\" = $but,
										\"HaveType\" = $onttype,
										\"UpdateDateData\" = current_date,
										\"IdDataParent\" = $iddataparent,
										\"IdTypeData\" = $idtype,
										\"IdInst\" = $idinst
										WHERE \"IdData\" = $idData";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On maj la table Nature_data
			// On delete les idnature déjà associés à ce dataset (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Nature_Data\" WHERE \"IdData\" = $idData";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux 
			foreach ($tab_nature as $item)
			{
				$requete = "INSERT INTO \"Nature_Data\" VALUES ($idData, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function update_geographie($idG, $precisiongeo, $latmin, $latmax, $longmin, $longmax, $tab_continent, $tab_pays)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$precisiongeo = $this->db->escape($precisiongeo);	
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($latmin) || $latmin == '')
			{
				$latmin = 0;
			}
			if (empty($latmax) || $latmax == '')
			{
				$latmax = 0;
			}
			if (empty($longmin) || $longmin == '')
			{
				$longmin = 0;
			}
			if (empty($longmax) || $longmax == '')
			{
				$longmax = 0;
			}
			// On construit la requête
			$requete = "UPDATE \"Geographie\" 
										SET \"PrecisionGeo\" = $precisiongeo,
										\"LatMin\" = $latmin,
										\"LatMax\" = $latmax,
										\"LongMin\" = $longmin,
										\"LongMax\" = $longmax
										WHERE \"IdGeo\" = $idG";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On maj la table Continent_Geo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Continent_Geo\" WHERE \"IdGeo\" = $idG";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux 
			foreach ($tab_continent as $item)
			{
				$requete = "INSERT INTO \"Continent_Geo\" VALUES ($idG, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table Country_Geo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Country_Geo\" WHERE \"IdGeo\" = $idG";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux 
			foreach ($tab_pays as $item)
			{
				// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
				$item = $this->db->escape($item);	
				$requete = "INSERT INTO \"Country_Geo\" VALUES ($idG, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function update_taxonomy($idTaxo, $precisiontaxo, $nomcommun, $tab_kingdom, $tab_phylum, $tab_class, $tab_order)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$precisiontaxo = $this->db->escape($precisiontaxo);	
			$nomcommun = $this->db->escape($nomcommun);
			// On construit la requête
			$requete = "UPDATE \"Taxonomy\"
										SET \"PrecisionTaxo\" = $precisiontaxo,
										\"CommonName\" = $nomcommun
										WHERE \"IdTaxo\" = $idTaxo";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On maj la table Kingdom_Taxo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Kingdom_Taxo\" WHERE \"IdTaxo\" = $idTaxo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux 
			foreach ($tab_kingdom as $item)
			{
				$requete = "INSERT INTO \"Kingdom_Taxo\" VALUES ($idTaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table Phylum_Taxo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Phylum_Taxo\" WHERE \"IdTaxo\" = $idTaxo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_phylum as $item)
			{
				$requete = "INSERT INTO \"Phylum_Taxo\" VALUES ($idTaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table Class_Taxo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Class_Taxo\" WHERE \"IdTaxo\" = $idTaxo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_class as $item)
			{
				$requete = "INSERT INTO \"Class_Taxo\" VALUES ($idTaxo, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table Order_Taxo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Order_Taxo\" WHERE \"IdTaxo\" = $idTaxo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_order as $item)
			{
				$requete = "INSERT INTO \"Order_Taxo\" VALUES ($idTaxo, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function update_temporal($idTempo, $fossil, $tab_ancient, $tab_current)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$fossil = $this->db->escape($fossil);	
			// On construit la requête
			$requete = "UPDATE \"Temporal\"
										SET \"TextFossil\" = $fossil
										WHERE \"IdTempo\" = $idTempo";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On maj la table Ancient_Tempo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Ancient_Tempo\" WHERE \"IdTempo\" = $idTempo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_ancient as $item)
			{
				$requete = "INSERT INTO \"Ancient_Tempo\" VALUES ($idTempo, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table Current_Tempo
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Current_Tempo\" WHERE \"IdTempo\" = $idTempo";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_current as $item)
			{
				$requete = "INSERT INTO \"Current_Tempo\" VALUES ($idTempo, $item)";
				$query = $this->db->query($requete);
			}
		}
		
		function update_method($idM, $collecte, $preservation, $quality)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$collecte = $this->db->escape($collecte);	
			$preservation = $this->db->escape($preservation);
			$quality = $this->db->escape($quality);
			// On construit la requête
			$requete = "UPDATE \"Methods\"
										SET \"CollecteMeth\" = $collecte, 
										\"PreservationMeth\" = $preservation, 
										\"QualityControl\" = $quality
										WHERE \"IdMethod\" = $idM";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_stockage($idData, $tab_support, $tab_physical, $tab_database)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On select un idStock pour ce jeu de données
			$requete = "SELECT \"IdStock\" FROM \"Stockage\" WHERE \"IdData\" = $idData";
			$query = $this->db->query($requete);
			$row = $query->row();
			$idstock = $row->IdStock;
			// On maj la table Support_Stock
			// On delete ceux déjà associés (plus simple que comparer id par id s'il faut garder, rajouter ou delete)
			$requete = "DELETE FROM \"Support_Stock\" WHERE \"IdStock\"IN (SELECT \"IdStock\" FROM \"Stockage\" WHERE \"IdData\" = $idData)";
			$query = $this->db->query($requete);
			// On rajoute les nouveaux
			foreach ($tab_support as $item)
			{
				// On fait la requete d'ajout
				$requete = "INSERT INTO \"Support_Stock\" VALUES ($idstock, $item)";
				$query = $this->db->query($requete);
			}
			// On maj la table PhysicalSize
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			if(isset($tab_physical['id']))
			{
				$idPhys = $tab_physical['id'];
			}
			$nb = $tab_physical['nb'];
			$unit = $this->db->escape($tab_physical['unit']);		
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($nb) || $nb == '')
			{
				$nb = 0;
			}
			// On construit la requête
			// Si maj à faire
			if(isset($tab_physical['id']))
			{
				$requete = "UPDATE \"PhysicalSize\" 
											SET \"NumberElement\" = $nb, 
											\"UnitOfMesure\" = $unit
											WHERE \"IdPhysicalSize\" = $idPhys";
			}
			else
			{
				$requete = "INSERT INTO \"PhysicalSize\" VALUES (DEFAULT, $nb, $unit, $idstock)";
			}	
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On rempli la table infoDatabase
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			if(isset($tab_database['id']))
			{
				$idDbb = $tab_database['id'];
			}
			$url = $this->db->escape($tab_database['url']);	
			$langage = $this->db->escape('');	
			$niv = $this->db->escape($tab_database['nivinfo']);	
			// On construit la requête
			// Si maj à faire
			if(isset($tab_database['id']))
			{
				$requete = "UPDATE \"InfoDatabase\" 
											SET \"UrlDatabase\" = $url, 
											\"LangageDatabase\" = $langage, 
											\"NivInformatisation\" = $niv
											WHERE \"IdInfoDatabase\" = $idDbb";
			}
			else
			{
				$requete = "INSERT INTO \"InfoDatabase\" VALUES (DEFAULT, $url, $langage, $niv, $idstock)";
			}
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_project($idP, $titleP, $domainP, $descP, $fundsP)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$titleP = $this->db->escape($titleP);	
			$domainP = $this->db->escape($domainP);
			$descP = $this->db->escape($descP);
			$fundsP = $this->db->escape($fundsP);
			// On construit la requête
			$requete = "UPDATE \"ProjectResearch\" 
										SET \"TitleProject\" = $titleP, 
										\"DomainProject\" = $domainP, 
										\"DescriptionProjet\" = $descP,
										\"FundsProject\" = $fundsP
										WHERE \"IdProject\" = $idP";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_biblio($idB, $refB, $typeB)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$refB = $this->db->escape($refB);	
			$typeB = $this->db->escape($typeB);
			// On construit la requête
			$requete = "UPDATE \"Biblio\"
										SET \"RefBiblio\" = $refB, 
										\"TypeRessource\" = $typeB
										WHERE \"IdBiblio\" = $idB";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function update_pers($idPers, $nomPers, $prenomPers, $prefixPers, $naissancePers, $decesPers, $mailPers, $telPers, $adressePers, $IdRole)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les variables (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$prenomPers = $this->db->escape($prenomPers);
			$nomPers = $this->db->escape($nomPers);
			$prefixPers = $this->db->escape($prefixPers);
			$mailPers = $this->db->escape($mailPers);
			$telPers = $this->db->escape($telPers);
			$adressePers = $this->db->escape($adressePers);
			// On initialise les variables numériques à 0 si elles sont vide.
			if (empty($naissancePers) || $naissancePers == '')
			{
				$naissancePers = 0;
			}
			if (empty($decesPers) || $decesPers == '')
			{
				$decesPers = 0;
			}
			// On construit la requête
			$requete = "UPDATE \"Personne\"
										SET \"SurNamePers\" = $nomPers, 
										\"FirstNamePers\" = $prenomPers, 
										\"PrefixPers\" = $prefixPers, 
										\"BirthYear\" = $naissancePers, 
										\"DeathYear\" = $decesPers, 
										\"EmailPers\" = $mailPers, 
										\"PhonePers\" = $telPers, 
										\"AddressPers\" = $adressePers, 
										\"IdRole\" = $IdRole
										WHERE \"IdPersonne\" = $idPers";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function delete_agentinst($idinst, $idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "DELETE FROM \"Agent_Inst\" WHERE \"IdAgent\" = $idagent AND \"IdInst\" = $idinst";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
		
		function delete_agentdata($iddata, $idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "DELETE FROM \"Agent_Data\" WHERE \"IdAgent\" = $idagent AND \"IdData\" = $iddata";
			// On contacte la bdd
			$query = $this->db->query($requete);
		}
}
?>
