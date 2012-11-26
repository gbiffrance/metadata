<?php
class Deconnexion extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// On supprime les informations de la session
		$this->session->sess_destroy();
		
		// Header
		$dataH['title'] = "Page de d&eacute;connexion";
		$dataH['log'] = "non";
		$this->load->view('header', $dataH);
		
		// Body
		
		// Footer
		$this->load->view('footer');
	}
}
?>
