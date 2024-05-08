<?php

class Model_salesdoc extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM sales_doc WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getSalescodeData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM sales_doc";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sales_doc";
		$query = $this->db->query($sql, array($this->session->userdata('itmid')));
		return $query->result_array();
	}
	public function getParentCategoryNameById($categoryId)
	{
		$queryResult = $this->db->query("SELECT name FROM categories WHERE id = ?", array($categoryId));

		$categoryName = '';
		if ($queryResult->num_rows() > 0) {
			$row = $queryResult->row_array();
			$categoryName = $row['name'];
		}

		return $categoryName;
	}

	public function storesales($data)
	{

		if ($data) {
			$insert = $this->db->insert('sales_doc', $data);
			return ($insert == true) ? true : false;
		}

	}


	public function create($data, $file)
	{

		if ($data && $file) {
			$insert = $this->db->insert('sales_doc', $data && $file);
			return ($insert == true) ? true : false;
		}

	}
	public function updatedata($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$query = $this->db->get('sales_doc');
			return $query->row_array();
		} else {
			return null;
		}
	}


	public function update($data, $id)
	{

		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('sales_doc', $data);
			return ($update == true) ? true : false;
		}
	}
	public function updatesales($data, $id)
	{

		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('sales_doc', $data);
			return ($update == true) ? true : false;
		}
	}

	public function deleteSalesDoc($DeleteFile, $id, $Type)
	{
		//echo $Type;

		$sql = "UPDATE sales_doc SET $Type = '$DeleteFile' WHERE id = $id";
		$query = $this->db->query($sql, array($id));
		return true;

	}

	public function GetAllCat()
	{
		$query = $this->db->query("SELECT * from sales_doc");
		return $query->result();

	}

	public function GetSalesDoc($id)
	{

		$query = $this->db->query("SELECT * from sales_doc WHERE id = $id");
		return $query->result();

	}


	public function GetCatData()
	{
		$query = $this->db->query("SELECT * from categories");
		return $query->result();

	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('sales_doc');
			return ($delete == true) ? true : false;
		}
	}

}