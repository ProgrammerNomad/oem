<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->data['page_title'] = 'Cotegory';

        $this->load->model('ModelCategory');
 


       // $this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*", ['active' => 1])->result();
       // $this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*", ['id' => $this->session->userdata('itmid'), 'active' => 1])->row();
    }

    public function index()
    {

        $data['ParentCategory'] = $this->ModelCategory->getParentCat();

        $this->load->view('frontend/Category_front', $data);
    }
    public function SubCat()
    {
        $data['ParentCategory'] = $this->ModelCategory->getChildCat($this->uri->segment(2));
     

        $this->load->view('frontend/SubCategory', $data);
    }
    public function DocFile()
    {
        $data['DocFiles'] = $this->ModelCategory->getDocFiles($this->uri->segment(2));
     

        $this->load->view('frontend/ViewDoc', $data);
    }
}
