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

			$options = '<option class="cat" value="0">Parent</option>';


			$cat = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => 0])->result();
	
	
			foreach ($cat as $ChildCat) {
				$options .= '<option class="cat" value= "' . $ChildCat->id . '">' . $ChildCat->name . '</option>';
				$cat1 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => $ChildCat->id])->result();
				foreach ($cat1 as $ChildCat1) {
					$options .= '<option class="cat-1" value= "' . $ChildCat1->id . '">-' . $ChildCat1->name . '</option>';
	
					$Cat2 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => $ChildCat1->id])->result();
	
					foreach ($Cat2 as $ChildCat2) {
						$options .= '<option class="cat-2" value= "' . $ChildCat2->id . '">--' . $ChildCat2->name . '</option>';
	
						$Cat3 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => $ChildCat2->id])->result();
	
						foreach ($Cat3 as $ChildCat3) {
							$options .= '<option class="cat-2" value= "' . $ChildCat3->id . '">---' . $ChildCat3->name . '</option>';
		
						}
					
					}
	
				}
	
			}



			$this->data['company_data']['categories'] = $options;

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