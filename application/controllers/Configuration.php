<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	    $this->load->helper('form');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	}


	public function index(){
		$data['title'] = "Configure the panel";
		$this->load->view('header');
		$this->load->view('configuration', $data);
		$this->load->view('footer');
	}
	public function operatorConfig(){
		$this->load->Model('services');
		$data['serviceList'] = $this->services->getAllSubCategory("1");
		$data['title'] = "Mobile Operator Setting";
		$this->load->view('header');
		$this->load->view('mobileConfig', $data);
		$this->load->view('footer');
	}
}
