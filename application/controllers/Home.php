<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->load->database();
	    $this->load->helper('url');
	    $this->load->library('session');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	}


	public function index(){
		$data['title'] = "Welcome Page";
		$this->load->view('header',$data);
		$this->load->view('home', $data);
		$this->load->view('footer');
	}
}
