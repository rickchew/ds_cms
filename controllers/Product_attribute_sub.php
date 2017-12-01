<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_attribute_sub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_attribute_sub_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_attribute_sub/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_attribute_sub/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_attribute_sub/index';
            $config['first_url'] = base_url() . 'product_attribute_sub/index';
        }
		$config['attributes'] = array('class' => 'page-link');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_attribute_sub_model->total_rows($q);
        $product_attribute_sub = $this->Product_attribute_sub_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_attribute_sub_data' => $product_attribute_sub,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$data['active_menu_id'] = '82';
        $this->load->view('product_attribute_sub/ds_product_attribute_sub_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Product_attribute_sub_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ds_product_attribute_sub_id' => $row->ds_product_attribute_sub_id,
		'ds_product_attribute_parent_id' => $row->ds_product_attribute_parent_id,
		'ds_product_attribute_sub_name' => $row->ds_product_attribute_sub_name,
		'ds_product_attribute_sub_enable' => $row->ds_product_attribute_sub_enable,
	    );
            $this->load->view('product_attribute_sub/ds_product_attribute_sub_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute_sub'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_attribute_sub/create_action'),
	    'ds_product_attribute_sub_id' => set_value('ds_product_attribute_sub_id'),
	    'ds_product_attribute_parent_id' => set_value('ds_product_attribute_parent_id'),
	    'ds_product_attribute_sub_name' => set_value('ds_product_attribute_sub_name'),
	    'ds_product_attribute_sub_enable' => set_value('ds_product_attribute_sub_enable'),
	);
        $this->load->view('product_attribute_sub/ds_product_attribute_sub_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ds_product_attribute_parent_id' => $this->input->post('ds_product_attribute_parent_id',TRUE),
		'ds_product_attribute_sub_name' => $this->input->post('ds_product_attribute_sub_name',TRUE),
		'ds_product_attribute_sub_enable' => $this->input->post('ds_product_attribute_sub_enable',TRUE),
	    );

            $this->Product_attribute_sub_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            //redirect(site_url('product_attribute_sub'));
            redirect(site_url('product_attribute_sub/add_sub/'.$this->input->post('ds_product_attribute_parent_id')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_attribute_sub_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_attribute_sub/update_action'),
		'ds_product_attribute_sub_id' => set_value('ds_product_attribute_sub_id', $row->ds_product_attribute_sub_id),
		'ds_product_attribute_parent_id' => set_value('ds_product_attribute_parent_id', $row->ds_product_attribute_parent_id),
		'ds_product_attribute_sub_name' => set_value('ds_product_attribute_sub_name', $row->ds_product_attribute_sub_name),
		'ds_product_attribute_sub_enable' => set_value('ds_product_attribute_sub_enable', $row->ds_product_attribute_sub_enable),
	    );
            $this->load->view('product_attribute_sub/ds_product_attribute_sub_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute_sub'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ds_product_attribute_sub_id', TRUE));
        } else {
            $data = array(
		'ds_product_attribute_parent_id' => $this->input->post('ds_product_attribute_parent_id',TRUE),
		'ds_product_attribute_sub_name' => $this->input->post('ds_product_attribute_sub_name',TRUE),
		'ds_product_attribute_sub_enable' => $this->input->post('ds_product_attribute_sub_enable',TRUE),
	    );

            $this->Product_attribute_sub_model->update($this->input->post('ds_product_attribute_sub_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product_attribute_sub/add_sub/'.$this->input->post('ds_product_attribute_parent_id')));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_attribute_sub_model->get_by_id($id);

        if ($row) {
            $this->Product_attribute_sub_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product_attribute_sub'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute_sub'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ds_product_attribute_parent_id', 'ds product attribute parent id', 'trim|required');
	$this->form_validation->set_rules('ds_product_attribute_sub_name', 'ds product attribute sub name', 'trim|required');
	$this->form_validation->set_rules('ds_product_attribute_sub_enable', 'ds product attribute sub enable', 'trim');

	$this->form_validation->set_rules('ds_product_attribute_sub_id', 'ds_product_attribute_sub_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function add_sub($id){
        //$this->
        $this->load->model('product_attribute_model');
        $data['info'] = $this->product_attribute_model->get_by_id($id);
        $data['sub'] = $this->Product_attribute_sub_model->get_by_main_id($id);
        $this->load->view('product_attribute_sub/add_sub',$data);
    }

}

/* End of file Product_attribute_sub.php */
/* Location: ./application/controllers/Product_attribute_sub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-01 19:56:27 */
/* http://harviacode.com */