<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->load->library('session');
	    $this->load->helper('form');
	    if (!isset($_SESSION['userId'])) {
	    	redirect('login');
	    }
	    $this->load->Model('services');
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
				$msg = "<div class='form-group'><input type='text' id='mobileNo' name='mobileNo' class='form-control' placeholder='Enter 10 digit mobile number'></div>";
				$msg .= "<div class='form-group inlineBlock'><input type='radio' name='dataCardType' value='prepaid'><label>Prepaid</label></div>";
				$msg .= "<div class='form-group inlineBlock'><input type='radio' name='dataCardType' value='postpaid'><label>Postpaid</label></div>";
				$msg .= "<div class='form-group'><select id='rechargeComp' name='rechargeComp' class='form-control'>
				<option value='0'>Select Operator</option>";
				$serviceList = $this->serviceList();
				foreach ($serviceList as $rowSubCategory){
					$msg .= "<option value='".$rowSubCategory->services_id."'>".$rowSubCategory->services_name."</option>";
				}
				$msg .="</select></div>";
				$msg .= "<div class='form-group'><input type='text' id='rechargeAmt' name='rechargeAmt' class='form-control' placeholder='Enter recharge amount'></div>";
				$msg .= "<div class='form-group'><input type='submit' class='btn btn-success' id='submitMobBtn' value='Proceed' class='form-control'></div>";
				echo $msg;
				break;
			case 'dth': //dth layout
				$msg = "<div class='form-group'><input type='text' id='consumerNo' name='consumerNo' class='form-control' placeholder='Enter consumer id'></div>";
				$msg .= "<div class='form-group'><input type='text' id='consumerAltNo' name='consumerAltNo' class='form-control' placeholder='Enter alternate number'></div>";
				$msg .= "<div class='form-group'><input type='submit' class='btn btn-success' id='submitDthBtn' value='Proceed' class='form-control'></div>";
				echo $msg;
				break;
			default:
				# code...
				break;
		}
	}
}
