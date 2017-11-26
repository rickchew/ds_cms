<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_category/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_category/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_category/index';
            $config['first_url'] = base_url() . 'product_category/index';
        }
		$config['attributes'] = array('class' => 'page-link');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_category_model->total_rows($q);
        $product_category = $this->Product_category_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_category_data' => $product_category,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$data['active_menu_id'] = '82';
        $this->load->view('product_category/ds_product_category_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Product_category_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ds_product_category_id' => $row->ds_product_category_id,
		'ds_product_category_name' => $row->ds_product_category_name,
		'ds_product_category_enable' => $row->ds_product_category_enable,
		'ds_product_category_date_created' => $row->ds_product_category_date_created,
		'ds_product_category_date_modified' => $row->ds_product_category_date_modified,
		'ds_product_category_created_by' => $row->ds_product_category_created_by,
		'ds_product_category_modified_by' => $row->ds_product_category_modified_by,
	    );
            $data['active_menu_id'] = '82';
            $this->load->view('product_category/ds_product_category_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_category'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_category/create_action'),
	    'ds_product_category_id' => set_value('ds_product_category_id'),
	    'ds_product_category_name' => set_value('ds_product_category_name'),
	    'ds_product_category_enable' => set_value('ds_product_category_enable'),
	    'ds_product_category_date_created' => set_value('ds_product_category_date_created'),
	    'ds_product_category_date_modified' => set_value('ds_product_category_date_modified'),
	    'ds_product_category_created_by' => set_value('ds_product_category_created_by'),
	    'ds_product_category_modified_by' => set_value('ds_product_category_modified_by'),
	);
        $data['active_menu_id'] = '82';
        $this->load->view('product_category/ds_product_category_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $enable = $this->input->post('ds_product_category_enable') ? TRUE:FALSE;
            $data = array(
    		'ds_product_category_name' => $this->input->post('ds_product_category_name',TRUE),
    		'ds_product_category_enable' => $enable,
    		'ds_product_category_date_created' => date('Y-m-d H:i:s'),
    		'ds_product_category_date_modified' => '',
    		'ds_product_category_created_by' => $this->session->userdata('user_id'),
    		'ds_product_category_modified_by' => '',
    	    );

            $this->Product_category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('product_category'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_category_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_category/update_action'),
        		'ds_product_category_id' => set_value('ds_product_category_id', $row->ds_product_category_id),
        		'ds_product_category_name' => set_value('ds_product_category_name', $row->ds_product_category_name),
        		'ds_product_category_enable' => set_value('ds_product_category_enable', $row->ds_product_category_enable),
        		'ds_product_category_date_created' => set_value('ds_product_category_date_created', $row->ds_product_category_date_created),
        		'ds_product_category_date_modified' => set_value('ds_product_category_date_modified', $row->ds_product_category_date_modified),
        		'ds_product_category_created_by' => set_value('ds_product_category_created_by', $row->ds_product_category_created_by),
        		'ds_product_category_modified_by' => set_value('ds_product_category_modified_by', $row->ds_product_category_modified_by),
        	    );
            $data['active_menu_id'] = '82';
            $this->load->view('product_category/ds_product_category_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_category'));
        }
    }
    
    public function update_action() 
    {
        //print_r($_POST);
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ds_product_category_id', TRUE));
        } else {
            $enable = $this->input->post('ds_product_category_enable') ? TRUE:FALSE;
            $data = array(
    		'ds_product_category_name' => $this->input->post('ds_product_category_name',TRUE),
    		'ds_product_category_enable' => $enable,
    		'ds_product_category_date_modified' => date('Y-m-d H:i:s'),
    		//'ds_product_category_created_by' => $this->input->post('ds_product_category_created_by',TRUE),
    		'ds_product_category_modified_by' => $this->session->userdata('user_id'),
    	    );

            $this->Product_category_model->update($this->input->post('ds_product_category_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product_category'));
        }
        //$this->output->enable_profiler(TRUE);
    }
    
    public function delete($id) {
        $this->load->model('products_model');
        $product_in_this_category = $this->products_model->get_by_category($id);

        if($product_in_this_category){
            $this->session->set_flashdata('error_message', 'This is not an <strong>EMPTY</strong> category !');
            redirect(site_url('product_category'));
        }

        
        $row = $this->Product_category_model->get_by_id($id);

        if ($row) {
            $this->Product_category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product_category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_category'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ds_product_category_name', 'ds product category name', 'trim|required');
	$this->form_validation->set_rules('ds_product_category_enable', 'ds product category enable', 'trim');
	$this->form_validation->set_rules('ds_product_category_date_created', 'ds product category date created', 'trim');
	$this->form_validation->set_rules('ds_product_category_date_modified', 'ds product category date modified', 'trim');
	$this->form_validation->set_rules('ds_product_category_created_by', 'ds product category created by', 'trim');
	$this->form_validation->set_rules('ds_product_category_modified_by', 'ds product category modified by', 'trim');

	$this->form_validation->set_rules('ds_product_category_id', 'ds_product_category_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Product_category.php */
/* Location: ./application/controllers/Product_category.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-23 21:11:17 */
/* http://harviacode.com */