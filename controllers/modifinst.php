<?php
class Modifinst extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Institution modifi&eacute;e";
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
			$this->load->model('Bdd_select');
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
					// On vérifie que le nouveau nom n'est pas déjà dans la base
					// On récupère tous les noms
					$tab_temp = $this->Bdd_select->list_ville();
					$exist = 0;
					// On teste si le nouveau nom existe déjà dans la base
					foreach($tab_temp as $item2)
					{
						// Si oui, on stocke l'Id
						if(strcasecmp($item2['NameTown'], $_POST['newville']) == 0)
						{
							$idtown = $item2['IdTown'];
							$exist = 1;
						}
					}
					// Si non, on le rajoute
					if($exist == 0)
					{
						$idtown = $this->Bdd_insert->add_town($_POST['newville']);
					}
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
				$id = $_POST['idInst'];
				// On fait la maj dans la bdd
				$this->Bdd_insert->update_institution($id, $name, $desc, $sigle, $adresse, $codepost, $phone, $email, $logo, $url, $idinstparent, $idregion, $idtown, $tab_type);
				// On stocke le nom et l'id de l'institution pour le passer à la vue
				$data['name'] = $_POST['nomInst'];
				$data['id'] = $_POST['idInst'];
		
				// On charge la vue.
				$this->load->view('ajoutinst', $data);
			}
		}
		
		// Footer
		$this->load->view('footer');
	}
}
