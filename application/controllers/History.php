<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller{

	function __construct(){
	    parent::__construct();
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	    //$this->load->Model('ServicesModel','services');
	}


	public function index(){
		echo "Access denied!!";
	}
	public function recharge(){
		$column = "order_id, status, mobile, amount, operator, rcg_status, rcg_on";
		$whereCondition = 'rcg_by = '.$_SESSION["userId"];
		$data['historyRcg'] = $this->main->getSpecificRecord('recharge_details',$column,$whereCondition,'rcg_on');
		$data['title'] = "Recharge History";
		$this->load->view('header',$data);
		$this->load->view('historyRecharge',$data);
		$this->load->view('footer');
	}
	public function wallet(){
		$column = "in_amt, out_amt, remaining_amt, created_on";
		$whereCondition = 'user_id = '.$_SESSION["userId"];
		$data['historywallet'] = $this->main->getSpecificRecord('wallet',$column,$whereCondition,'created_on');
		$data['title'] = "Wallet Passbook";
		$this->load->view('header',$data);
		$this->load->view('historyWallet',$data);
		$this->load->view('footer');
	}
}