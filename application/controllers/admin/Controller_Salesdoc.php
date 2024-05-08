<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Salesdoc extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = '
        ';
        $this->load->model('Admin_model');
        $this->load->model('model_media');
        $this->load->model('model_salesdoc');
        $this->load->model('model_subcategory');
        $this->load->model('model_category');

        $this->data['category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1])->result();


        $options = '<option value="0">Parent</option>';


        $cat = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => 0])->result();


        foreach ($cat as $ChildCat) {
            $options .= '<option value= "' . $ChildCat->id . '">' . $ChildCat->name . '</option>';
            $cat1 = $this->data['parent_category'] = $this->Admin_model->fetch_data("categories", "*", ['active' => 1, 'parent_category' => $ChildCat->id])->result();
            foreach ($cat1 as $ChildCat1) {
                $options .= '<option value= "' . $ChildCat1->id . '">-' . $ChildCat1->name . '</option>';

            }
            foreach ($cat1 as $ChildCat2) {
                $options .= '<option value= "' . $ChildCat2->id . '">--' . $ChildCat2->name . '</option>';

            }
        }

        $this->data['category'] = $options;

    }

    public function index()
    {
        if (!in_array('viewCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->render_template('salesdoc/index', $this->data);
    }

    public function fetchCategoryDataById($id)
    {
        if ($id) {
            $data = $this->model_salesdoc->updatedata($id);

            $ParentId = $data['parent_category'];

            if (!$data) {
                echo json_encode(array('error' => 'Category not found'));
                return;
            }

            $Allcat = $this->model_category->GetAllCat();

            $options = '<option value="">Parent</option>';

            foreach ($Allcat as $Cat) {
                if ($ParentId == $Cat->id) {
                    $options .= '<option value="' . $Cat->id . '" selected>' . $Cat->name . '</option>';
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
        $data = $this->model_salesdoc->getSalescodeData();
        foreach ($data as $key => $value) {
            $buttons = '';
            if (in_array('updateCategory', $this->permission)) {
                $buttons .= '<a class="btn btn-default btn-sm" href="/admin/Controller_AddSalesDocs/update/' . $value['id'] . '">Update</a>';
            }
            if (in_array('deleteCategory', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $category_name = $this->model_salesdoc->getParentCategoryNameById($value['category_id']);


            $ImageData = '';
            foreach (unserialize($value['picture']) as $Pic) {

                $ImageData .= '<a href=""><img src="/uploads/salesdocs/' . $Pic['picture'] . '" width="50px" /></a>';
            }

            $PdfData = '';
            foreach (unserialize($value['pdf']) as $Pic) {

                $PdfData .= '<a href="/uploads/salesdocs/' . $Pic['pdf'] . '">' . $Pic['pdf'] . '</a><br/>';
            }

            $drawingData = '';
            foreach (unserialize($value['drawing']) as $Pic) {

                $drawingData .= '<a href="/uploads/salesdocs/' . $Pic['drawing'] . '">' . $Pic['drawing'] . '</a><br/>';
            }

            $doc_fileData = '';
            foreach (unserialize($value['doc_file']) as $Pic) {

                $doc_fileData .= '<a href="/uploads/salesdocs/' . $Pic['doc_file'] . '">' . $Pic['doc_file'] . '</a><br/>';
            }

            $power_pointData = '';
            foreach (unserialize($value['power_point']) as $Pic) {

                $power_pointData .= '<a href="/uploads/salesdocs/' . $Pic['power_point'] . '">' . $Pic['power_point'] . '</a><br/>';
            }



            $result['data'][$key] = array(
                $category_name,
                $value['title'],
                $ImageData,
                $PdfData,
                $drawingData,
                $doc_fileData,
                $power_pointData,
                $status,
                $buttons
            );
        }
        echo json_encode($result);
    }

    public function create()
    {



        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category ID', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {


            //echo '<pre>';
            //print_r($this->input->post());



            // print_r($_FILES);


            //Upload multiple images

            $this->load->library('upload');

            $ImageCount = count($_FILES['picture']['name']);
            for ($i = 0; $i < $ImageCount; $i++) {

                $filename = $_FILES['picture']['name'][$i];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                $_FILES['file']['name'] = $ImageNewName; //$_FILES['picture']['name'][$i];
                $_FILES['file']['type'] = $_FILES['picture']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['picture']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['picture']['error'][$i];
                $_FILES['file']['size'] = $_FILES['picture']['size'][$i];

                // File upload configuration
                $uploadPath = './uploads/salesdocs';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgDatapicture[$i]['picture'] = $imageData['file_name'];

                }
            }
            if (!empty($uploadImgDatapicture)) {
                $picture = $uploadImgDatapicture;
            } else {
                $picture = [];
            }


            // upload pdf

            $this->load->library('upload');

            $ImageCount = count($_FILES['pdf']['name']);
            for ($i = 0; $i < $ImageCount; $i++) {

                $filename = $_FILES['pdf']['name'][$i];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                $_FILES['file']['name'] = $ImageNewName; //$_FILES['pdf']['name'][$i];
                $_FILES['file']['type'] = $_FILES['pdf']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['pdf']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['pdf']['error'][$i];
                $_FILES['file']['size'] = $_FILES['pdf']['size'][$i];

                // File upload configuration
                $uploadPath = './uploads/salesdocs';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'pdf|fpdf';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgDatapdf[$i]['pdf'] = $imageData['file_name'];

                }
            }
            if (!empty($uploadImgDatapdf)) {
                $pdf = $uploadImgDatapdf;
            } else {
                $pdf = [];
            }


            // upload drawing

            $this->load->library('upload');

            $ImageCount = count($_FILES['drawing']['name']);
            for ($i = 0; $i < $ImageCount; $i++) {

                $filename = $_FILES['drawing']['name'][$i];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                $_FILES['file']['name'] = $ImageNewName; //$_FILES['drawing']['name'][$i];
                $_FILES['file']['type'] = $_FILES['drawing']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['drawing']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['drawing']['error'][$i];
                $_FILES['file']['size'] = $_FILES['drawing']['size'][$i];

                // File upload configuration
                $uploadPath = './uploads/salesdocs';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'cdr|psd|jpg|jpeg|png';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgDatadrawing[$i]['drawing'] = $imageData['file_name'];

                }
            }
            if (!empty($uploadImgDatadrawing)) {
                $drawing = $uploadImgDatadrawing;
            } else {
                $drawing = [];
            }

            // upload doc_file

            $this->load->library('upload');

            $ImageCount = count($_FILES['doc_file']['name']);
            for ($i = 0; $i < $ImageCount; $i++) {

                $filename = $_FILES['doc_file']['name'][$i];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                $_FILES['file']['name'] = $ImageNewName; //$_FILES['doc_file']['name'][$i];
                $_FILES['file']['type'] = $_FILES['doc_file']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['doc_file']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['doc_file']['error'][$i];
                $_FILES['file']['size'] = $_FILES['doc_file']['size'][$i];

                // File upload configuration
                $uploadPath = './uploads/salesdocs';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|doc|docx';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgDatadoc_file[$i]['doc_file'] = $imageData['file_name'];

                }
            }
            if (!empty($uploadImgDatadoc_file)) {
                $doc_file = $uploadImgDatadoc_file;
            } else {
                $doc_file = [];
            }


            // upload power_point

            $this->load->library('upload');

            $ImageCount = count($_FILES['power_point']['name']);
            for ($i = 0; $i < $ImageCount; $i++) {

                $filename = $_FILES['power_point']['name'][$i];

                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                $_FILES['file']['name'] = $ImageNewName; //$_FILES['power_point']['name'][$i];
                $_FILES['file']['type'] = $_FILES['power_point']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['power_point']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['power_point']['error'][$i];
                $_FILES['file']['size'] = $_FILES['power_point']['size'][$i];

                // File upload configuration
                $uploadPath = './uploads/salesdocs';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|ppt|doc|docx';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgDatapower_point[$i]['power_point'] = $imageData['file_name'];

                }
            }
            if (!empty($uploadImgDatapower_point)) {
                $power_point = $uploadImgDatapower_point;
            } else {
                $power_point = [];
            }


            // Now store all data to DB



            $data = array(
                'description' => $this->input->post('description'),
                'category_id' => $this->input->post('category_id'),
                'title' => $this->input->post('title'),
                'active' => $this->input->post('active'),
                'picture' => serialize($picture),
                'pdf' => serialize($pdf),
                'drawing' => serialize($drawing),
                'doc_file' => serialize($doc_file),
                'power_point' => serialize($power_point),
            );


            $StoreData = $this->model_salesdoc->storesales($data);

        } else {
            // Form validation failed
            $response['success'] = false;
            $response['message'] = validation_errors();
        }

        redirect('admin/Controller_Salesdoc/');
    }

    public function update()
    {

        // get old data for reuse if files not updated

        $OldDocData = $this->model_salesdoc->GetSalesDoc($this->input->post('id'));

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category ID', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            //Upload multiple images

            $this->load->library('upload');

            $ImageCount = count($_FILES['picture']['name']);

            if ($ImageCount > 0) {
                for ($i = 0; $i < $ImageCount; $i++) {

                    $filename = $_FILES['picture']['name'][$i];

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                    $_FILES['file']['name'] = $ImageNewName; //$_FILES['picture']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['picture']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['picture']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['picture']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['picture']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/salesdocs';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgDatapicture[$i]['picture'] = $imageData['file_name'];

                    }
                }

                //merge to old

                $uploadImgDatapicture = array_merge((array) $uploadImgDatapicture, (array) unserialize($OldDocData[0]->picture));

                if (!empty($uploadImgDatapicture)) {
                    $picture = $uploadImgDatapicture;
                } else {
                    $picture = [];
                }


                // upload pdf

                $this->load->library('upload');

                $ImageCount = count($_FILES['pdf']['name']);
                for ($i = 0; $i < $ImageCount; $i++) {

                    $filename = $_FILES['pdf']['name'][$i];

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                    $_FILES['file']['name'] = $ImageNewName; //$_FILES['pdf']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['pdf']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['pdf']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['pdf']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['pdf']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/salesdocs';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'pdf|fpdf';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgDatapdf[$i]['pdf'] = $imageData['file_name'];

                    }
                }

                //merge to old

                $uploadImgDatapdf = array_merge((array) $uploadImgDatapdf, (array) unserialize($OldDocData[0]->pdf));

                if (!empty($uploadImgDatapdf)) {
                    $pdf = $uploadImgDatapdf;
                } else {
                    $pdf = [];
                }


                // upload drawing

                $this->load->library('upload');

                $ImageCount = count($_FILES['drawing']['name']);
                for ($i = 0; $i < $ImageCount; $i++) {

                    $filename = $_FILES['drawing']['name'][$i];

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                    $_FILES['file']['name'] = $ImageNewName; //$_FILES['drawing']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['drawing']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['drawing']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['drawing']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['drawing']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/salesdocs';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'cdr|psd|jpg|jpeg|png';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgDatadrawing[$i]['drawing'] = $imageData['file_name'];

                    }
                }
                //merge to old

                $uploadImgDatadrawing = array_merge((array) $uploadImgDatadrawing, (array) unserialize($OldDocData[0]->drawing));

                if (!empty($uploadImgDatadrawing)) {
                    $drawing = $uploadImgDatadrawing;
                } else {
                    $drawing = [];
                }

                // upload doc_file

                $this->load->library('upload');

                $ImageCount = count($_FILES['doc_file']['name']);
                for ($i = 0; $i < $ImageCount; $i++) {

                    $filename = $_FILES['doc_file']['name'][$i];

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                    $_FILES['file']['name'] = $ImageNewName; //$_FILES['doc_file']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['doc_file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['doc_file']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['doc_file']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['doc_file']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/salesdocs';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|doc|docx';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgDatadoc_file[$i]['doc_file'] = $imageData['file_name'];

                    }
                }
                //merge to old

                $uploadImgDatadoc_file = array_merge((array) $uploadImgDatadoc_file, (array) unserialize($OldDocData[0]->doc_file));

                if (!empty($uploadImgDatadoc_file)) {
                    $doc_file = $uploadImgDatadoc_file;
                } else {
                    $doc_file = [];
                }


                // upload power_point

                $this->load->library('upload');

                $ImageCount = count($_FILES['power_point']['name']);
                for ($i = 0; $i < $ImageCount; $i++) {

                    $filename = $_FILES['power_point']['name'][$i];

                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $ImageNewName = md5($imageData['file_name']) . '_' . time() . '.' . $extension;

                    $_FILES['file']['name'] = $ImageNewName; //$_FILES['power_point']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['power_point']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['power_point']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['power_point']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['power_point']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/salesdocs';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|ppt|doc|docx';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgDatapower_point[$i]['power_point'] = $imageData['file_name'];

                    }
                }

                //merge to old

                $uploadImgDatapower_point = array_merge((array) $uploadImgDatapower_point, (array) unserialize($OldDocData[0]->power_point));

                if (!empty($uploadImgDatapower_point)) {
                    $power_point = $uploadImgDatapower_point;
                } else {
                    $power_point = [];
                }


                // Now store all data to DB



                $data = array(
                    'description' => $this->input->post('description'),
                    'category_id' => $this->input->post('category_id'),
                    'title' => $this->input->post('title'),
                    'active' => $this->input->post('active'),
                    'picture' => serialize($picture),
                    'pdf' => serialize($pdf),
                    'drawing' => serialize($drawing),
                    'doc_file' => serialize($doc_file),
                    'power_point' => serialize($power_point),
                );


                $StoreData = $this->model_salesdoc->updatesales($data, $this->input->post('id'));

            } else {
                // Form validation failed
                $response['success'] = false;
                $response['message'] = validation_errors();
            }

            redirect('admin/Controller_AddSalesDocs/update/' . $this->input->post('id') . '?updated=1');
        }
    }

    public function delete()
    {

        $DocData = $this->model_salesdoc->GetSalesDoc($this->input->post('id'));

        $Type = $this->input->post('type');
        $Id = $this->input->post('id');
        $FileName = $this->input->post('filename');

        $DeleteFile = unserialize($DocData[0]->$Type);

        $i = 0;

        //print_r($DeleteFile);

        foreach ($DeleteFile as $File) {
            if ($File[$Type] == $FileName) {

                unset($DeleteFile[$i]);

                // Remove Actual file from directory
                if (file_exists('./uploads/salesdocs/' . $FileName)) {
                    unlink('./uploads/salesdocs/' . $FileName);
                }


            }

            $i++;
        }

        // Update to database

        $this->model_salesdoc->deleteSalesDoc(serialize($DeleteFile), $Id, $Type);


        echo 1;

        //print_r($this->input->post());

    }
    public function updateOld($id)
    {
        $response = array();

        if (!in_array('updateCategory', $this->permission)) {
            $response['success'] = false;
            $response['messages'] = 'Permission denied';
        } else {
            if ($id) {
                $this->form_validation->set_rules('edit_category_id', 'Category ID', 'trim|required');
                $this->form_validation->set_rules('edit_title', 'Title', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = array(
                        'category_id' => $this->input->post('edit_category_id'),
                        'title' => $this->input->post('edit_title'),
                        'active' => $this->input->post('edit_active'),
                    );

                    $update = $this->model_salesdoc->update($data, $id);

                    if ($update) {
                        $response['success'] = true;
                        $response['messages'] = 'Successfully updated';
                    } else {
                        $response['success'] = false;
                        $response['messages'] = 'Error in the database while updating the category information';
                    }
                } else {
                    $response['success'] = false;
                    $response['messages'] = validation_errors();
                }
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error: Please refresh the page and try again';
            }
        }

        echo json_encode($response);
    }

    public function remove()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $this->input->post('id');


        $DocData = $this->model_salesdoc->GetSalesDoc($id);

        // gel list of all files in A array and dlete in loop using if file exit

        $picture = unserialize($DocData[0]->picture);
        $pdf = unserialize($DocData[0]->pdf);
        $drawing = unserialize($DocData[0]->drawing);
        $doc_file = unserialize($DocData[0]->doc_file);
        $power_point = unserialize($DocData[0]->power_point);


        $AllFIles = array_merge((array) $picture, (array) $pdf, (array) $drawing, (array) $doc_file, (array) $power_point);


        foreach ($AllFIles as $key => $FileArray) {

            foreach ($FileArray as $Key => $Value) {
                //echo $Value;
                if (file_exists('./uploads/salesdocs/' . $Value)) {
                    unlink('./uploads/salesdocs/' . $Value);
                }

            }
        }

        $response = array();
        if ($id) {
            $delete = $this->model_salesdoc->remove($id);
            if ($delete) {
                $response['success'] = true;
                $response['message'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['message'] = "Error in the database while removing the sales document information";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Invalid ID provided";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
