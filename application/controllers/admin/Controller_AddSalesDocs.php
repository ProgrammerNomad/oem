<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_AddSalesDocs extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sales docs';

		$this->load->model('model_company');
		$this->load->model('Admin_model');
		$this->load->model('model_salesdoc');

		
		$this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*",['active'=>1])->result();
		$this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->session->userdata('itmid'),'active'=>1])->row();
	}

    /* 
    * It redirects to the company page and displays all the company information
    * It also updates the company information into the database if the 
    * validation for each input field is successfully valid
    */
	public function index()
	{  
        if(!in_array('updateCompany', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'Vat Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
	
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'company_name' => $this->input->post('company_name'),
        		'service_charge_value' => $this->input->post('service_charge_value'),
        		'vat_charge_value' => $this->input->post('vat_charge_value'),
        		'address' => $this->input->post('address'),
        		'phone' => $this->input->post('phone'),
        		'country' => $this->input->post('country'),
        		'message' => $this->input->post('message'),
                'currency' => $this->input->post('currency')
        	);



        	$update = $this->model_company->update($data, 1);
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/Controller_AddSalesDocs/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/Controller_AddSalesDocs/index', 'refresh');
        	}
        }
        else {

            // false case
            
            
            $this->data['currency_symbols'] = $this->currency();
        	$this->data['company_data'] = $this->model_company->getCompanyData(1);

			// Get data from Category table

			$this->data['company_data']['categories'] = $this->model_salesdoc->GetCatData();

			$this->render_template('salesdoc/create', $this->data);			
        }	

		
	}

	public function ViewEdit() {

		$DocId = $this->uri->segment(4);

		if(!in_array('updateCompany', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'Vat Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
	
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'company_name' => $this->input->post('company_name'),
        		'service_charge_value' => $this->input->post('service_charge_value'),
        		'vat_charge_value' => $this->input->post('vat_charge_value'),
        		'address' => $this->input->post('address'),
        		'phone' => $this->input->post('phone'),
        		'country' => $this->input->post('country'),
        		'message' => $this->input->post('message'),
                'currency' => $this->input->post('currency')
        	);



        	$update = $this->model_company->update($data, 1);
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/Controller_AddSalesDocs/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/Controller_AddSalesDocs/index', 'refresh');
        	}
        }
        else {

            // false case
            
            
            $this->data['currency_symbols'] = $this->currency();
        	$this->data['company_data'] = $this->model_company->getCompanyData(1);

			// Get data from Category table

			$DocData = $this->model_salesdoc->GetSalesDoc($DocId);

			$this->data['company_data']['SalesDoc'] = $DocData;

			$CatData = $this->model_salesdoc->GetCatData();

			


			// Make category option data

			$OptionList = '';
			foreach($CatData as $CatSinghle) {

				if($CatSinghle->id == $DocData[0]->category_id) 
				{
					$OptionList .= '<option value="'.$CatSinghle->id.'" selected>'.$CatSinghle->name.'</option>';
				}else{
					$OptionList .= '<option value="'.$CatSinghle->id.'">'.$CatSinghle->name.'</option>';
				}

			}

			$this->data['company_data']['categories'] = $OptionList;
			

			$this->render_template('salesdoc/Update', $this->data);			
        }	

}
}