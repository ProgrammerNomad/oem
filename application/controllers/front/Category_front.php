<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->data['page_title'] = 'Cotegory';

        $this->load->model('ModelCategory');
        $this->load->model('model_category');



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

        $data['BreadCrumb'] = $this->ShowBreadsCrub($this->uri->segment(2));


        $this->load->view('frontend/SubCategory', $data);
    }

    public function ShowBreadsCrub($id)
    {
        $parentCategory = $this->model_category->getParentCategoryNameById($id);

        $breadcrumb = '<li>' . $parentCategory['name'] . '<li>';

        if ($parentCategory['parent_category'] != 0) {

            $parentCategory2 = $this->model_category->getParentCategoryNameById($parentCategory['parent_category']);

            if (!empty($parentCategory2['name'])) {



                $breadcrumb = '<li>' . $parentCategory2['name'] . '</li> ' . $breadcrumb;
            }

            if ($parentCategory2['parent_category'] != 0) {

                $parentCategory3 = $this->model_category->getParentCategoryNameById($parentCategory2['parent_category']);

                if (!empty($parentCategory3['name'])) {
                    $breadcrumb = '<li>' . $parentCategory3['name'] . ' </li> ' . $breadcrumb;
                }



            }

        }

        return $breadcrumb;
    }

    public function SubCatTwo()
    {
        $data['ParentCategory'] = $this->ModelCategory->getChildCat($this->uri->segment(2));


        $data['BreadCrumb'] = $this->ShowBreadsCrub($this->uri->segment(2));


        $data['ParentID'] = $this->ModelCategory->getCategory($this->uri->segment(2));


        $data['DocFiles'] = $this->ModelCategory->getDocFiles($this->uri->segment(2));

        $this->load->view('frontend/SubCategoryTwo', $data);
    }
    public function DocFile()
    {
        $data['DocFiles'] = $this->ModelCategory->getDocFiles($this->uri->segment(2));


        $this->load->view('frontend/ViewDoc', $data);
    }
}
