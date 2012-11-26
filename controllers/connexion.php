<?php
class Connexion extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// On gère les possibles erreurs du formulaire de connexion
		// Si le formulaire de connexion a été validé
		if (isset($_POST['email']))
		{
			// On charge la librairie de vérification des champs
			$this->load->library('form_validation');
			// Si l'un des champs est vide
			if (!$this->form_validation->required($_POST['email']) || !$this->form_validation->required($_POST['password']))
			{
				$data['error'] = "Les deux champs doivent &ecirc;tre remplis.<br/>";
				// On pré-rempli avec l'email éventuellement
				$data['email'] = $_POST['email'];				
			}
			// Si les champs sont valides
			else
			{
				// On appelle le modèle de requête bdd
				$this->load->model('Bdd_select');
				// On vérifie la valeur du password
				// Si l'email n'est pas trouvé
				if (!$this->Bdd_select->get_infoAgent($_POST['email']))
				{
					// On affiche le formulaire
					$data['error'] = "L'email est invalide.<br/>";
				}
				else
				{
					$Agent = $this->Bdd_select->get_infoAgent($_POST['email']);
					// Si le password est invalide (on pense à hasher le mot de passe pour le comparer et à enlever les caractères blancs du retour bdd)
					if (trim($Agent->PassAgent) != $this->Bdd_select->hash_mdp($_POST['password']))
					{
						// On pré-rempli avec l'email
						$data['email'] = $_POST['email'];
						$data['error'] = "Le mot de passe est invalide.<br/>";
					}
					// Si le password est valide
					else
					{
						// On met à jour la session
						$newdata = array(
                   'username'  => $Agent->NameAgent,
                   'id'				 => $Agent->IdAgent,
                   'email'     => $Agent->EmailAgent,
                   'droits'		 => $Agent->IdDroit
              		);
						$this->session->set_userdata($newdata);
						// On affiche un message
						$data['valide'] = "Bienvenue $Agent->NameAgent, vous &ecirc;tes maintenant connect&eacute;(e)<br/>";
					}
				}
			}
		}
		else
		{
			// On crée la variable data
			$data['essai'] = 0;
		}
		
		// Header
		$dataH['title'] = "Page de connexion";
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
		// On affiche le formulaire
		$this->load->view('connexion', $data);
		
		// Footer
		$this->load->view('footer');
	}
	
}
?>
