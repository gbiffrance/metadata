<?php
class Modifagent extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Utilisateur modifi&eacute;";
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
		
			$this->form_validation->set_rules('nomAgent','Nom','required|max_length[40]');
			$this->form_validation->set_rules('emailAgent','Email','required|valid_email|max_length[50]');
			$this->form_validation->set_rules('nameOrga','Nom organisation','required|max_length[60]');
			$this->form_validation->set_rules('IdDroit','Droits','required');
			$this->form_validation->set_rules('IdInstlie[]','Inst lie','');
			$this->form_validation->set_rules('IdInstnonlie[]','Inst non lie','');
			$this->form_validation->set_rules('IdDatalie[]','Data lie','');
			$this->form_validation->set_rules('IdDatanonlie[]','Data non lie','');
		
			if ($this->form_validation->run() == TRUE)
			{
				// On récupère les résultats de $_POST
				$idagent = $_POST['IdAgent'];
				$nom = $_POST['nomAgent'];
				$mail = $_POST['emailAgent'];
				$nameOrga = $_POST['nameOrga'];
				$iddroit = $_POST['IdDroit'];
				// On met à jour l'agent
				$this->Bdd_insert->update_agent($idagent, $nom, $mail, $nameOrga);
				// Et ses droits
				$this->Bdd_insert->modif_agentdroit($idagent, $iddroit);
				// On gère les institutions
				// Institutions liées à délier
				if(isset($_POST['IdInstlie']))
				{
					foreach($_POST['IdInstlie'] as $value)
					{
						$this->Bdd_insert->delete_agentinst($value, $idagent);
					}
				}
				// Institutions à lier
				if(isset($_POST['IdInstnonlie']))
				{
					foreach($_POST['IdInstnonlie'] as $value)
					{
						$this->Bdd_insert->add_agentinst($value, $idagent);
					}
				}
				// On gère les datasets
				// Datasets liés à délier
				if(isset($_POST['IdDatalie']))
				{
					foreach($_POST['IdDatalie'] as $value)
					{
						$this->Bdd_insert->delete_agentdata($value, $idagent);
					}
				}
				// Datasets à lier
				if(isset($_POST['IdDatanonlie']))
				{
					foreach($_POST['IdDatanonlie'] as $value)
					{
						$this->Bdd_insert->add_agentdata($value, $idagent);
					}
				}
			}
			else
			{
				$idagent = $_POST['IdAgent'];
			}

			// On récupère les infos de l'agent de la bdd (meilleur moyen de vérifier que les maj se sont faites)
			$data['agent'] = $this->Bdd_select->get_agent($idagent);
			// La liste des droits
			$data['droits'] = $this->Bdd_select->list_droits();
			// La liste des inst qui lui sont liées (possibilité d'en enlever)
			$data['instlie'] = $this->Bdd_select->list_inst($idagent);
			// La liste des inst qui ne lui sont pas liées (possibilité d'en rajouter)
			$data['instnonlie'] = $this->Bdd_select->list_instnonagent($idagent);
			// la liste des datasets qui lui sont liés (possibilité d'en enlever)
			$data['datalie'] = $this->Bdd_select->list_dataset($idagent);
			// la liste des datasets qui ne lui sont pas liés (possibilité d'en rajouter)
			$data['datanonlie'] = $this->Bdd_select->list_datasetnonagent($idagent);
			// On appelle la vue gestion
			$this->load->view('gestion', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
}
?>
