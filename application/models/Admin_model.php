<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_model {
	function __construct() {
        parent::__construct();
    }
	public function login($username,$password){   
    $this->db->where("email", $username);
    $this->db->where("password", $password);
    $query = $this->db->get("users");
    return $query->result_array();
		}
	public function getalldata($table){
		$this->db->select('*');
        $this->db->order_by("id","desc");
		return $this->db->get($table)->result();
	}
	public function insertquery($table,$data){
		 $this->db->insert($table,$data);
         return $this->db->insert_id();
	}
	public function delete($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
         return  true;
    }
    public function update_opration($table, $data, $where){
		$this->db->update($table, $data, $where);
		return  true;
    }
    
    function fetch_data($tbl,$colm,$where = null){
    $this->db->select($colm);
    $this->db->order_by("id","desc");
        if(!empty($where)){
            $this->db->where($where);
        }
     $query=$this->db->get($tbl);
     return $query;   
    }
public function get_search($tbl,$colm, $like = null, $where = null) {
  $this->db->select($colm);
  if(!empty($like)){
   $this->db->like($like);   
  }
  if(!empty($where)){
  $this->db->where($where);  
  }
  $query = $this->db->get($tbl);
  return $query;
 }    
    
public function userlogin($email,$password){   
    $this->db->where("email", $email);
    $this->db->where("password", $password);
    $query = $this->db->get("user");
    return $query->num_rows();
        }
    public function record_count($tbl) { 
    return $this->db->count_all($tbl); 
    }
    //for general database query 
    public function run_query($query){ 
        return $this->db->query($query); 
    }

   public function suportDoctors()
    {
    
$this->db->select('users.*, ledership_category_tbl.l_cat_name AS ladrsipname');
$this->db->from('users');
$this->db->join('ledership_category_tbl', 'users.landersic_cat_id = ledership_category_tbl.id', 'inner');
$this->db->where('users.status','1','users.roll','D','users.user_type','SP_DOCTORS'); 
$query = $this->db->get();
$result = $query->result(); 
   return $result;
    }

    public function cartproduct($userid) {
        $this->db->select('cart.id, cart.event_id, event_tbl.title, event_tbl.img');
        $this->db->from('cart');
        $this->db->join('event_tbl', 'cart.event_id = event_tbl.id', 'left');
        $this->db->where('cart.user_id', $userid); // Add your WHERE condition
        $this->db->group_by('cart.event_id');
        $query = $this->db->get();
        return $query->result();
    }
     public function tickectitm($userid) {
        $this->db->select('cart.id, cart.ticket_id, cart.quantity, cart.event_id,  event_type.event_name, event_type.price, event_type.qty');
        $this->db->from('cart');
        $this->db->join('event_type', 'cart.ticket_id = event_type.id', 'left');
        $this->db->where('cart.user_id', $userid); // Add your WHERE condition
        $query = $this->db->get();
        return $query->result();
    }

 public function bookingdata() {
        $this->db->select('users.name,users.email,users.phone, booking_event.*');
        $this->db->from('booking_event');
        $this->db->join('users', 'users.id = booking_event.user_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }


}


