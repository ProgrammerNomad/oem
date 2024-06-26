<?php 

class Model_subcategory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
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
		if($id) {
			$sql = "SELECT * FROM subcategories";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM subcategories";
		$query = $this->db->query($sql,array($this->session->userdata('itmid')));
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
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('subcategories', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('subcategories');
			return ($delete == true) ? true : false;
		}
	}

}