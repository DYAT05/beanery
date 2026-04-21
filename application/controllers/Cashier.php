<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("General_model", "General");
		$this->load->model("Cashier_model", "Cashier");
		date_default_timezone_set('Asia/Manila');

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		if($this->session->userdata('sytem_login_check') != 1){
			redirect(base_url());
		} else {
			if($this->session->userdata('usertype') != "cashier"){
				redirect(base_url());
			}
		}
	}

    public function index(){
		if($this->session->userdata('is_duty') == "1"){
			$data = array(
				'orders' => $this->Cashier->getAllPendingOrders()
			);

			$this->load->view('cashier/dashboard', $data);
		} else {
			redirect('cashier/history');
		}
    }

//     public function index(){
//     if($this->session->userdata('is_duty') == "1"){

//         $orders = $this->Cashier->getAllPendingOrders();

//         echo "<pre>";
//         print_r($orders);
//         exit;

//         $data = array(
//             'orders' => $orders
//         );

//         $this->load->view('cashier/dashboard', $data);
//     } else {
//         redirect('cashier/history');
//     }
// }

    public function execOrderPaid(){
        $this->db->update('order_header', array('user_id' => $this->session->userdata('user_id'), 'order_status' => 'paid', 'name' => $this->input->post('name'), 'cash' => $this->input->post('cash'), 'notes' => $this->input->post('notes'), 'change' => $this->input->post('change')), array('id' => $this->input->post('order_id')));

        redirect('cashier/index', 'success');
    }

	public function pos(){
		if($this->session->userdata('is_duty') == "1"){
			$data = array(
				'categories' => $this->General->getCategories(),
				'poscart' => $this->Cashier->getPosCurrentList()
			);
	
			$this->load->view('cashier/pos', $data);
		} else {
			redirect('cashier/history');
		}
	}

	public function execPosAddToCart(){
		$datainsert = array(
			'menu_id' => $this->input->post('menu_id'),
			'category_id' => $this->input->post('category_id'),
			'quantity' => $this->input->post('quantity'),
			'price' => $this->input->post('price'),
			'status' => 'listed'
		);

		$this->db->insert('pos_cart', $datainsert);

		redirect('cashier/pos', 'success');
	}

	public function execPosUpdateItemInCart(){
		$datainsert = array(
			'quantity' => $this->input->post('quantity')
		);

		$this->db->update('pos_cart', $datainsert, array('id' => $this->input->post('poscart_id')));

		redirect('cashier/pos', 'success');
	}

	public function execPosRemoveItemInCart(){
		$this->db->delete('pos_cart', array('id' => $this->input->post('poscart_id')));

		redirect('cashier/pos', 'success');
	}

	public function execPosProceedToPayment(){
		$itemspos = $this->Cashier->getPosCurrentList();

		$orderheader = array(
			'user_id' => $this->session->userdata('user_id'),
			'total_amount' => $this->input->post('total_amount'),
			'name' => $this->input->post('customer_name'),
			'notes' => $this->input->post('customer_note'),
			'cash' => $this->input->post('cash'),
			'change' => $this->input->post('change'),
			'order_status' => 'paid',
			'created_at' => date('Y-m-d H:i:s'),
		);

		$this->db->insert('order_header', $orderheader);

		$getid = $this->db->insert_id();

		foreach($itemspos AS $item){
			$amount = $item->price * $item->quantity;

			$detailinsert = array(
				'order_header_id' => $getid,
				'menu_id' => $item->menu_id,
				'category_id' => $item->category_id,
				'quantity' => $item->quantity,
				'amount' => $amount,
				'status' => 'prepared',
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('user_id')
			);

			$this->db->insert('order_detail', $detailinsert);
			$this->db->update('pos_cart', array('status' => 'processed'), array('id' => $item->id));
		}

		echo $getid;

		// redirect('cashier/printTransactionReceipt/'.$getid, '_blank');

		// echo "
        //     <script>
        //         window.open('".base_url()."index.php/cashier/printTransactionReceipt/".$getid."', '_blank');
        //     </script>
        //     ";

		// redirect('cashier/pos', 'success');
	}

	public function execSubmitPettyCash(){
		$data = array(
			'cashier_id' => $this->session->userdata('user_id'),
			'transaction_datetime' => date('Y-m-d'),
			'created_at' => date('Y-m-d H:i:s'),
			'petty_cash' => $this->input->post('petty_cash')
		);

		$this->db->insert('transactions', $data);
		$this->db->update('beanery_users', array('is_duty' => 1), array('id' => $this->session->userdata('user_id')));
		$this->session->set_userdata('is_duty', 1);

		redirect('cashier/index', 'success');
	}

	public function execSubmitEndSession(){
		$retval = $this->input->post('transaction_id');
		$dataupdate = array(
			'cash_out' => $this->input->post('cash_count'),
			'transaction_count' => $this->input->post('transaction_count'),
			'updated_at' => date('Y-m-d H:i:s'),
			'p1' => $this->input->post('p1'),
			'p5' => $this->input->post('p5'),
			'p10' => $this->input->post('p10'),
			'p20' => $this->input->post('p20'),
			'p50' => $this->input->post('p50'),
			'p100' => $this->input->post('p100'),
			'p200' => $this->input->post('p200'),
			'p500' => $this->input->post('p500'),
			'p1000' => $this->input->post('p1000'),
			'cashier_name' => $this->input->post('cashier')
		);

		$this->db->update('transactions', $dataupdate, array('id'=>$this->input->post('transaction_id')));
		$this->db->update('beanery_users', array('is_duty' => 0), array('id' => $this->session->userdata('user_id')));
		$this->db->update('order_header', array('is_out' => 1), array('is_out' => 0));
		$this->session->set_userdata('is_duty', 0);

		echo $retval;
	}
	
    // public function history(){
    //     $transacted = array('prepared', 'paid');

    //     $data = array(
    //         'orders' => $this->General->getAllTransactionOrders($transacted)
    //     );

	// 	$this->load->view('cashier/history', $data);
    // }

