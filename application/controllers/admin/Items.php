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
        $this->load->view('salesdoc/create');
    }

    public function delete($id) {
        $this->item_model->delete_item($id);
        redirect('items');
    }
}
?>
