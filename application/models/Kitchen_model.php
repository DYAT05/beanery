<?php
class Kitchen_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllPaidOrders(){
        $this->db->select('order_header.*');
        $this->db->select('users.name');
        $this->db->from('order_header');
        $this->db->join('users', 'users.id = order_header.user_id', 'left');
        $this->db->where('order_status', 'paid');

        $query = $this->db->get();

        return $query->result();
    }
}