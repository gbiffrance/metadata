<?php
class Ajoutinst extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Nouvelle institution ajout&eacute;e";
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
		
			$this->form_validation->set_rules('nomInst','Nom','required|max_length[100]');
			$this->form_validation->set_rules('descInst','Description','required');
			$this->form_validation->set_rules('sigleInst','Sigle','max_length[10]');
			$this->form_validation->set_rules('adresseInst','Adresse','required|max_length[100]');
			$this->form_validation->set_rules('codepostalInst','Code postal','required|max_length[5]|integer');
			$this->form_validation->set_rules('IdTown','IdTown','');
			$this->form_validation->set_rules('newville','Nouvelle ville','');
			$this->form_validation->set_rules('IdRegion','IdRegion','');
			$this->form_validation->set_rules('telInst','Telephone','numeric');
			$this->form_validation->set_rules('mailInst','Mail','valid_email');
			$this->form_validation->set_rules('logoInst','Url Logo','valid_url');
			$this->form_validation->set_rules('urlInst','Url','valid_url');
			$this->form_validation->set_rules('parentInst','parentInst','');
			$this->form_validation->set_rules('IdTypeInst[]','Type','required');
		
			if ($this->form_validation->run() == FALSE)
			{
				// On récupère les champs des listes déroulantes
				$this->load->model('Bdd_select');
				// Types institutions
				$data['typeinst'] = $this->Bdd_select->list_typeInst();
				// Régions
				$data['region'] = $this->Bdd_select->list_region();
				// Villes
				$data['ville'] = $this->Bdd_select->list_ville();
				// Institutions pour l'institution mère
				$data['inst'] = $this->Bdd_select->list_inst();
				$this->load->view('ajout', $data);
			}
			else
			{
				// On récupère tous les résultats de $_POST
				$name = $_POST['nomInst'];
				$desc = $_POST['descInst'];
				$sigle = $_POST['sigleInst'];
				$adresse = $_POST['adresseInst'];
				$codepost = $_POST['codepostalInst'];
				$phone = $_POST['telInst'];
				$email = $_POST['mailInst'];
				$logo = $_POST['logoInst'];
				$url = $_POST['urlInst'];
				$idinstparent = $_POST['parentInst'];
				// Si nouvelle ville
				if ($_POST['IdTown'] == 0)
				{
					$idtown = $this->Bdd_insert->add_town($_POST['newville']);
				}
				else
				{
					$idtown = $_POST['IdTown'];
				}
				$idregion = $_POST['IdRegion'];
				foreach($_POST['IdTypeInst'] as $value)
				{
					$tab_type[] = $value;
				}
				// On fait l'ajout dans la bdd
				// Création de l'institution
				$data['id'] = $this->Bdd_insert->add_institution($name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type);
				// On associe l'agent à cette institution
				$this->Bdd_insert->add_agentinst($data['id'], $this->session->userdata('id'));
				// On passe l'agent en droit = 2 s'il était à 1
				if ($this->session->userdata('droits') == 1)
				{
					$this->Bdd_insert->modif_agentdroit($this->session->userdata('id'), 2);
					// On met à jour la session
					$newdata = array('droits' => 2);
					$this->session->set_userdata($newdata);
				}
				// On stocke le nom de l'institution pour le passer à la vue
				$data['name'] = $_POST['nomInst'];
		
				// On charge la vue.
				$this->load->view('ajoutinst', $data);
			}
		}
		
		// Footer
		$this->load->view('footer');
	}

}
