<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_model", "Login");
		date_default_timezone_set('Asia/Manila');

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	public function index()
	{	

		if($this->session->userdata('sytem_login_check') == 1){
			$userrole = $this->session->userdata('usertype');
			redirect(strtolower($userrole).'/index', 'Redirect Correct');
		} else {
			$data = array(
					'flashdata'	=>	$this->session->flashdata('action'),
				);

			$this->load->view('login', $data);

		}

	}

	public function loginpage(){

		if($this->session->userdata('sytem_login_check') == 1){
			$userrole = $this->session->userdata('usertype');
			redirect(strtolower($userrole).'/index', 'Redirect Correct');
		} else {
			$data = array(
					'flashdata'	=>	$this->session->flashdata('action'),
				);

			$this->load->view('login', $data);

		}
	}

	public function verify()
	{
		$hashedpassword = md5(base64_encode(md5($this->input->post('password'))));
		
		$user = $this->Login->doLogin($this->input->post('username'), $hashedpassword);

		if($user){
			$this->session->set_userdata(array(
				'sytem_login_check'		=>	1,
				'email'				=>	$user->email,
				'name'					=>	$user->name,
				'usertype'				=> 	$user->usertype,
				'user_id'				=> 	$user->id,
				'is_duty'				=> 	$user->is_duty,
			));

			redirect($user->usertype.'/index', 'Success');
		} else {
			$this->session->set_flashdata('action', 'error');

			redirect('login/loginpage', 'Login');
		}
	}

	public function logout(){
		unset($_SESSION['access_token']);

		$this->session->sess_destroy();

		redirect(base_url(), 'Error');
	}

}