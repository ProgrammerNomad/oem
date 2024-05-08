<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_GoodRecipt extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Good Recipt';

		$this->load->model('model_products');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
		$this->load->model('Admin_model');
        $this->data['companydata'] = $this->Admin_model->fetch_data("company", "*")->row();
        $this->load->helper('string');

	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewGoodRecipt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('goodrecipt/index', $this->data);	
	}
   
	public function create()
	{
        // echo 'came';
        // exit();
    
         $brandname = $this->Admin_model->fetch_data("brands", "*",['id'=>$this->input->post('brands')[0]])->row();
		if(!in_array('createGoodRecipt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		//$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		// $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
        $this->form_validation->set_rules('billnumber', 'TP Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $queryrecipt =  $this->Admin_model->fetch_data("orders", "*",['bill_no'=>$this->input->post('billnumber')]);
             if($queryrecipt->num_rows() > 0){
                $bildata = $queryrecipt->row();
                if($bildata->goodrecipt == 'No'){
               $ordardata =  $this->Admin_model->fetch_data("orders_item", "*",['order_id'=>$bildata->id])->result();

               foreach($ordardata as $ordareitm){
               $productitm = $this->Admin_model->fetch_data("products", "*",['id'=>$ordareitm->product_id])->row();
               $goodItm['tpnumber'] = $this->input->post('billnumber');
               $goodItm['brandunId'] = $productitm->brandunId;
               $goodItm['product_id'] = $productitm->id;
               $goodItm['sizevalue'] = $productitm->sizevalue;
               $goodItm['packsize'] = $productitm->packsize;
               $goodItm['size'] = $productitm->size;
               $goodItm['liquertype'] = $productitm->liquertype;
               $goodItm['stockprice'] = $productitm->stockprice;
               $goodItm['ExciseDuty'] = $productitm->ExciseDuty;
               $goodItm['retail'] = $productitm->retail;
               $goodItm['price'] = $ordareitm->rate;
               $goodItm['amount'] = $ordareitm->amount;
               $goodItm['qty'] = $ordareitm->qty;
               $goodItm['brand_id'] = json_decode($productitm->brand_id)[0];
               $goodItm['category_id'] = json_decode($productitm->category_id)[0];
               $goodItm['store_id'] = $productitm->store_id;
               $goodItm['user_id'] = $this->session->userdata('id');
               $goodItm['createDate'] = date('Y-m-d');
               $this->db->insert('goodrecipt',$goodItm);
               //$this->db->insert_id(); 
               $itmGodOpnig = $this->Admin_model->fetch_data("goodreciptitm", "*",['product_id'=>$productitm->id,'user_id'=>$this->session->userdata('id')]);
               if($itmGodOpnig->num_rows() > 0){
                $opndaay = $itmGodOpnig->row(); 
                $qtyy = (int)$ordareitm->qty + (int)$opndaay->qty; 
                $tolaamoutn = (int)$opndaay->price * $qtyy;        
                $this->Admin_model->update_opration('goodreciptitm',['qty'=>$qtyy,'amount'=>$tolaamoutn],['product_id'=>$productitm->id,'user_id'=>$this->session->userdata('id')]);
               }else{
                 $this->db->insert('goodreciptitm',$goodItm);
               }
               }
               $create = $this->Admin_model->update_opration('orders',['user_id'=>$this->session->userdata('id'),'roll'=>'U','goodrecipt'=>'Yes','reciptDate'=>date('Y-m-d')],['bill_no'=>$this->input->post('billnumber')]);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Controller_GoodRecipt/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('Controller_GoodRecipt/create', 'refresh');
        	}
             }else{
             $this->session->set_flashdata('error', 'TP Number Not Match!!');
        		redirect('Controller_GoodRecipt/create', 'refresh');
             } 
           } 
            
        }
        else {
            // false case

			$this->data['brands'] = $this->model_brands->getActiveBrands();        	
			$this->data['category'] = $this->model_category->getActiveCategroy();        	
			$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('goodrecipt/create', $this->data);
        }	
	}
  public function fetchProductData()
	{
		$result = array('data' => array());
        if($this->session->userdata('roll') == 'U'){
        $data = $this->Admin_model->fetch_data("orders", "*",['user_id'=>$this->session->userdata('id'),'roll'=>'U','goodrecipt'=>'Yes'])->result_array(); 
        }else{
        $data = $this->Admin_model->fetch_data("orders", "*")->result_array(); 
        }
		
		foreach ($data as $key => $value) {
            $date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;
			// button
            $buttons = '';
            
             
		   if(in_array('createGoodRecipt', $this->permission)) { 
    			$buttons .= '<a class="btn btn-primary btn-sm" href="'.base_url('Controller_GoodRecipt/viewrecipt/'.$value['id']).'">View</a>';
            }  
           
           if(in_array('deleteGoodRecipt', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low</span>';
            } else if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of Stock!</span>';
            }
            $username ='';
            $usernameget = $this->Admin_model->fetch_data("users", "*",['roll'=>'U','id'=>$value['user_id']])->row();
             if($this->session->userdata('roll') == 'A'){
             $username .= $usernameget->firstname.' '.$usernameget->lastname;	
             $result['data'][$key] = array(
				$username,
				$value['bill_no'],
				$date_time,
				'INR- '.$value['net_amount'],
				$value['reciptDate'],
				// $paid_status,
				$buttons
			);
             }else{
               $result['data'][$key] = array(
				$value['bill_no'],
				$date_time,
				'INR- '.$value['net_amount'],
				$value['reciptDate'],
				// $paid_status,
				$buttons
			);
             }
             
			
		} // /foreach

		echo json_encode($result);
	}

public function viewrecipt(){
 if(!in_array('viewGoodRecipt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('goodrecipt/viewrecipt', $this->data);	
}	

}