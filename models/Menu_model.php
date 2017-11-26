<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {
	
	function getParent($type){
		$this->db->where('(parent_id = 0 OR parent_id IS NULL)');
		//$this->db->or_where('parent_id ISNULL'); 
		$this->db->where('menu_type',$type);
		$this->db->where('menu_active','1');
		//$this->db->where('parent_id = 0');
		$this->db->order_by('menu_seqn');
		
		$query = $this->db->get('base_menu');
		
		//print_r($query->result());
		return $query->result();
		//return '!!!!';
	}
	function getChild($type){
		$this->db->where('parent_id != 0');
		$this->db->where('menu_type',$type);
		$this->db->where('menu_active','1');
		$this->db->order_by('menu_seqn');
		
		$query = $this->db->get('base_menu');
		
		return $query->result();
	}
}