<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	function login($username, $password){
		$this->db->flush_cache();
	
		$this->db->select('cms_users.*,base_group.description');
		$this->db->join('base_group', 'cms_users.group_id = base_group.group');
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
	
		$this->db->limit('1');
		$this->db->order_by('u_id');
		
		$query= $this->db->get('cms_users');
		//print_r($query);
		
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}
	/*
	function save($data){
		$this->db->insert('cms_users',$data);
	}*/
	function fb_register(){

		$data['fb_birthday'] = $this->input->post('birthday');
		$data['username'] = $this->session->userdata('fb_id');
		$data['email'] = $this->input->post('email');
		$data['fullname'] = $this->input->post('name');
		$data['group_id'] = '7';
		//$data['fb_id'] = $this->session->userdata('fb_id');
		//$data['fb_contact'] = $this->input->post('contact');

		$this->db->insert('cms_users',$data);
	}
	function update($id,$data){
		$this->db->where('u_id',$id);
		$this->db->update('cms_users',$data);
	}
	function getByID($id){
		$this->db->where('u_id',$id);
		$query = $this->db->get('cms_users');
		
		return $query->row();
	}

	function fetch_data($limit,$start,$condition=NULL){
		
		$this->db->order_by('username','asc');
		$this->db->limit($limit, $start);
		$query = $this->db->get("cms_users");
		
		return $query->num_rows() > 0 ? $query->result():null;
	}
	function record_count($condition=NULL){
		$query = $this->db->get('cms_users');
		return $query->num_rows();
	}
	function getAllStaff(){
		$this->db->select('cms_users.*,cms_groups.g_code');
		$this->db->join('cms_groups','cms_groups.g_id = cms_users.group_id');
		$this->db->where('group_id != 1');
		$query = $this->db->get('cms_users');
		
		return $query->result();
	}
	function isMember($fb_id){

		$this->db->where('fb_id',$fb_id);

		$query = $this->db->get('cms_users');
		if($query->num_rows() == 1){
			$result = $query->row();


			$sess_array = array();
			$this->session->set_userdata("user_id",$result->u_id);
			$this->session->set_userdata("username",$result->username);
			$this->session->set_userdata("password",$result->password);
			$this->session->set_userdata("name",$result->fullname);
			$this->session->set_userdata('logged_in', "1");
			$this->session->set_userdata('group_id', $result->group_id);
			$this->session->set_userdata('branch_id', $result->branch_id);
			$this->session->set_userdata('fb_id', $fb_id);
			//$this->session->set_userdata('group_name', $result->description);

			//print_r($this->session->all_userdata());
			return TRUE;
		}else{
			return FALSE;
		}
		//return $query->rows();
	}
	function groupsList(){
		$this->db->select('base_group.*, COUNT(cms_users.u_id) as sum_users');
		$this->db->join('cms_users', 'base_group.group = cms_users.group_id','left')
         ->group_by('cms_users.group_id');
        $this->db->order_by('group','asc');
		$query = $this->db->get('base_group');

		return $query->result();
	}
	function getByGroup($id){
		$this->db->where('group_id');
		$query = $this->db->get('cms_users');

		return $query->result();
	}
	function fetch_data_group($limit,$start,$group_id){
		$this->db->where('group_id',$group_id);
		$this->db->order_by('u_id','asc');
		$this->db->limit($limit, $start);
		$query = $this->db->get("cms_users");
		
		return $query->num_rows() > 0 ? $query->result():null;
	}
	function record_count_group($group_id){
		$this->db->where('group_id',$group_id);
		$query = $this->db->get('cms_users');
		return $query->num_rows();
	}
	function getByGroupID($id){
		$this->db->where('group',$id);

		$query = $this->db->get('base_group');
		return $query->row();
	}
	function getAccessListByGroupID($groupID){
		$this->db->select('menu_id');
		$this->db->where('group_id',$groupID);

		$query = $this->db->get('base_access');
		return $query->result();
	}
}