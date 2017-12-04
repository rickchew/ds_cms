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
    	$this->db->join('ds_branch','ds_branch.ds_branch_id = pos_doc.pos_doc_branch_id','left');
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
		$arr['pos_doc_inv_id'] = $this->getNextInv($arr['pos_doc_branch_id']);
		$this->db->insert('pos_doc',$arr);
		return $this->db->insert_id();
	}
	function getNextInv($branch){
		//$this->load->model('branch_model');
		//$branch_info = $this->branch_model->getByID($branchID);



		$this->load->model('branch_model');

		$branch_info = $this->branch_model->get_by_id($branch);


		//print_r($branch_info);

		switch ($this->input->post('docType')) {
		    case 1:
		        $search = $branch_info->ds_branch_code.date('Y'); // GET NEXT INVOICE
		        break;
		    case 2:
		        $search = 'OD'.$branch_info->ds_branch_code.date('Y'); // GET NEXT ORDER
		        break;
		    case 8:
		        //code to be executed if n=label3;
		    	$search = $branch_info->ds_branch_code.date('Y'); // GET NEXT INVOICE
		        break;
		    default:
		        //code to be executed if n is different from all labels;
		}
		
		
		$this->db->where("pos_doc_inv_id LIKE '$search%'");
		$this->db->order_by('pos_doc_inv_id','DESC');

		$query = $this->db->get('pos_doc');

		$result = $query->row();
		//echo "<hr>";
		//print_r($result);

		//$lastInv = ;
		$inv_no = isset($result->pos_doc_inv_id) ? substr($result->pos_doc_inv_id, -4):0;
		
        $inv_no += 1;

        //echo "This>>>>".sprintf('%04d',$inv_no);
        

        $display_inv_no = $search.sprintf('%04d',$inv_no);

		//print_r($display_inv_no);
		//$this->output->enable_profiler(true);

		return $display_inv_no;



	}
	function getDocByID($id){
		$this->db->join('mod_clients','mod_clients.mod_clients_id = pos_doc.pos_doc_customer_id','left');
		$this->db->join('ds_branch','ds_branch.ds_branch_id = pos_doc.pos_doc_branch_id','left');
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
	function cancel($id){
		$data['pos_doc_is_cancel'] = 1;
		$data['pos_doc_payment_wo_gst'] = 0;
		$data['pos_doc_payment_gst'] = 0;
		$data['pos_doc_payment_total'] = 0;

		$this->cancel_delete_child($id);

		$this->db->where($this->id, $id);
        $this->db->update($this->table, $data);


	}
	function cancel_delete_child($doc_id){

        $this->db->where($this->id, $doc_id);
        $this->db->delete('pos_doc_child');
	}
	function batch_update_child($doc_id,$data){
		$this->db->where('pos_doc_id',$doc_id);
		/*
		$data = array(
		   array(
		      'pos_doc_child_id' => '220' ,
		      'pos_doc_child_product_price' => '111' ,
		      //'date' => 'My date 2'
		   ),
		   array(
		      'pos_doc_child_id' => '219' ,
		      'pos_doc_child_product_price' => '222' ,
		      //'date' => 'Another date 2'
		   )
		);*/
		$this->db->update_batch('pos_doc_child', $data, 'pos_doc_child_id'); 
		$this->update_main_by_id($doc_id);
	}
   	function update_main_by_id($order_id){
   		$this->db->where('pos_doc_id',$order_id);
   		$data['pos_doc_order_saved'] = 1;

   		$this->db->update('pos_doc',$data);
   	}
   	function getInv($order_id){
   		$this->db->where('pos_doc_order_id',$order_id);
   		$query = $this->db->get('pos_doc');

   		return $query->result();
   	}
   	function manual_inv($main,$child){

   	}
}

/* End of file Members_model.php */
/* Location: ./application/models/Members_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-22 20:47:24 */
/* http://harviacode.com */