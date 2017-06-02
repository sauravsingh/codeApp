<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class walletModel extends CI_Model {

	function __construct(){
	    parent::__construct();
	    $this->load->database();
	    date_default_timezone_set('Asia/Kolkata');
	}
	function addAmtRequest($id){
		$this->db->trans_strict(FALSE);
		$this->db->trans_start();

		//fetch requested amount
		$dataTempGet = $this->db->get_where('wallet_temp', array('wallet_temp_id' => $id));
		$resultTempGet = $dataTempGet->row();
		//fetch amount from wallet
		$this->db->order_by('wallet_id', 'DESC');
		$dataGet = $this->db->get_where('wallet', array('user_id' => $id));	
		echo $dataGet->num_rows();
		$resultGet = $dataGet->row();
		echo $resultGet->remaining_amt;
		if($dataGet->num_rows() > 0){
			$resultGet = $dataGet->row();
			$totalBalance = $resultGet->remaining_amt+$resultTempGet->amount;
		}
		else{
			$totalBalance = 0+$resultTempGet->amount;
		}
		//insert record in wallet
		$dataInsertWallet = array(
			'user_id' => $resultTempGet->user_id,
			'in_amt' => $resultTempGet->amount,
			'remaining_amt' => $totalBalance,
			'created_on' => date('Y-m-d H:i:s'),
	        'created_by' => $_SESSION['userId'],
	        'status' => 1,
	        'ip' => $_SERVER['REMOTE_ADDR']
			);
		$this->main->insertQuery('wallet',$dataInsertWallet);
		$lastInsertedId = $this->db->insert_id();
		$this->db->set('status', 1);
		$this->db->where('wallet_temp_id', $id);
		$this->db->update('wallet_temp');
		//fetch remaining amount then add the balance
		/*$this->db->order_by('wallet_id', 'DESC');
		$dataGet = $this->db->get_where('wallet', array('user_id' => $userId));	
		//echo $dataGet->num_rows();	
		if($dataGet->num_rows() > 0){
			$resultGet = $dataGet->row();
			$totalBalance = $resultGet->remaining_amt+$amt;
		}
		else{
			$totalBalance = 0+$amt;
		}
		//insert the record
		$data = array(
	        'user_id' => $userId,
	        'in_amt' => $amt,
	        'created_on' => date('Y-m-d G:i:s'),
	        'created_by' => $_SESSION['userId'],
	        'status' => 0,
	        'ip' => $_SERVER['REMOTE_ADDR']
		);

		$this->db->insert('wallet', $data);
		$lastInsertedId = $this->db->insert_id();
		
		//update the record
		$this->db->set('remaining_amt', $totalBalance);
		$this->db->where('wallet_id', $lastInsertedId);
		$this->db->update('wallet');*/
		$this->db->trans_complete();
	}
	function requestedWallet($status){
		$query = $this->db->get_where('wallet_temp', array('status' => $status));
		return $query->result();
	}
	function approvedAmtRequested($id){
		$this->db->set(array('status' => 1,'modified_on' => date("Y-m-d H:i:s"), 'modified_by' => $_SESSION['userId']));
		$this->db->where('wallet_id', $id);
		return $this->db->update('wallet');
	}
}