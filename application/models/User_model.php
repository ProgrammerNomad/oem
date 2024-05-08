<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function login($email, $password) {
        // Validate login credentials against database
        $query = $this->db->get_where('customers', array('email' => $email, 'password' => $password));
        return $query->row_array();
    }

    public function create_user($email, $password) {
        // Insert new user into database
        $data = array(
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('customers', $data);
    }
}
?>
