<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

	function checkConnection(){
		$url = "http://122.180.87.159:91/MARSConnectionStatus/";
		$connStatus = file_get_contents($url);
		if($connStatus == "MARS_ALIVE"){
			return true;
		}
		else{
			return false;
		}
	}
	function makeRecharge($operator="",$number="",$amount=""){
		$randomVal = substr(md5(uniqid(rand(), true)), 0, 8);
		//$url = "http://122.180.87.159:91/MARSrequest/?operator=RA&number=1231231230&amount=10&reqref=".$randomVal;
		//$outputMsg = file_get_contents($url);
		$outputMsg = "REQUEST ACCEPTED your ref=e3019121 mars_reference=RC307912735";
		//$outputMsg = "REQUEST ERROR errorno=10;your ref=b726e6eb;mars_reason=Identical recharge already in queue";
		return $outputMsg;
	}
	function makeCustomMsg($outputMsg=''){
		if (strpos($outputMsg, 'REQUEST ACCEPTED') !== false) {
		    $array = explode("=", $outputMsg);
		    //print_r($array);
		    $outputArray = array(
		    	'status' => 'success',
		    	'response' => explodeString($array[0], ' ',0)." ".explodeString($array[0], ' ',1),
		    	'refCode' => explodeString($array[1], ' ', 0),
		    	'marsRef' => explodeString($array[2], ' ', 0)
		    	);
		    return $outputArray;
		    /*echo "Response: ".explodeString($array[0], ' ',0)." ".explodeString($array[0], ' ',1)."<br>";
		    echo "Ref code: ".explodeString($array[1], ' ', 0)."<br>";
		    echo "Mars Reference: ".explodeString($array[2], ' ', 0);*/
		}
		elseif (strpos($outputMsg, 'REQUEST ERROR') !== false) {
			$array = explode("=", $outputMsg);
			//print_r($array);
			$outputArray = array(
				'status' => 'error',
				'response' => $array[0],
				'errorCode' => explodeString($array[1], ';', 0),
				'refCode' => explodeString($array[2], ';', 0),
				'message' => errorMsg($this->explodeString($array[1], ';', 0))
				);
			return $outputArray;
			/*echo "Response: ".$array[0]."<br>";
			echo "Error Code: ".explodeString($array[1], ';', 0)."<br>";
			echo "Ref Code: ".explodeString($array[2], ';', 0)."<br>";
			echo "Reason: ".$array[3]."<br>";
			echo "Message: ".errorMsg($this->explodeString($array[1], ';', 0))."<br>";*/
		}
		else{
			$outputArray = array(
				'status' => 'unknown',
				'message' => 'Output not set'
				);
			$outputArray;
		}
	}
	function explodeString($array, $delimeter, $return){
		$explodeArray = explode($delimeter, $array);
		return $explodeArray[$return];
	}
	function errorMsg($errorCode){
		switch ($errorCode) {
			case '1':
				return "Mobile Number not entered";
				break;
			
			case '2':
				return "Amount not entered";
				break;
			
			case '3':
				return "Account disabled";
				break;
			
			case '4':
				return "Insufficient Balance in your account";
				break;
			
			case '5':
				return "Unknown Operator, please contact to admin";
				break;
			
			case '6':
				return "Recharge disabled for this operator, contact to admin";
				break;
			
			case '7':
				return "Operator not allowed for this account, contact to admin";
				break;
			
			case '8':
				return "Recharge amount can not be accepted, contact to admin";
				break;
			
			case '9':
				return "Recharge amount not accepted, contact to admin";
				break;
			
			case '10':
				return "Please try after sometime, your previous recharge is already in queue";
				break;
			
			default:
				return "Contact to admin";
				break;
		}
	}

//http://122.180.87.159:91/MARSrequest/?operator=RA&number=1231231230&amount=10&reqref=A0000002&userid=marskrcg&password=k@rcg%02