<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->load->database();
	    $this->load->helper('url');
	    $this->load->library('session');
	}


	public function index(){
		$sql = "SELECT * FROM users WHERE email = ? AND password = ? AND status = 1";
		$query = $this->db->query($sql, array($_POST['username'], md5($_POST['password'])));
		if($query->num_rows() > 0){
			$row = $query->row();

			if (isset($row)){
			    $newdata = array(
			    	'userId'	=> $row->user_id,
			        'username'  => 'johndoe',
			        'email'     => $row->email,
			        'userType'	=> $row->user_type,
			        'loggedIn' => TRUE
				);

				$this->session->set_userdata($newdata);
				redirect($this->config->item('base_url').'home');
			}
		}else{
			$this->session->set_flashdata("msg","Username/Password incorrect");
			redirect($this->config->item('base_url').'login');
		}
	}
}
