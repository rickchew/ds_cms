<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model','',TRUE);
	}

	function index(){

		//$this->output->enable_profiler(TRUE);
		//$this->input->post('password') = '1234';
		//$this->input->post('username') = "admin";
		//$result = $this->user_model->login('admin', '1234');
		//print_r($result);
		//print_r($this->session->all_userdata());
		
		//echo CI_VERSION;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		/*
		$result = $this->user_model->login($this->input->post('username'), $this->input->post('password'));
		
		$result = $this->user_model->login("admin","1234");
		if($result){
			
			$return = array('success'=>'1','msg'=>'SUCCESSFULL');
			print_r($result);
			$this->session->set_userdata("user_id",$result->u_id);
		}else{
			$return = array('success'=>'0');
		}*/

		
		$re = $this->check_database($this->input->post('password'));
		//print_r($re);
		if($re){
			$return = array('success'=>'1','msg'=>'SUCCESSFULL');
		}else{
			$return = array('success'=>'0');
		}

		//print_r($re);
		//$return = array('success'=>'0');
		//print_r($this->session->all_userdata());
		//print_r($this->form_validation->run());
		/*
		if($this->form_validation->run() == FALSE){
			$return = array('success'=>'0');
		}else{
			$return = array('success'=>'1','msg'=>'SUCCESSFULL');
		}*/
		//$_POST['password'] = 1234;
		
		//$return = array('success'=>'1','msg'=>'SUCCESSFULL');
		//print_r($this->form_validation->run());
		//$return['tmp'] = $_POST;
		header('Content-type: application/json');
		echo json_encode($return);

	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		//echo "1234";
		$username = $this->input->post('username');
		//query the database
		$result = $this->user_model->login($username, $password);
		//print_r($result);

		if($result)	{
			$sess_array = array();
			$this->session->set_userdata("user_id",$result->u_id);
			$this->session->set_userdata("username",$result->username);
			$this->session->set_userdata("password",$result->password);
			$this->session->set_userdata("name",$result->fullname);
			$this->session->set_userdata('logged_in', "1");
			$this->session->set_userdata('group_id', $result->group_id);
			$this->session->set_userdata('outlet_id', $result->cms_users_store_id);
			//$this->session->set_userdata('branch_id', $result->branch_id);
			$this->session->set_userdata('group_name', $result->description);
			//$this->session->set_userdata('normal_hour', $result->working_hour);
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			$this->session->set_flashdata('error', 'Wrong password!');
			return false;
		}
	}
}
?>