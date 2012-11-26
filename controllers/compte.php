<?php
class Compte extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modifier son compte";
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
			$data['agent'] = $this->Bdd_select->get_agent($this->session->userdata('id'));
			// On appelle la vue
			$this->load->view('compte', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
	
	// Si on modifie son compte
	function modif()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Modifier son compte";
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
			$this->form_validation->set_rules('passAgent','Password','max_length[50]|matches[passAgent2]');
			$this->form_validation->set_rules('passAgent2','Password2','max_length[50]');
		
			$idagent = $_POST['IdAgent'];
			if ($this->form_validation->run() == TRUE)
			{
				// On récupère les infos du formulaire
				$nom = $_POST['nomAgent'];
				$mail = $_POST['emailAgent'];
				// On initialise la variable à null si on ne modifie pas le password
				$password = NULL;
				if(isset($_POST['password']))
				{
					$password = $_POST['password'];
				}
				$orga = $_POST['nameOrga'];
				// On met à jour l'agent
				$this->Bdd_insert->update_agent($idagent, $nom, $mail, $orga, $password);
			}
		
			// On récupère les infos de l'agent de la bdd (meilleur moyen de vérifier que les maj se sont faites)
			$data['agent'] = $this->Bdd_select->get_agent($idagent);
			// On met à jour la session
				$newdata = array(
		                 'username'  => $data['agent']->NameAgent,
		                 'email'     => $data['agent']->EmailAgent
		            		);
			$this->session->set_userdata($newdata);
			// On appelle la vue
			$this->load->view('compte', $data);
		}
		
		// Footer
		$this->load->view('footer');
	}
}
?>
