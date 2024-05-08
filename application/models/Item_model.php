<?php
class Item_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_items() {
        return $this->db->get('items')->result_array();
    }

    public function add_item($data) {
        $this->db->insert('items', $data);
        return $this->db->insert_id();
    }

    public function delete_item($id) {
        $this->db->where('id', $id);
        $this->db->delete('items');
    }
}
?>
