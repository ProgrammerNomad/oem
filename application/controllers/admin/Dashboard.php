<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_stores');
		$this->load->model('Admin_model');
		$this->data['itmdata'] = $this->Admin_model->fetch_data("brands", "*",['active'=>1])->result();
         if(!empty($this->session->userdata('brand_iddata'))){
          $itmid = $this->session->userdata('brand_iddata');
         }else{
           $itmid = $this->session->userdata($logged_in_sess)['brand_id'];
         }
			$this->session->set_userdata('itmid',$itmid);
      $this->data['itmdatarow'] = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->session->userdata('itmid'),'active'=>1])->row();

	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_stores'] = $this->model_stores->countTotalStores();

		$this->data['total_brands'] = $this->model_products->countTotalbrands();
		$this->data['total_category'] = $this->model_products->countTotalcategory();
		$this->data['total_attribures'] = $this->model_products->countTotalattribures();

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}

	public function itmmanagebrand()
	{ 
		
		$this->session->set_userdata('brand_iddata',$this->input->post('brand_id'));
		redirect($_SERVER['HTTP_REFERER']);
	}
}