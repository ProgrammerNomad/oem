<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_SubCategory extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sub Category';
		$this->load->model('Model_subcategory');
		$this->load->model('Admin_model');
		$this->data['category'] = $this->Admin_model->fetch_data("categories", "*",['active'=>1])->result();
		$this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*",['active'=>1])->result();
		$this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->session->userdata('itmid'),'active'=>1])->row();
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('subcategory/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchCategoryDataById($id) 
	{
		if($id) {
			$data = $this->Model_subcategory->getCategoryData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
	public function fetchCategoryData()
	{
		$result = array('data' => array());

		$data = $this->Model_subcategory->getCategoryData();

		foreach ($data as $key => $value) {

			// button
			$catname = $this->Admin_model->fetch_data("categories", "*",['id'=>$value['category_id']])->row();
			$buttons = '';

			if(in_array('updateCategory', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteCategory', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['category_id'],
				$value['subcategory_name'],

				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		// print_r($_REQUEST);

		// die();

		if(!in_array('createCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();



		$this->form_validation->set_rules('category_id', 'Category name', 'trim|required');
		$this->form_validation->set_rules('subcategory_name', 'subcategory name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		// $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'category_id' => $this->input->post('category_id'),
        		'active' => $this->input->post('active'),	
        		'subcategory_name' => $this->input->post('subcategory_name'),
        		// 'brand_id' => $this->session->userdata('itmid')
        	);


        	$create = $this->Model_subcategory->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
       else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
			// print_r($create);die();

        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	
	public function update($id)
	{

		if(!in_array('updateCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_category_id', 'Category name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
            $this->form_validation->set_rules('edit_subcategory_name', 'subcategory name', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'category_id' => $this->input->post('edit_category_id'),
	        		'active' => $this->input->post('edit_active'),
	        		'subcategory_name' => $this->input->post('edit_subcategory_name'),
	        		// 'brand_id' => $this->session->userdata('itmid')	
	        	);

	        	$update = $this->Model_subcategory->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the category information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$category_id = $this->input->post('category_id');

		$response = array();
		if($category_id) {
			$delete = $this->Model_subcategory->remove($category_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}