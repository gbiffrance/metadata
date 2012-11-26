<?php
class Consultavance extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Consultation avanc&eacute;e des m&eacute;tadonn&eacute;es fran&ccedil;aises";
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
		// On récupère les champs des listes déroulantes
		$this->load->model('Bdd_select');
		// Types institutions
		$data['typeinst'] = $this->Bdd_select->list_typeInst();
		// Régions
		$data['region'] = $this->Bdd_select->list_region();
		// Villes
		$data['ville'] = $this->Bdd_select->list_ville();
		// Type dataset
		$data['typedata'] = $this->Bdd_select->list_typeData();
		// Nature dataset
		$data['naturedata'] = $this->Bdd_select->list_natureData();
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
		/* Pour le moment, on va pas plus précis que l'ordre
		// Famille taxonomie
		$data['family'] = $this->Bdd_select->list_family();
		// Genre taxonomie
		$data['genus'] = $this->Bdd_select->list_genus();
		// Espèce taxonomie
		$data['specie'] = $this->Bdd_select->list_specie();*/
		// On charge la vue avec tous ces éléments
		$this->load->view('consultavance', $data);
		
		// Footer
		$this->load->view('footer');
	}	
}
?>
