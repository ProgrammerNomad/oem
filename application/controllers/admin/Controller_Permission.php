<?php 

class Controller_Permission extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Permission';
		

		$this->load->model('model_groups');
		$this->load->model('Admin_model');
		$this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*",['active'=>1])->result();
		$this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->session->userdata('itmid'),'active'=>1])->row();
	}

	/* 
	* It redirects to the manage group page
	* As well as the group data is also been passed to display on the view page
	*/
	public function index()
	{

		if(!in_array('viewGroup', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$groups_data = $this->model_groups->getGroupData();
		$this->data['groups_data'] = $groups_data;

		$this->render_template('permission/index', $this->data);
	}	

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation is for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{

		if(!in_array('createGroup', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('group_name', 'Permission name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
        	$data = array(
        		'group_name' => $this->input->post('group_name'),
        		'permission' => $permission
        	);

        	$create = $this->model_groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/Controller_Permission/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/Controller_Permission/create', 'refresh');
        	}
        }
        else {
            // false case
            $this->render_template('permission/create', $this->data);
        }	
	}

	/*
	* If the validation is not valid, then it redirects to the edit group page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function edit($id = null)
	{

		if(!in_array('updateGroup', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {

			$this->form_validation->set_rules('group_name', 'Permission name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
	            $permission = serialize($this->input->post('permission'));
	            
	        	$data = array(
	        		'group_name' => $this->input->post('group_name'),
	        		'permission' => $permission
	        	);

	        	$update = $this->model_groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('admin/Controller_Permission/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('admin/Controller_Permission/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
	            // false case
	            $group_data = $this->model_groups->getGroupData($id);
				$this->data['group_data'] = $group_data;
				$this->render_template('permission/edit', $this->data);	
	        }	
		}
	}

	/*
	* It removes the removes information from the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function delete($id)
	{

		if(!in_array('deleteGroup', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {

				$check = $this->model_groups->existInUserGroup($id);
				if($check == true) {
					$this->session->set_flashdata('error', 'Group exists in the users');
	        		redirect('/admin/Controller_Permission/', 'refresh');
				}
				else {
					$delete = $this->model_groups->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('/admin/Controller_Permission/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('/admin/Controller_Permission/delete/'.$id, 'refresh');
		        	}
				}	
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('permission/delete', $this->data);
			}	
		}
	}


}