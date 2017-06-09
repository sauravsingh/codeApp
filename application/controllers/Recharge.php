<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends CI_Controller{

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	    $this->load->helper('form');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	    $this->load->Model('ServicesModel','services');
	}


	public function index(){
		$data['title'] = "Make Recharge";
		$data['services'] = $this->services->getCategory();
		$this->load->view('header');
		$this->load->view('recharge', $data);
		$this->load->view('footer');
	}
	public function serviceList(){
		$categoryId = "1";//(!isset($_POST['id'])) ? '1' : $_POST['id'];
		return $this->services->getSubCategory($categoryId);
	}
	public function fieldLayout(){
		$subCatId = $_POST['id'];
		switch ($subCatId) {
			case 'mobile': //mobile layout
				$msg = "<h3>Mobile Recharge</h3>";
				$msg .= "<div class='form-group'><input type='hidden' id='hiddenField' name='hiddenField' class='form-control' value='mobile'></div>";
				$msg .= "<div class='form-group'><input type='text' id='mobileNo' name='mobileNo' class='form-control' placeholder='Enter 10 digit mobile number'></div>";
				$msg .= "<div class='form-group inlineBlock'><input type='radio' checked name='dataCardType' value='prepaid'><label>Prepaid</label></div>";
				$msg .= "<div class='form-group inlineBlock'><input type='radio' name='dataCardType' value='postpaid'><label>Postpaid</label></div>";
				$msg .= "<div class='form-group'><select id='rechargeComp' name='rechargeComp' class='form-control'>
				<option value='0'>Select Operator</option>";
				$serviceList = $this->serviceList();
				foreach ($serviceList as $rowSubCategory){
					$msg .= "<option value='".$rowSubCategory->services_code."'>".$rowSubCategory->services_name."</option>";
				}
				$msg .="</select></div>";
				$msg .= "<div class='form-group'><input type='text' id='rechargeAmt' name='rechargeAmt' class='form-control' placeholder='Enter recharge amount'></div>";
				$msg .= "<div class='form-group'><input type='submit' class='btn btn-success' onclick='submitForm()' id='submitMobBtn' value='Proceed' class='form-control' data-toggle='modal' data-target='#myModal'></div>";
				echo $msg;
				break;
			case 'dth': //dth layout
				$msg = "<h3>DTH Recharge</h3>";
				$msg .= "<div class='form-group'><input type='hidden' id='hiddenField' name='hiddenField' class='form-control' value='dth'></div>";
				$msg .= "<div class='form-group'><input type='text' id='consumerNo' name='consumerNo' class='form-control' placeholder='Enter consumer id'></div>";
				$msg .= "<div class='form-group'><input type='text' id='consumerAltNo' name='consumerAltNo' class='form-control' placeholder='Enter alternate number'></div>";
				$msg .= "<div class='form-group'><input type='submit' class='btn btn-success' id='submitDthBtn' value='Proceed' class='form-control'></div>";
				echo $msg;
				break;
			default:
				# code...
				break;
		}
	}
	function preview(){
		$data['title'] = "Verify your recharge";
		$data['heading'] = "Verify your details";
		$data['formVal'] = $this->filtertype($_POST);
		$this->load->view('header');
		$this->load->view('preview', $data);
		$this->load->view('footer');
	}
	function filtertype($data){
		if ($data['hiddenField'] == "mobile") {
			//case 'mobile':
				$returnData = form_open('recharge/proceed');
                $mobileData = array(
                    'type'  => 'hidden',
                    'name' => 'rcgType',
                    'class' => 'form-control readonly',
                    'value' => $data['hiddenField'],
                    'readonly' => 'readonly'
                    );
                $mobileData = array(
                    'type'  => 'text',
                    'name' => 'rechargeNumber',
                    'class' => 'form-control readonly',
                    'value' => $data['mobileNo'],
                    'readonly' => 'readonly'
                    );
                $rcgTypeData = array(
                    'type'  => 'text',
                    'name' => 'rechargeType',
                    'class' => 'form-control readonly',
                    'value' => ucfirst($data['dataCardType']),
                    'readonly' => 'readonly'
                    );
                $rechargeComp = array(
                    'type'  => 'hidden',
                    'name' => 'rechargeOperator',
                    'class' => 'form-control readonly',
                    'value' => $data['rechargeComp'],
                    'readonly' => 'readonly'
                    );
                $rechargeCompName = array(
                    'type'  => 'text',
                    'name' => 'operatorNameSh',
                    'class' => 'form-control readonly',
                    'value' => $this->services->getOperatorNameByCode($data['rechargeComp']),
                    'readonly' => 'readonly'
                    );
                $rechargeAmt = array(
                	'type'  => 'text',
                    'name' => 'rechargeAmt',
                    'class' => 'form-control readonly',
                    'value' => $data['rechargeAmt'],
                    'readonly' => 'readonly'
                    );
                $proceedBtn = array(
                	'type' => 'submit',
                	'name' => 'proceedBtn',
                	'class' => 'btn btn-success',
                	'value' => 'Proceed'
                	);
                
                
                $returnData .= "<table class='table tbale-border'><tr><td>Mobile Number: </td><td>".form_input($mobileData)."</td></tr>";
                $returnData .=  "<tr><td>Connection : </td><td>".form_input($rcgTypeData)."</td></tr>";
                $returnData .=  form_input($rechargeComp);
                $returnData .= "<tr><td>Operator Name: </td><td>".form_input($rechargeCompName)."</td></tr>";
                $returnData .=  "<tr><td>Recharge Amount: </td><td>".form_input($rechargeAmt)."</td></tr>";
                $returnData .=  "<tr><td>".form_input($proceedBtn)."</td><td>".$this->goBack()."</td></tr></table>";
                $returnData .= form_close();
				return $returnData;
			}
			else if($data['hiddenField'] == "dth"){
				$returnData = "";
				return $returnData;
			}				
		}
	//proceed for payment
	public function proceed(){
		$remainingWalletAmt = $this->main->getWalletBalById($_SESSION['userId']);
		if($remainingWalletAmt > $_POST['rechargeAmt']){
			$this->load->helper('api_helper');
			$connectionStatus = "true";//checkConnection();
			if($connectionStatus=="true"){
				$output = makeRecharge();
				//print_r($output);
				$customFunc = makeCustomMsg($output);
				if($customFunc['status'] == "success"){
					$dataArray = array(
						'order_id' => rand(1111111111,9999999999),
						'status' => 'success',
						'mobile' => $_POST['rechargeNumber'],
						'amount' => $_POST['rechargeAmt'],
						'operator' => $_POST['rechargeOperator'],
						'conn_type' => $_POST['rechargeType'],
						'ref_code' => $customFunc['refCode'],
						'mars_ref' => $customFunc['marsRef'],
						'api_response' => $output,
						'rcg_by' => $_SESSION['userId'],
						'rcg_on' => date('Y-m-d H:i:s'),
						'ip' => $_SERVER['REMOTE_ADDR']
						);
					$this->main->insertQuery('recharge_details',$dataArray);
					$layout = "<table class='table table-border'>";
					$layout .= "<tr><td>Status</td><td>Processed</td>";
					$layout .= "<tr><td>Number</td><td>".$_POST['rechargeNumber']."</td></tr>";
					$layout .= "<tr><td>Amount</td><td>".$_POST['rechargeAmt']."</td></tr>";
					$layout .= "<tr><td>Transaction Code</td><td>".$customFunc['refCode']."</td></tr>";
					$layout .= "</table>";
				}
				else if($customFunc['status'] == "error"){
					$dataArray = array(
						'order_id' => rand(1111111111,9999999999),
						'status' => 'error',
						'mobile' => $_POST['rechargeNumber'],
						'amount' => $_POST['rechargeAmt'],
						'operator' => $_POST['rechargeOperator'],
						'conn_type' => $_POST['rechargeType'],
						'ref_code' => $customFunc['refCode'],
						'rcg_err_code' => $customFunc['errorCode'],
						'rcg_err_msg' => $customFunc['message'],
						'api_response' => $output,
						'rcg_by' => $_SESSION['userId'],
						'rcg_on' => date('Y-m-d H:i:s'),
						'ip' => $_SERVER['REMOTE_ADDR']
						);
					$this->main->insertQuery('recharge_details',$dataArray);
					$layout = "<table class='table table-border'>";
					$layout .= "<tr><td>Status</td><td>Not Processed</td>";
					$layout .= "<tr><td>Number</td><td>".$_POST['rechargeNumber']."</td></tr>";
					$layout .= "<tr><td>Amount</td><td>".$_POST['rechargeAmt']."</td></tr>";
					$layout .= "<tr><td>Transaction Code</td><td>".$customFunc['refCode']."</td></tr>";
					$layout .= "<tr><td>Message</td><td>".$customFunc['message']."</td></tr>";
					$layout .= "</table>";
				}
				elseif($customFunc['status'] == "unknown"){
					$dataArray = array(
						'order_id' => rand(1111111111,9999999999),
						'status' => 'unknown',
						'mobile' => $_POST['rechargeNumber'],
						'amount' => $_POST['rechargeAmt'],
						'operator' => $_POST['rechargeOperator'],
						'conn_type' => $_POST['rechargeType'],
						'rcg_by' => $_SESSION['userId'],
						'rcg_on' => date('Y-m-d H:i:s'),
						'ip' => $_SERVER['REMOTE_ADDR']
						);
					$this->main->insertQuery('recharge_details',$dataArray);
					$layout = "<table class='table table-border'>";
					$layout .= "<tr><td>Status</td><td>Unknown Request</td>";
					$layout .= "<tr><td>Number</td><td>".$_POST['rechargeNumber']."</td></tr>";
					$layout .= "<tr><td>Amount</td><td>".$_POST['rechargeAmt']."</td></tr>";
					$layout .= "<tr><td>Message</td><td>Unknown Request, try with correct data</td></tr>";
					$layout .= "</table>";
				}
				$data['title'] = "Recharge response";
				$data['layout'] = $layout;
				$this->load->view('header',$data);
				$this->load->view('recharge_output', $data);
				$this->load->view('footer');
			}
			else{
				$data['title'] = "Error Page";
				$data['errorMsg'] = "Something went wrong, please contact to admin!!!";
				$this->load->view('header',$data);
				$this->load->view('error', $data);
				$this->load->view('footer');
			}
		}
		else{
			$data['title'] = "Insufficient balance";
			$this->load->view('header');
			$this->load->view('insufficientBalPage', $data);
			$this->load->view('footer');
		}
	}
	public function goBack(){
		$backBtn = array(
        	'type' => 'button',
        	'class' => 'btn btn-info',
        	'value' => 'Back',
        	'onclick' => 'window.history.back()'
        	);
		return form_input($backBtn);
	}
}
