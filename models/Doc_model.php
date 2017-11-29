<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doc_model extends CI_Model{

	public $table = 'pos_doc';
    public $id = 'pos_doc_id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }
    function get_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function total_rows($q = NULL) {
    	$this->db->join('pos_doc_type','pos_doc_type.pos_doc_type_id = pos_doc.pos_doc_type_id','left');
    	$this->db->join('mod_clients','mod_clients.mod_clients_id = pos_doc.pos_doc_customer_id','left');
    	$this->db->join('ds_branch','ds_branch.ds_branch_id = pos_doc.pos_doc_branch_id','left');

        $this->db->like('pos_doc_id', $q);
		$this->db->or_like('pos_doc_inv_id', $q);
		$this->db->or_like('pos_doc_date', $q);
		$this->db->or_like('mod_clients.mod_clients_fullname', $q);
		$this->db->or_like('ds_branch.ds_branch_name', $q);

		$this->db->from($this->table);
	    
	    return $this->db->count_all_results();
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$member_id = NULL) {
    	$this->db->join('pos_doc_type','pos_doc_type.pos_doc_type_id = pos_doc.pos_doc_type_id','left');
    	$this->db->join('mod_clients','mod_clients.mod_clients_id = pos_doc.pos_doc_customer_id','left');
    	$this->db->join('ds_branch','ds_branch.ds_branch_id = pos_doc.pos_doc_branch_id','left');

        $this->db->order_by($this->id, $this->order);

        if($q){
        	$this->db->like('pos_doc_id', $q);
			$this->db->or_like('pos_doc_inv_id', $q);
			$this->db->or_like('pos_doc_date', $q);
			$this->db->or_like('mod_clients.mod_clients_fullname', $q);
			$this->db->or_like('ds_branch.ds_branch_name', $q);
        }
        

		if($member_id>0){
			$this->db->where('pos_doc_customer_id',$member_id);
		}

		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

	function batch_save_child($arr){
		$this->db->insert_batch('pos_doc_child', $arr); 
	}
	function save_main($arr){
		$this->db->insert('pos_doc',$arr);
		return $this->db->insert_id();
	}
	function getNextInv($branch){
		$this->load->model('branch_model');
		$branch_info = $this->branch_model->getByID($branchID);
	}
	function getDocByID($id){
		$this->db->join('mod_clients','mod_clients.mod_clients_id = pos_doc.pos_doc_customer_id');
		$this->db->where('pos_doc_id',$id);

		$query = $this->db->get('pos_doc');

		return $query->row();
	}
	function getChildByID($id){
		$this->db->join('ds_product', 'ds_product.ds_product_id = pos_doc_child.pos_doc_child_product_id','left');
		$this->db->where('pos_doc_id',$id);

		$query = $this->db->get('pos_doc_child');

		return $query->result();
	}
   
}

/* End of file Members_model.php */
/* Location: ./application/models/Members_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-22 20:47:24 */
/* http://harviacode.com */