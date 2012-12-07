<?php
class Statistiques extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Statistiques sur les m&eacute;tadonn&eacute;es";
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
		// On récupère les stat
		$this->load->model('Bdd_select');
		
		// Nombre d'inst par régions
		$data['instregion'] = $this->Bdd_select->count_instRegion();
		// Nombre d'inst par type
		$data['insttype'] = $this->Bdd_select->count_instType();
		// Nombre de dataset par inst
		$data['instdata'] = $this->Bdd_select->count_instData();
		// Nombre de datasets par type
		$data['datatype'] = $this->Bdd_select->count_dataType();
		// Nombre de dataset par nature
		$data['datanature'] = $this->Bdd_select->count_dataNature();
		// Nombre de dataset connectés au gbif
		$data['nbdataset'] = $this->Bdd_select->count_dataset("");
		$data['nbgbif'] = $this->Bdd_select->count_dataGbif();
		
		$this->load->view('stat', $data);
		
		// Footer
		$this->load->view('footer');
	}
	
}
?>
