<?php
class Detailresultat extends CI_Controller {

	// La fonction index ne servira pas, on met tout de même les header/footer au cas où quelqu'un se perde ici
	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Il manque un param&egrave;tre.";
		if ($this->session->userdata('username') == FALSE)
		{
			$dataH['log'] = "non";
		}
		else
		{
			$dataH['log'] = "oui";
		}
		$this->load->view('header', $dataH);
		
		// Body
		
		// Footer
		$this->load->view('footer');
	}
	
	// Fonction pour afficher une institution
	function inst($id)
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "D&eacute;tail de l'institution";
		$dataH['ajax_f'] = "inst_details";
		if ($this->session->userdata('username') == FALSE)
		{
			$dataH['log'] = "non";
		}
		else
		{
			$dataH['log'] = "oui";
		}
		$this->load->view('header', $dataH);
		
		// Body
		// On charge le modèle
		$this->load->model('Bdd_select');
		// On récupère les informations relatives à cette institution
		// Si l'institution n'est pas trouvée
		if (!$this->Bdd_select->get_infoInst($id))
		{
			$data['error'] = "L'institution n'existe pas";	
		}
		else
		{
			$data['inst'] = $this->Bdd_select->get_infoInst($id);
			// On récupère le type
			$data['type'] = $this->Bdd_select->get_typeInst($id);
			// On récupère la région
			$data['region'] = $this->Bdd_select->get_regionInst($data['inst']->IdRegion);
			// On récupère la ville
			$data['town'] = $this->Bdd_select->get_townInst($data['inst']->IdTown);
			// On vérifie s'il y a des datasets
			if ($this->Bdd_select->get_datasetInst($id))
			{
				$data['datasetInst'] = $this->Bdd_select->get_datasetInst($id);
			}
			// On vérifie s'il y a une institution mère
			if ($this->Bdd_select->get_infoInst($data['inst']->IdInstParent))
			{
				$data['instmere'] = $this->Bdd_select->get_infoInst($data['inst']->IdInstParent);
			}
			// On vérifie s'il y a des institutions filles
			if ($this->Bdd_select->get_instChild($id))
			{
				$data['instChild'] = $this->Bdd_select->get_instChild($id);
			}
		}
		$this->load->view('detailresultat', $data);

		// Footer
		$this->load->view('footer');
	}
	
	// Fonction pour afficher un jeu de données
	function dataset($id)
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "D&eacute;tail du jeu de donn&eacute;e";
		$dataH['ajax_f'] = "coll_details";
		if ($this->session->userdata('username') == FALSE)
		{
			$dataH['log'] = "non";
		}
		else
		{
			$dataH['log'] = "oui";
		}
		$this->load->view('header', $dataH);
		
		// Body
		// On charge le modèle
		$this->load->model('Bdd_select');
		// On récupère les informations relatives à ce dataset
		if (!$this->Bdd_select->get_infoData($id)) // Si le dataset n'est pas trouvé
		{
			$data['error'] = "Le jeu de donn&eacute;e n'existe pas";	
		}
		else
		{
			$data['dataset'] = $this->Bdd_select->get_infoData($id);
			// On récupère le type et la nature
			$data['typeData'] = $this->Bdd_select->get_typeData($data['dataset']->IdTypeData);
			$data['nature'] = $this->Bdd_select->get_natureData($id);
			// On vérifie s'il y a un dataset père
			if ($this->Bdd_select->get_infoData($data['dataset']->IdDataParent))
			{
				$data['datapere'] = $this->Bdd_select->get_infoData($data['dataset']->IdDataParent);
			}
			// On vérifie s'il y a des datasets fils
			if ($this->Bdd_select->get_dataChild($id))
			{
				$data['dataChild'] = $this->Bdd_select->get_dataChild($id);
			}
			// On récupère les infos de l'institution
			$data['inst'] = $this->Bdd_select->get_infoInst($data['dataset']->IdInst);
			$data['type'] = $this->Bdd_select->get_typeInst($data['dataset']->IdInst);
			$data['region'] = $this->Bdd_select->get_regionInst($data['inst']->IdRegion);
			$data['town'] = $this->Bdd_select->get_townInst($data['inst']->IdTown);
			// On vérifie s'il y a une institution mère
			if ($this->Bdd_select->get_infoInst($data['inst']->IdInstParent))
			{
				$data['instmere'] = $this->Bdd_select->get_infoInst($data['inst']->IdInstParent);
			}
			// On vérifie s'il y a des institutions filles
			if ($this->Bdd_select->get_instChild($data['dataset']->IdInst))
			{
				$data['instChild'] = $this->Bdd_select->get_instChild($data['dataset']->IdInst);
			}
			// On récupère les infos géographiques
			if ($this->Bdd_select->get_infoGeo($id))
			{
				$data['geo'] = $this->Bdd_select->get_infoGeo($id);
			}
			// On récupère les infos taxonomiques
			if ($this->Bdd_select->get_infoTaxo($id))
			{
				$data['taxo'] = $this->Bdd_select->get_infoTaxo($id);
			}
			// On récupère les infos temporelles
			if ($this->Bdd_select->get_infoTempo($id))
			{
				$data['tempo'] = $this->Bdd_select->get_infoTempo($id);
			}
			// On récupère les methodes
			if ($this->Bdd_select->get_infoMethode($id))
			{
				$data['methode'] = $this->Bdd_select->get_infoMethode($id);
			}
			// On récupère les projets
			if ($this->Bdd_select->get_infoProjet($id))
			{
				$data['projet'] = $this->Bdd_select->get_infoProjet($id);
			}
			// On récupère la biblio
			if ($this->Bdd_select->get_infoBiblio($id))
			{
				$data['biblio'] = $this->Bdd_select->get_infoBiblio($id);
			}
			// On récupère les stock
			if ($this->Bdd_select->get_infoStock($id))
			{
				$data['stock'] = $this->Bdd_select->get_infoStock($id);
			}
			// On récupère la liste des personnes
			if ($this->Bdd_select->get_persData($id))
			{
				$data['persData'] = $this->Bdd_select->get_persData($id);
			}
		}
		$this->load->view('detailresultat', $data);
		
		// Footer
		$this->load->view('footer');
	}

	// Fonction pour afficher une personne
	function pers($id)
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "D&eacute;tail de la personne";
		$dataH['ajax_f'] = "pers_details";
		if ($this->session->userdata('username') == FALSE)
		{
			$dataH['log'] = "non";
		}
		else
		{
			$dataH['log'] = "oui";
		}
		$this->load->view('header', $dataH);
		
		// Body
		// On charge le modèle
		$this->load->model('Bdd_select');
		// On récupère les informations relatives à cette personne
		// Si la personne n'est pas trouvée
		if (!$this->Bdd_select->get_infoPers($id))
		{
			$data['error'] = "La personne n'existe pas";	
		}
		else
		{
			$data['pers'] = $this->Bdd_select->get_infoPers($id);
			// On récupère le rôle
			$data['role'] = $this->Bdd_select->get_rolePers($data['pers']->IdRole);
			// On vérifie s'il y a des datasets
			if ($this->Bdd_select->get_datasetPers($id))
			{
				$data['datasetPers'] = $this->Bdd_select->get_datasetPers($id);
			}
		}
		$this->load->view('detailresultat', $data);
		
		// Footer
		$this->load->view('footer');
	}
	
}
?>
