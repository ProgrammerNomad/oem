<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('item_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $data['items'] = $this->item_model->get_all_items();
        $this->load->view('item/index', $data);
    }

    public function createsalesdoc() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $image_path = '';
            $file_path = ''; 
            
            if ($_FILES['userfile']['name']) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2048; 

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userfile')) {
                    $image_data = $this->upload->data();
                    $image_path = 'uploads
                    ' . $image_data['file_name'];
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
            }

            
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'image_path' => $image_path,
                'file_path' => $file_path
            );

            // Insert data into the database
            $this->item_model->add_item($data);
            redirect('admin/picture');
        } else {
            $this->load->view('salesdoc/create');
        }
    }

    public function delete($id) {
        $this->item_model->delete_item($id);
        redirect('items');
    }
}
?>
