<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller{

    //$data['active_menu_id'] = '82';
    //private $activeMenu = '82';

    function __construct(){
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->library('form_validation');

        //$data['active_menu_id'] = $activeMenu;
        //$data['active_menu_id'] = '82';
    }
    

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'products/indexq=' . urlencode($q);
            $config['first_url'] = base_url() . 'products/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'products/index';
            $config['first_url'] = base_url() . 'products/index';
        }

        $config['attributes'] = array('class' => 'page-link');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Products_model->total_rows($q);
        $products = $this->Products_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'products_data' => $products,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['active_menu_id'] = '82';
        $this->load->view('products/ds_product_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Products_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'ds_product_id' => $row->ds_product_id,
    		'ds_product_name' => $row->ds_product_name,
    		'ds_product_category' => $row->ds_product_category,
    		'ds_product_enable' => $row->ds_product_enable,
    		'ds_product_price' => $row->ds_product_price,
    		'ds_product_date_created' => $row->ds_product_date_created,
    		'ds_product_last_modified' => $row->ds_product_last_modified,
    		'ds_product_created_by' => $row->ds_product_created_by,
    		'ds_product_modified_by' => $row->ds_product_modified_by,
    	    );
            $data['active_menu_id'] = '82';
            $this->load->view('products/ds_product_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function create(){
        $this->load->model('product_category_model');
        //$data['product_category'] = $this->product_category_model->get_all();

        $data = array(
        'button' => 'Create',
        'action' => site_url('products/create_action'),
	    'ds_product_id' => set_value('ds_product_id'),
	    'ds_product_name' => set_value('ds_product_name'),
	    'ds_product_category' => set_value('ds_product_category'),
	    'ds_product_enable' => set_value('ds_product_enable'),
	    'ds_product_price' => set_value('ds_product_price'),
	    'ds_product_date_created' => set_value('ds_product_date_created'),
	    'ds_product_last_modified' => set_value('ds_product_last_modified'),
	    'ds_product_created_by' => set_value('ds_product_created_by'),
	    'ds_product_modified_by' => set_value('ds_product_modified_by'),
        'ds_product_is_service' => set_value('ds_product_is_service'),
        'category_list' =>  $this->product_category_model->get_all(),
	);
        $data['active_menu_id'] = '82';
        $this->load->view('products/ds_product_form', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $enable = $this->input->post('ds_product_enable') ? TRUE:FALSE;
            $isService = $this->input->post('ds_product_is_service') ? TRUE:FALSE;

            $data = array(
    		'ds_product_name' => $this->input->post('ds_product_name',TRUE),
    		'ds_product_category' => $this->input->post('ds_product_category',TRUE),
    		'ds_product_enable' => $enable,
    		'ds_product_price' => $this->input->post('ds_product_price',TRUE),
    		'ds_product_date_created' => date('Y-m-d H:i:s'),
    		'ds_product_last_modified' => '',
    		'ds_product_created_by' => $this->session->userdata('user_id'),
    		'ds_product_modified_by' => '',
            'ds_product_is_service' => $isService,
    	    );

            $this->Products_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('products'));
        }
    }
    
    public function update($id) {
        //$this->output->enable_profiler(TRUE);
        $row = $this->Products_model->get_by_id($id);
        //print_r($row);

        if ($row) {
            $this->load->model('product_category_model');
            //$data['product_category'] = $this->Product_category_model->get_all();

            //print_r($data['product_category']);

            $data = array(
                'button' => 'Update',
                'action' => site_url('products/update_action'),
        		'ds_product_id' => set_value('ds_product_id', $row->ds_product_id),
        		'ds_product_name' => set_value('ds_product_name', $row->ds_product_name),
        		'ds_product_category' => set_value('ds_product_category', $row->ds_product_category),
        		'ds_product_enable' => set_value('ds_product_enable', $row->ds_product_enable),
        		'ds_product_price' => set_value('ds_product_price', $row->ds_product_price),
                'ds_product_is_service' => set_value('ds_product_is_service',$row->ds_product_is_service),
                'category_list' =>  $this->product_category_model->get_all(),
	    );
            $data['active_menu_id'] = '82';
            //print_r($data);
            $this->load->view('products/ds_product_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }

    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ds_product_id', TRUE));
        } else {
            $enable = $this->input->post('ds_product_enable') ? TRUE:FALSE;
            $isService = $this->input->post('ds_product_is_service') ? TRUE:FALSE;

            $data = array(
        		'ds_product_name' => $this->input->post('ds_product_name',TRUE),
        		'ds_product_category' => $this->input->post('ds_product_category',TRUE),
        		'ds_product_enable' => $enable,
        		'ds_product_price' => $this->input->post('ds_product_price',TRUE),
        		'ds_product_last_modified' => date('Y-m-d H:i:s'),
        		'ds_product_created_by' => $this->session->userdata('user_id'),
                'ds_product_is_service' => $isService,
        	);

            $this->Products_model->update($this->input->post('ds_product_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('products'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Products_model->get_by_id($id);

        if ($row) {
            $this->Products_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('products'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ds_product_name', 'ds product name', 'trim|required');
	$this->form_validation->set_rules('ds_product_category', 'ds product category', 'trim|required');
	$this->form_validation->set_rules('ds_product_enable', 'ds product enable', 'trim');
	$this->form_validation->set_rules('ds_product_price', 'ds product price', 'trim|numeric');
	//$this->form_validation->set_rules('ds_product_date_created', 'ds product date created', 'trim|required');
	//$this->form_validation->set_rules('ds_product_last_modified', 'ds product last modified', 'trim');
	//$this->form_validation->set_rules('ds_product_created_by', 'ds product created by', 'trim|required');
	//$this->form_validation->set_rules('ds_product_modified_by', 'ds product modified by', 'trim');

	$this->form_validation->set_rules('ds_product_id', 'ds_product_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-23 14:27:43 */
/* http://harviacode.com */