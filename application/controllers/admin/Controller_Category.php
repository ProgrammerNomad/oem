<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Category extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Category';

        $this->load->model('model_category');
        $this->load->model('Admin_model');


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

        $this->data['category'] = $options;
        // $this->data['$catgio '] = $options;


        $this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*", ['active' => 1])->result();
        $this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*", ['id' => $this->session->userdata('itmid'), 'active' => 1])->row();
    }


    public function index()
    {

        if (!in_array('viewCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('category/index', $this->data);
    }


    public function GetAllCat()
    {
        $sql = "SELECT * FROM categories";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function fetchCategoryDataById($id)
    {
        if ($id) {
            $data = $this->model_category->updatedata($id);

            if (!$data) {
                echo json_encode(array('error' => 'Category not found'));
                return;
            }

            $ParentId = $data['parent_category'];

            $Allcat = $this->model_category->GetAllCat();

            $options = '<option value="">Parent</option>';

            foreach ($Allcat as $Cat) {
                if ($ParentId == $Cat->id) {
                    // Check if the parent category is not the same as the current category
                    if ($Cat->id != $id) {
                        $options .= '<option value="' . $Cat->id . '" selected>' . $Cat->name . '</option>';
                    } else {
                        $options .= '<option value="' . $Cat->id . '">' . $Cat->name . '</option>';
                    }
                } else {
                    $options .= '<option value="' . $Cat->id . '">' . $Cat->name . '</option>';
                }
            }

            $data['categories'] = $options;

            echo json_encode($data);
            return;
        }

        echo json_encode(array('error' => 'Invalid ID'));
    }


    public function fetchCategoryData()
    {
        $result = array('data' => array());

        $data = $this->model_category->getCategoryData();

        foreach ($data as $key => $value) {
            $buttons = '';

            if (in_array('updateCategory', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if (in_array('deleteCategory', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $parentCategory = $this->model_category->getParentCategoryNameById($value['parent_category']);

            $breadcrumb = $parentCategory['name'];

            
          //  echo  '<pre>';
          //  print_r($parentCategory);

           // die();

            $result['data'][$key] = array(
                $value['name'],
                $breadcrumb,
                // Display parent category name instead of ID

                $status,
                $buttons
            );
        }

        echo json_encode($result);
    }


    public function create()
    {
        if (!in_array('createCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
        $this->form_validation->set_rules('parent_category', 'Parent category', 'trim');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'name' => $this->input->post('category_name'),
                'parent_category' => $this->input->post('parent_category'),
                'active' => $this->input->post('active'),
            );

            $category_id = $this->model_category->create($data);

            if ($category_id) {
                $parent_category_ids = $this->input->post('parent_category');
                $parent_names = array();

                if (!empty($parent_category_ids)) {
                    foreach ($parent_category_ids as $parent_category_id) {
                        $parent_category_name = $this->model_category->getCategoryNameById($parent_category_id);
                        if ($parent_category_name) {
                            $parent_names[] = $parent_category_name;
                            $this->model_category->addParentCategory($category_id, $parent_category_id);
                        }
                    }
                }

                $response['success'] = true;
                $response['messages'] = 'Successfully created';
                $response['parent_names'] = $parent_names;
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating the category information';
            }
        } else {
            $response['success'] = false;
            $response['messages'] = validation_errors(); // Include all form validation errors
        }

        echo json_encode($response);
    }


    public function update($id)
    {
        $response = array();

        if (!in_array('updateCategory', $this->permission)) {
            $response['success'] = false;
            $response['message'] = 'Permission denied';
        } else {
            $category = $this->Admin_model->fetch_data("categories", "*", ['id' => $id])->row_array();

            if ($category) {
                $this->form_validation->set_rules('edit_category_name', 'Category name', 'trim|required');
                $this->form_validation->set_rules('edit_parent_category', 'Parent category', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
                $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

                if ($this->form_validation->run() == TRUE) {
                    $edit_category_name = $this->input->post('edit_category_name');
                    $edit_parent_category = $this->input->post('edit_parent_category');
                    $edit_active = $this->input->post('edit_active');

                    // Check if category and parent category are the same
                    if ($edit_parent_category != $id) {
                        $data = array(
                            'name' => $edit_category_name,
                            'parent_category' => $edit_parent_category, // Assuming it's the parent category ID
                            'active' => $edit_active,
                        );

                        $update = $this->model_category->update($data, $id);

                        if ($update == true) {
                            $response['success'] = true;
                            $response['message'] = 'Successfully updated';
                            $response['selected_parent_category'] = $edit_parent_category;
                        } else {
                            $response['success'] = false;
                            $response['message'] = 'Error updating category information';
                        }
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Category and parent category cannot be the same';
                    }
                } else {
                    $response['success'] = false;
                    $response['message'] = validation_errors();
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Category not found';
            }
        }

        echo json_encode($response);
        return;
    }



    public function remove()
    {
        if (!in_array('deleteCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $category_id = $this->input->post('category_id');

        $response = array();
        if ($category_id) {
            $delete = $this->model_category->remove($category_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the brand information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

}