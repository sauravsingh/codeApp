<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesModel extends CI_Model {

	function __construct(){
	    parent::__construct();
	    $this->load->database();
	}

	function getCategory(){
		$sql = "SELECT * FROM services_category WHERE status = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getSubCategory($cateId){
		$sql = "SELECT * FROM services_subcategory WHERE category_id=".$cateId." and status=1 ORDER BY services_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllSubCategory($cateId){
		$sql = "SELECT * FROM services_subcategory WHERE category_id=".$cateId." ORDER BY services_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getOperatorNameById($id){
		$sql = "SELECT services_name FROM services_subcategory WHERE services_id=".$id;
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result->services_name;
	}

	function getOperatorNameByCode($code){
		$sql = "SELECT services_name FROM services_subcategory WHERE services_code='".$code."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result->services_name;
	}
}
