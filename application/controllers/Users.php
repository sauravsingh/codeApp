<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	    $this->load->helper('form');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	}
	function addUser(){
		$data['title'] = "Add User";
		$data['userType'] = $this->main->getUserType();
		$this->load->view('header', $data);
		$this->load->view('addUser', $data);
		$this->load->view('footer');
	}
	function addUserRecord(){
		$data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'password' => md5($_POST['pwd']),
			'user_type' => $_POST['userType'],
			'created_by' => $_SESSION['userId'],
			'ip' => $_SERVER['REMOTE_ADDR'],
			);
		$dataExist = array(
			'email' => $_POST['email']
			);
		$queryExist = $this->main->checkExistRecord('users',$dataExist);
		if($queryExist == 0){
			$this->main->insertQuery('users',$data);
			echo "Record has been inserted successfully";	
		}
		else{
			echo "Email id already exists";
		}		
	}
	function usersList(){
		$data['title'] = "Users List";		
		$this->load->view('header', $data);
		$this->load->view('usersList', $data);
		$this->load->view('footer');
	}
	function listByType(){
		$id = $this->main->getSingleRecord('users_group','users_group_id','users_group_slang',$_POST['name']);
		$queryWhere = array(
			'user_type' => $id,
			'status' => 1
			);
		$data = $this->main->getMultiRecord('users',$queryWhere);
		if(count($data) > 0){
			echo "<table class='table table-border'><tr><th>Name</th><th>Email</th><th>Phone</th></tr>";
			foreach ($data as $rowData) {
				$phone = empty($rowData->phone) ? "NA" : $rowData->phone;
				echo "<tr><td>".ucfirst($rowData->name)."</td><td>".$rowData->email."</td><td>".$phone."</td></tr>";
			}
			echo "</table>";
		}
		else{
			echo "<br><div class='text-center'>No Record found!</div>";
		}
	}
}
