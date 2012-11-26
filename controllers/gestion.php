<?php
class Gestion extends CI_Controller {

	// La fonction index sert pour le choix de l'agent
	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Gestion des utilisateurs";
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
			$this->load->model('Bdd_select');
			// On liste les agents
			 $data['agents'] = $this->Bdd_select->list_agents();
			// On appelle la vue
			$this->load->view('gestion', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
	
	// Lors d'une modif d'un agent
	function agent($id)
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modification d'un utilisateur";	
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
			$this->load->model('Bdd_select');
			$this->load->library('form_validation');
			// On récupère les infos de l'agent
			$data['agent'] = $this->Bdd_select->get_agent($id);
			// La liste des droits
			$data['droits'] = $this->Bdd_select->list_droits();
			// La liste des inst qui lui sont liées (possibilité d'en enlever)
			$data['instlie'] = $this->Bdd_select->list_inst($id);
			// La liste des inst qui ne lui sont pas liées (possibilité d'en rajouter)
			$data['instnonlie'] = $this->Bdd_select->list_instnonagent($id);
			// la liste des datasets qui lui sont liés (possibilité d'en enlever)
			$data['datalie'] = $this->Bdd_select->list_dataset($id);
			// la liste des datasets qui ne lui sont pas liés (possibilité d'en rajouter)
			$data['datanonlie'] = $this->Bdd_select->list_datasetnonagent($id);
			// On appelle la vue
			$this->load->view('gestion', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
}
?>
