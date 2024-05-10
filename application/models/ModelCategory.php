<?php

class ModelCategory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}



	public function getParentCat()
	{
		$query = $this->db->query("SELECT * FROM `categories` WHERE `parent_category` = '0'");
		return $query->result();
	}
	public function getChildCat($id)
	{
		$query = $this->db->query("SELECT * FROM `categories` WHERE `parent_category` = '$id'");
		return $query->result();
	}
	public function getDocFiles($id)
	{
		$query = $this->db->query("SELECT * FROM `sales_doc` WHERE `category_id` = '$id'");
		return $query->result();
	}
	public function getCategory($id)
	{

		$sql = "SELECT * FROM categories WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();

	}
















	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM subcategories ";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCategoryData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM subcategories";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM subcategories";
		$query = $this->db->query($sql, array($this->session->userdata('itmid')));
		return $query->result_array();
	}
	public function create($data)
	{
		if (!empty($data)) {
			$insert = $this->db->insert('subcategories', $data);
			return ($insert == true) ? true : false;
		}

		// print_r($data);die();
	}
	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('subcategories', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('subcategories');
			return ($delete == true) ? true : false;
		}
	}

}