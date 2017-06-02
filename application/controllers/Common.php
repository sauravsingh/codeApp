<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	}


	public function logout(){
		$data['title'] = "Logout the session";
		$this->session->sess_destroy();
		echo "<center><h3>You have been logout, wait page is redirecting...</h3></center>";
		header("Refresh:5;url=".base_url()."login");
	}
	
}
