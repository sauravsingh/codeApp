<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller{

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	    $this->load->helper('form');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	    $this->load->Model('walletModel');
	}

	function requestBalance(){
		$data['title'] = "Request to add balance";
		$this->load->view('header');
		$this->load->view('requestBalance', $data);
		$this->load->view('footer');
	}
	function requestAmt(){
		$dataRequsted = array(
			'user_id' => $_SESSION['userId'],
			'amount' => $_POST['amt'],
			'created_on' => date('Y-m-d H:i:s'),
			'created_by' => $_SESSION['userId'],
			'ip' => $_SERVER['REMOTE_ADDR']
			);
		$output = $this->main->insertQuery('wallet_temp',$dataRequsted);
		if($output == 1){
			echo "Amount of INR ".$_POST['amt']." is requested to admin, they will add this amount in your wallet soon!";	
		}
		else{
			echo "Something went wrong, contact to admin!";
		}
	}
	function requestedAmount(){
		$data['requestedList'] = $this->walletModel->requestedWallet(0);
		$data['title'] = "Requested balance list";
		$this->load->view('header');
		$this->load->view('requestedAmount', $data);
		$this->load->view('footer');
	}
	function approvedAmtAjax(){
		$data = $this->walletModel->addAmtRequest($_POST['id']);
		echo $data;
		if($data == 1){
			$this->session->set_flashdata('msg', 'Approved.');
		}
		else{
			$this->session->set_flashdata('msg', 'Something went wrong, kinldy contact to maintenace team.');
		}
	}
}