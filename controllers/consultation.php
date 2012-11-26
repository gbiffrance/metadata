<?php
class Consultation extends CI_Controller {

	function index()
	{
		// Session
		$this->load->library('session');
		
		// Header
		$dataH['title'] = "Consultation des m&eacute;tadonn&eacute;es fran&ccedil;aises";
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
		$this->load->view('consultation');
		
		// Footer
		$this->load->view('footer');
	}	
}
?>
