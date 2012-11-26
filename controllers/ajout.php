<?php
class Ajout extends CI_Controller {

	// La fonction index sert pour le choix entre ajout inst et ajout dataset
	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Saisie d'une nouvelle m&eacute;tadonn&eacute;e";
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
			$this->load->view('ajout');
		}

		// Footer
		$this->load->view('footer');
	}	
}
?>
