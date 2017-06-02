<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller{

	function __construct(){
	    parent::__construct();
	    /*$this->load->library('session');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }*/
	    //$this->load->Model('walletModel');
	}
	function index(){
		echo "Access denied!";
	}
	function init(){
		//http://122.172.208.202/MARSrequest/?operator=RA&number=9900122334&amount=10&reqref?=A0000001&USERID=USERID&PASSWORD=PASSWORD
		echo $_GET['operator']."<br>";
		echo $_GET['number']."<br>";
		echo $_GET['amount']."<br>";
		echo $_GET['reqref?']."<br>";
		echo $_GET['USERID']."<br>";
		echo $_GET['PASSWORD'];
	}

	function cUrlCall($data=""){
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "http://122.180.87.159/MARSrequest/?",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => $data,
		);
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		if(curl_error($ch)){
		    echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		print_r($result);
		//return $result;
	}
	function rechargeCall(){
		$data = array(
			'operator' => 'RA',
			'number' => '9900122334',
			'amount' => '10',
			'reqref?' => 'A0000001',
			'USERID' => 'USERID',
			'PASSWORD' => 'PASSWORD'
			);
		$response = $this->cUrlCall($data);
		print_r($response);
	}
	function checkConnection(){
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "http://122.180.87.159/MARSConnectionStatus/",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		if(curl_error($ch)){
		    echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		print_r($result);
	}
}