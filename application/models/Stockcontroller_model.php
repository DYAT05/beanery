<?php
class Stockcontroller_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllInventoryItems($category){
        $query = $this->db->get_where('inventory', array('category' => $category));

        return $query->result();
    }

    public function getStockInventoryItemDescription($item){
        $query = $this->db->get_where('inventory', array('id' => $item));

        return $query->row();
    }

    public function getInventoryLogsPerItem($item){
        $query = $this->db->order_by('created_at', 'desc')->get_where('inventory_logs', array('inventory_id' => $item));

        return $query->result();
    }

    public function getLowStocksInventory(){
        $query = $this->db->get_where('inventory', 'total_stock < minimum_stock');

        return $query->result();
    }

    public function getOrderHeaderReports($getdate){
        $sql = "SELECT COUNT(oh.user_id) AS 'counttransaction', SUM(oh.total_amount) AS 'grandtotalamount', DATE_FORMAT(oh.created_at, '%Y-%m-%d') AS created_at, bu.name 
                -- FROM microhotel.order_header AS oh
                FROM `test-mb`.order_header AS oh
                INNER JOIN beanery_users AS bu
                    ON bu.id = oh.user_id
                WHERE order_status <> 'pending'";
        if($getdate != "" && $getdate){
            $sql .= " AND DATE_FORMAT(oh.created_at, '%Y-%m-%d') = '".$getdate."' ";
        }
                
        $sql .= " GROUP BY DATE_FORMAT(oh.created_at, '%Y-%m-%d'), bu.name ORDER BY DATE_FORMAT(oh.created_at, '%Y-%m-%d') DESC";

        $query = $this->db->query($sql);

        return $query->result();
    }
}