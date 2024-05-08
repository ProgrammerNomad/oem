<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorylist_front extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
		$this->data['page_title'] = 'Category';

		$this->load->model('model_category');
		$this->load->model('Admin_model');

		
    $options = '<option value="0">Parent</option>';


		$cat = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*",['active'=>1, 'parent_category'=>0])->result();

		
		foreach($cat as $ChildCat)
		{
			$options .= '<option value= "'.$ChildCat->id.'">'.$ChildCat->name.'</option>';
			$cat1 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*",['active'=>1, 'parent_category'=>$ChildCat->id])->result();
			foreach($cat1 as $ChildCat1)
			{
				$options .= '<option value= "'.$ChildCat1->id.'">-'.$ChildCat1->name.'</option>';

			}
			foreach($cat1 as $ChildCat2)
			{
				$options .= '<option value= "'.$ChildCat2->id.'">--'.$ChildCat2->name.'</option>';

			}
		}

		$this->data['category'] = $options;
		// $this->data['$catgio '] = $options;


		$this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*",['active'=>1])->result();
		$this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->session->userdata('itmid'),'active'=>1])->row();
	}

		
//    public function index() {
//         $this->load->view('frontend/Categorylist_front');
//     }

    public function fetchCategoryData()
    {
        $result = array('data' => array());

        $data = $this->model_category->getCategoryData();

        foreach ($data as $key => $value) {

            $buttons = '';

          
            $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $result['data'][$key] = array(
                $value['name'],
                $value['parent_category'],
                $status,
                $buttons
            );
        } 

        echo json_encode($result);
    }

public function indexdata() {

    $options = '<option value="0">Parent</option>';


    $cat = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*",['active'=>1, 'parent_category'=>0])->result();

    
    foreach($cat as $ChildCat)
    {
        $options .= '<option value= "'.$ChildCat->id.'">'.$ChildCat->name.'</option>';
        $cat1 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*",['active'=>1, 'parent_category'=>$ChildCat->id])->result();
        foreach($cat1 as $ChildCat1)
        {
            $options .= '<option value= "'.$ChildCat1->id.'">-'.$ChildCat1->name.'</option>';

        }
        foreach($cat1 as $ChildCat2)
        {
            $options .= '<option value= "'.$ChildCat2->id.'">--'.$ChildCat2->name.'</option>';

        }
    }

    $this->data['category'] = $options;
        $data['records'] =  $this->model_category->getCategoryData(); 
        $this->load->view('frontend/Categorylist_front', $data);
    }

}
