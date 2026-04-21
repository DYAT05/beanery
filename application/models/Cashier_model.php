<?php
class Cashier_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllPendingOrders(){
        $this->db->select('order_header.*');
        $this->db->select('users.name');
        $this->db->from('order_header');
        $this->db->join('users', 'users.id = order_header.user_id', 'inner');
        $this->db->where('order_status', 'pending');

        $query = $this->db->get();

        return $query->result();
    }
    
//DYAT
    // public function getAllPendingOrders(){
    //     $this->db->select('*');
    //     $this->db->from('order_header');

    //     // TEMP: remove filters
    //     // $this->db->where('order_status', 'prepared');
    //     // $this->db->where('is_out', 0);

    //     return $this->db->get()->result();
    // }
//DYAT


    public function getPosCurrentList(){
        $this->db->select('menu.menu_name');
        $this->db->select('pos_cart.*');
        $this->db->from('pos_cart');
        $this->db->join('menu', 'menu.id = pos_cart.menu_id', 'inner');
        $this->db->where('pos_cart.status', 'listed');

        $query = $this->db->get();

        return $query->result();
    }

    public function getLatestTransactionDetails(){
        $query = $this->db->order_by('id', 'DESC')->limit(1)->get_where('transactions', array('cashier_id' => $this->session->userdata('user_id')));

        return $query->row();
    }

    public function getTransactionDetails($id){
        $query = $this->db->get_where('transactions', array('id' => $id));

        return $query->row();
    }

    public function getOrderHeaderOut(){
        $query = $this->db->get_where('order_header', array('is_out' => 0));

        return $query->result();
    }

    public function getOrderHeaderDetails($orderid){
        $query = $this->db->get_where('order_header', array('id' => $orderid));

        return $query->row();
    }

    public function getOrderInfoDetails($orderid){
        $this->db->select('menu.menu_name');
        $this->db->select('menu.price');
        $this->db->select('order_detail.*');
        $this->db->from('order_detail');
        $this->db->join('menu', 'menu.id = order_detail.menu_id', 'inner');
        $this->db->where('order_detail.order_header_id', $orderid);

        $query = $this->db->get();

        return $query->result();
    }


    // DYAT

   
    // DYAT
}