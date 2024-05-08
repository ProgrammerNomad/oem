<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function login()
	{
       $this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {
                    if($login['roll'] == 'A'){
                    $brandid = $this->data['itmdata'][0]->id;
                    }
           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
				        'roll'     => $login['roll'],
				        'brand_id' =>($brandid) ? $brandid: '',
				        'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);
           			redirect('dashboard', 'refresh');
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = 'Email does not exists';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}
    // public function signup() {
    //     if($this->session->userdata('user_id')) {
    //         redirect('dashboard');
    //     }

    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    //     $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    //     $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('signup');
    //     } else {
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');
    //         $this->user_model->create_user($email, $password);

    //         $data['success'] = 'Account created successfully. Please login.';
    //         $this->load->view('login', $data);
    //     }
    // }

    public function logout() {
        $this->session->unset_userdata('user_id');
        // Redirect to login page
        redirect('Controller_login/login');
    }
}
?>
