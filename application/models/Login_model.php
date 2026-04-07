<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function doLogin($user, $pass){
		$sql = "SELECT u.*
				FROM beanery_users AS u
				WHERE BINARY u.email = BINARY ? 
					AND BINARY u.password = ?
				";

		$query = $this->db->query($sql, array($user, $pass));
		
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	} 

	public function getUserInfo($code,$usercode){
		if($code == "U"){
			$query = $this->db->get_where('user_info', array('usercode' => $usercode));
		} else {
			$query = $this->db->get_where('judge_details', array('usercode' => $usercode));
		}

		return $query->row();
	}

	public function checkExistingUsers($username){
		$sql = "SELECT *
				FROM user_info
				WHERE registration_email = ?
				";

		$query = $this->db->query($sql, array($username));

		if($query->num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	public function getCollegeList(){
		
		$query = $this->db->get('colleges_list');

		return $query->result();
	}

	public function checkSchoolCollegeExist($schoolname, $college){
		$query = $this->db->get_where('user_info', array('school_name' => $schoolname, 'college' => $college));

		return $query->row();
	}
}