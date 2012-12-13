<?php
class Bdd_select extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
		
		/*
		Liste des fonctions :
			get_infoAgent($email)
			hash_mdp($pass)	
			count_inst()
			count_dataset($type)
			count_instRegion()
			count_instType()
			count_instData()
			count_dataType()
			count_dataGbif()
			list_typeInst()
			list_typeData()
			list_region()
			list_ville()
			list_natureData()
			list_continent()
			list_pays()
			list_kingdom()
			list_phylum()
			list_class()
			list_orderTaxo()
			list_family()
			list_genus()
			list_specie()
			list_inst($idagent)
			list_dataset($idagent)
			list_instnonagent($idagent)
			list_datasetnonagent($idagent)
			list_Time()
			list_Ancient()
			list_Current()
			list_Support()
			list_Role()
			list_agents()
			list_droits()
			search_inst($motcle, $alpha='', $limit='ALL', $limdebut=0)
			search_data($motcle)
			search_pers($motcle)
			search_avance($motcle)
			get_infoInst($id)
			get_typeInst($id)
			get_regionInst($id)
			get_townInst($id)
			get_datasetInst($id)
			get_instChild($id)
			get_infoPers($id)
			get_rolePers($id)
			get_datasetPers($id)
			get_infoData($id)
			get_typeData($id)
			get_natureData($id)
			get_dataChild($id)
			get_infoGeo($id)
			get_infoTaxo($id)
			get_taxonomy($rang, $id)
			get_infoTempo($id)
			get_infoMethode($id)
			get_infoProjet($id)
			get_infoBiblio($id)
			get_infoStock($id)
			get_persData($id)
		*/
		
		/*
		Passage postgres -> Mysql
		champs et table protégés par \" -> 
		operateur double pipe -> CONCAT()
		array_to_string(array_agg("champs"), 'séparateur') -> GROUP_CONCAT()
		LIMIT {number1|ALL} OFFSET number2 -> LIMIT number2, number1
		*/
		
		function get_infoAgent($email)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$email = $this->db->escape($email);
			// On construit la requête
			$requete = "SELECT * FROM \"Agent\" WHERE \"EmailAgent\" = ".$email;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
		function hash_mdp($pass)
		{
			/* Pas encore géré dans la base
			// On défini un "grain de sel"
			$salt = "Gb!|=";
			// On inverse le mot de passe (1ère lettre devient dernière, 2ème devient avant-dernière, etc)
			$pass_inv = strrev($pass);
			// On ajoute le grain de sel au mot de passe inversé
			$pass_salt = $salt.$pass_inv;
			// On hash le tout avec sha1
			$pass_hash = sha1($pass_salt);
			return $pass_hash;
			*/
			$pass = sha1($pass);
			return $pass;
		}
		
		function count_inst()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT count(*) AS \"compte\" FROM \"Institution\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère le résultat
			$row = $query->row();
			// On retourne la réponse
			return $row->compte;
		}
		
		function count_dataset($type)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT count(*) AS \"compte\" FROM \"Dataset\"";
			// On regarde si il y a une condition et quelle est-elle
			if (isset($type))
			{
				// On récupère les types de dataset existant
				$typedata = $this->list_typeData();
				// On regarde si le type de dataset est celui voulu
				foreach ($typedata as $item)
				{
					// si oui, on met une condition dans la requête
					if (trim($item['NameTypeData']) == $type)
					{
						$requete .= " WHERE \"IdTypeData\" = ".$item['IdTypeData'];
					}
				}
				// On libère la variable
				unset ($item);
			}
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère le résultat
			$row = $query->row();
			// On retourne la réponse
			return $row->compte;
		}
		
		function count_instRegion()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT \"NameRegion\", requete.count
									FROM \"Region\"
									LEFT JOIN (SELECT \"IdRegion\", COUNT(\"IdInst\") as count
															FROM \"Institution\"
															GROUP BY \"IdRegion\") as requete
									ON requete.\"IdRegion\" = \"Region\".\"IdRegion\"
									ORDER BY \"NameRegion\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			return $query->result_array();
		}
		
		function count_instType()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT \"NameTypeInst\", COUNT(\"Type_Inst\".\"IdInst\") as count
										FROM \"Type_Inst\", \"TypeInstitution\", \"Institution\"
										WHERE \"Type_Inst\".\"IdInst\" = \"Institution\".\"IdInst\"
										AND \"Type_Inst\".\"IdTypeInst\" = \"TypeInstitution\".\"IdTypeInst\"
										GROUP BY \"NameTypeInst\"
										ORDER BY \"NameTypeInst\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			return $query->result_array();
		}
		
		function count_instData()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			// On récupère  : nombre d'institution possédant nombre dataset
			$requete = "SELECT COUNT(\"NameInst\") as nbInst, nbData
										FROM (SELECT \"NameInst\", COUNT(\"Institution\".\"IdInst\") as nbData
													FROM \"Dataset\", \"Institution\"
													WHERE \"Dataset\".\"IdInst\" = \"Institution\".\"IdInst\"
													GROUP BY \"NameInst\"
													ORDER BY nbData) as DataInst
										GROUP BY DataInst.nbData";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			return $query->result_array();
		}
		
		function count_dataType()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT \"NameTypeData\", COUNT(\"IdData\") as count
										FROM \"Dataset\", \"TypeDataset\"
										WHERE \"Dataset\".\"IdTypeData\" = \"TypeDataset\".\"IdTypeData\"
										GROUP BY \"NameTypeData\"
										ORDER BY \"NameTypeData\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			return $query->result_array();
		}
		
		function count_dataNature()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT \"NameNature\", COUNT(\"Nature_Data\".\"IdData\") as count
										FROM \"Nature_Data\", \"Dataset\", \"NatureData\"
										WHERE \"Nature_Data\".\"IdNature\" = \"NatureData\".\"IdNature\"
										AND \"Nature_Data\".\"IdData\" = \"Dataset\".\"IdData\"
										GROUP BY \"NameNature\"
										ORDER BY \"NameNature\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			return $query->result_array();
		}
		
		function count_dataGbif()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT COUNT(\"IdData\") as compte
										FROM \"Dataset\"
										WHERE \"IdGbif\" != '' ";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On récupère le résultat
			$row = $query->row();
			// On retourne la réponse
			return $row->compte;
		}
		
		function list_typeInst()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdTypeInst\", \"NameTypeInst\" FROM \"TypeInstitution\" ORDER BY \"NameTypeInst\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_typeData()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdTypeData\", \"NameTypeData\" FROM \"TypeDataset\" ORDER BY \"NameTypeData\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_region()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdRegion\", \"NameRegion\" FROM \"Region\" ORDER BY \"NameRegion\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_ville()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdTown\", \"NameTown\" FROM \"Town\" ORDER BY \"NameTown\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_natureData()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdNature\", \"NameNature\" FROM \"NatureData\" ORDER BY \"NameNature\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_continent()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdContinent\", \"NameContinent\" FROM \"Continent\" ORDER BY \"NameContinent\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_pays()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdCountry\", \"NameCountry\" FROM \"Country\" ORDER BY \"NameCountry\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_kingdom()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdKingdom\", \"KingdomTaxo\" FROM \"Kingdom\" ORDER BY \"KingdomTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_phylum()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdPhylum\", \"PhylumTaxo\" FROM \"Phylum\" ORDER BY \"PhylumTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_class()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdClass\", \"ClassTaxo\" FROM \"Class\" ORDER BY \"ClassTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_orderTaxo()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdOrder\", \"OrderTaxo\" FROM \"Order\" ORDER BY \"OrderTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_family()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdFamily\", \"FamilyTaxo\" FROM \"Family\" ORDER BY \"FamilyTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_genus()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdGenus\", \"GenusTaxo\" FROM \"Genus\" ORDER BY \"GenusTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_specie()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les types de dataset existant
			$requete = "SELECT \"IdSpecie\", \"SpecieTaxo\" FROM \"Specie\" ORDER BY \"SpecieTaxo\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_inst($idagent=NULL)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les inst
			$requete = "SELECT \"Institution\".\"IdInst\", \"NameInst\" FROM \"Institution\"";
			// Liée à un agent le cas échéant
			if(isset($idagent))
			{
				$requete .= ", \"Agent_Inst\" WHERE \"Agent_Inst\".\"IdInst\" = \"Institution\".\"IdInst\" AND \"IdAgent\" = ".$idagent;
			}
			$requete .= " ORDER BY \"NameInst\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_dataset($idagent=NULL)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les inst
			$requete = "SELECT \"Dataset\".\"IdData\", \"NameData\" FROM \"Dataset\"";
			// Liée à un agent le cas échéant
			if(isset($idagent))
			{
				$requete .= ", \"Agent_Data\" WHERE \"Agent_Data\".\"IdData\" = \"Dataset\".\"IdData\" AND \"IdAgent\" = ".$idagent;
			}
			$requete .= " ORDER BY \"NameData\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_instnonagent($idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les inst
			$requete = "SELECT \"IdInst\", \"NameInst\" 
										FROM \"Institution\"
										WHERE \"IdInst\" NOT IN 
											(SELECT \"Institution\".\"IdInst\"
												FROM \"Institution\", \"Agent_Inst\" 
												WHERE \"Agent_Inst\".\"IdInst\" = \"Institution\".\"IdInst\" 
												AND \"IdAgent\" = ".$idagent.")
										ORDER BY \"NameInst\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_datasetnonagent($idagent)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les inst
			$requete = "SELECT \"IdData\", \"NameData\" 
										FROM \"Dataset\"
										WHERE \"IdData\" NOT IN 
											(SELECT \"Dataset\".\"IdData\"
												FROM \"Dataset\", \"Agent_Data\" 
												WHERE \"Agent_Data\".\"IdData\" = \"Dataset\".\"IdData\" 
												AND \"IdAgent\" = ".$idagent.")
										ORDER BY \"NameData\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_Time()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix time
			$requete = "SELECT \"IdTime\", \"ChoiceTime\" FROM \"Time\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_Ancient()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix ancient
			$requete = "SELECT \"IdAncient\", \"CenturyAncient\" FROM \"Ancient\" ORDER BY \"CenturyAncient\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_Current()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix current
			$requete = "SELECT \"IdCurrent\", \"YearCurrent\" FROM \"Current\" ORDER BY \"YearCurrent\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
				
		function list_Support()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix support
			$requete = "SELECT \"IdSupport\", \"FormatSupport\" FROM \"Support\" ORDER BY \"FormatSupport\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_Role()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix role
			$requete = "SELECT \"IdRole\", \"NameRole\" FROM \"Role\" ORDER BY \"NameRole\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_agents()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix role
			$requete = "SELECT \"IdAgent\", \"NameAgent\", \"EmailAgent\", \"NameOrga\", \"NomDroit\" 
										FROM \"Agent\", \"Droits\" 
										WHERE \"Agent\".\"IdDroit\" = \"Droits\".\"IdDroit\" 
										ORDER BY \"NameAgent\" ASC";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function list_droits()
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On récupère les choix role
			$requete = "SELECT \"IdDroit\", \"NomDroit\" FROM \"Droits\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function search_inst($motcle, $alpha='', $limit="ALL", $limdebut=0)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable (ajout de \ avant les ' ) et ajout de ' entourant le texte spécifiquement pour ILIKE
			$motcle = $this->db->escape_like_str($motcle);
			// On effectue les requêtes de recherche & en partie de récupération du résultat
			// Recherche sur le nom de l'institution, son sigle, nom de la région, de la ville et le type de l'institution
			// Récupération du nom de l'institution, de la région et de la ville
			$requete = "SELECT DISTINCT \"Institution\".\"IdInst\", \"SigleInst\", \"NameInst\", \"NameRegion\", \"NameTown\" 
									FROM \"Region\", \"Town\", \"Institution\"
									LEFT JOIN \"Type_Inst\" ON \"Institution\".\"IdInst\" = \"Type_Inst\".\"IdInst\"
									LEFT JOIN \"TypeInstitution\" ON \"TypeInstitution\".\"IdTypeInst\" = \"Type_Inst\".\"IdTypeInst\"
										WHERE \"Institution\".\"IdTown\" = \"Town\".\"IdTown\"
										AND \"Institution\".\"IdRegion\" = \"Region\".\"IdRegion\"
										AND (\"NameInst\" ILIKE '%$motcle%'
											OR \"SigleInst\" ILIKE '%$motcle%'
											OR \"NameRegion\" ILIKE '%$motcle%'
											OR \"NameTown\" ILIKE '%$motcle%'
											OR \"NameTypeInst\" ILIKE '%$motcle%')";
			// $alpha = "NomChamps ASC/DESC"
			if ($alpha != '')
			{
				$requete .= " ORDER BY $alpha";
			}
			// postgres : [LIMIT { number | ALL }] [OFFSET number]
			$requete .= " LIMIT $limit OFFSET $limdebut";
			$query = $this->db->query($requete);
			$array_inst = $query->result_array();
			// Récupération des types d'institutions
			for($i=0;$i<sizeof($array_inst);$i++)
			{
				// Qu'on ajoute au tableau résultat
				$array_inst[$i]['NameTypeInst'] = $this->get_typeInst($array_inst[$i]['IdInst']);
			}
			// On retourne le résultat
			return $array_inst;
		}
		
		function search_data($motcle)
		{
		// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable (ajout de \ avant les ' ) et ajout de ' entourant le texte spécifiquement pour ILIKE
			$motcle = $this->db->escape_like_str($motcle);
			// On effectue les requêtes de recherche & en partie de récupération du résultat
			// Recherche sur le nom de la collection, le type de données et la nature des données
			// Récupération du nom du jeu de donnée, de l'institution, du type de donnée
			$requete = "SELECT DISTINCT \"Dataset\".\"IdData\", \"NameData\", \"Dataset\".\"IdInst\", \"NameInst\", \"NameTypeData\" 
									FROM \"TypeDataset\", \"Institution\", \"Dataset\"
									LEFT JOIN \"Nature_Data\" ON \"Dataset\".\"IdData\" = \"Nature_Data\".\"IdData\"
									LEFT JOIN \"NatureData\" ON \"NatureData\".\"IdNature\" = \"Nature_Data\".\"IdNature\"
										WHERE \"Dataset\".\"IdTypeData\" = \"TypeDataset\".\"IdTypeData\"
										AND \"Dataset\".\"IdInst\" = \"Institution\".\"IdInst\"
										AND (\"NameData\" ILIKE '%$motcle%'
											OR \"NameTypeData\" ILIKE '%$motcle%'
											OR \"NameNature\" ILIKE '%$motcle%')";
			$query = $this->db->query($requete);
			// On stocke le résultat dans un tableau
			$array_data = $query->result_array();
			// Récupération de la nature du dataset
			for($i=0;$i<sizeof($array_data);$i++)
			{
				// Qu'on ajoute au tableau résultat
				$array_data[$i]['NameNature'] = $this->get_natureData($array_data[$i]['IdData']);
			}
			// On retourne le résultat
			return $array_data;
		}
		
		function search_pers($motcle)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable (ajout de \ avant les ' ) et ajout de ' entourant le texte spécifiquement pour ILIKE
			$motcle = $this->db->escape_like_str($motcle);
			// On effectue les requêtes de recherche & récupération du résultat
			// Recherche sur le nom et prénom de la personne
			// Récupération du nom, prénom, rôle, nom dataset
			$requete = "SELECT \"Dataset\".\"IdData\", \"Dataset\".\"IdInst\", \"Personne\".\"IdPersonne\", \"SurNamePers\", \"FirstNamePers\", \"NameRole\", \"NameData\" 
									FROM \"Role\", \"Personne\"
									LEFT JOIN \"Data_Pers\" ON \"Personne\".\"IdPersonne\" = \"Data_Pers\".\"IdPersonne\"
									LEFT JOIN \"Dataset\" ON \"Dataset\".\"IdData\" = \"Data_Pers\".\"IdData\"
										WHERE \"Personne\".\"IdRole\" = \"Role\".\"IdRole\"
										AND (\"SurNamePers\" ILIKE '%$motcle%'
											OR \"FirstNamePers\" ILIKE '%$motcle%'
											OR \"NameRole\" ILIKE '%$motcle%')";
			$query = $this->db->query($requete);
			// On retourne le résultat
			return $query->result_array();
		}
		
		function search_avance($motcle)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise les 2 variables texte (ajout de \ avant les ' ) et ajout de ' entourant le texte spécifiquement pour ILIKE
			$motcle['nomInst'] = $this->db->escape_like_str($motcle['nomInst']);
			$motcle['nomData'] = $this->db->escape_like_str($motcle['nomData']);
			// On construit le début de la requète
			$requete = "SELECT DISTINCT \"Dataset\".\"IdData\", \"NameData\", \"Dataset\".\"IdInst\", \"NameInst\", \"SigleInst\", \"IdTypeData\"
									FROM (\"Dataset\" 
									LEFT JOIN \"Nature_Data\" ON \"Dataset\".\"IdData\" = \"Nature_Data\".\"IdData\" 
									LEFT JOIN \"Geographie\" ON \"Dataset\".\"IdData\" = \"Geographie\".\"IdData\" 
									LEFT JOIN \"Continent_Geo\" ON \"Geographie\".\"IdGeo\" = \"Continent_Geo\".\"IdGeo\" 
									LEFT JOIN \"Country_Geo\" ON \"Geographie\".\"IdGeo\" = \"Country_Geo\".\"IdGeo\"
									LEFT JOIN \"Taxonomy\" ON \"Dataset\".\"IdData\" = \"Taxonomy\".\"IdData\"), 
									(\"Institution\" 
									LEFT JOIN \"Type_Inst\" ON \"Institution\".\"IdInst\" = \"Type_Inst\".\"IdInst\") 
										WHERE \"Dataset\".\"IdInst\" = \"Institution\".\"IdInst\" 
										AND \"NameData\" ILIKE '%".$motcle['nomData']."%' 
										AND (\"NameInst\" ILIKE '%".$motcle['nomInst']."%' 
											OR \"SigleInst\" ILIKE '%".$motcle['nomInst']."%') ";
			// Pour chaque champs du formulaire
			/* $motcle[IdTypeInst], $motcle[IdRegion], $motcle[IdTown]
			$motcle[IdTypeData], $motcle[IdNature], $motcle[IdContinent], $motcle[IdCountry]
			// On gère la taxo différemment pour corriger un soucis de serveur qui tourne dans le vide si la requête concerne trop de dataset
			$motcle[IdKingdom], $motcle[IdPhylum], $motcle[IdClass], $motcle[IdOrder], $motcle[IdFamily], $motcle[IdGenus], $motcle[IdSpecie] */
			foreach ($motcle as $key => $value)
			{
				// On ne retraite pas les nom inst et data
				if ($key != 'nomInst' && $key != 'nomData')
				{
					$premier = 1;
					// Pour chaque choix multiple selectionné
					foreach ($motcle[$key] as $item)
					{
						// On ajoute les conditions à la requète.
						// Cas particulier de la taxonomie
						if ($key == 'IdKingdom')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Kingdom_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdPhylum')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Phylum_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdClass')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Class_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdOrder')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Order_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdFamily')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Family_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdGenus')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"Genus_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						elseif ($key == 'IdSpecie')
						{
							// Si c'est la première condition sur cette clé
							if ($premier == 1)
							{
								$requete .= "AND \"IdTaxo\" IN (SELECT \"IdTaxo\" FROM \"specie_Taxo\" WHERE \"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Si non
							else
							{
								$requete .= "OR \"".$key."\" = '$item' ";
							}
						}
						// Reste des mots clés
						else
						{
							// Si c'est la première condition sur cette clé = AND
							if ($premier == 1)
							{
								$requete .= " AND (\"".$key."\" = '$item' ";
								$premier = 0;
							}
							// Sinon = OR
							else
							{
								$requete .= " OR \"".$key."\" = '$item' ";
							}
						}
						
					}
					$requete .= ")";
				}
			}
			$query = $this->db->query($requete);
			// On stocke le résultat dans un tableau
			$array_data = $query->result_array();
			// Récupération de la nature du dataset et du type
			for($i=0;$i<sizeof($array_data);$i++)
			{
				// Qu'on ajoute au tableau résultat
				$array_data[$i]['NameNature'] = $this->get_natureData($array_data[$i]['IdData']);
				$array_data[$i]['NameTypeData'] = $this->get_typeData($array_data[$i]['IdTypeData']);
			}
			// On retourne le résultat
			return $array_data;
		}
		
		function get_infoInst($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Institution\" WHERE \"IdInst\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
		function get_typeInst($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT array_to_string(array_agg(\"NameTypeInst\"), ', ') AS \"NameTypeInst\" 
										FROM \"TypeInstitution\", \"Type_Inst\" 
											WHERE \"TypeInstitution\".\"IdTypeInst\" = \"Type_Inst\".\"IdTypeInst\" 
											AND \"IdInst\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$type = $query->row();
			return $type->NameTypeInst;
		}
		
		function get_regionInst($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"NameRegion\" FROM \"Region\"
										WHERE \"IdRegion\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$region = $query->row();
			return $region->NameRegion;
		}
		
		function get_townInst($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"NameTown\" FROM \"Town\"
										WHERE \"IdTown\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$town = $query->row();
			return $town->NameTown;
		}
		
		function get_datasetInst($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"IdData\", \"NameData\", \"IdDataParent\" FROM \"Dataset\"
										WHERE \"IdInst\" = ".$id."
										ORDER BY \"NameData\"";
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_instChild($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"IdInst\", \"NameInst\" FROM \"Institution\"
										WHERE \"IdInstParent\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_infoPers($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Personne\" WHERE \"IdPersonne\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
		function get_rolePers($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"NameRole\" FROM \"Role\" 
										WHERE \"IdRole\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$role = $query->row();
			return $role->NameRole;
		}
		
		function get_datasetPers($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"Dataset\".\"IdData\", \"NameData\", \"IdDataParent\" FROM \"Dataset\", \"Data_Pers\"
										WHERE \"Dataset\".\"IdData\" = \"Data_Pers\".\"IdData\"
										AND \"IdPersonne\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_infoData($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Dataset\" WHERE \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
		function get_typeData($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"NameTypeData\" FROM \"TypeDataset\" 
										WHERE \"IdTypeData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$typeD = $query->row();
			return $typeD->NameTypeData;
		}
		
		function get_natureData($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT array_to_string(array_agg(trim(\"NameNature\")), ', ') AS \"NameNature\"
										FROM \"Nature_Data\", \"NatureData\" 
											WHERE \"NatureData\".\"IdNature\" = \"Nature_Data\".\"IdNature\" 
											AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On retourne la réponse
			$nature = $query->row();
			return $nature->NameNature;
		}
		
		function get_dataChild($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"IdData\", \"NameData\" FROM \"Dataset\"
										WHERE \"IdDataParent\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_infoGeo($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Geographie\" WHERE \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On stocke le résultat
				$geo = $query->row();
				// On récupère les continents
				$requete = "SELECT array_to_string(array_agg(\"NameContinent\"), ', ') AS \"NameContinent\" 
											FROM \"Continent\", \"Continent_Geo\" 
												WHERE \"Continent\".\"IdContinent\" = \"Continent_Geo\".\"IdContinent\" 
												AND \"IdGeo\" = ".$geo->IdGeo;
				$query = $this->db->query($requete);
				$continent = $query->row();
				// Qu'on ajoute au résultat
				$geo->NameContinent = $continent->NameContinent;
				// On récupère les pays de la même façon
				$requete = "SELECT array_to_string(array_agg(\"NameCountry\"), ', ') AS \"NameCountry\" 
											FROM \"Country\", \"Country_Geo\" 
												WHERE \"Country\".\"IdCountry\" = \"Country_Geo\".\"IdCountry\" 
												AND \"IdGeo\" = ".$geo->IdGeo;
				$query = $this->db->query($requete);
				$pays = $query->row();
				// Qu'on ajoute au résultat
				$geo->NameCountry = $pays->NameCountry;
				// On retourne la réponse
				return $geo;
			}
		}
		
		function get_infoTaxo($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Taxonomy\" WHERE \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On stocke le résultat
				$taxo = $query->row();
				// On récupère les détails de la taxo
				$taxo->KingdomTaxo = $this->get_taxonomy('Kingdom', $taxo->IdTaxo);
				$taxo->PhylumTaxo = $this->get_taxonomy('Phylum', $taxo->IdTaxo);
				$taxo->ClassTaxo = $this->get_taxonomy('Class', $taxo->IdTaxo);
				$taxo->OrderTaxo = $this->get_taxonomy('Order', $taxo->IdTaxo);
				/* Pour le moment, on va pas plus précis que l'ordre
				$taxo->FamilyTaxo = $this->get_taxonomy('Family', $taxo->IdTaxo);
				$taxo->GenusTaxo = $this->get_taxonomy('Genus', $taxo->IdTaxo);
				$taxo->SpecieTaxo = $this->get_taxonomy('Specie', $taxo->IdTaxo);
				*/
				// On retourne la réponse
				return $taxo;
			}
		}
		
		function get_taxonomy($rang, $id)
		{
				// On récupère la liste des règnes/phylum/etc (défini par $rang)
				$champ = $rang."Taxo";
				$requete = "SELECT array_to_string(array_agg(\"".$champ."\"), ', ') AS \"".$champ."\" 
											FROM \"".$rang."\", \"".$rang."_Taxo\" 
												WHERE \"".$rang."\".\"Id".$rang."\" = \"".$rang."_Taxo\".\"Id".$rang."\" 
												AND \"IdTaxo\" = ".$id;
				$query = $this->db->query($requete);
				$rang = $query->row();
				// On retourne le texte résultat
				return $rang->$champ;
		}
		
		function get_infoTempo($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Temporal\" WHERE \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On stocke le résultat
				$tempo = $query->row();
				// On récupère les détails
				// Ancien
				$requete = "SELECT array_to_string(array_agg(\"CenturyAncient\"), ', ') AS \"CenturyAncient\" 
											FROM \"Ancient\", \"Ancient_Tempo\" 
												WHERE \"Ancient\".\"IdAncient\" = \"Ancient_Tempo\".\"IdAncient\" 
												AND \"IdTempo\" = ".$tempo->IdTempo;
				$query = $this->db->query($requete);
				$ancien = $query->row();
				// Qu'on ajoute au résultat
				$tempo->CenturyAncient = $ancien->CenturyAncient;
				// Actuel
				$requete = "SELECT array_to_string(array_agg(\"YearCurrent\"), ', ') AS \"YearCurrent\" 
											FROM \"Current\", \"Current_Tempo\" 
												WHERE \"Current\".\"IdCurrent\" = \"Current_Tempo\".\"IdCurrent\" 
												AND \"IdTempo\" = ".$tempo->IdTempo;
				$query = $this->db->query($requete);
				$actuel = $query->row();
				// Qu'on ajoute au résultat
				$tempo->YearCurrent = $actuel->YearCurrent;
				// On retourne la réponse
				return $tempo;
			}
		}
		
		function get_infoMethode($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT * FROM \"Methods\" WHERE \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
		function get_infoProjet($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// Il peut y avoir plusieurs projets
			$requete = "SELECT \"TitleProject\", \"DomainProject\", \"DescriptionProjet\", \"FundsProject\", \"ProjectResearch\".\"IdProject\" FROM \"Project_Data\", \"ProjectResearch\" 
										WHERE \"ProjectResearch\".\"IdProject\" = \"Project_Data\".\"IdProject\" 
										AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_infoBiblio($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// Il peut y avoir plusieurs éléments bibliographiques
			$requete = "SELECT \"RefBiblio\", \"TypeRessource\", \"Biblio\".\"IdBiblio\" FROM \"Biblio_Data\", \"Biblio\" 
										WHERE \"Biblio\".\"IdBiblio\" = \"Biblio_Data\".\"IdBiblio\" 
										AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_infoStock($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit les requêtes
			// On récupère le stockage physique
			$requete = "SELECT \"IdPhysicalSize\", (CAST(\"NumberElement\" AS VARCHAR) || ' ' || \"UnitOfMesure\") AS \"phys\"
										FROM \"PhysicalSize\", \"Stockage\"
											WHERE \"PhysicalSize\".\"IdStock\" = \"Stockage\".\"IdStock\"
											AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On stocke le résultat
			$stock->physique = $query->result();
			
			// On récupère les types de supports
			$requete = "SELECT array_to_string(array_agg(\"FormatSupport\"), ', ') AS \"FormatSupport\" 
										FROM \"Stockage\", \"Support\", \"Support_Stock\"
											WHERE \"Stockage\".\"IdStock\" = \"Support_Stock\".\"IdStock\"
											AND \"Support_Stock\".\"IdSupport\" = \"Support\".\"IdSupport\"
											AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On stocke le résultat
			$format = $query->row();
			$stock->FormatSupport = $format->FormatSupport;
			
			// On récupère les infos de la base de données
			$requete = "SELECT \"IdInfoDatabase\", \"UrlDatabase\", \"LangageDatabase\", \"NivInformatisation\" FROM \"InfoDatabase\", \"Stockage\"
										WHERE \"InfoDatabase\".\"IdStock\" = \"Stockage\".\"IdStock\"
										AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// On stocke le résultat
			$stock->bdd = $query->result();
			
			// On retourne le résultat
			return $stock;
		}
		
		function get_persData($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On sécurise la variable au cas où ce ne soit pas un id (ajout de \ avant les ' ) et ajout de ' entourant le texte
			$id = $this->db->escape($id);
			// On construit la requête
			$requete = "SELECT \"Personne\".\"IdPersonne\", \"SurNamePers\", \"FirstNamePers\", \"NameRole\" FROM \"Personne\", \"Data_Pers\", \"Role\" 
										WHERE \"Personne\".\"IdPersonne\" = \"Data_Pers\".\"IdPersonne\"
										AND \"Personne\".\"IdRole\" = \"Role\".\"IdRole\" 
										AND \"IdData\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->result();
			}
		}
		
		function get_agent($id)
		{
			// On se connecte à la base de donnée
			$this->load->database();
			// On construit la requête
			$requete = "SELECT * FROM \"Agent\" WHERE \"IdAgent\" = ".$id;
			// On contacte la bdd
			$query = $this->db->query($requete);
			// Si on n'a pas de retour
			if ($query->num_rows() == 0)
			{
				// On retourne FAUX
				return FALSE;
			}
			else
			{
				// On retourne la réponse
				return $query->row();
			}
		}
		
}
?>
