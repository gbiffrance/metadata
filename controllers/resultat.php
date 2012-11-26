<?php
class Resultat extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['ajax_f'] = "res_list";
		$dataH['title'] = "R&eacute;sultat de la recherche";
		if($_POST['choix'] == "inst" || $_POST['choix'] == "institution")
		{
			$dataH['choix'] = 'institutions';
		}
	// DEBUT NL MODIFS
// 		else if($_POST['choix'] == "instPere")
// 		{
// 			$dataH['choix'] = 'institutions';
// 		}
// 		else if($_POST['choix'] == "datasetPere")
// 		{
// 			$dataH['choix'] = 'collections';
// 		}
// 		else if($_POST['choix'] == "personPere")
// 		{
// 			$dataH['choix'] = 'personnes';
// 		}
	// FIN NL MODIFS
		else if($_POST['choix'] == "dataset")
		{
			$dataH['choix'] = 'collections';
		}
		else if($_POST['choix'] == "person")
		{
			$dataH['choix'] = 'personnes';
		}
		else if($_POST['choix'] == "advance")
		{
			$dataH['choix'] = 'avancee';
// 			$dataH['choix'] = 'advance';
		}

		if (isset($_POST['motcle']))
		{
			$dataH['title'] .= " : '".$_POST['motcle']."'";
		}
		else
		{
			$dataH['title'] .= " avanc&eacute;e";
		}
		if ($this->session->userdata('username') == FALSE)
		{
			$dataH['log'] = "non";
		}
		else
		{
			$dataH['log'] = "oui";
		}
		
		if($_POST['choix'] == "advance")
			$dataH['sWord'] = '';
		else
			$dataH['sWord'] = $_POST['motcle'];
		
		//$dataH['choix'] = $_POST['choix'];
		$this->load->view('header', $dataH);
		
		// Body
		// On charge le modèle
		$this->load->model('Bdd_select');
		// On regarde le type de requête qu'il y a eu
		// Si c'est une institution qui est recherchée
		
		// DEBUT MODIFS NICOLAS
		// Si c'est une institution qui est recherchée
		if ($_POST['choix'] == "institution")
		{
			// On cherche l'institution qui correspond au mot cle
			$res['institution'] = $this->Bdd_select->search_inst($_POST['motcle']);
		}
		// Si c'est un dataset qui est recherché
		else if ($_POST['choix'] == "dataset")
		{
			// On cherche le dataset qui correspond au mot clé
			$res['dataset'] = $this->Bdd_select->search_data($_POST['motcle']);
		}
		// Si c'est une personne qui est recherchée
		else if ($_POST['choix'] == "person")
		{
			// On cherche la personne qui correspond au mot clé
			$res['person'] = $this->Bdd_select->search_pers($_POST['motcle']);
		}
// FIN MODIFS NICOLAS

			// DELPHINE PART
// 		if ($_POST['choix'] == "institution")
// 		{
// 			// On cherche l'institution qui correspond au mot clé
// 			//$data['inst'] = $this->Bdd_select->search_inst($_POST['motcle']); // NL : ORI
// 			$res['inst'] = $this->Bdd_select->search_inst($_POST['motcle']); // NL : MODIFS
// 		}
// 		// Si c'est un dataset qui est recherché
// 		else if ($_POST['choix'] == "dataset")
// 		{
// 			// On cherche le dataset qui correspond au mot clé
// // 			$data['dataset'] = $this->Bdd_select->search_data($_POST['motcle']); // NL : ORI
// 			$res['dataset'] = $this->Bdd_select->search_data($_POST['motcle']); // NL : MODIFS
// 		}
// 		// Si c'est une personne qui est recherchée
// 		else if ($_POST['choix'] == "person")
// 		{
// 			// On cherche la personne qui correspond au mot clé
// // 			$data['pers'] = $this->Bdd_select->search_pers($_POST['motcle']); // NL : ORI
// 			$res['pers'] = $this->Bdd_select->search_pers($_POST['motcle']); // NL : MODIFS
// 		}
		// Si c'est une recherche avancée
		else if ($_POST['choix'] == "advance")
		{
			// On récupère tous les résultats de $_POST dans un tableau à transmettre au modèle
			$motcle['nomInst'] = $_POST['nomInst'];
			if (isset($_POST['IdTypeInst']))
			{
				foreach($_POST['IdTypeInst'] as $value)
				{
					$motcle['IdTypeInst'][] = $value;
				}
			}
			if (isset($_POST['IdRegion']))
			{
				foreach($_POST['IdRegion'] as $value)
				{
					$motcle['IdRegion'][] = $value;
				} 
			}
			if (isset($_POST['IdTown']))
			{
				foreach($_POST['IdTown'] as $value)
				{
					$motcle['IdTown'][] = $value;
				} 
			}
			$motcle['nomData'] = $_POST['nomData'];
			if (isset($_POST['IdTypeData']))
			{
				foreach($_POST['IdTypeData'] as $value)
				{
					$motcle['IdTypeData'][] = $value;
				} 
			}	
			if (isset($_POST['IdNature']))	
			{
				foreach($_POST['IdNature'] as $value)
				{
					$motcle['IdNature'][] = $value;
				} 
			}	
			if (isset($_POST['IdContinent']))	
			{
				foreach($_POST['IdContinent'] as $value)
				{
					$motcle['IdContinent'][] = $value;
				} 
			}	
			if (isset($_POST['IdCountry']))	
			{
				foreach($_POST['IdCountry'] as $value)
				{
					$motcle['IdCountry'][] = $value;
				} 
			}	
			if (isset($_POST['IdKingdom']))	
			{
				foreach($_POST['IdKingdom'] as $value)
				{
					$motcle['IdKingdom'][] = $value;
				} 
			}	
			if (isset($_POST['IdPhylum']))	
			{
				foreach($_POST['IdPhylum'] as $value)
				{
					$motcle['IdPhylum'][] = $value;
				} 
			}	
			if (isset($_POST['IdClass']))
			{	
				foreach($_POST['IdClass'] as $value)
				{
					$motcle['IdClass'][] = $value;
				} 
			}	
			if (isset($_POST['IdOrder']))
			{	
				foreach($_POST['IdOrder'] as $value)
				{
					$motcle['IdOrder'][] = $value;
				} 
			}	
			/* Pour le moment, on va pas plus précis que l'ordre
			if (isset($_POST['IdFamily']))
			{		
				foreach($_POST['IdFamily'] as $value)
				{
					$motcle['IdFamily'][] = $value;
				} 
			}	
			if (isset($_POST['IdGenus']))
			{		
				foreach($_POST['IdGenus'] as $value)
				{
					$motcle['IdGenus'][] = $value;
				} 
			}	
			if (isset($_POST['IdSpecie']))
			{		
				foreach($_POST['IdSpecie'] as $value)
				{
					$motcle['IdSpecie'][] = $value;
				}
			}	*/
			// On cherche le dataset qui correspond aux choix
// 			$data['dataset'] = $this->Bdd_select->search_avance($motcle); // NL : ORI
// 			$res['dataset'] = $this->Bdd_select->search_avance($motcle);// NL : MODIFS
			$res['advanceDataset'] = $this->Bdd_select->search_avance($motcle);// NL : MODIFS
		}
		
		// On affiche le résultat
		$this->load->view('resultat', $res); // NL : MODIFS
		
		// Footer
		$this->load->view('footer');
	}	
}
?>
