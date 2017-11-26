<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_control_model extends CI_Model {
	function get_all_menu($condition="", $sort="menu_seqn", $order="ASC"){
		if($condition != ""){
			$this->db->where($condition);
		}
		$this->db->order_by($sort, $order);
		$query = $this->db->get('menu');
		
		return $query->result();
	}
	
	function get_all_group($condition="", $sort="id", $order="ASC"){
		if($condition != ""){
			$this->db->where($condition);
		}
		$this->db->order_by($sort, $order);
		$query = $this->db->get('group');
		
		return $query->result();
	}
	
	function get_all_access($condition="", $sort="id", $order="ASC"){
		if($condition != ""){
			$this->db->where($condition);
		}
		$this->db->order_by($sort, $order);
		$query = $this->db->get('base_access');
		
		return $query->result();
	}
	function get_access_by_id($id){
		$this->db->select('base_access.menu_id');
		$this->db->where('group_id',$id);

		$query = $this->db->get('base_access');

		$return_arr = array();
		
		foreach($query->result() as $qv){
			array_push($return_arr,$qv->menu_id);
		}
		return $return_arr;
	}
	function toggle_up($menu_id){
		$current_menu = $this->get_all_menu("id = ".$menu_id);
		
		$sequence = $current_menu[0]->menu_seqn;
		$parent_id = $current_menu[0]->parent_id;
		
		$menu_same_parent = $this->get_all_menu("parent_id = ".$parent_id);
		
		if($sequence != 1){
			$array = array();
			foreach($menu_same_parent as $msp){
				array_push($array, $msp);
			}
			
			for($x=0; $x<count($array); $x++){
				if($array[$x]->id == $menu_id){
					$index_before = --$x;
					break;
				}
			}
			
			$sequence_before = $array[$index_before]->menu_seqn;
			$id_before = $array[$index_before]->id;
			
			//$data['MODIFIED_BY'] = $this->session->userdata('user_id');
			//$data['DATE_MODIFIED'] = date('Y-m-d H:i:s');
			$data['menu_seqn'] = $sequence_before;
			
			$this->db->where('id', $menu_id);
			$this->db->update('menu', $data);
			
			//$data_2['MODIFIED_BY'] = $this->session->userdata('user_id');
			//$data_2['DATE_MODIFIED'] = date('Y-m-d H:i:s');
			$data_2['menu_seqn'] = $sequence;
			
			$this->db->where('id', $id_before);
			$this->db->update('menu', $data_2);
		}
		
		if($parent_id == 0){
			return $parent_id;
		}
		else{
			$temp = $this->get_all_menu("id = ".$parent_id);
			
			if($temp[0]->parent_id == 0){
				return $parent_id;
			}
			else{
				return $temp[0]->parent_id;
			}
		}
	}
	
	function toggle_down($menu_id){
		$current_menu = $this->get_all_menu("id = ".$menu_id);
		
		$sequence = $current_menu[0]->menu_seqn;
		$parent_id = $current_menu[0]->parent_id;
		
		$menu_same_parent = $this->get_all_menu("parent_id = ".$parent_id);
		
		$array = array();
		foreach($menu_same_parent as $msp){
			array_push($array, $msp);
		}
		
		for($x=0; $x<count($array); $x++){
			if($x == (count($array) - 1)){	//Detect if last
				$index_after = -1;
				break;
			}
			
			if($array[$x]->id == $menu_id){
				$index_after = ++$x;
				break;
			}
		}
		
		if($index_after != -1){
			$sequence_after = $array[$index_after]->menu_seqn;
			$id_after = $array[$index_after]->id;
			
			/*$data['MODIFIED_BY'] = $this->session->userdata('user_id');
			$data['DATE_MODIFIED'] = date('Y-m-d H:i:s');*/
			$data['menu_seqn'] = $sequence_after;
			
			$this->db->where('id', $menu_id);
			$this->db->update('menu', $data);
			
			/*$data_2['MODIFIED_BY'] = $this->session->userdata('user_id');
			$data_2['DATE_MODIFIED'] = date('Y-m-d H:i:s');*/
			$data_2['menu_seqn'] = $sequence;
			
			$this->db->where('id', $id_after);
			$this->db->update('menu', $data_2);
		}
		
		if($parent_id == 0){
			return $parent_id;
		}
		else{
			$temp = $this->get_all_menu("id = ".$parent_id);
			
			if($temp[0]->parent_id == 0){
				return $parent_id;
			}
			else{
				return $temp[0]->parent_id;
			}
		}
	}
	
	function update(){
		$post = $this->input->post();
		$group = $this->get_all_group();
		$access = $this->get_all_access();
		
		$current_menu = $this->get_all_menu("id = ".$post['id']);
		$parent_id = $current_menu[0]->parent_id;
		
		foreach($group as $g){
			$found_id = -1;
			foreach($access as $a){
				if($a->menu_id == $post['id'] && $a->group_id == $g->id){
					$found_id = $a->id;
					break;
				}
			}
			
			if($found_id != -1){
				if(isset($post[$g->id]) == FALSE){
					$this->db->where('id', $found_id);
					$this->db->delete('base_access');
				}
			}
			else{
				if(isset($post[$g->id])){
					$data['menu_id'] = $post['id'];
					$data['group_id'] = $g->id;
					$data['date_created'] = date('Y-m-d H:i:s');
					$data['date_modified'] = date('Y-m-d H:i:s');
					$data['created_by'] = $this->session->userdata('user_id');
					$data['modified_by'] = $this->session->userdata('user_id');
					
					$this->db->insert('base_access', $data);
				}
			}
		}
		
		if($parent_id == 0){
			return $post['id'];
		}
		else{
			$temp = $this->get_all_menu("id = ".$parent_id);
			
			if($temp[0]->parent_id == 0){
				return $parent_id;
			}
			else{
				return $temp[0]->parent_id;
			}
		}
	}
	function isAccessExist($menu_id,$group_id){
		$this->db->where('menu_id',$menu_id);
		$this->db->where('group_id',$group_id);

		$query = $this->db->get('base_access');

		return $query->num_rows();
	}
	function removeExist($menu_id,$group_id){
		$this->db->where('menu_id',$menu_id);
		$this->db->where('group_id',$group_id);

		$this->db->delete('base_access');
	}
}