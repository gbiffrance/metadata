<?php
class Enregistrement extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// On gère les possibles erreurs du formulaire d'enregistrement
		// Si le formulaire d'enregistrement a été validé
		if (isset($_POST['email']))
		{
			// On charge la librairie de vérification des champs
			$this->load->library('form_validation');
			// Si des champs sont vides
			if (!$this->form_validation->required($_POST['email']) || !$this->form_validation->required($_POST['nom']) || !$this->form_validation->required($_POST['password']) || !$this->form_validation->required($_POST['password2']))
			{
				// On revoie le formulaire pré-rempli
				$data['error'] = "Les champs 'Email', 'Nom' et 'Mot de passe' doivent &ecirc;tre remplis.<br/>";
				$data['email'] = $_POST['email'];
				$data['nom'] = $_POST['nom'];
				$data['inst'] = $_POST['inst'];
			}
			// Si le mail est non valide
			else if (!$this->form_validation->valid_email($_POST['email']))
			{
				// On revoie le formulaire pré-rempli
				$data['error'] = "L'email n'est pas valide.<br/>";
				$data['nom'] = $_POST['nom'];
				$data['inst'] = $_POST['inst'];
			}
			// Si le mot de passe est différents dans les deux cases password
			else if ($_POST['password'] != $_POST['password2'])
			{
				// On revoie le formulaire pré-rempli
				$data['error'] = "Les deux champs 'Mot de passe' sont diff&eacute;rents.<br/>";
				$data['email'] = $_POST['email'];
				$data['nom'] = $_POST['nom'];
				$data['inst'] = $_POST['inst'];
			}
			// Si les champs sont valides
			else
			{
				// On charge le modèle de requête bdd
				$this->load->model('Bdd_select');
				$this->load->model('Bdd_insert');
				// On vérifie que l'email n'est pas déjà utilisé
				if (!$this->Bdd_select->get_infoAgent($_POST['email']))
				{
					// On rajoute l'agent dans la base de donnée
					$idagent = $this->Bdd_insert->add_agent($_POST['nom'], $_POST['password'], $_POST['email'], $_POST['inst']);
					// On met à jour la session
					$newdata = array(
                   'username'  => $_POST['nom'],
                   'id'				 => $idagent,
                   'email'     => $_POST['password'],
                   'droits'		 => 1
             		);
					$this->session->set_userdata($newdata);
					// On affiche un message
					$data['valide'] = "Bienvenue ".$_POST['nom'].", vous &ecirc;tes maintenant connect&eacute;(e)<br/>";
				}
				// Si le mail est déjà utilisé par un autre agent
				else
				{
					// On renvoie le formulaire pré-rempli + invitation à se connecter si on est déjà enregistré
					$data['error'] = "L'email est d&eacute;j&agrave; utilis&eacute; par un autre utilisateur. Si c'est vous, veuillez vous connecter au lieu de vous enregistrer.<br/>";
					$data['nom'] = $_POST['nom'];
					$data['inst'] = $_POST['inst'];
				}
			}
		}
		else
		{
			// On crée la variable data
			$data['essai'] = 0;
		}
			
		// Header
		$dataH['title'] = "Page d'enregistrement";
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
		$this->load->view('enregistrement', $data);
		
		// Footer
		$this->load->view('footer');
	}	
}
?>
