<?php

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM categories WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCategoryData($id = null)
	{
		if ($id->name) {
			$sql = "SELECT * FROM categories ";
			$query = $this->db->query($sql, array($id->name));
			return $query->row_array();
		}

		$sql = "SELECT * FROM categories ";
		$query = $this->db->query($sql, array($this->session->userdata('itmid')));
		return $query->result_array();
	}
	public function getParentCategoryNameById($parentCategoryId)
	{

		$sql = "SELECT * FROM categories WHERE id = ?";
		$query = $this->db->query($sql, array($parentCategoryId));
		return $query->row_array();
	}


	public function create($data)
	{
		if ($data) {
			$insert = $this->db->insert('categories', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function updatedata($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$query = $this->db->get('categories');
			return $query->row_array();
		} else {
			return null;
		}
	}


	public function update($data, $id)
	{

		// print_r($data);die();
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('categories', $data);
			return ($update == true) ? true : false;
		}
	}




	public function GetAllCat()
	{
		$query = $this->db->query("SELECT * from categories");
		return $query->result();

	}



	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('categories');
			return ($delete == true) ? true : false;
		}
	}

}