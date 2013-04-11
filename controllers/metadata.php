<?php
class Metadata extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "A propos des m&eacute;tadonn&eacute;es du GBIF";
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
		// On récupère quelques stat
		$this->load->model('Bdd_select');
		// Nombre d'instutitions
		$data['inst'] = $this->Bdd_select->count_inst();
		// Nombre de datasets
		$data['dataset'] = $this->Bdd_select->count_dataset("");
		// Nombre de datasets de collections
		$data['coll'] = $this->Bdd_select->count_dataset("Collection");
		// Nombre de datasets d'observations
		$data['obs'] = $this->Bdd_select->count_dataset("Observation");
		$this->load->view('accueil', $data);
		
		// Footer
		$this->load->view('footer');
	}
	
}
?>
