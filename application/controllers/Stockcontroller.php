<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockcontroller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("General_model", "General");
		$this->load->model("Stockcontroller_model", "Stockcontroller");
		date_default_timezone_set('Asia/Manila');

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		if($this->session->userdata('sytem_login_check') != 1){
			redirect(base_url());
		} else {
			if($this->session->userdata('usertype') != "stockcontroller"){
				redirect(base_url());
			}
		}
	}

    public function index(){
        $transacted = array('prepared', 'paid');

        $data = array(
            'topitems' => $this->General->getTopOrderedItems(),
            'lowstocks' => $this->Stockcontroller->getLowStocksInventory(),
            'currenttotalsales' => ($this->General->getTotalTransactionOrdersCurrent($transacted)->grandtotal) ? number_format($this->General->getTotalTransactionOrdersCurrent($transacted)->grandtotal, 2) : '0',
            'totalsales' => ($this->General->getTotalTransactionOrders($transacted)->grandtotal) ? number_format($this->General->getTotalTransactionOrders($transacted)->grandtotal, 2) : '0',
            'totaltransactions' => count($this->General->getAllTransactionOrders($transacted))
        );

		$this->load->view('stockcontroller/dashboard', $data);
    }

    public function inventoryPerishable(){
        $data = array(
            'categorylink' => 'inventoryPerishable',
            'printcategorylink' => 'printInventoryPerishable',
            'items' => $this->Stockcontroller->getAllInventoryItems('perishable')
        );

		$this->load->view('stockcontroller/inventory/perishable', $data);
    }

    public function printInventoryPerishable(){
        $data = array(
            'categorylink' => 'inventoryPerishable',
            'items' => $this->Stockcontroller->getAllInventoryItems('perishable')
        );

		$this->load->view('stockcontroller/inventory/print_perishable', $data);
    }

    public function inventoryNonperishable(){
        $data = array(
            'categorylink' => 'inventoryNonperishable',
            'printcategorylink' => 'printInventoryNonperishable',
            'items' => $this->Stockcontroller->getAllInventoryItems('nonperishable')
        );

		$this->load->view('stockcontroller/inventory/nonperishable', $data);
    }

    public function printInventoryNonperishable(){
        $data = array(
            'categorylink' => 'inventoryNonperishable',
            'items' => $this->Stockcontroller->getAllInventoryItems('nonperishable')
        );

		$this->load->view('stockcontroller/inventory/print_nonperishable', $data);
    }

    public function inventorySanitation(){
        $data = array(
            'categorylink' => 'inventorySanitation',
            'printcategorylink' => 'printInventorySanitation',
            'items' => $this->Stockcontroller->getAllInventoryItems('sanitation')
        );

		$this->load->view('stockcontroller/inventory/sanitation', $data);
    }

    public function printInventorySanitation(){
        $data = array(
            'categorylink' => 'inventorySanitation',
            'items' => $this->Stockcontroller->getAllInventoryItems('sanitation')
        );

		$this->load->view('stockcontroller/inventory/print_sanitation', $data);
    }

    public function inventorySmallwares(){
        $data = array(
            'categorylink' => 'inventorySmallwares',
            'printcategorylink' => 'printInventorySmallwares',
            'items' => $this->Stockcontroller->getAllInventoryItems('smallwares')
        );

		$this->load->view('stockcontroller/inventory/smallwares', $data);
    }

    public function printInventorySmallwares(){
        $data = array(
            'categorylink' => 'inventorySmallwares',
            'items' => $this->Stockcontroller->getAllInventoryItems('smallwares')
        );

		$this->load->view('stockcontroller/inventory/print_smallwares', $data);
    }

    public function inventoryCookware(){
        $data = array(
            'categorylink' => 'inventoryCookware',
            'printcategorylink' => 'printInventoryCookware',
            'items' => $this->Stockcontroller->getAllInventoryItems('cookware')
        );

		$this->load->view('stockcontroller/inventory/cookware', $data);
    }

    public function printInventoryCookware(){
        $data = array(
            'categorylink' => 'inventoryCookware',
            'items' => $this->Stockcontroller->getAllInventoryItems('cookware')
        );

		$this->load->view('stockcontroller/inventory/print_cookware', $data);
    }

    public function inventoryEquipment(){
        $data = array(
            'categorylink' => 'inventoryEquipment',
            'printcategorylink' => 'printInventoryEquipment',
            'items' => $this->Stockcontroller->getAllInventoryItems('equipment')
        );

		$this->load->view('stockcontroller/inventory/equipment', $data);
    }

    public function printInventoryEquipment(){
        $data = array(
            'categorylink' => 'inventoryEquipment',
            'items' => $this->Stockcontroller->getAllInventoryItems('equipment')
        );

		$this->load->view('stockcontroller/inventory/print_equipment', $data);
    }

    public function execAddNewStock(){
        $datainsert= $this->input->post();

        unset($datainsert['categorylink']);

        $datainsertlogs= $datainsert;

        $this->db->insert('inventory', $datainsert);

        $inventoryid = $this->db->insert_id();

        $datainsertlogs['inventory_id'] = $inventoryid;
        $datainsertlogs['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('inventory_logs', $datainsertlogs);


        redirect('stockcontroller/'.$this->input->post('categorylink'));
    }

    public function execUpdateStock(){
        $dataupdate= $this->input->post();

        unset($dataupdate['inventory_id']);
        unset($dataupdate['categorylink']);

        $this->db->update('inventory', $dataupdate, array('id' => $this->input->post('inventory_id')));

        $datainsertlogs= $dataupdate;
        
        $inventoryid = $this->input->post('inventory_id');

        $datainsertlogs['inventory_id'] = $inventoryid;
        $datainsertlogs['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('inventory_logs', $datainsertlogs);

        redirect('stockcontroller/'.$this->input->post('categorylink'));
    }

    public function removeItemInventory($item, $urilink){
        $this->db->delete('inventory', array('id' => $item));

        redirect('stockcontroller/'.$urilink);
    }

    public function modifyInventory($category){
        $data = array(
            'items' => $this->Stockcontroller->getAllInventoryItems(str_replace('-', '', $category))
        );
        $this->load->view('stockcontroller/updateinventory', $data);
    }

    public function getInventoryItemDetail(){
        $query = $this->db->get_where('inventory', array('id' => $this->input->post('getitemid')));

        echo json_encode($query->row());
    }

    public function updateInventoryStock(){
        $dataupdate = $this->input->post();
        $dataupdate['beginning_inventory'] = $this->input->post('old_ending_inventory');
        $dataupdate['is_updated'] = 1;
        $dataupdate['total_stock'] = $this->input->post('ending_inventory');

        unset($dataupdate['item_id']);
        unset($dataupdate['old_ending_inventory']);

        $this->db->update('inventory', $dataupdate, array('id' => $this->input->post('item_id')));

        $datainsertlogs= $dataupdate;

        unset($datainsertlogs['is_updated']);
        
        $inventoryid = $this->input->post('item_id');

        $datainsertlogs['inventory_id'] = $inventoryid;
        $datainsertlogs['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('inventory_logs', $datainsertlogs);

        redirect('stockcontroller/inventory'.str_replace('-', '', ucwords($this->input->post('category'))));
    }

    public function inventoryLogs($item){
        $data = array(
            'itemname' => $this->Stockcontroller->getStockInventoryItemDescription($item)->item,
            'itemlogs' => $this->Stockcontroller->getInventoryLogsPerItem($item)
        );

		$this->load->view('stockcontroller/inventory_logs', $data);
    }

    public function restaurantReportSummary(){
        $transdate = $this->input->get('transdate');

        $data = array(
            'transactions' => $this->Stockcontroller->getOrderHeaderReports($transdate)
        );

		$this->load->view('stockcontroller/report/summary', $data);
    }

    public function printRestaurantReportSummary(){
        $transdate = $this->input->get('transdate');

        $data = array(
            'transactions' => $this->Stockcontroller->getOrderHeaderReports($transdate)
        );

		$this->load->view('stockcontroller/report/print_summary', $data);
    }
}