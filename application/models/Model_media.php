<?php
class Model_media extends CI_Model {
    public function add_picture($subcategory_id, $picture) {
        $this->db->insert('media', array('subcateory_id' => $subcategory_id, 'picture' => $picture));
    }
}
?>
