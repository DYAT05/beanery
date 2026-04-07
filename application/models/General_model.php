<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getOrderDetails($orderid){
		$this->db->select('order_detail.*');
		$this->db->select('menu.menu_name');
		$this->db->select('menu_categories.category_name');
		$this->db->from('order_detail');
		$this->db->join('menu', 'menu.id = order_detail.menu_id','inner');
		$this->db->join('menu_categories', 'menu_categories.id = order_detail.category_id','inner');
		$this->db->where('order_detail.order_header_id', $orderid);
		$this->db->order_by('menu_categories.category_name', 'ASC');
		$this->db->order_by('menu.menu_name', 'ASC');

		$query = $this->db->get();

		return $query->result();
	}

	public function getCategories(){
		$query = $this->db->get_where('menu_categories', array('active' => 1));

		return $query->result();
	}

	public function getMenuPerCategory($category){
		$query = $this->db->get_where('menu', array('active' => 1, 'category_id' => $category));

		return $query->result();
	}

	// public function getAllTransactionOrders($arrstatus){
		
	// 	$this->db->select('*');
	// 	$this->db->from('order_header');
	// 	$this->db->where_in('order_status', $arrstatus);
	// 	$query = $this->db->get();

	// 	return $query->result();
	// }


// DYAT
public function getAllTransactionOrders($arrstatus, $start_date = null, $end_date = null){
    
    $this->db->select('*');
    $this->db->from('order_header');
    $this->db->where_in('order_status', $arrstatus);

    if (!empty($start_date)) {
        $this->db->where('created_at >=', $start_date);
    }

    if (!empty($end_date)) {
        $this->db->where('created_at <=', $end_date);
    }

    $this->db->order_by('created_at', 'DESC');

    $query = $this->db->get();

    return $query->result();
}


//DYAT

	public function getOrdersByDate($start_date, $end_date)
{
    $this->db->where('created_at >=', $start_date);
    $this->db->where('created_at <=', $end_date);
    return $this->db->get('orders')->result();
}

	public function getTotalTransactionOrders($arrstatus){
		$this->db->select('SUM(total_amount) as grandtotal');
		$this->db->from('order_header');
		$this->db->where_in('order_status', $arrstatus);
		
		$query = $this->db->get();

		return $query->row();
	}

	public function getTotalTransactionOrdersCurrent($arrstatus){
		$todaydate = date('Y-m-d');
		$fromdate = date('Y-m-d', strtotime($todaydate. ' - 1 days')). ' 00:00:00';
		$todate = date('Y-m-d'). ' 23:59:59';

		$this->db->select('SUM(total_amount) as grandtotal');
		$this->db->from('order_header');
		$this->db->where_in('order_status', $arrstatus);
		$this->db->where('created_at BETWEEN "'. $fromdate. '" and "'. $todate.'"');
		
		$query = $this->db->get();

		return $query->row();
	}

	public function getTopOrderedItems(){
		$this->db->select('menu.menu_name');
		$this->db->select('menu_categories.category_name');
		$this->db->select('COUNT(order_detail.menu_id) AS countitem');
		$this->db->from('order_detail');
		$this->db->join('menu', 'menu.id = order_detail.menu_id', 'inner');
		$this->db->join('menu_categories', 'menu_categories.id = order_detail.category_id', 'inner');
		$this->db->where('status', 'prepared');
		$this->db->group_by('order_detail.menu_id');
		$this->db->group_by('menu_name');
		$this->db->group_by('category_name');
		$this->db->limit(5);

		$query = $this->db->get();

		return $query->result();
	}
	
	public function getTotalTransactionOrdersPerMonth($month){
		$arrstatus = array('prepared', 'paid');

		$this->db->select('SUM(total_amount) as grandtotal');
		$this->db->from('order_header');
		$this->db->where_in('order_status', $arrstatus);
		$this->db->where('MONTH(created_at)', $month);
		
		$query = $this->db->get();

		return $query->row();
	}
}

// DYAT


// DYAT