// DYAT

public function history(){
	    $transacted = array('prepared', 'paid');

	    $start_date = $this->input->get('start_date');
	    $end_date   = $this->input->get('end_date');

	    // Convert datetime-local format
	    if (!empty($start_date)) {
	        $start_date = date('Y-m-d H:i:s', strtotime($start_date));
	    }

	    if (!empty($end_date)) {
	        $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +1 minute -1 second'));
	    }

	    $data = array(
	        'orders' => $this->General->getAllTransactionOrders($transacted, $start_date, $end_date)
	    );

	    $this->load->view('cashier/history', $data);
	}

 // DYAT

    public function getOrders()
	{
	    return $this->db->get('orders')->result();
	}

	public function printTransactionReceipt($orderid = null){
		$header = $this->Cashier->getOrderHeaderDetails($orderid);
		$details = $this->Cashier->getOrderInfoDetails($orderid);

		if($header){
			$data = array(
				'headercontent' => $header,
				'detailscontent' => $details,
			);
	
			$this->load->view('receipt', $data);
		} else {
			redirect(base_url());
		}
	}

	public function printEndingSession($id){
		$details = $this->Cashier->getTransactionDetails($id);

		$data = array(
			'detailscontent' => $details,
		);

		$this->load->view('cashier/ending_session', $data);
	}

	// DYAT

	public function downloadHistory()
{
    $transacted = array('prepared', 'paid');

    $start_date = $this->input->get('start_date');
    $end_date   = $this->input->get('end_date');

    if (!empty($start_date)) {
        $start_date = date('Y-m-d H:i:s', strtotime($start_date));
    }

    if (!empty($end_date)) {
        $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +1 minute -1 second'));
    }


    $orders = $this->General->getAllTransactionOrders($transacted, $start_date, $end_date);

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=transaction_history.csv");

    $output = fopen("php://output", "w");

    // Header
    fputcsv($output, ['Datetime', 'Ordered By', 'Total Amount']);

    foreach ($orders as $order) {
        fputcsv($output, [
            $order->created_at,
            $order->name,
            number_format($order->total_amount, 2)
        ]);
    }

    fclose($output);
    exit;
}

	// DYAT
}