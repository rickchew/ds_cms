<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_attribute extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_attribute_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_attribute/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_attribute/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_attribute/index';
            $config['first_url'] = base_url() . 'product_attribute/index';
        }
		$config['attributes'] = array('class' => 'page-link');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_attribute_model->total_rows($q);
        $product_attribute = $this->Product_attribute_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_attribute_data' => $product_attribute,
            'action' => site_url('product_attribute/create_action'),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$data['active_menu_id'] = '0';
        $this->load->view('product_attribute/ds_product_attribute_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Product_attribute_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ds_product_attribute_id' => $row->ds_product_attribute_id,
		'ds_product_attribute_name' => $row->ds_product_attribute_name,
		'ds_product_attribute_enable' => $row->ds_product_attribute_enable,
	    );
            $this->load->view('product_attribute/ds_product_attribute_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_attribute/create_action'),
	    'ds_product_attribute_id' => set_value('ds_product_attribute_id'),
	    'ds_product_attribute_name' => set_value('ds_product_attribute_name'),
	    'ds_product_attribute_enable' => set_value('ds_product_attribute_enable'),
	);
        $this->load->view('product_attribute/ds_product_attribute_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ds_product_attribute_name' => $this->input->post('ds_product_attribute_name',TRUE),
		'ds_product_attribute_enable' => $this->input->post('ds_product_attribute_enable',TRUE),
	    );

            $this->Product_attribute_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('product_attribute'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_attribute_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_attribute/update_action'),
		'ds_product_attribute_id' => set_value('ds_product_attribute_id', $row->ds_product_attribute_id),
		'ds_product_attribute_name' => set_value('ds_product_attribute_name', $row->ds_product_attribute_name),
		'ds_product_attribute_enable' => set_value('ds_product_attribute_enable', $row->ds_product_attribute_enable),
	    );
            $this->load->view('product_attribute/ds_product_attribute_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ds_product_attribute_id', TRUE));
        } else {
            $data = array(
		'ds_product_attribute_name' => $this->input->post('ds_product_attribute_name',TRUE),
		'ds_product_attribute_enable' => $this->input->post('ds_product_attribute_enable',TRUE),
	    );

            $this->Product_attribute_model->update($this->input->post('ds_product_attribute_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product_attribute'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_attribute_model->get_by_id($id);

        if ($row) {
            $this->Product_attribute_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product_attribute'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_attribute'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ds_product_attribute_name', 'ds product attribute name', 'trim|required');
	$this->form_validation->set_rules('ds_product_attribute_enable', 'ds product attribute enable', 'trim');

	$this->form_validation->set_rules('ds_product_attribute_id', 'ds_product_attribute_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Product_attribute.php */
/* Location: ./application/controllers/Product_attribute.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-29 15:06:22 */
/* http://harviacode.com */