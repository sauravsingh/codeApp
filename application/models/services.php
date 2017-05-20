<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class services extends CI_Model {

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
}
