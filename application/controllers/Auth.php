<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_auth');
        $this->load->model('Admin_model');
        $this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*", ['active' => 1])->result();
    }
    public function login()
    {
        $this->logged_in();

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $email_exists = $this->model_auth->check_email($this->input->post('email'));

            if ($email_exists == TRUE) {
                $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

                if ($login) {
                    if ($login['roll'] == 'A') {
                        $brandid = $this->data['itmdata'][0]->id;
                    }
                    $logged_in_sess = array(
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'firstname' => $login['firstname'],
                        'lastname' => $login['lastname'],
                        'email' => $login['email'],
                        'roll' => $login['roll'],
                        'brand_id' => ($brandid) ? $brandid : '',
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($logged_in_sess);
                    redirect('admin/dashboard', 'refresh');

                } else {
                    $this->data['errors'] = 'Incorrect username/password combination';
                    $this->load->view('login', $this->data);
                }
            } else {
                $this->data['errors'] = 'Email does not exists';

                $this->load->view('login', $this->data);
            }
        } else {
            // false case
            $this->load->view('login');
        }
    }
    public function logout()
    {
        // echo"hi";
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout successful');
        redirect('auth/login', 'refresh');
    }

    public function index()
    {
        $this->load->view('dashbord_front');
    }

    public function login_front()
    {
        $this->logged_in();

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $email_exists = $this->model_auth->check_email($this->input->post('email'));

            if ($email_exists == TRUE) {
                $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

                if ($login) {
                    $brandid = '';
                    if ($login['roll'] == 'A') {
                        $brandid = $this->data['itmdata'][0]->id;
                    }

                    $logged_in_sess = array(
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'firstname' => $login['firstname'],
                        'lastname' => $login['lastname'],
                        'email' => $login['email'],
                        'roll' => $login['roll'],
                        'brand_id' => ($brandid) ? $brandid : '',
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($logged_in_sess);

                    redirect('dashboard', 'refresh');
                } else {
                    $this->data['errors'] = 'Incorrect username/password combination';
                    $this->load->view('front/login', $this->data);
                }
            } else {
                $this->data['errors'] = 'Email does not exist';
                $this->load->view('front/login', $this->data);
            }
        } else {
            $this->load->view('front/login');
        }
    }
    public function logout_front()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout successful');
        redirect('Auth/login_front');
    }



    public function index_front()
    {
        $this->load->view('dashbord_front');
    }

}
