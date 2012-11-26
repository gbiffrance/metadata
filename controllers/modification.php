<?php
class Modification extends CI_Controller {

	// La fonction index sert pour le choix entre inst et dataset
	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modification d'une m&eacute;tadonn&eacute;e";
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
			// On récupère les champs des listes déroulantes
			$this->load->model('Bdd_select');
			// Liste des institutions
			// Si l'agent à un droit > 2 il a accès à toutes
			if ($this->session->userdata('droits') > 2)
			{
				$data['inst'] = $this->Bdd_select->list_inst();
			}
			// Sinon on sélectionne juste les siennes
			else
			{
				$data['inst'] = $this->Bdd_select->list_inst($this->session->userdata('id'));
			}
			// Liste des datasets
			// Si l'agent à un droit > 2 il a accès à tous
			if ($this->session->userdata('droits') > 2)
			{
				$data['dataset'] = $this->Bdd_select->list_dataset();
			}
			// Sinon on sélectionne juste les siennes
			else
			{
				$data['dataset'] = $this->Bdd_select->list_dataset($this->session->userdata('id'));
			}	
			$this->load->view('modification', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
	
	// Lors d'une modif d'une institution
	function inst()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modification de l'institution";
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
			// On récupère les champs des listes déroulantes
			$this->load->model('Bdd_select');
			// Validation formulaire
			$this->load->library('form_validation');
			// Types institutions
			$data['typeinst'] = $this->Bdd_select->list_typeInst();
			// Régions
			$data['region'] = $this->Bdd_select->list_region();
			// Villes
			$data['ville'] = $this->Bdd_select->list_ville();
			// Institutions pour l'institution mère
			$data['instmere'] = $this->Bdd_select->list_inst();
		
			// On récupère les infos de l'institution
			$id = $_POST['idInst'];
			$data['inst'] = $this->Bdd_select->get_infoInst($id);
			// Les types
			$data['type'] = $this->Bdd_select->get_typeInst($id);

			// On charge la vue avec tous ces éléments
			$this->load->view('modification', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
	
	// Lors d'une modif d'un dataset
	function dataset()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modification du jeu de donn&eacute;es";
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
			// On récupère les champs des listes déroulantes
			$this->load->model('Bdd_select');
			// Validation formulaire
			$this->load->library('form_validation');
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
		
		// Footer
		$this->load->view('footer');
	}
}
