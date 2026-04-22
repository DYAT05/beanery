<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kitchen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("General_model", "General");
		$this->load->model("Kitchen_model", "Kitchen");
		date_default_timezone_set('Asia/Manila');

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		if($this->session->userdata('sytem_login_check') != 1){
			redirect(base_url());
		} else {
			if($this->session->userdata('usertype') != "kitchen"){
				redirect(base_url());
			}
		}
	}

    // public function index(){
    //     $data = array(
    //         'orders' => $this->Kitchen->getAllPaidOrders()
    //     );

	// 	$this->load->view('kitchen/dashboard', $data);
    // }

// DYAT

	// current approach is not time-triggered, it is event-triggered
	// fix all old data whenever this code runs
	// Whenever someone opens the system, it clean up all old unpaid orders

	public function index()
	{
	    // Get current date
	    $todayStart = date('Y-m-d') . ' 00:00:00';

	    //  AUTO UPDATE: All yesterday and older "paid" orders → "prepared"
	    $this->db->set('order_status', 'prepared');
	    $this->db->where('order_status', 'paid');
	    $this->db->where('DATE(created_at) < CURDATE()', NULL, FALSE);
	    $this->db->update('order_header');

	    // (Optional) Update order_detail table as well
	    $this->db->set([
	        'status' => 'prepared',
	        'updated_at' => date('Y-m-d H:i:s')
	    ]);
	    $this->db->where('status', 'paid');
	    $this->db->where('DATE(updated_at) < CURDATE()', NULL, FALSE);
	    $this->db->update('order_detail');

	    //  LOAD ONLY TODAY'S ORDERS (for kitchen dashboard)
	    // $this->db->where('DATE(created_at) = CURDATE()', NULL, FALSE);
		$today = date('Y-m-d'); // get today's date in 'YYYY-MM-DD'
		$this->db->where('created_at >=', $today . ' 00:00:00');
		$this->db->where('created_at <=', $today . ' 23:59:59');
	    $this->db->where('order_status', 'paid');
	    $data['orders'] = $this->db->get('order_header')->result();

	    // Load your view
	    $this->load->view('kitchen/dashboard', $data);
	}


	
//DYAT 

    public function execOrderPrepared(){
        $this->db->update('order_header', array('order_status' => 'prepared'), array('id' => $this->input->post('order_id')));
        $this->db->update('order_detail', array('status' => 'prepared', 'updated_at' => date('Y-m-d H:i:s')), array('order_header_id' => $this->input->post('order_id')));

        redirect('kitchen/index', 'success');
    }
	
    public function history(){
        $transacted = array('prepared');

        $data = array(
            'orders' => $this->General->getAllTransactionOrders($transacted)
        );

		$this->load->view('kitchen/history', $data);
    }
}
