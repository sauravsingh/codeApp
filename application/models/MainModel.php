<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {

	function __construct(){
	    parent::__construct();
	    $this->load->database();
	}
	function getDetailById($id,$val){
		$this->db->select($val);
		$query = $this->db->get_where('users', array('user_id' => $id));
		$result = $query->row();
		return ucfirst($result->$val);
	}
	function getDetailsFromTabById($id,$idName,$column,$table){
		$this->db->select($column);
		$query = $this->db->get_where($table, array($idName => $id));
		$result = $query->row();
		return ucfirst($result->$column);
	}
	function getWalletBalById($id){
		$this->db->select('remaining_amt');
		$this->db->order_by('wallet_id','desc');
		$query = $this->db->get_where('wallet', array('user_id' => $id, 'status' => 1));
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->remaining_amt;
		}
		else{
			return '0';
		}
	}
	function insufficientBar(){
		$walletBal = $this->getWalletBalById($_SESSION['userId']);
		if($walletBal < 100){
			$band = "<div class='btn btn-danger fullWidth'>You have insufficient balance in your wallet, kindly recharge your account!</di>";
			echo $band;
		}
		else{

		}
	}
	function getUserType(){
		$this->db->select('*');
		$this->db->order_by('users_group_id','ASC');
		$query = $this->db->get_where('users_group', array('users_group_status' => 1));
		$result = $query->result();
		return $result;
	}
	function insertQuery($table,$data){
		return $this->db->insert($table, $data);
	}
	function checkExistRecord($table,$data){
		$query = $this->db->get_where($table, $data);
		return $query->num_rows();
	}
	function getSingleRecord($table,$column,$whereField,$where){
		$this->db->select($column);
		$query = $this->db->get_where($table, array($whereField => $where));
		$result = $query->row();
		return $result->$column;
	}
	function getSpecificRecord($table,$columnName,$whereCondition,$orderBy=""){
		$this->db->select($columnName);
		if($orderBy != ""){
			$this->db->order_by($orderBy, 'DESC');
		}		
		$query = $this->db->get_where($table, $whereCondition);
		$result = $query->result();
		return $result;
	}
	function getMultiRecord($table,$whereCondition){
		$this->db->select('*');
		$query = $this->db->get_where($table, $whereCondition);
		$result = $query->result();
		return $result;
	}
	function getUserTypeById($id,$column){
		$sql = "SELECT ".$column." FROM users u JOIN users_group ug ON u.user_type=ug.users_group_id WHERE u.user_id=".$id;
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result->$column;
	}
	function goBack(){
		$output = '<div class="col-lg-2"><br><br>  
                <button class="btn btn-primary" onclick="window.history.back()">Back</button>
            </div>';
        return $output;
	}
}